@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Year Level Updates</h2>
    <ul>
        @foreach ($levels as $level)
            <li>{{ $level->student_id }} - {{ $level->year_level }}</li>
        @endforeach
    </ul>
</div>
@endsection
