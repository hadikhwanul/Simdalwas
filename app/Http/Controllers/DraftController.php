<?php

namespace App\Http\Controllers;

use App\Models\Draft;
use App\Models\Induk;
use App\Models\Auditor;
use App\Models\History;
use App\Models\Departemen;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DraftController extends Controller
{
    /**
     * Display a listing of the drafts.
     */
    public function index(Request $request)
    {
        // Ambil user yang sedang login
        $user = auth()->user();

        // Start a query to get all drafts
        $query = Draft::query();


        // Filter tambahan berdasarkan kelompok kecuali SuperAdmin
        if ($user->jobdesks->role !== 'SuperAdmin' && !empty($user->kelompok)) {
            $query->where('irban', $user->kelompok);
        }

        // Apply filters from the request
        if ($request->filled('bidang')) {
            $query->where('bidang', $request->bidang);
        }

        if ($request->filled('sifat')) {
            $query->where('sifat', $request->sifat);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('tanggal_lhp')) {
            $query->whereDate('tanggal_lhp', $request->tanggal_lhp);
        }

        if ($request->has('induk_id') && $request->induk_id != '') {
            $query->where('induk_id', $request->induk_id);
        }

        // Get the filtered drafts
        $drafts = $query->latest()->get();

        return view('DraftLHP.index', [
            "judul" => "Draft LHP",
            "drafts" => $drafts,
            'induks' => Induk::all(),
        ]);
    }




    /**
     * Show the form for creating a new draft.
     */
    public function create()
    {
        return view('DraftLHP.create', [
            'judul' => 'Draft LHP',
            'departemen' => Departemen::all(),
            'induk' => Induk::all(),
            'auditor' => Auditor::all(),
        ]);
    }

    /**
     * Store a newly created draft in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
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
            'laporan' => 'required|mimes:pdf,doc,docx|max:20480',
        ]);

        $validatedData['status'] = "Draft LHP";
        if ($request->hasFile('laporan')) {
            $validatedData['laporan'] = $request->file('laporan')->store('public/laporan_files');
        }

        try {
            $draft = Draft::create($validatedData);
            History::create([
                'history' => "Draft LHP telah ditambahkan oleh {$validatedData['user']}",
                'lhp_id' => $draft->id,
            ]);

            return redirect()->route('draft-lhp.index')->with('success', 'Draft and history successfully created.');
        } catch (\Exception $e) {
            Log::error('Failed to create draft and history: ' . $e->getMessage());
            return redirect()->route('draft-lhp.index')->with('error', 'Failed to create draft and history. Please try again.');
        }
    }

    /**
     * Display the specified draft.
     */
    public function show(Draft $draft)
    {
        $draft->load('histories');
        return view('DraftLHP.show', [
            'judul' => 'Draft LHP',
            'draft' => $draft,
        ]);
    }

    /**
     * Show the form for editing the specified draft.
     */
    public function edit(Draft $draft)
    {
        return view('DraftLHP.edit', [
            'judul' => 'Draft LHP',
            'draft' => $draft,
            'departemen' => Departemen::all(),
            'induk' => Induk::all(),
            'auditor' => Auditor::all(),
        ]);
    }

    /**
     * Update the specified draft in storage.
     */
    public function update(Request $request, Draft $draft)
    {
        $validatedData = $request->validate([
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
            $validatedData['slug'] = SlugService::createSlug(Draft::class, 'slug', $request->judul);
        }

        if ($request->hasFile('laporan')) {
            if ($draft->laporan) {
                Storage::delete($draft->laporan);
            }
            $validatedData['laporan'] = $request->file('laporan')->store('public/laporan_files');
        }

        try {
            $draft->update($validatedData);
            History::create([
                'history' => "Draft LHP telah diperbarui oleh {$validatedData['user']}",
                'lhp_id' => $draft->id,
            ]);

            return redirect()->route('draft-lhp.index')->with('success', 'Draft and history successfully updated.');
        } catch (\Exception $e) {
            Log::error('Failed to update draft and history: ' . $e->getMessage());
            return redirect()->route('draft-lhp.index')->with('error', 'Failed to update draft and history. Please try again.');
        }
    }

    /**
     * Remove the specified draft from storage.
     */
    public function destroy(Draft $draft)
    {
        try {
            History::where('lhp_id', $draft->id)->delete();
            $draft->delete();

            return redirect()->route('draft-lhp.index')->with('success', 'Draft and related history successfully deleted.');
        } catch (\Exception $e) {
            Log::error('Failed to delete draft and related history: ' . $e->getMessage());
            return redirect()->route('draft-lhp.index')->with('error', 'Failed to delete draft and history. Please try again.');
        }
    }

}