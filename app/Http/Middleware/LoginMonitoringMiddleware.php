<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\LogIn;
use App\Models\ManageAccount;
use App\Models\SystemMonitoringAndLog;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginMonitoringMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only monitor login attempts and successful logins
        if ($this->shouldMonitor($request)) {
            $this->logLoginActivity($request);
        }

        return $response;
    }

    /**
     * Determine if we should monitor this request
     */
    private function shouldMonitor(Request $request): bool
    {
        $path = $request->path();
        $method = $request->method();
        
        // Monitor login attempts and authentication-related routes
        return in_array($path, [
            'login',
            'auth/login',
            'authenticate',
            'log-in',
            'otp'
        ]) || str_contains($path, 'login') || str_contains($path, 'auth');
    }

    /**
     * Log login activity
     */
    private function logLoginActivity(Request $request): void
    {
        try {
            $email = $request->input('email_address') ?? $request->input('email') ?? 'unknown';
            $userRole = $this->determineUserRole($email);
            $loginStatus = $this->determineLoginStatus($request);
            
            // Create login record
            $loginRecord = LogIn::create([
                'email_address' => $email,
                'user_role' => $userRole,
                'login_datetime' => now(),
            ]);

            // Update manage accounts if user exists
            $this->updateManageAccount($email, $userRole, $loginStatus);

            // Log to system monitoring
            $this->logToSystemMonitoring($email, $userRole, $loginStatus, $request);

        } catch (\Exception $e) {
            // Log error but don't break the application
            \Log::error('Login monitoring error: ' . $e->getMessage());
        }
    }

    /**
     * Determine user role based on email or other factors
     */
    private function determineUserRole(string $email): ?string
    {
        // Check if it's an admin email
        if (str_contains($email, 'admin') || str_contains($email, 'university.edu')) {
            return 'admin';
        }
        
        // Check if it's an assessor email
        if (str_contains($email, 'assessor') || str_contains($email, 'professor')) {
            return 'assessor';
        }
        
        // Default to student
        return 'student';
    }

    /**
     * Determine if login was successful or failed
     */
    private function determineLoginStatus(Request $request): string
    {
        // This is a simplified check - in a real application, you'd check
        // authentication status more thoroughly
        if ($request->session()->has('login_success')) {
            return 'success';
        }
        
        if ($request->session()->has('login_failed')) {
            return 'failed';
        }
        
        return 'attempt';
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
    private function logToSystemMonitoring(string $email, ?string $userRole, string $status, Request $request): void
    {
        SystemMonitoringAndLog::create([
            'log_id' => null, // Will be auto-generated
            'user_type' => $userRole ?? 'unknown',
            'action_performed' => $status === 'success' ? 'successful_login' : 'login_attempt',
            'details' => json_encode([
                'email' => $email,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'timestamp' => now()->toISOString(),
                'status' => $status
            ]),
            'timestamp' => now(),
        ]);
    }
}
