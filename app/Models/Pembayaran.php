<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Str;

class Pembayaran extends Model
{
    use HasFactory, sluggable;
    // Nama tabel
    protected $table = 'pembayarans';

    // Atribut yang dapat diisi secara massal
    // Menambahkan kolom yang dapat diisi
    protected $fillable = [
        'slug',
        'tagihan_id',
        'status',
        'bayar_rugi',
        'bayar_wajib',
        'resi',
        'tanggal_bayar',
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }
    /**
     * Relasi ke tabel Tagihan
     * Setiap pembayaran mungkin terkait dengan satu tagihan.
     */
    public function tagihans()
    {
        return $this->belongsTo(Tagihan::class, 'tagihan_id');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'resi' // Adjust this to the correct field
            ]
        ];
    }
}