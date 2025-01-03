@extends('admin.layout.app')
@section('content')

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h5 class="font-weight-bold mb-0">Tambah Data Detail Transaksi</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{url('/admin/detail_transaksi/store')}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="jenis_produk" class="form-label text-dark font-weight-bold">Produk</label>
                    <select class="form-select" name="produk_id" id="jenis_produk">
                        <option selected disabled>Pilih Produk</option>
                        @foreach($produk as $item)
                        <option value="{{$item->id}}">{{$item->nm_produk}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jenis_produk" class="form-label text-dark font-weight-bold">Nomor Transaksi</label>
                    <select class="form-select" name="transaksi_id" id="jenis_produk">
                        <option selected disabled>Pilih No Transaksi</option>
                        @foreach($transaksi as $item)
                        <option value="{{$item->id}}">{{$item->no_transaksi}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jenis_produk" class="form-label text-dark font-weight-bold">Quantity</label>
                    <input type="number" class="form-control" id="jenis_produk" name="jumlah"
                        placeholder="Masukan Jumlah Produk">
                </div>
                    <button type="submit" class="btn btn-primary text-white mx-2"><i class="fas fa-check"></i>
                        Submit</button>
                    <a href="{{url('admin/detail_transaksi/index')}}" class="btn btn-secondary text-white mx-2"><i
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