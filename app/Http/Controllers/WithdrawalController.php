<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use App\Models\Transaction;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    /**
     * Display the withdrawal interface.
     */
    public function index()
    {
        $user = Auth::user();
        $withdrawals = Withdrawal::where('user_id', $user->id)->orderBy('id', 'desc')->get();
        $minWithdrawal = (float) SystemSetting::getVal('min_withdrawal', 50.00);

        return view('user.withdraw', [
            'user' => $user,
            'withdrawals' => $withdrawals,
            'minWithdrawal' => $minWithdrawal,
        ]);
    }

    /**
     * Store a new pending withdrawal request.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $minWithdrawal = (float) SystemSetting::getVal('min_withdrawal', 50.00);

        $request->validate([
            'amount' => ['required', 'numeric', 'min:' . $minWithdrawal],
            'wallet_address' => ['required', 'string', 'min:10', 'max:150'],
            'pin' => ['required', 'string', 'size:6'], // Verify user's Security PIN before allowing withdrawal!
        ]);

        // Verify Security PIN
        if (! \Illuminate\Support\Facades\Hash::check($request->pin, $user->pin)) {
            return back()->withErrors(['pin' => 'The security PIN provided is incorrect.']);
        }

        // Check if user has sufficient balance
        if ($user->wallet_balance < $request->amount) {
            return back()->withErrors(['amount' => 'You do not have enough wallet balance for this withdrawal.']);
        }

        // Apply a flat 2.00 USD network fee
        $fee = 2.00;
        
        // Deduct balance immediately to prevent double spending
        $user->decrement('wallet_balance', $request->amount);

        // Record pending withdrawal
        $withdrawal = Withdrawal::create([
            'user_id' => $user->id,
            'wallet_address' => $request->wallet_address,
            'amount' => $request->amount - $fee,
            'fee' => $fee,
            'status' => 'pending',
        ]);

        // Log transaction history
        Transaction::create([
            'user_id' => $user->id,
            'type' => 'Withdrawal',
            'amount' => -$request->amount,
            'description' => 'Withdrawal request of ' . $request->amount . ' USD submitted to ' . $request->wallet_address . '. Fee: ' . $fee . ' USD.',
        ]);

        return redirect()->route('withdraw')->with('status', 'withdraw-submitted');
    }
}
