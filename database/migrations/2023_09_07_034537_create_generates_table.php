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
            $table->unsignedBigInteger('kode_invoice')->nullable();
            $table->string('username_user')->nullable();
            $table->string('member')->nullable();
            $table->string('outlet')->nullable();
            $table->string('paket')->nullable();
            $table->integer('total_harga_paket')->nullable();
            $table->integer('total')->nullable();
            $table->integer('sisa_hutang')->nullable();
            $table->date('tgl_masuk')->nullable();
            $table->date('batas_waktu_bayar')->nullable();
            $table->date('tgl_bayar')->nullable();
            $table->string('status_pembayaran')->nullable();
            $table->string('status')->nullable();
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
