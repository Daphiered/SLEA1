@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0"><i class="bi bi-pencil"></i> Edit Leadership Information</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('leadership.update', $leadership->leadership_id) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="student_id" class="form-label">Student</label>
                                    <select name="student_id" id="student_id" class="form-select @error('student_id') is-invalid @enderror" required>
                                        <option value="">Select Student</option>
                                        @foreach($students as $student)
                                            <option value="{{ $student->student_id }}" {{ old('student_id', $leadership->student_id) == $student->student_id ? 'selected' : '' }}>
                                                {{ $student->full_name }} ({{ $student->student_id }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('student_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="organization_name" class="form-label">Organization Name</label>
                                    <input type="text" name="organization_name" id="organization_name" class="form-control @error('organization_name') is-invalid @enderror" value="{{ old('organization_name', $leadership->organization_name) }}" required>
                                    @error('organization_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="organization_role" class="form-label">Organization Role</label>
                                    <input type="text" name="organization_role" id="organization_role" class="form-control @error('organization_role') is-invalid @enderror" value="{{ old('organization_role', $leadership->organization_role) }}" required>
                                    @error('organization_role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="term" class="form-label">Term</label>
                                    <input type="text" name="term" id="term" class="form-control @error('term') is-invalid @enderror" value="{{ old('term', $leadership->term) }}" placeholder="e.g., 2024-2025" required>
                                    @error('term')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="hours_log" class="form-label">Hours Log</label>
                                    <input type="text" name="hours_log" id="hours_log" class="form-control @error('hours_log') is-invalid @enderror" value="{{ old('hours_log', $leadership->hours_log) }}" placeholder="e.g., 120 hours" required>
                                    @error('hours_log')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="leadership_status" class="form-label">Leadership Status</label>
                                    <select name="leadership_status" id="leadership_status" class="form-select @error('leadership_status') is-invalid @enderror" required>
                                        <option value="">Select Status</option>
                                        <option value="Active" {{ old('leadership_status', $leadership->leadership_status) == 'Active' ? 'selected' : '' }}>Active</option>
                                        <option value="Inactive" {{ old('leadership_status', $leadership->leadership_status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                        <option value="Completed" {{ old('leadership_status', $leadership->leadership_status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                    @error('leadership_status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('leadership.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Update Leadership Record
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




