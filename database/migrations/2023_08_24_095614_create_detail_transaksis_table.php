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
        Schema::create('detail_transaksis', function (Blueprint $table) {
            $table->increments('id_detail_transaksi');
            $table->integer('id_transaksi');
            $table->integer('id_paket');
            $table->integer('jumlah_paket');
            $table->unsignedBigInteger('total_harga_paket');
            $table->unsignedBigInteger('sisa_hutang')->nullable();
            $table->double('qty');
            $table->string('keterangan');
            $table->timestamps();
            $table->softDeletes()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksis');
    }
};
