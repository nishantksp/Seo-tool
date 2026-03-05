@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="text-2xl font-semibold text-slate-900">All Websites</h2>
        <p class="text-sm text-slate-600">Manage website ownership, status, and details.</p>
    </div>

    <div class="flex flex-wrap items-center gap-3">
        <form method="GET" class="flex flex-wrap gap-3">
            <input type="text" name="search" placeholder="Search domain or client"
                   value="{{ $filters['search'] ?? '' }}"
                   class="w-60 rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">

            <select name="client_id" class="rounded-lg border-slate-300">
                <option value="">All Clients</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ ($filters['client_id'] ?? '') == $client->id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>

            <select name="status" class="rounded-lg border-slate-300">
                <option value="">All Status</option>
                <option value="active" {{ ($filters['status'] ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="paused" {{ ($filters['status'] ?? '') == 'paused' ? 'selected' : '' }}>Paused</option>
            </select>

            <button class="px-4 py-2 bg-slate-900 text-white rounded-lg text-sm">Filter</button>
        </form>

        <a href="/admin/websites/create"
           class="ml-auto px-4 py-2 bg-slate-900 text-white rounded-lg text-sm">
            Add Website
        </a>
    </div>

    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-100 text-slate-700">
                <tr>
                    <th class="px-4 py-3 text-left">Domain</th>
                    <th class="px-4 py-3 text-left">Client</th>
                    <th class="px-4 py-3 text-left">Country</th>
                    <th class="px-4 py-3 text-left">Niche</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Keywords</th>
                    <th class="px-4 py-3 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($websites as $site)
                <tr>
                    <td class="px-4 py-3">{{ $site->domain }}</td>
                    <td class="px-4 py-3">{{ $site->user->name }}</td>
                    <td class="px-4 py-3">{{ $site->country ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $site->niche ?? '-' }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded-full text-xs
                            {{ $site->status === 'active' ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">
                            {{ ucfirst($site->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-3">{{ $site->keywords_count }}</td>
                    <td class="px-4 py-3 text-right">
                        <a href="/admin/websites/{{ $site->id }}/edit" class="text-blue-600 hover:underline">Edit</a>
                        <form action="/admin/websites/{{ $site->id }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-rose-600 hover:underline ml-3"
                                    onclick="return confirm('Delete this website?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-6 text-center text-slate-500">
                        No websites found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>
        {{ $websites->links() }}
    </div>
</div>
@endsection
