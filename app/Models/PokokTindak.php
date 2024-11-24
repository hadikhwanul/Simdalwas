<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokokTindak extends Model
{
    use HasFactory;

    protected $table = 'pokok_tindak';

    // Declare $fillable property only once
    protected $fillable = ['no_pokok', 'no_subpokok', 'pokok_tindak'];

    // Define the relationship to Tindak (one-to-many)
    public function tindaks()
    {
        return $this->hasMany(Tindak::class);
    }

}