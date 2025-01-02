<?php

namespace App\Http\Controllers;

use App\Models\Draft;
use App\Models\Induk;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        // Ambil user yang sedang login
        $user = auth()->user();

        // Start a query to get all drafts
        $query = Draft::query();

        // Filter berdasarkan role
        $roleStatusMapping = [
            'DALNIS' => ['Review DALNIS', 'Revisi DALNIS', 'Revisi IRBAN', 'Draft LHP'],
            'IRBAN' => ['Review IRBAN', 'Revisi Sekretaris'],
            'SEKRETARIS' => ['Review Sekretaris', 'Review Inspektur'],
            'INSPEKTUR' => ['LHP Terbit', 'Revisi Inspektur'],
            'SuperAdmin' => [
                'Review DALNIS',
                'Review IRBAN',
                'Review Sekretaris',
                'Review Inspektur',
                'LHP Terbit',
                'Revisi DALNIS',
                'Revisi IRBAN',
                'Revisi Sekretaris',
                'Revisi Inspektur',
            ],
        ];

        // Ambil status yang sesuai dengan role user
        $statuses = $roleStatusMapping[$user->jobdesks->role] ?? [];
        // Filter berdasarkan status yang diizinkan untuk role tersebut
        if (!empty($statuses)) {
            $query->whereIn('status', $statuses);
        }
        // Filter berdasarkan status yang diizinkan untuk role tersebut
        if (!empty($statuses)) {
            $query->whereIn('status', $statuses);
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

        return view('Review.index', [
            "judul" => "Review Draft LHP",
            "review" => $drafts,
            'induks' => Induk::all(),
        ]);
    }


    public function show($slug)
    {
        // Retrieve the draft by its slug
        $draft = Draft::where('slug', $slug)->firstOrFail();

        // Eager load the related histories
        $draft->load('histories');

        return view('Review.show', [
            "judul" => "Review Draft LHP",
            "review" => $draft,
        ]);
    }

    public function dalnis(Request $request, Draft $review)
    {
        $action = $request->input('action');

        // Validasi input berdasarkan aksi
        $validatedData = $request->validate([
            'user' => 'required|string',
            'revisi_dalnis' => $action === 'revisi' ? 'required|string' : 'nullable|string',
        ]);

        try {
            if ($action === 'revisi') {
                // Status untuk revisi DALNIS
                $status = 'Revisi DALNIS';
                $review->update(['status' => $status]);

                History::create([
                    'history' => "Revision added by {$validatedData['user']} with status {$status}",
                    'lhp_id' => $review->id,
                    'revisi_dalnis' => $validatedData['revisi_dalnis'],
                ]);

                $message = 'DALNIS: Status, revision, and history updated successfully.';
            } elseif ($action === 'lanjutkan') {
                // Status untuk melanjutkan ke IRBAN
                $status = 'Review IRBAN';
                $review->update(['status' => $status]);

                History::create([
                    'history' => "Status updated to {$status} by {$validatedData['user']}",
                    'lhp_id' => $review->id,
                ]);

                $message = 'DALNIS: Status and history updated successfully.';
            } else {
                throw new \Exception('Invalid action.');
            }

            return redirect()->route('review-draft-lhp.index')->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Failed to update status and history: ' . $e->getMessage());
            return redirect()->route('review-draft-lhp.index')->with('error', 'Failed to update status and history. Please try again.');
        }
    }

    public function irban(Request $request, Draft $review)
    {
        // Tangkap aksi dari tombol
        $action = $request->input('action');

        // Validasi input
        $validatedData = $request->validate([
            'user' => 'required|string',
            'revisi_irban' => $action === 'revisi' ? 'required|string' : 'nullable|string',
        ]);

        try {
            if ($action === 'revisi') {
                $status = 'Revisi IRBAN';
                $review->update(['status' => $status]);

                History::create([
                    'history' => "Revision added by {$validatedData['user']} with status {$status}",
                    'lhp_id' => $review->id,
                    'revisi_irban' => $validatedData['revisi_irban'],
                ]);

                $message = 'IRBAN: Status, revision, and history updated successfully.';
            } elseif ($action === 'lanjutkan') {
                $status = 'Review Sekretaris';
                $review->update(['status' => $status]);

                History::create([
                    'history' => "Status updated to {$status} by {$validatedData['user']}",
                    'lhp_id' => $review->id,
                ]);

                $message = 'IRBAN: Status and history updated successfully.';
            } else {
                throw new \Exception('Invalid action.');
            }

            return redirect()->route('review-draft-lhp.index')->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Failed to update status and history: ' . $e->getMessage());
            return redirect()->route('review-draft-lhp.index')->with('error', 'Failed to update status and history. Please try again.');
        }
    }

    public function sekretaris(Request $request, Draft $review)
    {
        $action = $request->input('action');

        // Validasi input
        $validatedData = $request->validate([
            'user' => 'required|string',
            'revisi_sekretaris' => $action === 'revisi' ? 'required|string' : 'nullable|string',
        ]);

        try {
            if ($action === 'revisi') {
                $status = 'Revisi Sekretaris';
                $review->update(['status' => $status]);

                History::create([
                    'history' => "Revision added by {$validatedData['user']} with status {$status}",
                    'lhp_id' => $review->id,
                    'revisi_sekretaris' => $validatedData['revisi_sekretaris'],
                ]);

                $message = 'Sekretaris: Status, revision, and history updated successfully.';
            } elseif ($action === 'lanjutkan') {
                $status = 'Review Inspektur';
                $review->update(['status' => $status]);

                History::create([
                    'history' => "Status updated to {$status} by {$validatedData['user']}",
                    'lhp_id' => $review->id,
                ]);

                $message = 'Sekretaris: Status and history updated successfully.';
            } else {
                throw new \Exception('Invalid action.');
            }

            return redirect()->route('review-draft-lhp.index')->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Failed to update status and history: ' . $e->getMessage());
            return redirect()->route('review-draft-lhp.index')->with('error', 'Failed to update status and history. Please try again.');
        }
    }

    public function inspektur(Request $request, Draft $review)
    {
        $action = $request->input('action');

        // Validasi input
        $validatedData = $request->validate([
            'user' => 'required|string',
            'revisi_inspektur' => $action === 'revisi' ? 'required|string' : 'nullable|string',
        ]);

        try {
            if ($action === 'revisi') {
                $status = 'Revisi Inspektur';
                $review->update(['status' => $status]);

                History::create([
                    'history' => "Revision added by {$validatedData['user']} with status {$status}",
                    'lhp_id' => $review->id,
                    'revisi_inspektur' => $validatedData['revisi_inspektur'],
                ]);

                $message = 'Inspektur: Status, revision, and history updated successfully.';
            } elseif ($action === 'lanjutkan') {
                $status = 'LHP Terbit';
                $review->update(['status' => $status]);

                History::create([
                    'history' => "Status updated to {$status} by {$validatedData['user']}",
                    'lhp_id' => $review->id,
                ]);

                $message = 'Inspektur: Status and history updated successfully.';
            } else {
                throw new \Exception('Invalid action.');
            }

            return redirect()->route('review-draft-lhp.index')->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Failed to update status and history: ' . $e->getMessage());
            return redirect()->route('review-draft-lhp.index')->with('error', 'Failed to update status and history. Please try again.');
        }
    }


}