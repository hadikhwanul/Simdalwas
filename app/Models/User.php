<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Jobdesk;
use App\Models\Tagihan;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    use HasUuids;
    protected $table = 'users';

    public function getRouteKeyName()
    {
        return 'username';
    }

    protected $fillable = [
        'id',
        'profile',
        'nama',
        'username',
        'NIP',
        'no_hp',
        'no_wa',
        'kelompok',
        'jobdesk_id',
        'email',
        'password'
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
    ];

    public function jobdesks()
    {
        return $this->belongsTo(Jobdesk::class, 'jobdesk_id');
    }

    public function tagihans()
    {
        return $this->hasMany(Tagihan::class, 'user_id');
    }


}