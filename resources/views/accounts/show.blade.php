@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="bi bi-eye"></i> Account Details</h1>
    <div>
        <a href="{{ route('accounts.edit', $account->id) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> Edit Account
        </a>
        <a href="{{ route('accounts.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Accounts
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-person-circle"></i> Account Information
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Account ID:</label>
                            <p class="form-control-plaintext">{{ $account->id }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email Address:</label>
                            <p class="form-control-plaintext">
                                <i class="bi bi-envelope"></i> {{ $account->email_address }}
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">User Type:</label>
                            <p class="form-control-plaintext">
                                <span class="badge bg-info fs-6">{{ $account->user_type ?? 'Not specified' }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Account Status:</label>
                            <p class="form-control-plaintext">
                                @if($account->account_status == 'active')
                                    <span class="badge bg-success fs-6">Active</span>
                                @elseif($account->account_status == 'inactive')
                                    <span class="badge bg-secondary fs-6">Inactive</span>
                                @elseif($account->account_status == 'suspended')
                                    <span class="badge bg-danger fs-6">Suspended</span>
                                @else
                                    <span class="badge bg-warning fs-6">{{ $account->account_status ?? 'Unknown' }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Last Login:</label>
                            <p class="form-control-plaintext">
                                @if($account->last_login)
                                    <i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($account->last_login)->format('M d, Y H:i:s') }}
                                @else
                                    <span class="text-muted">Never logged in</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Created:</label>
                            <p class="form-control-plaintext">
                                <i class="bi bi-calendar"></i> {{ $account->created_at->format('M d, Y H:i:s') }}
                            </p>
                        </div>
                    </div>
                </div>
                
                @if($account->action)
                <div class="mb-3">
                    <label class="form-label fw-bold">Action/Notes:</label>
                    <div class="form-control-plaintext bg-light p-3 rounded">
                        {{ $account->action }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        @if($account->admin)
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-person-badge"></i> Associated Admin
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Admin ID:</label>
                    <p class="form-control-plaintext">{{ $account->admin->admin_id }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Name:</label>
                    <p class="form-control-plaintext">{{ $account->admin->name ?? 'N/A' }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Email:</label>
                    <p class="form-control-plaintext">{{ $account->admin->email_address ?? 'N/A' }}</p>
                </div>
                @if($account->admin->position)
                <div class="mb-3">
                    <label class="form-label fw-bold">Position:</label>
                    <p class="form-control-plaintext">{{ $account->admin->position }}</p>
                </div>
                @endif
            </div>
        </div>
        @else
        <div class="card">
            <div class="card-body text-center">
                <i class="bi bi-person-x display-4 text-muted mb-3"></i>
                <h6 class="text-muted">No Admin Profile Associated</h6>
                <p class="text-muted small">This account is not linked to any admin profile.</p>
            </div>
        </div>
        @endif
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-gear"></i> Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('accounts.edit', $account->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit Account
                    </a>
                    <form action="{{ route('accounts.destroy', $account->id) }}" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this account? This action cannot be undone.')">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="bi bi-trash"></i> Delete Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



