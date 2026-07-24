<x-layout>
<div class="container container-narrow">
    <div class="page-head">
        <div>
            <h1>Ganti File Dokumen</h1>
            <p class="subtitle">{{ $doc->title }}</p>
        </div>
        <a href="{{ route('user.dashboard') }}" class="link-muted">&larr; Kembali</a>
    </div>

    <div class="card">
        @if ($errors->any())
            <div class="alert alert-error">{{ $errors->first() }}</div>
        @endif
        <div class="alert alert-info">Progress dokumen berjalan otomatis mengikuti tahapan review Admin &amp; Direktur, dan tidak dapat diubah di halaman ini.</div>

        <div class="doc-progress" style="margin-bottom:16px;"><x-progress-bar :value="$doc->computedProgress()" /></div>

        <label>File Saat Ini</label>
        <div class="doc-file">📄 <a href="{{ $doc->fileUrl() }}" target="_blank">{{ $doc->original_name }}</a></div>

        <form method="POST" action="{{ route('user.document.update', $doc) }}" enctype="multipart/form-data">
            @csrf

            <label>Ganti File</label>
            <input type="file" name="document" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">

            <button type="submit" class="btn btn-primary btn-block">Simpan File Baru</button>
        </form>
    </div>
</div>
</x-layout>
