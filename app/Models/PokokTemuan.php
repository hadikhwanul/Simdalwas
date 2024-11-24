<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokokTemuan extends Model
{
    use HasFactory;

    protected $table = 'pokok_temuan';

    protected $fillable = [
        'no_pokok',
        'no_subpokok',
        'pokok_temuan',
    ];

    // Scope untuk mengambil hanya Pokok Temuan
    public function scopePokok($query)
    {
        return $query->where('no_subpokok', 0);
    }

    // Scope untuk mengambil hanya Sub Pokok Temuan
    public function scopeSubPokok($query)
    {
        return $query->where('no_subpokok', '!=', 0);
    }

    public function temuan()
    {
        return $this->hasMany(Temuan::class); // This sets up the reverse relationship
    }
}