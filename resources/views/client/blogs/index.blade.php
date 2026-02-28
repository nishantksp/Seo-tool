@extends('layouts.app')

@section('content')

<h2>My Blogs</h2>

<a href="/client/blogs/create" class="btn btn-primary mb-3">Add Blog</a>

<table class="table table-bordered">
    <tr>
        <th>Title</th>
        <th>Status</th>
        <th>Created</th>
    </tr>

    @foreach($blogs as $blog)
    <tr>
        <td>{{ $blog->title }}</td>
        <td>
            @if($blog->status == 'published')
                <span class="badge bg-success">Published</span>
            @else
                <span class="badge bg-secondary">Draft</span>
            @endif
        </td>
        <td>{{ $blog->created_at->format('d M Y') }}</td>
    </tr>
    @endforeach
</table>

@endsection