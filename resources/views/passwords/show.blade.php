@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="bi bi-eye"></i> Password Details</h1>
    <div>
        <a href="{{ route('passwords.edit', $password->id) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> Edit Password
        </a>
        <a href="{{ route('passwords.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Passwords
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-key"></i> Password Information
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Password ID:</label>
                            <p class="form-control-plaintext">{{ $password->id }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Password Status:</label>
                            <p class="form-control-plaintext">
                                @if($password->password_hashed)
                                    <span class="badge bg-success fs-6">Password Set</span>
                                @else
                                    <span class="badge bg-warning fs-6">No Password</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Password Created:</label>
                            <p class="form-control-plaintext">
                                @if($password->date_pass_created)
                                    <i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($password->date_pass_created)->format('M d, Y H:i:s') }}
                                @else
                                    <span class="text-muted">Not set</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Record Created:</label>
                            <p class="form-control-plaintext">
                                <i class="bi bi-calendar"></i> {{ $password->created_at->format('M d, Y H:i:s') }}
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Password Hash:</label>
                    <div class="form-control-plaintext bg-light p-3 rounded">
                        @if($password->password_hashed)
                            <code>{{ $password->password_hashed }}</code>
                        @else
                            <span class="text-muted">No password hash available</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        @if($password->admin)
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-person-badge"></i> Associated Admin
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Admin ID:</label>
                    <p class="form-control-plaintext">{{ $password->admin->admin_id }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Name:</label>
                    <p class="form-control-plaintext">{{ $password->admin->name ?? 'N/A' }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Email:</label>
                    <p class="form-control-plaintext">{{ $password->admin->email_address ?? 'N/A' }}</p>
                </div>
                @if($password->admin->position)
                <div class="mb-3">
                    <label class="form-label fw-bold">Position:</label>
                    <p class="form-control-plaintext">{{ $password->admin->position }}</p>
                </div>
                @endif
            </div>
        </div>
        @else
        <div class="card">
            <div class="card-body text-center">
                <i class="bi bi-person-x display-4 text-muted mb-3"></i>
                <h6 class="text-muted">No Admin Profile Associated</h6>
                <p class="text-muted small">This password record is not linked to any admin profile.</p>
            </div>
        </div>
        @endif
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-info-circle"></i> Record Information
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Created:</label>
                    <p class="form-control-plaintext">{{ $password->created_at->format('M d, Y H:i:s') }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Last Updated:</label>
                    <p class="form-control-plaintext">{{ $password->updated_at->format('M d, Y H:i:s') }}</p>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-gear"></i> Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('passwords.edit', $password->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit Password
                    </a>
                    <form action="{{ route('passwords.destroy', $password->id) }}" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this password record? This action cannot be undone.')">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="bi bi-trash"></i> Delete Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



