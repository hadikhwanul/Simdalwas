<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobdesk extends Model
{
    use HasFactory;

    protected $table = 'jobdesks';

    public function users(){
        return $this->hasOne(User::class,'jobdesk_id');
    }
}