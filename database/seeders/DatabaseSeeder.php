<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Auditor;
use App\Models\Departemen;
use App\Models\Draft;
use App\Models\Induk;
use App\Models\Jobdesk;
use App\Models\LHP;
use App\Models\PokokPenyebab;
use App\Models\PokokRekomendasi;
use App\Models\PokokTemuan;
use App\Models\PokokTindak;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    //Role
    Jobdesk::create(['role' => 'SuperAdmin']);
    Jobdesk::create(['role' => 'Admin']);
    Jobdesk::create(['role' => 'INSPEKTUR']);
    Jobdesk::create(['role' => 'SEKRETARIS']);
    Jobdesk::create(['role' => 'IRBAN']);
    Jobdesk::create(['role' => 'DALNIS']);
    Jobdesk::create(['role' => 'Anggota']);
    Jobdesk::create(['role' => 'Penanggung Jawab']);

    //USer
    User::create([
      'id' => Str::uuid(),
      'profile' => 'IMG_ORIi 800.jpg',
      'nama' => 'Hadi Ikhwanul Fuadi',
      'username' => 'hadi_ikhwanul',
      'NIP' => '225150209111001',
      'no_hp' => '081997963759',
      'no_wa' => '081997963759',
      'kelompok' => 'Admin',
      'jobdesk_id' => '1',
      'email' => 'hadikhwanul@gmail.com',
      'password' => bcrypt('hadi'),
    ]);

    User::create([
      'id' => Str::uuid(),
      'nama' => 'Admin',
      'username' => 'Admin',
      'NIP' => '225150209111002',
      'no_hp' => '081997963752',
      'no_wa' => '081997963752',
      'kelompok' => 'Admin',
      'jobdesk_id' => '2',
      'email' => 'Admin@gmail.com',
      'password' => bcrypt('Admin'),
    ]);

    User::create([
      'id' => Str::uuid(),
      'nama' => 'Pak INSPEKTUR',
      'username' => 'inspektur',
      'NIP' => '225150209111003',
      'no_hp' => '081997963753',
      'no_wa' => '081997963753',
      'kelompok' => 'Pimpinan',
      'jobdesk_id' => '3',
      'email' => 'inspektur@gmail.com',
      'password' => bcrypt('inspektur'),
    ]);

    User::create([
      'id' => Str::uuid(),
      'nama' => 'Pak SEKRETARIS',
      'username' => 'sekretaris',
      'NIP' => '225150209111004',
      'no_hp' => '081997963754',
      'no_wa' => '081997963754',
      'kelompok' => 'Sekretaris',
      'jobdesk_id' => '4',
      'email' => 'sekretaris@gmail.com',
      'password' => bcrypt('sekretaris'),
    ]);

    User::create([
      'id' => Str::uuid(),
      'nama' => 'Bu IRBAN',
      'username' => 'irban',
      'NIP' => '225150209111005',
      'no_hp' => '081997963755',
      'no_wa' => '081997963755',
      'kelompok' => 'IRBAN IV',
      'jobdesk_id' => '5',
      'email' => 'irban@gmail.com',
      'password' => bcrypt('irban'),
    ]);

    User::create([
      'id' => Str::uuid(),
      'nama' => 'Bu DALNIS',
      'username' => 'dalnis',
      'NIP' => '225150209111006',
      'no_hp' => '081997963756',
      'no_wa' => '081997963756',
      'kelompok' => 'IRBAN III',
      'jobdesk_id' => '6',
      'email' => 'dalnis@gmail.com',
      'password' => bcrypt('dalnis'),
    ]);

    User::create([
      'id' => Str::uuid(),
      'nama' => 'Abang Anggota',
      'username' => 'anggota',
      'NIP' => '225150209111007',
      'no_hp' => '081997963757',
      'no_wa' => '081997963757',
      'kelompok' => 'IRBAN II',
      'jobdesk_id' => '7',
      'email' => 'anggota@gmail.com',
      'password' => bcrypt('anggota'),
    ]);

    User::create([
      'id' => Str::uuid(),
      'nama' => 'Penanggung',
      'username' => 'penanggung',
      'NIP' => '225150209111008',
      'no_hp' => '081997963758',
      'no_wa' => '081997963758',
      'kelompok' => 'Tamu',
      'jobdesk_id' => '8',
      'email' => 'penanggung@gmail.com',
      'password' => bcrypt('penanggung'),
    ]);

    //Auditor  
    Auditor::create(['auditor' => 'BPK']);
    Auditor::create(['auditor' => 'BPKP']);
    Auditor::create(['auditor' => 'INSPEKTORAT KAB. LOMBOK TIMUR']);
    Auditor::create(['auditor' => 'INSPEKTORAT PROVINSI NTB']);
    Auditor::create(['auditor' => 'ITJEN DEPARTEMEN AGAMA']);
    Auditor::create(['auditor' => 'ITJEN DEPARTEMEN DALAM NEGERI']);
    Auditor::create(['auditor' => 'ITJEN DEPARTEMEN ENERGI DAN SUMBER DAYA MINERAL']);
    Auditor::create(['auditor' => 'ITJEN DEPARTEMEN KEHUTANAN']);
    Auditor::create(['auditor' => 'ITJEN DEPARTEMEN KELAUTAN DAN PERIKANAN']);
    Auditor::create(['auditor' => 'ITJEN DEPARTEMEN KESEHATAN']);
    Auditor::create(['auditor' => 'ITJEN DEPARTEMEN KOMUNIKASI DAN INFORMATIKA']);
    Auditor::create(['auditor' => 'ITJEN DEPARTEMEN PEKERJAAN UMUM']);
    Auditor::create(['auditor' => 'ITJEN DEPARTEMEN PENDIDIKAN NASIONAL']);
    Auditor::create(['auditor' => 'ITJEN DEPARTEMEN PERHUBUNGAN']);
    Auditor::create(['auditor' => 'ITJEN DEPARTEMEN PERTANIAN']);
    Auditor::create(['auditor' => 'ITJEN DEPARTEMEN SOSIAL']);
    Auditor::create(['auditor' => 'ITJEN DEPARTEMEN TENAGA KERJA DAN TRANSMIGRASI']);
    Auditor::create(['auditor' => 'ITJEN KEMENTERIAN NEGARA KOPERASI DAN UKM']);
    Auditor::create(['auditor' => 'ITJEN KEMENTERIAN NEGARA PEMUDA DAN OLAH RAGA']);
    Auditor::create(['auditor' => 'ITJEN KEMENTERIAN NEGARA PERUMAHAN RAKYAT']);
    Auditor::create(['auditor' => 'ITJEN KEMENTERIAN PAN DAN APARATUR']);
    Auditor::create(['auditor' => 'ITJEN PERPUSTAKAAN NASIONAL REPUBLIK INDONESIA']);

    //induk
    Induk::create(['induk' => 'BAPPENDA - BADAN PENDAPATAN DAERAH']);
    Induk::create(['induk' => 'BKBPP - BADAN KELUARGA BERENCANA DAN PEMBERDAYAAN PEREMPUAN']);
    Induk::create(['induk' => 'BKD - BADAN KEPEGAWAIAN DAERAH DAN PENGEMBANGAN SUMBER DAYA MANUSIA']);
    Induk::create(['induk' => 'BKPP - BADAN KEPEGAWAIAN PENDIDIKAN DAN PELATIHAN']);
    Induk::create(['induk' => 'BAKESBANGPOLDAGRI - BADAN KESATUAN BANGSA DAN POLITIK DALAM NEGERI']);
    Induk::create(['induk' => 'BASKEBANGPOLINMAS - BADAN KESATUAN BANGSA, POLITIK DAN PERLINDUNGAN MASYARAKAT']);
    Induk::create(['induk' => 'BKP - BADAN KETAHANAN PANGAN']);
    Induk::create(['induk' => 'BKPM - BADAN KOORDINASI PENANAMAN MODAL']);
    Induk::create(['induk' => 'BKPM-PT - BADAN KOORDINASI PENANAMAN MODAL DAN PERIZINAN TERPADU']);
    Induk::create(['induk' => 'BLHP - BADAN LINGKUNGAN HIDUP DAN PENELITIAN']);
    Induk::create(['induk' => 'BNN - BADAN NARKOTIKA NASIONAL']);
    Induk::create(['induk' => 'BPM-PEMDES - BADAN PEMBERDAYAAN MASYARAKAT DAN PEMERINTAHAN DESA']);
    Induk::create(['induk' => 'BP2KB - BADAN PEMBERDAYAAN PEREMPUAN DAN KELUARGA BERENCANA']);
    Induk::create(['induk' => 'BPM-LH - BADAN PENANAMAN MODAL DAN LINGKUNGAN HIDUP']);
    Induk::create(['induk' => 'BPBD - BADAN PENANGGULANGAN BENCANA DAERAH']);
    Induk::create(['induk' => 'BPKD - BADAN PENGELOLA KEUANGAN DAERAH']);
    Induk::create(['induk' => 'BPKAD - BADAN PENGELOLAAN KEUANGAN DAN ASET DAERAH']);
    Induk::create(['induk' => 'BPSDM - BADAN PENGEMBANGAN SUMBERDAYA MANUSIA DAERAH']);
    Induk::create(['induk' => 'BAPPEDA - BADAN PERENCANAAN PEMBANGUNAN DAERAH']);
    Induk::create(['induk' => 'BAPERSIP - BADAN PERPUSTAKAAN DAN ARSIP']);
    Induk::create(['induk' => 'BUMD - BADAN USAHA MILIK DAERAH']);
    Induk::create(['induk' => 'BPM-PEMKEL - BPM DAN PEMERINTAHAN KELURAHAN']);
    Induk::create(['induk' => 'BPM-PEMDES-PPKB-KP - BPM, PEMDES, PPKB DAN KP']);
    Induk::create(['induk' => 'DISHUT - DINAS KEHUTANAN']);
    Induk::create(['induk' => 'DISLUTKAN - DINAS KELAUTAN DAN PERIKANAN']);
    Induk::create(['induk' => 'DISDUKCAPIL - DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL']);
    Induk::create(['induk' => 'DIKES - DINAS KESEHATAN']);
    Induk::create(['induk' => 'DISKAPANG - DINAS KETAHANAN PANGAN']);
    Induk::create(['induk' => 'DISKOMINFOTIK - DINAS KOMUNIKASI, INFORMATIKA DAN STATISTIK']);
    Induk::create(['induk' => 'DISKOP - DINAS KOPERASI USAHA KECIL DAN MENENGAH']);
    Induk::create(['induk' => 'DISLHK - DINAS LINGKUNGAN HIDUP']);
    Induk::create(['induk' => 'DLHK - DINAS LINGKUNGAN HIDUP DAN KEBERSIHAN']);
    Induk::create(['induk' => 'DISPAR - DINAS PARIWISATA']);
    Induk::create(['induk' => 'DPUPR - DINAS PEKERJAAN UMUM DAN PENATAAN RUANG']);
    Induk::create(['induk' => 'DPUPT - DINAS PEKERJAAN UMUM, PERTAMBANGAN DAN ENERGI']);
    Induk::create(['induk' => 'DAMKARMAT - DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN']);
    Induk::create(['induk' => 'DPMPD DUKCAPIL - DINAS PEMBERDAYAAN MASYARAKAT']);
    Induk::create(['induk' => 'DP3AP2KB - DINAS PEMBERDAYAAN PEREMPUAN, PERLINDUNGAN ANAK, PENGENDALIAN PENDUDUK DAN KELUARGA BERENCANA']);
    Induk::create(['induk' => 'DIKPORA - DINAS PEMUDA DAN OLAHRAGA']);
    Induk::create(['induk' => 'DPMPTSP - DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU']);
    Induk::create(['induk' => 'DISPENDA - DINAS PENDAPATAN DAERAH']);
    Induk::create(['induk' => 'DPPKAD - DINAS PENDAPATAN, PENGELOLAAN KEUANGAN DAN ASET DAERAH']);
    Induk::create(['induk' => 'DIKBUD - DINAS PENDIDIKAN DAN KEBUDAYAAN']);
    Induk::create(['induk' => 'DISDIK - DINAS PENDIDIKAN NASIONAL']);
    Induk::create(['induk' => 'DISDAG - DINAS PERDAGANGAN']);
    Induk::create(['induk' => 'DISHUBKOMINFO - DINAS PERHUBUNGAN']);
    Induk::create(['induk' => 'DISPERIN - DINAS PERINDUSTRIAN']);
    Induk::create(['induk' => 'DISPERINDAG - DINAS PERINDUSTRIAN DAN PERDAGANGAN']);
    Induk::create(['induk' => 'DISBUN - DINAS PERKEBUNAN']);
    Induk::create(['induk' => 'DPKP - DINAS PERPUSTAKAAN DAN KEARSIPAN']);
    Induk::create(['induk' => 'DISTAMBEN - DINAS PERTAMBANGAN DAN ENERGI']);
    Induk::create(['induk' => 'DISTANBUN - DINAS PERTANIAN']);
    Induk::create(['induk' => 'DPTPH - DINAS PERTANIAN TANAMAN PANGAN DAN HORTIKULTURA']);
    Induk::create(['induk' => 'DPTPH - DINAS PERTANIAN TANAMAN PANGAN DAN PETERNAKAN']);
    Induk::create(['induk' => 'DISPERKIM - DINAS PERUMAHAN DAN PERMUKIMAN']);
    Induk::create(['induk' => 'DISNAKKESWAN - DINAS PETERNAKAN DAN KESEHATAN HEWAN']);
    Induk::create(['induk' => 'DINSOS - DINAS SOSIAL']);
    Induk::create(['induk' => 'DISNAKERTRANS - DINAS TENAGA KERJA DAN TRANSMIGRASI']);
    Induk::create(['induk' => 'INSPEKTORAT - INSPEKTORAT']);
    Induk::create(['induk' => 'KANTOR PPT - KANTOR PPT']);
    Induk::create(['induk' => 'KPUD - KOMISI PEMILIHAN UMUM DAERAH']);
    Induk::create(['induk' => 'PEMDES - PEMERINTAH DESA']);
    Induk::create(['induk' => 'PEMKEC - PEMERINTAH KECAMATAN']);
    Induk::create(['induk' => 'SATPOL PP - SATUAN POLISI PAMONG PRAJA']);
    Induk::create(['induk' => 'SEKDA - SEKRETARIAT DAERAH']);
    Induk::create(['induk' => 'SEKWAN - SEKRETARIAT DPRD']);

    //Departemen
    Departemen::create(['departemen' => 'DEPARTEMEN AGAMA']);
    Departemen::create(['departemen' => 'DEPARTEMEN ENERGI DAN SDM']);
    Departemen::create(['departemen' => 'DEPARTEMEN KEHUTANAN']);
    Departemen::create(['departemen' => 'DEPARTEMEN KELAUTAN DAN PERIKANAN']);
    Departemen::create(['departemen' => 'DEPARTEMEN KESEHATAN']);
    Departemen::create(['departemen' => 'DEPARTEMEN KOMINFO']);
    Departemen::create(['departemen' => 'DEPARTEMEN NAKERTRANS']);
    Departemen::create(['departemen' => 'DEPARTEMEN PEKERJAAN UMUM']);
    Departemen::create(['departemen' => 'DEPARTEMEN PENDIDIKAN NASIONAL']);
    Departemen::create(['departemen' => 'DEPARTEMEN PERHUBUNGAN']);
    Departemen::create(['departemen' => 'DEPARTEMEN PERTANIAN']);
    Departemen::create(['departemen' => 'DEPARTEMEN SOSIAL']);
    Departemen::create(['departemen' => 'KEMENEG PEMUDA DAN OLAH RAGA']);
    Departemen::create(['departemen' => 'KEMENEG PERUMAHAN RAKYAT']);
    Departemen::create(['departemen' => 'KEMENTERIAN DALAM NEGERI']);
    Departemen::create(['departemen' => 'KEMENTERIAN KOPERASI DAN UKM']);
    Departemen::create(['departemen' => 'KEMENTERIAN PAN DAN APARATUR']);
    Departemen::create(['departemen' => 'PERPUSTAKAAN NASIONAL RI']);

    //Pokok Temuan
    $this->call(PokokTemuanSeeder::class);

    //Pokok Penyebab
    $this->call(PokokPenyebabSeeder::class);

    //Pokok Rekomendasi
    $this->call(PokokRekomendasiSeeder::class);

    //Pokok Tindak Lanjut
    $this->call(PokokTindakSeeder::class);

    //Pokok Kecamatan
    $this->call(KecamatanSeeder::class);

    //Pokok Satker
    $this->call(SatkerSeeder::class);

    Draft::factory(30)->create(); // Seed LHPS


  }
}