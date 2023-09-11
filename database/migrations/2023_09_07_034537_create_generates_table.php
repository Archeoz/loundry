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
        Schema::create('generates', function (Blueprint $table) {
            $table->increments('id_generate');
            $table->integer('id_transaksi');
            $table->string('username_user');
            $table->string('member');
            $table->string('outlet');
            $table->string('paket');
            $table->integer('total_harga_paket');
            $table->integer('total');
            $table->date('tgl_masuk');
            $table->date('batas_waktu_bayar');
            $table->date('tgl_bayar');
            $table->string('status_pembayaran');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generates');
    }
};
