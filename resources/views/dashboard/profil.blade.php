@extends('dashboard.master')

@section('konten')
<!-- 🟧 HEADER DENGAN GAMBAR LATAR -->
<div class="header-resep text-center py-5 mb-5">
    <div class="header-overlay">
        <h1 class="fw-bold text-uppercase mb-2 title-white">Profil Saya</h1>
        <p class="mb-0 subtitle-white">Kelola informasi akun Anda di RupaRasa Sulawesi</p>
    </div>
</div>

<div class="container py-5" style="font-family: 'Inter', sans-serif;">
  <div class="wrap" style="display: grid; grid-template-columns: 320px 1fr; gap: 20px; max-width: 980px; margin: 0 auto;">

    {{-- LEFT: PROFILE CARD --}}
    <aside class="card profile text-center" style="display: flex; flex-direction: column; align-items: center; position: relative; background: linear-gradient(180deg, #fff7f2 0%, #ffe8d9 100%); overflow: hidden;">
      {{-- Avatar Huruf --}}
      <div class="avatar-placeholder" style="width: 110px; height: 110px; border-radius: 20px; background: linear-gradient(135deg, #ff7a2d, #e06629); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 36px; box-shadow: 0 6px 18px rgba(255,122,45,0.18);">
        {{ strtoupper(substr($user->name, 0, 1)) }}
      </div>

      {{-- Informasi Dasar --}}
      <h4 class="fw-bold mt-2">{{ $user->name }}</h4>
      <p class="text-muted">{{ $user->email }}</p>

      <div class="mt-3 small text-muted">
        <p><i class="bi bi-calendar3"></i> Anggota sejak: {{ $user->created_at->format('d M Y') }}</p>
        <p><i class="bi bi-geo-alt"></i> RupaRasa Sulawesi</p>
      </div>

      {{-- Tombol --}}
      <a href="{{ route('profil.edit') }}" class="btn-orange mt-3 w-75 mx-auto">Edit Profil</a>
      <a href="{{ route('logout') }}" class="btn btn-outline-danger mt-2 w-75 mx-auto">Logout</a>
      <a href="/home" class="btn btn-outline-secondary mt-3 w-75 mx-auto">Kembali</a>
    </aside>

    {{-- RIGHT: DETAIL CARD --}}
    <main class="card" style="background: #fff; border-radius: 14px; box-shadow: 0 6px 20px rgba(34,34,34,0.08); padding: 22px;">
      <h5 class="fw-bold mb-3 text-orange">Informasi Pengguna</h5>
      <p><strong>Nama:</strong> {{ $user->name }}</p>
      <p><strong>Email:</strong> {{ $user->email }}</p>
      <p><strong>Tanggal Bergabung:</strong> {{ $user->created_at->format('d M Y') }}</p>

      <hr>
      <h6 class="fw-bold mt-3">Tentang Saya</h6>
      <p>{{ $user->bio ?? 'Belum ada deskripsi.' }}</p>
    </main>

  </div>
</div>

<!-- 🧩 Style Header & Tombol -->
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

body, h1, h2, h3, h4, h5, h6, p, button, input, textarea {
    font-family: 'Inter', sans-serif !important;
}

.header-resep {
    background: url('/images/bg-profile.jpg') center center/cover no-repeat;
    border-radius: 0 0 20px 20px;
    position: relative;
    overflow: hidden;
    height: 300px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.header-resep .header-overlay {
    background-color: rgba(220, 212, 212, 0.45);
    padding: 40px;
    border-radius: 15px;
}
.title-white {
    color: #ffffff;
    text-shadow: 2px 2px 10px rgba(0,0,0,0.7);
}
.subtitle-white {
    color: #ffffff;
    opacity: 0.95;
    text-shadow: 1px 1px 8px rgba(0,0,0,0.5);
}

.text-orange { color: #f77f00 !important; }

.btn-orange {
    background: linear-gradient(90deg, #ff7a2d, #e06629);
    color: white;
    border: none;
    border-radius: 12px;
    padding: 10px 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s;
    display: inline-block;
    text-decoration: none;
}

.btn-orange:hover {
    background: #e06629;
}
</style>
@endsection
