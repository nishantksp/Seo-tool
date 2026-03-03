@extends('layouts.admin')

@section('content')

<h2>Update Ranking</h2>

<p><strong>Keyword:</strong> {{ $assignment->keyword->keyword }}</p>
<p><strong>Website:</strong> {{ $assignment->website->domain }}</p>

<form method="POST" action="/admin/rankings">
@csrf

<input type="hidden" name="keyword_assignment_id" value="{{ $assignment->id }}">

<div class="mb-3">
    <label>Current Rank</label>
    <input type="number" name="rank" class="form-control">
</div>

<div class="mb-3">
    <label>Search Engine</label>
    <select name="search_engine" class="form-control">
        <option value="google">Google</option>
        <option value="bing">Bing</option>
        <option value="yahoo">Yahoo</option>
    </select>
</div>

<div class="mb-3">
    <label>Location</label>
    <input type="text" name="location" class="form-control" placeholder="e.g., New York, US">
</div>

<div class="mb-3">
    <label>Device Type</label>
    <select name="device_type" class="form-control">
        <option value="desktop">Desktop</option>
        <option value="mobile">Mobile</option>
    </select>
</div>

<button class="btn btn-success">Save Ranking</button>

</form>

@endsection
