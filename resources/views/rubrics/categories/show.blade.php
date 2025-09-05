@extends('layouts.app')
@section('title','View Category')

@section('content')
<div class="container my-4">
  <div class="card">
    <div class="card-header">
      <h3 class="mb-0">Rubric Category Details</h3>
    </div>
    <div class="card-body">
      <dl class="row">
        <dt class="col-sm-3">ID</dt>
        <dd class="col-sm-9">{{ $category->category_id }}</dd>
        
        <dt class="col-sm-3">Title</dt>
        <dd class="col-sm-9">{{ $category->title }}</dd>
        
        <dt class="col-sm-3">Max Points</dt>
        <dd class="col-sm-9"><span class="badge bg-info">{{ number_format($category->max_points, 2) }}</span></dd>
        
        <dt class="col-sm-3">Order</dt>
        <dd class="col-sm-9">{{ $category->order_no }}</dd>
        
        <dt class="col-sm-3">Created</dt>
        <dd class="col-sm-9">{{ $category->created_at->format('M d, Y H:i') }}</dd>
        
        <dt class="col-sm-3">Updated</dt>
        <dd class="col-sm-9">{{ $category->updated_at->format('M d, Y H:i') }}</dd>
      </dl>
    </div>
    <div class="card-footer">
      <a href="{{ route('rubric-categories.edit', $category) }}" class="btn btn-warning">Edit</a>
      <a href="{{ route('rubric-categories.index') }}" class="btn btn-secondary">Back</a>
    </div>
  </div>
</div>
@endsection




