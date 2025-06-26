<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanDakwah extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_dakwah';

    protected $fillable = ['judul', 'deskripsi', 'tanggal', 'mesjid_id', 'perubahan_sebelum', 'perubahan_setelah'];

    // Cast 'tanggal' to a date
    protected $casts = [
        'tanggal' => 'date',
    ];

    // Define the relationship with the Mesjid model
    public function mesjid()
    {
        return $this->belongsTo(Mesjid::class, 'mesjid_id');
    }
}


