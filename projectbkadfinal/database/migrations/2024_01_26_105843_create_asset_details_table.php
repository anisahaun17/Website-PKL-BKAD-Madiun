<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asset_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("asset_id");
            $table->decimal('panjang', 8, 2);
            $table->decimal('lebar', 8, 2);
            $table->decimal('luas', 8, 2)->storedAs('panjang * lebar');
            $table->bigInteger('tarif');
            $table->integer('jumlah_asset');
            $table->integer('jumlah_digunakan')->default(0);
            $table->integer('jumlah_tersedia')->storedAs('jumlah_asset - jumlah_digunakan');
            $table->timestamps();

            $table->foreign("asset_id")
                ->references("id")
                ->on("assets")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS update_jumlah_tersedia');
        Schema::dropIfExists('asset_details');
    }
};
