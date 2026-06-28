<?php

namespace App\Http\Controllers;

use App\Models\Tier;
use App\Models\User;
use App\Models\Deposit;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Display the Cryptocore Welcome Home UI.
     */
    public function index()
    {
        $tiers = Tier::orderBy('price', 'asc')->get();
        
        // Dynamic aggregate stats to display on the technical grid HUD
        $totalUsers = User::where('role', 'user')->count();
        $totalDeposited = Deposit::where('status', 'confirmed')->sum('amount');
        
        // Provide mock live transactions ticker data
        $recentTransactions = [
            ['time' => now()->subMinutes(2)->format('H:i:s'), 'user' => 'silas', 'coin' => 'USDT', 'amount' => '350.00', 'type' => 'DEPOSIT // CONFIRMED'],
            ['time' => now()->subMinutes(12)->format('H:i:s'), 'user' => 'john', 'coin' => 'BTC', 'amount' => '0.05', 'type' => 'DEPOSIT // CONFIRMED'],
            ['time' => now()->subMinutes(25)->format('H:i:s'), 'user' => 'cynthia', 'coin' => 'ETH', 'amount' => '100.00', 'type' => 'UPGRADE // PENDING'],
            ['time' => now()->subMinutes(42)->format('H:i:s'), 'user' => 'silas', 'coin' => 'USDT', 'amount' => '100.00', 'type' => 'WITHDRAW // PENDING'],
            ['time' => now()->subMinutes(60)->format('H:i:s'), 'user' => 'admin', 'coin' => 'USDT', 'amount' => '12.50', 'type' => 'REFERRAL // DISPATCHED'],
        ];

        return view('welcome', [
            'tiers' => $tiers,
            'totalUsers' => max(48, $totalUsers + 45), // Base simulation offset
            'totalDeposited' => max(184000.00, $totalDeposited + 184000.00),
            'recentTransactions' => $recentTransactions,
        ]);
    }
}
