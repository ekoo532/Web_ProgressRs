<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ config('app.name') }}</title>
<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<header class="topbar">
    <div class="topbar-inner">
        <a href="{{ route('home') }}" class="brand">
            <span class="brand-icon brand-icon-logo"><img src="{{ asset('images/logo.png') }}" alt="Logo {{ config('app.name') }}"></span>
            <span>{{ config('app.name') }}</span>
        </a>
        @auth
        <div class="topbar-user">
            <span class="user-name">{{ auth()->user()->name }}</span>
            <span class="badge {{ auth()->user()->role === 'admin' ? 'badge-teal' : 'badge-slate' }}">
                {{ auth()->user()->role === 'admin' ? 'Admin' : 'User' }}
            </span>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="link-muted" style="background:none;border:none;cursor:pointer;padding:0;font:inherit;">Keluar</button>
            </form>
        </div>
        @endauth
    </div>
</header>
<main class="page">
@if (session('success'))
    <div class="flash flash-success">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="flash flash-error">{{ session('error') }}</div>
@endif

{{ $slot }}
</main>
</body>
</html>
