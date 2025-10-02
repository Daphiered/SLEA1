<!DOCTYPE html>
<html>
<head>
    <title>Clusters & Organizations</title>
</head>
<body>
    <h1>Clusters & Organizations</h1>

    @foreach($clusters as $cluster)
        <h2>{{ $cluster->name }}</h2>
        <ul>
            @foreach($cluster->organizations as $org)
                <li>{{ $org->name }}</li>
            @endforeach
        </ul>
    @endforeach

    <a href="{{ route('clusters.create') }}">Add Cluster</a><br>
    <a href="{{ route('organizations.create') }}">Add Organization</a>
</body>
</html>
