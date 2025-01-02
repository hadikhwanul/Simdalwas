<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tagihan extends Model
{
    use HasFactory, sluggable;

    protected $table = 'tagihans';
    protected $fillable = [
        'user_id',
        'deadline',
        'kecamatan_id',
        'satker_id',
        'total_kerugian',
        'sisa_kerugian',
        'total_kewajiban',
        'sisa_kewajiban',
        'peran_rugi',
        'ket_rugi',
        'peran_wajib',
        'ket_wajib',
        'user_tindak',
        'tindak_id'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'user_id' // Adjust this to the correct field
            ]
        ];
    }
    // In Tagihan model
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Relasi ke Kecamatan
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    // Relasi ke Satker
    public function satker()
    {
        return $this->belongsTo(Satker::class, 'satker_id');
    }

    // Relasi ke Tindak
    public function tindaks()
    {
        return $this->belongsTo(Tindak::class, 'tindak_id');
    }

    // Relasi ke User
    // Tagihan Model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'tagihan_id');
    }
}