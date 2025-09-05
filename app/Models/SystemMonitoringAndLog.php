<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemMonitoringAndLog extends Model
{
    protected $table = 'system_monitoring_and_logs';
    protected $primaryKey = 'logs_id';
 public $timestamps = true;
    protected $fillable = [
        'log_id', 'user_role', 'user_name',
        'activity_type', 'description',
    ];

    public function login()
    {
        return $this->belongsTo(\App\Models\LogIn::class, 'log_id', 'log_id');
    }
}
