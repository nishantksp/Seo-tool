@extends('layouts.admin')

@section('content')

<h2>Edit Social Post</h2>

<form method="POST" action="/admin/social/{{ $post->id }}">
@csrf
@method('PUT')

<div class="mb-3">
<label>Website</label>
<select name="website_id" class="form-control">
@foreach($websites as $site)
<option value="{{ $site->id }}"
    {{ $post->website_id == $site->id ? 'selected' : '' }}>
    {{ $site->domain }} ({{ $site->user->name }})
</option>
@endforeach
</select>
</div>

<div class="mb-3">
<label>Platform</label>
<select name="platform" class="form-control">
<option value="facebook" {{ $post->platform=='facebook'?'selected':'' }}>Facebook</option>
<option value="instagram" {{ $post->platform=='instagram'?'selected':'' }}>Instagram</option>
<option value="twitter" {{ $post->platform=='twitter'?'selected':'' }}>Twitter</option>
<option value="linkedin" {{ $post->platform=='linkedin'?'selected':'' }}>LinkedIn</option>
</select>
</div>

<div class="mb-3">
<label>Post URL</label>
<input type="text" name="post_url"
       value="{{ $post->post_url }}"
       class="form-control">
</div>

<div class="mb-3">
<label>Clicks</label>
<input type="number" name="clicks"
       value="{{ $post->clicks }}"
       class="form-control">
</div>

<div class="mb-3">
<label>Engagement</label>
<input type="number" name="engagement"
       value="{{ $post->engagement }}"
       class="form-control">
</div>

<div class="mb-3">
<label>Date</label>
<input type="date" name="date"
       value="{{ $post->date }}"
       class="form-control">
</div>

<button class="btn btn-success">Update</button>

</form>

@endsection