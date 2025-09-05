@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Edit Assessor Profile</h4>
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

                <form action="{{ route('assessor_profiles.update', $assessor_profile) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="assessor_id" class="form-label">Assessor ID</label>
                        <input type="text" class="form-control" id="assessor_id" 
                               value="{{ $assessor_profile->assessor_id }}" readonly>
                        <small class="form-text text-muted">Assessor ID cannot be changed</small>
                    </div>

                    <div class="mb-3">
                        <label for="email_address" class="form-label">Email Address *</label>
                        <select class="form-select @error('email_address') is-invalid @enderror" 
                                id="email_address" name="email_address" required>
                            <option value="">Select an email address</option>
                            @foreach($accounts as $account)
                                <option value="{{ $account->email_address }}" 
                                        {{ old('email_address', $assessor_profile->email_address) == $account->email_address ? 'selected' : '' }}>
                                    {{ $account->email_address }} - {{ $account->first_name }} {{ $account->last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('email_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="picture_path" class="form-label">Picture Path</label>
                        <input type="text" class="form-control @error('picture_path') is-invalid @enderror" 
                               id="picture_path" name="picture_path" 
                               value="{{ old('picture_path', $assessor_profile->picture_path) }}" 
                               placeholder="Enter picture file path">
                        @error('picture_path')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date_upload" class="form-label">Date Upload *</label>
                        <input type="date" class="form-control @error('date_upload') is-invalid @enderror" 
                               id="date_upload" name="date_upload" 
                               value="{{ old('date_upload', $assessor_profile->date_upload) }}" required>
                        @error('date_upload')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('assessor_profiles.show', $assessor_profile) }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

