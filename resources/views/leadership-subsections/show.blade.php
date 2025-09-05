@extends('layouts.app')
@section('title','View Leadership Position')

@section('content')
<div class="container my-4">
  <div class="card">
    <div class="card-header">
      <h3 class="mb-0">Leadership Position Details</h3>
    </div>
    <div class="card-body">
      <dl class="row">
        <dt class="col-sm-3">ID</dt>
        <dd class="col-sm-9">{{ $leadership->leadership_id }}</dd>
        
        <dt class="col-sm-3">Category</dt>
        <dd class="col-sm-9">
          <span class="badge bg-primary">{{ $leadership->subsection->section->category->title ?? 'N/A' }}</span>
        </dd>
        
        <dt class="col-sm-3">Section</dt>
        <dd class="col-sm-9">
          <span class="badge bg-secondary">{{ $leadership->subsection->section->title ?? 'N/A' }}</span>
        </dd>
        
        <dt class="col-sm-3">Subsection</dt>
        <dd class="col-sm-9">
          <strong>{{ $leadership->subsection->sub_section ?? 'N/A' }}</strong>
        </dd>
        
        <dt class="col-sm-3">Position</dt>
        <dd class="col-sm-9">{{ $leadership->position }}</dd>
        
        <dt class="col-sm-3">Points</dt>
        <dd class="col-sm-9">
          <span class="badge {{ $leadership->points < 0 ? 'bg-danger' : 'bg-info' }}">
            {{ number_format($leadership->points, 2) }}
          </span>
        </dd>
        
        <dt class="col-sm-3">Position Order</dt>
        <dd class="col-sm-9">{{ $leadership->position_order }}</dd>
        
        <dt class="col-sm-3">Created</dt>
        <dd class="col-sm-9">{{ $leadership->created_at->format('M d, Y H:i') }}</dd>
        
        <dt class="col-sm-3">Updated</dt>
        <dd class="col-sm-9">{{ $leadership->updated_at->format('M d, Y H:i') }}</dd>
      </dl>
    </div>
    <div class="card-footer">
      <a href="{{ route('leadership-subsections.edit', $leadership) }}" class="btn btn-warning">Edit</a>
      <a href="{{ route('leadership-subsections.index') }}" class="btn btn-secondary">Back</a>
    </div>
  </div>
</div>
@endsection
