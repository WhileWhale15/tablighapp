<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidentNote extends Model
{
    use HasFactory;

    protected $table = 'resident_notes';

    protected $fillable = [
        'mesjid_id',
        'kecamatan_id',
        'isi_catatan',
        'dibuat_oleh',
    ];

    public function mesjid()
    {
        return $this->belongsTo(Mesjid::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}
