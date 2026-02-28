<!DOCTYPE html>
<html>
<head>
    <title>SEO Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-4">
    <span class="navbar-brand">SEO Client Panel</span>

    <div>
        <a class="text-white me-3" href="/client/dashboard">Dashboard</a>
        <a class="text-white me-3" href="/client/websites">My Website</a>
        <a class="text-white me-3" href="/client/keywords">Keywords</a>
        <a class="text-white me-3" href="/client/backlinks">Backlinks</a>
        <a class="text-white me-3" href="/client/onpage">OnPage Report</a>
        <a class="text-white me-3" href="/client/blogs">Blogs</a>
        <a class="text-white me-3" href="/client/social">Social</a>

        <a class="text-white" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>