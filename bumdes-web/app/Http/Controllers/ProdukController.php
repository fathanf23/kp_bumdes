<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\JenisProduk;
use DB;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::with(['jenis_produk'])->get();
        return view('admin.produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenis_produk = JenisProduk::get();
        return view('admin.produk.create', compact('jenis_produk'));
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nm_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string',
            'foto' => 'required|image|max:2048',
            'jenis_produk' => 'required|exists:jenis_produk,id',
        ]);
    
        // Menyimpan file foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            
            // Menggunakan nama file asli atau custom nama dari input
            $filename = $file->getClientOriginalName();
            $filepath = 'img_produk/'; // Direktori penyimpanan
            
            // Pindahkan file ke direktori tujuan
            $file->move(public_path($filepath), $filename);
    
            // Menyimpan data ke database menggunakan SQL
            DB::insert(
                'INSERT INTO produk (nm_produk, harga, deskripsi, foto, jenis_produk_id) VALUES (?, ?, ?, ?, ?)',
                [
                    $request->nm_produk,
                    $request->harga,
                    $request->deskripsi,
                    $filename, // Nama file foto
                    $request->jenis_produk,
                ]
            );
    
            // Redirect dengan pesan sukses
            return redirect('admin/produk/index')->with('success', 'Produk berhasil ditambahkan!');
        }
    
        // Jika file tidak ada
        return redirect()->back()->with('error', 'Foto produk wajib diunggah!');
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
        $produk = Produk::with('jenis_produk')->get()->where('id', $id);
        $jenis_produk = JenisProduk::get();
        return view('admin.produk.edit', compact('produk', 'jenis_produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Cari produk berdasarkan ID
        $produk = Produk::findOrFail($id);

        // Update data produk
        $produk->nm_produk = $request->nm_produk;
        $produk->harga = $request->harga;
        $produk->deskripsi = $request->deskripsi;
        $produk->jenis_produk_id = $request->jenis_produk_id;

        // Cek apakah ada foto baru diunggah
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($produk->foto && file_exists(public_path('img_produk/' . $produk->foto))) {
                unlink(public_path('img_produk/' . $produk->foto));
            }

            // Simpan foto baru
            $file = $request->file('foto');
            $nama_foto = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img_produk'), $nama_foto);
            $produk->foto = $nama_foto;
        }

        // Simpan perubahan ke database
        if ($produk->save()) {
            return redirect('admin/produk/index')->with('success', 'Produk berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui produk');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk = Produk::where('id', $id)->first();
        if (file_exists(public_path('img_produk/' . $produk->foto))) {
            unlink(public_path('img_produk/' . $produk->foto));
        }
        $produk->delete();
        return redirect('admin/produk/index');
    }

}
