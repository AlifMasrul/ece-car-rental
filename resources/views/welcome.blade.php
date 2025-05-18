<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Easy Car Enterprise</title>

    <!-- Google Font & Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f4f6f9;
        }

        .navbar {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .hero-section {
            background: linear-gradient(135deg, #e3f2fd, #ffffff);
            padding: 6rem 0;
            text-align: center;
            border-bottom: 1px solid #dee2e6;
        }

        .hero-section h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .hero-section p {
            font-size: 1.25rem;
            color: #555;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
        }

        .btn-lg {
            padding: 0.75rem 1.5rem;
            font-size: 1.125rem;
        }

        footer {
            background-color: #ffffff;
            padding: 2rem 0;
            text-align: center;
            color: #888;
            font-size: 0.9rem;
            margin-top: 4rem;
            border-top: 1px solid #dee2e6;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container-lg">
            <a class="navbar-brand fw-bold text-primary" href="/">Easy Car Enterprise</a>
            <div class="d-flex">
                @if (Route::has('login'))
                    <div>
                        @auth
                            <a href="{{ route('cars.index') }}" class="btn btn-outline-primary me-2">Browse Cars</a>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary me-2">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-success">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1>Welcome to Easy Car Enterprise</h1>
            <p>Your trusted source for convenient and affordable car rentals.</p>
            <hr class="my-4 w-25 mx-auto">
            @auth
                <p>Ready to find your perfect ride?</p>
                <a class="btn btn-lg btn-primary" href="{{ route('cars.index') }}">Browse Available Cars</a>
            @else
                <p>Please log in or register to browse our available cars.</p>
                <a class="btn btn-lg btn-primary me-2" href="{{ route('login') }}">Log In</a>
                @if (Route::has('register'))
                    <a class="btn btn-lg btn-success" href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    </div>

    <!-- About Section -->
    <div class="container-lg mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card p-4">
                    <div class="card-body">
                        <h3 class="card-title mb-3"><i class="bi bi-info-circle-fill text-primary me-2"></i>About Us</h3>
                        <p class="card-text">
                            Easy Car Enterprise is committed to providing reliable car rental services with a wide selection of vehicles to suit your needs. We operate in multiple locations including Bandar Baru Bangi, Shah Alam, and Gombak — always ready to serve you with convenience, affordability, and professionalism.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            &copy; {{ date('Y') }} Easy Car Enterprise. All rights reserved.
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons (Optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</body>

</html>
