@extends('admin.clients.layout')

@section('page_title', 'Edit Client')
@section('page_subtitle', 'Update profile details, contact info, or reset password.')

@section('page_content')
<form method="POST" action="/admin/clients/{{ $client->id }}" class="space-y-6">
    @csrf
    @method('PUT')

    @include('admin.clients.partials.form', [
        'client' => $client
    ])

    <div class="flex items-center justify-end gap-3">
        <a href="/admin/clients" class="text-sm text-slate-600 hover:text-slate-900">
            Cancel
        </a>
        <button type="submit"
                class="px-5 py-2 rounded-lg bg-slate-900 text-white text-sm font-medium hover:bg-slate-800">
            Update Client
        </button>
    </div>
</form>

<div class="mt-10 border-t pt-6">
    <h3 class="text-sm font-semibold text-slate-900 mb-2">Reset Password</h3>
    <form method="POST" action="/admin/clients/{{ $client->id }}/reset-password" class="space-y-4">
        @csrf
        @method('PATCH')

        <div>
            <label class="block text-sm font-medium text-slate-700">New Password</label>
            <input type="password" name="password"
                   class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700">Confirm Password</label>
            <input type="password" name="password_confirmation"
                   class="mt-1 w-full rounded-lg border-slate-300 focus:border-slate-900 focus:ring-slate-900">
        </div>

        <button type="submit"
                class="px-4 py-2 rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200 text-sm font-medium">
            Reset Password
        </button>
    </form>
</div>
@endsection
