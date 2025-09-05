@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Password Change Details</h4>
                <div>
                    <a href="{{ route('change_assessor_passwords.edit', $change_assessor_password) }}" class="btn btn-warning btn-sm">Edit</a>
                    <a href="{{ route('change_assessor_passwords.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-muted">Password Change Information</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Change ID:</strong></td>
                                <td>{{ $change_assessor_password->change_pass_id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email Address:</strong></td>
                                <td>{{ $change_assessor_password->email_address }}</td>
                            </tr>
                            <tr>
                                <td><strong>Date Changed:</strong></td>
                                <td>{{ \Carbon\Carbon::parse($change_assessor_password->date_pass_changed)->format('F j, Y') }}</td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="col-md-6">
                        <h6 class="text-muted">Assessor Information</h6>
                        @if($change_assessor_password->account)
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Name:</strong></td>
                                    <td>{{ $change_assessor_password->account->first_name }} {{ $change_assessor_password->account->last_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Position:</strong></td>
                                    <td>{{ $change_assessor_password->account->position }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Account Created:</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($change_assessor_password->account->dateacc_created)->format('F j, Y') }}</td>
                                </tr>
                            </table>
                        @else
                            <p class="text-muted">No account information available</p>
                        @endif
                    </div>
                </div>

                <div class="mt-4">
                    <h6 class="text-muted">Password Details</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card bg-warning text-dark">
                                <div class="card-header">
                                    <strong>Old Password Hash</strong>
                                </div>
                                <div class="card-body">
                                    <code class="text-break">{{ $change_assessor_password->old_password_hashed }}</code>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-success text-white">
                                <div class="card-header">
                                    <strong>New Password Hash</strong>
                                </div>
                                <div class="card-body">
                                    <code class="text-break">{{ $change_assessor_password->new_password_hashed }}</code>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <form action="{{ route('change_assessor_passwords.destroy', $change_assessor_password) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this password change record?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Record</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection






