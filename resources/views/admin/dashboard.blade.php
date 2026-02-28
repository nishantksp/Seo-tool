@extends('layouts.admin')

@section('content')
<h2>Admin Dashboard</h2>
<hr>
<p>Total Clients: {{ $clients }}</p>
<p>Total Websites: {{ $websites }}</p>
<p>Total Keywords: {{ $keywords }}</p>
@endsection