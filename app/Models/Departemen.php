<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;

    protected $table = 'departemens';

    // Relationship with Draft
    public function drafts()
    {
        return $this->hasMany(Draft::class); // This sets up the reverse relationship
    }
}