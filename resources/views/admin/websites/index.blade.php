@extends('layouts.admin')

@section('content')

<h2>All Websites</h2>

<a href="/admin/websites/create" class="btn btn-primary mb-3">Add Website</a>

<table class="table table-bordered">
    <tr>
        <th>Domain</th>
        <th>Client</th>
        <th>Country</th>
        <th>Niche</th>
    </tr>

    @foreach($websites as $site)
    <tr>
        <td>{{ $site->domain }}</td>
        <td>{{ $site->user->name }}</td>
        <td>{{ $site->country }}</td>
        <td>{{ $site->niche }}</td>
    </tr>
    @endforeach
</table>

@endsection