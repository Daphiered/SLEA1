@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="bi bi-plus-circle"></i> Create New Admin Password</h1>
    <a href="{{ route('passwords.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back to Passwords
    </a>
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
        <h5 class="card-title mb-0">Password Information</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('passwords.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="admin_id" class="form-label">
                            <i class="bi bi-person-badge"></i> Admin Profile <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('admin_id') is-invalid @enderror" 
                                id="admin_id" 
                                name="admin_id" 
                                required>
                            <option value="">Select Admin Profile</option>
                            @foreach($admins as $admin)
                                <option value="{{ $admin->admin_id }}" 
                                        {{ old('admin_id') == $admin->admin_id ? 'selected' : '' }}>
                                    {{ $admin->name }} ({{ $admin->email_address }})
                                </option>
                            @endforeach
                        </select>
                        @error('admin_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password_hashed" class="form-label">
                            <i class="bi bi-lock"></i> Password <span class="text-danger">*</span>
                        </label>
                        <input type="password" 
                               class="form-control @error('password_hashed') is-invalid @enderror" 
                               id="password_hashed" 
                               name="password_hashed" 
                               value="{{ old('password_hashed') }}" 
                               required
                               minlength="8">
                        @error('password_hashed')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Minimum 8 characters</div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="date_pass_created" class="form-label">
                            <i class="bi bi-calendar"></i> Password Creation Date
                        </label>
                        <input type="datetime-local" 
                               class="form-control @error('date_pass_created') is-invalid @enderror" 
                               id="date_pass_created" 
                               name="date_pass_created" 
                               value="{{ old('date_pass_created', now()->format('Y-m-d\TH:i')) }}">
                        @error('date_pass_created')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Leave empty to use current date and time</div>
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('passwords.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Create Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection


