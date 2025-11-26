<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $table = 'reseps';

    protected $fillable = [
       'nama_rasa',
    'provinsi_asal',
    'resep',
    'sejarah',
    'gambar'
    ];
}
