@extends('layouts.app')

@section('content')
<h3 class="mb-3">Edit Submission Oversight</h3>

@if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
  </div>
@endif

<form action="{{ route('submission_oversights.update', $oversight->sub_oversight_id) }}" method="POST" class="card p-3">
  @csrf
  @method('PUT')
  <div class="row g-3">
    <div class="col-md-4">
      <label class="form-label">Pending Submission ID</label>
      <input type="number" name="pending_sub_id" class="form-control" value="{{ old('pending_sub_id', $oversight->pending_sub_id) }}" required>
    </div>
    <div class="col-md-4">
      <label class="form-label">Admin ID</label>
      <input type="text" name="admin_id" maxlength="15" class="form-control" value="{{ old('admin_id', $oversight->admin_id) }}" required>
    </div>
    <div class="col-md-4">
      <label class="form-label">Status</label>
      <input type="text" name="submission_status" maxlength="20" class="form-control" value="{{ old('submission_status', $oversight->submission_status) }}" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Flag</label>
      <input type="text" name="flag" maxlength="20" class="form-control" value="{{ old('flag', $oversight->flag) }}">
    </div>
    <div class="col-md-6">
      <label class="form-label">Action</label>
      <input type="text" name="action" maxlength="20" class="form-control" value="{{ old('action', $oversight->action) }}">
    </div>
  </div>
  <div class="text-end mt-3">
    <a href="{{ route('submission_oversights.index') }}" class="btn btn-secondary">Cancel</a>
    <button class="btn btn-primary" type="submit">Update</button>
  </div>
</form>
@endsection


