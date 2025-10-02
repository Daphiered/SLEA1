@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="bi bi-pencil"></i> Edit Account</h1>
    <div>
        <a href="{{ route('accounts.show', $account->id) }}" class="btn btn-info">
            <i class="bi bi-eye"></i> View Account
        </a>
        <a href="{{ route('accounts.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Accounts
        </a>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h6><i class="bi bi-exclamation-triangle"></i> Please fix the following errors:</h6>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Edit Account Information</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('accounts.update', $account->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email_address" class="form-label">
                            <i class="bi bi-envelope"></i> Email Address <span class="text-danger">*</span>
                        </label>
                        <input type="email" 
                               class="form-control @error('email_address') is-invalid @enderror" 
                               id="email_address" 
                               name="email_address" 
                               value="{{ old('email_address', $account->email_address) }}" 
                               required>
                        @error('email_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="admin_id" class="form-label">
                            <i class="bi bi-person-badge"></i> Admin Profile
                        </label>
                        <select class="form-select @error('admin_id') is-invalid @enderror" 
                                id="admin_id" 
                                name="admin_id">
                            <option value="">Select Admin Profile (Optional)</option>
                            @foreach($admins as $admin)
                                <option value="{{ $admin->admin_id }}" 
                                        {{ old('admin_id', $account->admin_id) == $admin->admin_id ? 'selected' : '' }}>
                                    {{ $admin->name }} ({{ $admin->email_address }})
                                </option>
                            @endforeach
                        </select>
                        @error('admin_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="user_type" class="form-label">
                            <i class="bi bi-person-gear"></i> User Type
                        </label>
                        <select class="form-select @error('user_type') is-invalid @enderror" 
                                id="user_type" 
                                name="user_type">
                            <option value="">Select User Type</option>
                            <option value="admin" {{ old('user_type', $account->user_type) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="assessor" {{ old('user_type', $account->user_type) == 'assessor' ? 'selected' : '' }}>Assessor</option>
                            <option value="student" {{ old('user_type', $account->user_type) == 'student' ? 'selected' : '' }}>Student</option>
                            <option value="supervisor" {{ old('user_type', $account->user_type) == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                        </select>
                        @error('user_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="account_status" class="form-label">
                            <i class="bi bi-toggle-on"></i> Account Status
                        </label>
                        <select class="form-select @error('account_status') is-invalid @enderror" 
                                id="account_status" 
                                name="account_status">
                            <option value="active" {{ old('account_status', $account->account_status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('account_status', $account->account_status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="suspended" {{ old('account_status', $account->account_status) == 'suspended' ? 'selected' : '' }}>Suspended</option>
                        </select>
                        @error('account_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="last_login" class="form-label">
                            <i class="bi bi-clock"></i> Last Login
                        </label>
                        <input type="datetime-local" 
                               class="form-control @error('last_login') is-invalid @enderror" 
                               id="last_login" 
                               name="last_login" 
                               value="{{ old('last_login', $account->last_login ? \Carbon\Carbon::parse($account->last_login)->format('Y-m-d\TH:i') : '') }}">
                        @error('last_login')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Leave empty to keep current value</div>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="action" class="form-label">
                    <i class="bi bi-list-check"></i> Action/Notes
                </label>
                <textarea class="form-control @error('action') is-invalid @enderror" 
                          id="action" 
                          name="action" 
                          rows="3" 
                          placeholder="Enter any notes or actions for this account...">{{ old('action', $account->action) }}</textarea>
                @error('action')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('accounts.show', $account->id) }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Update Account
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">
            <i class="bi bi-info-circle"></i> Account Information
        </h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Account ID:</strong> {{ $account->id }}</p>
                <p><strong>Created:</strong> {{ $account->created_at->format('M d, Y H:i:s') }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Last Updated:</strong> {{ $account->updated_at->format('M d, Y H:i:s') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection



