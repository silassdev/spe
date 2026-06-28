<?php

namespace App\Http\Controllers;

use App\Models\Tier;
use App\Models\Deposit;
use App\Models\WalletAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    /**
     * Display membership levels and allow upgrades.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $tiers = Tier::orderBy('price', 'asc')->get();
        $adminWallets = WalletAddress::where('status', 'active')->get();
        
        $selectedTier = null;
        if ($request->has('tier_id')) {
            $selectedTier = Tier::find($request->tier_id);
        }

        return view('user.membership', [
            'user' => $user,
            'tiers' => $tiers,
            'selectedTier' => $selectedTier,
            'adminWallets' => $adminWallets,
        ]);
    }

    /**
     * Submit an upgrade verification proof for admin approval.
     */
    public function upgrade(Request $request)
    {
        $request->validate([
            'tier_id' => ['required', 'exists:tiers,id'],
            'currency' => ['required', 'string', 'in:BTC,ETH,USDT,BNB'],
            'tx_hash' => ['required', 'string', 'unique:deposits,tx_hash'],
            'proof_img' => ['required', 'image', 'max:4096'],
        ]);

        $user = Auth::user();
        $tier = Tier::findOrFail($request->tier_id);
        
        $proofPath = null;
        if ($request->hasFile('proof_img')) {
            $proofPath = $request->file('proof_img')->store('proofs', 'public');
        }

        Deposit::create([
            'user_id' => $user->id,
            'amount' => $tier->price,
            'currency' => $request->currency,
            'tx_hash' => $request->tx_hash,
            'proof_img' => $proofPath,
            'type' => 'upgrade',
            'target_tier_id' => $tier->id,
            'status' => 'pending',
        ]);

        return redirect()->route('membership')->with('status', 'upgrade-submitted');
    }
}
