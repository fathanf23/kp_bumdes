@extends('frontend.layouts.app')
@section('content')

<section class="py-3" style="background-image: url('images/background-pattern.jpg');background-repeat: no-repeat;background-size: cover;">
    <div class="container-fluid">
        <!-- Hero Section -->
        <div class="row">
            <div class="col-md-12 text-center text-white banner-section">
                <h1 class="display-3 fw-bold mt-5">BUMDes</h1>
                <p class="fs-5">BADAN USAHA MILIK DESA</p>
            </div>
        </div>    
        <!-- End Hero Section -->

        <!-- Services Section -->
        <div class="row mt-5">
            <!-- Kartu 1 -->
            <div class="col-md-6">
                <a href="{{ route('playground') }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-0">
                            <img src="{{ asset('frontend/images/playground.jpg') }}" class="img-fluid w-100" alt="Playground" style="height: 300px; object-fit: cover;">
                            <div class="overlay d-flex justify-content-center align-items-center">
                                <h3 class="text-white">Playground</h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Kartu 2 -->
            <div class="col-md-6">
                <a href="{{ route('catering') }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-0">
                            <img src="{{ asset('frontend/images/catering.jpg') }}" class="img-fluid w-100" alt="Catering" style="height: 300px; object-fit: cover;">
                            <div class="overlay d-flex justify-content-center align-items-center">
                                <h3 class="text-white">Catering</h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- End Services Section -->
    </div>
</section>

<style>
    .banner-section {
        background-image: url('/frontend/images/beranda.jpg'); /* Path gambar */
        background-size: cover; /* Membuat gambar menutupi area */
        background-position: center; /* Menyesuaikan posisi gambar */
        height: 60vh; /* Tinggi area */
        display: flex; /* Membantu pusatkan konten */
        flex-direction: column; /* Atur konten vertikal */
        justify-content: center; /* Pusatkan secara vertikal */
        align-items: center; /* Pusatkan secara horizontal */
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7); /* Tambahkan bayangan teks agar lebih jelas */
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background: rgba(0, 0, 0, 0.5);
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    .card:hover .overlay {
        opacity: 1;
    }
</style>

@endsection
