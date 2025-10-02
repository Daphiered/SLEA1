@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="bi bi-trophy"></i> Award Report Details</h4>
                    <div class="btn-group" role="group">
                        <a href="{{ route('award_reports.edit', $awardReport->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <a href="{{ route('award_reports.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Award Report ID</label>
                                <p class="form-control-plaintext">{{ $awardReport->id }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Final Review ID</label>
                                <p class="form-control-plaintext">{{ $awardReport->final_review_id }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Admin ID</label>
                                <p class="form-control-plaintext">{{ $awardReport->admin_id }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Award Date</label>
                                <p class="form-control-plaintext">
                                    {{ $awardReport->award_date ? \Carbon\Carbon::parse($awardReport->award_date)->format('F d, Y') : 'Not specified' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Award Type</label>
                        <p class="form-control-plaintext">
                            <span class="badge bg-primary fs-6">{{ $awardReport->award_type }}</span>
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Remarks</label>
                        <div class="form-control-plaintext" style="min-height: 100px; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                            {{ $awardReport->remarks ?: 'No remarks provided' }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Created At</label>
                                <p class="form-control-plaintext">
                                    {{ $awardReport->created_at ? \Carbon\Carbon::parse($awardReport->created_at)->format('F d, Y \a\t g:i A') : 'Not available' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Last Updated</label>
                                <p class="form-control-plaintext">
                                    {{ $awardReport->updated_at ? \Carbon\Carbon::parse($awardReport->updated_at)->format('F d, Y \a\t g:i A') : 'Not available' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('award_reports.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Back to List
                        </a>
                        <div class="btn-group" role="group">
                            <a href="{{ route('award_reports.edit', $awardReport->id) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Edit Award Report
                            </a>
                            <form action="{{ route('award_reports.destroy', $awardReport->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this award report?')">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection







