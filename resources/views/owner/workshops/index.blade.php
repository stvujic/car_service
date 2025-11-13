@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <h1 class="mb-4">My Workshops</h1>

        {{-- flash poruke --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- dugme za novi workshop --}}
        <div class="mb-3">
            <a href="{{ route('owner_workshops_create') }}" class="btn btn-primary">
                Add New Workshop
            </a>
        </div>

        @if ($workshops->isEmpty())
            <div class="alert alert-info">
                You don't have any workshops yet.
            </div>
        @else
            <table class="table table-striped align-middle">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>City</th>
                    <th>Verified</th>
                    <th class="text-end">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($workshops as $workshop)
                    <tr>
                        <td>{{ $workshop->name }}</td>
                        <td>{{ $workshop->city }}</td>
                        <td>
                            @if ($workshop->is_verified)
                                <span class="badge bg-success">Verified</span>
                            @else
                                <span class="badge bg-secondary">Pending</span>
                            @endif
                        </td>
                        <td class="text-end">
                            {{-- Public prikaz --}}
                            <a href="{{ route('workshops_show', $workshop->slug) }}"
                               class="btn btn-sm btn-outline-secondary">
                                View public
                            </a>

                            {{-- Edit --}}
                            <a href="{{ route('owner_workshops_edit', $workshop->id) }}"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            {{-- Delete --}}
                            <form action="{{ route('owner_workshops_destroy', $workshop->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this workshop?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{-- paginacija --}}
            <div class="mt-3">
                {{ $workshops->links() }}
            </div>
        @endif

    </div>
@endsection
