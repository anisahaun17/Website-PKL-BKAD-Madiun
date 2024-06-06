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
        Schema::create('sewa_details', function (Blueprint $table) {
            $table->id();
            $table->uuid('kode_transaksi');
            $table->unsignedBigInteger('asset_detail_id');
            $table->integer('jumlah');
            $table->bigInteger('tarif');
            $table->bigInteger('harga');
            $table->timestamps();

            $table->foreign('kode_transaksi')
                ->references('kode_transaksi')
                ->on('sewas')
                ->onDelete('cascade');

            $table->foreign('asset_detail_id')
                ->references('id')
                ->on('asset_details')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sewa_details');
    }
};
