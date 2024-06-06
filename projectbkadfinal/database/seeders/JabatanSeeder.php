<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nama = [
            ["nama" => "Kepala Bidang Akuntansi dan Aset"],
        ];

        DB::table("jabatans")->insert($nama);
    }
}
