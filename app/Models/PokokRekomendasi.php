<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokokRekomendasi extends Model
{
    use HasFactory;

    protected $table = 'pokok_rekomendasi';

    // Get distinct Pokok Rekomendasi
    public static function getDistinctPokokRekomendasi()
    {
        return self::select('pokok_rekomendasi', 'no_pokok')->distinct()->get();
    }

    // Get distinct Sub Pokok Rekomendasi, excluding no_subpokok = '00'
    public static function getDistinctSubPokokRekomendasi()
    {
        return self::select('pokok_rekomendasi', 'sub_pokok_rekomendasi', 'no_pokok', 'no_subpokok', 'id')
            ->where('no_subpokok', '!=', '00')
            ->distinct()
            ->get();
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