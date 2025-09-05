@extends('layouts.app')

@section('content')
<div class="container my-4">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">COR Submissions</h3>
        <a href="{{ route('cor.create', ['student_id' => request('student_id')]) }}" class="btn btn-primary">
            Upload COR
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
                <th>Student ID</th>
                <th>File</th>
                <th>Type</th>
                <th>Size</th>
                <th>Uploaded</th>
                <th>AY</th>
                <th>Status</th>
                <th>Download</th>
            </tr>
            </thead>
            <tbody>
            @forelse($submissions as $row)
                <tr>
                    <td>{{ $row->student_id }}</td>
                    <td>{{ $row->file_name }}</td>
                    <td>{{ strtoupper($row->file_type) }}</td>
                    <td>{{ number_format($row->file_size / 1024, 1) }} KB</td>
                    <td>{{ $row->upload_date->format('Y-m-d H:i') }}</td>
                    <td>{{ $row->academic_year }}</td>
                    <td><span class="badge text-bg-info">{{ $row->status }}</span></td>
                    <td>
                        @if($row->storage_path)
                            <a href="{{ route('cor.download', $row) }}" class="btn btn-sm btn-outline-primary">Download</a>
                        @else
                            —
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center text-muted">No submissions yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $submissions->withQueryString()->links() }}
</div>
@endsection
