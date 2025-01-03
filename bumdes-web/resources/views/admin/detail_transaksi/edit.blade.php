@extends('admin.layout.app')
@section('content')

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h5 class="font-weight-bold mb-0">Edit Detail Transaksi</h5>
        </div>
        <div class="card-body">
            @foreach($detail_transaksi as $item)
            <form method="POST" action="{{url('/admin/detail_transaksi/update/'. $item->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="jenis_produk" class="form-label text-dark font-weight-bold">No Transaksi</label>
                    <select class="form-select" name="produk_id" id="jenis_produk">
                        <option selected disabled>{{$item->transaksi->no_transaksi}}</option>
                        @foreach($transaksi as $t)
                        <option value="{{$t->id}}">{{$t->no_transaksi}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jenis_produk" class="form-label text-dark font-weight-bold">Produk</label>
                    <select class="form-select" name="produk_id" id="jenis_produk">
                        <option selected disabled>{{$item->produk->nm_produk}}</option>
                        @foreach($produk as $item)
                        <option value="{{$item->id}}">{{$item->nm_produk}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label text-dark font-weight-bold">Jumlah</label>
                    <input type="number" class="form-control"  name="jumlah"
                        placeholder="Masukkan kategori/Jenis Produk">
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