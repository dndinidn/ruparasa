<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['user_id', 'produk_id', 'rating', 'komentar', 'balasan_penjual'];

public function produk()
{
    return $this->belongsTo(Produk::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}


}

