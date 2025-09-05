<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChangeAssessorPassword;
use Illuminate\Support\Facades\Hash;

class ChangeAssessorPasswordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $passwordChanges = [
            [
                'email_address' => 'john.doe@university.edu',
                'old_password_hashed' => Hash::make('oldpassword123'),
                'new_password_hashed' => Hash::make('newpassword456'),
                'date_pass_changed' => now()->subDays(20),
            ],
            [
                'email_address' => 'jane.smith@university.edu',
                'old_password_hashed' => Hash::make('initialpass789'),
                'new_password_hashed' => Hash::make('securepass321'),
                'date_pass_changed' => now()->subDays(15),
            ],
            [
                'email_address' => 'robert.wilson@university.edu',
                'old_password_hashed' => Hash::make('tempassword'),
                'new_password_hashed' => Hash::make('permanentpass'),
                'date_pass_changed' => now()->subDays(10),
            ],
            [
                'email_address' => 'sarah.johnson@university.edu',
                'old_password_hashed' => Hash::make('defaultpass'),
                'new_password_hashed' => Hash::make('personalpass'),
                'date_pass_changed' => now()->subDays(5),
            ],
        ];

        foreach ($passwordChanges as $change) {
            ChangeAssessorPassword::create($change);
        }
    }
}






