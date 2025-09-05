@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Academic Information</h1>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Student ID</th>
                <th>Email</th>
                <th>College</th>
                <th>Program</th>
                <th>Major</th>
                <th>Year Level</th>
                <th>Graduate Year</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($academics as $academic)
                <tr>
                    <td>{{ $academic->student_id }}</td>
                    <td>{{ $academic->email_address }}</td>
                    <td>{{ $academic->college }}</td>
                    <td>{{ $academic->program }}</td>
                    <td>{{ $academic->major }}</td>
                    <td>{{ $academic->year_level }}</td>
                    <td>{{ $academic->graduate_year }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
