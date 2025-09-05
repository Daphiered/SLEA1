@extends('layouts.app')

@section('content')
<h4>Edit Assessor Account</h4>

<form action="{{ route('assessor_accounts.update',$assessor_account) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3"><label>Email (read-only)</label>
        <input type="text" class="form-control" value="{{ $assessor_account->email_address }}" readonly>
    </div>
    <div class="mb-3"><label>Admin ID</label><input type="text" name="admin_id" class="form-control" value="{{ $assessor_account->admin_id }}"></div>
    <div class="mb-3"><label>First Name</label><input type="text" name="first_name" class="form-control" value="{{ $assessor_account->first_name }}"></div>
    <div class="mb-3"><label>Middle Name</label><input type="text" name="middle_name" class="form-control" value="{{ $assessor_account->middle_name }}"></div>
    <div class="mb-3"><label>Last Name</label><input type="text" name="last_name" class="form-control" value="{{ $assessor_account->last_name }}"></div>
    <div class="mb-3"><label>Position</label><input type="text" name="position" class="form-control" value="{{ $assessor_account->position }}"></div>
    <div class="mb-3"><label>Default Password</label><input type="text" name="default_password" class="form-control" value="{{ $assessor_account->default_password }}"></div>
    <div class="mb-3"><label>Date Created</label><input type="datetime-local" name="dateacc_created" class="form-control" value="{{ \Carbon\Carbon::parse($assessor_account->dateacc_created)->format('Y-m-d\TH:i') }}"></div>
    <button class="btn btn-success">Update</button>
</form>
@endsection
