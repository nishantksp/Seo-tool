@extends('layouts.app')

@section('content')
<h2>My Keywords</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Keyword</th>
            <th>Current Rank</th>
            <th>Previous Rank</th>
            <th>Change</th>
            <th>Last Updated</th>
        </tr>
    </thead>
    <tbody>
        @foreach($keywords as $keyword)

        @php
            $latest = $keyword->latestRanking;
            $change = null;

            if($latest && $latest->previous_rank){
                $change = $latest->previous_rank - $latest->rank;
            }
        @endphp

        <tr>
            <td>{{ $keyword->keyword->keyword }}</td>

            <td>
                {{ $latest->rank ?? '-' }}
            </td>

            <td>
                {{ $latest->previous_rank ?? '-' }}
            </td>

            <td>
                @if($change > 0)
                    <span class="text-success">Up {{ $change }}</span>
                @elseif($change < 0)
                    <span class="text-danger">Down {{ abs($change) }}</span>
                @else
                    -
                @endif
            </td>

            <td>
                {{ $latest->checked_at ?? '-' }}
            </td>
        </tr>

        @endforeach
    </tbody>
</table>

@endsection
