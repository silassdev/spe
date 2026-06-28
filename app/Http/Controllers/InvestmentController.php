<?php

namespace App\Http\Controllers;

use App\Models\Tier;
use App\Models\Investment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvestmentController extends Controller
{
    /**
     * Display available investment plans and subscriptions.
     */
    public function index()
    {
        $user = Auth::user();
        $tiers = Tier::orderBy('price', 'asc')->get();
        $investments = Investment::with('tier')->where('user_id', $user->id)->orderBy('id', 'desc')->get();

        return view('user.invest', [
            'user' => $user,
            'tiers' => $tiers,
            'investments' => $investments,
        ]);
    }

    /**
     * Subscribe to an investment tier plan using wallet balance.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tier_id' => ['required', 'exists:tiers,id'],
            'pin' => ['required', 'string', 'size:6'], // Verify user PIN before investment
        ]);

        $user = Auth::user();
        $tier = Tier::findOrFail($request->tier_id);

        // Verify Security PIN
        if (! \Illuminate\Support\Facades\Hash::check($request->pin, $user->pin)) {
            return back()->withErrors(['pin' => 'The security PIN provided is incorrect.']);
        }

        // Verify balance
        if ($user->wallet_balance < $tier->price) {
            return back()->withErrors(['tier_id' => 'Insufficient wallet balance. Please deposit funds first.']);
        }

        // Deduct price
        $user->decrement('wallet_balance', $tier->price);

        // Update active user membership tier
        $user->update(['tier_id' => $tier->id]);

        // Create Active Investment
        Investment::create([
            'user_id' => $user->id,
            'tier_id' => $tier->id,
            'amount' => $tier->price,
            'profit' => 0.00,
            'status' => 'active',
            'started_at' => now(),
            'expires_at' => now()->addDays($tier->duration),
            'last_roi_at' => now(), // Setup baseline
        ]);

        // Record Transaction
        Transaction::create([
            'user_id' => $user->id,
            'type' => 'Upgrade',
            'amount' => -$tier->price,
            'description' => 'Activated ' . $tier->name . ' Investment Plan. Price: ' . $tier->price . ' USD. Duration: ' . $tier->duration . ' Days. Daily ROI: ' . $tier->daily_roi . '%.',
        ]);

        return redirect()->route('dashboard')->with('status', 'plan-activated');
    }
}
