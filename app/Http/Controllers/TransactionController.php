<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display historical transactions ledger.
     */
    public function index()
    {
        $user = Auth::user();
        $transactions = Transaction::where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('user.transactions', [
            'user' => $user,
            'transactions' => $transactions,
        ]);
    }
}
