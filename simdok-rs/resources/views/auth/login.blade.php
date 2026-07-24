<x-layout>
<div class="auth-wrap">
    <div class="auth-card">
        <div class="brand brand-lg">
            <span class="brand-icon brand-icon-logo"><img src="{{ asset('images/logo.png') }}" alt="Logo {{ config('app.name') }}"></span>
            <div>
                <div class="brand-title">{{ config('app.name') }}</div>
                <div class="brand-sub">Sistem Progress &amp; ACC Dokumen</div>
            </div>
        </div>

        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login.attempt') }}">
            @csrf
            <label>Username</label>
            <input type="text" name="username" required autofocus value="{{ old('username') }}">

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
        </form>

        <p class="auth-footer">
            Belum punya akun user? <a href="{{ route('register') }}">Buat akun baru</a>
        </p>
    </div>
</div>
</x-layout>
