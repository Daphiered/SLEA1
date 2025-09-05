<?php

namespace App\Http\Controllers;

use App\Models\SystemMonitoringAndLog;
use Illuminate\Http\Request;

class SystemMonitoringAndLogController extends Controller
{
    public function index()
    {
        $logs = SystemMonitoringAndLog::with('login')->latest()->paginate(20);
        return view('system-logs.index', compact('logs'));
    }
}
