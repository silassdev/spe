<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\WalletAddress;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    /**
     * Display the deposit screen.
     */
    public function index()
    {
        $user = Auth::user();
        $deposits = Deposit::where('user_id', $user->id)->orderBy('id', 'desc')->get();
        $adminWallets = WalletAddress::where('status', 'active')->get();

        return view('user.deposit', [
            'user' => $user,
            'deposits' => $deposits,
            'adminWallets' => $adminWallets,
        ]);
    }

    /**
     * Store a new pending deposit request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => ['required', 'numeric', 'min:10'], // Min deposit $10
            'currency' => ['required', 'string', 'in:BTC,ETH,USDT,BNB'],
            'tx_hash' => ['required', 'string', 'unique:deposits,tx_hash'],
            'proof_img' => ['required', 'image', 'max:4096'], // Proof of payment screenshot
        ]);

        $user = Auth::user();
        $proofPath = null;
        
        if ($request->hasFile('proof_img')) {
            $proofPath = $request->file('proof_img')->store('proofs', 'public');
        }

        Deposit::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'currency' => $request->currency,
            'tx_hash' => $request->tx_hash,
            'proof_img' => $proofPath,
            'type' => 'deposit',
            'status' => 'pending',
        ]);

        return redirect()->route('deposit')->with('status', 'deposit-submitted');
    }
}
