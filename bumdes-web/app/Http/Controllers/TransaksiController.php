<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = Transaksi::with('user')->get();
        return view('admin.transaksi.index', compact('transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::get();
        return view('admin.transaksi.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $lastEntry = DB::table('transaksi')->orderBy('no_transaksi', 'desc')->first();

    if ($lastEntry) {
        $lastNumber = (int)substr($lastEntry->no_transaksi, 1);
        $newNumber = $lastNumber + 1;
    } else {
        $newNumber = 1;
    }
    $newNoTransaksi = 'A' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        // Menyimpan file foto
        if ($request->hasFile('bukti_bayar')) {
            $file = $request->file('bukti_bayar');
            $filename = $file->getClientOriginalName();
            $filepath = 'img_bukti_bayar/'; // Direktori penyimpanan
            
            // Pindahkan file ke direktori tujuan
            $file->move(public_path($filepath), $filename);
            DB::table('transaksi')->insert([
                'no_transaksi' => $newNoTransaksi, // Nomor pendaftaran otomatis
                'tanggal' => now(),
                'pembayaran' => $request->input('pembayaran'),
                'total_bayar' => $request->input('total_bayar'),
                'status' => 'Pending',
                'jenis_transaksi' => $request->input('jenis_transaksi'),
                'bukti_bayar' => $filename,
                'user_id' => $request->input('user_id'),
            ]);
    
            // Redirect dengan pesan sukses
            return redirect('admin/transaksi/index')->with('success', 'Produk berhasil ditambahkan!');
        }
            // Menyimpan data ke database menggunakan SQL
    }
    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $user = User::all();
        $transaksi = Transaksi::get()->where('id', $id);
        return view('admin.transaksi.edit', compact('user', 'transaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // Update data produk
        $transaksi->pembayaran = $request->pembayaran;
        $transaksi->status = $request->status;
        $transaksi->total_bayar = $request->total_bayar;
        $transaksi->jenis_transaksi = $request->jenis_transaksi;

        // Cek apakah ada foto baru diunggah
        if ($request->hasFile('bukti_bayar')) {
            // Hapus foto lama jika ada
            if ($transaksi->bukti_bayar && file_exists(public_path('img_bukti_bayar/' . $transaksi->bukti_bayar))) {
                unlink(public_path('img_bukti_bayar/' . $transaksi->bukti_bayar));
            }

            // Simpan foto baru
            $file = $request->file('bukti_bayar');
            $nama_foto = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img_bukti_bayar'), $nama_foto);
            $transaksi->bukti_bayar = $nama_foto;
        }

        // Simpan perubahan ke database
        if ($transaksi->save()) {
            return redirect('admin/transaksi/index')->with('success', 'Produk berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui produk');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::where('id', $id)->first();
        if (file_exists(public_path('img_bukti_bayar/' . $transaksi->bukti_bayar))) {
            unlink(public_path('img_bukti_bayar/' . $transaksi->bukti_bayar));
        }
        $transaksi->delete();
        return redirect('admin/transaksi/index');
    }
}
