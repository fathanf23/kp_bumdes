@extends ('frontend.layouts.app')
@section('content')
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">Register</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{url('/register/store')}}">
                            @csrf
                            <div class="form-floating mb-3">
                                <input class="form-control" id="" name="nama" type="text"
                                    placeholder="Masukan Nama Lengkap Anda!" />
                                <label for="inputEmail">Nama Lengkap</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="" name="alamat" type="text"
                                    placeholder="Masukan Alamat Anda!" />
                                <label for="inputEmail">Alamat</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputEmail" name="username" type="text"
                                    placeholder="Buat Username Untuk Login" />
                                <label for="inputEmail">Username Untuk Login</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputPassword" name="password" type="password"
                                    placeholder="Password" />
                                <label for="inputPassword">Password</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                            </div>
                            <div class=" d-flex justify-content-center">
                                <button name="submit" type="submit" class="btn bg-primary text-white">Buat Akun</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small"><a href="{{url('login')}}">Already have an account? login!</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection