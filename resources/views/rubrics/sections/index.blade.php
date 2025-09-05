@extends('layouts.app')

@section('content')
<div class="container my-4">
  @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Rubric Sections</h3>
    <a href="{{ route('rubric-sections.create') }}" class="btn btn-primary">New Section</a>
  </div>

  <form method="GET" class="mb-3">
    <div class="row g-2">
      <div class="col-md-6">
        <select name="category_id" class="form-select" onchange="this.form.submit()">
          <option value="">All Categories</option>
          @foreach($categories as $c)
            <option value="{{ $c->category_id }}" @selected($categoryId==$c->category_id)>
              {{ $c->order_no }} — {{ $c->title }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="col-md-2">
        <button class="btn btn-outline-secondary w-100">Filter</button>
      </div>
    </div>
  </form>

  <div class="table-responsive">
    <table class="table table-sm align-middle">
      <thead><tr>
        <th>#</th><th>Category</th><th>Title</th><th>Order</th><th>Actions</th>
      </tr></thead>
      <tbody>
        @forelse($sections as $s)
          <tr>
            <td>{{ $s->section_id }}</td>
            <td>{{ $s->category->title ?? '—' }}</td>
            <td class="text-truncate" style="max-width:480px">{{ $s->title }}</td>
            <td>{{ $s->order_no }}</td>
            <td class="d-flex gap-2">
              <a href="{{ route('rubric-sections.edit', $s) }}" class="btn btn-sm btn-outline-primary">Edit</a>
              <form action="{{ route('rubric-sections.destroy', $s) }}" method="POST"
                    onsubmit="return confirm('Delete this section?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="5" class="text-center text-muted">No sections.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{ $sections->withQueryString()->links() }}
</div>
@endsection
