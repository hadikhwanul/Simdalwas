<?php

namespace App\Http\Controllers;

use App\Models\Draft;
use App\Models\Induk;
use App\Models\Bidang;
use App\Models\Temuan;
use App\Models\Auditor;
use App\Models\History;
use App\Models\Departemen;
use App\Models\Penyebab;
use App\Models\PokokTemuan;
use Illuminate\Http\Request;
use App\Models\PokokPenyebab;
use App\Models\PokokRekomendasi;
use App\Models\Rekomendasi;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TemuanExport;

class LHPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil user yang sedang login
        $user = auth()->user();
        $userRole = $user->jobdesks->role; // Asumsi role disimpan di 'role'
        $userKlmpk = $user->kelompok; // Asumsi kelompok disimpan di 'kelompok'

        // Daftar role yang menampilkan semua laporan
        $excludedRoles = ['SEKRETARIS', 'INSPEKTUR', 'Admin', 'SuperAdmin'];

        // Mulai query draft
        $query = Draft::query()->where('status', 'LHP Terbit');

        // Filter berdasarkan role
        if (!in_array($userRole, $excludedRoles)) {
            // Filter berdasarkan kelompok hanya jika role tidak termasuk dalam excludedRoles
            if (!empty($userKlmpk)) {
                $query->where('irban', $userKlmpk);
            }
        }

        // Apply filters dari request
        if ($request->filled('bidang')) {
            $query->where('bidang', $request->bidang);
        }

        if ($request->filled('sifat')) {
            $query->where('sifat', $request->sifat);
        }

        if ($request->filled('tanggal_lhp')) {
            $query->whereDate('tanggal_lhp', $request->tanggal_lhp);
        }

        if ($request->has('induk_id') && $request->induk_id != '') {
            $query->where('induk_id', $request->induk_id);
        }

        // Eksekusi query untuk mendapatkan hasil
        $drafts = $query->latest()->get();

        return view('LHP.index', [
            "judul" => "LHP",
            "lhps" => $drafts,
            'induks' => Induk::all(),
        ]);
    }
    public function show(Draft $draft)
    {
        $draft->load('histories');
        return view('LHP.show', [
            "judul" => 'LHP',
            "lhp" => $draft,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Draft $draft)
    {
        return view('LHP.edit', [
            "judul" => "LHP",
            "lhp" => $draft,
            "departemen" => Departemen::all(),
            "induk" => Induk::all(),
            "auditor" => Auditor::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Draft $draft)
    {
        $validatedDataLhp = $request->validate([
            'no_lhp' => 'required|string',
            'judul' => 'required|string',
            'tanggal_lhp' => 'required|date',
            'auditor_id' => 'required|integer',
            'induk_id' => 'required|integer',
            'departemen_id' => 'nullable|integer',
            'bidang' => 'nullable|string',
            'pemeriksa' => 'required|string',
            'sifat' => 'required|string',
            'irban' => 'required|string',
            'user' => 'required|string',
            'laporan' => 'nullable|mimes:pdf,doc,docx|max:20480',
        ]);

        if ($request->judul !== $draft->judul) {
            $validatedDataLhp['slug'] = SlugService::createSlug(Draft::class, 'slug', $request->judul);
        }

        if ($request->hasFile('laporan')) {
            if ($draft->laporan) {
                Storage::delete($draft->laporan);
            }
            $validatedDataLhp['laporan'] = $request->file('laporan')->store('public/laporan_files');
        }

        try {
            $draft->update($validatedDataLhp);

            History::create([
                'history' => "LHP telah diperbarui oleh " . $validatedDataLhp['user'],
                'lhp_id' => $draft->id,
            ]);

            return redirect()->route('lhp.index')
                ->with('success', 'LHP dan riwayat berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui LHP dan riwayat: ' . $e->getMessage());

            return redirect()->route('lhp.index')
                ->with('error', 'Gagal memperbarui LHP dan riwayat. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Draft $draft)
    {
        try {
            History::where('lhp_id', $draft->id)->delete();
            $draft->delete();

            return redirect()->route('lhp.index')
                ->with('success', 'Draft dan riwayat terkait berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus draft dan riwayat terkait: ' . $e->getMessage());

            return redirect()->route('lhp.index')
                ->with('error', 'Gagal menghapus draft dan riwayat. Silakan coba lagi.');
        }
    }

    /**
     * Display the PDF file associated with the specified slug.
     */
    public function showPDF($slug)
    {
        $draft = Draft::where('slug', $slug)->firstOrFail();
        $filePath = storage_path('app/public/laporan_files/' . basename($draft->laporan));

        if (file_exists($filePath)) {
            return response()->file($filePath, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . basename($draft->laporan) . '"',
            ]);
        }

        return abort(404, 'File tidak ditemukan.');
    }

    public function temuan($slug)
    {
        $draft = Draft::where('slug', $slug)->firstOrFail();

        // Ambil semua temuans yang terkait dengan draft ini
        $temuans = Temuan::where('lhp_id', $draft->id)
            ->with(['penyebabs.pokokPenyebab', 'rekomendasis.pokokRekomendasi', 'pokokTemuan'])
            ->get();

        // Ambil semua pokok temuan dengan kondisi yang diminta
        $pokokTemuan = PokokTemuan::where('no_subpokok', 0)
            ->whereIn('no_pokok', $temuans->pluck('pokok_temuan_id')) // Cari no_pokok yang ada di temuans
            ->get();

        return view('Temuan.index', [
            "judul" => 'LHP',
            "lhp" => $draft,
            "temuans" => $temuans,
            "pokokTemuan" => $pokokTemuan,
        ]);
    }

    public function exportExcel($slug)
    {
        // Ambil data draft berdasarkan slug
        $draft = Draft::where('slug', $slug)->firstOrFail();

        // Ambil semua temuans yang terkait dengan draft ini
        $temuans = Temuan::where('lhp_id', $draft->id)->get();

        // Ekspor data temuan ke Excel
        return Excel::download(new TemuanExport($temuans, $draft), 'temuan_lhp_' . $draft->slug . '.xlsx');
    }

    public function tambahtemuan($slug)
    {
        $draft = Draft::where('slug', $slug)->firstOrFail();

        return view('Temuan.create', [
            'judul' => 'LHP',
            'lhp' => $draft,
            'pokok_temuan' => PokokTemuan::getDistinctPokokTemuan(),
            'sub_pokok_temuan' => PokokTemuan::getDistinctSubPokokTemuan(),
            'pokok_penyebab' => PokokPenyebab::getDistinctPokokPenyebab(),
            'sub_pokok_penyebab' => PokokPenyebab::getDistinctSubPokokPenyebab(),
            'pokok_rekomendasi' => PokokRekomendasi::getDistinctPokokRekomendasi(),
            'sub_pokok_rekomendasi' => PokokRekomendasi::getDistinctSubPokokRekomendasi(),
        ]);
    }

    public function storetemuan(Request $request, $slug)
    {
        // Find the LHP model using the slug
        $lhp = Draft::where('slug', $slug)->first();

        if (!$lhp) {
            return redirect()->back()->with('error', 'LHP not found.');
        }

        // Validation rules for the incoming data
        try {
            $validated = $request->validate([
                'temuan' => 'required|string',
                'keterangan' => 'required|string',
                'pokok_temuan_id' => 'required|integer|exists:pokok_temuan,id',

                // Penyebab Validation
                'penyebab' => 'required|string', // Ensure penyebab exists
                'id_pokok_penyebab' => 'required|integer|exists:pokok_penyebab,id',

                // Rekomendasi Validation
                'rekomendasi' => 'required|string', // Ensure rekomendasi exists
                'pokok_rekomendasi_id' => 'required|integer|exists:pokok_rekomendasi,id', // Ensure pokok_rekomendasi_id exists

                // Validasi di Controller
                'kerugian' => 'nullable|regex:/^\d{1,3}(\.\d{3})*$/', // Validasi format angka dengan titik sebagai pemisah ribuan
                'kewajiban' => 'nullable|regex:/^\d{1,3}(\.\d{3})*$/', // Validasi format angka dengan titik sebagai pemisah ribuan

            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed in storetemuan:', $e->errors());
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        try {
            // Store Temuan
            $temuan = new Temuan();
            $temuan->temuan = $request->temuan;
            $temuan->keterangan = $request->keterangan;
            $temuan->pokok_temuan_id = $request->pokok_temuan_id;
            $temuan->user = auth()->user()->username; // Use authenticated user's username
            $temuan->lhp_id = $lhp->id;
            $temuan->save();

            // Store Penyebab
            $temuan->penyebabs()->create([
                'penyebab' => $request->penyebab,
                'id_pokok_penyebab' => $request->id_pokok_penyebab, // Assuming this is provided
                'temuan_id' => $temuan->id, // Explicitly assign temuan_id
            ]);

            // Clean kerugian and kewajiban from thousand separators
            $kerugian = str_replace('.', '', $request->kerugian ?? '0');
            $kewajiban = str_replace('.', '', $request->kewajiban ?? '0');

            // Store Rekomendasi
            $temuan->rekomendasis()->create([
                'rekomendasi' => $request->rekomendasi,
                'pokok_rekomendasi_id' => $request->pokok_rekomendasi_id,
                'kerugian' => $kerugian,
                'kewajiban' => $kewajiban,
                'temuan_id' => $temuan->id, // Explicitly assign temuan_id
            ]);

            return redirect()->route('lhp.temuan', $lhp->slug)->with('success', 'Temuan successfully saved!');
        } catch (\Exception $e) {
            Log::error('Failed to store temuan:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Failed to save Temuan. Please try again.')->withInput();
        }
    }

    public function edittemuan($slug, $temuan_id)
    {
        // Ambil Draft berdasarkan slug
        $draft = Draft::where('slug', $slug)->firstOrFail();

        // Ambil Temuan yang ingin diedit berdasarkan temuan_id
        $temuan = Temuan::findOrFail($temuan_id);

        return view('Temuan.edit', [
            'judul' => 'Edit Temuan',
            'lhp' => $draft,
            'temuan' => $temuan,
            'pokok_temuan' => PokokTemuan::getDistinctPokokTemuan(),
            'sub_pokok_temuan' => PokokTemuan::getDistinctSubPokokTemuan(),
            'pokok_penyebab' => PokokPenyebab::getDistinctPokokPenyebab(),
            'sub_pokok_penyebab' => PokokPenyebab::getDistinctSubPokokPenyebab(),
            'pokok_rekomendasi' => PokokRekomendasi::getDistinctPokokRekomendasi(),
            'sub_pokok_rekomendasi' => PokokRekomendasi::getDistinctSubPokokRekomendasi(),
        ]);
    }

    public function updatetemuan(Request $request, Draft $draft, Temuan $temuan)
    {
        try {
            // Validasi data yang diterima
            $validated = $request->validate([
                'temuan' => 'required|string',
                'keterangan' => 'required|string',
                'pokok_temuan_id' => 'required|integer|exists:pokok_temuan,id',

                // Penyebab Validation
                'penyebab' => 'required|string',
                'id_pokok_penyebab' => 'required|integer|exists:pokok_penyebab,id',

                // Rekomendasi Validation
                'rekomendasi' => 'required|string',
                'pokok_rekomendasi_id' => 'required|integer|exists:pokok_rekomendasi,id',

                // Nilai Kerugian dan Kewajiban
                'kerugian' => 'nullable|regex:/^\d{1,3}(\.\d{3})*$/',
                'kewajiban' => 'nullable|regex:/^\d{1,3}(\.\d{3})*$/',
            ]);

            // Pastikan temuan terkait dengan LHP yang diberikan
            if ($temuan->lhp_id !== $draft->id) {
                return redirect()->back()->with('error', 'Temuan does not belong to the specified LHP.');
            }

            // Update data Temuan
            $temuan->update([
                'temuan' => $request->temuan,
                'keterangan' => $request->keterangan,
                'pokok_temuan_id' => $request->pokok_temuan_id,
            ]);

            // Update data Penyebab
            if ($temuan->penyebabs()->exists()) {
                $temuan->penyebabs()->update([
                    'penyebab' => $request->penyebab,
                    'id_pokok_penyebab' => $request->id_pokok_penyebab,
                ]);
            }

            // Bersihkan nilai kerugian dan kewajiban dari format ribuan
            $kerugian = str_replace('.', '', $request->kerugian ?? '0');
            $kewajiban = str_replace('.', '', $request->kewajiban ?? '0');

            // Update data Rekomendasi
            if ($temuan->rekomendasis()->exists()) {
                $temuan->rekomendasis()->update([
                    'rekomendasi' => $request->rekomendasi,
                    'pokok_rekomendasi_id' => $request->pokok_rekomendasi_id,
                    'kerugian' => $kerugian,
                    'kewajiban' => $kewajiban,
                ]);
            }

            return redirect()->route('lhp.temuan', $draft->slug)
                ->with('success', 'Temuan successfully updated.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Failed to update temuan:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Failed to update Temuan. Please try again.')->withInput();
        }
    }

    public function destroytemuan(Draft $draft, Temuan $temuan)
    {
        try {
            // Validasi bahwa temuan terkait dengan draft yang diberikan
            if ($temuan->lhp_id !== $draft->id) {
                return redirect()->back()->with('error', 'Temuan does not belong to the specified LHP.');
            }

            // Hapus data terkait menggunakan relasi
            $temuan->penyebabs()->delete(); // Hapus semua penyebab terkait
            $temuan->rekomendasis()->delete(); // Hapus semua rekomendasi terkait

            // Hapus data temuan
            $temuan->delete();

            return redirect()->route('lhp.temuan', $draft->slug)->with('success', 'Temuan successfully deleted.');
        } catch (\Exception $e) {
            Log::error('Failed to delete temuan:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Failed to delete Temuan. Please try again.');
        }
    }
}