<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokokRekomendasi extends Model
{
    use HasFactory;

    protected $table = 'pokok_rekomendasi';

    public function scopePokok($query)
    {
        return $query->where('no_subpokok', 0);
    }

    // Scope untuk mengambil hanya Sub Pokok Temuan
    public function scopeSubPokok($query)
    {
        return $query->where('no_subpokok', '!=', 0);
    }

    protected $fillable = [
        'no_pokok',
        'no_subpokok',
        'pokok_rekomendasi',
    ];

    // Define the relationship to Rekomendasi (one-to-many)
    public function rekomendasis()
    {
        return $this->hasMany(Rekomendasi::class);
    }
}