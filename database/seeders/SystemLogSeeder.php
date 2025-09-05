<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LogIn;
use App\Models\SystemMonitoringAndLog;

class SystemLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create login records
        $logins = [
            [
                'email_address' => 'john.doe@university.edu',
                'user_role' => 'assessor',
                'login_datetime' => now()->subDays(5),
            ],
            [
                'email_address' => 'jane.smith@university.edu',
                'user_role' => 'assessor',
                'login_datetime' => now()->subDays(4),
            ],
            [
                'email_address' => 'admin@university.edu',
                'user_role' => 'admin',
                'login_datetime' => now()->subDays(3),
            ],
            [
                'email_address' => 'maria.garcia@student.university.edu',
                'user_role' => 'student',
                'login_datetime' => now()->subDays(2),
            ],
            [
                'email_address' => 'dean@university.edu',
                'user_role' => 'admin',
                'login_datetime' => now()->subDays(1),
            ],
        ];

        foreach ($logins as $login) {
            LogIn::create($login);
        }

        // Create system monitoring logs
        $logs = [
            [
                'log_id' => 1,
                'user_role' => 'assessor',
                'user_name' => 'John Doe',
                'activity_type' => 'login',
                'description' => 'User logged in successfully',
            ],
            [
                'log_id' => 1,
                'user_role' => 'assessor',
                'user_name' => 'John Doe',
                'activity_type' => 'profile_update',
                'description' => 'Updated assessor profile information',
            ],
            [
                'log_id' => 2,
                'user_role' => 'assessor',
                'user_name' => 'Jane Smith',
                'activity_type' => 'login',
                'description' => 'User logged in successfully',
            ],
            [
                'log_id' => 3,
                'user_role' => 'admin',
                'user_name' => 'System Administrator',
                'activity_type' => 'login',
                'description' => 'Admin user logged in',
            ],
            [
                'log_id' => 3,
                'user_role' => 'admin',
                'user_name' => 'System Administrator',
                'activity_type' => 'user_management',
                'description' => 'Created new assessor account',
            ],
            [
                'log_id' => 4,
                'user_role' => 'student',
                'user_name' => 'Maria Garcia',
                'activity_type' => 'login',
                'description' => 'Student logged in successfully',
            ],
            [
                'log_id' => 5,
                'user_role' => 'admin',
                'user_name' => 'Faculty Dean',
                'activity_type' => 'login',
                'description' => 'Dean user logged in',
            ],
            [
                'log_id' => 5,
                'user_role' => 'admin',
                'user_name' => 'Faculty Dean',
                'activity_type' => 'system_review',
                'description' => 'Reviewed system reports and analytics',
            ],
        ];

        foreach ($logs as $log) {
            SystemMonitoringAndLog::create($log);
        }
    }
}






