@extends('layouts.app')

@section('content')

<h2>OnPage SEO Reports</h2>

<table class="table table-bordered">
<tr>
<th>URL</th>
<th>Score</th>
<th>Status</th>
<th>Date</th>
</tr>

@foreach($reports as $r)
<tr>
<td>{{ $r->url }}</td>
<td>{{ $r->seo_score }}/100</td>
<td>
@if($r->seo_score >= 80)
<span class="badge bg-success">Good</span>
@elseif($r->seo_score >= 50)
<span class="badge bg-warning">Average</span>
@else
<span class="badge bg-danger">Poor</span>
@endif
</td>
<td>{{ $r->checked_at }}</td>
</tr>
@endforeach

</table>

@endsection
