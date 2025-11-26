{{-- resources/views/penjual/profile/edit.blade.php --}}
@extends('penjual.master')

@section('konten')

<style>
:root {
  --orange: #e06629;          /* ORANGE utama */
  --orange-dark: #c25520;     /* ORANGE gelap */
  --profile-bg1: #ffffff;     /* sidebar tidak biru */
  --profile-bg2: #f4f4f4;
  --card-shadow: 0 6px 20px rgba(34,34,34,0.08);
  --radius: 14px;
}

.wrap {
  max-width: 980px;
  margin: auto;
  display: grid;
  grid-template-columns: 330px 1fr;
  gap: 25px;
}

.card {
  background: #fff;
  border-radius: var(--radius);
  box-shadow: var(--card-shadow);
  padding: 22px;
}

/* SIDEBAR PROFIL TETAP PUTIH */
.profile {
  text-align: center;
  background: linear-gradient(180deg, var(--profile-bg1) 0%, var(--profile-bg2) 100%);
}

/* AVATAR ORANGE */
.avatar-placeholder {
  width: 110px;
  height: 110px;
  border-radius: 20px;
  background: linear-gradient(135deg, var(--orange), var(--orange-dark));
  color: white;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 38px;
  margin: 20px auto 10px;
}

/* TOMBOL ORANGE */
.btn-orange {
  background: linear-gradient(90deg, var(--orange), var(--orange-dark));
  color: #fff;
  border: none;
  border-radius: 10px;
  padding: 10px;
  font-weight: 600;
  width: 100%;
}

/* TEKS ORANGE */
h5, h4, label, .fw-bold, .title-blue {
  color: var(--orange-dark) !important;
}

/* INPUT */
input, textarea {
  border: 1px solid #f3c0a5 !important;
}

input:focus, textarea:focus {
  border-color: var(--orange);
  box-shadow: 0 0 4px rgba(224,102,41,0.5);
}

.toggle-password {
  position: absolute;
  right: 12px;
  top: 38px;
  cursor: pointer;
  color: #777;
}
</style>

<div class="container py-4">
  <div class="wrap">

    {{-- SIDEBAR PROFIL --}}
    <aside class="card profile">
      <div class="avatar-placeholder">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
      <h4 class="fw-bold">{{ $user->name }}</h4>
      <p class="text-muted">{{ $user->email }}</p>

      <a href="/dashboardpenjual" class="btn btn-outline-secondary w-75 mt-3">
        Kembali
      </a>
    </aside>

    {{-- FORM EDIT --}}
    <main class="card">
      <h5 class="fw-bold mb-3">Edit Data Akun</h5>

      {{-- UPDATE DATA AKUN --}}
      <form action="{{ route('penjual.profile.updateAkun') }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
          <label class="form-label">Nama Lengkap</label>
          <input type="text" name="name" class="form-control"
                 value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control"
                 value="{{ old('email', $user->email) }}" required>
        </div>

        <button type="submit" class="btn-orange w-100 mb-4">
          Simpan Perubahan Akun
        </button>
      </form>

      <hr>

      {{-- UPDATE PROFIL TOKO --}}
      <h5 class="fw-bold mb-3 mt-4">Edit Profil Toko</h5>

      <form action="{{ route('penjual.profile.updateToko') }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
          <label class="form-label">Nama Toko</label>
          <input type="text" name="nama_toko" class="form-control"
                 value="{{ old('nama_toko', $penjual->nama_toko) }}" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Alamat Toko</label>
          <input type="text" name="alamat" class="form-control"
                 value="{{ old('alamat', $penjual->alamat) }}">
        </div>

        <div class="mb-3">
          <label class="form-label">Kontak</label>
          <input type="text" name="kontak" class="form-control"
                 value="{{ old('kontak', $penjual->kontak) }}">
        </div>

        <button type="submit" class="btn-orange w-100 mb-4">
          Simpan Perubahan Toko
        </button>
      </form>

      <hr>

      {{-- UPDATE PASSWORD --}}
      <h5 class="fw-bold mb-3 mt-4">Ubah Password</h5>

      <form action="{{ route('penjual.profile.updatePassword') }}" method="POST">
        @csrf

        <div class="mb-3 position-relative">
          <label>Password Lama</label>
          <input type="password" name="current_password" class="form-control" required>
        </div>

        <div class="mb-3 position-relative">
          <label>Password Baru</label>
          <input type="password" name="new_password" class="form-control" required>
        </div>

        <div class="mb-3 position-relative">
          <label>Konfirmasi Password Baru</label>
          <input type="password" name="new_password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn-orange w-100">Perbarui Password</button>
      </form>

    </main>

  </div>
</div>

{{-- SWEETALERT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Sukses!',
      text: '{{ session('success') }}',
      confirmButtonColor: '#e06629'
    })
  </script>
@endif

@if($errors->any())
  <script>
    Swal.fire({
      icon: "error",
      title: "Terjadi Kesalahan",
      html: `{!! implode('<br>', $errors->all()) !!}`,
      confirmButtonColor: "#e06629"
    })
  </script>
@endif

@endsection
