<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KelurahanSeeder extends Seeder
{
    public function run(): void
    {
        $kelurahans = [
            // Kecamatan Binjai Utara (id: 5)
            ['nama_kelurahan' => 'Jati Utomo', 'kecamatan_id' => 5],
            ['nama_kelurahan' => 'Kebun Lada', 'kecamatan_id' => 5],
            ['nama_kelurahan' => 'Cengkeh Turi', 'kecamatan_id' => 5],
            ['nama_kelurahan' => 'Jati Karya', 'kecamatan_id' => 5],
            ['nama_kelurahan' => 'Jati Makmur', 'kecamatan_id' => 5],
            ['nama_kelurahan' => 'Jati Negara', 'kecamatan_id' => 5],
            ['nama_kelurahan' => 'Damai', 'kecamatan_id' => 5],
            ['nama_kelurahan' => 'Nangka', 'kecamatan_id' => 5],
            ['nama_kelurahan' => 'Pahlawan', 'kecamatan_id' => 5],

            // Kecamatan Binjai Selatan (id: 8)
            ['nama_kelurahan' => 'Bhakti Karya', 'kecamatan_id' => 8],
            ['nama_kelurahan' => 'Binjai Estate', 'kecamatan_id' => 8],
            ['nama_kelurahan' => 'Rambung Barat', 'kecamatan_id' => 8],
            ['nama_kelurahan' => 'Rambung Dalam', 'kecamatan_id' => 8],
            ['nama_kelurahan' => 'Rambung Timur', 'kecamatan_id' => 8],
            ['nama_kelurahan' => 'Tanah Merah', 'kecamatan_id' => 8],
            ['nama_kelurahan' => 'Pujidadi', 'kecamatan_id' => 8],
            ['nama_kelurahan' => 'Kampung Baru', 'kecamatan_id' => 8],

            // Kecamatan Binjai Timur (id: 9)
            ['nama_kelurahan' => 'Dataran Tinggi', 'kecamatan_id' => 9],
            ['nama_kelurahan' => 'Mencirim', 'kecamatan_id' => 9],
            ['nama_kelurahan' => 'Sumber Karya', 'kecamatan_id' => 9],
            ['nama_kelurahan' => 'Sumber Mulyorejo', 'kecamatan_id' => 9],
            ['nama_kelurahan' => 'Tanah Tinggi', 'kecamatan_id' => 9],
            ['nama_kelurahan' => 'Tunggurono', 'kecamatan_id' => 9],
            ['nama_kelurahan' => 'Tanjung Langkat', 'kecamatan_id' => 9],

            // Kecamatan Binjai Barat (id: 11)
            ['nama_kelurahan' => 'Limau Sundai', 'kecamatan_id' => 11],
            ['nama_kelurahan' => 'Bandar Senembah', 'kecamatan_id' => 11],
            ['nama_kelurahan' => 'Paya Roba', 'kecamatan_id' => 11],
            ['nama_kelurahan' => 'Suka Ramai', 'kecamatan_id' => 11],
            ['nama_kelurahan' => 'Suka Maju', 'kecamatan_id' => 11],
            ['nama_kelurahan' => 'Limau Mungkur', 'kecamatan_id' => 11],

            // Kecamatan Binjai Kota (id: 17)
            ['nama_kelurahan' => 'Binjai', 'kecamatan_id' => 17],
            ['nama_kelurahan' => 'Berngam', 'kecamatan_id' => 17],
            ['nama_kelurahan' => 'Pekan Binjai', 'kecamatan_id' => 17],
            ['nama_kelurahan' => 'Satria', 'kecamatan_id' => 17],
            ['nama_kelurahan' => 'Setia', 'kecamatan_id' => 17],
            ['nama_kelurahan' => 'Kartini', 'kecamatan_id' => 17],
            ['nama_kelurahan' => 'Tangsi', 'kecamatan_id' => 17],
        ];

        foreach ($kelurahans as $kelurahan) {
            DB::table('kelurahan')->insert([
                'nama_kelurahan' => $kelurahan['nama_kelurahan'],
                'kecamatan_id' => $kelurahan['kecamatan_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
