@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Upload Profile Picture</h2>
    <form action="{{ route('profiles.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Student ID:</label>
            <input type="text" name="student_id" class="form-control">
        </div>
        <div class="mb-3">
            <label>Picture Path:</label>
            <input type="text" name="profile_picture_path" class="form-control">
        </div>
        <div class="mb-3">
            <label>Date Uploaded:</label>
            <input type="date" name="date_upload_profile" class="form-control">
        </div>
        <button class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection
