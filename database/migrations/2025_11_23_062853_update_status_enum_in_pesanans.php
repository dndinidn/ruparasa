<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    /**
     * Run the migrations.
     */

            //

public function up()
{
    Schema::table('pesanans', function (Blueprint $table) {
        $table->enum('status', [
            'keranjang',
            'menunggu_konfirmasi',
            'dikemas',
            'dikirim',
            'selesai'
        ])->default('keranjang')->change();
    });
}

public function down()
{
    Schema::table('pesanans', function (Blueprint $table) {
        $table->enum('status', ['dikemas', 'dikirim', 'selesai'])
              ->default('dikemas')
              ->change();
    });
}

};
