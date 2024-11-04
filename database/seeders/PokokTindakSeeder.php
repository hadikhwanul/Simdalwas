<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PokokTindak;
use Illuminate\Support\Facades\DB;

class PokokTindakSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['no_pokok' => '01', 'no_subpokok' => '00', 'pokok_tindak' => 'Pelaksanaan Tindak Lanjut Berupa Pemasukan/Penyetoran'],
            ['no_pokok' => '01', 'no_subpokok' => '01', 'pokok_tindak' => 'Penyetoran uang untuk menyelesaikan tuntutan ganti rugi/tuntutan perbendaharaan yang telah ditetapkan.'],
            ['no_pokok' => '01', 'no_subpokok' => '02', 'pokok_tindak' => 'Penyetoran uang untuk melunasi kewajiban membayar pajak dan non pajak.'],
            ['no_pokok' => '01', 'no_subpokok' => '03', 'pokok_tindak' => 'Penyetoran uang untuk menyelesaikan denda yang ditetapkan.'],
            ['no_pokok' => '01', 'no_subpokok' => '04', 'pokok_tindak' => 'Penyetoran uang untuk menyelesaikan tagihan lainnya.'],
            ['no_pokok' => '01', 'no_subpokok' => '05', 'pokok_tindak' => 'Pemasukan / penyetoran uang lainnya.'],
            ['no_pokok' => '01', 'no_subpokok' => '06', 'pokok_tindak' => 'Pemasukan lebih kecil dari yang seharusnya, karena kekeliruan perhitungan.'],
            ['no_pokok' => '01', 'no_subpokok' => '07', 'pokok_tindak' => 'Penyetoran uang atas rekomendasi non finansial (rekomendasi administrasif atau rekomendasi yang bersifat dapat dinilai dengan uang).'],
            ['no_pokok' => '02', 'no_subpokok' => '00', 'pokok_tindak' => 'Pelaksanaan Tindak Lanjut Berupa Penyerahan Barang/Jasa'],
            ['no_pokok' => '02', 'no_subpokok' => '01', 'pokok_tindak' => 'Penyerahan barang/jasa yang kurang diserahkan menurut kontrak.'],
            ['no_pokok' => '02', 'no_subpokok' => '02', 'pokok_tindak' => 'Penyerahan kembali barang yang lebih diterima.'],
            ['no_pokok' => '02', 'no_subpokok' => '03', 'pokok_tindak' => 'Penyerahan barang/jasa lainnya.'],
            ['no_pokok' => '02', 'no_subpokok' => '04', 'pokok_tindak' => 'Perbaikan atas perkiraan fisik yang kurang sempurna.'],
            ['no_pokok' => '03', 'no_subpokok' => '00', 'pokok_tindak' => 'Pelaksanaan Tindak Lanjut Sedang Dalam Proses'],
            ['no_pokok' => '03', 'no_subpokok' => '01', 'pokok_tindak' => 'Keputusan tuntutan ganti rugi/tuntutan perbendaharaan.'],
            ['no_pokok' => '03', 'no_subpokok' => '02', 'pokok_tindak' => 'Keputusan denda.'],
            ['no_pokok' => '03', 'no_subpokok' => '03', 'pokok_tindak' => 'Pembayaran sebagian tuntutan ganti rugi/tuntutan perbendaharaan.'],
            ['no_pokok' => '03', 'no_subpokok' => '04', 'pokok_tindak' => 'Pembayaran sebagian denda.'],
            ['no_pokok' => '03', 'no_subpokok' => '05', 'pokok_tindak' => 'Pelaksanaan sebagian tindak lanjut lainnya berupa penyetoran sebagian uang, barang atau jasa yang ditetapkan.'],
            ['no_pokok' => '03', 'no_subpokok' => '06', 'pokok_tindak' => 'Pelaksanaan tindak lanjut penyempurnaan kelembagaan yang masih memerlukan persetujuan Kementerian PAN dan Reformasi Birokrasi.'],
            ['no_pokok' => '03', 'no_subpokok' => '07', 'pokok_tindak' => 'Pelaksanaan tindak lanjut penyempurnaan ketatalaksanaan dan kepegawaian yang tahap-tahapannya belum selesai.'],
            ['no_pokok' => '04', 'no_subpokok' => '00', 'pokok_tindak' => 'Penyerahan Kasus Ke Aparat Yang Berwenang'],
            ['no_pokok' => '04', 'no_subpokok' => '01', 'pokok_tindak' => 'Penyerahan kasus tindak pidana korupsi kepada kepolisian.'],
            ['no_pokok' => '04', 'no_subpokok' => '02', 'pokok_tindak' => 'Penyerahan kasus tindak pidana korupsi kepada kejaksaan.'],
            ['no_pokok' => '04', 'no_subpokok' => '03', 'pokok_tindak' => 'Penyerahan kasus tindak pidana korupsi kepada KPK.'],
            ['no_pokok' => '04', 'no_subpokok' => '04', 'pokok_tindak' => 'Penyerahan kasus kepada instansi lainnya yang berwenang.'],
            ['no_pokok' => '05', 'no_subpokok' => '00', 'pokok_tindak' => 'Pelaksanaan Tindak Lanjut Berupa Tindakan Administratif Atau Hukuman Disiplin Pegawai'],
            ['no_pokok' => '05', 'no_subpokok' => '01', 'pokok_tindak' => 'Hukuman disiplin ringan berdasarkan PP 53 Tahun 2010.'],
            ['no_pokok' => '05', 'no_subpokok' => '02', 'pokok_tindak' => 'Hukuman disiplin sedang  berdasarkan PP 53 Tahun 2010.'],
            ['no_pokok' => '05', 'no_subpokok' => '03', 'pokok_tindak' => 'Hukuman disiplin berat berdasarkan PP 53 Tahun 2010.'],
            ['no_pokok' => '05', 'no_subpokok' => '04', 'pokok_tindak' => 'Hukuman lainnya.'],
            ['no_pokok' => '06', 'no_subpokok' => '00', 'pokok_tindak' => 'Pelaksanaan Tindak Lanjut Berupa Audit Dengan Tujuan Tertentu'],
            ['no_pokok' => '06', 'no_subpokok' => '01', 'pokok_tindak' => 'Pelaksanaan tindak lanjut hasil audit dengan tujuan tertentu.'],
            ['no_pokok' => '07', 'no_subpokok' => '00', 'pokok_tindak' => 'Pelaksanaan Tindak Lanjut Berupa Penyempurnaan Kelembagaan'],
            ['no_pokok' => '07', 'no_subpokok' => '01', 'pokok_tindak' => 'Penyempurnaan pokok-pokok organisasi (struktur, tugas, dan fungsi).'],
            ['no_pokok' => '07', 'no_subpokok' => '02', 'pokok_tindak' => 'Penyempurnaan hubungan organisasi dengan organisasi lain berupa penyempurnaan hubungan konsultatif.'],
            ['no_pokok' => '07', 'no_subpokok' => '03', 'pokok_tindak' => 'Penyempurnaan hubungan organisasi dengan organisasi lain berupa desentralisasi, dekonsentrasi atau tugas pembantuan.'],
            ['no_pokok' => '07', 'no_subpokok' => '04', 'pokok_tindak' => 'Peneyempurnaan lain pokok-pokok organisasi atau hubungan organisasi dengan organisasi lain.'],
            ['no_pokok' => '08', 'no_subpokok' => '00', 'pokok_tindak' => 'Pelaksanaan Tindak Lanjut Berupa Penyempurnaan Sistem Pengendalian Intern'],
            ['no_pokok' => '08', 'no_subpokok' => '01', 'pokok_tindak' => 'Penyempurnaan lingkungan pengendalian.'],
            ['no_pokok' => '08', 'no_subpokok' => '02', 'pokok_tindak' => 'Penyempurnaan penilaian resiko.'],
            ['no_pokok' => '08', 'no_subpokok' => '03', 'pokok_tindak' => 'Penyempurnaan kegiatan pengendalian.'],
            ['no_pokok' => '08', 'no_subpokok' => '04', 'pokok_tindak' => 'Penyempurnaan informasi dan komunikasi.'],
            ['no_pokok' => '08', 'no_subpokok' => '05', 'pokok_tindak' => 'Penyempurnaan pemantauan pengendalian intern.'],
            ['no_pokok' => '09', 'no_subpokok' => '00', 'pokok_tindak' => 'Pelaksanaan Tindak Lanjut Berupa Penyempurnaan Kepegawaian'],
            ['no_pokok' => '09', 'no_subpokok' => '01', 'pokok_tindak' => 'Penyempurnaan penetapan formasi pegawai dan perencanaan pegawai pada umumnya.'],
            ['no_pokok' => '09', 'no_subpokok' => '02', 'pokok_tindak' => 'Penyempurnaan persyaratan penerimaan pegawai.'],
            ['no_pokok' => '09', 'no_subpokok' => '03', 'pokok_tindak' => 'Penyempurnaan seleksi pegawai dan cara pengadaan pegawai pada umumnya.'],
            ['no_pokok' => '09', 'no_subpokok' => '04', 'pokok_tindak' => 'Penyempurnaan pembinaan karir pegawai.'],
            ['no_pokok' => '09', 'no_subpokok' => '05', 'pokok_tindak' => 'Penyempurnaan kesejahteraan pegawai.'],
            ['no_pokok' => '09', 'no_subpokok' => '06', 'pokok_tindak' => 'Penyempurnaan sistem informasi kepegawaian.'],
            ['no_pokok' => '09', 'no_subpokok' => '07', 'pokok_tindak' => 'Penyempurnaan lain kepegawaian.'],
            ['no_pokok' => '10', 'no_subpokok' => '00', 'pokok_tindak' => 'Pelaksanaan Tindak Lanjut Berupa Pelimpahan Pemantauan Kepada Instansi Lain'],
            ['no_pokok' => '10', 'no_subpokok' => '01', 'pokok_tindak' => 'Pemantauan tindak lanjut diserahkan kepada APIP lain.'],
            ['no_pokok' => '11', 'no_subpokok' => '00', 'pokok_tindak' => 'Koreksi Tindak Lanjut'],
            ['no_pokok' => '11', 'no_subpokok' => '01', 'pokok_tindak' => 'Koreksi Tindak Lanjut'],
            ['no_pokok' => '12', 'no_subpokok' => '00', 'pokok_tindak' => 'Temuan Audit Yang Tidak Dapat Ditindaklanjuti'],
            ['no_pokok' => '12', 'no_subpokok' => '01', 'pokok_tindak' => 'Temuan audit yang rekomendasinya tidak memadai.'],
            ['no_pokok' => '12', 'no_subpokok' => '02', 'pokok_tindak' => 'Temuan audit yang tidak dapat ditindaklanjuti.'],
        ];

        foreach ($data as $item) {
            PokokTindak::create($item);
        }
    }
}