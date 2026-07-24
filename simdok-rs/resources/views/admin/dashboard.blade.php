<x-layout>
<div class="container">
    <div class="page-head">
        <div>
            <h1>Panel Admin — Progress &amp; Persetujuan Dokumen</h1>
            <p class="subtitle">Progress dokumen berjalan otomatis 25% &rarr; 50% &rarr; 75% &rarr; 100% mengikuti tahapan di bawah.</p>
        </div>
        <a href="{{ route('admin.users') }}" class="link-muted">Kelola Pengguna</a>
    </div>

    <div class="stat-grid">
        <div class="stat-card"><div class="stat-label">Total Dokumen</div><div class="stat-value">{{ $countAll }}</div></div>
        <div class="stat-card"><div class="stat-label">Belum Direview (25%)</div><div class="stat-value stat-rose">{{ $countMenungguReview }}</div></div>
        <div class="stat-card"><div class="stat-label">Menunggu ACC Direktur (50%)</div><div class="stat-value stat-amber">{{ $countMenungguDirektur }}</div></div>
        <div class="stat-card"><div class="stat-label">Siap Dikirim ke User (75%)</div><div class="stat-value stat-amber">{{ $countMenungguKirim }}</div></div>
    </div>
    <div class="stat-grid" style="margin-top:-8px;">
        <div class="stat-card"><div class="stat-label">Selesai &amp; Dikirim (100%)</div><div class="stat-value stat-teal">{{ $countSelesai }}</div></div>
    </div>

    <div class="tab-row">
        @foreach ($tabs as $key => $label)
            <a href="?status={{ $key }}" class="tab {{ $filter === $key ? 'tab-active' : '' }}">{{ $label }}</a>
        @endforeach
    </div>

    @if ($docs->isEmpty())
        <div class="empty-state"><p>Tidak ada dokumen pada kategori ini.</p></div>
    @else
        <div class="table-card">
            <div class="table-row table-head">
                <div class="col-doc">Dokumen</div>
                <div class="col-user">Diupload oleh</div>
                <div class="col-progress">Progress</div>
                <div class="col-status">Status</div>
                <div class="col-action">Aksi</div>
            </div>
            @foreach ($docs as $doc)
            <div class="table-row">
                <div class="col-doc">
                    <div class="doc-name">{{ $doc->title }}</div>
                    <div class="doc-cat">{{ $doc->category }} · <a href="{{ $doc->fileUrl() }}" target="_blank">Lihat File</a></div>
                </div>
                <div class="col-user">{{ $doc->uploader->name }}</div>
                <div class="col-progress"><x-progress-bar :value="$doc->computedProgress()" /></div>
                <div class="col-status"><x-status-badge :doc="$doc" /></div>
                <div class="col-action">
                    <a href="{{ route('admin.document.show', $doc) }}" class="btn btn-outline btn-sm">
                        {{ $doc->is_completed ? 'Lihat Detail' : 'Kelola Progress' }}
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
</x-layout>
