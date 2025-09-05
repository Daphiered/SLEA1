<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>@yield('title','Rubric Subsections')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @vite(['resources/css/app.css','resources/js/app.js']) {{-- or include Bootstrap if you prefer --}}
</head>
<body class="p-6">
  <div class="max-w-4xl mx-auto">
    @if(session('success'))
      <div style="padding:.75rem; background:#e6ffec; border:1px solid #b7f5c8; margin-bottom:1rem;">
        {{ session('success') }}
      </div>
    @endif
    @yield('content')
  </div>
</body>
</html>
