@extends('dashboard.layout')

@section('konten')

<style>
/* =========================================
   1. Variabel Warna & Font
   ========================================= */
:root {
    --primary-orange: #ff7e00;
    --secondary-orange: #e06629;
    --text-color: #343a40;
    --border-color: #e9ecef;
}

/* Konsistensi Warna */
.text-orange {
    color: var(--primary-orange) !important;
}

/* =========================================
   2. Styling Tombol Aksi
   ========================================= */
.btn-orange {
    background-color: var(--primary-orange);
    color: #fff;
    border: 1px solid var(--primary-orange);
    border-radius: 8px;
    font-weight: 600;
    transition: background-color 0.3s, border-color 0.3s;
}
.btn-orange:hover {
    background-color: var(--secondary-orange);
    color: #fff;
    border-color: var(--secondary-orange);
}
.btn-outline-orange {
    color: var(--primary-orange);
    border: 1px solid var(--primary-orange);
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s;
}
.btn-outline-orange:hover {
    background-color: #fff8f2;
    color: var(--secondary-orange);
}

/* =========================================
   3. Card Review Item (Modern)
   ========================================= */
.review-card {
    border: 1px solid #f0f0f0;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    padding: 20px;
}

.review-card h5 {
    color: var(--text-color);
    font-weight: 600;
    margin-bottom: 15px;
    padding-bottom: 5px;
    border-bottom: 1px solid #eee;
}

/* =========================================
   4. Rating Bintang Visual (Kekinian)
   ========================================= */

.rating-stars {
    display: flex;
    flex-direction: row-reverse; /* Membalik urutan agar rating 5 di kiri */
    justify-content: flex-end;
    font-size: 1.8rem; /* Ukuran ikon bintang */
    padding: 10px 0;
}

/* Sembunyikan input radio */
.rating-stars input[type="radio"] {
    display: none;
}

/* Styling default ikon bintang */
.rating-stars label {
    cursor: pointer;
    color: #ccc; /* Warna bintang saat belum di-rating */
    transition: color 0.3s;
    margin: 0 2px;
}

/* Hover effect */
.rating-stars label:hover,
.rating-stars label:hover ~ label {
    color: #ffd700; /* Warna bintang saat di-hover */
}

/* Check effect: Bintang yang dipilih dan bintang di sebelah kirinya (nilai lebih tinggi) */
.rating-stars input:checked ~ label {
    color: #ffd700; /* Warna bintang saat sudah di-rating */
}
</style>

<div class="container my-5">
    <h2 class="text-orange fw-bold mb-5">⭐ Tambah Review Pesanan #{{ $pesanan->id }}</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show review-success-alert" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('pesanan.submitReview', $pesanan->id) }}" method="POST">
        @csrf
        @foreach($pesanan->items as $index => $item)
            <div class="card mb-4 review-card">
                <h5>{{ $item->produk->nama_produk }}</h5>
                <input type="hidden" name="produk_id[]" value="{{ $item->produk->id }}">

                {{-- Bagian Rating Bintang --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Penilaian Produk</label>
                    <div class="rating-stars">
                        @for ($i = 5; $i >= 1; $i--)
                            <input type="radio" id="star{{ $index }}_{{ $i }}" name="rating[{{ $index }}]" value="{{ $i }}" required>
                            <label for="star{{ $index }}_{{ $i }}"><i class="fas fa-star"></i></label>
                        @endfor
                    </div>
                    @error('rating.' . $index)
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Bagian Komentar --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Komentar Anda</label>
                    <textarea name="komentar[]" class="form-control" rows="3" placeholder="Bagaimana pendapat Anda tentang produk ini?" required></textarea>
                    @error('komentar.' . $index)
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        @endforeach

        <div class="d-flex gap-3 mt-4">
            <button type="submit" class="btn btn-orange">
                <i class="fas fa-paper-plane me-1"></i> Kirim Semua Review
            </button>
            <a href="{{ route('pesanan.index') }}" class="btn btn-outline-orange">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Pesanan Saya
            </a>
        </div>
    </form>
</div>
@endsection
