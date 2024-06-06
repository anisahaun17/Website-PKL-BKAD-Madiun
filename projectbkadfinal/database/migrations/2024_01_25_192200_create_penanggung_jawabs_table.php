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
        Schema::create('penanggung_jawabs', function (Blueprint $table) {
            $table->id();
            $table->string("nama");
            $table->string("nip", 18);
            $table->string("status");
            $table->unsignedBigInteger("jabatan_id");
            $table->timestamps();

            $table->foreign("jabatan_id")
                ->references("id")
                ->on("jabatans")
                ->onDelete("restrict");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penanggung_jawabs');
    }
};
