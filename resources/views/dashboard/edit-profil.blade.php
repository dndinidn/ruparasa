@extends('dashboard.master')

@section('konten')

{{-- ===== STYLE ===== --}}
<style>
  :root {
    --orange: #ff7a2d;
    --orange-dark: #e06629;
    --muted: #6b6b6b;
    --card-shadow: 0 6px 20px rgba(34,34,34,0.08);
    --radius: 14px;
  }

  body {
    background: linear-gradient(180deg, #fff 0%, #fff 65%, #fffafa 100%);
  }

  .wrap {
    max-width: 980px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 330px 1fr;
    gap: 25px;
  }

  .card {
    background: #fff;
    border-radius: var(--radius);
    box-shadow: var(--card-shadow);
    padding: 22px;
    transition: transform .18s ease, box-shadow .18s ease;
  }

  .card:hover {
    transform: translateY(-4px);
  }

  .profile {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    background: linear-gradient(180deg, #fff7f2 0%, #ffe8d9 100%);
    overflow: hidden;
  }

  .avatar-placeholder {
    width: 110px;
    height: 110px;
    border-radius: 20px;
    background: linear-gradient(135deg, var(--orange), var(--orange-dark));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 36px;
    margin: 20px 0 10px;
    box-shadow: 0 6px 18px rgba(255,122,45,0.18);
  }

  .btn-orange {
    background: linear-gradient(90deg, var(--orange), var(--orange-dark));
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
    background: var(--orange-dark);
  }

  .toggle-password {
    position: absolute;
    right: 12px;
    top: 38px;
    cursor: pointer;
    color: #999;
  }

  .toggle-password:hover {
    color: var(--orange-dark);
  }

  @media (max-width: 900px) {
    .wrap {
      grid-template-columns: 1fr;
    }
  }
</style>

<div class="container py-5">
  <div class="wrap">

{{-- KIRI: INFORMASI PROFIL --}}
<aside class="card profile text-center">
  <div class="avatar-placeholder">
    {{ strtoupper(substr($user->name, 0, 1)) }}
  </div>

  <h4 class="fw-bold mt-2">{{ $user->name }}</h4>
  <p class="text-muted mb-3">{{ $user->email }}</p>

  <div class="mt-3 small text-muted">
    <p><i class="bi bi-calendar3"></i> Anggota sejak: {{ $user->created_at->format('d M Y') }}</p>
    <p><i class="bi bi-geo-alt"></i> Rupa Rasa Sulawesi</p>
  </div>

  <a href="/profil" class="btn btn-outline-secondary mt-3 w-75 mx-auto">Kembali</a>
</aside>

{{-- KANAN: FORM EDIT --}}
<main class="card">
  <h5 class="fw-bold mb-3" style="color: var(--orange);">Edit Informasi Profil</h5>

  <form action="{{ route('profil.update') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label class="form-label fw-semibold">Nama</label>
      <input type="text" name="name" class="form-control" 
             value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label fw-semibold">Email</label>
      <input type="email" name="email" class="form-control"
             value="{{ old('email', $user->email) }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label fw-semibold">Tentang Saya</label>
      <textarea name="bio" rows="4" class="form-control">{{ old('bio', $user->bio) }}</textarea>
    </div>

    <button type="submit" class="btn-orange w-100 mb-4">Simpan Perubahan</button>
  </form>

  <hr>

  {{-- FORM UBAH PASSWORD --}}
  <h5 class="fw-bold mb-3 mt-4" style="color: var(--orange);">Ubah Password</h5>
  <form action="{{ route('profil.password.update') }}" method="POST">
    @csrf
    <div class="mb-3 position-relative">
      <label class="form-label fw-semibold">Password Lama</label>
      <input type="password" name="current_password" id="current_password" class="form-control" required>
      <span class="toggle-password" onclick="togglePassword('current_password', this)">
        <i class="bi bi-eye-slash"></i>
      </span>
    </div>

    <div class="mb-3 position-relative">
      <label class="form-label fw-semibold">Password Baru</label>
      <input type="password" name="new_password" id="new_password" class="form-control" required>
      <span class="toggle-password" onclick="togglePassword('new_password', this)">
        <i class="bi bi-eye-slash"></i>
      </span>
    </div>

    <div class="mb-3 position-relative">
      <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
      <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
      <span class="toggle-password" onclick="togglePassword('new_password_confirmation', this)">
        <i class="bi bi-eye-slash"></i>
      </span>
    </div>

    <button type="submit" class="btn-orange w-100">Perbarui Password</button>
  </form>
</main>

  </div>
</div>

{{-- ===== SCRIPT ===== --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  // 👁️ Toggle Lihat/Sembunyikan Password
  function togglePassword(id, el) {
    const input = document.getElementById(id);
    const icon = el.querySelector('i');

    if (input.type === "password") {
      input.type = "text";
      icon.classList.replace("bi-eye-slash", "bi-eye");
    } else {
      input.type = "password";
      icon.classList.replace("bi-eye", "bi-eye-slash");
    }
  }

  // ✅ Popup jika berhasil update profil atau password
  @if(session('success'))
    Swal.fire({
      icon: 'success',
      title: 'Berhasil!',
      text: '{{ session('success') }}',
      confirmButtonColor: '#ff7a2d',
    });
  @endif

  // ❌ Popup jika ada error validasi atau password salah
  @if ($errors->any())
    Swal.fire({
      icon: 'error',
      title: 'Gagal!',
      html: `{!! implode('<br>', $errors->all()) !!}`,
      confirmButtonColor: '#ff7a2d',
    });
  @endif
</script>

@endsection
