<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\Investment;
use App\Models\Referral;
use App\Models\Transaction;
use App\Models\SystemSetting;
use App\Models\WalletAddress;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display administrative dashboard statistics.
     */
    public function index()
    {
        $stats = [
            'totalUsers' => User::where('role', 'user')->count(),
            'activeUsers' => User::where('role', 'user')->where('status', 'active')->count(),
            'pendingDeposits' => Deposit::where('status', 'pending')->count(),
            'revenue' => Deposit::where('status', 'confirmed')->sum('amount'),
            'totalInvestments' => Investment::where('status', 'active')->sum('amount'),
            'totalWithdrawals' => Withdrawal::where('status', 'approved')->sum('amount'),
            'membershipUpgrades' => Deposit::where('type', 'upgrade')->where('status', 'confirmed')->count(),
            'dailySignups' => User::whereDate('created_at', today())->count(),
        ];

        return view('admin.dashboard', [
            'stats' => $stats
        ]);
    }

    /**
     * List and search platform users.
     */
    public function users()
    {
        $users = User::with('tier')->where('role', 'user')->orderBy('id', 'desc')->get();
        return view('admin.users', ['users' => $users]);
    }

    /**
     * Trigger a mandatory Security PIN reset for a user.
     */
    public function resetUserPin(User $user)
    {
        // Nullify current PIN and raise reset flag
        $user->update([
            'pin' => null,
            'must_reset_pin' => true
        ]);

        return redirect()->route('admin.users')->with('status', 'pin-reset-success');
    }

    /**
     * Display all pending deposits & membership upgrades.
     */
    public function deposits()
    {
        $deposits = Deposit::with(['user', 'targetTier'])
            ->where('status', 'pending')
            ->orderBy('id', 'desc')
            ->get();
        return view('admin.deposits', ['deposits' => $deposits]);
    }

    /**
     * Approve user deposits and trigger upgrades + referral payouts.
     */
    public function approveDeposit(Deposit $deposit)
    {
        if ($deposit->status !== 'pending') {
            return back()->withErrors(['error' => 'This deposit has already been processed.']);
        }

        $user = $deposit->user;

        // Upgrade-type deposit handling
        if ($deposit->type === 'upgrade') {
            $tier = $deposit->targetTier;

            // Associate user to Tier
            $user->update(['tier_id' => $tier->id]);

            // Create Active Investment ROI Plan
            Investment::create([
                'user_id' => $user->id,
                'tier_id' => $tier->id,
                'amount' => $deposit->amount,
                'profit' => 0.00,
                'status' => 'active',
                'started_at' => now(),
                'expires_at' => now()->addDays($tier->duration),
                'last_roi_at' => now(),
            ]);

            // Record transaction
            Transaction::create([
                'user_id' => $user->id,
                'type' => 'Upgrade',
                'amount' => -$deposit->amount,
                'description' => 'Upgraded to ' . $tier->name . ' Membership level. Active investment initiated.',
            ]);

            // Handle referral commission calculations
            $referral = Referral::where('referred_id', $user->id)->first();
            if ($referral) {
                $refPercent = (float) SystemSetting::getVal('referral_percent', 5.00);
                $commission = ($deposit->amount * $refPercent) / 100;
                
                $referrer = $referral->referrer;
                $referrer->increment('wallet_balance', $commission);

                $referral->update([
                    'commission' => $referral->commission + $commission
                ]);

                // Log referral transaction payout
                Transaction::create([
                    'user_id' => $referrer->id,
                    'type' => 'Referral',
                    'amount' => $commission,
                    'description' => 'Referral bonus from referred user ' . $user->username . ' upgrading to ' . $tier->name . '.',
                ]);
            }
        } else {
            // General balance deposit handling
            $user->increment('wallet_balance', $deposit->amount);

            Transaction::create([
                'user_id' => $user->id,
                'type' => 'Deposit',
                'amount' => $deposit->amount,
                'description' => 'Deposit confirmation. Added to wallet balance.',
            ]);
        }

        // Finalize deposit
        $deposit->update([
            'status' => 'confirmed',
            'confirmed_at' => now()
        ]);

        return redirect()->route('admin.deposits')->with('status', 'deposit-approved');
    }

    /**
     * Reject deposit proof submissions.
     */
    public function rejectDeposit(Deposit $deposit)
    {
        if ($deposit->status !== 'pending') {
            return back()->withErrors(['error' => 'This deposit has already been processed.']);
        }

        $deposit->update(['status' => 'rejected']);

        return redirect()->route('admin.deposits')->with('status', 'deposit-rejected');
    }

    /**
     * Display pending user cashouts.
     */
    public function withdrawals()
    {
        $withdrawals = Withdrawal::with('user')
            ->where('status', 'pending')
            ->orderBy('id', 'desc')
            ->get();
        return view('admin.withdrawals', ['withdrawals' => $withdrawals]);
    }

    /**
     * Approve user withdrawals.
     */
    public function approveWithdrawal(Withdrawal$withdrawal)
    {
        if ($withdrawal->status !== 'pending') {
            return back()->withErrors(['error' => 'This withdrawal has already been processed.']);
        }

        $withdrawal->update(['status' => 'approved']);

        return redirect()->route('admin.withdrawals')->with('status', 'withdrawal-approved');
    }

    /**
     * Reject user withdrawals and refund their account.
     */
    public function rejectWithdrawal(Withdrawal $withdrawal)
    {
        if ($withdrawal->status !== 'pending') {
            return back()->withErrors(['error' => 'This withdrawal has already been processed.']);
        }

        $user = $withdrawal->user;
        
        // Revert deduction (Amount + fee)
        $refundAmount = $withdrawal->amount + $withdrawal->fee;
        $user->increment('wallet_balance', $refundAmount);

        $withdrawal->update(['status' => 'rejected']);

        // Log transaction history
        Transaction::create([
            'user_id' => $user->id,
            'type' => 'Bonus', // Classified as a Refund
            'amount' => $refundAmount,
            'description' => 'Withdrawal request rejected by administrator. Funds refunded to wallet.',
        ]);

        return redirect()->route('admin.withdrawals')->with('status', 'withdrawal-rejected');
    }

    /**
     * Show general site settings and wallet destinations.
     */
    public function settings()
    {
        $settings = [
            'site_name' => SystemSetting::getVal('site_name', 'CryptoCore'),
            'maintenance_mode' => SystemSetting::getVal('maintenance_mode', '0'),
            'referral_percent' => SystemSetting::getVal('referral_percent', '5.00'),
            'min_deposit' => SystemSetting::getVal('min_deposit', '10.00'),
            'min_withdrawal' => SystemSetting::getVal('min_withdrawal', '50.00'),
        ];

        $wallets = WalletAddress::all();

        return view('admin.settings', [
            'settings' => $settings,
            'wallets' => $wallets,
        ]);
    }

    /**
     * Update dynamic settings variables.
     */
    public function updateSettings(Request $request)
    {
        $request->validate([
            'site_name' => ['required', 'string', 'max:100'],
            'maintenance_mode' => ['required', 'in:0,1'],
            'referral_percent' => ['required', 'numeric', 'min:0', 'max:100'],
            'min_deposit' => ['required', 'numeric', 'min:1'],
            'min_withdrawal' => ['required', 'numeric', 'min:1'],
        ]);

        SystemSetting::setVal('site_name', $request->site_name);
        SystemSetting::setVal('maintenance_mode', $request->maintenance_mode);
        SystemSetting::setVal('referral_percent', $request->referral_percent);
        SystemSetting::setVal('min_deposit', $request->min_deposit);
        SystemSetting::setVal('min_withdrawal', $request->min_withdrawal);

        return redirect()->route('admin.settings')->with('status', 'settings-updated');
    }

    /**
     * Update dynamic admin receive key destinations.
     */
    public function updateWallets(Request $request)
    {
        $request->validate([
            'wallet' => ['required', 'array'],
            'wallet.*' => ['required', 'string', 'min:10'],
        ]);

        foreach ($request->wallet as $walletId => $address) {
            $wallet = WalletAddress::find($walletId);
            if ($wallet) {
                $wallet->update(['address' => $address]);
            }
        }

        return redirect()->route('admin.settings')->with('status', 'wallets-updated');
    }

    /**
     * View active tickets.
     */
    public function support()
    {
        $tickets = SupportTicket::with('user')->orderBy('id', 'desc')->get();
        return view('admin.support', ['tickets' => $tickets]);
    }

    /**
     * Reply to support tickets.
     */
    public function replySupport(Request $request, SupportTicket $ticket)
    {
        $request->validate([
            'reply' => ['required', 'string', 'max:2000']
        ]);

        // Simulating email dispatch/internal response
        $ticket->update(['status' => 'replied']);

        return redirect()->route('admin.support')->with('status', 'ticket-replied');
    }
}
