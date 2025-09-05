<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudentPersonalInformation;
use App\Models\StudentPassword;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;

class StudentAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create student personal information
        $students = [
            [
                'student_id' => 'STU001',
                'last_name' => 'Garcia',
                'first_name' => 'Maria',
                'middle_name' => 'Santos',
                'email_address' => 'maria.garcia@student.university.edu',
                'contact_number' => '+639123456789',
                'date_of_birth' => '2000-05-15',
                'gender' => 'Female',
                'address' => '123 Main Street, Manila, Philippines',
                'dateacc_created' => now()->subDays(30),
            ],
            [
                'student_id' => 'STU002',
                'last_name' => 'Santos',
                'first_name' => 'Juan',
                'middle_name' => 'Cruz',
                'email_address' => 'juan.santos@student.university.edu',
                'contact_number' => '+639234567890',
                'date_of_birth' => '1999-08-22',
                'gender' => 'Male',
                'address' => '456 Oak Avenue, Quezon City, Philippines',
                'dateacc_created' => now()->subDays(25),
            ],
            [
                'student_id' => 'STU003',
                'last_name' => 'Reyes',
                'first_name' => 'Ana',
                'middle_name' => 'Gonzales',
                'email_address' => 'ana.reyes@student.university.edu',
                'contact_number' => '+639345678901',
                'date_of_birth' => '2001-03-10',
                'gender' => 'Female',
                'address' => '789 Pine Road, Makati, Philippines',
                'dateacc_created' => now()->subDays(20),
            ],
        ];

        foreach ($students as $student) {
            StudentPersonalInformation::create($student);
        }

        // Create student passwords
        $studentPasswords = [
            [
                'student_id' => 'STU001',
                'password_hashed' => Hash::make('student123'),
                'date_pass_created' => now()->subDays(30),
            ],
            [
                'student_id' => 'STU002',
                'password_hashed' => Hash::make('student123'),
                'date_pass_created' => now()->subDays(25),
            ],
            [
                'student_id' => 'STU003',
                'password_hashed' => Hash::make('student123'),
                'date_pass_created' => now()->subDays(20),
            ],
        ];

        foreach ($studentPasswords as $password) {
            StudentPassword::create($password);
        }

        // Create student profiles
        $profiles = [
            [
                'profile_id' => 'PROF001',
                'student_id' => 'STU001',
                'picture_path' => 'student_profiles/maria_garcia.jpg',
                'date_upload' => now()->subDays(25),
            ],
            [
                'profile_id' => 'PROF002',
                'student_id' => 'STU002',
                'picture_path' => null,
                'date_upload' => now()->subDays(20),
            ],
            [
                'profile_id' => 'PROF003',
                'student_id' => 'STU003',
                'picture_path' => 'student_profiles/ana_reyes.jpg',
                'date_upload' => now()->subDays(15),
            ],
        ];

        foreach ($profiles as $profile) {
            Profile::create($profile);
        }
    }
}






