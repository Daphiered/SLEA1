@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1><i class="bi bi-award"></i> Leadership Information Details</h1>
                <div>
                    <a href="{{ route('leadership.edit', $leadership->leadership_id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="{{ route('leadership.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back to Leadership
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-building"></i> Organization Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Organization Name:</label>
                                        <p class="form-control-plaintext">{{ $leadership->organization_name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Role/Position:</label>
                                        <p class="form-control-plaintext">{{ $leadership->organization_role }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Term:</label>
                                        <p class="form-control-plaintext">{{ $leadership->term }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Hours Logged:</label>
                                        <p class="form-control-plaintext">{{ $leadership->hours_log }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Leadership Status:</label>
                                        <p class="form-control-plaintext">
                                            @if($leadership->leadership_status === 'Active')
                                                <span class="badge bg-success fs-6">Active</span>
                                            @elseif($leadership->leadership_status === 'Completed')
                                                <span class="badge bg-primary fs-6">Completed</span>
                                            @else
                                                <span class="badge bg-secondary fs-6">Inactive</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Leadership ID:</label>
                                        <p class="form-control-plaintext">{{ $leadership->leadership_id }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    @if($leadership->student)
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-person-badge"></i> Student Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Student Name:</label>
                                <p class="form-control-plaintext">{{ $leadership->student->full_name }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Student ID:</label>
                                <p class="form-control-plaintext">{{ $leadership->student->student_id }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Email:</label>
                                <p class="form-control-plaintext">{{ $leadership->student->email_address }}</p>
                            </div>
                            @if($leadership->student->contact_number)
                            <div class="mb-3">
                                <label class="form-label fw-bold">Contact:</label>
                                <p class="form-control-plaintext">{{ $leadership->student->contact_number }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="bi bi-person-x display-4 text-muted mb-3"></i>
                            <h6 class="text-muted">Student Not Found</h6>
                            <p class="text-muted small">The associated student record could not be found.</p>
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
                                <p class="form-control-plaintext">{{ $leadership->created_at->format('M d, Y H:i:s') }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Last Updated:</label>
                                <p class="form-control-plaintext">{{ $leadership->updated_at->format('M d, Y H:i:s') }}</p>
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
                                <a href="{{ route('leadership.edit', $leadership->leadership_id) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil"></i> Edit Leadership Record
                                </a>
                                <form action="{{ route('leadership.destroy', $leadership->leadership_id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this leadership record? This action cannot be undone.')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100">
                                        <i class="bi bi-trash"></i> Delete Record
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


