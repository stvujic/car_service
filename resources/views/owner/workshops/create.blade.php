@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <h1 class="mb-4">Add New Workshop</h1>

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

        <form action="{{ route('owner_workshops_store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Workshop name</label>
                <input type="text" name="name" id="name"
                       class="form-control"
                       value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" name="city" id="city"
                       class="form-control"
                       value="{{ old('city') }}" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" id="address"
                       class="form-control"
                       value="{{ old('address') }}" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone"
                       class="form-control"
                       value="{{ old('phone') }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Short description</label>
                <textarea name="description" id="description"
                          class="form-control"
                          rows="4">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">
                Save Workshop
            </button>

            <a href="{{ route('owner_workshops_index') }}" class="btn btn-secondary ms-2">
                Cancel
            </a>
        </form>

    </div>
@endsection
