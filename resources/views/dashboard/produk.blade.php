@extends('dashboard.master')

@section('konten')
    <!-- 🟧 HEADER DENGAN GAMBAR LATAR -->
    <div class="header-resep text-center py-5 mb-5">
        <div class="header-overlay">
            <h1 class="fw-bold text-uppercase mb-2 title-white">Daftar Produk Market Place</h1>
            <p class="mb-0 subtitle-white">Menampilkan produk dari berbagai penjual</p>
        </div>
    </div>

    <!-- 🟠 Icon Kardus & Keranjang di pojok kanan atas container -->
    <div class="container position-relative mb-4">
        <div class="d-flex justify-content-end gap-2">
            <!-- Icon Kardus (langsung ke pesanan / COD) -->
            <a href="{{ route('pesananuser.lihat') }}"
               class="btn btn-orange d-flex align-items-center">
                <i class="bi bi-box-seam me-1"></i>
                Pesanan
            </a>

            <!-- Icon Keranjang (untuk menampung banyak produk sebelum checkout) -->
            <a href="{{ route('pesanan.keranjang') }}"
               class="btn btn-orange position-relative d-flex align-items-center">
                <i class="bi bi-cart-check-fill me-1"></i>
                Keranjang
                @if(session('keranjang_count') > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge bg-danger rounded-pill">
                        {{ session('keranjang_count') }}
                    </span>
                @endif
            </a>
        </div>
    </div>

    <div class="container py-5" style="font-family: 'Inter', sans-serif;">
        {{-- ✅ Alert jika ada pesan sukses --}}
        @if (session('success'))
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

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

                            <p class="text-muted mb-2"><i class="bi bi-person-fill text-orange"></i> {{ $produk->penjual->nama ?? 'Penjual' }}</p>
                            <p class="card-text text-muted text-truncate">{{ $produk->deskripsi }}</p>
                            <p class="text-dark fw-bold mb-2">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>

                            <!-- Input jumlah -->
                            <div class="mb-2 d-flex align-items-center gap-2">
                                <label for="jumlah_{{ $produk->id }}" class="mb-0 fw-semibold">Jumlah:</label>
                                <input type="number" id="jumlah_{{ $produk->id }}" name="jumlah" value="1" min="1" class="form-control" style="width:60px">
                            </div>

                           <!-- Tombol Beli & Keranjang side by side -->
<div class="d-flex gap-2 mt-auto">

    <!-- Beli Sekarang -->
 <form action="{{ route('pesanan.beli', $produk->id) }}"
      method="POST" class="beli-form">
    @csrf
    <input type="hidden" name="jumlah" class="jumlah-input" value="1">
    <button type="submit" class="btn btn-primary">Beli Sekarang</button>
</form>




    <!-- Tambah ke Keranjang -->
    <form action="{{ route('pesanan.keranjang.tambah', $produk->id) }}" method="POST" class="flex-fill keranjang-form">
        @csrf
        <input type="hidden" name="jumlah" class="jumlah-input" value="1">
        <button type="submit" class="btn btn-outline-orange w-100">Keranjang</button>
    </form>

</div>


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
    .title-white, .subtitle-white {
        color: #fff;
        text-shadow: 1px 1px 8px rgba(0,0,0,0.5);
    }

    .text-orange { color: #f77f00 !important; }

    .btn-orange { background-color: #f77f00; color: #fff; border: none; }
    .btn-orange:hover { background-color: #e56e00; }

    .btn-outline-orange { border:1px solid #f77f00; color:#f77f00; background:transparent; }
    .btn-outline-orange:hover { background-color:#f77f00; color:#fff; }
    </style>
    <script>
document.addEventListener('DOMContentLoaded', function () {

    // Ambil semua card produk
    document.querySelectorAll('.card').forEach(function(card) {

        let jumlahInput = card.querySelector('input[name="jumlah"]');
        let beliForm = card.querySelector('.beli-form');
        let keranjangForm = card.querySelector('.keranjang-form');

        // tombol beli
        if (beliForm) {
            beliForm.addEventListener('submit', function () {
                let jumlah = card.querySelector('input[type="number"]').value;
                beliForm.querySelector('.jumlah-input').value = jumlah;
            });
        }

        // tombol tambah ke keranjang
        if (keranjangForm) {
            keranjangForm.addEventListener('submit', function () {
                let jumlah = card.querySelector('input[type="number"]').value;
                keranjangForm.querySelector('.jumlah-input').value = jumlah;
            });
        }

    });

});
</script>

@endsection
