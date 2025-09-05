@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="bi bi-arrow-repeat"></i> Admin Password Changes</h1>
    <a href="{{ route('password-changes.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Record Password Change
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Admin</th>
                        <th>Change Date</th>
                        <th>Password Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($changes as $change)
                    <tr>
                        <td>{{ $change->id }}</td>
                        <td>
                            @if($change->admin)
                                <div>
                                    <strong>{{ $change->admin->name ?? 'N/A' }}</strong><br>
                                    <small class="text-muted">{{ $change->admin->email_address ?? 'N/A' }}</small>
                                </div>
                            @else
                                <span class="text-muted">No Admin Associated</span>
                            @endif
                        </td>
                        <td>
                            @if($change->date_pass_changed)
                                {{ \Carbon\Carbon::parse($change->date_pass_changed)->format('M d, Y H:i') }}
                            @else
                                <span class="text-muted">Not Set</span>
                            @endif
                        </td>
                        <td>
                            @if($change->password_hashed && $change->old_password_hashed)
                                <span class="badge bg-success">Password Changed</span>
                            @elseif($change->password_hashed)
                                <span class="badge bg-info">New Password Set</span>
                            @else
                                <span class="badge bg-warning">Incomplete</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('password-changes.show', $change->id) }}" 
                                   class="btn btn-info btn-sm" 
                                   title="View Details">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('password-changes.edit', $change->id) }}" 
                                   class="btn btn-warning btn-sm" 
                                   title="Edit Record">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('password-changes.destroy', $change->id) }}" 
                                      method="POST" 
                                      style="display:inline;"
                                      onsubmit="return confirm('Are you sure you want to delete this password change record? This action cannot be undone.')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Record">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            <i class="bi bi-inbox display-4 d-block mb-2"></i>
                            No password change records found. <a href="{{ route('password-changes.create') }}">Record your first password change</a>.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($changes->count() > 0)
<div class="mt-3">
    <small class="text-muted">
        Showing {{ $changes->count() }} password change record(s)
    </small>
</div>
@endif
@endsection


