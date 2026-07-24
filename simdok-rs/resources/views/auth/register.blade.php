<x-layout>
<div class="auth-wrap">
    <div class="auth-card">
        <div class="brand brand-lg">
            <span class="brand-icon brand-icon-logo"><img src="{{ asset('images/logo.png') }}" alt="Logo {{ config('app.name') }}"></span>
            <div>
                <div class="brand-title">Buat Akun Baru</div>
                <div class="brand-sub">Khusus untuk pengguna (User)</div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-error">{{ $errors->first() }}</div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            <a href="{{ route('login') }}" class="btn btn-primary btn-block">Ke Halaman Login</a>
        @else
        <form method="POST" action="{{ route('register.attempt') }}">
            @csrf
            <label>Nama Lengkap</label>
            <input type="text" name="name" required autofocus value="{{ old('name') }}">

            <label>Username</label>
            <input type="text" name="username" required value="{{ old('username') }}">

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Konfirmasi Password</label>
            <input type="password" name="password2" required>

            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
        </form>
        <p class="auth-footer">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
        @endif
    </div>
</div>
</x-layout>
