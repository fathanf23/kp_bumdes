@extends('admin.layout.app')
@section('content')

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h5 class="font-weight-bold mb-0">Tambah Data Produk</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{url('/admin/produk/store')}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nm_produk" class="form-label text-dark font-weight-bold">Nama Produk</label>
                    <input type="text" class="form-control" id="nm_produk" name="nm_produk"
                        placeholder="Masukkan nama produk">
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label text-dark font-weight-bold">Harga Produk</label>
                    <input type="number" class="form-control" id="harga" name="harga"
                        placeholder="Masukkan harga produk">
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label text-dark font-weight-bold">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"
                        placeholder="Masukkan deskripsi produk"></textarea>
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label text-dark font-weight-bold">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                </div>
                <div class="mb-3">
                    <label for="jenis_produk" class="form-label text-dark font-weight-bold">Jenis Produk</label>
                    <select class="form-select" name="jenis_produk" id="jenis_produk">
                        <option selected disabled>Pilih Jenis Produk</option>
                        @foreach($jenis_produk as $item)
                        <option value="{{$item->id}}">{{$item->jenis_produk}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary text-white mx-2"><i class="fas fa-check"></i>
                        Submit</button>
                    <a href="{{url('admin/produk/index')}}" class="btn btn-secondary text-white mx-2"><i
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