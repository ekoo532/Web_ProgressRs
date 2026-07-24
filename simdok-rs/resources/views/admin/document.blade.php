<x-layout>
<div class="container container-narrow">
    <div class="page-head">
        <div>
            <h1>Progress Dokumen</h1>
            <p class="subtitle">{{ $doc->title }} &middot; diupload oleh {{ $doc->uploader->name }}</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="link-muted">&larr; Kembali</a>
    </div>

    <div class="card">
        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-error">{{ $errors->first() }}</div>
        @endif

        <div class="doc-file" style="margin-bottom:16px;">📄 <a href="{{ $doc->fileUrl() }}" target="_blank">{{ $doc->original_name }}</a></div>

        <div class="doc-progress" style="margin-bottom:20px;"><x-progress-bar :value="$doc->computedProgress()" /></div>

        <p style="font-size:13px; color:var(--slate-500); margin-bottom:20px;">
            Progress bersifat <b>otomatis</b> dan mengikuti tahapan berikut secara berurutan — tidak dapat diinput manual:
        </p>

        <div class="workflow-steps">
            <div class="workflow-step done">
                <span class="workflow-dot">✓</span>
                <div>
                    <div class="workflow-title">Dokumen Masuk</div>
                    <div class="workflow-sub">25% &middot; otomatis saat user upload</div>
                </div>
            </div>

            <div class="workflow-step {{ $doc->admin_approved ? 'done' : (! $doc->is_completed ? 'current' : '') }}">
                <span class="workflow-dot">{{ $doc->admin_approved ? '✓' : '2' }}</span>
                <div style="flex:1;">
                    <div class="workflow-title">Direview / di-ACC Admin</div>
                    <div class="workflow-sub">50%{{ $doc->reviewed_at ? ' · '.$doc->reviewed_at->format('d M Y H:i') : '' }}</div>
                    @if (! $doc->admin_approved)
                        <form method="POST" action="{{ route('admin.document.review', $doc) }}" style="margin-top:10px;">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">Tandai Sudah Direview/di-ACC Admin</button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="workflow-step {{ $doc->director_approved ? 'done' : ($doc->admin_approved && ! $doc->is_completed ? 'current' : '') }}">
                <span class="workflow-dot">{{ $doc->director_approved ? '✓' : '3' }}</span>
                <div style="flex:1;">
                    <div class="workflow-title">Di-ACC / Ditandatangani Direktur</div>
                    <div class="workflow-sub">75%{{ $doc->approved_at ? ' · '.$doc->approved_at->format('d M Y H:i') : '' }}</div>
                    @if ($doc->admin_approved && ! $doc->director_approved)
                        <form method="POST" action="{{ route('admin.document.director', $doc) }}" style="margin-top:10px;">
                            @csrf
                            <label style="display:flex; align-items:flex-start; gap:8px; font-weight:400; font-size:13px; color:var(--slate-500); margin:0 0 10px;">
                                <input type="checkbox" name="director_confirmed" value="1" required style="margin-top:3px;">
                                <span>Saya konfirmasi dokumen fisik/file ini sudah di-ACC atau ditandatangani oleh Direktur.</span>
                            </label>
                            <button type="submit" class="btn btn-primary btn-sm">Tandai Sudah ACC/TTD Direktur</button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="workflow-step {{ $doc->is_completed ? 'done' : ($doc->director_approved ? 'current' : '') }}">
                <span class="workflow-dot">{{ $doc->is_completed ? '✓' : '4' }}</span>
                <div style="flex:1;">
                    <div class="workflow-title">Selesai &amp; Dikirim Kembali ke User</div>
                    <div class="workflow-sub">100%{{ $doc->completed_at ? ' · '.$doc->completed_at->format('d M Y H:i') : '' }}</div>
                    @if ($doc->director_approved && ! $doc->is_completed)
                        <form method="POST" action="{{ route('admin.document.complete', $doc) }}" style="margin-top:10px;">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">Tandai Selesai &amp; Sudah Dikirim ke User</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</x-layout>
