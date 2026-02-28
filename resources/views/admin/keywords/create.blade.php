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

<button class="btn btn-success">Save</button>

</form>

@endsection