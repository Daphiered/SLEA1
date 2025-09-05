@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="bi bi-award"></i> Leadership Information</h4>
                    <a href="{{ route('leadership.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Add Leadership
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($leaderships->count() > 0)
                        <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Student</th>
                <th>Organization Name</th>
                <th>Role</th>
                <th>Term</th>
                <th>Hours Log</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leaderships as $leadership)
                <tr>
                    <td>
                        @if($leadership->student)
                            <div>
                                <strong>{{ $leadership->student->full_name }}</strong><br>
                                <small class="text-muted">{{ $leadership->student_id }}</small>
                            </div>
                        @else
                            <span class="text-muted">{{ $leadership->student_id }}</span>
                        @endif
                    </td>
                    <td>{{ $leadership->organization_name }}</td>
                    <td>{{ $leadership->organization_role }}</td>
                    <td>{{ $leadership->term }}</td>
                    <td>{{ $leadership->hours_log }}</td>
                    <td>
                        @if($leadership->leadership_status === 'Active')
                            <span class="badge bg-success">Active</span>
                        @elseif($leadership->leadership_status === 'Completed')
                            <span class="badge bg-primary">Completed</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('leadership.show', $leadership->leadership_id) }}" class="btn btn-sm btn-info" title="View Details">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('leadership.edit', $leadership->leadership_id) }}" class="btn btn-sm btn-warning" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('leadership.destroy', $leadership->leadership_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this leadership record?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
                        </tbody>
                    </table>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-inbox display-1 text-muted"></i>
                            <h5 class="text-muted mt-3">No Leadership Records Found</h5>
                            <p class="text-muted">Start by adding leadership information for students.</p>
                            <a href="{{ route('leadership.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Add First Record
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
