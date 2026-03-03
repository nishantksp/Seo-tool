@extends('layouts.admin')

@section('content')

<h2>Add Keyword</h2>

<form method="POST" action="/admin/keywords">
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
    <label>Keyword</label>
    <input type="text" name="keyword" class="form-control">
</div>

<div class="mb-3">
    <label>Search Volume</label>
    <input type="number" name="search_volume" class="form-control">
</div>

<div class="mb-3">
    <label>Difficulty</label>
    <input type="number" name="difficulty" class="form-control">
</div>

<div class="mb-3">
    <label>Target URL</label>
    <input type="text" name="target_url" class="form-control">
</div>

<div class="mb-3">
    <label>Priority (1-10)</label>
    <input type="number" name="priority" class="form-control" min="1" max="10">
</div>

<div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control">
        <option value="active">Active</option>
        <option value="paused">Paused</option>
        <option value="archived">Archived</option>
    </select>
</div>

<button class="btn btn-success">Save</button>

</form>

@endsection
