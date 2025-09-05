@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Create Award Report</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('award_reports.store') }}">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="final_review_id" class="form-label">Final Review ID</label>
                                    <select name="final_review_id" id="final_review_id" class="form-select @error('final_review_id') is-invalid @enderror" required>
                                        <option value="">Select Final Review</option>
                                        @foreach($finalReviews as $finalReview)
                                            <option value="{{ $finalReview->id }}" {{ old('final_review_id') == $finalReview->id ? 'selected' : '' }}>
                                                Review #{{ $finalReview->id }} - {{ $finalReview->admin_id }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('final_review_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="admin_id" class="form-label">Admin ID</label>
                                    <input type="text" name="admin_id" id="admin_id" class="form-control @error('admin_id') is-invalid @enderror" value="{{ old('admin_id') }}" placeholder="e.g., ADMIN001" required>
                                    @error('admin_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="award_type" class="form-label">Award Type</label>
                                    <select name="award_type" id="award_type" class="form-select @error('award_type') is-invalid @enderror" required>
                                        <option value="">Select Award Type</option>
                                        <option value="Excellence in Web Development" {{ old('award_type') == 'Excellence in Web Development' ? 'selected' : '' }}>Excellence in Web Development</option>
                                        <option value="Outstanding Software Engineering" {{ old('award_type') == 'Outstanding Software Engineering' ? 'selected' : '' }}>Outstanding Software Engineering</option>
                                        <option value="Innovation in Technology" {{ old('award_type') == 'Innovation in Technology' ? 'selected' : '' }}>Innovation in Technology</option>
                                        <option value="Academic Excellence" {{ old('award_type') == 'Academic Excellence' ? 'selected' : '' }}>Academic Excellence</option>
                                        <option value="Leadership Achievement" {{ old('award_type') == 'Leadership Achievement' ? 'selected' : '' }}>Leadership Achievement</option>
                                        <option value="Community Service" {{ old('award_type') == 'Community Service' ? 'selected' : '' }}>Community Service</option>
                                    </select>
                                    @error('award_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="award_date" class="form-label">Award Date</label>
                                    <input type="date" name="award_date" id="award_date" class="form-control @error('award_date') is-invalid @enderror" value="{{ old('award_date') }}" required>
                                    @error('award_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea name="remarks" id="remarks" rows="4" class="form-control @error('remarks') is-invalid @enderror" placeholder="Enter detailed remarks about the award..." required>{{ old('remarks') }}</textarea>
                            @error('remarks')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('award_reports.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Create Award Report
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection






