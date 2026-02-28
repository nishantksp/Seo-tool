@extends('layouts.admin')

@section('content')

<h2>All Backlinks</h2>

<a href="{{ route('backlinks.create') }}" class="btn btn-primary mb-3">Add Backlink</a>

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

</table>

{{ $backlinks->links() }}

@endsection