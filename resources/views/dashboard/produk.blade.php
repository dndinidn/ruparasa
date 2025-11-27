@extends('dashboard.master')

@section('konten')
<!-- 🟧 HEADER DENGAN GAMBAR LATAR -->
<div class="header-resep text-center py-5 mb-5">
    <div class="header-overlay">
        <h1 class="fw-bold text-uppercase mb-2 title-white">Daftar Produk Market Place</h1>
        <p class="mb-0 subtitle-white">Menampilkan produk dari berbagai penjual</p>
    </div>
</div>

<!-- 🟠 Icon Kardus, Keranjang & Filter -->
<div class="container position-relative mb-4">
    <div class="d-flex justify-content-end gap-2">

        <!-- Icon Kardus -->
        <a href="{{ route('pesananuser.lihat') }}"
           class="btn btn-orange d-flex align-items-center">
            <i class="bi bi-box-seam me-1"></i> Pesanan
        </a>

        <!-- Icon Keranjang -->
        <a href="{{ route('pesanan.keranjang') }}"
           class="btn btn-orange position-relative d-flex align-items-center">
            <i class="bi bi-cart-check-fill me-1"></i> Keranjang
            @if(session('keranjang_count') > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge bg-danger rounded-pill">
                    {{ session('keranjang_count') }}
                </span>
            @endif
        </a>

        <!-- Icon Filter -->
        <button class="btn btn-orange d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#filterModal">
            <i class="bi bi-funnel-fill me-1"></i> Filter
        </button>

    </div>
</div>

<!-- 🔍 SEARCH BAR -->
<div class="container mb-4">
   <form method="GET" action="{{ route('produk', $penjual_id) }}" class="d-flex">
        <input type="text" name="cari" class="form-control me-2"
            placeholder="Cari produk..." value="{{ request('cari') }}">
        <button class="btn btn-orange" type="submit">
            <i class="bi bi-search"></i> 
        </button>
    </form>
</div>

<div class="container py-5" style="font-family: 'Inter', sans-serif;">
    {{-- Alert jika ada pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- 🛒 Daftar Produk -->
    <!-- 🛒 Daftar Produk -->
<div class="row">
    @forelse($produks as $produk)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">

                {{-- Gambar Produk --}}
                @if($produk->gambar)
                    <img src="{{ asset('storage/' . $produk->gambar) }}" class="card-img-top"
                         alt="{{ $produk->nama_produk }}" style="height: 220px; object-fit: cover;">
                @else
                    <img src="{{ asset('img/default.png') }}" class="card-img-top"
                         alt="Default" style="height: 220px; object-fit: cover;">
                @endif

                <div class="card-body d-flex flex-column">
                    {{-- Nama Produk --}}
                    <h5 class="card-title fw-bold text-orange">{{ $produk->nama_produk }}</h5>

                    {{-- Harga --}}
                    <p class="text-dark fw-bold mb-2">
                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                    </p>

                    {{-- Stok --}}
                    <p class="text-muted mb-2">Stok: {{ $produk->stok }}</p>

                    {{-- Rating --}}
                    @php
                        $rating = $produk->reviews->avg('rating') ?? 0;
                        $fullStars = floor($rating);
                        $halfStar = $rating - $fullStars >= 0.5;
                    @endphp
                    <p class="mb-2">
                        @for($i = 0; $i < $fullStars; $i++)
                            <i class="bi bi-star-fill text-warning"></i>
                        @endfor
                        @if($halfStar)
                            <i class="bi bi-star-half text-warning"></i>
                        @endif
                        @for($i = $fullStars + ($halfStar ? 1 : 0); $i < 5; $i++)
                            <i class="bi bi-star text-warning"></i>
                        @endfor
                        ({{ $produk->reviews->count() }} ulasan)
                    </p>

                    {{-- Tombol Lihat Produk --}}
                    <a href="{{ route('produk.detail', $produk->id) }}" class="btn btn-primary mt-auto w-100">
                        Lihat Produk
                    </a>
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
        <a href="{{ url('/toko') }}" class="btn btn-outline-orange rounded-pill px-4 py-2">
            Kembali ke Beranda
        </a>
    </div>
</div>

<!-- STYLE -->
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

body { font-family: 'Inter', sans-serif !important; }

.header-resep {
    background: url('/images/produk.png') center center/cover no-repeat;
    border-radius: 0 0 20px 20px;
    height: 300px;
    display: flex; align-items: center; justify-content: center;
}
.header-overlay { background-color: rgba(220, 212, 212, 0.45); padding: 40px; border-radius: 15px; }
.title-white, .subtitle-white { color: #fff; text-shadow: 1px 1px 8px rgba(0,0,0,0.5); }

.text-orange { color: #f77f00 !important; }
.btn-orange { background-color: #f77f00; color: #fff; }
.btn-orange:hover { background-color: #e56e00; }
.btn-outline-orange { border:1px solid #f77f00; color:#f77f00; }
.btn-outline-orange:hover { background:#f77f00; color:#fff; }
</style>

<!-- ================= FILTER MODAL ================= -->
<div class="modal fade" id="filterModal" tabindex="-1">
  <div class="modal-dialog">
    <form method="GET" action="{{ route('produk', $penjual_id) }}" class="modal-content">
        <input type="hidden" name="penjual_id" value="{{ $penjual_id }}">
        <div class="modal-header">
            <h5 class="modal-title">Filter Kategori</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <label class="fw-semibold mb-2">Pilih Kategori</label>
            <select name="kategori" class="form-control">
                <option value="">Semua Kategori</option>
                <optgroup label="Makanan Khas Sulawesi">
                    <option value="Makanan Lokal">Makanan Lokal</option>
                    <option value="Snack / Camilan">Snack / Camilan</option>
                    <option value="Kue Tradisional">Kue Tradisional</option>
                    <option value="Sambal & Bumbu">Sambal & Bumbu</option>
                    <option value="Minuman Tradisional">Minuman Tradisional</option>
                </optgroup>
                <optgroup label="Souvenir & Kerajinan">
                    <option value="Tenun & Songket">Tenun & Songket</option>
                    <option value="Aksesoris Khas Sulawesi">Aksesoris Khas Sulawesi</option>
                    <option value="Kerajinan Kayu">Kerajinan Kayu</option>
                    <option value="Kerajinan Kerang">Kerajinan Kerang</option>
                    <option value="Miniatur / Pajangan">Miniatur / Pajangan</option>
                    <option value="Dekorasi Rumah">Dekorasi Rumah</option>
                </optgroup>
            </select>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-orange">Terapkan Filter</button>
        </div>
    </form>
  </div>
</div>

@endsection
