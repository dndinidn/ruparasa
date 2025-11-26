<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agenda_budayas';

    protected $fillable = [
        'tanggal',
        'nama',
        'lokasi',
        'deskripsi',
        'status',
    ];
    protected $casts = [
    'tanggal' => 'datetime',
];

}

