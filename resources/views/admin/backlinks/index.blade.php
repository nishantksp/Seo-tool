@extends('layouts.admin')

@section('content')

<h2>All Backlinks</h2>

<a href="{{ route('backlinks.create') }}" class="btn btn-primary mb-3">Add Backlink</a>


<form method="GET" action="{{ url('/admin/backlinks') }}">
    <select name="website_id" onchange="this.form.submit()">
        <option value="">All Websites</option>
        @foreach ($allWebsites as $w)
            <option value="{{ $w->id }}"
                {{ request('website_id') == $w->id ? 'selected' : '' }}>
                {{ $w->domain }}
            </option>
        @endforeach
    </select>
</form>


<!-- showing website selected website with its keyword details  -->
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Keyword</th>
        <th>First Rank</th>
        <th>Best Rank</th>
        <th>Date</th>
    </tr>

    @foreach( $keywords as $keyword)
    <tr>
        <td>{{$keyword->id}}</td>
        <td>{{$keyword->keyword}}</td>
        <td>30</td>
        <td>30</td>
        <td>{{$keyword->created_at}}</td>
       
    </tr>
    @endforeach
</table>
<!-- 
<table class="table table-bordered">
    <tr>
        <th>Client</th>
        <th>Website</th>
        <th>Source URL</th>
        <th>DA</th>
        <th>Type</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

@foreach($backlinks as $link)
<tr>
    <td>{{ $link->website->user->name }}</td>
    <td>{{ $link->website->domain }}</td>
    <td>{{ $link->source_url }}</td>
    <td>{{ $link->da }}</td>
    <td>
        @if($link->link_type == 'dofollow')
            <span class="badge bg-success">DoFollow</span>
        @else
            <span class="badge bg-secondary">NoFollow</span>
        @endif
    </td>
    <td>
        @if($link->status == 'active')
            <span class="badge bg-success">Active</span>
        @else
            <span class="badge bg-danger">Lost</span>
        @endif
    </td>
    <td>
        <a href="/admin/backlinks/{{ $link->id }}/edit" class="btn btn-sm btn-warning">Edit</a>

        <form action="/admin/backlinks/{{ $link->id }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger">Delete</button>
        </form>
    </td>
</tr>
@endforeach

</table> -->

{{ $backlinks->links() }}

@endsection