@extends('layouts.app')

@section('content')

<h2>My Backlinks</h2>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card p-3 text-center">
            <h5>Total</h5>
            <h3>{{ $total }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3 text-center">
            <h5>Active</h5>
            <h3 class="text-success">{{ $active }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3 text-center">
            <h5>Lost</h5>
            <h3 class="text-danger">{{ $lost }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3 text-center">
            <h5>DoFollow</h5>
            <h3>{{ $dofollow }}</h3>
        </div>
    </div>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Source URL</th>
            <th>Anchor Text</th>
            <th>DA</th>
            <th>Link Type</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
        @foreach($backlinks as $link)
        <tr>
            <td>
                <a href="{{ $link->source_url }}" target="_blank">
                    {{ $link->source_url }}
                </a>
            </td>

            <td>{{ $link->anchor_text }}</td>

            <td>{{ $link->da ?? '-' }}</td>

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

        </tr>
        @endforeach
    </tbody>
</table>

@endsection