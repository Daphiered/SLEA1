@extends('layouts.app')

@section('content')
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="m-0">Log In Records</h1>
    <a href="{{ route('log-in.create') }}" class="btn btn-primary">New Login</a>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
      <thead class="table-dark">
        <tr>
          <th>Log ID</th>
          <th>Email</th>
          <th>User Role</th>
          <th>Login Datetime</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @forelse($logins as $row)
          <tr>
            <td>{{ $row->log_id }}</td>
            <td>{{ $row->email_address }}</td>
            <td>{{ $row->user_role }}</td>
            <td>{{ optional($row->login_datetime)->format('Y-m-d H:i') }}</td>
            <td class="text-nowrap">
              <a class="btn btn-sm btn-outline-secondary" href="{{ route('log-in.show', $row->log_id) }}">View</a>
              <form action="{{ route('log-in.destroy', $row->log_id) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Delete this record?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="5" class="text-center">No login records yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{ $logins->links() }}
</div>
@endsection
