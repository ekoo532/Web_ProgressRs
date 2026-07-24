<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $filter = $request->query('status', 'semua');

        $query = Document::with('uploader');

        match ($filter) {
            'menunggu-review' => $query->where('admin_approved', false),
            'menunggu-direktur' => $query->where('admin_approved', true)->where('director_approved', false),
            'menunggu-kirim' => $query->where('director_approved', true)->where('is_completed', false),
            'selesai' => $query->where('is_completed', true),
            default => null,
        };

        $docs = $query->orderByDesc('updated_at')->get();

        $countAll = Document::count();
        $countMenungguReview = Document::where('admin_approved', false)->count();
        $countMenungguDirektur = Document::where('admin_approved', true)->where('director_approved', false)->count();
        $countMenungguKirim = Document::where('director_approved', true)->where('is_completed', false)->count();
        $countSelesai = Document::where('is_completed', true)->count();

        $tabs = [
            'semua' => 'Semua',
            'menunggu-review' => 'Dokumen Masuk (Belum Direview)',
            'menunggu-direktur' => 'Menunggu ACC Direktur',
            'menunggu-kirim' => 'Siap Dikirim ke User',
            'selesai' => 'Selesai',
        ];

        return view('admin.dashboard', compact(
            'docs', 'filter', 'tabs',
            'countAll', 'countMenungguReview', 'countMenungguDirektur', 'countMenungguKirim', 'countSelesai'
        ));
    }
}
