<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DB;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function login_proses(Request $request)
    {
        $data = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($data)) {
            $user = Auth::user();

            if ($user->role == 'Admin') {
                return redirect()->route('admin');
            } elseif ($user->role == 'Pelanggan') {
                return redirect()->route('beranda');
            } else {
                return redirect('/'); 
            }
        } else {
            return redirect()->route('login')->with('failed', 'Username atau Password Salah!');
        }
    }
    
    public function register()
    {
        return view('register');
    }
    public function registerStore(Request $request)
    {
    $hashedPassword = bcrypt($request->password);
        //tambah data menggunakan query builder
        DB::table('user')->insert([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'username'=>$request->username,
            'password'=>$hashedPassword,
            'role'=> 'Pelanggan',
        ]);
        return redirect('/login')->with('success', 'Berhasil Menambahkan Data');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('beranda')->with('success', 'Kamu berhasil Logout');
    }
}
