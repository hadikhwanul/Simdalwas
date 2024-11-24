<?php

namespace App\Http\Controllers;

use App\Models\Draft;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    public function index()
    {
        $review = Draft::latest()->paginate(10)->withQueryString();
        return view('Review.index', [
            "judul" => "Review Draft LHP",
            "review" => $review,
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