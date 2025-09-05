@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="mb-3">Login #{{ $login->log_id }}</h1>

  <div class="card">
    <div class="card-body">
      <dl class="row">
        <dt class="col-sm-3">Email</dt>
        <dd class="col-sm-9">{{ $login->email_address }}</dd>

        <dt class="col-sm-3">User Role</dt>
        <dd class="col-sm-9">{{ $login->user_role }}</dd>

        <dt class="col-sm-3">Login Datetime</dt>
        <dd class="col-sm-9">{{ optional($login->login_datetime)->format('Y-m-d H:i') }}</dd>

        <dt class="col-sm-3">Created</dt>
        <dd class="col-sm-9">{{ $login->created_at }}</dd>
      </dl>
    </div>
  </div>

  <div class="mt-3">
    <a href="{{ route('log-in.index') }}" class="btn btn-secondary">Back</a>
  </div>
  <h2 class="mt-4">Recent System Logs</h2>
<table class="table table-sm">
  <thead><tr><th>#</th><th>Activity</th><th>Description</th><th>When</th></tr></thead>
  <tbody>
    @forelse($login->logs as $lg)
      <tr>
        <td>{{ $lg->logs_id }}</td>
        <td>{{ $lg->activity_type }}</td>
        <td>{{ $lg->description }}</td>
        <td>{{ $lg->created_at?->format('Y-m-d H:i') }}</td>
      </tr>
    @empty
      <tr><td colspan="4" class="text-center">No logs for this login yet.</td></tr>
    @endforelse
  </tbody>
</table>

</div>
@endsection
