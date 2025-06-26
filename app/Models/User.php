<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $table = 'users';

    protected $guard_name = 'web'; // Ensure this is set if you're using the default guard

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'mesjid_id',
        'profile_picture',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Determine if the user has verified their email address.
     * Admins are always considered verified.
     */
    public function hasVerifiedEmail()
    {
        if ($this->hasRole('admin')) {
            return true;
        }
        return !is_null($this->email_verified_at);
    }

    public function jamaah()
    {
        return $this->hasOne(\App\Models\Jemaah::class);
    }

    public function jemaah()
    {
        return $this->hasOne(\App\Models\Jemaah::class);
    }
}
