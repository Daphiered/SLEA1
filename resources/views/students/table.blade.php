@extends('layouts.app')
@section('title', 'All Students - Table View')

@section('content')
<div class="container-fluid my-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0">
                <i class="bi bi-table"></i> All Students - Table View
            </h3>
            <div class="d-flex gap-2">
                <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
                <a href="{{ route('students.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Add New Student
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <!-- Search and Filter -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" id="searchInput" class="form-control" placeholder="Search students...">
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <span class="text-muted">Total Students: <strong>{{ $students->count() }}</strong></span>
                </div>
            </div>

            <!-- Students Table -->
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="studentsTable">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Student ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Birth Date</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Program</th>
                            <th>Year Level</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $index => $student)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <span class="badge bg-primary">{{ $student->student_id ?? 'N/A' }}</span>
                            </td>
                            <td>
                                <strong>{{ $student->full_name }}</strong>
                            </td>
                            <td>
                                <a href="mailto:{{ $student->email_address }}" class="text-decoration-none">
                                    {{ $student->email_address }}
                                </a>
                            </td>
                            <td>{{ $student->contact_number ?? 'N/A' }}</td>
                            <td>{{ $student->birth_date ? \Carbon\Carbon::parse($student->birth_date)->format('M d, Y') : 'N/A' }}</td>
                            <td>
                                @if($student->age)
                                    <span class="badge bg-info">{{ $student->age }} years</span>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>
                                @if($student->gender)
                                    <span class="badge bg-{{ $student->gender === 'Male' ? 'primary' : ($student->gender === 'Female' ? 'danger' : 'secondary') }}">
                                        {{ $student->gender }}
                                    </span>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>
                                @if($student->academicInformation)
                                    <span class="badge bg-success">{{ $student->academicInformation->program }}</span>
                                @else
                                    <span class="text-muted">Not enrolled</span>
                                @endif
                            </td>
                            <td>
                                @if($student->academicInformation)
                                    <span class="badge bg-warning">{{ $student->academicInformation->year_level }}</span>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">{{ Str::limit($student->address ?? 'N/A', 30) }}</small>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('students.show', $student->email_address) }}" 
                                       class="btn btn-sm btn-outline-info" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('students.edit', $student->email_address) }}" 
                                       class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                            onclick="deleteStudent('{{ $student->email_address }}')" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12" class="text-center text-muted py-4">
                                <i class="bi bi-inbox display-4"></i>
                                <p class="mt-2">No students found</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this student? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Search functionality
document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchTerm = this.value.toLowerCase();
    const table = document.getElementById('studentsTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    
    for (let row of rows) {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    }
});

// Delete functionality
function deleteStudent(email) {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    const form = document.getElementById('deleteForm');
    form.action = `/students/${email}`;
    modal.show();
}
</script>
@endpush
