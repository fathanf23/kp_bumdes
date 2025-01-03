@extends('admin.layout.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-table me-1"></i>
                    DataTable Produk
                </div>
                <a href="{{ url('/admin/produk/create') }}" class="btn bg-primary d-flex align-items-center"
                   style="width: fit-content;">
                    <i class="fas fa-plus text-white mr-2"></i>
                    <span class="text-white font-weight-bold">Tambah Produk</span>
                </a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga Produk</th>
                            <th>Deskripsi</th>
                            <th>Foto</th>
                            <th>Jenis Produk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga Produk</th>
                            <th>Deskripsi</th>
                            <th>Foto</th>
                            <th>Jenis Produk</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($produk as $p)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$p->nm_produk}}</td>
                            <td>{{$p->harga}}</td>
                            <td>{{$p->deskripsi}}</td>
                            <td>
                                <img src="{{ URL::asset('img_produk/' . $p->foto) }}" alt="" style="width: 100px; height: auto;">
                            </td>
                            <td>{{$p->jenis_produk->jenis_produk}}</td>
                            <td>
                        <!-- Tombol Delete -->
                        <a href="#" class="btn btn-md btn-danger px-2" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{$p->id}}">
                            <i class="fas fa-trash"></i> Delete
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal{{$p->id}}" tabindex="-1"
                            aria-labelledby="deleteModalLabel{{$p->id}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{$p->id}}">Hapus Data</h5>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            <i class="fas fa-times"></i>
                                        </button>

                                    </div>
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus <strong>{{$p->nm_produk}}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <a href="{{ url('admin/produk/destroy/' . $p->id) }}"
                                            class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{url('admin/produk/edit/'.$p->id)}}" class="btn btn-md btn-primary px-2"> 
                        <i class="fas fa-edit"></i></i> Edit
                        </a>
                    </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

@endsection
