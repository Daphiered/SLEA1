@php
    $update = $update ?? null;
@endphp

<div class="mb-3">
    <label>Student ID</label>
    <input type="text" name="student_id" class="form-control" value="{{ old('student_id', $update->student_id ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Old Program</label>
    <input type="text" name="old_program" class="form-control" value="{{ old('old_program', $update->old_program ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Old Major</label>
    <input type="text" name="old_major" class="form-control" value="{{ old('old_major', $update->old_major ?? '') }}">
</div>

<div class="mb-3">
    <label>New Program</label>
    <input type="text" name="new_program" class="form-control" value="{{ old('new_program', $update->new_program ?? '') }}" required>
</div>

<div class="mb-3">
    <label>New Major</label>
    <input type="text" name="new_major" class="form-control" value="{{ old('new_major', $update->new_major ?? '') }}">
</div>

<div class="mb-3">
    <label>Date Changed</label>
    <input type="datetime-local" name="date_prog_changed" class="form-control"
           value="{{ old('date_prog_changed', isset($update) ? \Carbon\Carbon::parse($update->date_prog_changed)->format('Y-m-d\TH:i') : '') }}" required>
</div>
