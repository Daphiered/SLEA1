@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">System Monitoring & Logs</h4>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-secondary btn-sm" onclick="window.print()">
                        <i class="bi bi-printer"></i> Print
                    </button>
                    <button class="btn btn-outline-info btn-sm" onclick="exportLogs()">
                        <i class="bi bi-download"></i> Export
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($logs->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Log ID</th>
                                    <th>User Role</th>
                                    <th>User Name</th>
                                    <th>Activity Type</th>
                                    <th>Description</th>
                                    <th>Login Info</th>
                                    <th>Timestamp</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logs as $log)
                                <tr>
                                    <td><strong>{{ $log->logs_id }}</strong></td>
                                    <td>
                                        @switch($log->user_role)
                                            @case('admin')
                                                <span class="badge bg-danger">{{ ucfirst($log->user_role) }}</span>
                                                @break
                                            @case('assessor')
                                                <span class="badge bg-warning text-dark">{{ ucfirst($log->user_role) }}</span>
                                                @break
                                            @case('student')
                                                <span class="badge bg-info">{{ ucfirst($log->user_role) }}</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary">{{ ucfirst($log->user_role) }}</span>
                                        @endswitch
                                    </td>
                                    <td>{{ $log->user_name ?? 'N/A' }}</td>
                                    <td>
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
                                            @case('system_review')
                                                <span class="badge bg-info">{{ ucfirst($log->activity_type) }}</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary">{{ ucfirst($log->activity_type) }}</span>
                                        @endswitch
                                    </td>
                                    <td>{{ $log->description ?? 'No description' }}</td>
                                    <td>
                                        @if($log->login)
                                            <small class="text-muted">
                                                <strong>Email:</strong> {{ $log->login->email_address }}<br>
                                                <strong>Login:</strong> {{ \Carbon\Carbon::parse($log->login->login_datetime)->format('M j, Y H:i') }}
                                            </small>
                                        @else
                                            <span class="text-muted">No login info</span>
                                        @endif
                                    </td>
                                    <td>{{ $log->created_at->format('M j, Y H:i:s') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-3">
                        <p class="text-muted">
                            Showing {{ $logs->count() }} log entries
                        </p>
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $logs->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-activity display-1 text-muted"></i>
                        <h5 class="mt-3">No System Logs Found</h5>
                        <p class="text-muted">System activity logs will appear here as users interact with the system.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function exportLogs() {
    // Simple CSV export functionality
    const table = document.querySelector('table');
    const rows = Array.from(table.querySelectorAll('tr'));
    
    let csv = [];
    rows.forEach(row => {
        const cols = Array.from(row.querySelectorAll('td, th'));
        const rowData = cols.map(col => {
            // Remove HTML tags and get clean text
            return '"' + col.textContent.replace(/"/g, '""') + '"';
        });
        csv.push(rowData.join(','));
    });
    
    const csvContent = csv.join('\n');
    const blob = new Blob([csvContent], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'system_logs_' + new Date().toISOString().split('T')[0] + '.csv';
    a.click();
    window.URL.revokeObjectURL(url);
}
</script>
@endsection
