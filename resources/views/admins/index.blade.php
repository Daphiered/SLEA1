@extends('layouts.app')

@section('content')
<h1>Admin Profiles</h1>
<a href="{{ route('admins.create') }}" class="btn btn-primary mb-2">Add Admin</a>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Name</th>
        <th>Position</th>
        <th>Action</th>
    </tr>
    @foreach ($admins as $admin)
    <tr>
        <td>{{ $admin->admin_id }}</td>
        <td>{{ $admin->email_address }}</td>
        <td>{{ $admin->name }}</td>
        <td>{{ $admin->position }}</td>
        <td>
            <a href="{{ route('admins.show',$admin->admin_id) }}" class="btn btn-info btn-sm">Show</a>
            <a href="{{ route('admins.edit',$admin->admin_id) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('admins.destroy',$admin->admin_id) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
