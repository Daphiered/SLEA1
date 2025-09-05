@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="mb-3">New Login Record</h1>

  <form action="{{ route('log-in.store') }}" method="POST" class="row g-3">
    @csrf

    <div class="col-md-6">
      <label class="form-label">Email Address</label>
      <input type="email" name="email_address" class="form-control" value="{{ old('email_address') }}" required>
      @error('email_address') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
      <label class="form-label">User Role</label>
      <select name="user_role" class="form-select">
        <option value="">— Select —</option>
        @foreach(['admin','assessor','student'] as $role)
          <option value="{{ $role }}" @selected(old('user_role')===$role)>{{ ucfirst($role) }}</option>
        @endforeach
      </select>
      @error('user_role') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
      <label class="form-label">Login Datetime</label>
      <input type="datetime-local" name="login_datetime" class="form-control"
             value="{{ old('login_datetime') }}">
      <div class="form-text">Leave empty to use current time.</div>
      @error('login_datetime') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
      <button class="btn btn-primary">Save</button>
      <a href="{{ route('log-in.index') }}" class="btn btn-light">Cancel</a>
    </div>
  </form>
</div>
@endsection
