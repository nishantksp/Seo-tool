@extends('layouts.app')

@section('content')

<h2>My Website</h2>

<table class="table table-bordered">
    <tr>
        <th>Domain</th>
        <th>Country</th>
        <th>Niche</th>
    </tr>

    @foreach($websites as $site)
    <tr>
        <td>{{ $site->domain }}</td>
        <td>{{ $site->country }}</td>
        <td>{{ $site->niche }}</td>
    </tr>
    @endforeach
</table>

@endsection