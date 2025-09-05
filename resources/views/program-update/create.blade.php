@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Program Update</h1>

    <form action="{{ route('update-programs.store') }}" method="POST">
        @csrf

        @include('update_programs.form')

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('update-programs.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
