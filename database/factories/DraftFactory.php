<?php

namespace Database\Factories;

use App\Models\Draft;
use App\Models\Lhp;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DraftFactory extends Factory
{
    protected $model = Draft::class;

    public function definition(): array
    {
        return [
            'no_lhp' => $this->faker->unique()->numerify('LHP-####'),
            'judul' => $this->faker->sentence(5),
            'slug' => Str::slug($this->faker->unique()->sentence(3)),
            'tanggal_lhp' => $this->faker->date(),
            'auditor_id' => mt_rand(1, 22), // Pastikan ada factory untuk Auditor
            'induk_id' => mt_rand(1, 66),     // Pastikan ada factory untuk Induk
            'departemen_id' => mt_rand(1, 18),
            'bidang' => $this->faker->randomElement([
                'Komprehensif',
                'Kebijakan',
                'Tupoksi',
                'Pengelolaan Aset Daerah',
                'Pengelolaan Keuangan',
                'Pengelolaan Pendapatan',
                'Pengelolaan Kepegawaian',
                'Pengelolaan Kekayaan',
            ]),
            'pemeriksa' => $this->faker->name(),
            'irban' => $this->faker->randomElement([
                'IRBAN I',
                'IRBAN II',
                'IRBAN III',
                'IRBAN IV',
                'IRBAN V',
            ]),
            'user' => $this->faker->userName(),
            'sifat' => $this->faker->randomElement([
                'Reguler',
                'Khusus',
                'Kinerja',
                'Rahasia',
                'Terpadu',
                'Kasus',
            ]),
            'status' => $this->faker->randomElement([
                'Review DALNIS',
                'Review IRBAN',
                'Review Sekretaris',
                'Review Inspektur',
                'LHP Terbit',
                'Revisi DALNIS',
                'Revisi IRBAN',
                'Revisi Sekretaris',
                'Revisi Inspektur',
            ]),
            'laporan' => $this->faker->optional()->filePath(),
        ];
    }
}