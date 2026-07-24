<x-layout>
<div class="container container-narrow">
    <div class="page-head">
        <div>
            <h1>Upload Dokumen Baru</h1>
            <p class="subtitle">Lengkapi detail dokumen dan unggah file aslinya. Progress akan diperbarui oleh Admin.</p>
        </div>
        <a href="{{ route('user.dashboard') }}" class="link-muted">&larr; Kembali</a>
    </div>

    <div class="card">
        @if ($errors->any())
            <div class="alert alert-error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('user.upload.store') }}" enctype="multipart/form-data">
            @csrf

            <label>Judul Dokumen</label>
            <input type="text" name="title" required value="{{ old('title') }}" placeholder="Contoh: Izin Operasional RS 2026">

            <label>Kategori</label>
            <select name="category">
                @foreach ($categories as $c)
                    <option value="{{ $c }}" @selected(old('category') === $c)>{{ $c }}</option>
                @endforeach
            </select>

            <label>File Dokumen (PDF/JPG/PNG/DOC/DOCX, maks 10MB)</label>
            <input type="file" name="document" required accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">

            <button type="submit" class="btn btn-primary btn-block">Upload Dokumen</button>
        </form>
    </div>
</div>
</x-layout>
