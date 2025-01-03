<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function catering()
    {
        $produk = Produk::with('jenis_produk')
        ->whereHas('jenis_produk', function ($query) {
            $query->where('id', '2'); // Ganti 'nama' dengan kolom yang sesuai di tabel jenis_produk
        })
        ->get();
        
        return view('catering', compact('produk'));
    }
    public function playground()
    {
        $produk = Produk::with('jenis_produk')
        ->whereHas('jenis_produk', function ($query) {
            $query->where('id', '1'); // Ganti 'nama' dengan kolom yang sesuai di tabel jenis_produk
        })
        ->get();
        
        return view('playground', compact('produk'));
    }
    public function beranda()
    {
        return view('frontend.beranda');
    }
   
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
