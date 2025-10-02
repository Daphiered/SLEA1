@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Leadership Information</h2>
    <form action="{{ route('leadership.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="student_id" class="form-label">Student ID</label>
            <input type="text" class="form-control" id="student_id" name="student_id" required>
        </div>
        <div class="mb-3">
            <label for="leadership_type" class="form-label">Leadership Type</label>
            <select class="form-control" id="leadership_type" name="leadership_type" required>
                
                @foreach($leadershipTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="organization_name" class="form-label">Organization Name</label>
            <select class="form-control" id="organization_name" name="organization_name" required>
                <option value="N/A">N/A</option>
                @foreach($organizations as $org)
                    <option value="{{ $org->name }}">{{ $org->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="position" class="form-label">Position</label>
            <input type="text" class="form-control" id="position" name="position" required>
        </div>
        <div class="mb-3">
            <label for="term" class="form-label">Term</label>
            <input type="text" class="form-control" id="term" name="term" required>
        </div>
        <div class="mb-3">
            <label for="issued_by" class="form-label">Issued By</label>
            <input type="text" class="form-control" id="issued_by" name="issued_by" required>
        </div>
        <div class="mb-3">
            <label for="leadership_status" class="form-label">Leadership Status</label>
            <select class="form-control" id="leadership_status" name="leadership_status" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
