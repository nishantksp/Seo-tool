@extends('layouts.admin')

@section('content')

<h2>All Websites</h2>

<a href="/admin/websites/create" class="btn btn-primary mb-3">Add Website</a>


<table class="table table-bordered">
    <tr>
        <th>Domain</th>
        <th>Client</th>
        <th>Country</th>
        <th>Niche</th>
        <th>Keywords</th>
        <th>Action</th>
    </tr>

    @foreach($websites as $site)
    <tr>
        <td>{{ $site->domain }}</td>
        <td>{{ $site->user->name }}</td>
        <td>{{ $site->country }}</td>
        <td>{{ $site->niche }}</td>
        <td>

    <button class="btn btn-sm btn-info"
        data-bs-toggle="modal"
        data-bs-target="#keywordsModal{{ $site->id }}">
        View Keywords ({{ $site->keywords->count() }})
    </button>
</td>
        
        <td>
            <!-- Edit Button -->
            <a href="/admin/websites/{{ $site->id }}/edit" class="btn btn-sm btn-warning">
                Edit
            </a>

            <!-- Delete Button -->
            <form action="/admin/websites/{{ $site->id }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger"
                    onclick="return confirm('Are you sure you want to delete this website?')">
                    Delete
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection
@foreach($websites as $site)

<div class="modal fade" id="keywordsModal{{ $site->id }}" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">
            Keywords - {{ $site->domain }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        @if($site->keywords->count() > 0)
            <ul class="list-group">
                @foreach($site->keywords as $keyword)
                    <li class="list-group-item">
                        {{ $keyword->keyword }}
                    </li>
                @endforeach
            </ul>
        @else
            <p>No keywords found.</p>
        @endif
      </div>

    </div>
  </div>
</div>

@endforeach