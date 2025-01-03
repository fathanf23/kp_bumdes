<?php

namespace App\Http\Controllers;

use App\Models\JenisProduk;
use Illuminate\Http\Request;
use DB;

class JenisProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenis_produk = JenisProduk::get();
        return view('admin.jenis_produk.index', compact('jenis_produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jenis_produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::table('jenis_produk')->insert([
            'jenis_produk' => $request->input('jenis_produk'),
        ]); 
        return redirect('admin/jenis_produk/index');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisProduk $jenisProduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $jenis_produk = JenisProduk::get()->where('id', $id);
        return view('admin.jenis_produk.edit', compact('jenis_produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        DB::table('jenis_produk')->where('id', $id)->update([
            'jenis_produk' => $request->input('jenis_produk'),
        ]);
        return redirect('admin/jenis_produk/index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $jenis_produk = JenisProduk::where('id', $id)->first();
        $jenis_produk->delete();
        return redirect('admin/jenis_produk/index');
    }
}
