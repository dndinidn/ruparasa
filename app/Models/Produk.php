<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produks';
    protected $fillable = ['penjual_id', 'nama_produk', 'harga', 'stok', 'deskripsi','gambar'];

    // Relasi ke Toko / Penjual
    public function penjual()
    {
        return $this->belongsTo(Toko::class, 'penjual_id');
    }

    public function items()
{
    return $this->hasMany(PesananItem::class, 'produk_id');
}



}
