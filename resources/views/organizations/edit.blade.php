@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Organization</h1>

    <form action="{{ route('organizations.update', $organization->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="cluster_id" class="form-label">Cluster</label>
            <select name="cluster_id" id="cluster_id" class="form-control" required>
                <option value="">Select Cluster</option>
                @foreach($clusters as $cluster)
                    <option value="{{ $cluster->id }}" {{ $organization->cluster_id == $cluster->id ? 'selected' : '' }}>
                        {{ $cluster->name }}
                    </option>
                @endforeach
            </select>
            @error('cluster_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Organization Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $organization->name) }}" required>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $organization->description) }}</textarea>
            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('organizations.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
