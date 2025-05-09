<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Easy Car Enterprise</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Y9PmytcbvPpNxx6ts3EyJDvAnvK/zqzjny9c0B+jFOlyu4oVD5PtogQ9v+nuAAXX" crossorigin="anonymous">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        .hero-section {
            background-color: #f8f9fa;
            padding: 5rem 0;
            text-align: center;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #1e7e34;
            border-color: #1e7e34;
        }
    </style>
</head>

<body class="antialiased">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Easy Car Enterprise</a>
            <div class="d-flex">
                @if (Route::has('login'))
                    <div>
                        @auth
                            <a href="{{ route('cars.index') }}" class="btn btn-secondary me-2">Browse Cars</a>
                            <form method="POST" action="{{ route('logout') }}">
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

    <div class="hero-section">
        <div class="container">
            <h1 class="display-4">Welcome to Easy Car Enterprise</h1>
            <p class="lead">Your trusted source for convenient and affordable car rentals.</p>
            <hr class="my-4">
            @auth
                <p>Ready to find your perfect ride?</p>
                <a class="btn btn-lg btn-primary" href="{{ route('cars.index') }}" role="button">Browse Available Cars</a>
            @else
                <p>Please log in or register to browse our available cars.</p>
                <a class="btn btn-lg btn-primary me-2" href="{{ route('login') }}" role="button">Log In</a>
                @if (Route::has('register'))
                    <a class="btn btn-lg btn-success" href="{{ route('register') }}" role="button">Register</a>
                @endif
            @endauth
        </div>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">About Us</h2>
                        <p class="card-text">Easy Car Enterprise is dedicated to providing reliable car rental services
                            with a wide selection of vehicles to suit your needs. With branches in Bandar Baru Bangi, Shah
                            Alam, and Gombak, we're ready to serve you.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Y8Si9Pb3eqbjWqyWvAiUZ6ztc9OuKmwXjz7tUOa7kt9vP9vmazegGGnYPhxYzKC" crossorigin="anonymous">
    </script>
</body>

</html>