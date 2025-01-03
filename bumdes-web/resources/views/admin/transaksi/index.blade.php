@extends('admin.layout.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-table me-1"></i>
                    DataTable Transaksi
                </div>
                <a href="{{ url('/admin/transaksi/create') }}" class="btn bg-primary d-flex align-items-center"
                    style="width: fit-content;">
                    <i class="fas fa-plus text-white mr-2"></i>
                    <span class="text-white font-weight-bold">Tambah Transaksi Baru</span>
                </a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Transaksi</th>
                            <th>Tanggal Transaksi</th>
                            <th>Metode Bayar</th>
                            <th>Total Bayar</th>
                            <th>Status</th>
                            <th>Jenis Transaksi</th>
                            <th>Bukti Bayar</th>
                            <th>Nama User</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>No Transaksi</th>
                            <th>Tanggal Transaksi</th>
                            <th>Metode Bayar</th>
                            <th>Total Bayar</th>
                            <th>Status</th>
                            <th>Jenis Transaksi</th>
                            <th>Bukti Bayar</th>
                            <th>Nama User</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($transaksi as $t)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$t->no_transaksi}}</td>
                            <td>{{$t->tanggal}}</td>
                            <td>{{$t->pembayaran}}</td>
                            <td>{{$t->total_bayar}}</td>
                            <td>{{$t->status}}</td>
                            <td>{{$t->jenis_transaksi}}</td>
                            <td>
                                <img src="{{ URL::asset('img_bukti_bayar/' . $t->bukti_bayar) }}" alt=""
                                    style="width: 100px; height: auto;">
                            </td>
                            <td>{{$t->user->username}}</td>
                            <td>
                                <!-- Tombol Delete -->
                                <a href="#" class="btn btn-md btn-danger px-2" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{$t->id}}">
                                    <i class="fas fa-trash"></i> Delete
                                </a>

                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal{{$t->id}}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{$t->id}}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{$t->id}}">Hapus Data</h5>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="fas fa-times"></i>
                                                </button>

                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus <strong>{{$t->no_transaksi}}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <a href="{{ url('admin/transaksi/destroy/' . $t->id) }}"
                                                    class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{url('admin/transaksi/edit/'.$t->id)}}"
                                    class="btn btn-md btn-primary px-2">
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