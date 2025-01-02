<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tindak extends Model
{
    use HasFactory, Sluggable;

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
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['tindak']
            ]
        ];
    }

    // Define the relationship to PokokTindak (many-to-one)
    public function pokokTindak()
    {
        return $this->belongsTo(PokokTindak::class);
    }

    // Define the relationship to Tagihan (many-to-one)
    public function tagihans()
    {
        return $this->hasMany(Tagihan::class);
    }

    // Define the relationship to Rekomendasi (one-to-many)
    public function rekomendasis()
    {
        return $this->belongsTo(Rekomendasi::class);  // Update to hasMany
    }
}