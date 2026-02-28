@extends('layouts.app')

@section('content')

<h2>Social Media Tracker</h2>

<a href="/client/social/create" class="btn btn-primary mb-3">Add Post</a>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card p-3 text-center">
            <h5>Total Posts</h5>
            <h3>{{ $totalPosts }}</h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3 text-center">
            <h5>Total Clicks</h5>
            <h3>{{ $totalClicks }}</h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3 text-center">
            <h5>Total Engagement</h5>
            <h3>{{ $totalEngagement }}</h3>
        </div>
    </div>
</div>

<table class="table table-bordered">
    <tr>
        <th>Platform</th>
        <th>Post URL</th>
        <th>Clicks</th>
        <th>Engagement</th>
        <th>Date</th>
    </tr>

    @foreach($posts as $post)
    <tr>
        <td>{{ ucfirst($post->platform) }}</td>
        <td>
            <a href="{{ $post->post_url }}" target="_blank">
                View Post
            </a>
        </td>
        <td>{{ $post->clicks }}</td>
        <td>{{ $post->engagement }}</td>
        <td>{{ $post->date }}</td>
    </tr>
    @endforeach
</table>

@endsection