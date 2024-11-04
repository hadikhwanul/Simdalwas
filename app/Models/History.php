<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'histories';

    protected $fillable = [
        'lhp_id',
        'history',
        'revisi_dalnis',
        'revisi_irban',
        'revisi_sekretaris',
        'revisi_inspektur',
    ];

    // Relationship with Draft
    public function draft()
    {
        return $this->belongsTo(Draft::class, 'lhp_id'); // Make sure to match the foreign key here
    }
}