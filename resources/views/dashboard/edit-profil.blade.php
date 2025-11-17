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
        <p><i class="bi bi-geo-alt"></i> {{ $user->provinsi ?? 'Belum diisi' }}, {{ $user->kota ?? '' }}</p>
        <p><i class="bi bi-telephone"></i> {{ $user->kontak ?? 'Belum diisi' }}</p>
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
          <label class="form-label fw-semibold">Provinsi</label>
          <select name="provinsi" id="provinsi" class="form-select" required>
            <option value="">Pilih Provinsi</option>
            @foreach(['Sulawesi Barat','Sulawesi Selatan','Sulawesi Tengah','Sulawesi Tenggara','Sulawesi Utara','Gorontalo'] as $prov)
              <option value="{{ $prov }}" {{ $user->provinsi==$prov?'selected':'' }}>{{ $prov }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Kota/Kabupaten</label>
          <select name="kota" id="kota" class="form-select" required>
            <option value="{{ $user->kota ?? '' }}">{{ $user->kota ?? 'Pilih Kota' }}</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Alamat Lengkap</label>
          <input type="text" name="alamat" class="form-control"
                 value="{{ old('alamat', $user->alamat) }}">
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Kontak / No. HP</label>
          <input type="text" name="kontak" class="form-control"
                 value="{{ old('kontak', $user->kontak) }}">
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Tentang Saya</label>
          <textarea name="bio" rows="4" class="form-control">{{ old('bio', $user->bio) }}</textarea>
        </div>

        <button type="submit" class="btn-orange w-100 mb-4">Simpan Perubahan</button>
      </form>
    </main>

  </div>
</div>

{{-- ===== SCRIPT: Dropdown Kota Dinamis ===== --}}
<script>
const kotaOptions = {
  'Sulawesi Barat': ['Kab. Majene','Kab. Mamasa','Kab. Mamuju','Kab. Mamuju Tengah','Kab. Mamuju Utara','Kab. Polewali Mandar'],
  'Sulawesi Selatan': ['Kab. Bulukumba','Kab. Enrekang','Kab. Gowa','Kab. Jeneponto','Kab. Luwu','Kab.Luwu Timur','Kab.Luwu Utara','Kab.Maros','Kab.Pangkajene Kepulauan','Kab.Pinrang','Kab.Selayar','Kab.Sidenreng','Kab.Sinjai','Kab.Soppeng','Kab.Takalar','Kab.Tana Toraja','Kab.Toraja Utara','Kab.Wajo','Kota Makassar','Kota Palopo','Kota Parepare'],
  'Sulawesi Tengah': ['Kab. banggai','Kab.banggai kepulauan','Kab. banggai laut','Kab.buol','Kab.donggala','Kab. morowali','Kab.morowali utara','Kab.parigi moutong','Kab.poso','Kab.sigi','Kab.tojo una-una','Kab.toli-toli','Kota palu'],
  'Sulawesi Tenggara': ['Kab.bombana','Kab.buton','Kab.buton selatan','Kab.buton tengah','Kab.buton utara','Kab.kolaka','Kab.kolaka timur','Kab.kolaka utara','Kab.konawe','Kab.konawe kepulauan','Kab.konawe selatan','Kab.konawe utara','Kab.muna','Kab.wakatobi','Kota bau-bau','Kota kendari'],
  'Sulawesi Utara': ['Kab.bolaang mongondow (bolmong)','Kab.bolaang mongondow selatan','Kab.bolaang mongondow timur','Kab.bolaang mongondow utara','Kab.kepulauan sangihe','Kab.kepulauan siau tagulandang biaro(sitaro)','Kab.kepulauan talaud','Kab.minahasa','Kab.minahasa selatan','Kab.minahasa tenggara','Kab.minahasa utara','Kota Bitung','Kota kotamobagu','kota manado','kota tomohon'],
  'Gorontalo': ['Kab.boalemo','Kab.bone bolango','Kab.gorontalo','Kab.gorontalo utara','Kab.pohuwato','kota gorontalo']
};

const provSelect = document.getElementById('provinsi');
const kotaSelect = document.getElementById('kota');

provSelect.addEventListener('change', function(){
  const list = kotaOptions[this.value] || [];
  kotaSelect.innerHTML = '<option value="">Pilih Kota</option>';
  list.forEach(k => {
    let selected = '{{ $user->kota }}' === k ? 'selected' : '';
    kotaSelect.innerHTML += `<option value="${k}" ${selected}>${k}</option>`;
  });
});
</script>

@endsection
