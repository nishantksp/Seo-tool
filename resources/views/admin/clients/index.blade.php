@extends('admin.clients.layout')

@section('page_title', 'Clients')
@section('page_subtitle', 'Manage client users, profiles, and access status.')

@section('page_content')
<div class="flex items-center justify-between mb-6">
    <div class="text-sm text-slate-600">
        Total Clients: <span class="font-semibold text-slate-900">{{ $clients->count() }}</span>
    </div>
    <a href="/admin/clients/create"
       class="inline-flex items-center px-4 py-2 rounded-lg bg-slate-900 text-white text-sm font-medium hover:bg-slate-800">
        Add Client
    </a>
</div>

<div class="overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-100 text-slate-700">
            <tr>
                <th class="px-4 py-3 text-left font-medium">Client</th>
                <th class="px-4 py-3 text-left font-medium">Company</th>
                <th class="px-4 py-3 text-left font-medium">Contact</th>
                <th class="px-4 py-3 text-left font-medium">Status</th>
                <th class="px-4 py-3 text-right font-medium">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @forelse($clients as $client)
                <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">
                        <div class="font-medium text-slate-900">{{ $client->name }}</div>
                        <div class="text-slate-600">{{ $client->email }}</div>
                    </td>
                    <td class="px-4 py-3">
                        {{ $client->clientProfile->company_name ?? '-' }}
                    </td>
                    <td class="px-4 py-3">
                        <div>{{ $client->clientProfile->contact_person ?? '-' }}</div>
                        <div class="text-slate-600">{{ $client->clientProfile->phone ?? '-' }}</div>
                    </td>
                    <td class="px-4 py-3">
                        @if($client->is_active)
                            <span class="inline-flex px-2 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700">
                                Active
                            </span>
                        @else
                            <span class="inline-flex px-2 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-700">
                                Inactive
                            </span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <a href="/admin/clients/{{ $client->id }}/edit"
                           class="inline-flex items-center px-3 py-1.5 rounded-md bg-slate-100 text-slate-700 hover:bg-slate-200">
                            Edit
                        </a>

                        @if($client->is_active)
                            <form method="POST" action="/admin/clients/{{ $client->id }}/deactivate" class="inline">
                                @csrf
                                @method('PATCH')
                                <button class="inline-flex items-center px-3 py-1.5 rounded-md bg-amber-100 text-amber-800 hover:bg-amber-200">
                                    Deactivate
                                </button>
                            </form>
                        @else
                            <form method="POST" action="/admin/clients/{{ $client->id }}/activate" class="inline">
                                @csrf
                                @method('PATCH')
                                <button class="inline-flex items-center px-3 py-1.5 rounded-md bg-emerald-100 text-emerald-800 hover:bg-emerald-200">
                                    Activate
                                </button>
                            </form>
                        @endif

                        <form method="POST" action="/admin/clients/{{ $client->id }}" class="inline"
                              onsubmit="return confirm('Soft delete this client?');">
                            @csrf
                            @method('DELETE')
                            <button class="inline-flex items-center px-3 py-1.5 rounded-md bg-rose-100 text-rose-800 hover:bg-rose-200">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-6 text-center text-slate-500">No clients found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
