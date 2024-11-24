<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temuan extends Model
{
    use HasFactory;

    protected $table = 'temuans';

    protected $fillable = [
        'lhp_id',          // Foreign key to Draft
        'temuan',
        'keterangan',
        'pokok_temuan_id',
        'penyebab_id',
        'rekomendasi_id',
        'user',
    ];

    // Relationship to the Draft model
    public function draft()  // One Temuan belongs to one Draft
    {
        return $this->belongsTo(Draft::class, 'lhp_id'); // Foreign key lhp_id in Temuan
    }

    // Other relationships to related models (PokokTemuan, Penyebab, Rekomendasi)
    public function pokokTemuan()
    {
        return $this->belongsTo(PokokTemuan::class, 'pokok_temuan_id');
    }

    public function penyebabs()
    {
        return $this->hasMany(Penyebab::class, 'temuan_id'); // Ensure foreign key is 'temuan_id'
    }

    public function rekomendasis()
    {
        return $this->hasMany(Rekomendasi::class, 'temuan_id'); // Ensure foreign key is 'temuan_id'
    }
}