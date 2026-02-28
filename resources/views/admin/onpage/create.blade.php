@extends('layouts.admin')

@section('content')

<h2>Add OnPage Report</h2>

<form method="POST" action="/admin/onpage">
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
<label>URL</label>
<input type="text" name="url" class="form-control">
</div>

<div class="mb-3">
<label>Title Length</label>
<input type="number" name="title_length" class="form-control">
</div>

<div class="mb-3">
<label>Meta Length</label>
<input type="number" name="meta_length" class="form-control">
</div>

<div class="mb-3">
<label>H1 Count</label>
<input type="number" name="h1_count" class="form-control">
</div>

<div class="mb-3">
<label>H2 Count</label>
<input type="number" name="h2_count" class="form-control">
</div>

<div class="mb-3">
<label>Images Missing ALT</label>
<input type="number" name="image_alt_missing" class="form-control">
</div>

<div class="mb-3">
<label>Internal Links</label>
<input type="number" name="internal_links" class="form-control">
</div>

<button class="btn btn-success">Save Report</button>

</form>

@endsection