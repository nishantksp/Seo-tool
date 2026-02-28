@extends('layouts.admin')

@section('content')

<h2>All Keywords</h2>

<a href="/admin/keywords/create" class="btn btn-primary mb-3">Add Keyword</a>

<table class="table table-bordered">
<tr>
    <th>Client</th>
    <th>Website</th>
    <th>Keyword</th>
    <th>Search Volume</th>
    <th>Difficulty</th>
    <th>Action</th>
</tr>

@foreach($keywords as $key)
<tr>
    <td>{{ $key->website->user->name }}</td>
    <td>{{ $key->website->domain }}</td>
    <td>{{ $key->keyword }}</td>
    <td>{{ $key->search_volume }}</td>
    <td>{{ $key->difficulty }}</td>
    <td>
        <a href="/admin/keywords/{{ $key->id }}/ranking"
   class="btn btn-sm btn-info">
   Update Rank
</a>
        <a href="/admin/keywords/{{ $key->id }}/edit" class="btn btn-sm btn-warning">Edit</a>

        <form action="/admin/keywords/{{ $key->id }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger">Delete</button>
        </form>
    </td>
</tr>
@endforeach

</table>

{{ $keywords->links() }}

@endsection