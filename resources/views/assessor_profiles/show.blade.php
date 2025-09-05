@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Assessor Profile Details</h4>
                <div>
                    <a href="{{ route('assessor_profiles.edit', $assessor_profile) }}" class="btn btn-warning btn-sm">Edit</a>
                    <a href="{{ route('assessor_profiles.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-muted">Profile Information</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Assessor ID:</strong></td>
                                <td>{{ $assessor_profile->assessor_id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email Address:</strong></td>
                                <td>{{ $assessor_profile->email_address }}</td>
                            </tr>
                            <tr>
                                <td><strong>Date Upload:</strong></td>
                                <td>{{ \Carbon\Carbon::parse($assessor_profile->date_upload)->format('F j, Y') }}</td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="col-md-6">
                        <h6 class="text-muted">Account Information</h6>
                        @if($assessor_profile->account)
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Name:</strong></td>
                                    <td>{{ $assessor_profile->account->first_name }} {{ $assessor_profile->account->last_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Position:</strong></td>
                                    <td>{{ $assessor_profile->account->position }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Account Created:</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($assessor_profile->account->dateacc_created)->format('F j, Y') }}</td>
                                </tr>
                            </table>
                        @else
                            <p class="text-muted">No account information available</p>
                        @endif
                    </div>
                </div>

                @if($assessor_profile->picture_path)
                    <div class="mt-4">
                        <h6 class="text-muted">Profile Picture</h6>
                        <div class="text-center">
                            @if(Str::endsWith(strtolower($assessor_profile->picture_path), ['.jpg', '.jpeg', '.png', '.gif']))
                                <img src="{{ asset('storage/' . $assessor_profile->picture_path) }}" 
                                     alt="Profile Picture" class="img-fluid rounded" style="max-height: 300px;">
                            @else
                                <div class="alert alert-info">
                                    <strong>Picture Path:</strong> {{ $assessor_profile->picture_path }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <div class="mt-4">
                    <form action="{{ route('assessor_profiles.destroy', $assessor_profile) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this profile?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

