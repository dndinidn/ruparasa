{{-- resources/views/penjual/profile/edit.blade.php --}}
@extends('penjual.master')

@section('konten')

<style>
:root {
<<<<<<< HEAD
  --orange: #e06629;
  --orange-dark: #c25520;
  --profile-bg1: #ffffff;
=======
  --orange: #e06629;          /* ORANGE utama */
  --orange-dark: #c25520;     /* ORANGE gelap */
  --profile-bg1: #ffffff;     /* sidebar tidak biru */
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
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

<<<<<<< HEAD
=======
/* SIDEBAR PROFIL TETAP PUTIH */
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
.profile {
  text-align: center;
  background: linear-gradient(180deg, var(--profile-bg1) 0%, var(--profile-bg2) 100%);
}

<<<<<<< HEAD
=======
/* AVATAR ORANGE */
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
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

<<<<<<< HEAD
=======
/* TOMBOL ORANGE */
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
.btn-orange {
  background: linear-gradient(90deg, var(--orange), var(--orange-dark));
  color: #fff;
  border: none;
  border-radius: 10px;
  padding: 10px;
  font-weight: 600;
  width: 100%;
}

<<<<<<< HEAD
h5, h4, label, .fw-bold {
  color: var(--orange-dark) !important;
}

=======
/* TEKS ORANGE */
h5, h4, label, .fw-bold, .title-blue {
  color: var(--orange-dark) !important;
}

/* INPUT */
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
input, textarea {
  border: 1px solid #f3c0a5 !important;
}

input:focus, textarea:focus {
  border-color: var(--orange);
  box-shadow: 0 0 4px rgba(224,102,41,0.5);
}

<<<<<<< HEAD
.toggle-box {
  background: #fff7f3;
  border: 1px solid #f3c0a5;
  padding: 10px 14px;
  cursor: pointer;
  border-radius: 10px;
  margin-bottom: 12px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.toggle-content {
  display: none;
  margin-bottom: 20px;
}

.toggle-box:hover {
  background: #ffe9df;
=======
.toggle-password {
  position: absolute;
  right: 12px;
  top: 38px;
  cursor: pointer;
  color: #777;
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
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
<<<<<<< HEAD

      {{-- TOGGLE 1: DATA AKUN --}}
      <div class="toggle-box" onclick="toggleSection('akun')">
        <span class="fw-bold">Edit Data Akun</span>
        <span id="icon-akun">▼</span>
      </div>

      <div id="section-akun" class="toggle-content">
        <form id="form-akun" action="{{ route('penjual.profile.updateAkun') }}" method="POST">
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
      </div>

      {{-- TOGGLE 2: PROFIL TOKO --}}
      <div class="toggle-box" onclick="toggleSection('toko')">
        <span class="fw-bold">Edit Profil Toko</span>
        <span id="icon-toko">▼</span>
      </div>

      <div id="section-toko" class="toggle-content">
        <form id="form-toko" action="{{ route('penjual.profile.updateToko') }}" method="POST">
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
      </div>

      {{-- TOGGLE 3: PASSWORD --}}
      <div class="toggle-box" onclick="toggleSection('password')">
        <span class="fw-bold">Ubah Password</span>
        <span id="icon-password">▼</span>
      </div>

      <div id="section-password" class="toggle-content">
        <form id="form-password" action="{{ route('penjual.profile.updatePassword') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label>Password Lama</label>
            <input type="password" name="current_password" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>Password Baru</label>
            <input type="password" name="new_password" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>Konfirmasi Password Baru</label>
            <input type="password" name="new_password_confirmation" class="form-control" required>
          </div>

          <button type="submit" class="btn-orange w-100">
            Perbarui Password
          </button>
        </form>
      </div>
=======
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
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a

    </main>

  </div>
</div>

<<<<<<< HEAD
{{-- SCRIPT TOGGLE (Accordion Eksklusif) --}}
<script>
    const sections = ['akun', 'toko', 'password'];

    function toggleSection(selected) {
        sections.forEach(sec => {
            const content = document.getElementById("section-" + sec);
            const icon = document.getElementById("icon-" + sec);

            if (sec === selected) {
                const opening = content.style.display !== "block";
                content.style.display = opening ? "block" : "none";
                icon.textContent = opening ? "▲" : "▼";
            } else {
                content.style.display = "none";
                icon.textContent = "▼";
            }
        });
    }
</script>

{{-- SCRIPT: DISABLE BUTTON JIKA TIDAK ADA PERUBAHAN --}}
<script>
function enableOnChange(formId, buttonSelector) {
    const form = document.getElementById(formId);
    const submitBtn = form.querySelector(buttonSelector);

    const initialData = new FormData(form);
    const initial = {};
    initialData.forEach((v, k) => initial[k] = v);

    function checkChanges() {
        const currentData = new FormData(form);
        let changed = false;

        currentData.forEach((v, k) => {
            if (v !== initial[k]) changed = true;
        });

        submitBtn.disabled = !changed;
        submitBtn.style.opacity = changed ? "1" : "0.5";
        submitBtn.style.cursor = changed ? "pointer" : "not-allowed";
    }

    form.querySelectorAll("input, textarea").forEach(el => {
        el.addEventListener("input", checkChanges);
    });

    submitBtn.disabled = true;
    submitBtn.style.opacity = "0.5";
    submitBtn.style.cursor = "not-allowed";
}

document.addEventListener("DOMContentLoaded", function() {
    enableOnChange("form-akun", ".btn-orange");
    enableOnChange("form-toko", ".btn-orange");
    enableOnChange("form-password", ".btn-orange");
});
</script>

{{-- SWEETALERT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#e06629'
        });
    @endif

    @if($errors->any())
        Swal.fire({
            icon: "error",
            title: "Terjadi Kesalahan",
            html: `{!! implode('<br>', $errors->all()) !!}`,
            confirmButtonColor: "#e06629"
        });

        document.addEventListener("DOMContentLoaded", function() {
            @if($errors->has('name') || $errors->has('email'))
                toggleSection('akun');
            @elseif($errors->has('nama_toko') || $errors->has('alamat') || $errors->has('kontak'))
                toggleSection('toko');
            @elseif($errors->has('current_password') || $errors->has('new_password') || $errors->has('new_password_confirmation'))
                toggleSection('password');
            @endif
        });
    @endif
</script>
=======
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
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a

@endsection
