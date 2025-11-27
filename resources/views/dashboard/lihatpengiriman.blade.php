@extends('dashboard.layout')

@section('konten')

<style>
/* =========================================
   1. Variabel Warna & Font
   ========================================= */
:root {
    --primary-orange: #ff7e00;
    --danger-red: #dc3545;
    --success-green: #198754;
    --text-color: #343a40;
    --muted-color: #6c757d;
}

/* Mengganti warna dasar text-orange dengan variabel */
.text-orange {
    color: var(--primary-orange) !important;
}

/* Mengganti warna tombol sukses agar sesuai dengan skema */
.btn-success {
    background-color: var(--success-green);
    border-color: var(--success-green);
}

/* =========================================
   2. Card Pesanan Styling (Kekinian)
   ========================================= */
.order-card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08); /* Shadow yang lebih lembut dan menonjol */
    transition: transform 0.3s ease;
    overflow: hidden; /* Agar border-radius diterapkan dengan baik */
}

.order-card:hover {
    transform: translateY(-3px);
}

.order-card .card-header {
    background-color: #fff8f2; /* Latar belakang header yang lebih hangat */
    border-bottom: 2px solid var(--primary-orange);
    color: var(--text-color);
    font-size: 1.1rem;
    padding: 15px 20px;
}

.order-card .card-body {
    padding: 20px;
}

/* Styling Detail Item */
.item-detail {
    list-style: none;
    padding-left: 0;
    margin-bottom: 10px;
}
.item-detail li {
    padding: 5px 0;
    border-bottom: 1px dashed #eee;
    color: var(--muted-color);
    font-size: 0.95rem;
}
.item-detail li:last-child {
    border-bottom: none;
}
.item-detail .product-name {
    font-weight: 500;
    color: var(--text-color);
}

/* Styling Status */
.status-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 50rem;
    font-weight: 600;
    text-transform: capitalize;
    font-size: 0.9rem;
    margin-top: 5px;
}

/* Status: Dikirim */
.status-dikirim {
    background-color: #fff3cd; /* Kuning Muda */
    color: #856404; /* Kuning Tua */
}
/* Status: Selesai */
.status-selesai {
    background-color: #d4edda; /* Hijau Muda */
    color: var(--success-green);
}
/* Status: Lainnya (misalnya menunggu pembayaran) */
.status-default {
    background-color: #e9ecef;
    color: var(--muted-color);
}


/* =========================================
   3. Tombol Aksi Kustom (Review)
   ========================================= */
.review-btn {
    background-color: var(--primary-orange);
    color: #fff;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 8px; /* Lebih bulat dari 5px */
    text-decoration: none;
    font-weight: 600;
    transition: background-color 0.3s ease;
    box-shadow: 0 2px 4px rgba(255, 126, 0, 0.2);
}
.review-btn:hover {
    background-color: var(--secondary-orange);
    color: #fff;
    box-shadow: 0 4px 8px rgba(255, 126, 0, 0.3);
}

/* Mengubah style Tombol Terima Pesanan */
.btn-success {
    border-radius: 8px;
    font-weight: 600;
}
</style>

<div class="container my-5">
    <h2 class="text-orange fw-bold mb-5">🛍️ Pesanan Saya</h2>

    @forelse($pesanan as $p)
        <div class="card order-card mb-4">
            {{-- HEADER PESANAN --}}
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="fw-bold">
                    Pesanan #{{ $p->id }}
                </div>
                <div>
                    Total Belanja:
                    <span class="text-orange fw-bolder">
                        Rp {{ number_format($p->items->sum(fn($i) => $i->harga * $i->jumlah) + ($p->ongkir ?? 0), 0, ',', '.') }}
                    </span>
                </div>
            </div>

            {{-- BODY DETAIL PESANAN --}}
            <div class="card-body">
                <div class="row">
                    {{-- Detail Item --}}
                    <div class="col-md-8">
                        <p class="fw-bold mb-2">Detail Produk:</p>
                        <ul class="item-detail">
                            @foreach($p->items as $item)
                                <li>
                                    <span class="product-name">{{ $item->produk->nama_produk }}</span>
                                    <span class="float-end">x {{ $item->jumlah }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Status dan Aksi --}}
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        {{-- Badge Status --}}
                        <p class="mb-2">Status Pesanan:</p>
                        @php
                            $statusClass = '';
                            if ($p->status === 'dikirim') {
                                $statusClass = 'status-dikirim';
                            } elseif ($p->status === 'selesai') {
                                $statusClass = 'status-selesai';
                            } else {
                                $statusClass = 'status-default';
                            }
                        @endphp
                        <span class="status-badge {{ $statusClass }}">{{ ucfirst($p->status) }}</span>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex gap-3 mt-4 justify-content-end">

                    @if($p->status === 'dikirim')
                        <form id="form-terima-{{ $p->id }}" action="{{ route('pesanan.terima', $p->id) }}" method="POST">
                            @csrf
                            <button type="button" class="btn btn-success" onclick="konfirmasiTerima({{ $p->id }})">
                                <i class="fas fa-check me-1"></i> Pesanan Diterima
                            </button>
                        </form>
                    @endif

                    @if($p->status === 'selesai')
                        <a href="{{ route('pesanan.review', $p->id) }}" class="btn review-btn">
                            <i class="fas fa-star me-1"></i> Beri Ulasan
                        </a>
                    @endif

                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-light text-center py-5 border rounded-lg" role="alert">
            <i class="fas fa-box-open fa-3x mb-3 text-muted"></i>
            <h5 class="text-muted">Belum ada riwayat pesanan.</h5>
            <p>Mulai belanja sekarang dan riwayat pesanan Anda akan muncul di sini.</p>
        </div>
    @endforelse
</div>

{{-- Memastikan SweetAlert2 terinclude --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function konfirmasiTerima(id) {
    Swal.fire({
        title: 'Konfirmasi Penerimaan',
        text: 'Pastikan pesanan Anda sudah diterima dengan baik dan tidak ada masalah sebelum menekan tombol ini. Tindakan ini akan menyelesaikan pesanan.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="fas fa-check me-1"></i> Ya, Pesanan Sudah Diterima',
        cancelButtonText: '<i class="fas fa-times me-1"></i> Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('form-terima-' + id).submit();
        }
    });
}

// Menambahkan ikon Font Awesome jika belum ada
// Pastikan Anda sudah menyertakan library Font Awesome di layout utama Anda.
</script>
@endsection
