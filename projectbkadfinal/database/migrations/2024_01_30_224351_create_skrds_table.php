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
        Schema::create('skrds', function (Blueprint $table) {
            $table->id();
            $table->uuid('kode_transaksi');
            $table->unsignedBigInteger('penanggung_jawab_id');
            $table->bigInteger('denda')->nullable();
            $table->bigInteger('pengurangan')->nullable();
            $table->string('terbilang');
            $table->date('tanggal_cetak')->nullable();
            $table->timestamps();

            $table->foreign('kode_transaksi')
                ->references('kode_transaksi')
                ->on('sewas')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('penanggung_jawab_id')
                ->references('id')
                ->on('penanggung_jawabs')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skrds');
    }
};
