@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="text-2xl font-semibold text-slate-900">My Keywords</h2>
        <p class="text-sm text-slate-600">Track your latest rankings and changes.</p>
    </div>

    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-100 text-slate-700">
                <tr>
                    <th class="px-4 py-3 text-left">Keyword</th>
                    <th class="px-4 py-3 text-left">Current Rank</th>
                    <th class="px-4 py-3 text-left">Previous Rank</th>
                    <th class="px-4 py-3 text-left">Change</th>
                    <th class="px-4 py-3 text-left">Last Updated</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($keywords as $keyword)
                    @php
                        $latest = $keyword->latestRanking;
                        $change = null;

                        if ($latest && $latest->previous_rank) {
                            $change = $latest->previous_rank - $latest->rank;
                        }
                    @endphp

                    <tr>
                        <td class="px-4 py-3 font-medium text-slate-900">
                            {{ $keyword->keyword->keyword }}
                        </td>
                        <td class="px-4 py-3">{{ $latest->rank ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $latest->previous_rank ?? '-' }}</td>
                        <td class="px-4 py-3">
                            @if($change > 0)
                                <span class="text-emerald-700 bg-emerald-50 px-2 py-1 rounded-full text-xs">Up {{ $change }}</span>
                            @elseif($change < 0)
                                <span class="text-rose-700 bg-rose-50 px-2 py-1 rounded-full text-xs">Down {{ abs($change) }}</span>
                            @else
                                <span class="text-slate-500">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">{{ $latest->checked_at ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-slate-500">
                            No keywords assigned yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
