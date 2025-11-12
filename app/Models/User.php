<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Relasi ke tabel toko (penjual)
     */
    public function penjual()
    {
        return $this->hasOne(Toko::class);
    }
    // app/Models/User.php
public function penjual1()
{
    return $this->hasOne(\App\Models\Penjual::class);
}


    /**
     * Kolom yang bisa diisi massal
     */
protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'bio',
        'photo',
    ];


    /**
     * Kolom yang disembunyikan ketika serialisasi
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting atribut
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Accessor untuk mengambil URL foto profil
     */
    protected function photoUrl(): Attribute
    {
        return Attribute::get(function () {
            // Jika user punya foto tersimpan di storage
            if ($this->photo && file_exists(storage_path('app/public/profile/' . $this->photo))) {
                return asset('storage/profile/' . $this->photo);
            }

            // Jika tidak ada foto, pakai avatar default
            return 'https://i.pravatar.cc/150?u=' . urlencode($this->email);
        });
    }
}
