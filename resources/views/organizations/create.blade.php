<!DOCTYPE html>
<html>
<head>
    <title>Create Organization</title>
</head>
<body>
    <h1>Create Organization</h1>
    <form method="POST" action="{{ route('organizations.store') }}">
        @csrf
        <label>Name:</label>
        <input type="text" name="name" required>
        <br>
        <label>Cluster:</label>
        <input type="text" name="cluster" required>
       
    
        <button type="submit">Save</button>
    </form>
</body>
</html>
