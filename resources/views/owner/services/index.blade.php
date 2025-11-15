@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <h1 class="mb-3">
            Services for workshop: {{ $workshop->name }}
        </h1>

        <a href="{{ route('owner_workshops_index') }}" class="btn btn-secondary mb-3">
            Back to my workshops
        </a>

        <a href="{{ route('owner_services_create', $workshop->id) }}" class="btn btn-primary mb-3 ms-2">
            Add new service
        </a>

        {{-- flash poruka --}}
        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        {{-- ako nema servisa --}}
        @if($services->isEmpty())
            <p class="mt-3 text-muted">
                There are no services for this workshop yet.
            </p>
        @else
            <table class="table table-bordered mt-3 align-middle">
                <thead>
                <tr>
                    <th>Name</th>
                    <th style="width: 150px;">Duration (minutes)</th>
                    <th style="width: 150px;">Price (cents)</th>
                    <th style="width: 200px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($services as $service)
                    <tr>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->duration_minutes }}</td>
                        <td>{{ $service->price_cents }}</td>
                        <td>
                            <a href="{{ route('owner_services_edit', [$workshop->id, $service->id]) }}"
                               class="btn btn-sm btn-outline-primary">
                                Edit
                            </a>

                            <form action="{{ route('owner_services_destroy', [$workshop->id, $service->id]) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this service?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
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
                {{ $services->links() }}
            </div>
        @endif
    </div>
@endsection
