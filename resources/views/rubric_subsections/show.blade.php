@extends('layouts.app')
@section('title','View Subsection')

@section('content')
<div class="container my-4">
  <div class="card">
    <div class="card-header">
      <h3 class="mb-0">Rubric Subsection Details</h3>
    </div>
    <div class="card-body">
      <dl class="row">
        <dt class="col-sm-3">ID</dt>
        <dd class="col-sm-9">{{ $sub->sub_items }}</dd>
        
        <dt class="col-sm-3">Section</dt>
        <dd class="col-sm-9">{{ $sub->section->title ?? 'N/A' }}</dd>
        
        <dt class="col-sm-3">Sub Section</dt>
        <dd class="col-sm-9">{{ $sub->sub_section }}</dd>
        
        <dt class="col-sm-3">Evidence Needed</dt>
        <dd class="col-sm-9">{{ $sub->evidence_needed ?: '—' }}</dd>
        
        <dt class="col-sm-3">Order</dt>
        <dd class="col-sm-9">{{ $sub->order_no }}</dd>
      </dl>
    </div>
    <div class="card-footer">
      <a href="{{ route('rubric-subsections.edit',$sub) }}" class="btn btn-warning">Edit</a>
      <a href="{{ route('rubric-subsections.index') }}" class="btn btn-secondary">Back</a>
    </div>
  </div>
</div>
@endsection
