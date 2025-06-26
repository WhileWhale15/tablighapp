<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jemaah extends Model
{
    use HasFactory;

    protected $table = 'jemaah';

    protected $fillable = [
        'mesjid_id',
        'nama',
        'no_ktp',
        'no_telepon',
        'jenis_kelamin',
        'alamat',
        'user_id',
    ];

    public function mesjid()
    {
        return $this->belongsTo(Mesjid::class);
    }

    public function pengalamanKhuruj()
    {
        return $this->hasMany(PengalamanKhuruj::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
