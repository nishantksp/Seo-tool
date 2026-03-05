<aside id="admin-sidebar" class="h-screen w-64 bg-slate-900 text-white flex flex-col">
    <div class="px-6 py-5 border-b border-slate-800">
        <div class="text-lg font-semibold">SEO Admin</div>
        <div class="text-xs text-slate-400 mt-1">Internal Management</div>
    </div>

    <nav class="flex-1 px-3 py-4 space-y-1 text-sm">
        <a href="/admin/dashboard"
           class="block px-4 py-2 rounded-lg {{ request()->is('admin/dashboard') ? 'bg-slate-800 text-white' : 'text-slate-200 hover:text-white hover:bg-slate-800' }}">
            Dashboard
        </a>
        <a href="/admin/clients"
           class="block px-4 py-2 rounded-lg {{ request()->is('admin/clients*') ? 'bg-slate-800 text-white' : 'text-slate-200 hover:text-white hover:bg-slate-800' }}">
            Clients
        </a>
        <a href="/admin/websites"
           class="block px-4 py-2 rounded-lg {{ request()->is('admin/websites*') ? 'bg-slate-800 text-white' : 'text-slate-200 hover:text-white hover:bg-slate-800' }}">
            Websites
        </a>
        <a href="/admin/keywords"
           class="block px-4 py-2 rounded-lg {{ request()->is('admin/keywords*') ? 'bg-slate-800 text-white' : 'text-slate-200 hover:text-white hover:bg-slate-800' }}">
            Keywords
        </a>
        <a href="/admin/backlinks"
           class="block px-4 py-2 rounded-lg {{ request()->is('admin/backlinks*') ? 'bg-slate-800 text-white' : 'text-slate-200 hover:text-white hover:bg-slate-800' }}">
            Backlinks
        </a>
        <a href="/admin/onpage"
           class="block px-4 py-2 rounded-lg {{ request()->is('admin/onpage*') ? 'bg-slate-800 text-white' : 'text-slate-200 hover:text-white hover:bg-slate-800' }}">
            Onpage
        </a>
        <a href="/admin/social"
           class="block px-4 py-2 rounded-lg {{ request()->is('admin/social*') ? 'bg-slate-800 text-white' : 'text-slate-200 hover:text-white hover:bg-slate-800' }}">
            Social
        </a>
    </nav>

    <div class="px-6 py-4 border-t border-slate-800">
        <div class="text-xs text-slate-400">Signed in as</div>
        <div class="text-sm font-semibold text-white">{{ auth()->user()->name ?? 'Admin' }}</div>
        <div class="text-xs text-slate-400 mb-3">{{ auth()->user()->email ?? '' }}</div>

        <a class="block px-4 py-2 rounded-lg text-slate-200 hover:text-white hover:bg-slate-800"
           href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</aside>
