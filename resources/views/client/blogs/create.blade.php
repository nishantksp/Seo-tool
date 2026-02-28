@extends('layouts.app')

@section('content')

<h2>Create Blog</h2>

<form method="POST" action="/client/blogs">
@csrf

<div class="mb-3">
    <label>Website</label>
    <select name="website_id" class="form-control">
        @foreach($websites as $site)
        <option value="{{ $site->id }}">{{ $site->domain }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Title</label>
    <input type="text" name="title" class="form-control">
</div>

<div class="mb-3">
    <label>Meta Title</label>
    <input type="text" name="meta_title" class="form-control">
</div>

<div class="mb-3">
    <label>Meta Description</label>
    <textarea name="meta_description" class="form-control"></textarea>
</div>

<div class="mb-3">
    <label>Content</label>
    <textarea name="content" rows="6" class="form-control"></textarea>
</div>

<div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control">
        <option value="draft">Draft</option>
        <option value="published">Published</option>
    </select>
</div>

<button class="btn btn-success">Save Blog</button>

</form>

@endsection