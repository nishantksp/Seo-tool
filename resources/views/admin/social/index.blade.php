@extends('layouts.admin')

@section('content')

<h2>All Social Posts</h2>

<form method="GET" class="mb-3">
    <select name="platform" onchange="this.form.submit()" class="form-control w-25">
        <option value="">All Platforms</option>
        <option value="facebook">Facebook</option>
        <option value="instagram">Instagram</option>
        <option value="twitter">Twitter</option>
        <option value="linkedin">LinkedIn</option>
    </select>
</form>

<a href="/admin/social/create" class="btn btn-primary mb-3">Add Post</a>

<table class="table table-bordered">
<tr>
<th>Client</th>
<th>Website</th>
<th>Platform</th>
<th>Clicks</th>
<th>Engagement</th>
<th>Date</th>
<th>Action</th>
</tr>

@foreach($posts as $post)
<tr>
<td>{{ $post->website->user->name }}</td>
<td>{{ $post->website->domain }}</td>
<td>{{ ucfirst($post->platform) }}</td>
<td>{{ $post->clicks }}</td>
<td>{{ $post->engagement }}</td>
<td>{{ $post->date }}</td>
<td>
<a href="/admin/social/{{ $post->id }}/edit"
   class="btn btn-sm btn-warning">Edit</a>

<form action="/admin/social/{{ $post->id }}"
      method="POST"
      style="display:inline;">
@csrf
@method('DELETE')
<button class="btn btn-sm btn-danger">Delete</button>
</form>
</td>
</tr>
@endforeach

</table>

{{ $posts->links() }}

@endsection