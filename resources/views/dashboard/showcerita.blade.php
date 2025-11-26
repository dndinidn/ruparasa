@extends('dashboard.master')

@section('konten')
<!-- 🟧 HEADER DENGAN GAMBAR LATAR -->
<div class="header-cerita text-center mb-5">
    <div class="header-overlay">
        <h1 class="fw-bold text-uppercase mb-2 title-white">Detail Cerita Inspiratif</h1>
        <p class="mb-0 subtitle-white">Menikmati kisah penuh makna dari masyarakat</p>
    </div>
</div>

<div class="container pb-5">
    <div class="d-flex justify-content-start mb-4">
        <a href="{{ route('cerita.userIndex') }}" class="btn btn-outline-orange rounded-pill px-4">
            ⬅️ Kembali
        </a>
    </div>

    <div class="card shadow-sm border-0 p-4 text-center">
        @if($ceritas->gambar)
            <div class="d-flex justify-content-center mb-4">
                <img src="{{ asset('storage/' . $ceritas->gambar) }}" 
                     alt="Gambar Cerita" 
                     class="rounded shadow-sm"
                     style="width: 250px; height: 250px; object-fit: cover; border: 4px solid #f77f00;">
            </div>
        @endif

        <h3 class="fw-bold text-orange">{{ $ceritas->judul }}</h3>
        <p class="text-muted small mb-3">
            <i class="bi bi-person-circle"></i> Ditulis oleh {{ $ceritas->user->name ?? 'Anonim' }}
        </p>
        <hr>
        <div class="isi-cerita text-start">
            {!! $ceritas->isi_cerita !!}
        </div>
    </div>
</div>

<!-- 🧩 STYLE -->
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

body, h1, h2, h3, h4, h5, h6, p, button, input, textarea {
    font-family: 'Inter', sans-serif !important;
}

/* HEADER DENGAN GAMBAR */
.header-cerita {
    background: url('/images/bg-cerita.png') center center/cover no-repeat;
    border-radius: 0 0 25px 25px;
    height: 300px;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
}
.header-overlay {
    background-color: rgba(0, 0, 0, 0.5);
    padding: 40px 60px;
    border-radius: 15px;
}
.title-white {
    color: #ffffff;
    text-shadow: 2px 2px 10px rgba(0,0,0,0.7);
}
.subtitle-white {
    color: #ffffff;
    opacity: 0.9;
    text-shadow: 1px 1px 8px rgba(0,0,0,0.5);
}

/* 🟧 WARNA UTAMA */
.text-orange { color: #f77f00 !important; }

.btn-outline-orange {
    border: 2px solid #f77f00;
    color: #f77f00;
    background: transparent;
    transition: all 0.3s ease;
}
.btn-outline-orange:hover {
    background-color: #f77f00;
    color: white;
}

/* ISI CERITA */
.isi-cerita {
    line-height: 1.8;
    font-size: 1rem;
    text-align: justify;
    color: #333;
}

/* CARD STYLE */
.card {
    border-radius: 20px;
    overflow: hidden;
}
</style>
@endsection
