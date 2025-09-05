<?php

namespace App\Services;

use App\Models\LogIn;
use App\Models\ManageAccount;
use App\Models\SystemMonitoringAndLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginMonitoringService
{
    /**
     * Record a login attempt
     */
    public function recordLoginAttempt(string $email, ?string $userRole = null, Request $request = null): LogIn
    {
        $userRole = $userRole ?? $this->determineUserRole($email);
        
        $loginRecord = LogIn::create([
            'email_address' => $email,
            'user_role' => $userRole,
            'login_datetime' => now(),
        ]);

        // Update manage account
        $this->updateManageAccount($email, $userRole, 'attempt');

        // Log to system monitoring
        $this->logToSystemMonitoring($loginRecord, 'login_attempt', $request);

        return $loginRecord;
    }

    /**
     * Record a successful login
     */
    public function recordSuccessfulLogin(string $email, ?string $userRole = null, Request $request = null): LogIn
    {
        $userRole = $userRole ?? $this->determineUserRole($email);
        
        $loginRecord = LogIn::create([
            'email_address' => $email,
            'user_role' => $userRole,
            'login_datetime' => now(),
        ]);

        // Update manage account
        $this->updateManageAccount($email, $userRole, 'success');

        // Log to system monitoring
        $this->logToSystemMonitoring($loginRecord, 'successful_login', $request);

        return $loginRecord;
    }

    /**
     * Record a failed login attempt
     */
    public function recordFailedLogin(string $email, ?string $userRole = null, Request $request = null): LogIn
    {
        $userRole = $userRole ?? $this->determineUserRole($email);
        
        $loginRecord = LogIn::create([
            'email_address' => $email,
            'user_role' => $userRole,
            'login_datetime' => now(),
        ]);

        // Update manage account
        $this->updateManageAccount($email, $userRole, 'failed');

        // Log to system monitoring
        $this->logToSystemMonitoring($loginRecord, 'failed_login', $request);

        return $loginRecord;
    }

    /**
     * Get comprehensive login statistics
     */
    public function getLoginStatistics(): array
    {
        $totalLogins = LogIn::count();
        $todayLogins = LogIn::whereDate('login_datetime', today())->count();
        $thisWeekLogins = LogIn::whereBetween('login_datetime', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $thisMonthLogins = LogIn::whereMonth('login_datetime', now()->month)->count();

        $loginsByRole = LogIn::selectRaw('user_role, COUNT(*) as count')
            ->groupBy('user_role')
            ->pluck('count', 'user_role')
            ->toArray();

        $recentLogins = LogIn::with('manageAccount')
            ->latest('login_datetime')
            ->limit(10)
            ->get();

        $accountStats = [
            'total_accounts' => ManageAccount::count(),
            'active_accounts' => ManageAccount::active()->count(),
            'inactive_accounts' => ManageAccount::where('account_status', 'inactive')->count(),
            'suspended_accounts' => ManageAccount::where('account_status', 'suspended')->count(),
        ];

        return [
            'login_stats' => [
                'total_logins' => $totalLogins,
                'today_logins' => $todayLogins,
                'this_week_logins' => $thisWeekLogins,
                'this_month_logins' => $thisMonthLogins,
                'by_role' => $loginsByRole,
            ],
            'account_stats' => $accountStats,
            'recent_logins' => $recentLogins,
        ];
    }

    /**
     * Get login activity for a specific user
     */
    public function getUserLoginActivity(string $email, int $limit = 50): array
    {
        $logins = LogIn::where('email_address', $email)
            ->latest('login_datetime')
            ->limit($limit)
            ->get();

        $account = ManageAccount::where('email_address', $email)->first();
        
        $stats = [
            'total_logins' => $logins->count(),
            'recent_logins' => $logins->where('login_datetime', '>=', now()->subDays(30))->count(),
            'last_login' => $logins->first()?->login_datetime,
            'account_status' => $account?->account_status,
        ];

        return [
            'logins' => $logins,
            'stats' => $stats,
            'account' => $account,
        ];
    }

    /**
     * Check for suspicious login activity
     */
    public function checkSuspiciousActivity(string $email): array
    {
        $recentLogins = LogIn::where('email_address', $email)
            ->where('login_datetime', '>=', now()->subHours(24))
            ->count();

        $failedLogins = LogIn::where('email_address', $email)
            ->where('login_datetime', '>=', now()->subHours(1))
            ->count();

        $suspicious = [];
        
        if ($recentLogins > 10) {
            $suspicious[] = 'High number of login attempts in the last 24 hours';
        }
        
        if ($failedLogins > 5) {
            $suspicious[] = 'Multiple failed login attempts in the last hour';
        }

        return [
            'is_suspicious' => !empty($suspicious),
            'reasons' => $suspicious,
            'recent_attempts' => $recentLogins,
            'failed_attempts' => $failedLogins,
        ];
    }

    /**
     * Determine user role based on email
     */
    private function determineUserRole(string $email): ?string
    {
        if (str_contains($email, 'admin') || str_contains($email, 'university.edu')) {
            return 'admin';
        }
        
        if (str_contains($email, 'assessor') || str_contains($email, 'professor')) {
            return 'assessor';
        }
        
        return 'student';
    }

    /**
     * Update manage account with login information
     */
    private function updateManageAccount(string $email, ?string $userRole, string $status): void
    {
        if ($userRole === 'admin') {
            return; // Don't track admin logins in manage_accounts
        }

        $account = ManageAccount::where('email_address', $email)->first();
        
        if ($account) {
            $account->update([
                'last_login' => now(),
                'action' => $status === 'success' ? 'login_success' : 'login_attempt',
            ]);
        } else if ($userRole && in_array($userRole, ['student', 'assessor'])) {
            // Create new account record if it doesn't exist
            ManageAccount::create([
                'email_address' => $email,
                'admin_id' => 'SUPER001', // Default admin
                'user_type' => $userRole,
                'account_status' => 'active',
                'last_login' => now(),
                'action' => $status === 'success' ? 'login_success' : 'login_attempt',
            ]);
        }
    }

    /**
     * Log to system monitoring
     */
    private function logToSystemMonitoring(LogIn $loginRecord, string $action, ?Request $request = null): void
    {
        try {
            // Create the system monitoring log
            SystemMonitoringAndLog::create([
                'log_id' => $loginRecord->log_id,
                'user_role' => $loginRecord->user_role ?? 'unknown',
                'user_name' => $loginRecord->email_address,
                'activity_type' => $action,
                'description' => json_encode([
                    'email' => $loginRecord->email_address,
                    'ip_address' => $request?->ip() ?? 'unknown',
                    'user_agent' => $request?->userAgent() ?? 'unknown',
                    'timestamp' => now()->toISOString(),
                ]),
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to log to system monitoring: ' . $e->getMessage());
        }
    }
}
