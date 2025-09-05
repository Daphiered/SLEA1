@extends('layouts.app')

@section('content')
<div class="container my-4">
  <h3 class="mb-3">New Rubric Subsection</h3>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0 mt-2">
        @foreach($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('rubric-subsections.store') }}" method="POST" class="card p-3">
    @csrf

    <div class="mb-3">
      <label class="form-label">Section</label>
      <select name="section_id" class="form-select @error('section_id') is-invalid @enderror" required>
        <option value="" disabled {{ old('section_id') ? '' : 'selected' }}>-- Select Section --</option>
        @foreach($sections as $section_id => $title)
          <option value="{{ $section_id }}"
            {{ old('section_id') == $section_id ? 'selected' : '' }}>
            {{ $title }}
          </option>
        @endforeach
      </select>
      @error('section_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Sub Section</label>
      <input name="sub_section" class="form-control @error('sub_section') is-invalid @enderror"
             maxlength="255" value="{{ old('sub_section') }}" required>
      @error('sub_section') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>



    <div class="mb-3">
      <label class="form-label">Evidence Needed</label>
      <input name="evidence_needed" class="form-control @error('evidence_needed') is-invalid @enderror"
             maxlength="255" value="{{ old('evidence_needed') }}">
      @error('evidence_needed') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Order No</label>
      <input type="number" name="order_no" min="1" max="255"
             class="form-control @error('order_no') is-invalid @enderror"
             value="{{ old('order_no', 1) }}" required>
      @error('order_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="text-end">
      <a href="{{ route('rubric-subsections.index') }}" class="btn btn-outline-secondary">Cancel</a>
      <button class="btn btn-primary">Save</button>
    </div>
  </form>
</div>
@endsection
