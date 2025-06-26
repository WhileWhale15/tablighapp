<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengalamanKhuruj extends Model
{
    use HasFactory;

    protected $table = 'pengalaman_khuruj';

    public function jemaah()
    {
        return $this->belongsTo(Jemaah::class);
    }
}
