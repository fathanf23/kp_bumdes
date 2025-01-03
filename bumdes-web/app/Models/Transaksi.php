<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $fillable = ['no_transaksi', 'tanggal', 'pembayaran', 'total_bayar', 'status', 'jenis_transaksi', 'bukti_bayar', 'user_id'];
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}
