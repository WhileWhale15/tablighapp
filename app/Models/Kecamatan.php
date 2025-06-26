<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';

    protected $fillable = [
        'nama_kecamatan',
    ];

    public function kelurahans()
    {
        return $this->hasMany(Kelurahan::class);
    }

    public function mesjids()
    {
        return $this->hasMany(Mesjid::class);
    }

    public function residentNotes()
    {
        return $this->hasMany(ResidentNote::class, 'kecamatan_id');
    }
}
