@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="bi bi-mortarboard"></i> Student Management
                </h4>
                <div class="d-flex gap-2">
                    <a href="{{ route('students.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> New Student
                    </a>
                    <a href="{{ route('students-table') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-table"></i> Table View
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Search and Filter -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" class="form-control" id="searchInput" placeholder="Search students...">
                            <button class="btn btn-outline-secondary" type="button" onclick="searchStudents()">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="programFilter">
                            <option value="">All Programs</option>
                            <option value="BSIT">BSIT</option>
                            <option value="BSCS">BSCS</option>
                            <option value="BSIS">BSIS</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="yearFilter">
                            <option value="">All Year Levels</option>
                            <option value="1st Year">1st Year</option>
                            <option value="2nd Year">2nd Year</option>
                            <option value="3rd Year">3rd Year</option>
                            <option value="4th Year">4th Year</option>
                        </select>
                    </div>
                </div>

                <!-- Students Grid -->
                <div class="row" id="studentsGrid">
                    @forelse($students ?? [] as $student)
                        <div class="col-md-6 col-lg-4 mb-3 student-card">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0">
                                            @if($student->profile && $student->profile->picture_path)
                                                <img src="{{ asset('storage/' . $student->profile->picture_path) }}" 
                                                     alt="Profile Picture" 
                                                     class="rounded-circle" 
                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center" 
                                                     style="width: 50px; height: 50px;">
                                                    <i class="bi bi-person text-white"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">{{ $student->first_name }} {{ $student->last_name }}</h6>
                                            <small class="text-muted">{{ $student->email_address }}</small>
                                        </div>
                                    </div>
                                    
                                    <div class="row text-center mb-3">
                                        <div class="col-6">
                                            <small class="text-muted">Program</small>
                                            <div class="fw-bold">{{ $student->academicInfo->program ?? 'N/A' }}</div>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted">Year Level</small>
                                            <div class="fw-bold">{{ $student->academicInfo->year_level ?? 'N/A' }}</div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('students.show', $student->email_address) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                        <a href="{{ route('students.edit', $student->email_address) }}" 
                                           class="btn btn-sm btn-outline-warning">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="deleteStudent('{{ $student->email_address }}')">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center py-5">
                                <i class="bi bi-mortarboard display-1 text-muted"></i>
                                <h5 class="mt-3">No Students Found</h5>
                                <p class="text-muted">Start by adding your first student to the system.</p>
                                <a href="{{ route('students.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i> Add First Student
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function searchStudents() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const studentCards = document.querySelectorAll('.student-card');
    
    studentCards.forEach(card => {
        const text = card.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

function deleteStudent(email) {
    if (confirm('Are you sure you want to delete this student? This action cannot be undone.')) {
        fetch(`/students/${email}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error deleting student: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting student');
        });
    }
}

// Filter functionality
document.getElementById('programFilter').addEventListener('change', filterStudents);
document.getElementById('yearFilter').addEventListener('change', filterStudents);

function filterStudents() {
    const programFilter = document.getElementById('programFilter').value;
    const yearFilter = document.getElementById('yearFilter').value;
    
    // Implementation would filter students based on selected criteria
    console.log('Filtering by:', { program: programFilter, year: yearFilter });
}
</script>
@endsection









