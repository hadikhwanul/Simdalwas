<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Draft;
use App\Models\Induk;
use App\Models\Satker;
use App\Models\Tindak;
use App\Models\Tagihan;
use App\Models\Kecamatan;
use App\Models\PokokTindak;
use App\Models\Rekomendasi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class TindakController extends Controller
{
    public function index(Request $request)
    {
        $query = Rekomendasi::with(['tindaks', 'temuan.draft']); // Eager load relationships

        // Filter berdasarkan temuan->draft
        if ($request->filled('bidang')) {
            $query->whereHas('temuan.draft', function ($q) use ($request) {
                $q->where('bidang', $request->bidang);
            });
        }

        if ($request->filled('sifat')) {
            $query->whereHas('temuan.draft', function ($q) use ($request) {
                $q->where('sifat', $request->sifat);
            });
        }

        if ($request->filled('tanggal_lhp')) {
            $query->whereHas('temuan.draft', function ($q) use ($request) {
                $q->whereDate('tanggal_lhp', $request->tanggal_lhp);
            });
        }

        if ($request->has('induk_id') && $request->induk_id != '') {
            $query->whereHas('temuan.draft', function ($q) use ($request) {
                $q->where('induk_id', $request->induk_id);
            });
        }

        // Filter berdasarkan status di tindak
        if ($request->filled('status')) {
            $query->whereHas('tindaks', function ($q) use ($request) {
                $q->where('status', $request->status);
            });
        }

        // Eksekusi query dengan paginasi
        $rekomendasi = $query->latest()->get();

        return view('Tindak.index', [
            'judul' => 'Tindak Lanjut',
            'rekomendasi' => $rekomendasi,
            'induks' => Induk::all(),
        ]);
    }


    public function create($slug)
    {
        $rekomendasi = Rekomendasi::where('slug', $slug)->firstOrFail();
        // Get distinct PokokTindak data
        $pokokTindak = PokokTindak::select('pokok_tindak', 'no_pokok')->distinct()->get();

        // Get distinct SubPokokTindak data, excluding no_subpokok = '00'
        $subpokokTindak = PokokTindak::select('pokok_tindak', 'sub_pokok_tindak', 'no_pokok', 'no_subpokok', 'id')
            ->where('no_subpokok', '!=', '00') // Exclude entries with no_subpokok == '00'
            ->distinct()
            ->get();

        return view('Tindak.create', [
            'judul' => 'Tindak Lanjut',
            'rekomendasi' => $rekomendasi,
            'PokokTindak' => $pokokTindak,
            'SubPokokTindak' => $subpokokTindak,

        ]);
    }
    public function store(Request $request, $slug)
    {
        try {
            // Validate incoming request data
            $validated = $request->validate([
                'tindak' => 'required|string', // 'tindak' is a required string
                'pokok_tindak' => 'required|integer', // 'pokok_tindak' must be an integer
                'pokok_temuan_id' => 'required|integer', // 'pokok_temuan_id' must be an integer
                'status' => 'required|string', // 'status' is a required string
                'tanggal_tl' => 'required|date', // 'tanggal_tl' must be a valid date
            ]);

            // Retrieve the rekomendasi by slug
            $rekomendasi = Rekomendasi::where('slug', $slug)->firstOrFail();

            // Create a new Tindak record
            $tindak = new Tindak();
            $tindak->tindak = $validated['tindak'];
            $tindak->pokok_tindak_id = $validated['pokok_temuan_id'];
            $tindak->status = $validated['status'];
            $tindak->tanggal_tl = $validated['tanggal_tl'];
            $tindak->rekomendasi_id = $rekomendasi->id; // Assign the rekomendasi ID

            // Handle file upload if exists
            if ($request->hasFile('laporan_tl')) {
                $tindak->laporan_tl = $request->file('laporan_tl')->store('laporan_tindak');
            }

            // Save the Tindak record
            $tindak->save();

            // Redirect to the appropriate route with a success message
            return redirect()->route('tindak.index')
                ->with('success', 'Tindak Lanjut berhasil disimpan.');

        } catch (\Exception $e) {
            // Handle any errors (e.g., database errors, validation errors)
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                ->withInput();
        }
    }
    public function daftartagih($slug)
    {
        // Memuat relasi tagihans dan rekomendasis berdasarkan slug
        $tindak = Tindak::with(['tagihans', 'rekomendasis']) // Now using the corrected relationship
            ->where('slug', $slug)
            ->firstOrFail();

        $tagihans = Tagihan::where('tindak_id', $tindak->id)->latest()->get();

        return view('Tindak.daftartagih', [
            'judul' => 'Tindak Lanjut',
            'tindak' => $tindak,
            'tagihan' => $tagihans,
        ]);
    }


    public function penanggungcreate($slug)
    {
        // Mendapatkan data tindak berdasarkan slug
        $tindak = Tindak::where('slug', $slug)->firstOrFail();

        // Mendapatkan daftar pengguna dengan kelompok 'Tamu' dan role 'Penanggung Jawab'
        $penanggung = User::where('kelompok', 'Tamu')
            ->whereHas('jobdesks', function ($query) {
                $query->where('role', 'Penanggung Jawab');
            })
            ->get();

        return view('Tindak.tagihan', [
            'judul' => 'Tindak Lanjut',
            'tindak' => $tindak,
            'penanggung' => $penanggung,
            'kecamatan' => Kecamatan::getDistinctKecamatan(),
            'deskel' => Kecamatan::getDistinctDeskel(),
            'opd' => Satker::getDistinctOpd(),
            'sekolah' => Satker::getDistinctSekolah(),
        ]);
    }

    public function penanggungstore(Request $request, $slug)
    {
        // Validasi data request
        $validatedData = $request->validate([
            'user_id' => 'required|uuid|exists:users,id',
            'deadline' => 'required|date',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'satker_id' => 'required|exists:satkers,id',
            'total_kerugian' => 'nullable|numeric|min:0',
            'total_kewajiban' => 'nullable|numeric|min:0',
            'peran_rugi' => 'nullable|string',
            'ket_rugi' => 'nullable|string',
            'peran_wajib' => 'nullable|string',
            'ket_wajib' => 'nullable|string',
            'user' => 'required|string',
        ]);

        // Cek data yang diterima
        Log::debug('Validated Data for Tagihan: ', $validatedData);

        // Cari data tindak berdasarkan slug
        $tindak = Tindak::where('slug', $slug)->first();
        if (!$tindak) {
            Log::error('Tindak not found for slug: ' . $slug);
            return redirect()->back()->with('error', 'Tindak tidak ditemukan.');
        }

        try {
            // Membuat dan menyimpan Tagihan baru
            $tagihan = new Tagihan();
            $tagihan->user_id = $validatedData['user_id'];
            $tagihan->deadline = $validatedData['deadline'];
            $tagihan->kecamatan_id = $validatedData['kecamatan_id'] ?? null;
            $tagihan->satker_id = $validatedData['satker_id'] ?? null;
            $tagihan->total_kerugian = $validatedData['total_kerugian'] ?? 0;
            $tagihan->sisa_kerugian = $tagihan->total_kerugian; // Assign numeric value
            $tagihan->bayar_kerugian = 0;
            $tagihan->total_kewajiban = $validatedData['total_kewajiban'] ?? 0;
            $tagihan->sisa_kewajiban = $tagihan->total_kewajiban; // Assign numeric value
            $tagihan->bayar_kewajiban = 0;
            $tagihan->peran_rugi = $validatedData['peran_rugi'] ?? null;
            $tagihan->ket_rugi = $validatedData['ket_rugi'] ?? null;
            $tagihan->peran_wajib = $validatedData['peran_wajib'] ?? null;
            $tagihan->ket_wajib = $validatedData['ket_wajib'] ?? null;
            $tagihan->user_tindak = $validatedData['user'];
            $tagihan->tindak_id = $tindak->id;

            // Simpan data ke database
            $tagihan->save();

            Log::info('Tagihan berhasil disimpan: ', $tagihan->toArray());

            // Redirect dengan pesan sukses
            return redirect()->route('daftar.pj', $slug)
                ->with('success', 'Tagihan dan Penanggung Jawab berhasil ditambahkan.');
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Query Exception: ' . $e->getMessage(), ['slug' => $slug, 'data' => $validatedData]);
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan pada database. Silakan coba lagi.');
        } catch (\Exception $e) {
            Log::error('General Exception: ' . $e->getMessage(), ['slug' => $slug, 'data' => $validatedData]);
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }



    public function penanggungedit($slug, $tagihanSlug)
    {
        // Mendapatkan data tindak berdasarkan slug
        $tindak = Tindak::where('slug', $slug)->firstOrFail();

        // Mendapatkan data tagihan berdasarkan tagihan slug
        $tagihan = Tagihan::where('slug', $tagihanSlug)->firstOrFail();

        // Mendapatkan daftar pengguna dengan kelompok 'Tamu' dan role 'Penanggung Jawab'
        $penanggung = User::where('kelompok', 'Tamu')
            ->whereHas('jobdesks', function ($query) {
                $query->where('role', 'Penanggung Jawab');
            })
            ->get();

        return view('Tindak.edittagihan', [
            'judul' => 'Tindak Lanjut',
            'tindak' => $tindak,
            'penanggung' => $penanggung,
            'tagihan' => $tagihan,
            'kecamatan' => Kecamatan::getDistinctKecamatan(),
            'deskel' => Kecamatan::getDistinctDeskel(),
            'opd' => Satker::getDistinctOpd(),
            'sekolah' => Satker::getDistinctSekolah(),
        ]);
    }


    public function penanggungupdate(Request $request, $slug, $tagihanSlug)
    {
        // Validasi data request
        $validatedData = $request->validate([
            'user_id' => 'required|uuid|exists:users,id',
            'deadline' => 'required|date',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'satker_id' => 'required|exists:satkers,id',
            'total_kerugian' => 'nullable|numeric|min:0',
            'total_kewajiban' => 'nullable|numeric|min:0',
            'peran_rugi' => 'nullable|string',
            'ket_rugi' => 'nullable|string',
            'peran_wajib' => 'nullable|string',
            'ket_wajib' => 'nullable|string',
            'user' => 'required|string',
        ]);

        // Cek data yang diterima
        Log::debug('Validated Data for Tagihan: ', $validatedData);

        // Cari data tindak berdasarkan slug
        $tindak = Tindak::where('slug', $slug)->first();
        if (!$tindak) {
            Log::error('Tindak not found for slug: ' . $slug);
            return redirect()->back()->with('error', 'Tindak tidak ditemukan.');
        }

        // Cari Tagihan berdasarkan slug
        $tagihan = Tagihan::where('slug', $tagihanSlug)->where('tindak_id', $tindak->id)->first();
        if (!$tagihan) {
            Log::error('Tagihan not found for slug: ' . $tagihanSlug);
            return redirect()->back()->with('error', 'Tagihan tidak ditemukan.');
        }

        try {
            // Update Tagihan dengan data baru
            $tagihan->user_id = $validatedData['user_id'];
            $tagihan->deadline = $validatedData['deadline'];
            $tagihan->kecamatan_id = $validatedData['kecamatan_id'] ?? null;
            $tagihan->satker_id = $validatedData['satker_id'] ?? null;
            $tagihan->total_kerugian = $validatedData['total_kerugian'] ?? 0;
            $tagihan->sisa_kerugian = $tagihan->total_kerugian; // Assign numeric value
            $tagihan->bayar_kerugian = 0;
            $tagihan->total_kewajiban = $validatedData['total_kewajiban'] ?? 0;
            $tagihan->sisa_kewajiban = $tagihan->total_kewajiban; // Assign numeric value
            $tagihan->bayar_kewajiban = 0;
            $tagihan->peran_rugi = $validatedData['peran_rugi'] ?? null;
            $tagihan->ket_rugi = $validatedData['ket_rugi'] ?? null;
            $tagihan->peran_wajib = $validatedData['peran_wajib'] ?? null;
            $tagihan->ket_wajib = $validatedData['ket_wajib'] ?? null;
            $tagihan->user_tindak = $validatedData['user'];
            $tagihan->tindak_id = $tindak->id;

            // Simpan perubahan ke database
            $tagihan->save();

            Log::info('Tagihan berhasil diupdate: ', $tagihan->toArray());

            // Redirect dengan pesan sukses
            return redirect()->route('daftar.pj', $slug)
                ->with('success', 'Tagihan dan Penanggung Jawab berhasil diperbarui.');
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Query Exception: ' . $e->getMessage(), ['slug' => $slug, 'tagihanSlug' => $tagihanSlug, 'data' => $validatedData]);
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan pada database. Silakan coba lagi.');
        } catch (\Exception $e) {
            Log::error('General Exception: ' . $e->getMessage(), ['slug' => $slug, 'tagihanSlug' => $tagihanSlug, 'data' => $validatedData]);
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function penanggungsdestroy($slug, $tagihanSlug)
    {
        // Cari data tindak berdasarkan slug
        $tindak = Tindak::where('slug', $slug)->first();
        if (!$tindak) {
            Log::error('Tindak not found for slug: ' . $slug);
            return redirect()->back()->with('error', 'Tindak tidak ditemukan.');
        }

        // Cari Tagihan berdasarkan slug
        $tagihan = Tagihan::where('slug', $tagihanSlug)->where('tindak_id', $tindak->id)->first();
        if (!$tagihan) {
            Log::error('Tagihan not found for slug: ' . $tagihanSlug);
            return redirect()->back()->with('error', 'Tagihan tidak ditemukan.');
        }

        try {
            // Menghapus tagihan
            $tagihan->delete();

            Log::info('Tagihan berhasil dihapus: ', $tagihan->toArray());

            // Redirect dengan pesan sukses
            return redirect()->route('daftar.pj', $slug)
                ->with('success', 'Tagihan dan Penanggung Jawab berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('General Exception: ' . $e->getMessage(), ['slug' => $slug, 'tagihanSlug' => $tagihanSlug]);
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Tindak $tindak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tindak $tindak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tindak $tindak)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tindak $tindak)
    {
        //
    }
}