<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogIn extends Model
{
    protected $table = 'log_in';
    protected $primaryKey = 'log_id';

    protected $fillable = [
        'email_address',
        'user_role',
        'login_datetime',
    ];

    protected $casts = [
        'login_datetime' => 'datetime',
    ];

    public function otps(): HasMany
    {
        return $this->hasMany(Otp::class, 'log_id', 'log_id');
    }

    public function manageAccount(): BelongsTo
    {
        return $this->belongsTo(ManageAccount::class, 'email_address', 'email_address');
    }

    /**
     * Scope for recent logins
     */
    public function scopeRecent($query, $days = 7)
    {
        return $query->where('login_datetime', '>=', now()->subDays($days));
    }

    /**
     * Scope for logins by user role
     */
    public function scopeByRole($query, $role)
    {
        return $query->where('user_role', $role);
    }

    /**
     * Scope for logins by email
     */
    public function scopeByEmail($query, $email)
    {
        return $query->where('email_address', $email);
    }

    /**
     * Get login statistics
     */
    public static function getLoginStats()
    {
        return [
            'total_logins' => self::count(),
            'today_logins' => self::whereDate('login_datetime', today())->count(),
            'this_week_logins' => self::whereBetween('login_datetime', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'by_role' => self::selectRaw('user_role, COUNT(*) as count')
                ->groupBy('user_role')
                ->pluck('count', 'user_role')
                ->toArray(),
        ];
    }
}
