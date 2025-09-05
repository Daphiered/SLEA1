@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Final Review Request Details</h1>

    <p><strong>ID:</strong> {{ $finalReview->final_review_id }}</p>
    <p><strong>Submission:</strong> {{ $finalReview->submission->title ?? 'N/A' }}</p>
    <p><strong>Action:</strong> {{ $finalReview->action }}</p>
    <p><strong>Created At:</strong> {{ $finalReview->created_at }}</p>

    <a href="{{ route('final-reviews.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
