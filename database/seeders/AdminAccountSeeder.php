<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminProfile;
use App\Models\AdminPassword;
use Illuminate\Support\Facades\Hash;

class AdminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin profiles
        $adminProfiles = [
            [
                'admin_id' => 'SUPER001',
                'email_address' => 'admin@university.edu',
                'name' => 'System Administrator',
                'contact_number' => '09123456789',
                'position' => 'System Administrator',
            ],
            [
                'admin_id' => 'ADMIN002',
                'email_address' => 'dean@university.edu',
                'name' => 'Faculty Dean',
                'contact_number' => '09123456788',
                'position' => 'Dean of Faculty',
            ],
        ];

        foreach ($adminProfiles as $profile) {
            AdminProfile::create($profile);
        }

        // Create admin passwords
        $adminPasswords = [
            [
                'admin_id' => 'SUPER001',
                'password_hashed' => Hash::make('admin123'),
                'date_pass_created' => now()->subDays(60),
            ],
            [
                'admin_id' => 'ADMIN002',
                'password_hashed' => Hash::make('dean123'),
                'date_pass_created' => now()->subDays(45),
            ],
        ];

        foreach ($adminPasswords as $password) {
            AdminPassword::create($password);
        }
    }
}






