<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

/**
 * Local/server CLI only: never exposes an account creation route on the public site.
 */
class ManageStaffAccount extends Command
{
    protected $signature = 'greenmiles:user
        {--role=owner : Account role: owner or editor}
        {--email= : Account email (if omitted, prompted interactively)}';

    protected $description = 'Securely create or reset a Green Miles Owner or Editor login';

    public function handle(): int
    {
        $role = strtolower(trim((string) $this->option('role')));

        if (! in_array($role, ['owner', 'editor'], true)) {
            $this->error('Role must be owner or editor.');
            return self::FAILURE;
        }

        if (! Schema::hasTable('users')) {
            $this->error('The users table does not exist. First run: php artisan migrate');
            return self::FAILURE;
        }

        $email = strtolower(trim((string) ($this->option('email') ?: $this->ask('Login email address'))));

        if (! filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 255) {
            $this->error('Enter a valid email address (maximum 255 characters).');
            return self::FAILURE;
        }

        $user = User::query()->where('email', $email)->first();
        $defaultName = $user?->name ?? ($role === 'owner' ? 'Green Miles Owner' : 'Green Miles Editor');
        $name = trim((string) $this->ask('Display name', $defaultName));

        if ($name === '' || mb_strlen($name) > 255) {
            $this->error('A display name (maximum 255 characters) is required.');
            return self::FAILURE;
        }

        $password = (string) $this->secret('New password (12 or more characters; hidden while typing)');
        $confirmPassword = (string) $this->secret('Confirm new password');

        if (strlen($password) < 12) {
            $this->error('Password must be at least 12 characters. No changes saved.');
            return self::FAILURE;
        }

        if (! hash_equals($password, $confirmPassword)) {
            $this->error('Passwords do not match. No changes saved.');
            return self::FAILURE;
        }

        if ($user && ! $this->confirm('Update the existing account, reset its password, and set its role to '.strtoupper($role).'?', false)) {
            $this->warn('Cancelled. No changes saved.');
            return self::SUCCESS;
        }

        $user ??= new User();
        $user->fill([
            'name' => $name,
            'email' => $email,
            'role' => $role,
            'is_active' => true,
        ]);
        $user->password = Hash::make($password);
        $user->save();

        // No password is printed or passed as a command argument.
        $this->info('Account saved successfully.');
        $this->line('Role: '.ucfirst($role));
        $this->line('Email: '.$email);
        $this->line('Log in at: '.rtrim((string) config('app.url'), '/').'/manage');
        $this->comment('An authenticator app may be required to complete two-factor setup on first login.');

        return self::SUCCESS;
    }
}
