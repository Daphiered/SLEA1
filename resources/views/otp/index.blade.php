@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">One-Time Passwords (OTPs)</h1>

    {{-- Create OTP Form --}}
    <div class="card mb-4">
        <div class="card-header">Generate New OTP</div>
        <div class="card-body">
            <form action="{{ route('otp.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="log_id" class="form-label">Select Login</label>
                   <select name="user_role" class="form-select" required>
      <option value="">Role…</option>
      <option value="admin">Admin</option>
      <option value="assessor">Assessor</option>
      <option value="student">Student</option>
    </select>
                        @foreach($logins as $login)
                            <option value="{{ $login->log_id }}">
                                {{ $login->email_address }} ({{ ucfirst($login->user_role) }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="otp_code" class="form-label">OTP Code</label>
                    <input type="text" name="otp_code" id="otp_code" class="form-control" placeholder="Enter OTP" required>
                </div>

                <button type="submit" class="btn btn-primary">Save OTP</button>
            </form>
        </div>
    </div>

    {{-- OTP List --}}
    <div class="card">
        <div class="card-header">Existing OTPs</div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>OTP ID</th>
                            <th>Login ID</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>OTP Code</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($otps as $otp)
                            <tr>
                                <td>{{ $otp->otp_id }}</td>
                                <td>{{ $otp->log_id }}</td>
                                <td>{{ $otp->login->email_address ?? 'N/A' }}</td>
                                <td>{{ ucfirst($otp->login->user_role ?? 'N/A') }}</td>
                                <td>{{ $otp->otp_code }}</td>
                                <td>{{ $otp->created_at ? $otp->created_at->format('Y-m-d H:i') : '' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No OTP records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            {{ $otps->links() }}
        </div>
    </div>
</div>
@endsection
