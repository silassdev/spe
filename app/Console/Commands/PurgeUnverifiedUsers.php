<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Company;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PurgeUnverifiedUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:purge-unverified-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Purge unverified user accounts and their empty companies older than 1 week';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cutoffDate = now()->subWeek();
        
        $unverifiedUsers = User::whereNull('email_verified_at')
            ->where('created_at', '<', $cutoffDate)
            ->get();

        if ($unverifiedUsers->isEmpty()) {
            $this->info('No unverified accounts to purge.');
            return 0;
        }

        $userCount = 0;
        $companyCount = 0;

        foreach ($unverifiedUsers as $user) {
            $companyId = $user->company_id;
            $email = $user->email;
            
            $this->info("Purging user: {$email} (Created at: {$user->created_at})");
            $user->delete();
            $userCount++;

            if ($companyId) {
                // Check if the company has any remaining users
                $otherUsersCount = User::where('company_id', $companyId)->count();
                if ($otherUsersCount === 0) {
                    $company = Company::find($companyId);
                    if ($company) {
                        $this->info("Purging orphaned company: {$company->name}");
                        $company->delete();
                        $companyCount++;
                    }
                }
            }
        }

        $this->info("Purged {$userCount} users and {$companyCount} empty companies.");
        Log::info("Unverified user purge completed. Purged {$userCount} users and {$companyCount} empty companies.");

        return 0;
    }
}
