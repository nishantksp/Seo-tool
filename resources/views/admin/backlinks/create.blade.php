@extends('layouts.admin')

@section('content')

<h2>Add Backlink</h2>

<form method="POST" action="/admin/backlinks">
@csrf

<div class="mb-3">
    <label>Website</label>
    <select name="website_id" class="form-control">
        @foreach($websites as $site)
        <option value="{{ $site->id }}">
            {{ $site->domain }} ({{ $site->user->name }})
        </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Source URL</label>
    <input type="text" name="source_url" class="form-control">
</div>

<div class="mb-3">
    <label>Target URL</label>
    <input type="text" name="target_url" class="form-control">
</div>

<div class="mb-3">
    <label>Anchor Text</label>
    <input type="text" name="anchor_text" class="form-control">
</div>

<div class="mb-3">
    <label>DA</label>
    <input type="number" name="da" class="form-control">
</div>

<div class="mb-3">
    <label>Link Type</label>
    <select name="link_type" class="form-control">
        <option value="dofollow">DoFollow</option>
        <option value="nofollow">NoFollow</option>
    </select>
</div>

<div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control">
        <option value="active">Active</option>
        <option value="lost">Lost</option>
    </select>
</div>

<button class="btn btn-success">Save</button>

</form>

@endsection