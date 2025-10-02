@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Organizations</h1>
        <a href="{{ route('organizations.create') }}" class="btn btn-primary">Add Organization</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Combined Name</th>
                    <th>Cluster</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($organizations as $org)
                <tr>
                    <td>{{ $org->id }}</td>
                    <td>{{ $org->name }}</td>
                    <td>{{ $org->combined_name }}</td>
                    <td>{{ $org->cluster->name ?? 'None' }}</td>
                    <td>{{ $org->description }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('organizations.show', $org->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('organizations.edit', $org->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('organizations.destroy', $org->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this organization?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
