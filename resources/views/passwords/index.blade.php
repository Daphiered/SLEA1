@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="bi bi-key"></i> Admin Passwords</h1>
    <a href="{{ route('passwords.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add New Password
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
                        <th>Password Status</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($passwords as $password)
                    <tr>
                        <td>{{ $password->id }}</td>
                        <td>
                            @if($password->admin)
                                <div>
                                    <strong>{{ $password->admin->name ?? 'N/A' }}</strong><br>
                                    <small class="text-muted">{{ $password->admin->email_address ?? 'N/A' }}</small>
                                </div>
                            @else
                                <span class="text-muted">No Admin Associated</span>
                            @endif
                        </td>
                        <td>
                            @if($password->password_hashed)
                                <span class="badge bg-success">Password Set</span>
                            @else
                                <span class="badge bg-warning">No Password</span>
                            @endif
                        </td>
                        <td>
                            @if($password->date_pass_created)
                                {{ \Carbon\Carbon::parse($password->date_pass_created)->format('M d, Y H:i') }}
                            @else
                                <span class="text-muted">Not Set</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('passwords.show', $password->id) }}" 
                                   class="btn btn-info btn-sm" 
                                   title="View Details">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('passwords.edit', $password->id) }}" 
                                   class="btn btn-warning btn-sm" 
                                   title="Edit Password">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('passwords.destroy', $password->id) }}" 
                                      method="POST" 
                                      style="display:inline;"
                                      onsubmit="return confirm('Are you sure you want to delete this password record? This action cannot be undone.')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Password">
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
                            No password records found. <a href="{{ route('passwords.create') }}">Create your first password record</a>.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($passwords->count() > 0)
<div class="mt-3">
    <small class="text-muted">
        Showing {{ $passwords->count() }} password record(s)
    </small>
</div>
@endif
@endsection


