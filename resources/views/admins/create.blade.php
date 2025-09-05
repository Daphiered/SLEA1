@extends('layouts.app')

@section('content')
<h1>Add Admin</h1>
<form action="{{ route('admins.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>ID</label>
        <input type="text" name="admin_id" class="form-control">
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email_address" class="form-control">
    </div>
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control">
    </div>
    <div class="mb-3">
        <label>Position</label>
        <input type="text" name="position" class="form-control">
    </div>
    <button class="btn btn-success">Save</button>
</form>
@endsection
