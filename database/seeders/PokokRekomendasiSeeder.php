<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PokokRekomendasi;

class PokokRekomendasiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['no_pokok' => '01', 'no_subpokok' => '00', 'pokok_rekomendasi' => 'Rekomendasi Bersifat Finansial'],
            ['no_pokok' => '01', 'no_subpokok' => '01', 'pokok_rekomendasi' => 'Penyetoran ke kas Negara/Daerah sisa anggaran, Pajak dan non Pajak yang belum disetor.'],
            ['no_pokok' => '01', 'no_subpokok' => '02', 'pokok_rekomendasi' => 'Penyetoran kembali uang ke Kas Negara / Daerah selain sisa anggaran, pajak dan Non Pajak.'],
            ['no_pokok' => '01', 'no_subpokok' => '03', 'pokok_rekomendasi' => 'Penagihan kepada pihak ketiga hak Negara/Daerah berupa pajak dan non pajak dan penyetorannya ke Kas Negara/Daerah.'],
            ['no_pokok' => '01', 'no_subpokok' => '04', 'pokok_rekomendasi' => 'Penagihan kepada pegawai hak/tagihan Negara/Daerah dan penyetorannya ke Kas Negara/Daerah.'],
            ['no_pokok' => '01', 'no_subpokok' => '05', 'pokok_rekomendasi' => 'Pembatalan pengeluaran yang tidak sesuai atau melampaui mata anggarannya dan penyetorannya ke Kas Negara/Daerah.'],
            ['no_pokok' => '01', 'no_subpokok' => '06', 'pokok_rekomendasi' => 'Penyetoran kembali uang ke Kas BUMN/BUMD.'],
            ['no_pokok' => '01', 'no_subpokok' => '07', 'pokok_rekomendasi' => 'Penagihan kepada pihak ketiga hak BUMN/BUMD dan pelunasannya oleh pihak ketiga.'],
            ['no_pokok' => '01', 'no_subpokok' => '08', 'pokok_rekomendasi' => 'Pengenaan denda dan penyetorannya ke Kas BUMN/BUMD.'],
            ['no_pokok' => '01', 'no_subpokok' => '09', 'pokok_rekomendasi' => 'Tuntutan ganti rugi terhadap pegawai BUMN/BUMD dan penyetoran ganti rugi ke Kas BUMN/BUMD.'],
            ['no_pokok' => '01', 'no_subpokok' => '10', 'pokok_rekomendasi' => 'Pengembalian fungli kepada masyarakat.'],
            ['no_pokok' => '01', 'no_subpokok' => '11', 'pokok_rekomendasi' => 'Rekomendasi lainnya yang bersifat finansial.'],
            ['no_pokok' => '02', 'no_subpokok' => '00', 'pokok_rekomendasi' => 'Rekomendasi Bersifat Pengembalian Barang atau Penyerahan Barang/Jasa'],
            ['no_pokok' => '02', 'no_subpokok' => '01', 'pokok_rekomendasi' => 'Pengembalian Barang Milik Negara/Daerah.'],
            ['no_pokok' => '02', 'no_subpokok' => '02', 'pokok_rekomendasi' => 'Penyerahan barang/jasa sebagai realisasi kontrak kepada Negara/Daerah.'],
            ['no_pokok' => '02', 'no_subpokok' => '03', 'pokok_rekomendasi' => 'Pengembalian barang milik BUMN/BUMD.'],
            ['no_pokok' => '02', 'no_subpokok' => '04', 'pokok_rekomendasi' => 'Penyerahan barang/jasa sebagai realisasi kontrak kepada BUMN/BUMD.'],
            ['no_pokok' => '02', 'no_subpokok' => '05', 'pokok_rekomendasi' => 'Pengembalian bantuan yang dipotong kepada masyarakat.'],
            ['no_pokok' => '02', 'no_subpokok' => '06', 'pokok_rekomendasi' => 'Rekomendasi lain bersifat pengembalian barang atau penyerahan barang/jasa.'],
            ['no_pokok' => '03', 'no_subpokok' => '00', 'pokok_rekomendasi' => 'Rekomendasi Bersifat Hukum oleh Instansi yang Bersangkutan'],
            ['no_pokok' => '03', 'no_subpokok' => '01', 'pokok_rekomendasi' => 'Pelaksanaan hukuman disiplin berdasarkan PP 53 Tahun 2010.'],
            ['no_pokok' => '03', 'no_subpokok' => '02', 'pokok_rekomendasi' => 'Pelaksanaan hukuman disiplin berdasarkan peraturan lainnya.'],
            ['no_pokok' => '03', 'no_subpokok' => '03', 'pokok_rekomendasi' => 'Rekomendasi lain bersifat hukuman.'],
            ['no_pokok' => '04', 'no_subpokok' => '00', 'pokok_rekomendasi' => 'Rekomendasi yang Diserahkan ke Aparat yang Berwenang'],
            ['no_pokok' => '04', 'no_subpokok' => '01', 'pokok_rekomendasi' => 'Penyerahan kasus tindak pidana korupsi kepada kepolisian.'],
            ['no_pokok' => '04', 'no_subpokok' => '02', 'pokok_rekomendasi' => 'Penyerahan kasus tindak pidana korupsi kepada kejaksaan.'],
            ['no_pokok' => '04', 'no_subpokok' => '03', 'pokok_rekomendasi' => 'Penyerahan kasus tindak pidana korupsi kepada KPK.'],
            ['no_pokok' => '04', 'no_subpokok' => '04', 'pokok_rekomendasi' => 'Penyerahan kasus kepada instansi lainnya yang berwenang.'],
            ['no_pokok' => '05', 'no_subpokok' => '00', 'pokok_rekomendasi' => 'Rekomendasi yang Tidak Bersifat Hukuman'],
            ['no_pokok' => '05', 'no_subpokok' => '01', 'pokok_rekomendasi' => 'Memperbaiki segera kegiatan atau keadaan agar sesuai dengan peraturan perundang-undangan yang berlaku.'],
            ['no_pokok' => '05', 'no_subpokok' => '02', 'pokok_rekomendasi' => 'Memperbaiki segera kegiatan atau keadaan sesuai dengan prosedur atau tata kerja yang berlaku bagi organisasi termasuk prinsip akuntansi yang lazim.'],
            ['no_pokok' => '05', 'no_subpokok' => '03', 'pokok_rekomendasi' => 'Membatalkan keputusan atau pelaksanaan kegiatan yang tidak sesuai dengan peraturan perundang-undangan yang berlaku.'],
            ['no_pokok' => '05', 'no_subpokok' => '04', 'pokok_rekomendasi' => 'Rekomendasi lainnya yang tidak bersifat hukuman.'],
            ['no_pokok' => '06', 'no_subpokok' => '00', 'pokok_rekomendasi' => 'Rekomendasi Bersifat Peningkatan Kehematan'],
            ['no_pokok' => '06', 'no_subpokok' => '01', 'pokok_rekomendasi' => 'Penyempurnaan organisasi pengadaan sumber daya.'],
            ['no_pokok' => '06', 'no_subpokok' => '02', 'pokok_rekomendasi' => 'Penyempurnaan kebijakan pengadaan sumber daya.'],
            ['no_pokok' => '06', 'no_subpokok' => '03', 'pokok_rekomendasi' => 'Penyempurnaan prosedur pelaksanaan pengadaan sumber daya.'],
            ['no_pokok' => '06', 'no_subpokok' => '04', 'pokok_rekomendasi' => 'Penyempurnaan rencana yang sudah ada mengenai pengadaan sumber daya.'],
            ['no_pokok' => '06', 'no_subpokok' => '05', 'pokok_rekomendasi' => 'Penyempurnaan sistem pencatatan dan pelaporan dalam rangka meningkatkan efektivitas pemantauan atasan untuk pengarahan dan tindakan korektif terhadap penyimpangan yang terjadi dalam proses pengadaan sumber daya.'],
            ['no_pokok' => '06', 'no_subpokok' => '06', 'pokok_rekomendasi' => 'Peningkatan mutu personil dan personil kunci yang terlibat dalam proses pengadaan sumber daya.'],
            ['no_pokok' => '06', 'no_subpokok' => '07', 'pokok_rekomendasi' => 'Penyempurnaan proses perumusan kebijakan pengadaan sumber daya.'],
            ['no_pokok' => '06', 'no_subpokok' => '08', 'pokok_rekomendasi' => 'Penyempurnaan proses perencanaan pengadaan sumber daya.'],
            ['no_pokok' => '06', 'no_subpokok' => '09', 'pokok_rekomendasi' => 'Penyempurnaan sistem informasi pasar dalam rangka pengadaan sumber daya.'],
            ['no_pokok' => '06', 'no_subpokok' => '10', 'pokok_rekomendasi' => 'Penyempurnaan proses pengarahan dan tindakan korektif oleh atasan untuk penyempurnaan.'],
            ['no_pokok' => '06', 'no_subpokok' => '11', 'pokok_rekomendasi' => 'Penyempurnaan sistem evaluasi atasan terhadap proses dan hasil pengadaan sumber daya.'],
            ['no_pokok' => '06', 'no_subpokok' => '12', 'pokok_rekomendasi' => 'Penyempurnaan lain dalam proses pengadaan sumber daya agar tercapai tujuan mendapatkan sumber daya dengan biaya yang terendah tanpa menurunkan pemenuhan fungsi & kualitas minimum sumber daya dalam kedudukannya sebagai masukan untuk mencapai tujuan organisasi secara efisien dan efektif.'],
            ['no_pokok' => '07', 'no_subpokok' => '00', 'pokok_rekomendasi' => 'Rekomendasi Bersifat Peningkatan Efisiensi/Produktivitas'],
            ['no_pokok' => '07', 'no_subpokok' => '01', 'pokok_rekomendasi' => 'Penyempurnaan standar masukan/keluaran atau masukan/keluaran bagian/bidang tertentu (pusat-pusat tanggung jawab).'],
            ['no_pokok' => '07', 'no_subpokok' => '02', 'pokok_rekomendasi' => 'Penyempurnaan pemantauan atasan terhadap penyimpangan pusat tanggung jawab dari standar dalam rangka meningkatkan efektivitas pengarahan atasan dan atau tindakan korektif atasan terhadap penyimpangan dari standar tersebut.'],
            ['no_pokok' => '07', 'no_subpokok' => '03', 'pokok_rekomendasi' => 'Penyempurnaan unsur-unsur sistem pengendalian dalam rangka meningkatkan efektivitas pengendalian terhadap efisiensi penggunaan sumber daya dan tata kerja (dibandingkan tata kerja lainnya yang mungkin) dalam mencapai tujuan organisasi secara efektif.'],
            ['no_pokok' => '07', 'no_subpokok' => '04', 'pokok_rekomendasi' => 'Penyempurnaan pelaksanaan pemantauan oleh atasan terhadap penggunaan sumber daya dan tata kerja untuk menghasilkan keluaran dalam rangka meningkatkan efektivitas pengarahan dan atau tindakan korektif atasan terhadap keadaan yang menurunkan efisien organisasi (dibandingkan tata kerja lain yang mungkin) dalam mencapai tujuan organisasi secara efektif.'],
            ['no_pokok' => '07', 'no_subpokok' => '05', 'pokok_rekomendasi' => 'Penyempurnaan sistem evaluasi alasan terhadap efisiensi operasional pusat-pusat tanggung jawab dan efisiensi tata kerja organisasi (dibandingkan tata kerja lain yang mungkin) dalam mencapai tujuan organisasi secara efektif.'],
            ['no_pokok' => '07', 'no_subpokok' => '06', 'pokok_rekomendasi' => 'Penyempurnaan lain penggunaan sumber daya, hasil yang diperoleh dan tata kerja dalam rangka meningkatkan efisiensi penggunaan sumber daya dan tata kerja menghasilkan keluaran dalam mencapai tujuan antara tujuan organisasi secara efektif.'],
            ['no_pokok' => '08', 'no_subpokok' => '00', 'pokok_rekomendasi' => 'Rekomendasi Bersifat Peningkatan Efektivitas'],
            ['no_pokok' => '08', 'no_subpokok' => '01', 'pokok_rekomendasi' => 'Penyempurnaan kuantifikasi keluaran organisasi.'],
            ['no_pokok' => '08', 'no_subpokok' => '02', 'pokok_rekomendasi' => 'Penyempurnaan kuantifikasi tujuan yang ingin dicapai organisasi atau indikator keberhasilan organisasi.'],
            ['no_pokok' => '08', 'no_subpokok' => '03', 'pokok_rekomendasi' => 'Penyempurnaan kejelasan tujuan organisasi.'],
            ['no_pokok' => '08', 'no_subpokok' => '04', 'pokok_rekomendasi' => 'Penyempurnaan strategi menajemen (kebijakan dan program pokok) dalam mencapai tujuan organisasi secara efisien dan efektif.'],
            ['no_pokok' => '08', 'no_subpokok' => '05', 'pokok_rekomendasi' => 'Penyempurnaan alokasi berdaya untuk meningkatkan efisiensi dan efektivitas pencapaian tujuan organisasi.'],
            ['no_pokok' => '08', 'no_subpokok' => '06', 'pokok_rekomendasi' => 'Penyempurnaan unsur-unsur sistem pengendalian (sarana waskat) dalam rangka meningkatkan pengendalian atasan terhadap efisiensi dan efektivitas pencapaian tujuan organisasi.'],
            ['no_pokok' => '08', 'no_subpokok' => '07', 'pokok_rekomendasi' => 'Penyempurnaan pelaksanaan pemantauan oleh atasan terhadap penggunaan sumber daya dan kegiatan mencapai tujuan dalam rangka meningkatkan efektivitas pengarahan dan atau tindakan korektif atasan terhadap penyimpangan yang akan menghambat/menghalangi pencapaian tujuan organisasi secara efisien dan efektif (keluaran organisasi tujuan organisasi secara efisien dan efektif (keluaran organisasi tidak mendukung pencapaian tujuan organisasi).'],
            ['no_pokok' => '08', 'no_subpokok' => '08', 'pokok_rekomendasi' => 'Penyempurnaan sistem penilaian alasan terhadap penggunaan sumber daya dan tata kerja mencapai tujuan dan terhadap tujuan yang dapat dicapai untuk bahan masukan bagi pelaksana siklus pengelolaan berikutnya.'],
            ['no_pokok' => '08', 'no_subpokok' => '09', 'pokok_rekomendasi' => 'Penyempurnaan lain terhadap alokasi sumber daya susunan sumber daya dan kegiatan organisasi dalam rangka pencapain tujuan organisasi secara efisien dan efektif.'],
            ['no_pokok' => '08', 'no_subpokok' => '10', 'pokok_rekomendasi' => 'Penyederhanaan kerja dibidang pelayanan perijinan dan rekomendasi instansi untuk penerbitan perijinan.'],
            ['no_pokok' => '08', 'no_subpokok' => '11', 'pokok_rekomendasi' => 'Penyederhanaan kerja dibidang pelaksanaan pelayanan sebagai tugas pokok instansi/BUMN/BUMD.'],
            ['no_pokok' => '08', 'no_subpokok' => '12', 'pokok_rekomendasi' => 'Penyempurnaan penyebarluasan tatacara dan persyaratan perijinan/pelayanan kepada masyarakat.'],
            ['no_pokok' => '08', 'no_subpokok' => '13', 'pokok_rekomendasi' => 'Penyempurnaan koordinasi antarinstansi dalam pelaksanaan pelayanan kepada masyarakat.'],
            ['no_pokok' => '09', 'no_subpokok' => '00', 'pokok_rekomendasi' => 'Rekomendasi Bersifat Peningkatan Sistem Pengendalian Intern'],
            ['no_pokok' => '09', 'no_subpokok' => '01', 'pokok_rekomendasi' => 'Penyempurnaan lingkungan pengendalian.'],
            ['no_pokok' => '09', 'no_subpokok' => '02', 'pokok_rekomendasi' => 'Penyempurnaan penilaian resiko.'],
            ['no_pokok' => '09', 'no_subpokok' => '03', 'pokok_rekomendasi' => 'Penyempurnaan kegiatan pengendalian.'],
            ['no_pokok' => '09', 'no_subpokok' => '04', 'pokok_rekomendasi' => 'Penyempurnaan informasi dan komunikasi.'],
            ['no_pokok' => '09', 'no_subpokok' => '05', 'pokok_rekomendasi' => 'Penyempurnaan pemantauan pengendalian intern.'],
        ];

        foreach ($data as $item) {
            PokokRekomendasi::create($item);
        }
    }
}