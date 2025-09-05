@extends('layouts.app')
@section('content')
<div class="container my-4">
  <h3 class="mb-3">New Section</h3>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0 mt-2">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
  @endif

  <form action="{{ route('rubric-sections.store') }}" method="POST" class="card p-3">
    @csrf

    <div class="mb-3">
      <label class="form-label">Category</label>
      <select name="category_id" class="form-select" required>
        <option value="" disabled selected>Select category</option>
        @foreach($categories as $c)
          <option value="{{ $c->category_id }}">{{ $c->order_no }} — {{ $c->title }}</option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Title</label>
      <input name="title" class="form-control" maxlength="255" value="{{ old('title') }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Order No</label>
      <input name="order_no" type="number" min="1" max="255" class="form-control" value="{{ old('order_no',1) }}" required>
    </div>

    <div class="text-end">
      <a href="{{ route('rubric-sections.index') }}" class="btn btn-outline-secondary">Cancel</a>
      <button class="btn btn-primary">Save</button>
    </div>
  </form>
</div>
@endsection
