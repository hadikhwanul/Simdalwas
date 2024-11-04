<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Induk extends Model
{
    use HasFactory;

    protected $table = 'induks';

    // Relationship with Draft
    public function drafts()
    {
        return $this->hasMany(Draft::class); // This sets up the reverse relationship
    }
}