<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class DocumentController extends Controller
{
    /**
     * Setara dengan user/dashboard.php.
     */
    public function index(): View
    {
        $user = Auth::user();

        $docs = Document::with(['directorConfirmer', 'completer'])
            ->where('uploader_id', $user->id)
            ->orderByDesc('updated_at')
            ->get();

        $total = $docs->count();
        $selesai = $docs->where('is_completed', true)->count();
        $menungguDirektur = $docs->where('admin_approved', true)->where('director_approved', false)->count();
        $dalamProses = $total - $selesai;

        return view('user.dashboard', compact('docs', 'total', 'selesai', 'menungguDirektur', 'dalamProses'));
    }

    /**
     * Setara dengan user/upload.php (form GET).
     */
    public function create(): View
    {
        return view('user.upload', ['categories' => Document::CATEGORIES]);
    }

    /**
     * Setara dengan user/upload.php (proses POST).
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', Rule::in(Document::CATEGORIES)],
            'document' => ['required', 'file', 'max:10240', 'mimes:pdf,jpg,jpeg,png,doc,docx'],
        ], [
            'title.required' => 'Judul dokumen wajib diisi.',
            'document.required' => 'File dokumen wajib diupload.',
            'document.max' => 'Ukuran file melebihi batas maksimum (10 MB).',
            'document.mimes' => 'Jenis file tidak diizinkan. Gunakan PDF, JPG, PNG, DOC, atau DOCX.',
        ]);

        $file = $request->file('document');
        $ext = strtolower($file->getClientOriginalExtension());
        $storedName = 'doc_'.Str::random(20).'_'.time().'.'.$ext;

        $file->storeAs('documents', $storedName, 'public');

        // Progress OTOMATIS: dokumen yang baru masuk selalu mulai di 25%.
        Document::create([
            'title' => $data['title'],
            'category' => $data['category'],
            'file_name' => $storedName,
            'original_name' => $file->getClientOriginalName(),
            'progress' => 25,
            'admin_approved' => false,
            'director_approved' => false,
            'is_completed' => false,
            'uploader_id' => Auth::id(),
        ]);

        return redirect()->route('user.dashboard')
            ->with('success', 'Dokumen berhasil diupload. Progress otomatis 25% (Dokumen Masuk) dan akan berlanjut otomatis sesuai proses review Admin/Direktur.');
    }

    /**
     * Setara dengan user/update_progress.php (form ganti file, GET).
     */
    public function edit(Document $document): View|RedirectResponse
    {
        if ($document->uploader_id !== Auth::id()) {
            return redirect()->route('user.dashboard')->with('error', 'Dokumen tidak ditemukan.');
        }

        return view('user.update-file', ['doc' => $document]);
    }

    /**
     * Setara dengan user/update_progress.php (proses ganti file, POST).
     * Catatan: hanya mengganti file fisik, TIDAK mengubah progress —
     * progress tetap berjalan otomatis berdasarkan status admin/direktur.
     */
    public function update(Request $request, Document $document): RedirectResponse
    {
        if ($document->uploader_id !== Auth::id()) {
            return redirect()->route('user.dashboard')->with('error', 'Dokumen tidak ditemukan.');
        }

        $request->validate([
            'document' => ['required', 'file', 'max:10240', 'mimes:pdf,jpg,jpeg,png,doc,docx'],
        ], [
            'document.required' => 'Pilih file baru untuk mengganti dokumen.',
            'document.max' => 'Ukuran file melebihi batas maksimum (10 MB).',
            'document.mimes' => 'Jenis file tidak diizinkan. Gunakan PDF, JPG, PNG, DOC, atau DOCX.',
        ]);

        $file = $request->file('document');
        $ext = strtolower($file->getClientOriginalExtension());
        $newStoredName = 'doc_'.Str::random(20).'_'.time().'.'.$ext;

        $file->storeAs('documents', $newStoredName, 'public');
        Storage::disk('public')->delete('documents/'.$document->file_name);

        $document->update([
            'file_name' => $newStoredName,
            'original_name' => $file->getClientOriginalName(),
        ]);

        return redirect()->route('user.dashboard')
            ->with('success', 'File dokumen berhasil diperbarui. Progress tetap berjalan otomatis, tidak berubah karena penggantian file.');
    }
}
