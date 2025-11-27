@extends('dashboard.layout')
@section('konten')

<style>
/* =========================================
   1. Variabel & Global Styling
   ========================================= */
:root {
    --primary-orange: #f77f00;
    --secondary-orange: #e06629;
    --text-color: #343a40;
    --muted-color: #6c757d;
    --border-color: #e9ecef;
    --danger-color: #dc3545;
}

/* Warna Utama */
.text-orange { color: var(--primary-orange) !important; }

/* Font dan Background Card */
.card {
    border-radius: 12px; /* Lebih standar */
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08); /* Shadow yang bersih */
    margin-bottom: 25px;
    border: none;
    background-color: white;
}

/* =========================================
   2. Tabel Produk
   ========================================= */
.table-product th, .table-product td {
    vertical-align: middle;
    padding: 12px; /* Padding yang cukup */
    font-size: 0.9rem; /* Ukuran teks standar */
}
.table-product thead {
    background-color: #f8f9fa; /* Latar belakang header yang netral */
    color: var(--text-color);
}
.product-img {
    width: 50px; /* Ukuran gambar sedikit dikecilkan */
    height: 50px;
    object-fit: cover;
    border-radius: 6px;
    border: 1px solid #eee;
}
.stok-status {
    font-weight: 500;
}
.stok-habis {
    color: var(--danger-color);
}
.stok-tersedia {
    color: #28a745;
}

/* =========================================
   3. Ringkasan & Total
   ========================================= */
.summary-box {
    padding-top: 15px;
}
.summary-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
    font-size: 0.95rem;
    color: var(--muted-color);
}
.summary-item strong {
    font-weight: 600;
    color: var(--text-color);
}
.total-item {
    font-size: 1.4rem; /* Ukuran total yang menonjol */
    font-weight: 700;
    margin-top: 15px;
    padding-top: 15px;
    border-top: 2px solid var(--border-color);
    color: var(--primary-orange);
}

/* Informasi Alamat */
.address-info {
    font-size: 0.95rem;
    line-height: 1.5;
}

/* =========================================
   4. Tombol Aksi
   ========================================= */
.btn-orange {
    background: linear-gradient(90deg, var(--primary-orange), var(--secondary-orange));
    color: white;
    border-radius: 8px; /* Lebih kecil, lebih profesional */
    font-weight: 600;
    padding: 12px 0; /* Padding lebih kecil */
    font-size: 1.0rem; /* Ukuran font tombol lebih moderat */
    transition: all 0.3s ease;
    border: none;
}
.btn-orange:hover:not(:disabled) {
    opacity: 0.9;
    color: white;
}
.btn-orange:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

/* Modal Styling */
#codModal .modal-content {
    border-radius: 12px;
}
#codModal h4 {
    font-weight: 600;
}
</style>

<div class="container my-5">
    <h2 class="text-orange fw-bold mb-4">Konfirmasi Pesanan</h2>

    @if(isset($pesanan) && $pesanan && $pesanan->items->count() > 0)
        @php
            // Variabel $subtotal, $ongkir, dan $total sudah dikirim dari controller (beliSekarang)
            // Jadi, kita hanya perlu cek kondisi stok habis
            $stokHabis = $pesanan->items->contains(function($i){
                return $i->produk->stok == 0 || $i->jumlah > $i->produk->stok;
            });
        @endphp

        <div class="card p-4">

            {{-- Bagian Tabel Produk --}}
            <h4 class="mb-3 fw-bold" style="font-size: 1.15rem;">Rincian Produk</h4>
            <div class="table-responsive mb-4">
                <table class="table table-product align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th class="text-end">Harga Satuan</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-end">Subtotal Item</th>
                            <th class="text-center">Stok Saat Ini</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesanan->items as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/' . $item->produk->gambar) }}" class="product-img me-3" alt="{{ $item->produk->nama_produk }}">
                                    <span class="fw-semibold">{{ $item->produk->nama_produk }}</span>
                                </div>
                            </td>
                            <td class="text-end">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $item->jumlah }}</td>
                            <td class="text-end fw-semibold">Rp {{ number_format($item->harga * $item->jumlah, 0, ',', '.') }}</td>
                            <td class="text-center">
                                @if($item->produk->stok == 0 || $item->jumlah > $item->produk->stok)
                                    <span class="stok-status stok-habis">Stok Habis ({{ $item->produk->stok }})</span>
                                @else
                                    <span class="stok-status stok-tersedia">Tersedia ({{ $item->produk->stok }})</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Bagian Ringkasan & Total --}}
            <div class="row">
                <div class="col-md-7 mb-4">
                    <h4 class="fw-bold mb-3" style="font-size: 1.15rem;">Informasi Pengiriman</h4>
                    <div class="card p-3 bg-light address-info">
                        <p class="mb-1"><strong>Alamat Pengiriman:</strong></p>
                        <p class="mb-0">{{ $alamat }}, {{ $kota }}, {{ $provinsi }}</p>
                    </div>
                </div>

                <div class="col-md-5 summary-box">
                    <h4 class="fw-bold mb-3" style="font-size: 1.15rem;">Ringkasan Pembayaran</h4>
                    <div class="summary-item">
                        <span>Sub total produk:</span>
                        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="summary-item">
                        <span>Biaya Pengiriman (Ongkir):</span>
                        <span>Rp {{ number_format($ongkir, 0, ',', '.') }}</span>
                    </div>

                    <div class="summary-item total-item">
                        <span class="fw-bolder">TOTAL PEMBAYARAN:</span>
                        <span class="fw-bolder text-orange">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- Tombol Checkout --}}
            <div class="mt-4">
                <button
                    id="btnBayar"
                    data-id="{{ $pesanan->id ?? '' }}"
                    class="btn btn-orange w-100"
                    @if($stokHabis) disabled @endif
                >
                    <i class="fas fa-credit-card me-2"></i> Konfirmasi & Bayar (COD)
                </button>
            </div>

            @if($stokHabis)
                <div class="alert alert-danger mt-3 text-center" role="alert" style="font-size: 0.9rem;">
                    <i class="fas fa-exclamation-triangle me-2"></i> Mohon maaf, ada **produk yang stoknya habis atau jumlahnya melebihi stok**. Harap perbaiki pesanan di keranjang Anda.
                </div>
            @endif
        </div>
    @else
        <div class="alert alert-light text-center py-5 border rounded-3" role="alert">
            <i class="fas fa-shopping-cart fa-3x mb-3 text-muted"></i>
            <h5 class="text-muted">Keranjang Anda Kosong.</h5>
            <p>Tidak ada item untuk dikonfirmasi dan di-checkout.</p>
        </div>
    @endif
</div>

{{-- MODAL COD --}}
<div class="modal fade" id="codModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="text-center">
                <i class="fas fa-box-open fa-3x text-orange mb-3"></i>
                <h4 class="text-orange fw-bold mb-3">Pesanan Berhasil Dibuat</h4>
                <p class="text-muted" style="font-size: 0.95rem;">Pesanan Anda telah berhasil dikonfirmasi dan akan segera diproses untuk pengiriman (metode COD).</p>
                {{-- Menggunakan variabel $total yang sudah benar dari controller --}}
                <p class="fw-bold mt-3" style="font-size: 1.1rem;">Total Pembayaran: <span class="text-orange">Rp {{ number_format($total ?? 0, 0, ',', '.') }}</span></p>
                <button id="okCOD" class="btn btn-orange w-100 mt-3">Lanjutkan ke Riwayat Pesanan</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('btnBayar')?.addEventListener('click', function() {
    var pesananId = this.dataset.id || null;

    // Cek stok habis (redundansi, tapi baik untuk JS check)
    if (this.disabled) {
        Swal.fire({
            icon: 'error',
            title: 'Gagal Checkout!',
            text: 'Ada produk dengan stok habis/berlebih. Mohon perbaiki pesanan di keranjang.',
            confirmButtonColor: 'var(--primary-orange)'
        });
        return;
    }

    // Tampilkan modal COD/Konfirmasi
    // Gunakan class Bootstrap 5 untuk inisialisasi Modal
    var codModal = new bootstrap.Modal(document.getElementById('codModal'));
    codModal.show();

    // Ketika tombol 'Lanjutkan ke Riwayat Pesanan' di modal diklik
    document.getElementById('okCOD').addEventListener('click', function() {
        // Panggil endpoint backend untuk menyelesaikan pesanan (COD)
        // Jika ini dari 'beliSekarang', kita akan memproses semua item yang dicentang di keranjang
        // Karena proses pembayaran final dari alur 'beliSekarang' tidak ada dalam file ini,
        // kita asumsikan 'pesananId' adalah ID keranjang yang akan diproses di /pesanan/bayar/{id}.

        let url = `/pesanan/bayar/${pesananId}`;

        fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }
        })
        .then(res => {
            codModal.hide();
            return res.json();
        })
        .then(data => {
            if(data.success){
                Swal.fire({
                    icon: 'success',
                    title: 'Pesanan Berhasil Dibuat!',
                    text: 'Pesanan Anda telah dikonfirmasi dan menunggu pengiriman.',
                    confirmButtonColor: 'var(--primary-orange)',
                }).then(() => {
                    // Redirect ke halaman riwayat pesanan user setelah sukses
                    window.location.href = "{{ route('pesananuser.lihat') }}";
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: data.message || 'Terjadi kesalahan saat memproses pesanan.',
                    confirmButtonColor: 'var(--primary-orange)',
                });
            }
        })
        .catch(err => {
            codModal.hide();
            console.error('Fetch error:', err);
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Terjadi kesalahan koneksi saat memproses pesanan.',
                confirmButtonColor: 'var(--primary-orange)',
            });
        });

    }, { once: true });
});
</script>

@endsection
