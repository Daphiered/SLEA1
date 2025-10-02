<!DOCTYPE html>
<html>
<head>
    <title>Add Cluster</title>
</head>
<body>
    <h1>Add Cluster</h1>

    <form action="{{ route('clusters.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Cluster Name" required>
        <button type="submit">Save</button>
    </form>
</body>
</html>
