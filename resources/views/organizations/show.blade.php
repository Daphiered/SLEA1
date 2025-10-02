@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Organization Details</h1>
    <p><strong>Cluster:</strong> {{ $organization->cluster }}</p>
    <p><strong>Name:</strong> {{ $organization->name }}</p>

    <a href="{{ route('organizations.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
