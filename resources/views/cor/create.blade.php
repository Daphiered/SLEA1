@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h3 class="mb-3">Upload Certificate of Registration (COR)</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>There were some problems with your input.</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cor.store') }}" method="POST" enctype="multipart/form-data" class="card p-3">
        @csrf

        <div class="mb-3">
            <label class="form-label">Student ID</label>
            <input type="text" name="student_id" class="form-control" maxlength="20"
                   value="{{ old('student_id', $studentId) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">COR File (PDF/JPG/PNG · max 5MB)</label>
            <input type="file" name="file" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status (optional)</label>
            <input type="text" name="status" class="form-control" maxlength="15"
                   placeholder="Pending/Approved/Rejected" value="{{ old('status') }}">
        </div>

        <div class="text-end">
            <a href="{{ route('cor.index') }}" class="btn btn-outline-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Submit COR</button>
        </div>
    </form>

    <p class="text-muted mt-3">
        Academic Year is computed automatically from the upload date (AY starts in August).
    </p>
</div>
@endsection
