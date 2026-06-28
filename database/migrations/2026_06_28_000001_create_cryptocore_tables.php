<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Tiers (Membership Levels)
        Schema::create('tiers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Bronze, Silver, Gold, Platinum, Diamond
            $table->decimal('price', 16, 2); // Plan Cost in USD
            $table->decimal('daily_roi', 5, 2); // Daily ROI percentage e.g. 1.25%
            $table->integer('duration'); // Duration in days
            $table->timestamps();
        });

        // Add foreign key constraint to users table tier_id (optional, let's also add it just in case)
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('tier_id')->references('id')->on('tiers')->onDelete('set null');
        });

        // 2. Deposits (Balance Deposits or Upgrades)
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 16, 2);
            $table->string('currency'); // BTC, ETH, USDT, BNB
            $table->string('tx_hash')->nullable();
            $table->string('proof_img')->nullable(); // Uploaded invoice receipt image
            $table->string('type')->default('deposit'); // deposit, upgrade
            $table->unsignedBigInteger('target_tier_id')->nullable(); // If upgrading
            $table->string('status')->default('pending'); // pending, confirmed, rejected
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamps();

            $table->foreign('target_tier_id')->references('id')->on('tiers')->onDelete('set null');
        });

        // 3. Withdrawals
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('wallet_address');
            $table->decimal('amount', 16, 2);
            $table->decimal('fee', 16, 2)->default(0.00);
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->timestamps();
        });

        // 4. Admin Receiving Wallet Addresses
        Schema::create('wallet_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('coin_name'); // Bitcoin, Ethereum, USDT ERC20, BNB Smart Chain
            $table->string('coin_symbol'); // BTC, ETH, USDT, BNB
            $table->string('address');
            $table->string('status')->default('active'); // active, inactive
            $table->timestamps();
        });

        // 5. Investments (Active ROI Plans)
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('tier_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 16, 2);
            $table->decimal('profit', 16, 2)->default(0.00);
            $table->string('status')->default('active'); // active, completed
            $table->timestamp('started_at');
            $table->timestamp('expires_at');
            $table->timestamp('last_roi_at')->nullable();
            $table->timestamps();
        });

        // 6. Referrals
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('referrer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('referred_id')->constrained('users')->onDelete('cascade');
            $table->decimal('commission', 16, 2)->default(0.00);
            $table->timestamps();
        });

        // 7. Transactions Ledger
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type'); // Deposit, Withdrawal, Upgrade, Referral, Profit, Bonus
            $table->decimal('amount', 16, 2);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // 8. Announcements
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->timestamps();
        });

        // 9. Support Tickets
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('subject');
            $table->text('message');
            $table->string('status')->default('open'); // open, replied, closed
            $table->timestamps();
        });

        // 10. System Settings
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_settings');
        Schema::dropIfExists('support_tickets');
        Schema::dropIfExists('announcements');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('referrals');
        Schema::dropIfExists('investments');
        Schema::dropIfExists('wallet_addresses');
        Schema::dropIfExists('withdrawals');
        Schema::dropIfExists('deposits');
        
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropForeign(['tier_id']);
            });
        }
        
        Schema::dropIfExists('tiers');
    }
};
