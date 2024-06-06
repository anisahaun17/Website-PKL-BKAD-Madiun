<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PenanggungJawabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pj = [
            [
                "nama" => "LILIS HARTUTIK, S.E, M.M",
                "nip" => "196911241993022002",
                "status" => "Aktif",
                "jabatan_id" => 1
            ]
        ];

        DB::table("penanggung_jawabs")->insert($pj);
    }
}
