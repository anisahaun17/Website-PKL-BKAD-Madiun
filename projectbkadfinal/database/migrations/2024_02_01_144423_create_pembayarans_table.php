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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skrd_id');
            $table->unsignedBigInteger('petugas_id');
            $table->bigInteger('total');
            $table->date('tanggal_pembayaran');
            $table->timestamps();

            $table->foreign('skrd_id')
                ->references('id')
                ->on('skrds')
                ->onDelete('restrict');

            $table->foreign('petugas_id')
                ->references('id')
                ->on('petugas')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
