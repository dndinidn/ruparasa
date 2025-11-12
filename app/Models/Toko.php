<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $table = 'penjuals';
    protected $fillable = ['user_id', 'nama_toko', 'alamat', 'kontak'];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function produks()
    {
        return $this->hasMany(Produk::class, 'penjual_id');
    }


}
