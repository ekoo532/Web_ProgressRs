<x-layout>
<div class="container">
    <div class="page-head">
        <div>
            <h1>Dokumen Saya</h1>
            <p class="subtitle">Upload dokumen dan pantau progress-nya. Progress berjalan <b>otomatis</b> 25% &rarr; 50% &rarr; 75% &rarr; 100% mengikuti tahapan review Admin &amp; Direktur.</p>
        </div>
        <a href="{{ route('user.upload') }}" class="btn btn-primary">+ Upload Dokumen</a>
    </div>

    <div class="stat-grid">
        <div class="stat-card"><div class="stat-label">Total Dokumen</div><div class="stat-value">{{ $total }}</div></div>
        <div class="stat-card"><div class="stat-label">Dalam Proses</div><div class="stat-value stat-amber">{{ $dalamProses }}</div></div>
        <div class="stat-card"><div class="stat-label">Menunggu ACC Direktur</div><div class="stat-value stat-amber">{{ $menungguDirektur }}</div></div>
        <div class="stat-card"><div class="stat-label">Selesai &amp; Dikirim (100%)</div><div class="stat-value stat-teal">{{ $selesai }}</div></div>
    </div>

    @if ($docs->isEmpty())
        <div class="empty-state">
            <p>Belum ada dokumen. Mulai dengan upload dokumen pertama Anda.</p>
        </div>
    @else
        <div class="doc-list">
        @foreach ($docs as $doc)
            <div class="doc-card">
                <div class="doc-main">
                    <div class="doc-title-row">
                        <h3>{{ $doc->title }}</h3>
                        <span class="badge badge-slate">{{ $doc->category }}</span>
                        <x-status-badge :doc="$doc" />
                    </div>
                    <div class="doc-file">
                        📄 <a href="{{ $doc->fileUrl() }}" target="_blank" rel="noopener">{{ $doc->original_name }}</a>
                    </div>
                    <div class="doc-progress"><x-progress-bar :value="$doc->computedProgress()" /></div>
                    <div class="doc-meta">Diperbarui {{ $doc->updated_at?->format('d M Y H:i') ?? '-' }}</div>
                </div>
                <div class="doc-actions">
                    <div class="stepper">
                        <div class="step done">Masuk</div>
                        <div class="step-line"></div>
                        <div class="step {{ $doc->admin_approved ? 'done' : '' }}">Review Admin</div>
                        <div class="step-line"></div>
                        <div class="step {{ $doc->director_approved ? 'done' : '' }}">ACC Direktur</div>
                        <div class="step-line"></div>
                        <div class="step {{ $doc->is_completed ? 'done' : '' }}">Dikirim ke User</div>
                    </div>
                    <a href="{{ route('user.document.edit', $doc) }}" class="link-muted" style="font-size:12px;">Ganti File Dokumen</a>
                </div>
            </div>
        @endforeach
        </div>
    @endif
</div>
</x-layout>
