<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $table = 'tagihans';

    protected $fillable = [
        'kecamatan_id',
        'satker_id',
        'kerugian',
        'kewajiban',
        'tindak_id',
        'user_id',
        'resi'
    ];

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
    public function tindak()
    {
        return $this->belongsTo(Tindak::class, 'tindak_id');
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}