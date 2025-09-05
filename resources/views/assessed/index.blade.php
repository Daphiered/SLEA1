@extends('layouts.app')

@section('content')
<div class="container my-4">
  @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Finalized Submissions</h3>
    <form action="{{ route('assessed.store') }}" method="POST" class="d-flex gap-2">
      @csrf
      <input type="number" name="pending_sub_id" class="form-control" placeholder="Pending ID" required>
      <input type="text" name="assessor_id" class="form-control" placeholder="Assessor (optional)" maxlength="15">
      <select name="action" class="form-select" required>
        <option value="Approved">Approved</option>
        <option value="Rejected">Rejected</option>
      </select>
      <button class="btn btn-primary">Finalize</button>
    </form>
  </div>

  <div class="table-responsive">
    <table class="table table-sm align-middle">
      <thead>
        <tr>
          <th>#</th>
          <th>Pending ID</th>
          <th>Assessor</th>
          <th>Action</th>
          <th>Student</th>
          <th>Title</th>
          <th>Queued</th>
          <th>Assessed</th>
          <th>Created</th>
        </tr>
      </thead>
      <tbody>
        @forelse($items as $it)
          <tr>
            <td>{{ $it->submission_id }}</td>
            <td>{{ $it->pending_sub_id }}</td>
            <td>{{ $it->assessor_id ?? '—' }}</td>
            <td>
              <span class="badge @if($it->action==='Approved') text-bg-success @else text-bg-danger @endif">
                {{ $it->action }}
              </span>
            </td>
            <td>{{ $it->pending->submission->student_id ?? '—' }}</td>
            <td class="text-truncate" style="max-width:260px">
              {{ $it->pending->submission->activity_title ?? '—' }}
            </td>
            <td>{{ $it->pending->pending_queued_date?->format('Y-m-d H:i') }}</td>
            <td>{{ $it->pending->assessed_date?->format('Y-m-d H:i') ?? '—' }}</td>
            <td>{{ $it->created_at?->format('Y-m-d H:i') }}</td>
          </tr>
        @empty
          <tr><td colspan="9" class="text-center text-muted">No finalized submissions.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{ $items->links() }}
</div>
@endsection
