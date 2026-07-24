<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DocumentController extends Controller
{
    /**
     * Setara dengan admin/update_progress.php (tampilan detail + tombol aksi).
     */
    public function show(Document $document): View
    {
        $document->load('uploader');

        return view('admin.document', ['doc' => $document]);
    }

    /**
     * Tahap 2: Direview / di-ACC Admin -> progress 50%.
     */
    public function review(Document $document): RedirectResponse
    {
        if ($document->admin_approved) {
            return back()->with('error', 'Aksi tidak valid untuk status dokumen saat ini.');
        }

        $document->update([
            'admin_approved' => true,
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
            'progress' => 50,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Dokumen "'.$document->title.'" ditandai sudah direview/di-ACC Admin. Progress otomatis menjadi 50%.');
    }

    /**
     * Tahap 3: Di-ACC / Ditandatangani Direktur -> progress 75%.
     */
    public function director(Request $request, Document $document): RedirectResponse
    {
        if (! $document->admin_approved || $document->director_approved) {
            return back()->with('error', 'Aksi tidak valid untuk status dokumen saat ini.');
        }

        $request->validate([
            'director_confirmed' => ['accepted'],
        ], [
            'director_confirmed.accepted' => 'Silakan centang konfirmasi bahwa dokumen sudah di-ACC/ditandatangani Direktur.',
        ]);

        $document->update([
            'director_approved' => true,
            'approved_by' => Auth::id(),
            'approved_at' => now(),
            'progress' => 75,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Dokumen "'.$document->title.'" ditandai sudah di-ACC/TTD Direktur. Progress otomatis menjadi 75%.');
    }

    /**
     * Tahap 4: Selesai & Dikirim Kembali ke User -> progress 100%.
     */
    public function complete(Document $document): RedirectResponse
    {
        if (! $document->director_approved || $document->is_completed) {
            return back()->with('error', 'Aksi tidak valid untuk status dokumen saat ini.');
        }

        $document->update([
            'is_completed' => true,
            'completed_by' => Auth::id(),
            'completed_at' => now(),
            'progress' => 100,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Dokumen "'.$document->title.'" ditandai selesai & sudah dikirim kembali ke user. Progress otomatis menjadi 100%.');
    }
}
