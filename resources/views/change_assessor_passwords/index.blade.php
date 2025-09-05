@extends('layouts.app')

@section('content')
<a href="{{ route('change_assessor_passwords.create') }}" class="btn btn-primary mb-3">New Password Change</a>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Old Password</th>
        <th>New Password</th>
        <th>Date Changed</th>
        <th>Options</th>
    </tr>
    @foreach($password_changes as $change)
    <tr>
        <td>{{ $change->change_pass_id }}</td>
        <td>{{ $change->email_address }}</td>
        <td>{{ $change->old_password_hashed }}</td>
        <td>{{ $change->new_password_hashed }}</td>
        <td>{{ $change->date_pass_changed }}</td>
        <td>
            <a href="{{ route('change_assessor_passwords.show',$change) }}" class="btn btn-info btn-sm">View</a>
            <a href="{{ route('change_assessor_passwords.edit',$change) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('change_assessor_passwords.destroy',$change) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
