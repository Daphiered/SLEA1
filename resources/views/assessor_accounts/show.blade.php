@extends('layouts.app')

@section('content')
<h4>Assessor Account Details</h4>
<ul class="list-group">
    <li class="list-group-item"><strong>Email:</strong> {{ $assessor_account->email_address }}</li>
    <li class="list-group-item"><strong>Name:</strong> {{ $assessor_account->first_name }} {{ $assessor_account->last_name }}</li>
    <li class="list-group-item"><strong>Position:</strong> {{ $assessor_account->position }}</li>
    <li class="list-group-item"><strong>Date Created:</strong> {{ $assessor_account->dateacc_created }}</li>
</ul>
<a href="{{ route('assessor_accounts.index') }}" class="btn btn-secondary mt-3">Back</a>
@endsection
