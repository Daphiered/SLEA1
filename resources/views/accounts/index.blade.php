@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="bi bi-people"></i> Manage Accounts</h1>
    <a href="{{ route('accounts.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add New Account
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Email Address</th>
                        <th>Admin</th>
                        <th>User Type</th>
                        <th>Account Status</th>
                        <th>Last Login</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($accounts as $account)
                    <tr>
                        <td>{{ $account->id }}</td>
                        <td>{{ $account->email_address }}</td>
                        <td>
                            @if($account->admin)
                                {{ $account->admin->name ?? 'N/A' }}
                            @else
                                <span class="text-muted">No Admin</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-info">{{ $account->user_type ?? 'N/A' }}</span>
                        </td>
                        <td>
                            @if($account->account_status == 'active')
                                <span class="badge bg-success">Active</span>
                            @elseif($account->account_status == 'inactive')
                                <span class="badge bg-secondary">Inactive</span>
                            @elseif($account->account_status == 'suspended')
                                <span class="badge bg-danger">Suspended</span>
                            @else
                                <span class="badge bg-warning">{{ $account->account_status ?? 'Unknown' }}</span>
                            @endif
                        </td>
                        <td>
                            @if($account->last_login)
                                {{ \Carbon\Carbon::parse($account->last_login)->format('M d, Y H:i') }}
                            @else
                                <span class="text-muted">Never</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('accounts.show', $account->id) }}" 
                                   class="btn btn-info btn-sm" 
                                   title="View Details">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('accounts.edit', $account->id) }}" 
                                   class="btn btn-warning btn-sm" 
                                   title="Edit Account">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('accounts.destroy', $account->id) }}" 
                                      method="POST" 
                                      style="display:inline;"
                                      onsubmit="return confirm('Are you sure you want to delete this account? This action cannot be undone.')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Account">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="bi bi-inbox display-4 d-block mb-2"></i>
                            No accounts found. <a href="{{ route('accounts.create') }}">Create your first account</a>.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($accounts->count() > 0)
<div class="mt-3">
    <small class="text-muted">
        Showing {{ $accounts->count() }} account(s)
    </small>
</div>
@endif
@endsection


