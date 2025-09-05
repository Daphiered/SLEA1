@extends('layouts.app')

@section('content')
<div class="container my-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Queue Submission</h3>
    <a href="{{ route('pending.index') }}" class="btn btn-outline-secondary">Back</a>
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
    <form method="POST" action="{{ route('pending.store') }}">
      @csrf

      <div class="mb-3">
        <label class="form-label">Submission ID (subrec_id)</label>
        <input type="number" name="subrec_id" class="form-control @error('subrec_id') is-invalid @enderror"
               value="{{ old('subrec_id', $subrec_id) }}" required>
        @error('subrec_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        @if($sub)
          <div class="form-text">
            Student: <b>{{ $sub->student_id }}</b> · Title: <b>{{ $sub->activity_title }}</b> ({{ optional($sub->activity_date)->format('Y-m-d') }})
          </div>
        @endif
      </div>

      <div class="mb-3">
        <label class="form-label">Assessor ID (optional)</label>
        <input type="text" name="assessor_id" maxlength="15" class="form-control"
               value="{{ old('assessor_id') }}">
      </div>

      <div class="mb-3">
        <label class="form-label">Remarks (optional)</label>
        <input type="text" name="remarks" maxlength="255" class="form-control" value="{{ old('remarks') }}">
      </div>

      <div class="text-end">
        <button class="btn btn-primary">Queue</button>
      </div>
    </form>
  </div>
</div>
@endsection
