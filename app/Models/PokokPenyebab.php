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
    public static function getDistinctPokokPenyebab()
    {
        return self::select('pokok_penyebab', 'no_pokok')->distinct()->get();
    }

    // Get distinct Sub Pokok Penyebab, excluding no_subpokok = '00'
    public static function getDistinctSubPokokPenyebab()
    {
        return self::select('pokok_penyebab', 'sub_pokok_penyebab', 'no_pokok', 'no_subpokok', 'id')
            ->where('no_subpokok', '!=', '00')
            ->distinct()
            ->get();
    }
}