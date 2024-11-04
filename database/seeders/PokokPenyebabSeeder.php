<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PokokPenyebab;

class PokokPenyebabSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['no_pokok' => '10', 'no_subpokok' => '00', 'pokok_penyebab' => 'KELEMAHAN SISTEM PENGENDALIAN INTERN'],
            ['no_pokok' => '11', 'no_subpokok' => '00', 'pokok_penyebab' => 'Kelemahan Dalam Lingkungan Pengendalian'],
            ['no_pokok' => '11', 'no_subpokok' => '01', 'pokok_penyebab' => 'Penegakkan integritas dan nilai etika yang kurang efektif.'],
            ['no_pokok' => '11', 'no_subpokok' => '02', 'pokok_penyebab' => 'Komitmen yang rendah terhadap kompetensi.'],
            ['no_pokok' => '11', 'no_subpokok' => '03', 'pokok_penyebab' => 'Kepemimpinan yang kurang kondusif.'],
            ['no_pokok' => '11', 'no_subpokok' => '04', 'pokok_penyebab' => 'Pembentukan struktur organisasi yang kurang sesuai kebutuhan.'],
            ['no_pokok' => '11', 'no_subpokok' => '05', 'pokok_penyebab' => 'Pendelegasian wewenang dan tanggung jawab yang kurang tepat.'],
            ['no_pokok' => '11', 'no_subpokok' => '06', 'pokok_penyebab' => 'Penyusunan dan penerapan kebijakan yang kurang sehat tentang pembinaan sumber daya manusia.'],
            ['no_pokok' => '11', 'no_subpokok' => '07', 'pokok_penyebab' => 'Perwujudan peran aparat pengawasan intern pemerintah yang kurang efektif.'],
            ['no_pokok' => '11', 'no_subpokok' => '08', 'pokok_penyebab' => 'Hubungan kerja yang kurang baik dengan instansi Pemerintah terkait.'],
            ['no_pokok' => '12', 'no_subpokok' => '00', 'pokok_penyebab' => 'Kelemahan Dalam Penilaian Resiko'],
            ['no_pokok' => '12', 'no_subpokok' => '01', 'pokok_penyebab' => 'Penetapan maksud dan tujuan Instansi Pemerintah secara keseluruhan yang kurang jelas dan kurang konsisten.'],
            ['no_pokok' => '12', 'no_subpokok' => '02', 'pokok_penyebab' => 'Penetapan maksud dan tujuan Instansi Pemerintah pada tingkatan kegiatan yang kurang jelas dan kurang konsisten.'],
            ['no_pokok' => '12', 'no_subpokok' => '03', 'pokok_penyebab' => 'Identifikasi yang kurang efisien dan efektif atas risiko yang dapat menghambat pencapaian tujuan.'],
            ['no_pokok' => '12', 'no_subpokok' => '04', 'pokok_penyebab' => 'Terhadap risiko yang teridentifikasi belum atau kurang efektif dianalisis untuk mengetahui pengaruhnya terhadap pencapaian tujuan.'],
            ['no_pokok' => '12', 'no_subpokok' => '05', 'pokok_penyebab' => 'Pengelolaan manajemen risiko yang kurang efektif selama perubahan.'],
            ['no_pokok' => '13', 'no_subpokok' => '00', 'pokok_penyebab' => 'Kelemahan Dalam Kegiatan Pengendalian'],
            ['no_pokok' => '13', 'no_subpokok' => '01', 'pokok_penyebab' => 'Reviu yang kurang efektif atas kinerja instansi Pemerintah yang bersangkutan.'],
            ['no_pokok' => '13', 'no_subpokok' => '02', 'pokok_penyebab' => 'Pembinaan yang kurang tepat atas sumber daya manusia.'],
            ['no_pokok' => '13', 'no_subpokok' => '03', 'pokok_penyebab' => 'Pengendalian yang kurang efektif atas pengelolaan sistem informasi.'],
            ['no_pokok' => '13', 'no_subpokok' => '04', 'pokok_penyebab' => 'Pengendalian fisik yang kurang efektif atas aset.'],
            ['no_pokok' => '13', 'no_subpokok' => '05', 'pokok_penyebab' => 'Penetapan dan reviu yang kurang efektif atas indikacator dan ukuran kinerja.'],
            ['no_pokok' => '13', 'no_subpokok' => '06', 'pokok_penyebab' => 'Pemisahan fungsi yang kurang efektif.'],
            ['no_pokok' => '13', 'no_subpokok' => '07', 'pokok_penyebab' => 'Tidak adanya otorisasi atas transaksi dan kejadian yang penting.'],
            ['no_pokok' => '13', 'no_subpokok' => '08', 'pokok_penyebab' => 'Pencatatan yang kurang akurat dan/atau terlambat atas transaksi dan kejadian.'],
            ['no_pokok' => '13', 'no_subpokok' => '09', 'pokok_penyebab' => 'Tidak adanya pembatasan akses atas sumber daya dan pencatatannya.'],
            ['no_pokok' => '13', 'no_subpokok' => '10', 'pokok_penyebab' => 'Kurangnya akuntabilitas terhadap sumber daya dan pencatatannya.'],
            ['no_pokok' => '13', 'no_subpokok' => '11', 'pokok_penyebab' => 'Dokumentasi yang kurang baik atas Sistem Pengendalian Intern serta transaksi dan kejadian penting.'],
            ['no_pokok' => '14', 'no_subpokok' => '00', 'pokok_penyebab' => 'Kelemahan Dalam Informasi dan Komunikasi'],
            ['no_pokok' => '14', 'no_subpokok' => '01', 'pokok_penyebab' => 'Informasi yang kurang relevan dan/atau kurang dapat diandalkan baik informasi yang bersifat keuangan maupun non keuangan yang berhubungan dengan peristiwa-peristiwa eksternal serta internal.'],
            ['no_pokok' => '14', 'no_subpokok' => '02', 'pokok_penyebab' => 'Kurangnya komunikasi atas informasi yang dihasilkan instansi, baik kepada Pimpinan Instansi Pemerintah maupun instansi Pemerintah lainnya yang memerlukan sehingga menghambat pelaksanaan pengendalian intern.'],
            ['no_pokok' => '15', 'no_subpokok' => '00', 'pokok_penyebab' => 'Kelemahan Dalam Pemantauan Pengendalian Intern'],
            ['no_pokok' => '15', 'no_subpokok' => '01', 'pokok_penyebab' => 'Tidak adanya atau kurangnya pemantauan berkelanjutan.'],
            ['no_pokok' => '15', 'no_subpokok' => '02', 'pokok_penyebab' => 'Tidak adanya atau kurangnya pelaksanaan evaluasi terpisah atas pengendalian intern.'],
            ['no_pokok' => '15', 'no_subpokok' => '03', 'pokok_penyebab' => 'Kurang efektifnya pelaksanaan tindak lanjut rekomendasi hasil audit dan / atau pemeriksaan.'],
            ['no_pokok' => '20', 'no_subpokok' => '00', 'pokok_penyebab' => 'PENYEBAB LAIN DI LUAR SISTEM PENGENDALIAN INTERN'],
            ['no_pokok' => '21', 'no_subpokok' => '00', 'pokok_penyebab' => 'Penyebab Ekstern Hambatan Kelancaran Kegiatan'],
            ['no_pokok' => '21', 'no_subpokok' => '01', 'pokok_penyebab' => 'Pekerjaan persiapan kegiatan dan perumusan kegiatan kurang mantap (survey dan disain tidak mantap).'],
            ['no_pokok' => '21', 'no_subpokok' => '02', 'pokok_penyebab' => 'DIPA terlambat diterima'],
            ['no_pokok' => '21', 'no_subpokok' => '03', 'pokok_penyebab' => 'Revisi DIPA yang berlarut-larut'],
            ['no_pokok' => '21', 'no_subpokok' => '04', 'pokok_penyebab' => 'Tanah yang diperlukan untuk pelaksanaan kegiatan penyelesaiannya menjadi berlarut-larut.'],
            ['no_pokok' => '21', 'no_subpokok' => '05', 'pokok_penyebab' => 'Tidak dapat diperoleh tanah yang diperlukan karena dana tidak mencukupi atau tidak tersedia.'],
            ['no_pokok' => '21', 'no_subpokok' => '06', 'pokok_penyebab' => 'Penetapan rekanan menjadi berlarut-larut.'],
            ['no_pokok' => '21', 'no_subpokok' => '07', 'pokok_penyebab' => 'Perijinan atau persetujuan untuk memulai suatu kegiatan menjadi berlarut-larut.'],
            ['no_pokok' => '21', 'no_subpokok' => '08', 'pokok_penyebab' => 'Sarana komunikasi dan atau telekomunikasi tidak mendukung kelancaran kegiatan.'],
            ['no_pokok' => '21', 'no_subpokok' => '09', 'pokok_penyebab' => 'Rekanan yang ditetapkan tidak mampu menyelesaikan tanggung jawabnya.'],
            ['no_pokok' => '21', 'no_subpokok' => '10', 'pokok_penyebab' => 'Rekanan mempunyai itikad yang kurang baik.'],
            ['no_pokok' => '21', 'no_subpokok' => '11', 'pokok_penyebab' => 'Penyebab ekstern lainnya.'],
            ['no_pokok' => '22', 'no_subpokok' => '00', 'pokok_penyebab' => 'Penyebab Ekstern Hambatan Kelancaran Tugas Pokok'],
            ['no_pokok' => '22', 'no_subpokok' => '01', 'pokok_penyebab' => 'Instansi lain yang terkait kurang reponsif.'],
            ['no_pokok' => '22', 'no_subpokok' => '02', 'pokok_penyebab' => 'Sarana komunikasi dan atau telekomunkasi tidak mendukung kelancaran tugas instansi.'],
            ['no_pokok' => '22', 'no_subpokok' => '03', 'pokok_penyebab' => 'Revisi DIPA yang diajukan pimpinan instansi penyelesaiannya berlarut-larut.'],
            ['no_pokok' => '22', 'no_subpokok' => '04', 'pokok_penyebab' => 'Rekanan yang telah ditetapkan tidak mampu menyelesaikan tanggung jawab.'],
            ['no_pokok' => '22', 'no_subpokok' => '05', 'pokok_penyebab' => 'Perijinan atau persetujuan untuk memulai suatu kegiatan instansi menjadi berlarut-larut.'],
            ['no_pokok' => '22', 'no_subpokok' => '06', 'pokok_penyebab' => 'Pencairan dana pinjaman tidak tepat waktu atau tidak sesuai jadwal kebutuhan.'],
            ['no_pokok' => '22', 'no_subpokok' => '07', 'pokok_penyebab' => 'Penyebab ekstern lainnya.'],
            ['no_pokok' => '23', 'no_subpokok' => '00', 'pokok_penyebab' => 'Penyebab Ketidaklancaran Pelayanan Aparatur Pemerintah Kepada Masyarakat'],
            ['no_pokok' => '23', 'no_subpokok' => '01', 'pokok_penyebab' => 'Prosedur yang ditetapkan belum sederhana.'],
            ['no_pokok' => '23', 'no_subpokok' => '02', 'pokok_penyebab' => 'Masyarakat buta terhadap persyaratan yang perlu dipenuhi dan prosedur yang harus ditempuh.'],
            ['no_pokok' => '23', 'no_subpokok' => '03', 'pokok_penyebab' => 'Tidak ada batas waktu maksimum penyelesaian pelayanan.'],
            ['no_pokok' => '23', 'no_subpokok' => '04', 'pokok_penyebab' => 'Prosedur yang ditetapkan cukup banyak titik pertemuan pegawai dengan masyarakat sehingga membuka peluang pungutan liar.'],
            ['no_pokok' => '23', 'no_subpokok' => '05', 'pokok_penyebab' => 'Persyaratan yang ditetapkan berlebihan sehingga menyulitkan permohonan pelayanan.'],
            ['no_pokok' => '23', 'no_subpokok' => '06', 'pokok_penyebab' => 'Tidak ada koordinasi antar instansi sehingga jelas siapa yang berwenang mengambil keputusan.'],
        ];

        foreach ($data as $item) {
            PokokPenyebab::create($item);
        }
    }
}