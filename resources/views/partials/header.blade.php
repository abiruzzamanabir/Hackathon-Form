<!-- resources/views/layouts/partials/header.blade.php -->

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <!-- Brand/Logo or Home link -->
        <a class="navbar-brand" href="{{ url('/') }}">Your App Name</a>

        <!-- Toggle for mobile view -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links and profile section -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Check if user is authenticated -->
                @if (Auth::user())
                    <!-- Profile Section -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ Auth::user()->avatar }}" alt="User Profile Picture" class="img-fluid rounded-circle border border-info shadow-sm" width="40">
                            <span class="ms-2">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('google.logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @else
                    <!-- Optionally, you can add a login link if the user is not authenticated -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('case.index') }}">Login</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
