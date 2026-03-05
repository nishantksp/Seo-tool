@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="text-2xl font-semibold text-slate-900">Add Keyword Assignment</h2>
        <p class="text-sm text-slate-600">Create a keyword and assign it to a website.</p>
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

    <form method="POST" action="/admin/keywords" class="space-y-8">
        @csrf

        <div class="bg-white border border-slate-200 rounded-xl p-6 space-y-6">
            <h3 class="text-sm font-semibold text-slate-900 uppercase tracking-wide">Assignment</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700">Website</label>
                    <select name="website_id" class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
                        @foreach($websites as $site)
                            <option value="{{ $site->id }}" {{ old('website_id') == $site->id ? 'selected' : '' }}>
                                {{ $site->domain }} ({{ $site->user->name }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700">Target URL</label>
                    <input type="text" name="target_url" value="{{ old('target_url') }}"
                           class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700">Priority (1-10)</label>
                    <input type="number" name="priority" min="1" max="10" value="{{ old('priority') }}"
                           class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700">Status</label>
                    <select name="status" class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
                        <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="paused" {{ old('status') === 'paused' ? 'selected' : '' }}>Paused</option>
                        <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700">Notes</label>
                    <textarea name="notes" rows="3"
                              class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">{{ old('notes') }}</textarea>
                </div>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-xl p-6 space-y-6">
            <h3 class="text-sm font-semibold text-slate-900 uppercase tracking-wide">Keyword Details</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700">Keyword</label>
                    <input type="text" name="keyword" value="{{ old('keyword') }}"
                           class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700">Intent</label>
                    <select name="intent" class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
                        <option value="">Select intent</option>
                        <option value="informational" {{ old('intent') === 'informational' ? 'selected' : '' }}>Informational</option>
                        <option value="transactional" {{ old('intent') === 'transactional' ? 'selected' : '' }}>Transactional</option>
                        <option value="navigational" {{ old('intent') === 'navigational' ? 'selected' : '' }}>Navigational</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700">Search Volume</label>
                    <input type="number" name="search_volume" value="{{ old('search_volume') }}"
                           class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700">Difficulty</label>
                    <input type="number" name="difficulty" value="{{ old('difficulty') }}"
                           class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700">Language</label>
                    <input type="text" name="language" value="{{ old('language', 'en') }}"
                           class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700">Country</label>
                    <input type="text" name="country" value="{{ old('country') }}"
                           class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700">CPC</label>
                    <input type="number" step="0.01" name="cpc" value="{{ old('cpc') }}"
                           class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700">Competition (0-100)</label>
                    <input type="number" name="competition" min="0" max="100" value="{{ old('competition') }}"
                           class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
                </div>

                <div class="flex items-center gap-2 pt-2">
                    <input type="checkbox" name="is_branded" value="1" {{ old('is_branded') ? 'checked' : '' }}
                           class="rounded border-slate-300 text-slate-900 focus:ring-slate-900">
                    <label class="text-sm text-slate-700">Branded keyword</label>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="/admin/keywords" class="text-sm text-slate-600 hover:text-slate-900">Cancel</a>
            <button type="submit" class="px-5 py-2 rounded-lg bg-slate-900 text-white text-sm font-medium hover:bg-slate-800">
                Save Keyword
            </button>
        </div>
    </form>
</div>
@endsection
