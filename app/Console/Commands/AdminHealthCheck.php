<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class AdminHealthCheck extends Command
{
    protected $signature = 'greenmiles:admin-check';
    protected $description = 'Check Green Miles admin prerequisites without revealing login credentials';

    public function handle(): int
    {
        if (! Schema::hasTable('users')) {
            $this->error('Missing users table. Run: php artisan migrate');
            return self::FAILURE;
        }

        $owners = User::where('role', 'owner')->where('is_active', true)->count();
        $editors = User::where('role', 'editor')->where('is_active', true)->count();
        $this->line("Active owner accounts: {$owners}");
        $this->line("Active editor accounts: {$editors}");

        if ($owners === 0) {
            $this->warn('No active Owner account. Run: php artisan greenmiles:user');
            return self::FAILURE;
        }

        $this->info('Owner account is present. Sign in at /manage with its configured email and password.');
        $this->comment('If credentials are unknown, use php artisan greenmiles:user to set a new password.');
        return self::SUCCESS;
    }
}
