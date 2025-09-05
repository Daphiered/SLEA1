@extends('layouts.app')

@section('content')
<div class="container my-4">
  @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Approval of Accounts</h3>
    <form method="GET" class="d-flex gap-2">
      <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Search student/program/email">
      <button class="btn btn-outline-secondary">Search</button>
    </form>
  </div>

  <div class="table-responsive">
    <table class="table table-sm align-middle">
      <thead>
        <tr>
          <th>Student ID</th>
          <th>Program</th>
          <th>Year Level</th>
          <th>Status</th>
          <th>Admin</th>
          <th>Action Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($rows as $r)
          <tr>
            <td>{{ $r->student_id }}</td>
            <td>{{ $r->program }}</td>
            <td>{{ $r->year_level }}</td>
            <td>
              @php $status = $r->action ?? 'Pending'; @endphp
              <span class="badge
                @if($status==='Approved') text-bg-success
                @elseif($status==='Rejected') text-bg-danger
                @else text-bg-secondary @endif">
                {{ $status }}
              </span>
            </td>
            <td>{{ $r->admin_id ?? '—' }}</td>
            <td>{{ $r->action_date ? \Carbon\Carbon::parse($r->action_date)->format('Y-m-d H:i') : '—' }}</td>
            <td class="d-flex gap-2">
              <form method="POST" action="{{ route('approvals.approve', $r->student_id) }}">
                @csrf
                <button class="btn btn-sm btn-outline-success"
                        @disabled(($r->action ?? '')==='Approved')>Approve</button>
              </form>
              <form method="POST" action="{{ route('approvals.reject', $r->student_id) }}">
                @csrf
                <button class="btn btn-sm btn-outline-danger"
                        @disabled(($r->action ?? '')==='Rejected')>Reject</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="7" class="text-center text-muted">No students found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{ $rows->links() }}
</div>
@endsection
