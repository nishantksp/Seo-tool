@extends('layouts.admin')

@section('content')

<h2>OnPage Reports</h2>

<a href="/admin/onpage/create" class="btn btn-primary mb-3">Add Report</a>

<table class="table table-bordered">
<tr>
<th>Client</th>
<th>Website</th>
<th>URL</th>
<th>SEO Score</th>
<th>Date</th>
<th>Action</th>
</tr>

@foreach($reports as $r)
<tr>
<td>{{ $r->website->user->name }}</td>
<td>{{ $r->website->domain }}</td>
<td>{{ $r->url }}</td>
<td>{{ $r->seo_score }}/100</td>
<td>{{ $r->checked_at }}</td>
<td>
<form action="/admin/onpage/{{ $r->id }}" method="POST">
@csrf
@method('DELETE')
<button class="btn btn-danger btn-sm">Delete</button>
</form>
</td>
</tr>
@endforeach

</table>

{{ $reports->links() }}

@endsection