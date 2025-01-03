@extends('frontend.layouts.app')

@section('title', 'Catering')

@section('content')
<div class="container py-5">
    <h1 class="text-center fw-bold mb-5" style="color: #1a202c;">Menu Catering</h1>
    <div class="row g-4">
        @foreach($produk as $item)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card shadow-sm border-0">
                <img src="{{ URL::asset('img_produk/' . $item->foto) }}" 
                     alt="{{ $item->nm_produk }}" 
                     class="card-img-top" 
                     style="height: 180px; object-fit: cover; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">{{ $item->nm_produk }}</h5>
                    <p class="card-text text-muted">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                    <a href="{{ route('add.to.cart', $item->id) }}" class="btn btn-primary w-100">
                        Add to Cart
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
