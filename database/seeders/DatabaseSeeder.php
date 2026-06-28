<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tier;
use App\Models\WalletAddress;
use App\Models\SystemSetting;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\Investment;
use App\Models\Referral;
use App\Models\Transaction;
use App\Models\Announcement;
use App\Models\SupportTicket;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Tiers (Membership Levels)
        $bronze = Tier::create([
            'name' => 'Bronze',
            'price' => 100.00,
            'daily_roi' => 1.20,
            'duration' => 30, // days
        ]);

        $silver = Tier::create([
            'name' => 'Silver',
            'price' => 500.00,
            'daily_roi' => 1.50,
            'duration' => 45,
        ]);

        $gold = Tier::create([
            'name' => 'Gold',
            'price' => 2500.00,
            'daily_roi' => 1.80,
            'duration' => 60,
        ]);

        $platinum = Tier::create([
            'name' => 'Platinum',
            'price' => 10000.00,
            'daily_roi' => 2.20,
            'duration' => 90,
        ]);

        $diamond = Tier::create([
            'name' => 'Diamond',
            'price' => 50000.00,
            'daily_roi' => 2.80,
            'duration' => 120,
        ]);

        // 2. Seed Admin Wallet Addresses
        WalletAddress::create([
            'coin_name' => 'Bitcoin',
            'coin_symbol' => 'BTC',
            'address' => '3FZbgi29cpjq2GjdwV8eyHuJJnkLtktZc5',
            'status' => 'active',
        ]);

        WalletAddress::create([
            'coin_name' => 'Ethereum',
            'coin_symbol' => 'ETH',
            'address' => '0x71C7656EC7ab88b098defB751B7401B5f6d8976F',
            'status' => 'active',
        ]);

        WalletAddress::create([
            'coin_name' => 'USDT (ERC20)',
            'coin_symbol' => 'USDT',
            'address' => '0x71C7656EC7ab88b098defB751B7401B5f6d8976F',
            'status' => 'active',
        ]);

        WalletAddress::create([
            'coin_name' => 'BNB (Smart Chain)',
            'coin_symbol' => 'BNB',
            'address' => '0x71C7656EC7ab88b098defB751B7401B5f6d8976F',
            'status' => 'active',
        ]);

        // 3. Seed System Settings
        SystemSetting::setVal('site_name', 'CryptoCore');
        SystemSetting::setVal('logo', '/img/logo.png');
        SystemSetting::setVal('maintenance_mode', '0');
        SystemSetting::setVal('referral_percent', '5.00');
        SystemSetting::setVal('min_deposit', '10.00');
        SystemSetting::setVal('min_withdrawal', '50.00');

        // 4. Seed Admin Account
        $admin = User::create([
            'username' => 'admin',
            'name' => 'System Administrator',
            'email' => 'admin@cryptocore.com',
            'phone' => '+2348012345678',
            'password' => Hash::make('password'),
            'pin' => Hash::make('123456'),
            'must_reset_pin' => false,
            'role' => 'admin',
            'status' => 'active',
            'country' => 'United States',
            'email_verified_at' => now(),
        ]);

        // 5. Seed regular users
        $userSilas = User::create([
            'username' => 'silas',
            'name' => 'Silas Dev',
            'email' => 'silas@example.com',
            'phone' => '+2348022222222',
            'password' => Hash::make('password'),
            'pin' => Hash::make('111111'),
            'must_reset_pin' => false,
            'role' => 'user',
            'status' => 'active',
            'country' => 'Nigeria',
            'tier_id' => $bronze->id,
            'wallet_balance' => 250.00,
            'email_verified_at' => now(),
        ]);

        $userJohn = User::create([
            'username' => 'john',
            'name' => 'John Obi',
            'email' => 'john@example.com',
            'phone' => '+2348033333333',
            'password' => Hash::make('password'),
            'pin' => Hash::make('222222'),
            'must_reset_pin' => false,
            'role' => 'user',
            'status' => 'active',
            'country' => 'Nigeria',
            'tier_id' => $silver->id,
            'wallet_balance' => 1050.00,
            'email_verified_at' => now(),
        ]);

        $userCynthia = User::create([
            'username' => 'cynthia',
            'name' => 'Cynthia Adams',
            'email' => 'cynthia@example.com',
            'phone' => '+2348044444444',
            'password' => Hash::make('password'),
            'pin' => Hash::make('333333'),
            'must_reset_pin' => false,
            'role' => 'user',
            'status' => 'active',
            'country' => 'Ghana',
            'tier_id' => null,
            'wallet_balance' => 0.00,
            'email_verified_at' => now(),
        ]);

        // Setup Referrals
        Referral::create([
            'referrer_id' => $admin->id,
            'referred_id' => $userSilas->id,
            'commission' => 12.50, // 5% of Silas deposits
        ]);

        Referral::create([
            'referrer_id' => $userSilas->id,
            'referred_id' => $userJohn->id,
            'commission' => 25.00, // 5% of John's Silver package ($500)
        ]);

        // Seed announcements
        Announcement::create([
            'title' => 'CryptoCore Platform Launch',
            'content' => 'Welcome to the futuristic high-yield CryptoCore platform! We are officially live with automated deposits, technical grid dashboard telemetry, and 5 distinct investment levels.',
        ]);

        Announcement::create([
            'title' => 'Security Update: Mandatory PIN Setup',
            'content' => 'For security, your 6-digit security PIN is hashed separately. If you forget your PIN, contact the administrator. The admin can trigger a reset which allows you to define a new PIN on your next login.',
        ]);

        // Seed support ticket
        SupportTicket::create([
            'user_id' => $userSilas->id,
            'subject' => 'Daily ROI Payment Interval',
            'message' => 'Hello support, does the daily ROI system run on weekends too?',
            'status' => 'open',
        ]);

        // Seed user transactions
        // Silas
        Transaction::create([
            'user_id' => $userSilas->id,
            'type' => 'Deposit',
            'amount' => 350.00,
            'description' => 'Deposit of 350.00 USDT confirmed.',
        ]);

        Transaction::create([
            'user_id' => $userSilas->id,
            'type' => 'Upgrade',
            'amount' => -100.00,
            'description' => 'Upgraded to Bronze Membership level.',
        ]);

        Transaction::create([
            'user_id' => $userSilas->id,
            'type' => 'Referral',
            'amount' => 25.00,
            'description' => 'Referral commission received from user john (Silver Upgrade).',
        ]);

        // John
        Transaction::create([
            'user_id' => $userJohn->id,
            'type' => 'Deposit',
            'amount' => 1550.00,
            'description' => 'Deposit of 0.05 BTC confirmed.',
        ]);

        Transaction::create([
            'user_id' => $userJohn->id,
            'type' => 'Upgrade',
            'amount' => -500.00,
            'description' => 'Upgraded to Silver Membership level.',
        ]);

        // Seed deposits
        Deposit::create([
            'user_id' => $userSilas->id,
            'amount' => 350.00,
            'currency' => 'USDT',
            'tx_hash' => '0x992389ab4cde901f4c78d65432d90efab8d234a9efcd8923a1a9bcd89f0e1d2c',
            'type' => 'deposit',
            'status' => 'confirmed',
            'confirmed_at' => now()->subDays(2),
        ]);

        Deposit::create([
            'user_id' => $userSilas->id,
            'amount' => 100.00,
            'currency' => 'USDT',
            'tx_hash' => '0x88f2389ab4cde901f4c78d65432d90efab8d234a9efcd8923a1a9bcd89f0e1d2b',
            'type' => 'upgrade',
            'target_tier_id' => $bronze->id,
            'status' => 'confirmed',
            'confirmed_at' => now()->subDays(2),
        ]);

        Deposit::create([
            'user_id' => $userJohn->id,
            'amount' => 1550.00,
            'currency' => 'BTC',
            'tx_hash' => '8c7dbd23f78a7ef90e9d6d54238e9c0b1a0d8c9735d4f3b2cd1a2e3f4a5b6c7d',
            'type' => 'deposit',
            'status' => 'confirmed',
            'confirmed_at' => now()->subDay(),
        ]);

        Deposit::create([
            'user_id' => $userJohn->id,
            'amount' => 500.00,
            'currency' => 'BTC',
            'tx_hash' => '5c7dbd23f78a7ef90e9d6d54238e9c0b1a0d8c9735d4f3b2cd1a2e3f4a5b6c7e',
            'type' => 'upgrade',
            'target_tier_id' => $silver->id,
            'status' => 'confirmed',
            'confirmed_at' => now()->subDay(),
        ]);

        // Pending Upgrade for Cynthia (requesting upgrade to Bronze)
        Deposit::create([
            'user_id' => $userCynthia->id,
            'amount' => 100.00,
            'currency' => 'ETH',
            'tx_hash' => '0x323ab4cd1f5432d90efab8d234a9efcd8923a1a9bcd89f0e1d2c992389abcde9',
            'type' => 'upgrade',
            'target_tier_id' => $bronze->id,
            'status' => 'pending',
        ]);

        // Active Investments
        Investment::create([
            'user_id' => $userSilas->id,
            'tier_id' => $bronze->id,
            'amount' => 100.00,
            'profit' => 2.40, // 2 days of ROI (100 * 1.2% * 2)
            'status' => 'active',
            'started_at' => now()->subDays(2),
            'expires_at' => now()->addDays(28),
            'last_roi_at' => now()->subDay(),
        ]);

        Investment::create([
            'user_id' => $userJohn->id,
            'tier_id' => $silver->id,
            'amount' => 500.00,
            'profit' => 7.50, // 1 day of ROI (500 * 1.5% * 1)
            'status' => 'active',
            'started_at' => now()->subDay(),
            'expires_at' => now()->addDays(44),
            'last_roi_at' => now()->subDay(),
        ]);

        // Seed a pending withdrawal for Silas
        Withdrawal::create([
            'user_id' => $userSilas->id,
            'wallet_address' => '0x71C7656EC7ab88b098defB751B7401B5f6d8976F',
            'amount' => 100.00,
            'fee' => 2.00,
            'status' => 'pending',
        ]);
    }
}
