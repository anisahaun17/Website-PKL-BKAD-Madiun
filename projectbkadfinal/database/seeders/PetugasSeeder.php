<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nama = [
            ["nama" => "WINDARTO, S.Sos."],
            ["nama"=> "ENDAH MUNINGGAR AJI, S.E."],
            ["nama"=> "ANDIK WARDHANA"],
            ["nama"=> "ANDRIS BAGUS DEWANTORO, A.Md."],
        ];

        DB::table("petugas")->insert($nama);
    }
}
