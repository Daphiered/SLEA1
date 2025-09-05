@extends('layouts.app')
@section('title','Rubric Subsections')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="bi bi-list-check"></i> Rubric Subsections</h4>
                    <a href="{{ route('rubric-subsections.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> New Subsection
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($subs->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Section</th>
                                        <th>Sub Section</th>
                                        <th>Order</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subs as $s)
                                        <tr>
                                            <td>{{ $s->sub_items }}</td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $s->section->title ?? 'N/A' }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('rubric-subsections.show',$s) }}" class="text-decoration-none">
                                                    {{ $s->sub_section }}
                                                </a>
                                            </td>
                                            <td>{{ $s->order_no }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('rubric-subsections.show',$s) }}" class="btn btn-sm btn-info">
                                                        <i class="bi bi-eye"></i> View
                                                    </a>
                                                    <a href="{{ route('rubric-subsections.edit',$s) }}" class="btn btn-sm btn-warning">
                                                        <i class="bi bi-pencil"></i> Edit
                                                    </a>
                                                    <form action="{{ route('rubric-subsections.destroy',$s) }}" method="POST" class="d-inline">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this subsection?')">
                                                            <i class="bi bi-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            {{ $subs->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-list-check display-1 text-muted"></i>
                            <h5 class="text-muted mt-3">No Rubric Subsections Found</h5>
                            <p class="text-muted">Start by creating rubric subsections for leadership assessment.</p>
                            <a href="{{ route('rubric-subsections.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Create First Subsection
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
