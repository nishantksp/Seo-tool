<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-slate-50 text-slate-900">
<div class="min-h-screen">
    <!-- Sidebar -->
    <div id="sidebar-wrapper" class="fixed inset-y-0 left-0 z-40 w-64 transform bg-slate-900 transition-transform duration-200 ease-in-out">
        @include('layouts.sidebar')
    </div>

    <!-- Overlay for mobile -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/40 z-30 hidden lg:hidden"></div>

    <main id="main-content" class="w-full transition-all duration-200 ease-in-out">
        <!-- Top bar with hamburger -->
        <div id="topbar" class="sticky top-0 z-50 bg-slate-50 border-b border-slate-200 transition-all duration-200 ease-in-out">
            <div class="w-full px-4 sm:px-6 lg:px-8 py-4 flex items-center gap-3">
                <button id="sidebar-toggle" class="inline-flex items-center justify-center w-10 h-10 rounded-lg border border-slate-200 bg-white text-slate-700 hover:bg-slate-100">
                    <span class="sr-only">Toggle sidebar</span>
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div class="text-sm text-slate-600">
                    Admin Panel
                </div>
            </div>
        </div>

        <div class="w-full px-4 sm:px-6 lg:px-8 py-8">
            @yield('content')
        </div>
    </main>
</div>

<script>
    const sidebarWrapper = document.getElementById('sidebar-wrapper');
    const sidebarOverlay = document.getElementById('sidebar-overlay');
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const mainContent = document.getElementById('main-content');
    const topbar = document.getElementById('topbar');

    const isDesktop = () => window.innerWidth >= 1024;

    const applyLayout = (isOpen) => {
        const useOffset = isOpen && isDesktop();
        const margin = useOffset ? '16rem' : '0';
        const width = useOffset ? 'calc(100% - 16rem)' : '100%';

        // Move the whole main area; top bar lives inside main.
        mainContent.style.marginLeft = margin;
        mainContent.style.width = width;
    };

    const openSidebar = () => {
        sidebarWrapper.classList.remove('-translate-x-full');
        if (!isDesktop()) {
            sidebarOverlay.classList.remove('hidden');
        }
        applyLayout(true);
    };

    const closeSidebar = () => {
        sidebarWrapper.classList.add('-translate-x-full');
        sidebarOverlay.classList.add('hidden');
        applyLayout(false);
    };

    sidebarToggle.addEventListener('click', () => {
        const isOpen = !sidebarWrapper.classList.contains('-translate-x-full');
        isOpen ? closeSidebar() : openSidebar();
    });

    sidebarOverlay.addEventListener('click', closeSidebar);

    const setInitialSidebar = () => {
        if (isDesktop()) {
            openSidebar();
        } else {
            closeSidebar();
        }
    };

    window.addEventListener('resize', setInitialSidebar);

    // Initialize on first load
    setInitialSidebar();
</script>
</body>
</html>
