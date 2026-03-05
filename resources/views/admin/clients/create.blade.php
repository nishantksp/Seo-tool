@extends('admin.clients.layout')

@section('page_title', 'Create Client')
@section('page_subtitle', 'Add a new client with profile information.')

@section('page_content')
<form method="POST" action="/admin/clients" class="space-y-6">
    @csrf

    @include('admin.clients.partials.form', [
        'client' => null
    ])

    <div class="flex items-center justify-end gap-3">
        <a href="/admin/clients" class="text-sm text-slate-600 hover:text-slate-900">
            Cancel
        </a>
        <button type="submit"
                class="px-5 py-2 rounded-lg bg-slate-900 text-white text-sm font-medium hover:bg-slate-800">
            Save Client
        </button>
    </div>
</form>
@endsection
