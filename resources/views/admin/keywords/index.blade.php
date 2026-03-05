@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-semibold text-slate-900">All Keywords</h2>
            <p class="text-sm text-slate-600">Manage keyword assignments, targets, and status.</p>
        </div>
        <a href="/admin/keywords/create"
           class="px-4 py-2 rounded-lg bg-slate-900 text-white text-sm font-medium hover:bg-slate-800">
            Add Keyword
        </a>
    </div>

    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-100 text-slate-700">
                <tr>
                    <th class="px-4 py-3 text-left">Keyword</th>
                    <th class="px-4 py-3 text-left">Website</th>
                    <th class="px-4 py-3 text-left">Client</th>
                    <th class="px-4 py-3 text-left">Target URL</th>
                    <th class="px-4 py-3 text-left">Volume</th>
                    <th class="px-4 py-3 text-left">Difficulty</th>
                    <th class="px-4 py-3 text-left">Intent</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($keywords as $key)
                    <tr>
                        <td class="px-4 py-3 font-medium text-slate-900">
                            {{ $key->keyword->keyword }}
                        </td>
                        <td class="px-4 py-3">{{ $key->website->domain }}</td>
                        <td class="px-4 py-3">{{ $key->website->user->name }}</td>
                        <td class="px-4 py-3">
                            <span class="text-slate-600">{{ $key->target_url ?? '-' }}</span>
                        </td>
                        <td class="px-4 py-3">{{ $key->keyword->search_volume ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $key->keyword->difficulty ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <span class="text-slate-600">{{ $key->keyword->intent ?? '-' }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded-full text-xs
                                {{ $key->status === 'active' ? 'bg-emerald-50 text-emerald-700' : ($key->status === 'paused' ? 'bg-amber-50 text-amber-700' : 'bg-slate-100 text-slate-600') }}">
                                {{ ucfirst($key->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right space-x-3">
                            <a href="/admin/keywords/{{ $key->id }}/ranking" class="text-blue-600 hover:underline">
                                Update Rank
                            </a>
                            <a href="/admin/keywords/{{ $key->id }}/edit" class="text-slate-700 hover:underline">
                                Edit
                            </a>
                            <form action="/admin/keywords/{{ $key->id }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-rose-600 hover:underline"
                                        onclick="return confirm('Delete this keyword assignment?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-4 py-6 text-center text-slate-500">
                            No keyword assignments found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>
        {{ $keywords->links() }}
    </div>
</div>
@endsection
