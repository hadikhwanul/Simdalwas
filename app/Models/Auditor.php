<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditor extends Model
{
    use HasFactory;

    protected $table = 'auditors';

    protected $fillable = ['auditor']; // Adjust fields as necessary

    // Relationship with Draft
    public function drafts()
    {
        return $this->hasMany(Draft::class); // This sets up the reverse relationship
    }
}