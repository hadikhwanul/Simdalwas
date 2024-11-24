<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyebab extends Model
{
    use HasFactory;

    protected $table = 'penyebabs';
    protected $fillable = [
        'penyebab',
        'id_pokok_penyebab',
    ];

    // Define the relationship to PokokPenyebab (many-to-one)
    public function temuan()
    {
        return $this->belongsTo(Temuan::class, 'temuan_id'); // Foreign key 'temuan_id'
    }

    public function pokokPenyebab()
    {
        return $this->belongsTo(PokokPenyebab::class, 'id_pokok_penyebab');
    }

}