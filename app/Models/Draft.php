<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Draft extends Model
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

    // Relationship with Auditor
    public function auditor()
    {
        return $this->belongsTo(Auditor::class); // Assumes 'auditor_id' foreign key
    }

    // Relationship with Induk
    public function induk()
    {
        return $this->belongsTo(Induk::class); // Assumes 'induk_id' foreign key
    }

    // Relationship with Departemen
    public function departemen()
    {
        return $this->belongsTo(Departemen::class); // Assumes 'departemen_id' foreign key
    }
    // Relationship with History
    public function histories()
    {
        return $this->hasMany(History::class, 'lhp_id')->orderBy('created_at', 'desc'); // Ensure 'lhp_id' is the foreign key in the histories table
    }

    public function temuans()
    {
        return $this->hasMany(Temuan::class, 'lhp_id'); // One Draft can have many Temuans
    }
}