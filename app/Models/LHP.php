<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LHP extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'lhps';

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['judul']
            ]
        ];
    }
    protected $fillable = [
        'no_lhp',
        'judul',
        'tanggal_lhp',
        'auditor_id',
        'induk_id',
        'departemen_id',
        'bidang',
        'pemeriksa',
        'sifat',
        'irban',
        'user',
        'laporan',
        'status'
    ];
}