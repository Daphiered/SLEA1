@extends('layouts.app')

@section('content')
<h1>Edit Admin</h1>
<form action="{{ route('admins.update',$admin->admin_id) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email_address" value="{{ $admin->email_address }}" class="form-control">
    </div>
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" value="{{ $admin->name }}" class="form-control">
    </div>
    <div class="mb-3">
        <label>Position</label>
        <input type="text" name="position" value="{{ $admin->position }}" class="form-control">
    </div>
    <button class="btn btn-warning">Update</button>
</form>
@endsection
