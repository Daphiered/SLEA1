@extends('layouts.app')

@section('content')
<div class="container my-4">
  @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Rubric Categories</h3>
    <a href="{{ route('rubric-categories.create') }}" class="btn btn-primary">New Category</a>
  </div>

  <div class="table-responsive">
    <table class="table table-sm align-middle">
      <thead><tr><th>#</th><th>Title</th><th>Max Points</th><th>Order</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse($categories as $c)
          <tr>
            <td>{{ $c->category_id }}</td>
            <td>{{ $c->title }}</td>
            <td><span class="badge bg-info">{{ number_format($c->max_points, 2) }}</span></td>
            <td>{{ $c->order_no }}</td>
            <td class="d-flex gap-2">
              <a href="{{ route('rubric-categories.show', $c) }}" class="btn btn-sm btn-outline-info">View</a>
              <a href="{{ route('rubric-categories.edit', $c) }}" class="btn btn-sm btn-outline-primary">Edit</a>
              <form action="{{ route('rubric-categories.destroy', $c) }}" method="POST"
                    onsubmit="return confirm('Delete category (and its sections)?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="5" class="text-center text-muted">No categories.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{ $categories->links() }}
</div>
@endsection
