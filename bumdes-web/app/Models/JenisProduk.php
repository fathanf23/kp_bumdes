<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisProduk extends Model
{
    use HasFactory;
    protected $table = "jenis_produk";
    protected $fillable = ['jenis_produk'];
    public $timestamps = false;

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }
}
