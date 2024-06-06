<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis = [
            [
                'nama' => 'Tanah untuk pemasangan papan reklame permanent : billboard, megatron/videotron/LED, neon box, reklame rerjalan, baliho, dan lain-lain',
                'tarif' => 4600,
                'kategori_id' => 1
            ],
            [
                'nama' => 'Tanah untuk pemasangan papan nama toko/perusahaan',
                'tarif' => 2300,
                'kategori_id' => 1
            ],
            [
                'nama' => 'Tanah untuk pemasangan baliho tidak permanen',
                'tarif' => 1500,
                'kategori_id' => 1
            ],
            [
                'nama' => 'Tanah untuk pemasangan reklame insidental : spanduk, umbul-umbul, dan lain-lain',
                'tarif' => 6000,
                'kategori_id' => 1
            ],
            [
                'nama' => 'Tanah untuk warung, depot, dan bangunan tidak permanen lainnya',
                'tarif' => 1500,
                'kategori_id' => 1
            ],
            [
                'nama' => 'Tanah untuk pergudangan atau perindustrian beserta usahanya (Jalan Golongan A)',
                'tarif' => 5000,
                'kategori_id' => 1
            ],
            [
                'nama' => 'Tanah untuk pergudangan atau perindustrian beserta usahanya (Jalan Golongan B)',
                'tarif' => 3400,
                'kategori_id' => 1
            ],
            [
                'nama' => 'Tanah untuk pergudangan atau perindustrian beserta usahanya (Jalan Golongan C',
                'tarif' => 2000,
                'kategori_id' => 1
            ],
            [
                'nama' => 'Tanah dan bangunan permanen untuk Sekolah: PAUD, TK, SD, SMP, SMA, SMK, dan sederajat beserta halamannya',
                'tarif' => 600,
                'kategori_id' => 2
            ],
            [
                'nama' => 'Tanah dan bangunan permanen untuk Akademi, Universitas, dan sejenisnya beserta halamannya',
                'tarif' => 1100,
                'kategori_id' => 2
            ],
            [
                'nama' => 'Tanah dan bangunan untuk usaha atau industri beserta halamannya (Jalan Golongan A)',
                'tarif' => 7500,
                'kategori_id' => 2
            ],
            [
                'nama' => 'Tanah dan bangunan untuk usaha atau industri beserta halamannya (Jalan Golongan B)',
                'tarif' => 4000,
                'kategori_id' => 2
            ],
            [
                'nama' => 'Tanah dan bangunan untuk usaha atau industri beserta halamannya (Jalan Golongan C)',
                'tarif' => 2300,
                'kategori_id' => 2
            ]
        ];

        DB::table('jenis')->insert($jenis);
    }
}
