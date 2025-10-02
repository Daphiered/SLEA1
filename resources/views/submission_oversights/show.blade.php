@extends('layouts.app')

@section('content')
<h3 class="mb-3">Submission Oversight #{{ $oversight->sub_oversight_id }}</h3>

<div class="card">
  <div class="card-body">
    <dl class="row mb-0">
      <dt class="col-sm-3">Pending Submission ID</dt>
      <dd class="col-sm-9">{{ $oversight->pending_sub_id }}</dd>

      <dt class="col-sm-3">Admin</dt>
      <dd class="col-sm-9">{{ optional($oversight->admin)->admin_id ?? '—' }}</dd>

      <dt class="col-sm-3">Status</dt>
      <dd class="col-sm-9"><span class="badge bg-info">{{ $oversight->submission_status }}</span></dd>

      <dt class="col-sm-3">Flag</dt>
      <dd class="col-sm-9">{{ $oversight->flag ?? '—' }}</dd>

      <dt class="col-sm-3">Action</dt>
      <dd class="col-sm-9">{{ $oversight->action ?? '—' }}</dd>

      <dt class="col-sm-3">Updated</dt>
      <dd class="col-sm-9">{{ optional($oversight->updated_at)->format('Y-m-d H:i') }}</dd>
    </dl>
  </div>
</div>

<div class="mt-3">
  <a href="{{ route('submission_oversights.edit', $oversight->sub_oversight_id) }}" class="btn btn-primary">Edit</a>
  <a href="{{ route('submission_oversights.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection



