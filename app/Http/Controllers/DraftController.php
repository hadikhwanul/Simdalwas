<?php

namespace App\Http\Controllers;

use App\Models\Draft;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Auditor;
use App\Models\Departemen;
use App\Models\History;
use App\Models\Induk;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DraftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drafts = Draft::latest()->paginate(10)->withQueryString();
        return view('DraftLHP.index', [
            "judul" => "Draft LHP",
            "drafts" => $drafts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('DraftLHP.create', [
            "judul" => "Draft LHP",
            "departemen" => Departemen::all(),
            "induk" => Induk::all(),
            "auditor" => Auditor::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
            'laporan' => 'required|mimes:pdf,doc,docx|max:20480', // 20MB
        ]);

        $validatedDataLhp['status'] = "Draft LHP";
        if ($request->hasFile('laporan')) {
            $validatedDataLhp['laporan'] = $request->file('laporan')->store('public/laporan_files');
        }

        try {
            $draft = Draft::create($validatedDataLhp);
            if (!$draft) {
                return redirect()->route('draft-lhp.index')->with('error', 'Failed to create draft.');
            }

            $validatedDataHistory = [
                'history' => "Draft LHP " . $validatedDataLhp['judul'] . " telah ditambahkan oleh " . $validatedDataLhp['user'],
                'lhp_id' => $draft->id,
            ];

            History::create($validatedDataHistory);

            return redirect()->route('draft-lhp.index')
                ->with('success', 'Draft and history successfully created.');
        } catch (\Exception $e) {
            return redirect()->route('draft-lhp.index')
                ->with('error', 'Failed to create draft and history. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Draft $draft)
    {
        // Eager load the related histories to optimize queries
        $draft->load('histories');

        return view('DraftLHP.show', [
            'judul' => 'Detail Draft LHP',
            'draft' => $draft,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Draft $draft)
    {
        return view('DraftLHP.edit', [
            "judul" => "Edit Draft LHP",
            "draft" => $draft,
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
        // Validasi data
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
            'laporan' => 'nullable|mimes:pdf,doc,docx|max:20480', // 20MB
        ]);

        // Generate slug baru jika judul berubah
        if ($request->judul !== $draft->judul) {
            $validatedDataLhp['slug'] = SlugService::createSlug(Draft::class, 'slug', $request->judul);
        }

        // Jika ada file laporan baru yang diunggah, hapus file lama
        if ($request->hasFile('laporan')) {
            if ($draft->laporan) {
                Storage::delete($draft->laporan); // Hapus file lama
            }
            $validatedDataLhp['laporan'] = $request->file('laporan')->store('public/laporan_files');
        }

        try {
            // Update data draft
            $draft->update($validatedDataLhp);

            // Buat entri riwayat
            History::create([
                'history' => "Draft LHP " . $validatedDataLhp['judul'] . " telah diperbarui oleh " . $validatedDataLhp['user'],
                'lhp_id' => $draft->id,
            ]);

            return redirect()->route('draft-lhp.index')
                ->with('success', 'Draft dan riwayat berhasil diperbarui.');
        } catch (\Exception $e) {
            // Log error untuk debug
            Log::error('Gagal memperbarui draft dan riwayat: ' . $e->getMessage());

            return redirect()->route('draft-lhp.index')
                ->with('error', 'Gagal memperbarui draft dan riwayat. Silakan coba lagi.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Draft $draft)
    {
        try {
            // Capture the ID before deletion to delete related histories
            $draftId = $draft->id;

            // Delete all history records associated with the draft
            History::where('lhp_id', $draftId)->delete();

            // Delete the Draft record
            $draft->delete();

            return redirect()->route('draft-lhp.index')
                ->with('success', 'Draft and related history successfully deleted.');
        } catch (\Exception $e) {
            // Log the error for better debugging
            Log::error('Failed to delete draft and related history: ' . $e->getMessage());

            return redirect()->route('draft-lhp.index')
                ->with('error', 'Failed to delete draft and history. Please try again.');
        }
    }


    public function showPDF($slug)
    {
        // Find the draft by slug
        $draft = Draft::where('slug', $slug)->firstOrFail();

        // Construct the file path
        $filePath = storage_path('app/public/laporan_files/' . basename($draft->laporan));

        // Check if the file exists
        if (file_exists($filePath)) {
            return response()->file($filePath, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . basename($draft->laporan) . '"', // This makes sure it opens in the browser
            ]);
        }

        return abort(404, 'File not found.');
    }

}