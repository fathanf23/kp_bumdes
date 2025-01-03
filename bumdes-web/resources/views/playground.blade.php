@extends('frontend.layouts.app')
@section('content')

<section class="py-5" style="background-color: #f7f7f7;">
    <div class="container">
    <div class="d-flex align-items-center justify-content-center mb-4">
            <h1 class="fw-bold">Playground Ticket</h1>
        </div>
        <div class="row">
            @foreach ($produk as $item)
            <div class="col-12 mb-4">
                <div class="d-flex flex-column flex-md-row align-items-center shadow p-3 bg-white" 
                    style="border-radius: 15px;">
                    <!-- Gambar Produk -->
                    <div class="text-center mb-3 mb-md-0" style="flex: 1;">
                        <img src="{{ asset('img_produk/' . $item->foto) }}" alt="{{ $item->nm_produk }}" 
                            class="img-fluid" 
                            style="max-width: 100%; height: auto; object-fit: cover; border-radius: 10px; max-height: 300px;">
                    </div>
                    <!-- Deskripsi Produk -->
                    <div class="ms-md-4 text-center text-md-start" style="flex: 1;">
                        <h3 class="fw-bold" style="font-size: 1.8rem;">{{ $item->nm_produk }}</h3>
                        <p class="text-muted mb-2" style="font-size: 1rem;">{{ $item->deskripsi }}</p>
                        <h4 class="text-primary fw-bold mb-4" style="font-size: 1.5rem;">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </h4>
                        <!-- Tombol Add to Cart -->
                        <a href="{{ route('add.to.cart', $item->id) }}" class="btn btn-primary w-100">
                        Add to Cart
                    </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
