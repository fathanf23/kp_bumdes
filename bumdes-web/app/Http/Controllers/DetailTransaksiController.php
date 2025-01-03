<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $detail_transaksi = DB::table('detail_transaksi')
        ->leftJoin('transaksi', 'detail_transaksi.transaksi_id', '=', 'transaksi.id')
        ->leftJoin('produk', 'detail_transaksi.produk_id', '=', 'produk.id')
        ->select(
            'detail_transaksi.id',
            'transaksi.no_transaksi',
            DB::raw('GROUP_CONCAT(CONCAT(produk.nm_produk, " (x", detail_transaksi.jumlah, ")") SEPARATOR ", ") as produk'),
            DB::raw('SUM(detail_transaksi.jumlah) as total_jumlah'),
            DB::raw('SUM(produk.harga * detail_transaksi.jumlah) as total_subtotal') // Perubahan ada di sini
        )
        ->groupBy('detail_transaksi.id', 'transaksi.no_transaksi')
        ->get();

    return view('admin.detail_transaksi.index', compact('detail_transaksi'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produk = Produk::get();
        $transaksi = Transaksi::get();
        return view('admin.detail_transaksi.create', compact('produk', 'transaksi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'transaksi_id' => 'required|exists:transaksi,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $produk = Produk::findOrFail($request->produk_id);
        $subtotal = $produk->harga * $request->jumlah;

        DetailTransaksi::create([
            'produk_id' => $request->produk_id,
            'transaksi_id' => $request->transaksi_id,
            'jumlah' => $request->jumlah,
            'subtotal' => $subtotal,
        ]);

        return redirect('admin/detail_transaksi/index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $produk = Produk::all();
        $transaksi = Transaksi::all();
        $detail_transaksi = DetailTransaksi::get()->where('id', $id);
        return view('admin.detail_transaksi.edit', compact('detail_transaksi', 'produk', 'transaksi'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $detailTransaksi = DetailTransaksi::findOrFail($id);
        $produk = Produk::findOrFail($request->produk_id);
        $subtotal = $produk->harga * $request->jumlah;

        $detailTransaksi->update([
            'produk_id' => $request->produk_id,
            'jumlah' => $request->jumlah,
            'subtotal' => $subtotal,
        ]);

        return redirect('admin/detail_transaksi/index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $detail_transaksi = DetailTransaksi::where('id', $id)->first();
        $detail_transaksi->delete();
        return redirect('admin/detail_transaksi/index');
    }
}
