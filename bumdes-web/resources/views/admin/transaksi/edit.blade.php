@extends('admin.layout.app')
@section('content')

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h5 class="font-weight-bold mb-0">Edit Data Transaksi</h5>
        </div>
        <div class="card-body">
            @foreach($transaksi as $item)
            <form method="POST" action="{{url('/admin/transaksi/update/'. $item->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label text-dark font-weight-bold">Metode Pembayaran</label>
                    <select class="form-select" name="pembayaran" id="jenis_produk">
                        <option selected>{{$item->pembayaran}}</option>
                        <option value="CASH">CASH<option>
                        <option value="TRANSFER">TRANSFER<option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label text-dark font-weight-bold">Status Transaksi</label>
                    <select class="form-select" name="status" id="jenis_produk">
                        <option selected>{{$item->status}}</option>
                        <option value="PENDING">Pending<option>
                        <option value="SUCCESS">Success<option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label text-dark font-weight-bold">Jenis Transaksi</label>
                    <select class="form-select" name="jenis_transaksi" id="">
                        <option selected>{{$item->jenis_transaksi}}</option>
                        <option value="CATERING">Catering<option>
                        <option value="PLAYGROUND">Playground<option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label text-dark font-weight-bold">Bukti Pembayaran</label>
                    <input type="file" class="form-control" id="foto" name="bukti_bayar">
                    <img src="{{ URL::asset('img_bukti_bayar/' . $item->bukti_bayar) }}" alt="" style="width: 100px; height: auto;">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label text-dark font-weight-bold">Total Bayar</label>
                    <input type="text" value="{{$item->total_bayar}}" class="form-control" id="" name="total_bayar">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label text-dark font-weight-bold">Username</label>
                    <input type="text" readonly value="{{$item->user->username}}" class="form-control" id="" name="user_id">
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary text-white mx-2"><i class="fas fa-check"></i>
                        Submit</button>
                    <a href="{{url('admin/jenis_produk/index')}}" class="btn btn-secondary text-white mx-2"><i
                            class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </form>
            @endforeach
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