<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            'Prestasi',
            'Opini',
            'Kegiatan',
            'Informasi Sekolah',
            'Pengumuman'
        ];

        foreach ($kategori as $nama) {
            Kategori::create(['nama_kategori' => $nama]);
        }
    }
}