@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Assessor Profiles</h4>
                <a href="{{ route('assessor_profiles.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Create New Profile
                </a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($assessor_profiles->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Assessor ID</th>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Picture</th>
                                    <th>Date Upload</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assessor_profiles as $profile)
                                <tr>
                                    <td><strong>{{ $profile->assessor_id }}</strong></td>
                                    <td>{{ $profile->email_address }}</td>
                                    <td>
                                        @if($profile->account)
                                            {{ $profile->account->first_name }} {{ $profile->account->last_name }}
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($profile->picture_path)
                                            <span class="badge bg-success">Has Picture</span>
                                        @else
                                            <span class="badge bg-secondary">No Picture</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($profile->date_upload)->format('M j, Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('assessor_profiles.show', $profile) }}" 
                                               class="btn btn-info btn-sm" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('assessor_profiles.edit', $profile) }}" 
                                               class="btn btn-warning btn-sm" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('assessor_profiles.destroy', $profile) }}" 
                                                  method="POST" style="display:inline;">
                                                @csrf 
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" 
                                                        onclick="return confirm('Are you sure you want to delete this profile?')"
                                                        title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-3">
                        <p class="text-muted">
                            Showing {{ $assessor_profiles->count() }} assessor profile(s)
                        </p>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-people display-1 text-muted"></i>
                        <h5 class="mt-3">No Assessor Profiles Found</h5>
                        <p class="text-muted">Get started by creating your first assessor profile.</p>
                        <a href="{{ route('assessor_profiles.create') }}" class="btn btn-primary">
                            Create First Profile
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
