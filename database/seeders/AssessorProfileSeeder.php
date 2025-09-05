<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AssessorProfile;

class AssessorProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profiles = [
            [
                'assessor_id' => 'PROF001',
                'email_address' => 'john.doe@university.edu',
                'picture_path' => 'profiles/john_doe.jpg',
                'date_upload' => now()->subDays(25),
            ],
            [
                'assessor_id' => 'PROF002',
                'email_address' => 'jane.smith@university.edu',
                'picture_path' => 'profiles/jane_smith.jpg',
                'date_upload' => now()->subDays(20),
            ],
            [
                'assessor_id' => 'PROF003',
                'email_address' => 'robert.wilson@university.edu',
                'picture_path' => 'profiles/robert_wilson.jpg',
                'date_upload' => now()->subDays(15),
            ],
            [
                'assessor_id' => 'PROF004',
                'email_address' => 'sarah.johnson@university.edu',
                'picture_path' => null,
                'date_upload' => now()->subDays(10),
            ],
            [
                'assessor_id' => 'PROF005',
                'email_address' => 'michael.brown@university.edu',
                'picture_path' => 'profiles/michael_brown.jpg',
                'date_upload' => now()->subDays(5),
            ],
        ];

        foreach ($profiles as $profile) {
            AssessorProfile::create($profile);
        }
    }
}






