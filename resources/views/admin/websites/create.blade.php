@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="text-2xl font-semibold text-slate-900">Add Website</h2>
        <p class="text-sm text-slate-600">Create a new website and assign it to a client.</p>
    </div>

    @if ($errors->any())
        <div class="rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/admin/websites" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-slate-700">Client</label>
                <select name="user_id" class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ old('user_id') == $client->id ? 'selected' : '' }}>
                            {{ $client->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700">Domain</label>
                <input type="text" name="domain"
                       value="{{ old('domain') }}"
                       class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700">Country</label>
                <select name="country" class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
                    <option value="">Select country</option>
                    @foreach($countries as $country)
                        <option value="{{ $country }}" {{ old('country') == $country ? 'selected' : '' }}>
                            {{ $country }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700">Niche</label>
                <select name="niche" class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
                    <option value="">Select niche</option>
                    @foreach($niches as $niche)
                        <option value="{{ $niche }}" {{ old('niche') == $niche ? 'selected' : '' }}>
                            {{ $niche }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700">Status</label>
                <select name="status" class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
                    <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="paused" {{ old('status') === 'paused' ? 'selected' : '' }}>Paused</option>
                </select>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="/admin/websites" class="text-sm text-slate-600 hover:text-slate-900">Cancel</a>
            <button type="submit" class="px-5 py-2 rounded-lg bg-slate-900 text-white text-sm font-medium hover:bg-slate-800">
                Save Website
            </button>
        </div>
    </form>
</div>
@endsection
