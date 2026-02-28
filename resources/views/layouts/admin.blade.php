<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<nav class="navbar navbar-dark bg-primary px-4">
    <span class="navbar-brand">SEO Admin Panel</span>

    <div>
        <a class="text-white me-3" href="/admin/dashboard">Dashboard</a>
        <a class="text-white me-3" href="/admin/websites">Websites</a>
        <a class="text-white me-3" href="/admin/backlinks">Backlinks</a>
        <a class="text-white me-3" href="/admin/keywords">Keywords</a>
        <!-- <a class="text-white me-3" href="/admin/rankings">Rankings</a> -->
        <a class="text-white me-3" href="/admin/onpage">Onpage</a>
        <a class="text-white me-3" href="/admin/social">Social</a>
        <a class="text-white me-3" href="">Clients</a>

        <a class="text-white"
           href="{{ route('logout') }}"
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