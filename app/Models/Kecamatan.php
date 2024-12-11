<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';

    public static function getDistinctKecamatan()
    {
        return self::select('kecamatan', 'no_camat')->distinct()->get();
    }

    /**
     * Get distinct Deskel data excluding no_deskel = '00'.
     */
    public static function getDistinctDeskel()
    {
        return self::select('kecamatan', 'deskel', 'no_camat', 'no_deskel', 'id')
            ->where('no_deskel', '!=', '00')
            ->distinct()
            ->get();
    }

    // Relasi ke Tagihan
    public function tagihans()
    {
        return $this->hasMany(Tagihan::class, 'kecamatan_id');
    }
}