@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <h1 class="mb-4">Edit Workshop</h1>

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

        <form action="{{ route('owner_workshops_update', $workshop->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Workshop name</label>
                <input type="text" name="name" id="name"
                       class="form-control"
                       value="{{ old('name', $workshop->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" name="city" id="city"
                       class="form-control"
                       value="{{ old('city', $workshop->city) }}" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" id="address"
                       class="form-control"
                       value="{{ old('address', $workshop->address) }}" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone"
                       class="form-control"
                       value="{{ old('phone', $workshop->phone) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Short description</label>
                <textarea name="description" id="description"
                          class="form-control"
                          rows="4">{{ old('description', $workshop->description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">
                Update Workshop
            </button>

            <a href="{{ route('owner_workshops_index') }}" class="btn btn-secondary ms-2">
                Back
            </a>
        </form>

        {{-- 👇👇👇 NOVI DEO: SERVICES ZA OVAJ WORKSHOP --}}

        <hr class="my-4">

        <h2 class="mb-3">Services for this workshop</h2>

        {{-- Forma za dodavanje nove usluge --}}
        <div class="card mb-4">
            <div class="card-header">
                Add new service
            </div>
            <div class="card-body">
                <form action="{{ route('owner_services_store', $workshop->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Service name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Duration (minutes)</label>
                            <input type="number" name="duration_minutes" class="form-control" value="{{ old('duration_minutes') }}" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Price (cents)</label>
                            <input type="number" name="price_cents" class="form-control" value="{{ old('price_cents') }}" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Price (RSD)</label>
                            <input type="number" name="price" class="form-control" value="{{ old('price') }}">
                            <div class="form-text">Optional if you're using cents system.</div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Add service
                    </button>
                </form>
            </div>
        </div>

        {{-- Lista postojećih usluga --}}
        <h3 class="mb-3">Existing services</h3>

        @if($workshop->services->isEmpty())
            <p class="text-muted">There are no services for this workshop yet.</p>
        @else
            <table class="table table-bordered align-middle">
                <thead>
                <tr>
                    <th>Name</th>
                    <th style="width: 120px;">Price</th>
                    <th style="width: 200px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($workshop->services as $service)
                    <tr>
                        <td colspan="3">
                            <form action="{{ route('owner_services_update', [$workshop->id, $service->id]) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row g-3 align-items-end">

                                    <div class="col-md-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name"
                                               class="form-control"
                                               value="{{ old('name_'.$service->id, $service->name) }}">
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Duration (minutes)</label>
                                        <input type="number" name="duration_minutes"
                                               class="form-control"
                                               value="{{ old('duration_minutes_'.$service->id, $service->duration_minutes) }}">
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Price (cents)</label>
                                        <input type="number" name="price_cents"
                                               class="form-control"
                                               value="{{ old('price_cents_'.$service->id, $service->price_cents) }}">
                                    </div>

                                    <div class="col-md-3 d-flex gap-2">
                                        <button type="submit" class="btn btn-success w-100">
                                            Save
                                        </button>

                                        <form action="{{ route('owner_services_destroy', [$workshop->id, $service->id]) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger w-100">
                                                Delete
                                            </button>
                                        </form>
                                    </div>

                                </div>

                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif


    </div>
@endsection
