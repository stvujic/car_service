@extends('layouts.app')

@section('content')

    {{-- HERO SECTION --}}
    <div class="hero-section">
        <div class="hero-overlay"></div>

        <div class="hero-content">
            <h1 class="display-4 fw-bold mb-4">Find Your Trusted Car Service</h1>

            @guest
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-3">
                    Login
                </a>

                <a href="{{ route('register') }}" class="btn btn-success btn-lg">
                    Register
                </a>
            @endguest
        </div>
    </div>



    {{-- ABOUT SECTION --}}
    <div class="container" id="about">
        <h2 class="section-title text-center">About Us</h2>

        <p class="lead text-center">
            Car Service App helps drivers find verified and reliable car workshops, book services,
            and manage appointments with ease. Workshop owners can manage their services,
            working hours, and bookings through a simple dashboard.
        </p>
    </div>



    {{-- WORKSHOPS SECTION --}}
    <div class="container" id="workshops">
        <h2 class="section-title text-center">Available Workshops</h2>

        <div class="row">

            @foreach ($workshops as $workshop)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">

                        <div class="card-body">
                            <h5 class="card-title">{{ $workshop->name }}</h5>

                            <p class="card-text text-muted">{{ $workshop->city }}</p>

                            <a href="{{ route('workshops_show', $workshop->slug) }}"
                               class="btn btn-primary">
                                View Workshop
                            </a>
                        </div>

                    </div>
                </div>
            @endforeach

        </div>
    </div>



    {{-- CONTACT SECTION --}}
    <div class="container" id="contact">
        <h2 class="section-title text-center">Contact Us</h2>

        <div class="row justify-content-center">
            <div class="col-md-6">

                <form>
                    <div class="mb-3">
                        <label class="form-label">Your Name</label>
                        <input type="text" class="form-control" placeholder="John Doe">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Your Email</label>
                        <input type="email" class="form-control" placeholder="email@example.com">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea class="form-control" rows="5"
                                  placeholder="How can we help you?"></textarea>
                    </div>

                    <button class="btn btn-success w-100">Send Message</button>
                </form>

            </div>
        </div>
    </div>

@endsection
