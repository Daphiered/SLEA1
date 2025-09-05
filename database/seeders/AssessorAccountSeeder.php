<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AssessorAccount;
use Illuminate\Support\Facades\Hash;

class AssessorAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $assessors = [
            [
                'email_address' => 'john.doe@university.edu',
                'admin_id' => 'ADM001',
                'last_name' => 'Doe',
                'first_name' => 'John',
                'middle_name' => 'Michael',
                'position' => 'Senior Lecturer',
                'default_password' => Hash::make('password123'),
                'dateacc_created' => now()->subDays(30),
            ],
            [
                'email_address' => 'jane.smith@university.edu',
                'admin_id' => 'ADM002',
                'last_name' => 'Smith',
                'first_name' => 'Jane',
                'middle_name' => 'Elizabeth',
                'position' => 'Associate Professor',
                'default_password' => Hash::make('password123'),
                'dateacc_created' => now()->subDays(25),
            ],
            [
                'email_address' => 'robert.wilson@university.edu',
                'admin_id' => 'ADM003',
                'last_name' => 'Wilson',
                'first_name' => 'Robert',
                'middle_name' => 'James',
                'position' => 'Lecturer',
                'default_password' => Hash::make('password123'),
                'dateacc_created' => now()->subDays(20),
            ],
            [
                'email_address' => 'sarah.johnson@university.edu',
                'admin_id' => 'ADM004',
                'last_name' => 'Johnson',
                'first_name' => 'Sarah',
                'middle_name' => 'Marie',
                'position' => 'Assistant Professor',
                'default_password' => Hash::make('password123'),
                'dateacc_created' => now()->subDays(15),
            ],
            [
                'email_address' => 'michael.brown@university.edu',
                'admin_id' => 'ADM005',
                'last_name' => 'Brown',
                'first_name' => 'Michael',
                'middle_name' => 'David',
                'position' => 'Senior Lecturer',
                'default_password' => Hash::make('password123'),
                'dateacc_created' => now()->subDays(10),
            ],
        ];

        foreach ($assessors as $assessor) {
            AssessorAccount::create($assessor);
        }
    }
}






