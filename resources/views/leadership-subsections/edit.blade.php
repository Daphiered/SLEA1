@extends('layouts.app')
@section('title','Edit Leadership Position')

@section('content')
<div class="container my-4">
  <h3 class="mb-3">Edit Leadership Position #{{ $leadership->leadership_id }}</h3>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0 mt-2">
        @foreach($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('leadership-subsections.update',$leadership) }}" class="card p-3">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label">Subsection</label>
      <select name="sub_items" class="form-select @error('sub_items') is-invalid @enderror" required>
        <option value="" disabled>-- Select Subsection --</option>
        @foreach($subsections as $sub_items => $sub_section)
          <option value="{{ $sub_items }}"
            {{ old('sub_items', $leadership->sub_items) == $sub_items ? 'selected' : '' }}>
            {{ $sub_section }}
          </option>
        @endforeach
      </select>
      @error('sub_items') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Position</label>
      <input name="position" class="form-control @error('position') is-invalid @enderror"
             maxlength="255" value="{{ old('position', $leadership->position) }}" required>
      @error('position') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Points</label>
      <input type="number" name="points" step="0.01" min="-99.99" max="99.99"
             class="form-control @error('points') is-invalid @enderror"
             value="{{ old('points', $leadership->points) }}" required>
      @error('points') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Position Order</label>
      <input type="number" name="position_order" min="1" max="255"
             class="form-control @error('position_order') is-invalid @enderror"
             value="{{ old('position_order', $leadership->position_order) }}" required>
      @error('position_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="text-end">
      <a href="{{ route('leadership-subsections.index') }}" class="btn btn-outline-secondary">Cancel</a>
      <button class="btn btn-primary">Update</button>
    </div>
  </form>
</div>
@endsection

