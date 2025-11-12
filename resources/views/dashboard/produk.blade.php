@extends('dashboard.master')

@section('konten')
<!-- 🟧 HEADER DENGAN GAMBAR LATAR -->
<div class="header-resep text-center py-5 mb-5">
    <div class="header-overlay">
        <h1 class="fw-bold text-uppercase mb-2 title-white">Daftar Produk Market Place</h1>
        <p class="mb-0 subtitle-white">Menampilkan produk dari berbagai penjual</p>
    </div>
</div>

<!-- 🟠 Icon Pesanan di pojok kanan atas container -->
<div class="container position-relative">
    <a href="{{ route('pesananuser.lihat') }}" class="btn btn-orange position-absolute top-0 end-0 mt-2 me-2">
        <i class="bi bi-cart-check-fill"></i>
        @if(session('pesanan_count') > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ session('pesanan_count') }}
            </span>
        @endif
    </a>
</div>

<div class="container py-5" style="font-family: 'Inter', sans-serif;">

    {{-- ✅ Alert jika ada pesan sukses --}}
    @if (session('success'))
    <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- 🧡 Header Section -->
    <div class="row mb-4">
        <div class="col-lg-6">
            <h2 class="fw-bold text-orange text-uppercase">Daftar Produk</h2>
        </div>
    </div>

    <!-- 🛒 Daftar Kartu Produk -->
    <div class="row">
        @forelse($produks as $produk)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    @if($produk->gambar)
                        <img src="{{ asset('storage/' . $produk->gambar) }}" class="card-img-top" alt="{{ $produk->nama_produk }}" style="height: 220px; object-fit: cover;">
                    @else
                        <img src="{{ asset('img/default.png') }}" class="card-img-top" alt="Default" style="height: 220px; object-fit: cover;">
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold text-orange">{{ $produk->nama_produk }}</h5>

                        <!-- Penjual -->
                        <p class="text-muted mb-2"><i class="bi bi-person-fill text-orange"></i> {{ $produk->penjual->nama ?? 'Penjual' }}</p>

                        <p class="card-text text-muted text-truncate">{{ $produk->deskripsi }}</p>
                        <p class="text-dark fw-bold mb-2">Rp {{ number_format($produk->harga,0,',','.') }}</p>

                        <!-- FORM Beli -->
  <!-- FORM Beli -->
<form action="{{ route('pesanan.beli', $produk->id) }}" method="POST" class="mt-auto">
    @csrf
    <div class="input-group mb-2" style="width:95px; font-size:0.8rem;">
        <button type="button" class="btn btn-outline-orange btn-sm" 
                style="padding:0 6px; font-weight:bold;" 
                onclick="this.nextElementSibling.stepDown()">-</button>
        <input type="number" name="jumlah" value="1" min="1" 
               class="form-control form-control-sm text-center jumlah-input" 
               style="height:30px; font-size:0.8rem; color:#000; background-color:#fff; border-radius:4px; border:1px solid #f77f00;">
        <button type="button" class="btn btn-outline-orange btn-sm" 
                style="padding:0 6px; font-weight:bold;" 
                onclick="this.previousElementSibling.stepUp()">+</button>
    </div>
    <button type="submit" class="btn btn-orange w-100" style="font-size:0.85rem; padding:4px 0;">Beli</button>
</form>

<style>
/* Hapus panah default input number di semua browser */
input.jumlah-input::-webkit-outer-spin-button,
input.jumlah-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
input.jumlah-input {
    -moz-appearance: textfield;
}
</style>


                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-4">
                <p>Belum ada produk yang tersedia.</p>
            </div>
        @endforelse
    </div>

    <div class="text-center mt-4">
        <a href="{{ url('/') }}" class="btn btn-outline-orange rounded-pill px-4 py-2">Kembali ke Beranda</a>
    </div>

</div>

<!-- 🧩 Style Header & Kartu -->
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

body, h1, h2, h3, h4, h5, h6, p, button, input, textarea {
    font-family: 'Inter', sans-serif !important;
}

/* 🧡 HEADER DENGAN GAMBAR */
.header-resep {
    background: url('/images/produk.png') center center/cover no-repeat;
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
    color: #ffffffff;
    text-shadow: 2px 2px 10px rgba(0,0,0,0.7);
}
.subtitle-white {
    color: #ffffffff;
    opacity: 0.95;
    text-shadow: 1px 1px 8px rgba(0,0,0,0.5);
}

.text-orange { color: #f77f00 !important; }

/* 🧡 Tombol */
.btn-orange {
    background-color: #f77f00;
    color: #ffffffff;
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

/* Kartu Produk */
.card-title { font-size: 1.25rem; }
.card-text { font-size: 0.95rem; }

/* Input jumlah kecil */
.input-group input {
    max-width: 40px;
    height:30px;
    font-size:0.8rem;
    text-align:center;
}
</style>
@endsection
