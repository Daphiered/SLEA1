@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="bi bi-pencil"></i> Edit Student: {{ $student->first_name }} {{ $student->last_name }}
                </h4>
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

                <form action="{{ route('students.update', $student->email_address) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Personal Information -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="border-bottom pb-2">
                                <i class="bi bi-person"></i> Personal Information
                            </h5>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="student_id" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="student_id" 
                                   value="{{ $student->student_id }}" readonly>
                            <small class="form-text text-muted">Student ID cannot be changed</small>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="last_name" class="form-label">Last Name *</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                   id="last_name" name="last_name" value="{{ old('last_name', $student->last_name) }}" required>
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="first_name" class="form-label">First Name *</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                   id="first_name" name="first_name" value="{{ old('first_name', $student->first_name) }}" required>
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control @error('middle_name') is-invalid @enderror"
                                   id="middle_name" name="middle_name" value="{{ old('middle_name', $student->middle_name) }}">
                            @error('middle_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="email_address" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email_address" 
                                   value="{{ $student->email_address }}" readonly>
                            <small class="form-text text-muted">Email address cannot be changed</small>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="contact_number" class="form-label">Contact Number *</label>
                            <input type="tel" class="form-control @error('contact_number') is-invalid @enderror"
                                   id="contact_number" name="contact_number" value="{{ old('contact_number', $student->contact_number) }}" required>
                            @error('contact_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="date_of_birth" class="form-label">Date of Birth *</label>
                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                   id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $student->date_of_birth) }}" required>
                            @error('date_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="gender" class="form-label">Gender *</label>
                            <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="Male" {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender', $student->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="address" class="form-label">Address *</label>
                            <textarea class="form-control @error('address') is-invalid @enderror"
                                      id="address" name="address" rows="2" required>{{ old('address', $student->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Academic Information Update -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="border-bottom pb-2">
                                <i class="bi bi-book"></i> Academic Information
                            </h5>
                            <p class="text-muted">Use the dedicated academic update forms to modify program and year level information.</p>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6>Current Academic Info</h6>
                                    @if($student->academicInfo)
                                        <p><strong>Program:</strong> {{ $student->academicInfo->program }}</p>
                                        <p><strong>Major:</strong> {{ $student->academicInfo->major ?? 'N/A' }}</p>
                                        <p><strong>Year Level:</strong> {{ $student->academicInfo->year_level }}</p>
                                        <p><strong>Graduate Prior:</strong> {{ $student->academicInfo->graduate_prior ?? 'N/A' }}</p>
                                    @else
                                        <p class="text-muted">No academic information available</p>
                                    @endif
                                    <a href="{{ route('academics.create') }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-plus-circle"></i> Update Academic Info
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6>Quick Updates</h6>
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('Update-program.create') }}" class="btn btn-sm btn-outline-warning">
                                            <i class="bi bi-arrow-repeat"></i> Change Program
                                        </a>
                                        <a href="{{ route('year-level.create') }}" class="btn btn-sm btn-outline-info">
                                            <i class="bi bi-arrow-up"></i> Update Year Level
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Picture Update -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="border-bottom pb-2">
                                <i class="bi bi-image"></i> Profile Picture
                            </h5>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="profile_picture" class="form-label">Update Profile Picture</label>
                            <input type="file" class="form-control @error('profile_picture') is-invalid @enderror"
                                   id="profile_picture" name="profile_picture" accept="image/*">
                            @error('profile_picture')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Accepted formats: JPG, PNG, GIF (Max: 2MB)</small>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Current Picture</label>
                            <div class="text-center">
                                @if($student->profile && $student->profile->picture_path)
                                    <img src="{{ asset('storage/' . $student->profile->picture_path) }}" 
                                         alt="Current Profile Picture" 
                                         class="img-fluid rounded" 
                                         style="max-height: 150px;">
                                    <p class="text-muted mt-2">Current profile picture</p>
                                @else
                                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center mx-auto" 
                                         style="width: 150px; height: 150px;">
                                        <i class="bi bi-person display-4 text-white"></i>
                                    </div>
                                    <p class="text-muted mt-2">No profile picture set</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Additional Actions -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="border-bottom pb-2">
                                <i class="bi bi-gear"></i> Additional Actions
                            </h5>
                        </div>
                        
                        <div class="col-md-3">
                            <a href="{{ route('change-password.form') }}" class="btn btn-outline-primary w-100 mb-2">
                                <i class="bi bi-key"></i> Change Password
                            </a>
                        </div>
                        
                        <div class="col-md-3">
                            <a href="{{ route('cor.create') }}" class="btn btn-outline-success w-100 mb-2">
                                <i class="bi bi-upload"></i> Upload COR
                            </a>
                        </div>
                        
                        <div class="col-md-3">
                            <a href="{{ route('leadership.create') }}" class="btn btn-outline-info w-100 mb-2">
                                <i class="bi bi-trophy"></i> Add Leadership
                            </a>
                        </div>
                        
                        <div class="col-md-3">
                            <a href="{{ route('profiles.create') }}" class="btn btn-outline-warning w-100 mb-2">
                                <i class="bi bi-person-plus"></i> Update Profile
                            </a>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('students.show', $student->email_address) }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Update Student
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// File size validation
document.getElementById('profile_picture').addEventListener('change', function() {
    const file = this.files[0];
    const maxSize = 2 * 1024 * 1024; // 2MB
    
    if (file && file.size > maxSize) {
        alert('File size must be less than 2MB');
        this.value = '';
    }
});
</script>
@endsection






