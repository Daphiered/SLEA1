@extends('layouts.app')

@section('content')
<h4>Create Assessor Account</h4>

<form action="{{ route('assessor_accounts.store') }}" method="POST">
    @csrf
    <div class="mb-3"><label>Email</label><input type="email" name="email_address" class="form-control"></div>
    <div class="mb-3"><label>Admin ID</label><input type="text" name="admin_id" class="form-control"></div>
    <div class="mb-3"><label>First Name</label><input type="text" name="first_name" class="form-control"></div>
    <div class="mb-3"><label>Middle Name</label><input type="text" name="middle_name" class="form-control"></div>
    <div class="mb-3"><label>Last Name</label><input type="text" name="last_name" class="form-control"></div>
    <div class="mb-3"><label>Position</label><input type="text" name="position" class="form-control"></div>
    <div class="mb-3"><label>Default Password</label><input type="text" name="default_password" class="form-control"></div>
    <div class="mb-3"><label>Date Created</label><input type="datetime-local" name="dateacc_created" class="form-control"></div>
    <button class="btn btn-success">Save</button>
</form>
@endsection
