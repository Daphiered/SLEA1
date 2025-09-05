@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="bi bi-trophy"></i> Award Reports</h4>
                    <a href="{{ route('award_reports.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> New Award Report
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($awardReports->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Final Review ID</th>
                                        <th>Admin ID</th>
                                        <th>Award Type</th>
                                        <th>Award Date</th>
                                        <th>Remarks</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($awardReports as $awardReport)
                                        <tr>
                                            <td>{{ $awardReport->id }}</td>
                                            <td>{{ $awardReport->final_review_id }}</td>
                                            <td>{{ $awardReport->admin_id }}</td>
                                            <td>
                                                <span class="badge bg-primary">{{ $awardReport->award_type }}</span>
                                            </td>
                                            <td>{{ $awardReport->award_date ? \Carbon\Carbon::parse($awardReport->award_date)->format('M d, Y') : 'N/A' }}</td>
                                            <td>
                                                <span class="text-truncate d-inline-block" style="max-width: 200px;" title="{{ $awardReport->remarks }}">
                                                    {{ $awardReport->remarks }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('award_reports.show', $awardReport->id) }}" class="btn btn-sm btn-info">
                                                        <i class="bi bi-eye"></i> View
                                                    </a>
                                                    <a href="{{ route('award_reports.edit', $awardReport->id) }}" class="btn btn-sm btn-warning">
                                                        <i class="bi bi-pencil"></i> Edit
                                                    </a>
                                                    <form action="{{ route('award_reports.destroy', $awardReport->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this award report?')">
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
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-trophy display-1 text-muted"></i>
                            <h5 class="text-muted mt-3">No Award Reports Found</h5>
                            <p class="text-muted">Start by creating award reports for final reviews.</p>
                            <a href="{{ route('award_reports.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Create First Award Report
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection






