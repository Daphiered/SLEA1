@extends('layouts.app')
@section('content')
<div class="container my-4">
  <h3 class="mb-3">Edit Category</h3>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0 mt-2">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
  @endif

  <form action="{{ route('rubric-categories.update', $category) }}" method="POST" class="card p-3">
    @csrf @method('PUT')
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input name="title" class="form-control" maxlength="50" value="{{ old('title',$category->title) }}" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Max Points</label>
      <input name="max_points" type="number" step="0.01" min="0" max="999.99" 
             class="form-control" value="{{ old('max_points',$category->max_points) }}" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Order No</label>
      <input name="order_no" type="number" min="1" max="255" class="form-control"
             value="{{ old('order_no',$category->order_no) }}" required>
    </div>
    <div class="text-end">
      <a href="{{ route('rubric-categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
      <button class="btn btn-primary">Update</button>
    </div>
  </form>
</div>
@endsection
