@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="bi bi-person-badge"></i> Student Profile
                </h4>
                <div class="d-flex gap-2">
                    <a href="{{ route('students.edit', $student->email_address) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="{{ route('students.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="row">
                    <!-- Profile Picture and Basic Info -->
                    <div class="col-md-4">
                        <div class="text-center mb-4">
                            @if($student->profile && $student->profile->picture_path)
                                <img src="{{ asset('storage/' . $student->profile->picture_path) }}" 
                                     alt="Profile Picture" 
                                     class="img-fluid rounded" 
                                     style="max-height: 300px;">
                            @else
                                <div class="bg-secondary rounded d-flex align-items-center justify-content-center mx-auto" 
                                     style="width: 300px; height: 300px;">
                                    <i class="bi bi-person display-1 text-white"></i>
                                </div>
                            @endif
                        </div>
                        
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Quick Actions</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('change-password.form') }}" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-key"></i> Change Password
                                    </a>
                                    <a href="{{ route('cor.create') }}" class="btn btn-outline-success btn-sm">
                                        <i class="bi bi-upload"></i> Upload COR
                                    </a>
                                    <a href="{{ route('leadership.create') }}" class="btn btn-outline-info btn-sm">
                                        <i class="bi bi-trophy"></i> Add Leadership
                                    </a>
                                    <a href="{{ route('academics.create') }}" class="btn btn-outline-warning btn-sm">
                                        <i class="bi bi-book"></i> Update Academic Info
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Student Information -->
                    <div class="col-md-8">
                        <!-- Personal Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="mb-0">
                                    <i class="bi bi-person"></i> Personal Information
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td><strong>Student ID:</strong></td>
                                                <td>{{ $student->student_id }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Full Name:</strong></td>
                                                <td>{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Email:</strong></td>
                                                <td>{{ $student->email_address }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Contact:</strong></td>
                                                <td>{{ $student->contact_number }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td><strong>Date of Birth:</strong></td>
                                                <td>{{ \Carbon\Carbon::parse($student->date_of_birth)->format('F j, Y') }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Age:</strong></td>
                                                <td>{{ \Carbon\Carbon::parse($student->date_of_birth)->age }} years old</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Gender:</strong></td>
                                                <td>{{ $student->gender }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Address:</strong></td>
                                                <td>{{ $student->address }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Academic Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="mb-0">
                                    <i class="bi bi-book"></i> Academic Information
                                </h6>
                            </div>
                            <div class="card-body">
                                @if($student->academicInfo)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong>Program:</strong></td>
                                                    <td>{{ $student->academicInfo->program }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Major:</strong></td>
                                                    <td>{{ $student->academicInfo->major ?? 'N/A' }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong>Year Level:</strong></td>
                                                    <td>{{ $student->academicInfo->year_level }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Graduate Prior:</strong></td>
                                                    <td>{{ $student->academicInfo->graduate_prior ?? 'N/A' }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                @else
                                    <p class="text-muted">No academic information available.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Leadership Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="mb-0">
                                    <i class="bi bi-trophy"></i> Leadership & Activities
                                </h6>
                            </div>
                            <div class="card-body">
                                @if($student->leadershipInfo && $student->leadershipInfo->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Organization</th>
                                                    <th>Role</th>
                                                    <th>Term</th>
                                                    <th>Hours</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($student->leadershipInfo as $leadership)
                                                    <tr>
                                                        <td>{{ $leadership->organization_name }}</td>
                                                        <td>{{ $leadership->organization_role }}</td>
                                                        <td>{{ $leadership->term }}</td>
                                                        <td>{{ $leadership->hours_log }}</td>
                                                        <td>
                                                            <span class="badge bg-{{ $leadership->leadership_status == 'Active' ? 'success' : 'secondary' }}">
                                                                {{ $leadership->leadership_status }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-muted">No leadership information available.</p>
                                @endif
                            </div>
                        </div>

                        <!-- COR Submissions -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="mb-0">
                                    <i class="bi bi-file-earmark-text"></i> COR Submissions
                                </h6>
                            </div>
                            <div class="card-body">
                                @if($student->corSubmissions && $student->corSubmissions->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>File Name</th>
                                                    <th>Type</th>
                                                    <th>Size</th>
                                                    <th>Academic Year</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($student->corSubmissions as $cor)
                                                    <tr>
                                                        <td>{{ $cor->file_name }}</td>
                                                        <td>{{ strtoupper($cor->file_type) }}</td>
                                                        <td>{{ $cor->file_size }} KB</td>
                                                        <td>{{ $cor->academic_year }}</td>
                                                        <td>
                                                            <span class="badge bg-{{ $cor->status == 'Approved' ? 'success' : ($cor->status == 'Pending' ? 'warning' : 'danger') }}">
                                                                {{ $cor->status }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('cor.download', $cor->cor_id) }}" 
                                                               class="btn btn-sm btn-outline-primary">
                                                                <i class="bi bi-download"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-muted">No COR submissions available.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Account Information -->
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">
                                    <i class="bi bi-shield-check"></i> Account Information
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td><strong>Account Created:</strong></td>
                                                <td>{{ \Carbon\Carbon::parse($student->dateacc_created)->format('F j, Y') }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Last Updated:</strong></td>
                                                <td>{{ $student->updated_at->format('F j, Y H:i') }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td><strong>Account Status:</strong></td>
                                                <td><span class="badge bg-success">Active</span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Profile Complete:</strong></td>
                                                <td>
                                                    @if($student->profile && $student->academicInfo)
                                                        <span class="badge bg-success">Complete</span>
                                                    @else
                                                        <span class="badge bg-warning">Incomplete</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection






