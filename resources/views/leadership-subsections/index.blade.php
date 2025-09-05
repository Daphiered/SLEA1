@extends('layouts.app')
@section('title','Leadership Positions')

@section('content')
<div class="container my-4">
  @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Leadership Positions</h3>
    <a href="{{ route('leadership-subsections.create') }}" class="btn btn-primary">New Leadership Position</a>
  </div>

  <div class="table-responsive">
    <table class="table table-sm align-middle">
      <thead><tr><th>#</th><th>Category</th><th>Section</th><th>Subsection</th><th>Position</th><th>Points</th><th>Order</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse($leadership as $l)
          <tr>
            <td>{{ $l->leadership_id }}</td>
            <td>
              <span class="badge bg-primary">{{ $l->subsection->section->category->title ?? 'N/A' }}</span>
            </td>
            <td>
              <span class="badge bg-secondary">{{ $l->subsection->section->title ?? 'N/A' }}</span>
            </td>
            <td>
              <strong>{{ $l->subsection->sub_section }}</strong>
            </td>
            <td>{{ $l->position }}</td>
            <td>
              <span class="badge {{ $l->points < 0 ? 'bg-danger' : 'bg-info' }}">
                {{ number_format($l->points, 2) }}
              </span>
            </td>
            <td>{{ $l->position_order }}</td>
            <td class="d-flex gap-2">
              <a href="{{ route('leadership-subsections.show', $l) }}" class="btn btn-sm btn-outline-info">View</a>
              <a href="{{ route('leadership-subsections.edit', $l) }}" class="btn btn-sm btn-outline-primary">Edit</a>
              <form action="{{ route('leadership-subsections.destroy', $l) }}" method="POST"
                    onsubmit="return confirm('Delete this leadership position?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="8" class="text-center text-muted">No leadership positions found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{ $leadership->links() }}
</div>
@endsection
