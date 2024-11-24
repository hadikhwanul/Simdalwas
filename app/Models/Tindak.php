<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tindak extends Model
{
    use HasFactory;

    protected $table = 'tindaks';
    protected $fillable = [
        'tindak',
        'pokok_tindak_id',
        'ket_tl',
        'status',
        'tanggal_tl',
        'tagihan_id',
        'laporan_tl',
    ];

    // Define the relationship to PokokTindak (many-to-one)
    public function pokokTindak()
    {
        return $this->belongsTo(PokokTindak::class);
    }

    // Define the relationship to Tagihan (many-to-one)
    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class);
    }

    // Define the relationship to Rekomendasi (one-to-many)
    public function rekomendasis()
    {
        return $this->hasMany(Rekomendasi::class);
    }
}