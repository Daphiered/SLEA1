@extends('layouts.app')

@section('content')
<div class="container my-4">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Submission Records</h3>
        <a href="{{ route('submissions.create', ['student_id' => request('student_id')]) }}" class="btn btn-primary">
            New Submission
        </a>
    </div>

    <form method="GET" class="mb-3">
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" name="student_id" value="{{ $studentId }}" class="form-control" placeholder="Filter by Student ID">
            </div>
            <div class="col-md-2">
                <button class="btn btn-outline-secondary w-100">Filter</button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-sm align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student ID</th>
                    <th>Activity</th>
                    <th>Type</th>
                    <th>Role</th>
                    <th>Date</th>
                    <th>Category</th>
                    <th>Section</th>
                    <th>Subsection</th>
                    <th>Leadership</th>
                    <th>Term</th>
                    <th>Org</th>
                    <th>Doc</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                @forelse($records as $r)
                    <tr>
                        <td>{{ $r->subrec_id }}</td>
                        <td>{{ $r->student_id }}</td>
                        <td>{{ $r->activity_title }}</td>
                        <td>{{ $r->activity_type }}</td>
                        <td>{{ $r->activity_role }}</td>
                        <td>{{ optional($r->activity_date)->format('Y-m-d') }}</td>
                        <td>
                            @if($r->category)
                                <span class="badge bg-primary">{{ $r->category->title }}</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            @if($r->section)
                                <span class="badge bg-secondary">{{ $r->section->title }}</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            @if($r->subsection)
                                <span class="badge bg-info">{{ $r->subsection->sub_section }}</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            @if($r->rubricLeadership)
                                <span class="badge bg-warning">{{ $r->rubricLeadership->position }}</span>
                                <br><small class="text-muted">{{ $r->rubricLeadership->points }} pts</small>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>{{ $r->term ?? '—' }}</td>
                        <td>{{ $r->organizing_body }}</td>
                        <td>{{ $r->document_title ?? '—' }}</td>
                        <td>
                            @if($r->document_title_path)
                                <a href="{{ route('submissions.download', $r->subrec_id) }}"
                                   class="btn btn-sm btn-outline-primary">Download</a>
                            @else
                                —
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="14" class="text-center text-muted">No submissions yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $records->withQueryString()->links() }}
</div>
@endsection
