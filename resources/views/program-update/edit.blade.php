@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Program Update</h1>

    <form action="{{ route('update-programs.update', $update->updateprog_id) }}" method="POST">
        @csrf
        @method('PUT')

        @include('update_programs.form', ['update' => $update])

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('update-programs.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
