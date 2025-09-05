@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Academic Info</h2>
    <form action="{{ route('academics.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="student_id" class="form-label">Student ID</label>
            <input type="text" name="student_id" class="form-control">
        </div>
        <div class="mb-3">
            <label for="email_address" class="form-label">Email</label>
            <input type="email" name="email_address" class="form-control">
        </div>
        <div class="mb-3">
            <label for="college" class="form-label">College</label>
            <input type="text" name="college" class="form-control">
        </div>
        <button class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
