@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Assessor Accounts</h4>
                <a href="{{ route('assessor_accounts.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> New Assessor Account
                </a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($assessor_accounts->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Date Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assessor_accounts as $account)
                                <tr>
                                    <td><strong>{{ $account->email_address }}</strong></td>
                                    <td>{{ $account->first_name }} {{ $account->last_name }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $account->position }}</span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($account->dateacc_created)->format('M j, Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('assessor_accounts.show', $account) }}" 
                                               class="btn btn-info btn-sm" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('assessor_accounts.edit', $account) }}" 
                                               class="btn btn-warning btn-sm" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('assessor_accounts.destroy', $account) }}" 
                                                  method="POST" style="display:inline;">
                                                @csrf 
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" 
                                                        onclick="return confirm('Are you sure you want to delete this assessor account?')"
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
                            Showing {{ $assessor_accounts->count() }} assessor account(s)
                        </p>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-people display-1 text-muted"></i>
                        <h5 class="mt-3">No Assessor Accounts Found</h5>
                        <p class="text-muted">Get started by creating your first assessor account.</p>
                        <a href="{{ route('assessor_accounts.create') }}" class="btn btn-primary">
                            Create First Account
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
