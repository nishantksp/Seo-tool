@extends('layouts.admin')

@section('content')
<h2>Admin Dashboard</h2>
<a href="/admin/clients" class="inline-flex items-center px-4 py-2 rounded-lg bg-slate-900 text-white text-sm font-medium hover:bg-slate-800">
    Manage Clients
</a>

<hr>

<p>Total Clients: {{ $clients }}</p>
<p>Total Websites: {{ $websites }}</p>
<p>Total Keywords: {{ $keywords }}</p>
@endsection