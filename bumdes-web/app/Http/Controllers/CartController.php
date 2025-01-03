<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\JenisProduk;
use DB;
class CartController extends Controller
{
    public function addToCart($id)
{
    $produk = Produk::with('jenis_produk')->findOrFail($id);
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['qty']++;
        $cart[$id]['harga'] += $produk->harga;
    } else {
        $cart[$id] = [
            "nm_produk" => $produk->nm_produk,
            "qty" => 1,
            "harga" => $produk->harga,
            "foto" => $produk->foto,
            "jenis_produk" =>$produk->jenis_produk_id
        ];
    }
    session()->put('cart', $cart);
    return redirect()->back()->with('success', 'Produk Berhasil Ditambahkan!');
}
public function cart(Request $request)
{
    $produk = Produk::with('jenis_produk')->get();
    // dd($);
    $cart = session()->get('cart', []);
    $jenis_produk = JenisProduk::all()->keyBy('id');

    if(empty($cart))
    {   
        return redirect('/');
    }
    $total = 0;
    // $pelanggan_id = auth()->user()->id;
    foreach ($cart as $item) {
        $total += $item['harga'];
    }
    // dd($cart);
    // session()->forget('cart');

            return view('cart', compact('produk'));
            
}
public function remove($id)
    {
        $cart = session()->get('cart', []);

        // Hapus produk dari sesi
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
    public function process(Request $request)
    {
        // Generate No Transaksi (A001++)
        $lastTransaction = DB::table('transaksi')->latest('id')->first();
        $newNoTransaksi = $lastTransaction
            ? 'A' . str_pad(substr($lastTransaction->no_transaksi, 1) + 1, 3, '0', STR_PAD_LEFT)
            : 'A001';

        // Hitung total bayar dari cart
        $cart = session('cart', []);
        $totalBayar = array_reduce($cart, function ($total, $item) {
            return $total + ($item['harga'] * $item['qty']);
        }, 0);

        // Simpan bukti bayar (jika ada)
        $buktiBayarPath = null;
        if ($request->hasFile('bukti_bayar')) {
            $file = $request->file('bukti_bayar');
            $filename = $file->getClientOriginalName();
            $filepath = 'img_bukti_bayar/'; // Direktori penyimpanan
            $file->move(public_path($filepath), $filename);



        // Simpan ke tabel transaksi
        $transaksiId = DB::table('transaksi')->insertGetId([
            'no_transaksi' => $newNoTransaksi,
            'tanggal' => now(), // Gunakan helper Laravel
            'pembayaran' => $request->input('payment'),
            'total_bayar' => $totalBayar,
            'status' => 'Pending',
            'jenis_transaksi' => $request->input('payment'),
            'bukti_bayar' => $filename,
            'user_id' => Auth::id(),
        ]);
    }

        // Simpan ke tabel detail_transaksi
        foreach ($cart as $id => $details) {
            DB::table('detail_transaksi')->insert([
                'produk_id' => $id,
                'transaksi_id' => $transaksiId,
                'jumlah' => $details['qty'],
                'subtotal' => $details['harga'] * $details['qty'],
            ]);
        }
        

        // Hapus cart dari session
        session()->forget('cart');

        return redirect()->route('beranda')->with('success', 'Checkout berhasil!');
    }
}
