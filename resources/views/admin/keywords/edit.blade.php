@extends('layouts.admin')

@section('content')

<h2>Edit Keyword</h2>

<form method="POST" action="/admin/keywords/{{ $keyword->id }}">
@csrf
@method('PUT')

<div class="mb-3">
    <label>Website</label>
    <select name="website_id" class="form-control">
        @foreach($websites as $site)
        <option value="{{ $site->id }}" {{ $keyword->website_id == $site->id ? 'selected' : '' }}>
            {{ $site->domain }} ({{ $site->user->name }})
        </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Keyword</label>
    <input type="text" name="keyword" class="form-control" value="{{ $keyword->keyword->keyword }}">
</div>

<div class="mb-3">
    <label>Search Volume</label>
    <input type="number" name="search_volume" class="form-control" value="{{ $keyword->keyword->search_volume ?? '' }}">
</div>

<div class="mb-3">
    <label>Difficulty</label>
    <input type="number" name="difficulty" class="form-control" value="{{ $keyword->keyword->difficulty ?? '' }}">
</div>

<div class="mb-3">
    <label>Target URL</label>
    <input type="text" name="target_url" class="form-control" value="{{ $keyword->target_url ?? '' }}">
</div>

<div class="mb-3">
    <label>Priority (1-10)</label>
    <input type="number" name="priority" class="form-control" min="1" max="10" value="{{ $keyword->priority }}">
</div>

<div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control">
        <option value="active" {{ $keyword->status === 'active' ? 'selected' : '' }}>Active</option>
        <option value="paused" {{ $keyword->status === 'paused' ? 'selected' : '' }}>Paused</option>
        <option value="archived" {{ $keyword->status === 'archived' ? 'selected' : '' }}>Archived</option>
    </select>
</div>

<button class="btn btn-success">Update</button>

</form>

@endsection
