@extends('layouts.app')

@section('content')
<div class="container my-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Assess Queue #{{ $pending->pending_sub_id }}</h3>
    <a href="{{ route('pending.index') }}" class="btn btn-outline-secondary">Back</a>
  </div>

  <div class="card p-3 mb-3">
    <div><strong>Submission ID:</strong> {{ $pending->subrec_id }}</div>
    <div><strong>Student:</strong> {{ $pending->submission->student_id ?? '—' }}</div>
    <div><strong>Title:</strong> {{ $pending->submission->activity_title ?? '—' }}</div>
    <div><strong>Queued:</strong> {{ $pending->pending_queued_date?->format('Y-m-d H:i') }}</div>
  </div>

  @if ($errors->any())
    <div class="alert alert-danger">
      <strong>Fix the following:</strong>
      <ul class="mb-0 mt-2">
        @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
      </ul>
    </div>
  @endif

  <div class="card p-3">
    <form method="POST" action="{{ route('pending.update', $pending) }}">
      @csrf @method('PUT')

      <div class="row g-3">
        <div class="col-md-4">
          <label class="form-label">Action</label>
          <select name="action" class="form-select">
            @foreach (['Queued','Approved','Rejected'] as $opt)
              <option value="{{ $opt }}" @selected(old('action', $pending->action) === $opt)>{{ $opt }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label">Assessor ID</label>
          <input type="text" name="assessor_id" maxlength="15" class="form-control"
                 value="{{ old('assessor_id', $pending->assessor_id) }}">
        </div>
        <div class="col-md-4">
          <label class="form-label">Score / Points</label>
          <input type="number" name="score_points" step="0.01" min="0" max="99.99" class="form-control"
                 value="{{ old('score_points', $pending->score_points) }}">
        </div>
        <div class="col-md-12">
          <label class="form-label">Remarks</label>
          <input type="text" name="remarks" maxlength="255" class="form-control"
                 value="{{ old('remarks', $pending->remarks) }}">
        </div>
      </div>

      <div class="text-end mt-3">
        <button class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</div>
@endsection
