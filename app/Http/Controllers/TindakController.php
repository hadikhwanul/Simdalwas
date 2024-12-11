<?php

namespace App\Http\Controllers;

use App\Models\Draft;
use App\Models\Kecamatan;
use App\Models\Satker;
use App\Models\Tagihan;
use App\Models\Tindak;
use App\Models\PokokTindak;
use App\Models\Rekomendasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TindakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rekomendasi = Rekomendasi::with('tindaks') // Eager load the 'tindaks' relationship
            ->latest()
            ->paginate(10);


        return view('Tindak.index', [
            'judul' => 'Tindak Lanjut',
            'rekomendasi' => $rekomendasi,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
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
        // Memuat relasi tagihans dan rekomendasis
        $tindak = Tindak::with(['tagihans', 'tagihans.rekomendasis'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('Tindak.daftartagih', [
            'judul' => 'Tindak Lanjut',
            'tindak' => $tindak,
            'tagihan' => $tindak->tagihans, // Mengambil tagihan dari relasi
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
            ->get(); // Menambahkan get() untuk mengambil data

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