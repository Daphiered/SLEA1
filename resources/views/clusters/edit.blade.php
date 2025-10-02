@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Cluster</h1>

    <form action="{{ route('clusters.update', $cluster->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Cluster Name</label>
            <input type="text" name="name" class="form-control" value="{{ $cluster->name }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
