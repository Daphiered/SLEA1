@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Profile List</h1>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Profile ID</th>
                <th>Student ID</th>
                <th>Picture Path</th>
                <th>Upload Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($profiles as $profile)
                <tr>
                    <td>{{ $profile->profile_id }}</td>
                    <td>{{ $profile->student_id }}</td>
                    <td>{{ $profile->profile_picture_path }}</td>
                    <td>{{ $profile->date_upload_profile }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No profiles found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
