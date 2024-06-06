<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'nama' => 'BKAD Kota Madiun',
                'username' => 'bkadkotamadiun',
                'password' => bcrypt('madiunkotapendekar')
            ]
        ];

        DB::table('users')->insert($user);
    }
}
