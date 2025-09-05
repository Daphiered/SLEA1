@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Program Updates</h1>
    <a href="{{ route('update-programs.create') }}" class="btn btn-primary mb-3">Add New Update</a>

    @if($updates->isEmpty())
        <p>No program updates found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Old Program</th>
                    <th>New Program</th>
                    <th>Date Changed</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($updates as $update)
                    <tr>
                        <td>{{ $update->student_id }}</td>
                        <td>{{ $update->old_program }}</td>
                        <td>{{ $update->new_program }}</td>
                        <td>{{ $update->date_prog_changed }}</td>
                        <td>
                            <a href="{{ route('update-programs.edit', $update->updateprog_id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('update-programs.destroy', $update->updateprog_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <a href="{{ route('update-programs.create') }}" class="btn btn-primary">Add New Update</a>

            </tbody>
        </table>
    @endif
</div>
@endsection
