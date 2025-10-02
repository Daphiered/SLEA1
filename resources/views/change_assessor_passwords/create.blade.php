@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Record New Password Change</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('change_assessor_passwords.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="email_address" class="form-label">Assessor Email Address *</label>
                        <select class="form-select @error('email_address') is-invalid @enderror" 
                                id="email_address" name="email_address" required>
                            <option value="">Select an assessor email address</option>
                            @foreach($accounts as $account)
                                <option value="{{ $account->email_address }}" 
                                        {{ old('email_address') == $account->email_address ? 'selected' : '' }}>
                                    {{ $account->email_address }} - {{ $account->first_name }} {{ $account->last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('email_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Select the assessor whose password was changed</small>
                    </div>

                    <div class="mb-3">
                        <label for="old_password_hashed" class="form-label">Old Password Hash *</label>
                        <input type="text" class="form-control @error('old_password_hashed') is-invalid @enderror" 
                               id="old_password_hashed" name="old_password_hashed" value="{{ old('old_password_hashed') }}" 
                               placeholder="Enter the old password hash" required>
                        @error('old_password_hashed')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Enter the hashed version of the old password</small>
                    </div>

                    <div class="mb-3">
                        <label for="new_password_hashed" class="form-label">New Password Hash *</label>
                        <input type="text" class="form-control @error('new_password_hashed') is-invalid @enderror" 
                               id="new_password_hashed" name="new_password_hashed" value="{{ old('new_password_hashed') }}" 
                               placeholder="Enter the new password hash" required>
                        @error('new_password_hashed')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Enter the hashed version of the new password</small>
                    </div>

                    <div class="mb-3">
                        <label for="date_pass_changed" class="form-label">Date Password Changed *</label>
                        <input type="date" class="form-control @error('date_pass_changed') is-invalid @enderror" 
                               id="date_pass_changed" name="date_pass_changed" value="{{ old('date_pass_changed') }}" required>
                        @error('date_pass_changed')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Select the date when the password was changed</small>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('change_assessor_passwords.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Record Password Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection









