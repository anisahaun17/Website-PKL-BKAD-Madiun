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
        Schema::create('sewas', function (Blueprint $table) {
            $table->uuid('kode_transaksi')->primary();
            $table->unsignedBigInteger('asset_id');
            $table->string('nama');
            $table->string('nik', 16);
            $table->string('telepon', 15);
            $table->string('npwr');
            $table->string('alamat');
            $table->date('tgl_sewa_mulai');
            $table->integer('lama_sewa');
            $table->date('tgl_sewa_selesai')->storedAs('tgl_sewa_mulai + INTERVAL lama_sewa MONTH');
            $table->timestamps();

            $table->foreign('asset_id')
                ->references('id')
                ->on('assets')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sewas');
    }
};
