<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanans';

    protected $fillable = [
        'user_id',
        'total',
        'ongkir',
        'status', // dikemas, dikirim, tiba
    ];
   
    public function items()
    {
        return $this->hasMany(PesananItem::class, 'pesanan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
