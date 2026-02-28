@extends('layouts.app')

@section('content')
<h2>Client Dashboard</h2>
<hr>
<p>Total Keywords: {{ $keywords }}</p>
<p>Total Backlinks: {{ $backlinks }}</p>
@endsection