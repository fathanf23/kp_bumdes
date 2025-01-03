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
                <a href="{{ url('/admin/user/create') }}" class="btn bg-primary d-flex align-items-center"
                    style="width: fit-content;">
                    <i class="fas fa-plus text-white mr-2"></i>
                    <span class="text-white font-weight-bold">Tambah User</span>
                </a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Role</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($user as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->username}}</td>
                            <td>{{$item->password}}</td>
                            <td>{{$item->role}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

@endsection