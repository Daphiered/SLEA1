<!DOCTYPE html>
<html>
<head>
    <title>Changed Passwords</title>
</head>
<body>
    <h2>Changed Passwords</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Password ID</th>
                <th>New Password (Hashed)</th>
                <th>Date Changed</th>
            </tr>
        </thead>
        <tbody>
            @forelse($changes as $change)
                <tr>
                    <td>{{ $change->password_id }}</td>
                    <td>{{ $change->new_password_hashed }}</td>
                    <td>{{ $change->date_pass_changed }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
