@extends('layouts.app')

@section('content')
<h1>Admin Detail</h1>
<ul class="list-group">
    <li class="list-group-item"><b>ID:</b> {{ $admin->admin_id }}</li>
    <li class="list-group-item"><b>Email:</b> {{ $admin->email_address }}</li>
    <li class="list-group-item"><b>Name:</b> {{ $admin->name }}</li>
    <li class="list-group-item"><b>Position:</b> {{ $admin->position }}</li>
</ul>
<a href="{{ route('admins.index') }}" class="btn btn-secondary mt-2">Back</a>
@endsection
