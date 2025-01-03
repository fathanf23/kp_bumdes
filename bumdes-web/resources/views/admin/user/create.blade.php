@extends('admin.layout.app')
@section('content')

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h5 class="font-weight-bold mb-0">Tambah Data Produk</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{url('/admin/user/store')}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label text-dark font-weight-bold">Username</label>
                    <input type="text" class="form-control" id="jenis_produk" name="username"
                        placeholder="Masukan Username">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label text-dark font-weight-bold">Username</label>
                    <input type="password" class="form-control" id="" name="password"
                        placeholder="Masukan Username">
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary text-white mx-2"><i class="fas fa-check"></i>
                        Submit</button>
                    <a href="{{url('admin/jenis_produk/index')}}" class="btn btn-secondary text-white mx-2"><i
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