@extends('layouts.admin')

@section('content')

<h2>Update Ranking</h2>

<p><strong>Keyword:</strong> {{ $keyword->keyword }}</p>

<form method="POST" action="/admin/rankings">
@csrf

<input type="hidden" name="keyword_id" value="{{ $keyword->id }}">

<div class="mb-3">
    <label>Current Rank</label>
    <input type="number" name="rank" class="form-control">
</div>

<button class="btn btn-success">Save Ranking</button>

</form>

@endsection