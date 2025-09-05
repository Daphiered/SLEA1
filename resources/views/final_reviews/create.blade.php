@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Final Review Request</h1>
    <form action="{{ route('final-reviews.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="submission_id" class="form-label">Submission</label>
            <select name="submission_id" class="form-control" required>
                @foreach($submissions as $submission)
                    <option value="{{ $submission->id }}">{{ $submission->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="action" class="form-label">Action</label>
            <input type="text" name="action" class="form-control" maxlength="20">
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('final-reviews.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
