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

    public static function getDistinctPokokTemuan()
    {
        return self::select('pokok_temuan', 'no_pokok')->distinct()->get();
    }

    // Get distinct Sub Pokok Temuan, excluding no_subpokok = '00'
    public static function getDistinctSubPokokTemuan()
    {
        return self::select('pokok_temuan', 'sub_pokok_temuan', 'no_pokok', 'no_subpokok', 'id')
            ->where('no_subpokok', '!=', '00')
            ->distinct()
            ->get();
    }

    public function temuan()
    {
        return $this->hasMany(Temuan::class); // This sets up the reverse relationship
    }
}