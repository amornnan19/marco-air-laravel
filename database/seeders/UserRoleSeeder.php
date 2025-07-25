<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::firstOrCreate(
            ['email' => 'admin@marcoair.com'],
            [
                'name' => 'Marco Air Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_admin' => true,
                'first_name' => 'Admin',
                'last_name' => 'Marco Air',
                'phone' => '0800000001',
                'terms_accepted' => true,
                'terms_accepted_at' => now(),
                'marketing_consent' => true,
                'data_sharing_consent' => true,
                'line_id' => 'admin_line_id',
                'email_verified_at' => now(),
            ]
        );

        // Create Dealer User
        User::firstOrCreate(
            ['email' => 'dealer@marcoair.com'],
            [
                'name' => 'Marco Air Dealer',
                'password' => Hash::make('password'),
                'role' => 'dealer',
                'is_admin' => false,
                'first_name' => 'Dealer',
                'last_name' => 'Marco Air',
                'phone' => '0800000002',
                'terms_accepted' => true,
                'terms_accepted_at' => now(),
                'marketing_consent' => true,
                'data_sharing_consent' => true,
                'line_id' => 'dealer_line_id',
                'email_verified_at' => now(),
            ]
        );

        // Create Customer User
        User::firstOrCreate(
            ['email' => 'customer@marcoair.com'],
            [
                'name' => 'Marco Air Customer',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'is_admin' => false,
                'first_name' => 'Customer',
                'last_name' => 'Marco Air',
                'phone' => '0800000003',
                'terms_accepted' => true,
                'terms_accepted_at' => now(),
                'marketing_consent' => true,
                'data_sharing_consent' => true,
                'line_id' => 'customer_line_id',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Created test users with different roles');
    }
}
