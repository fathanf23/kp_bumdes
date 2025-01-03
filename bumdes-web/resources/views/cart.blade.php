@extends('frontend.layouts.app')

@section('title', 'Cart')

@section('content')
<div class="container py-5">
    <h1 class="text-center fw-bold mb-4">Your Cart</h1>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th scope="col" class="text-center">Foto</th>
                <th scope="col">Nama Produk</th>
                <th scope="col" class="text-center">Harga Produk</th>
                <th scope="col" class="text-center">Jenis Produk</th>
                <th scope="col" class="text-center">Quantity</th>
                <th scope="col" class="text-center">Total</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @if(session('cart'))
            @foreach(session('cart') as $id => $details)
            @php $total += $details['harga'] * $details['qty']; @endphp
            <tr>
                <td class="text-center" style="width: 120px;">
                    <img src="{{ asset('img_produk/' . $details['foto']) }}" alt="{{ $details['nm_produk'] }}"
                        class="img-fluid rounded" style="max-height: 100px;">
                </td>
                <td>{{ $details['nm_produk'] }}</td>
                <td class="text-center">Rp {{ number_format($details['harga'], 0, ',', '.') }}</td>
                <td class="text-center">
                    @if($details['jenis_produk'] == 1)
                    Playground
                    @elseif($details['jenis_produk'] == 2)
                    Catering
                    @else
                    Unknown
                    @endif
                </td>
                <td class="text-center">{{ $details['qty'] }}</td>
                <td class="text-center">Rp {{ number_format($details['harga'] * $details['qty'], 0, ',', '.') }}</td>
                <td class="text-center">
                    <form action="{{ route('cart.remove', $id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm remove-from-cart">
                            <i class="fa fa-trash"></i> Remove
                        </button>
                    </form>

                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="6" class="text-center">Your cart is empty!</td>
            </tr>
            @endif
        </tbody>
    </table>
    <div class="text-end">
        <h4 class="fw-bold">Total: Rp {{ number_format($total, 0, ',', '.') }}</h4>
        <a href="/catering" class="btn btn-success mt-3">Tambah Belanjaan Catering</a>
        <a href="/playground" class="btn btn-warning mt-3">Tambah Belanjaan Ticket Playground</a>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#checkoutModal">
    Proceed to Checkout
</button>    </div>

</div>
<!-- Button Trigger -->


<!-- Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('checkout.process') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutModalLabel">Checkout Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Total Harga -->
                    <div class="mb-3">
                        <label for="totalBayar" class="form-label">Total Bayar</label>
                        <input type="text" class="form-control" id="totalBayar" value="Rp {{ number_format($total, 0, ',', '.') }}" readonly>
                    </div>
                    <!-- Pembayaran -->
                    <div class="mb-3">
                        <label for="payment" class="form-label">Metode Pembayaran</label>
                        <select class="form-select" id="payment" name="payment" required>
                            <option value="" disabled selected>Pilih metode pembayaran</option>
                            <option value="CASH">CASH</option>
                            <option value="TRANSFER">TRANSFER</option>
                        </select>
                    </div>
                    <!-- Bukti Pembayaran -->
                    <div class="mb-3" id="buktiBayarInput" style="display: none;">
                    <label for="foto" class="form-label text-dark font-weight-bold">Bukti Pembayaran</label>
                    <input type="file" class="form-control" id="foto" name="bukti_bayar">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.getElementById('payment').addEventListener('change', function () {
        const buktiBayarInput = document.getElementById('buktiBayarInput');
        if (this.value === 'TRANSFER') {
            buktiBayarInput.style.display = 'block';
        } else {
            buktiBayarInput.style.display = 'none';
        }
    });
</script>


@endsection