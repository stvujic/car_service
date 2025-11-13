<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Service</title>

    {{-- BOOTSTRAP CSS --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>
        /* Hero background */
        .hero-section {
            background: url('https://images.unsplash.com/photo-1581091215367-59abcbf87d1d?auto=format&fit=crop&w=1350&q=80')
            center center/cover no-repeat;
            height: 80vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-overlay {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.45);
        }

        .hero-content {
            position: relative;
            z-index: 3;
            text-align: center;
            color: white;
        }

        .section-title {
            margin-top: 60px;
            margin-bottom: 20px;
        }
    </style>

</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">

        <a class="navbar-brand" href="{{ route('home') }}">
            CarService
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#about">About us</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#workshops">Workshops</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
            </ul>

            {{-- AUTH BUTTONS --}}
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-light me-2">
                    Login
                </a>
                <a href="{{ route('register') }}" class="btn btn-light">
                    Register
                </a>
            @endguest

            @auth
                <span class="text-light me-3">
                        Hi, {{ Auth::user()->name }}
                    </span>

                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-danger">Logout</button>
                </form>
            @endauth

        </div>
    </div>
</nav>


{{-- PAGE CONTENT --}}
<main style="margin-top: 56px;">
    @yield('content')
</main>


{{-- FOOTER --}}
<footer class="bg-dark text-light text-center py-4 mt-5">
    <p class="mb-0">&copy; {{ date('Y') }} Car Service App. All rights reserved.</p>
</footer>


{{-- BOOTSTRAP JS --}}
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
</script>

</body>
</html>
