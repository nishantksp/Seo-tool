@extends('layouts.admin')

@section('content')

<h2>Add Website</h2>

<form method="POST" action="/admin/websites">
@csrf

<div class="mb-3">
    <label>Client</label>
    <select name="user_id" class="form-control">
        @foreach($clients as $client)
        <option value="{{ $client->id }}">{{ $client->name }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Domain</label>
    <input type="text" name="domain" class="form-control">
</div>

<div class="mb-3">
    <label>Country</label>
    <select name="country" class="form-control">
        <option value="">Select Country</option>
        @foreach($countries as $country)
            <option value="{{ $country }}">{{ $country }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Niche</label>
    <select name="niche" class="form-control">
        <option value="">Select Niche</option>
        @foreach($niches as $niche)
            <option value="{{ $niche }}">{{ $niche }}</option>
        @endforeach
    </select>
</div>

<button class="btn btn-success">Save</button>

</form>

@endsection