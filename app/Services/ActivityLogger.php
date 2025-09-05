<?php

namespace App\Services;

use App\Models\SystemMonitoringAndLog;
use Illuminate\Http\Request;

class ActivityLogger
{
    public function log(
        string $activityType,
        ?string $description = null,
        ?int $logId = null,
        ?string $userRole = null,
        ?string $userName = null,
        ?Request $request = null
    ): SystemMonitoringAndLog {
        return SystemMonitoringAndLog::create([
            'log_id'       => $logId,
            'user_role'    => $userRole,
            'user_name'    => $userName,
            'activity_type'=> $activityType,
            'description'  => $description,
        ]);
    }
}
