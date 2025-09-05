<!DOCTYPE html>
<html>
<head>
    <title>Change Student Password</title>
</head>
<body>
    <h1><strong>Change Student Password</strong></h1>

    <form action="{{ url('/change-password') }}" method="POST">
        @csrf
        <p>
            <label for="password_id">Password ID:</label>
            <input type="number" name="password_id" id="password_id" required>
        </p>
        <p>
            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" id="new_password" required>
        </p>
        <button type="submit">Change Password</button>
    </form>
</body>
</html>
