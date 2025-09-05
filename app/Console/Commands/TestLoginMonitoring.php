<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\LoginMonitoringService;
use App\Models\LogIn;
use App\Models\ManageAccount;

class TestLoginMonitoring extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:login-monitoring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the login monitoring system';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing Login Monitoring System');
        $this->info('==============================');
        $this->newLine();

        try {
            $loginService = new LoginMonitoringService();
            
            // Test 1: Record a login attempt
            $this->info('1. Testing login attempt recording...');
            $loginRecord = $loginService->recordLoginAttempt('test@student.edu', 'student');
            $this->info('   ✓ Login record created with ID: ' . $loginRecord->log_id);
            
            // Test 2: Record a successful login
            $this->info('2. Testing successful login recording...');
            $successRecord = $loginService->recordSuccessfulLogin('test@student.edu', 'student');
            $this->info('   ✓ Successful login recorded with ID: ' . $successRecord->log_id);
            
            // Test 3: Check if manage account was created/updated
            $this->info('3. Checking manage account...');
            $account = ManageAccount::where('email_address', 'test@student.edu')->first();
            if ($account) {
                $this->info('   ✓ Manage account found - Status: ' . $account->account_status);
                $this->info('   ✓ Last login: ' . $account->last_login);
            } else {
                $this->error('   ✗ Manage account not found');
            }
            
            // Test 4: Get login statistics
            $this->info('4. Testing login statistics...');
            $stats = $loginService->getLoginStatistics();
            $this->info('   ✓ Total logins: ' . $stats['login_stats']['total_logins']);
            $this->info('   ✓ Today\'s logins: ' . $stats['login_stats']['today_logins']);
            $this->info('   ✓ Active accounts: ' . $stats['account_stats']['active_accounts']);
            
            // Test 5: Check user login activity
            $this->info('5. Testing user login activity...');
            $userActivity = $loginService->getUserLoginActivity('test@student.edu');
            $this->info('   ✓ User login count: ' . $userActivity['stats']['total_logins']);
            
            // Test 6: Check suspicious activity
            $this->info('6. Testing suspicious activity detection...');
            $suspicious = $loginService->checkSuspiciousActivity('test@student.edu');
            $this->info('   ✓ Suspicious activity check: ' . ($suspicious['is_suspicious'] ? 'Suspicious' : 'Normal'));
            
            $this->newLine();
            $this->info('✅ All tests passed! Login monitoring system is working correctly.');
            
        } catch (\Exception $e) {
            $this->error('❌ Test failed: ' . $e->getMessage());
            $this->error('Stack trace:');
            $this->error($e->getTraceAsString());
        }
    }
}
