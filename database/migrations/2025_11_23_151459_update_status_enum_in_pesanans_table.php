<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up(): void
{
    Schema::table('pesanans', function (Blueprint $table) {
        $table->enum('status', [
            'menunggu_pembayaran',
            'menunggu_konfirmasi',
            'dikemas',
            'dikirim',
            'selesai'
        ])->default('menunggu_pembayaran')->change();
    });
}

public function down(): void
{
    Schema::table('pesanans', function (Blueprint $table) {
        $table->enum('status', ['dikemas', 'dikirim', 'selesai'])
              ->default('dikemas')
              ->change();
    });
}

};
