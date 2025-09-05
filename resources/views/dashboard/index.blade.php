@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">System Dashboard</h2>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-2">
        <div class="card bg-primary text-white">
            <div class="card-body text-center">
                <i class="bi bi-people display-6"></i>
                <h4 class="mt-2">{{ $stats['total_assessors'] }}</h4>
                <p class="mb-0">Assessors</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card bg-success text-white">
            <div class="card-body text-center">
                <i class="bi bi-person-badge display-6"></i>
                <h4 class="mt-2">{{ $stats['total_profiles'] }}</h4>
                <p class="mb-0">Profiles</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card bg-warning text-dark">
            <div class="card-body text-center">
                <i class="bi bi-key display-6"></i>
                <h4 class="mt-2">{{ $stats['total_password_changes'] }}</h4>
                <p class="mb-0">Password Changes</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card bg-info text-white">
            <div class="card-body text-center">
                <i class="bi bi-activity display-6"></i>
                <h4 class="mt-2">{{ $stats['total_logs'] }}</h4>
                <p class="mb-0">System Logs</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card bg-secondary text-white">
            <div class="card-body text-center">
                <i class="bi bi-box-arrow-in-right display-6"></i>
                <h4 class="mt-2">{{ $stats['total_logins'] }}</h4>
                <p class="mb-0">Logins</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card bg-dark text-white">
            <div class="card-body text-center">
                <i class="bi bi-graph-up display-6"></i>
                <h4 class="mt-2">{{ number_format(($stats['total_profiles'] / max($stats['total_assessors'], 1)) * 100, 1) }}%</h4>
                <p class="mb-0">Profile Rate</p>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-activity"></i> Recent System Logs
                </h5>
            </div>
            <div class="card-body">
                @if($recent_logs->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recent_logs as $log)
                            <div class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">
                                        @switch($log->activity_type)
                                            @case('login')
                                                <span class="badge bg-success">{{ ucfirst($log->activity_type) }}</span>
                                                @break
                                            @case('profile_update')
                                                <span class="badge bg-primary">{{ ucfirst($log->activity_type) }}</span>
                                                @break
                                            @case('user_management')
                                                <span class="badge bg-warning text-dark">{{ ucfirst($log->activity_type) }}</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary">{{ ucfirst($log->activity_type) }}</span>
                                        @endswitch
                                        {{ $log->user_name ?? 'Unknown User' }}
                                    </div>
                                    <small class="text-muted">{{ $log->description }}</small>
                                </div>
                                <small class="text-muted">{{ $log->created_at->diffForHumans() }}</small>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted text-center">No recent system logs</p>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-box-arrow-in-right"></i> Recent Logins
                </h5>
            </div>
            <div class="card-body">
                @if($recent_logins->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recent_logins as $login)
                            <div class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">
                                        @switch($login->user_role)
                                            @case('admin')
                                                <span class="badge bg-danger">{{ ucfirst($login->user_role) }}</span>
                                                @break
                                            @case('assessor')
                                                <span class="badge bg-warning text-dark">{{ ucfirst($login->user_role) }}</span>
                                                @break
                                            @case('student')
                                                <span class="badge bg-info">{{ ucfirst($login->user_role) }}</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary">{{ ucfirst($login->user_role) }}</span>
                                        @endswitch
                                        {{ $login->email_address }}
                                    </div>
                                    <small class="text-muted">{{ $login->login_datetime ? \Carbon\Carbon::parse($login->login_datetime)->format('M j, Y H:i') : 'N/A' }}</small>
                                </div>
                                <small class="text-muted">{{ $login->created_at->diffForHumans() }}</small>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted text-center">No recent logins</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-lightning"></i> Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <a href="{{ route('assessor_accounts.create') }}" class="btn btn-primary w-100 mb-2">
                            <i class="bi bi-plus-circle"></i> New Assessor
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('assessor_profiles.create') }}" class="btn btn-success w-100 mb-2">
                            <i class="bi bi-person-plus"></i> New Profile
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('change_assessor_passwords.create') }}" class="btn btn-warning w-100 mb-2">
                            <i class="bi bi-key"></i> Record Password Change
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('system-logs.index') }}" class="btn btn-info w-100 mb-2">
                            <i class="bi bi-activity"></i> View All Logs
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection






