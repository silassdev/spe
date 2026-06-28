<?php

namespace App\Console\Commands;

use App\Models\Investment;
use App\Models\Transaction;
use Illuminate\Console\Command;

class DistributeDailyRoi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roi:distribute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Distribute daily ROI profit to all active CryptoCore investment plans';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $activeInvestments = Investment::with(['user', 'tier'])
            ->where('status', 'active')
            ->where('expires_at', '>', now())
            ->get();

        $count = 0;
        $totalDistributed = 0;

        foreach ($activeInvestments as $investment) {
            // Skip if ROI was already distributed today
            if ($investment->last_roi_at && $investment->last_roi_at->isToday()) {
                continue;
            }

            // Calculate daily ROI payout
            $dailyPayout = ($investment->amount * ($investment->tier->daily_roi / 100));
            $dailyPayout = round($dailyPayout, 2);

            // Add to user wallet balance
            $investment->user->increment('wallet_balance', $dailyPayout);

            // Accumulate investment profit counter
            $investment->increment('profit', $dailyPayout);

            // Update last ROI distribution timestamp
            $investment->update(['last_roi_at' => now()]);

            // Log the profit transaction in the ledger
            Transaction::create([
                'user_id' => $investment->user_id,
                'type' => 'Profit',
                'amount' => $dailyPayout,
                'description' => 'Daily ROI profit from ' . $investment->tier->name . ' Plan (' . $investment->tier->daily_roi . '% × $' . $investment->amount . ').',
            ]);

            $count++;
            $totalDistributed += $dailyPayout;

            $this->line('  ✓ Distributed $' . $dailyPayout . ' to user: ' . $investment->user->username . ' (' . $investment->tier->name . ' Plan)');
        }

        // Mark expired investments as completed
        $expired = Investment::where('status', 'active')
            ->where('expires_at', '<=', now())
            ->get();

        foreach ($expired as $inv) {
            $inv->update(['status' => 'completed']);
            Transaction::create([
                'user_id' => $inv->user_id,
                'type' => 'Bonus',
                'amount' => 0,
                'description' => $inv->tier->name . ' Investment Plan has completed its ' . $inv->tier->duration . '-day cycle.',
            ]);
            $this->line('  ✓ Expired investment marked complete: ' . $inv->user->username . ' (' . $inv->tier->name . ')');
        }

        $this->info('');
        $this->info('✅ ROI Distribution Complete.');
        $this->info("   Processed: {$count} investments");
        $this->info("   Total Distributed: $" . number_format($totalDistributed, 2));
    }
}
