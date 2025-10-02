@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3 class="mb-0">Submission Oversights</h3>
  <a href="{{ route('submission_oversights.create') }}" class="btn btn-primary">New Oversight</a>
</div>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
  <table class="table table-striped align-middle">
    <thead>
      <tr>
        <th>#</th>
        <th>Pending Sub ID</th>
        <th>Admin</th>
        <th>Status</th>
        <th>Flag</th>
        <th>Action</th>
        <th>Updated</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($oversights as $o)
        <tr>
          <td>{{ $o->sub_oversight_id }}</td>
          <td>{{ $o->pending_sub_id }}</td>
          <td>{{ optional($o->admin)->admin_id ?? '—' }}</td>
          <td><span class="badge bg-info">{{ $o->submission_status }}</span></td>
          <td>{{ $o->flag ?? '—' }}</td>
          <td>{{ $o->action ?? '—' }}</td>
          <td>{{ optional($o->updated_at)->format('Y-m-d H:i') }}</td>
          <td>
            <div class="btn-group btn-group-sm">
              <a class="btn btn-outline-secondary" href="{{ route('submission_oversights.show', $o->sub_oversight_id) }}">View</a>
              <a class="btn btn-outline-primary" href="{{ route('submission_oversights.edit', $o->sub_oversight_id) }}">Edit</a>
              <form action="{{ route('submission_oversights.destroy', $o->sub_oversight_id) }}" method="POST" onsubmit="return confirm('Delete this oversight?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger" type="submit">Delete</button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr><td colspan="8" class="text-center text-muted">No records yet.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection



