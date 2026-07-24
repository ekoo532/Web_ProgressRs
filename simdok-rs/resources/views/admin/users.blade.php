<x-layout>
<div class="container">
    <div class="page-head">
        <div>
            <h1>Kelola Pengguna</h1>
            <p class="subtitle">Tambah akun admin/user secara manual jika diperlukan.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="link-muted">&larr; Kembali</a>
    </div>

    <div class="card card-narrow">
        <h3>Tambah Pengguna</h3>
        @if ($errors->any())
            <div class="alert alert-error">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            <label>Nama Lengkap</label>
            <input type="text" name="name" required value="{{ old('name') }}">

            <label>Username</label>
            <input type="text" name="username" required value="{{ old('username') }}">

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Peran</label>
            <select name="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit" class="btn btn-primary btn-block">Tambah Pengguna</button>
        </form>
    </div>

    <div class="table-card" style="margin-top:24px;">
        <div class="table-row table-head">
            <div class="col-doc">Nama</div>
            <div class="col-user">Username</div>
            <div class="col-status">Peran</div>
            <div class="col-progress">Dibuat</div>
        </div>
        @foreach ($users as $usr)
        <div class="table-row">
            <div class="col-doc">{{ $usr->name }}</div>
            <div class="col-user">{{ $usr->username }}</div>
            <div class="col-status"><span class="badge {{ $usr->role === 'admin' ? 'badge-teal' : 'badge-slate' }}">{{ $usr->role }}</span></div>
            <div class="col-progress">{{ $usr->created_at?->format('d M Y H:i') ?? '-' }}</div>
        </div>
        @endforeach
    </div>
</div>
</x-layout>
