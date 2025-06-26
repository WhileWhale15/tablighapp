<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KegiatanDakwah;

class KegiatanDakwahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KegiatanDakwah::create([
            'judul' => 'Kegiatan Dakwah 1',
            'deskripsi' => 'Deskripsi kegiatan dakwah 1',
            'tanggal' => '2025-04-01',
            'mesjid_id' => 8, // Replace with a valid mesjid_id
        ]);

        KegiatanDakwah::create([
            'judul' => 'Kegiatan Dakwah 2',
            'deskripsi' => 'Deskripsi kegiatan dakwah 2',
            'tanggal' => '2025-04-15',
            'mesjid_id' => 8, // Replace with a valid mesjid_id
        ]);
    }
}
