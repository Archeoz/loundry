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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->increments('id_transaksi');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->integer('id_outlet');
            $table->integer('id_member');
            $table->dateTime('tgl');
            $table->dateTime('batas_waktu');
            $table->dateTime('tgl_bayar');
            $table->integer('biaya_tambahan');
            $table->double('diskon');
            $table->integer('pajak');
            $table->enum('status',['baru','proses','selesai','diambil'])->default('baru');
            $table->enum('dibayar',['dibayar','belum_dibayar']);
            $table->timestamps();
            $table->softDeletes()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
