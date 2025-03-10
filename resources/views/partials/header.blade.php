<nav class="navbar navbar-expand-lg navbar-light">

    <!-- Brand/Logo or Home link -->
    <a href="{{ $theme->url }}">
        <img width="150px" src="{{ asset('assets/img/' . $theme->logo) }}" alt="Theme Logo" class="mb-0">
    </a>

    <!-- Toggle for mobile view -->

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links and profile section -->
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <!-- Check if user is authenticated -->
            @if (Auth::user())
                <!-- Profile Section -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{-- <img src="{{ Auth::user()->avatar }}" alt="User Profile Picture"
                            class="img-fluid rounded-circle border border-info shadow-sm" width="40"> --}}
                        <span class="ms-2">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('info.index') }}">Profile</a></li>
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

</nav>
