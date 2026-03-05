@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-slate-900">@yield('page_title')</h1>
            @hasSection('page_subtitle')
                <p class="text-sm text-slate-600 mt-1">@yield('page_subtitle')</p>
            @endif
        </div>

        <div class="bg-white border border-slate-200 rounded-xl shadow-sm">
            <div class="p-6">
                @yield('page_content')
            </div>
        </div>
    </div>
</div>
@endsection