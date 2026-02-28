@extends('layouts.admin')

@section('content')

<h2>Edit Website</h2>

<form method="POST" action="/admin/websites/{{ $website->id }}">
@csrf
@method('PUT')

<div class="mb-3">
    <label>Client</label>
    <select name="user_id" class="form-control">
        @foreach($clients as $client)
            <option value="{{ $client->id }}"
                {{ $website->user_id == $client->id ? 'selected' : '' }}>
                {{ $client->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Domain</label>
    <input type="text" name="domain" class="form-control"
        value="{{ $website->domain }}">
</div>

<div class="mb-3">
    <label>Country</label>
    <select name="country" class="form-control">
        @foreach($countries as $country)
            <option value="{{ $country }}"
                {{ $website->country == $country ? 'selected' : '' }}>
                {{ $country }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Niche</label>
    <select name="niche" class="form-control">
        @foreach($niches as $niche)
            <option value="{{ $niche }}"
                {{ $website->niche == $niche ? 'selected' : '' }}>
                {{ $niche }}
            </option>
        @endforeach
    </select>
</div>

<button class="btn btn-success">Update</button>

</form>

@endsection