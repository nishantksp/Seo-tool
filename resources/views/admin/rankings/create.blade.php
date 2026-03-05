@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="text-2xl font-semibold text-slate-900">Update Ranking</h2>
        <p class="text-sm text-slate-600">Add a new ranking snapshot for this keyword assignment.</p>
    </div>

    <div class="bg-white border border-slate-200 rounded-xl p-6 space-y-2">
        <div class="text-sm text-slate-500">Keyword</div>
        <div class="text-lg font-semibold text-slate-900">{{ $assignment->keyword->keyword }}</div>
        <div class="text-sm text-slate-500">Website</div>
        <div class="text-sm text-slate-900">{{ $assignment->website->domain }}</div>
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

    <form method="POST" action="/admin/rankings" class="space-y-6">
        @csrf
        <input type="hidden" name="keyword_assignment_id" value="{{ $assignment->id }}">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-slate-700">Current Rank</label>
                <input type="number" name="rank" value="{{ old('rank') }}"
                       class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700">Search Engine</label>
                <select name="search_engine" class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
                    <option value="google" {{ old('search_engine') === 'google' ? 'selected' : '' }}>Google</option>
                    <option value="bing" {{ old('search_engine') === 'bing' ? 'selected' : '' }}>Bing</option>
                    <option value="yahoo" {{ old('search_engine') === 'yahoo' ? 'selected' : '' }}>Yahoo</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700">Location</label>
                <input type="text" name="location" value="{{ old('location') }}" placeholder="e.g., New York, US"
                       class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700">Device Type</label>
                <select name="device_type" class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
                    <option value="desktop" {{ old('device_type') === 'desktop' ? 'selected' : '' }}>Desktop</option>
                    <option value="mobile" {{ old('device_type') === 'mobile' ? 'selected' : '' }}>Mobile</option>
                </select>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="/admin/keywords" class="text-sm text-slate-600 hover:text-slate-900">Cancel</a>
            <button type="submit" class="px-5 py-2 rounded-lg bg-slate-900 text-white text-sm font-medium hover:bg-slate-800">
                Save Ranking
            </button>
        </div>
    </form>
</div>
@endsection
