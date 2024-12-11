<?php

namespace App\Models;

use App\Models\Temuan;
use App\Models\Tindak;
use App\Models\PokokRekomendasi;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rekomendasi extends Model
{
    use HasFactory, sluggable;
    protected $table = 'rekomendasis';

    protected $fillable = [
        'rekomendasi',
        'pokok_rekomendasi_id',
        'tindak_id',
        'kerugian',
        'kewajiban',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['rekomendasi']
            ]
        ];
    }

    // Define the relationship to Tindak (many-to-one)
    public function tindaks()
    {
        return $this->hasOne(Tindak::class);
    }

    public function temuan()
    {
        return $this->belongsTo(Temuan::class, 'temuan_id'); // Foreign key 'temuan_id'
    }

    public function pokokRekomendasi()
    {
        return $this->belongsTo(PokokRekomendasi::class, 'pokok_rekomendasi_id');
    }
}