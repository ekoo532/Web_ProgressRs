<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'file_name',
        'original_name',
        'progress',
        'admin_approved',
        'reviewed_by',
        'reviewed_at',
        'director_approved',
        'is_completed',
        'uploader_id',
        'approved_by',
        'approved_at',
        'completed_by',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'admin_approved' => 'boolean',
            'director_approved' => 'boolean',
            'is_completed' => 'boolean',
            'reviewed_at' => 'datetime',
            'approved_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public const CATEGORIES = ['Administrasi', 'Medis', 'Keuangan', 'SDM', 'Legal', 'Lainnya'];

    // ----- Relasi -----

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploader_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function directorConfirmer()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function completer()
    {
        return $this->belongsTo(User::class, 'completed_by');
    }

    // =========================================================
    // Progress OTOMATIS berdasarkan tahapan alur kerja dokumen.
    // Setara dengan compute_progress() di includes/helpers.php.
    //   1. Dokumen masuk (baru diupload)      -> 25%
    //   2. Direview / di-ACC Admin             -> 50%
    //   3. Di-ACC / ditandatangani Direktur     -> 75%
    //   4. Selesai, dikirim kembali ke user     -> 100%
    // =========================================================
    public function computedProgress(): int
    {
        if ($this->is_completed) {
            return 100;
        }
        if ($this->director_approved) {
            return 75;
        }
        if ($this->admin_approved) {
            return 50;
        }

        return 25;
    }

    /**
     * Setara dengan status_badge() di includes/helpers.php.
     */
    public function statusLabel(): string
    {
        if ($this->is_completed) {
            return 'Selesai · Dikirim ke User';
        }
        if ($this->director_approved) {
            return 'ACC Direktur · Menunggu Dikirim';
        }
        if ($this->admin_approved) {
            return 'Direview Admin · Menunggu ACC Direktur';
        }

        return 'Dokumen Masuk';
    }

    public function statusBadgeClass(): string
    {
        if ($this->is_completed) {
            return 'badge-teal';
        }
        if ($this->admin_approved || $this->director_approved) {
            return 'badge-amber';
        }

        return 'badge-slate';
    }

    public function fileUrl(): string
    {
        return asset('storage/documents/'.$this->file_name);
    }
}
