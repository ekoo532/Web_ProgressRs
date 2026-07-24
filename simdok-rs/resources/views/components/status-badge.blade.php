@php
    if ($doc->is_completed) {
        $class = 'badge-teal';
        $label = 'Selesai · Dikirim ke User';
    } elseif ($doc->director_approved) {
        $class = 'badge-amber';
        $label = 'ACC Direktur · Menunggu Dikirim';
    } elseif ($doc->admin_approved) {
        $class = 'badge-amber';
        $label = 'Direview Admin · Menunggu ACC Direktur';
    } else {
        $class = 'badge-slate';
        $label = 'Dokumen Masuk';
    }
@endphp
<span class="badge {{ $class }}">{{ $label }}</span>
