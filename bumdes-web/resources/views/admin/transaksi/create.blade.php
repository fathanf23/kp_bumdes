@extends('admin.layout.app')
@section('content')

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h5 class="font-weight-bold mb-0">Tambah Data Transaksi</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{url('/admin/transaksi/store')}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="jenis_produk" class="form-label text-dark font-weight-bold">Metode Pembayaran</label>
                    <select class="form-select" name="pembayaran" id="jenis_produk">
                        <option selected disabled>Pilih Metode</option>
                        <option value="TRANSFER">Transfer</option>
                        <option value="CASH">Cash</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label text-dark font-weight-bold">Total Bayar</label>
                    <input type="text" class="form-control" id="foto" placeholder="Masukan total bayar!" name="total_bayar">
                </div>
                
                <div class="mb-3">
                    <label for="jenis_produk" class="form-label text-dark font-weight-bold">Jenis Transaksi</label>
                    <select class="form-select" name="jenis_transaksi" id="jenis_produk">
                        <option selected disabled>Pilih Jenis Transaksi</option>
                        <option value="Playground">Playground</option>
                        <option value="Makanan">Makanan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jenis_produk" class="form-label text-dark font-weight-bold">User/Pelanggan</label>
                    <select class="form-select" name="user_id" id="jenis_produk">
                        <option selected disabled>Pilih Pelanggan</option>
                        @foreach($user as $item)
                        <option value="{{$item->id}}">{{$item->username}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label text-dark font-weight-bold">Bukti Pembayaran</label>
                    <input type="file" class="form-control" id="foto" name="bukti_bayar">
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary text-white mx-2"><i class="fas fa-check"></i>
                        Submit</button>
                    <a href="{{url('admin/transaksi/index')}}" class="btn btn-secondary text-white mx-2"><i
                            class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

@if(session('error'))
<script>
Swal.fire({
    title: 'Gagal!',
    text: "{{ session('error') }}",
    icon: 'error',
    confirmButtonText: 'OK'
});
</script>
@endif

@endsection