@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <h1 class="mb-3">
            Edit service for workshop: {{ $workshop->name }}
        </h1>

        <a href="{{ route('owner_services_index', $workshop->id) }}" class="btn btn-secondary mb-3">
            Back to services
        </a>

        {{-- flash poruka --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- validation errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>There were some problems with your input:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('owner_services_update', [$workshop->id, $service->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Service name</label>
                <input type="text"
                       name="name"
                       id="name"
                       class="form-control"
                       value="{{ old('name', $service->name) }}"
                       required>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="duration_minutes" class="form-label">Duration (minutes)</label>
                    <input type="number"
                           name="duration_minutes"
                           id="duration_minutes"
                           class="form-control"
                           value="{{ old('duration_minutes', $service->duration_minutes) }}"
                           required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="price_cents" class="form-label">Price (cents)</label>
                    <input type="number"
                           name="price_cents"
                           id="price_cents"
                           class="form-control"
                           value="{{ old('price_cents', $service->price_cents) }}"
                           required>
                </div>
            </div>

            <button type="submit" class="btn btn-success">
                Update service
            </button>

            <a href="{{ route('owner_services_index', $workshop->id) }}" class="btn btn-secondary ms-2">
                Cancel
            </a>
        </form>

        {{-- opciono: delete dugme i ovde --}}
        <form action="{{ route('owner_services_destroy', [$workshop->id, $service->id]) }}"
              method="POST"
              class="mt-3"
              onsubmit="return confirm('Are you sure you want to delete this service?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger">
                Delete this service
            </button>
        </form>

    </div>
@endsection
