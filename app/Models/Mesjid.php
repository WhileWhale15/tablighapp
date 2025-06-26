<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesjid extends Model
{
    use HasFactory;

    protected $table = 'mesjid';

    protected $fillable = [
        'nama_mesjid',
        'alamat',
        'kelurahan_id',
        'kecamatan_id',
    ];

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id');
    }

    public function jemaah()
    {
        return $this->hasMany(Jemaah::class, 'mesjid_id');
    }

    public function kegiatanDakwah()
    {
        return $this->hasMany(KegiatanDakwah::class, 'mesjid_id');
    }

    public function residentNotes()
    {
        return $this->hasMany(ResidentNote::class, 'mesjid_id');
    }

    // Helper method to get jemaah count
    public function getJemaahCountAttribute()
    {
        return $this->jemaah()->count();
    }
}
