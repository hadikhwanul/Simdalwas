<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satker extends Model
{
    use HasFactory;

    protected $table = 'satkers';

    public static function getDistinctOpd()
    {
        return self::select('opd', 'no_opd')->distinct()->get();
    }

    /**
     * Get distinct Sekolah data excluding no_sekolah = '00'.
     */
    public static function getDistinctSekolah()
    {
        return self::select('opd', 'sekolah', 'no_opd', 'no_sekolah', 'id')
            ->where('no_sekolah', '!=', '00')
            ->distinct()
            ->get();
    }

    // Relasi ke Tagihan
    public function tagihans()
    {
        return $this->hasMany(Tagihan::class, 'satker_id');
    }
}