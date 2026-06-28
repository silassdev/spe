<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\PinResetController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Welcome / Homepage
Route::get('/', [WelcomeController::class, 'index'])->name('home');

// Auth routes (handled in auth.php)
require __DIR__.'/auth.php';

Route::get('/email/confirmed', function (\Illuminate\Http\Request $request) {
    return view('auth.email-confirmed', [
        'status' => $request->query('status', 'success')
    ]);
})->name('email.confirmed');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    // Forced PIN reset flow (Users can access this if they need to reset, bypasses the must_reset_pin redirect)
    Route::get('/reset-pin', [PinResetController::class, 'show'])->name('pin.reset');
    Route::post('/reset-pin', [PinResetController::class, 'store']);
});

// Authenticated & Secure Routes (Subject to PIN checks)
Route::middleware(['auth', 'verified', 'must_reset_pin'])->group(function () {
    
    // User Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/deposit', [DepositController::class, 'index'])->name('deposit');
    Route::post('/deposit', [DepositController::class, 'store'])->name('deposit.store');
    
    Route::get('/withdraw', [WithdrawalController::class, 'index'])->name('withdraw');
    Route::post('/withdraw', [WithdrawalController::class, 'store'])->name('withdraw.store');
    
    Route::get('/invest', [InvestmentController::class, 'index'])->name('invest');
    Route::post('/invest', [InvestmentController::class, 'store'])->name('invest.store');
    
    Route::get('/membership', [MembershipController::class, 'index'])->name('membership');
    Route::post('/membership/upgrade', [MembershipController::class, 'upgrade'])->name('membership.upgrade');
    
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
    Route::get('/referrals', [DashboardController::class, 'referrals'])->name('referrals');
    
    Route::get('/support', [SupportTicketController::class, 'index'])->name('support');
    Route::post('/support', [SupportTicketController::class, 'store'])->name('support.store');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Dashboard Routes
    Route::middleware(['can:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::post('/users/{user}/reset-pin', [AdminController::class, 'resetUserPin'])->name('users.reset-pin');
        
        Route::get('/deposits', [AdminController::class, 'deposits'])->name('deposits');
        Route::post('/deposits/{deposit}/approve', [AdminController::class, 'approveDeposit'])->name('deposits.approve');
        Route::post('/deposits/{deposit}/reject', [AdminController::class, 'rejectDeposit'])->name('deposits.reject');
        
        Route::get('/withdrawals', [AdminController::class, 'withdrawals'])->name('withdrawals');
        Route::post('/withdrawals/{withdrawal}/approve', [AdminController::class, 'approveWithdrawal'])->name('withdrawals.approve');
        Route::post('/withdrawals/{withdrawal}/reject', [AdminController::class, 'rejectWithdrawal'])->name('withdrawals.reject');
        
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
        Route::post('/settings/wallets', [AdminController::class, 'updateWallets'])->name('settings.wallets');
        
        Route::get('/support', [AdminController::class, 'support'])->name('support');
        Route::post('/support/{ticket}/reply', [AdminController::class, 'replySupport'])->name('support.reply');
    });
});
