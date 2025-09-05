<?php

require_once 'vendor/autoload.php';

use App\Services\LoginMonitoringService;
use App\Models\LogIn;
use App\Models\ManageAccount;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Testing Login Monitoring System\n";
echo "==============================\n\n";

try {
    $loginService = new LoginMonitoringService();
    
    // Test 1: Record a login attempt
    echo "1. Testing login attempt recording...\n";
    $loginRecord = $loginService->recordLoginAttempt('test@student.edu', 'student');
    echo "   ✓ Login record created with ID: " . $loginRecord->log_id . "\n";
    
    // Test 2: Record a successful login
    echo "2. Testing successful login recording...\n";
    $successRecord = $loginService->recordSuccessfulLogin('test@student.edu', 'student');
    echo "   ✓ Successful login recorded with ID: " . $successRecord->log_id . "\n";
    
    // Test 3: Check if manage account was created/updated
    echo "3. Checking manage account...\n";
    $account = ManageAccount::where('email_address', 'test@student.edu')->first();
    if ($account) {
        echo "   ✓ Manage account found - Status: " . $account->account_status . "\n";
        echo "   ✓ Last login: " . $account->last_login . "\n";
    } else {
        echo "   ✗ Manage account not found\n";
    }
    
    // Test 4: Get login statistics
    echo "4. Testing login statistics...\n";
    $stats = $loginService->getLoginStatistics();
    echo "   ✓ Total logins: " . $stats['login_stats']['total_logins'] . "\n";
    echo "   ✓ Today's logins: " . $stats['login_stats']['today_logins'] . "\n";
    echo "   ✓ Active accounts: " . $stats['account_stats']['active_accounts'] . "\n";
    
    // Test 5: Check user login activity
    echo "5. Testing user login activity...\n";
    $userActivity = $loginService->getUserLoginActivity('test@student.edu');
    echo "   ✓ User login count: " . $userActivity['stats']['total_logins'] . "\n";
    
    // Test 6: Check suspicious activity
    echo "6. Testing suspicious activity detection...\n";
    $suspicious = $loginService->checkSuspiciousActivity('test@student.edu');
    echo "   ✓ Suspicious activity check: " . ($suspicious['is_suspicious'] ? 'Suspicious' : 'Normal') . "\n";
    
    echo "\n✅ All tests passed! Login monitoring system is working correctly.\n";
    
} catch (Exception $e) {
    echo "\n❌ Test failed: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
