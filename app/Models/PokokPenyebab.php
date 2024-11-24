<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokokPenyebab extends Model
{
    use HasFactory;

    protected $table = 'pokok_penyebab';

    protected $fillable = [
        'no_pokok',
        'no_subpokok',
        'pokok_penyebab',
    ];

    // Define the relationship to Penyebab (one-to-many)
    public function penyebabs()
    {
        return $this->hasMany(Penyebab::class, 'id_pokok_penyebab');
    }
    public function scopePokok($query)
    {
        return $query->where('no_subpokok', 0);
    }

    // Scope untuk mengambil hanya Sub Pokok Temuan
    public function scopeSubPokok($query)
    {
        return $query->where('no_subpokok', '!=', 0);
    }
}