@extends('layouts.admin')

@section('content')
<h2>Admin Dashboard</h2>
<!-- <a href="/admin/clients" class="inline-flex items-center px-4 py-2 rounded-lg bg-slate-900 text-white text-sm font-medium hover:bg-slate-800">
    Manage Clients
</a> -->

<!-- displaying websites summary here  -->
<div class="mt-2 grid grid-cols-1 md:grid-cols-4 gap-4">
    <div class="bg-white p-4 rounded-xl shadow-sm border">
        <div class="text-sm text-slate-500">Total Websites</div>
        <div class="text-2xl font-semibold">{{ $websiteStats['total'] }}</div>
    </div>

    <div class="bg-white p-4 rounded-xl shadow-sm border">
        <div class="text-sm text-slate-500">Active Websites</div>
        <div class="text-2xl font-semibold text-emerald-600">{{ $websiteStats['active'] }}</div>
    </div>

    <div class="bg-white p-4 rounded-xl shadow-sm border">
        <div class="text-sm text-slate-500">Paused Websites</div>
        <div class="text-2xl font-semibold text-amber-600">{{ $websiteStats['paused'] }}</div>
    </div>

    <div class="bg-white p-4 rounded-xl shadow-sm border">
        <div class="text-sm text-slate-500">New This Month</div>
        <div class="text-2xl font-semibold text-blue-600">{{ $websiteStats['created_this_month'] }}</div>
    </div>
</div>
<br>

<p>Total Clients: {{ $getAdminStats['clients'] }}</p>
<p>Total Websites: {{ $getAdminStats['websites'] }}</p>
<p>Total Keywords: {{ $getAdminStats['keywords'] }}</p>
@endsection