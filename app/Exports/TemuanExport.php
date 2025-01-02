<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

namespace App\Exports;

use App\Models\Temuan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class TemuanExport implements FromCollection, WithHeadings, WithTitle
{
    protected $temuans;
    protected $draft;

    // Constructor untuk menerima data temuan dan draft
    public function __construct($temuans, $draft)
    {
        $this->temuans = $temuans;
        $this->draft = $draft;
    }

    // Menyediakan data untuk diekspor
    public function collection()
    {
        $data = [];
        foreach ($this->temuans as $temuan) {
            $data[] = [
                $temuan->temuan,
                $temuan->pokokTemuan->pokok_temuan,
                $temuan->pokokTemuan->sub_pokok_temuan,
                $temuan->penyebabs->penyebab,
                $temuan->penyebabs->pokokPenyebab->pokok_penyebab,
                $temuan->penyebabs->pokokPenyebab->sub_pokok_penyebab,
                $temuan->rekomendasis->rekomendasi,
                $temuan->rekomendasis->pokokRekomendasi->pokok_rekomendasi,
                $temuan->rekomendasis->pokokRekomendasi->sub_pokok_rekomendasi,
            ];
        }
        return collect($data);
    }

    // Menambahkan heading kolom
    public function headings(): array
    {
        return [
            'Temuan',
            'Pokok Temuan',
            'Sub Pokok Temuan',
            'Penyebab',
            'Pokok Penyebab',
            'Sub Pokok Penyebab',
            'Rekomendasi',
            'Pokok Rekomendasi',
            'Sub Pokok Rekomendasi',
        ];
    }

    // Menentukan judul sheet Excel
    public function title(): string
    {
        return 'Temuan LHP ' . $this->draft->judul;
    }
}