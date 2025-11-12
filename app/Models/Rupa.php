<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rupa extends Model
{
    use HasFactory;

    protected $table = 'rupas';

    protected $fillable = [
    'judul',
    'tipe',
    'file_path',
    'deskripsi',
    ];

    public static function ambilDataRupa()
    {
        return self::all();
    }
}
