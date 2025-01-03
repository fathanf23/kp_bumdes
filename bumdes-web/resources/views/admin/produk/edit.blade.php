@extends('admin.layout.app')
@section('content')

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h5 class="font-weight-bold mb-0">Tambah Data Produk</h5>
        </div>
        <div class="card-body">
        @foreach($produk as $p)
            <form method="POST" action="{{url('admin/produk/update/'. $p->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nm_produk" class="form-label text-dark font-weight-bold">Nama Produk</label>
                    <input type="text" class="form-control" value="{{$p->nm_produk}}" id="nm_produk" name="nm_produk"
                        placeholder="Masukkan nama produk">
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label text-dark font-weight-bold">Harga Produk</label>
                    <input type="number" class="form-control" value="{{$p->harga}}" id="harga" name="harga"
                        placeholder="Masukkan harga produk">
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label text-dark font-weight-bold">Deskripsi</label>
                    <input type="text" class="form-control" value="{{$p->deskripsi}}" id="harga" name="deskripsi"
                        placeholder="Masukkan harga produk">
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label text-dark font-weight-bold">Pilih Foto Baru</label>
                    <input type="file" value="{{$p->foto}}" class="form-control" id="foto" name="foto">
                    <h6 class="font-weight-bold text-dark">Foto Sebelumnya :</h6>
                    <img src="{{ URL::asset('img_produk/' . $p->foto) }}" alt="" style="width: 100px; height: auto;">

                </div>
                <div class="mb-3">
                    <label for="jenis_produk" class="form-label text-dark font-weight-bold">Jenis Produk</label>
                    <select class="form-select" name="jenis_produk_id" id="jenis_produk">
                        <option>{{$p->jenis_produk->id}}</option>
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