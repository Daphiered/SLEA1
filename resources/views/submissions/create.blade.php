@extends('layouts.app')

@section('content')
<div class="container my-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">New Submission Record</h3>
    <a href="{{ route('submissions.index') }}" class="btn btn-outline-secondary">Back to List</a>
  </div>

  @if ($errors->any())
    <div class="alert alert-danger">
      <strong>Please fix the following:</strong>
      <ul class="mb-0 mt-2">
        @foreach ($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('submissions.store') }}" method="POST" enctype="multipart/form-data" class="card p-3">
    @csrf

    <div class="row g-3">
      <div class="col-md-4">
        <label class="form-label">Student ID <span class="text-danger">*</span></label>
        <input type="text" name="student_id" class="form-control @error('student_id') is-invalid @enderror"
               maxlength="20" value="{{ old('student_id', $studentId) }}" required>
        @error('student_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="col-md-4">
        <label class="form-label">Leadership ID (optional)</label>
        <input type="number" name="leadership_id" class="form-control @error('leadership_id') is-invalid @enderror"
               value="{{ old('leadership_id') }}">
        @error('leadership_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="col-md-4">
        <label class="form-label">Activity Date <span class="text-danger">*</span></label>
        <input type="datetime-local" name="activity_date" class="form-control @error('activity_date') is-invalid @enderror"
               value="{{ old('activity_date') }}" required>
        @error('activity_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="col-md-6">
        <label class="form-label">Activity Title <span class="text-danger">*</span></label>
        <input type="text" name="activity_title" class="form-control @error('activity_title') is-invalid @enderror"
               maxlength="255" value="{{ old('activity_title') }}" required>
        @error('activity_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="col-md-3">
        <label class="form-label">Activity Type <span class="text-danger">*</span></label>
        <input type="text" name="activity_type" class="form-control @error('activity_type') is-invalid @enderror"
               maxlength="255" value="{{ old('activity_type') }}" required>
        @error('activity_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="col-md-3">
        <label class="form-label">Activity Role <span class="text-danger">*</span></label>
        <input type="text" name="activity_role" class="form-control @error('activity_role') is-invalid @enderror"
               maxlength="255" value="{{ old('activity_role') }}" required>
        @error('activity_role') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="col-md-6">
        <label class="form-label">Organizing Body <span class="text-danger">*</span></label>
        <input type="text" name="organizing_body" class="form-control @error('organizing_body') is-invalid @enderror"
               maxlength="255" value="{{ old('organizing_body') }}" required>
        @error('organizing_body') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="col-md-3">
        <label class="form-label">Term</label>
        <input type="text" name="term" class="form-control @error('term') is-invalid @enderror"
               maxlength="50" placeholder="1st Sem / 2nd Sem / Summer" value="{{ old('term') }}">
        @error('term') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="col-md-3">
        <label class="form-label">Issued By</label>
        <input type="text" name="issued_by" class="form-control @error('issued_by') is-invalid @enderror"
               maxlength="50" value="{{ old('issued_by') }}">
        @error('issued_by') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="col-md-12">
        <label class="form-label">Note (optional)</label>
        <input type="text" name="note" class="form-control @error('note') is-invalid @enderror"
               maxlength="50" value="{{ old('note') }}">
        @error('note') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="col-md-4">
        <label class="form-label">Document Type</label>
        <input type="text" name="document_type" class="form-control @error('document_type') is-invalid @enderror"
               maxlength="255" value="{{ old('document_type') }}">
        @error('document_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="col-md-3">
        <label class="form-label">
          <i class="bi bi-tags"></i> Rubric Category
        </label>
        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" id="category_id">
          <option value="">Select Category</option>
          @foreach($categories as $category)
            <option value="{{ $category->category_id }}" {{ old('category_id') == $category->category_id ? 'selected' : '' }}>
              {{ $category->title }} ({{ $category->max_points }} pts)
            </option>
          @endforeach
        </select>
        @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="col-md-3">
        <label class="form-label">
          <i class="bi bi-list-nested"></i> Rubric Section
        </label>
        <select name="section_id" class="form-select @error('section_id') is-invalid @enderror" id="section_id">
          <option value="">Select Section</option>
        </select>
        @error('section_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="col-md-3">
        <label class="form-label">
          <i class="bi bi-list"></i> Rubric Subsection
        </label>
        <select name="sub_items" class="form-select @error('sub_items') is-invalid @enderror" id="sub_items">
          <option value="">Select Subsection</option>
        </select>
        @error('sub_items') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="col-md-3">
        <label class="form-label">
          <i class="bi bi-trophy"></i> Leadership Position
        </label>
        <select name="leadership_id" class="form-select @error('leadership_id') is-invalid @enderror" id="leadership_id">
          <option value="">Select Leadership Position</option>
        </select>
        @error('leadership_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="col-md-6">
        <label class="form-label">Upload Document (PDF/JPG/PNG · max 5MB)</label>
        <input type="file" name="document_file" class="form-control @error('document_file') is-invalid @enderror"
               accept=".pdf,.jpg,.jpeg,.png">
        @error('document_file') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="col-md-6">
        <label class="form-label">Date Document Submitted</label>
        <input type="datetime-local" name="datedocu_submitted"
               class="form-control @error('datedocu_submitted') is-invalid @enderror"
               value="{{ old('datedocu_submitted') }}">
        @error('datedocu_submitted') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>
    </div>

    <div class="text-end mt-3">
      <button type="submit" class="btn btn-primary">Save Submission</button>
    </div>
  </form>

  <p class="text-muted mt-3">
    Academic Info update: <em>school_year</em> will be set from Activity Date (AY starts in August).
    If your table has <code>semester</code>, it will copy the Term value too.
  </p>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('category_id');
    const sectionSelect = document.getElementById('section_id');
    const subsectionSelect = document.getElementById('sub_items');
    const leadershipSelect = document.getElementById('leadership_id');
    
    // Load sections when category changes
    categorySelect.addEventListener('change', function() {
        const categoryId = this.value;
        sectionSelect.innerHTML = '<option value="">Select Section</option>';
        subsectionSelect.innerHTML = '<option value="">Select Subsection</option>';
        leadershipSelect.innerHTML = '<option value="">Select Leadership Position</option>';
        
        if (categoryId) {
            // Find the selected category and populate sections
            @foreach($categories as $category)
                if (categoryId == '{{ $category->category_id }}') {
                    @foreach($category->sections as $section)
                        sectionSelect.innerHTML += '<option value="{{ $section->section_id }}">{{ $section->title }}</option>';
                    @endforeach
                }
            @endforeach
        }
    });
    
    // Load subsections when section changes
    sectionSelect.addEventListener('change', function() {
        const sectionId = this.value;
        subsectionSelect.innerHTML = '<option value="">Select Subsection</option>';
        leadershipSelect.innerHTML = '<option value="">Select Leadership Position</option>';
        
        if (sectionId) {
            // Find the selected section and populate subsections
            @foreach($categories as $category)
                @foreach($category->sections as $section)
                    if (sectionId == '{{ $section->section_id }}') {
                        @foreach($section->subsections as $subsection)
                            subsectionSelect.innerHTML += '<option value="{{ $subsection->sub_items }}">{{ $subsection->sub_section }}</option>';
                        @endforeach
                    }
                @endforeach
            @endforeach
        }
    });
    
    // Load leadership positions when subsection changes
    subsectionSelect.addEventListener('change', function() {
        const subsectionId = this.value;
        leadershipSelect.innerHTML = '<option value="">Select Leadership Position</option>';
        
        if (subsectionId) {
            // Find the selected subsection and populate leadership positions
            @foreach($categories as $category)
                @foreach($category->sections as $section)
                    @foreach($section->subsections as $subsection)
                        if (subsectionId == '{{ $subsection->sub_items }}') {
                            @foreach($subsection->leadershipPositions as $leadership)
                                leadershipSelect.innerHTML += '<option value="{{ $leadership->leadership_id }}">{{ $leadership->position }} ({{ $leadership->points }} pts)</option>';
                            @endforeach
                        }
                    @endforeach
                @endforeach
            @endforeach
        }
    });
    
    // Trigger change event if category is pre-selected (for form validation errors)
    if (categorySelect.value) {
        categorySelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endpush
@endsection
