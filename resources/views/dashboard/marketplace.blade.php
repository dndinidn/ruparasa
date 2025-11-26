@extends('dashboard.master')
@section('konten')

<!-- 🟧 HEADER DENGAN GAMBAR LATAR -->
<div class="header-resep text-center mb-5" style="background: url('/images/bg-produk.png') center center/cover no-repeat;">
    <div class="header-overlay">
        <h1 class="fw-bold text-uppercase mb-2 title-white">MARKETPLACE</h1>
        <p class="mb-0 subtitle-white">Temukan Souvenir dan Makanan Lokal</p>
    </div>
</div>

<section class="py-5">
    <div class="container mt-5">
        <!-- 🔎 Form Pencarian Toko -->
<form action="{{ route('toko.index') }}" method="GET" class="mb-4 d-flex justify-content-center">
    <input type="text" name="search" class="form-control w-50 rounded-start" placeholder="Cari toko atau alamat..." value="{{ request('search') }}">
    <button class="btn btn-orange rounded-end ms-1">Cari</button>
</form>

        <h3 class="text-center mb-5 fw-bold text-orange">Daftar Toko</h3>
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 justify-content-center gx-4">
            @forelse ($penjual as $pjl)
                <div class="col mb-5">
                    <div class="card h-100 shadow-sm border-0 rounded bg-white">
                        <div class="card-body text-center">
                            <h5 class="fw-bolder text-orange">{{ $pjl->nama_toko }}</h5>
                            <p class="text-muted"><strong>Alamat:</strong> {{ $pjl->alamat }}</p>
                            <p class="text-muted"><strong>Kontak:</strong> {{ $pjl->kontak }}</p>
                        </div>
                        <div class="card-footer border-0 bg-transparent text-center">
                            <a href="{{ route('produk', ['penjual_id' => $pjl->id]) }}"
                               class="btn btn-outline-orange mt-auto rounded-pill px-4 py-2">
                               Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-4">
                    <p>Belum ada toko yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- 🧩 Style Header & Kartu -->
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

body, h1, h2, h3, h4, h5, h6, p, button, input, textarea {
    font-family: 'Inter', sans-serif !important;
}

/* 🧡 HEADER DENGAN GAMBAR */
.header-resep {
    position: relative;
    border-radius: 0 0 20px 20px;
    height: 300px;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
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

/* 🧡 Tombol */
.btn-orange {
    background-color: #f77f00;
    color: #fcfbfb;
    border: none;
}
.btn-orange:hover { background-color: #e56e00; color: #fff; }

.btn-outline-orange {
    border: 1px solid #f77f00;
    color: #f77f00;
    background: transparent;
}
.btn-outline-orange:hover {
    background-color: #f77f00;
    color: #fff;
}

/* 🥡 Kartu Toko mirip style Resep */
.card {
    border-radius: 15px;
    overflow: hidden;
    background-color: #ffffff; /* Kotak lebih terang */
    padding: 15px;
    transition: transform 0.2s, box-shadow 0.2s;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}
.card h5 {
    font-size: 1.25rem;
}
.card p {
    font-size: 0.95rem;
    color: #555;
}
</style>

@endsection
