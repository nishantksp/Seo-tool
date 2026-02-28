@extends('layouts.admin')

@section('content')

<h2>Add Social Post</h2>

<form method="POST" action="/admin/social">
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
<label>Platform</label>
<select name="platform" class="form-control">
<option value="facebook">Facebook</option>
<option value="instagram">Instagram</option>
<option value="twitter">Twitter</option>
<option value="linkedin">LinkedIn</option>
</select>
</div>

<div class="mb-3">
<label>Post URL</label>
<input type="text" name="post_url" class="form-control">
</div>

<div class="mb-3">
<label>Clicks</label>
<input type="number" name="clicks" class="form-control">
</div>

<div class="mb-3">
<label>Engagement</label>
<input type="number" name="engagement" class="form-control">
</div>

<div class="mb-3">
<label>Date</label>
<input type="date" name="date" class="form-control">
</div>

<button class="btn btn-success">Save</button>

</form>

@endsection