@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Final Review Requests</h1>
    <a href="{{ route('final-reviews.create') }}" class="btn btn-primary mb-3">New Request</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Submission</th>
                <th>Action</th>
                <th>Created</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach($finalReviews as $review)
                <tr>
                    <td>{{ $review->final_review_id }}</td>
                    <td>{{ $review->submission->title ?? 'N/A' }}</td>
                    <td>{{ $review->action }}</td>
                    <td>{{ $review->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('final-reviews.show', $review->final_review_id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('final-reviews.edit', $review->final_review_id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('final-reviews.destroy', $review->final_review_id) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this request?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $finalReviews->links() }}
</div>
@endsection
