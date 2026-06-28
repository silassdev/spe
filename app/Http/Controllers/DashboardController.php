<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Investment;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\Referral;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the main user dashboard telemetry.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Calculate portfolio value (active investments sum)
        $portfolioValue = Investment::where('user_id', $user->id)
            ->where('status', 'active')
            ->sum('amount');

        // Calculate referral earnings
        $referralEarnings = Referral::where('referrer_id', $user->id)
            ->sum('commission');

        // Recent user history lists
        $recentDeposits = Deposit::where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

        $recentWithdrawals = Withdrawal::where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

        $currentInvestments = Investment::with('tier')
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->orderBy('id', 'desc')
            ->get();

        // System Announcements
        $announcements = Announcement::orderBy('id', 'desc')->limit(5)->get();

        // Quick notifications/activity simulation
        $notifications = [
            'Secure Session Authenticated from IP: ' . request()->ip(),
            $user->email_verified_at ? 'Identity verified.' : 'Please verify email address.',
        ];

        return view('user.dashboard', [
            'user' => $user,
            'portfolioValue' => $portfolioValue,
            'referralEarnings' => $referralEarnings,
            'recentDeposits' => $recentDeposits,
            'recentWithdrawals' => $recentWithdrawals,
            'currentInvestments' => $currentInvestments,
            'announcements' => $announcements,
            'notifications' => $notifications,
        ]);
    }

    /**
     * Display the referrals statistics.
     */
    public function referrals()
    {
        $user = Auth::user();

        // List of referrals under this user
        $referrals = Referral::with('referred')
            ->where('referrer_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();

        $totalEarnings = Referral::where('referrer_id', $user->id)->sum('commission');

        // Generate dynamic referral link
        $referralLink = route('register') . '?ref=' . $user->username;

        return view('user.referrals', [
            'user' => $user,
            'referrals' => $referrals,
            'totalEarnings' => $totalEarnings,
            'referralLink' => $referralLink,
        ]);
    }
}
