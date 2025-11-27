@extends('dashboard.master')
<<<<<<< HEAD

@section('konten')
<div class="header-resep text-center py-5 mb-5">
    <div class="header-overlay">
        <h1 class="fw-bold text-uppercase mb-2 title-white">{{ $produk->nama_produk }}</h1>
    </div>
</div>

<div class="container py-5">
    
    {{-- KONTROL ATAS: Tombol Kembali & Tombol Keranjang --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('produk', $produk->penjual_id) }}" class="btn btn-outline-orange">&larr; Kembali ke Produk</a>

        <a href="{{ route('pesanan.keranjang') }}" class="btn btn-orange position-relative d-flex align-items-center">
            <i class="bi bi-cart-fill me-1"></i>
            @if(session('keranjang_count') > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge bg-danger rounded-pill p-1">
                    {{ session('keranjang_count') }}
                </span>
            @endif
        </a>
    </div>
    
    {{-- ALERT sukses keranjang --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    <div class="row">
        <div class="col-md-6">
            @if($produk->gambar)
                <img src="{{ asset('storage/' . $produk->gambar) }}" class="img-fluid rounded" alt="{{ $produk->nama_produk }}">
            @else
                <img src="{{ asset('img/default.png') }}" class="img-fluid rounded" alt="Default">
            @endif
        </div>

        <div class="col-md-6">
            <h2 class="text-orange fw-bold">{{ $produk->nama_produk }}</h2>
            <p class="text-muted mb-2">
                <i class="bi bi-person-fill text-orange"></i> {{ $produk->penjual->nama ?? 'Penjual' }}
            </p>
            <h4 class="text-dark fw-bold mb-2">Rp {{ number_format($produk->harga,0,',','.') }}</h4>
            <p class="mb-2"><strong>Stok:</strong> {{ $produk->stok }}</p>
            <p class="mb-4"><strong>Deskripsi:</strong> {{ $produk->deskripsi }}</p>

            <div class="mb-3 d-flex align-items-center gap-2">
                <label class="mb-0 fw-semibold">Jumlah:</label>
                <input type="number" value="1" min="1" max="{{ $produk->stok }}" class="form-control jumlah" style="width:60px">
            </div>

            <div class="d-flex gap-2 mb-4">
                {{-- Tombol Beli Sekarang --}}
                <form action="{{ route('pesanan.beli', $produk->id) }}" method="POST" class="beli-form flex-fill">
                    @csrf
                    <input type="hidden" name="jumlah" value="1" class="jumlah-input">
                    <button type="submit" class="btn btn-primary w-100"
                        @if($produk->stok == 0) disabled @endif>
                        @if($produk->stok == 0) Stok Habis @else Beli Sekarang @endif
                    </button>
                </form>

                {{-- Tombol Tambah ke Keranjang --}}
                <form action="{{ route('pesanan.keranjang.tambah', $produk->id) }}" method="POST" class="keranjang-form flex-fill">
                    @csrf
                    <input type="hidden" name="jumlah" value="1" class="jumlah-input">
                    <button type="submit" class="btn btn-outline-orange w-100"
                        @if($produk->stok == 0) disabled @endif>
                        @if($produk->stok == 0) Stok Habis @else Tambah Keranjang @endif
                    </button>
                </form>
            </div>
        </div>
    </div>

<div class="mt-5">
    <h4 class="text-orange fw-bold mb-3">Review Pengguna</h4>
    @forelse($produk->reviews as $review)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <p class="mb-1"><strong>{{ $review->user->name ?? 'User' }}</strong> 
                    <span class="text-warning">{{ str_repeat('★', $review->rating) }}</span>
                </p>
                <p class="mb-0">{{ $review->komentar }}</p>

                @if($review->balasan_penjual)
                    <div class="mt-2 p-2 bg-light rounded">
                        <strong>Balasan Penjual:</strong>
                        <p class="mb-0">{{ $review->balasan_penjual }}</p>
                    </div>
                @endif

                <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
            </div>
        </div>
    @empty
        <p class="text-muted">Belum ada review untuk produk ini.</p>
    @endforelse
</div>

</div>

<script>
const jumlahInput = document.querySelector('.jumlah');
const maxStok = {{ $produk->stok }};

jumlahInput.addEventListener('input', function() {
    let value = Math.floor(Number(this.value)); // Buat bulat dan hilangkan desimal

    if(value < 1) value = 1; // Minimal 1
    if(value > maxStok) value = maxStok; // Maksimal stok

    this.value = value;

    // Update semua input hidden
    document.querySelectorAll('.jumlah-input').forEach(input => {
        input.value = value;
    });
});

// Pastikan input hidden terupdate saat submit (cadangan)
document.querySelectorAll('.beli-form, .keranjang-form').forEach(form => {
    form.addEventListener('submit', function() {
        this.querySelector('.jumlah-input').value = jumlahInput.value;
    });
});
</script>

<style>
.header-resep {
    background: url('/images/produk.png') center center/cover no-repeat;
    border-radius: 0 0 20px 20px;
    height: 300px;
    display: flex; align-items: center; justify-content: center;
}
.header-overlay { background-color: rgba(220, 212, 212, 0.45); padding: 40px; border-radius: 15px; }
.title-white, .subtitle-white { color: #fff; text-shadow: 1px 1px 8px rgba(0,0,0,0.5); }

.text-orange { color: #f77f00 !important; }

.btn-primary, .btn-orange { 
    background-color: #f77f00; 
    border-color: #f77f00; 
    color: #fff; 
}
.btn-primary:hover, .btn-orange:hover { 
    background-color: #e56e00; 
    border-color: #e56e00; 
}

.btn-outline-orange { 
    border: 1px solid #f77f00; 
    color: #f77f00; 
    background-color: transparent; 
}
.btn-outline-orange:hover { 
    background: #f77f00; 
    color: #fff; 
}

.badge.bg-danger {
    padding: .3em .6em !important;
    font-size: .75em;
    font-weight: 700;
}
</style>
@endsection
=======
@section('konten')

@endsection
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
