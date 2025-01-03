<!DOCTYPE html>
<html lang="en">

<head>
    <title>FoodMart - BUMDes eCommerce</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="BUMDes Dev">
    <meta name="keywords" content="Grocery, eCommerce, BUMDes">
    <meta name="description" content="eCommerce BUMDes website">

    <!-- External CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ URL::asset('frontend/css/vendor.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('frontend/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Navbar Section -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
    <div class="container">
        <a class="navbar-brand fw-bold fs-3 text-dark" href="#">BUMDes</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('beranda') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Playground</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Catering</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Produk</a>
                </li>
            </ul>

            <div class="d-flex align-items-center ms-3">
                @if(Auth::check())
                <!-- Cart Icon -->
                <a href="{{ route('cart') }}" class="position-relative me-3">
                    <i class="fas fa-shopping-cart text-dark fa-2x"></i>
                    @if (count((array) session('cart')) > 0)
                    <span
                        class="position-absolute bg-success rounded-circle d-flex align-items-center justify-content-center text-white"
                        style="top: -5px; right: -10px; height: 20px; min-width: 20px; font-size: 0.8rem;">
                        {{ count((array) session('cart')) }}
                    </span>
                    @endif
                </a>

                <!-- User Info -->
                <span class="fw-bold me-3">@if (empty(Auth::user()->username))
                                {{ 'Tamu' }}
                                @else
                                {{ Auth::user()->username }}
                                @endif</span>

                <!-- Logout Button -->
                <form action="{{ route('logout') }}"  style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">
                        Logout
                    </button>
                </form>
                @else
                <!-- Login Link for Guests -->
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
                    Login
                </a>
                @endif
            </div>
        </div>
    </div>
</nav>

    <!-- Add your content here -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
