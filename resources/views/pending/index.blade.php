@extends('layouts.app')

@section('content')
<div class="container my-4">
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Pending Submissions</h3>
    <a href="{{ route('pending.create') }}" class="btn btn-primary">Queue Submission</a>
  </div>

  <form method="GET" class="mb-3">
    <div class="row g-2">
      <div class="col-md-3">
        <select name="action" class="form-select">
          <option value="">All Actions</option>
          @foreach(['Queued','Approved','Rejected'] as $opt)
            <option value="{{ $opt }}" @selected(request('action')===$opt)>{{ $opt }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-3">
        <input type="text" name="assessor_id" value="{{ $assessor }}" class="form-control" placeholder="Assessor ID">
      </div>
      <div class="col-md-3">
        <input type="text" name="student_id" value="{{ $student_id }}" class="form-control" placeholder="Student ID">
      </div>
      <div class="col-md-2">
        <button class="btn btn-outline-secondary w-100">Filter</button>
      </div>
    </div>
  </form>

  <div class="table-responsive">
    <table class="table table-sm align-middle">
      <thead>
        <tr>
          <th>#</th>
          <th>Subrec</th>
          <th>Student</th>
          <th>Title</th>
          <th>Action</th>
          <th>Score</th>
          <th>Assessor</th>
          <th>Queued</th>
          <th>Assessed</th>
          <th>Edit</th>
        </tr>
      </thead>
      <tbody>
        @forelse($rows as $r)
          <tr>
            <td>{{ $r->pending_sub_id }}</td>
            <td>{{ $r->subrec_id }}</td>
            <td>{{ $r->submission->student_id ?? '—' }}</td>
            <td class="text-truncate" style="max-width:260px">{{ $r->submission->activity_title ?? '—' }}</td>
            <td>
              <span class="badge
                @if($r->action==='Approved') text-bg-success
                @elseif($r->action==='Rejected') text-bg-danger
                @else text-bg-secondary @endif">
                {{ $r->action }}
              </span>
            </td>
            <td>{{ $r->score_points ?? '—' }}</td>
            <td>{{ $r->assessor_id ?? '—' }}</td>
            <td>{{ $r->pending_queued_date?->format('Y-m-d H:i') }}</td>
            <td>{{ $r->assessed_date?->format('Y-m-d H:i') ?? '—' }}</td>
            <td><a href="{{ route('pending.edit', $r) }}" class="btn btn-sm btn-outline-primary">Assess</a></td>
          </tr>
        @empty
          <tr><td colspan="10" class="text-center text-muted">No pending items.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{ $rows->links() }}
</div>
@endsection
