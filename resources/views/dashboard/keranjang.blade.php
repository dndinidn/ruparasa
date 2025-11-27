<<<<<<< HEAD
@extends('dashboard.layout')
@section('konten')

<style>
/* Import Google Font - Poppins (Diasumsikan sudah ada di layout) */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

/* =========================================
   1. Variabel Warna & Global
   ========================================= */
:root {
    --primary-orange: #ff7e00; /* Oranye Utama (#ff7e00) */
    --secondary-orange: #e06629;
    --text-color: #343a40;
    --muted-color: #6c757d;
    --border-color: #e9ecef;
}

body {
    /* Terapkan font Poppins */
    font-family: 'Poppins', sans-serif;
    background-color: #f8f9fa;
}

.text-orange-main { color: var(--primary-orange) !important; }

/* =========================================
   2. Tombol Aksi
   ========================================= */

/* Tombol Checkout (BELI SEKARANG) - Menggunakan warna solid */
.btn-checkout {
    background-color: var(--primary-orange); /* Warna Solid */
    color: white;
    border-radius: 8px;
    font-weight: 700;
    padding: 12px 20px;
    transition: all 0.3s ease;
    border: none;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 10px rgba(255, 126, 0, 0.3); /* Tetap berikan shadow */
}
.btn-checkout:hover:not(:disabled) {
    background-color: var(--secondary-orange); /* Warna sedikit gelap saat hover */
    opacity: 1;
    box-shadow: 0 6px 15px rgba(255, 126, 0, 0.4);
}
.btn-checkout:disabled {
    cursor: not-allowed;
    opacity: 0.6 !important;
    box-shadow: none;
    background-color: var(--primary-orange); /* Pastikan warna dasar tetap, hanya opacity yang berkurang */
}

/* Tombol Kembali (Oranye Solid) */
.btn-back {
    background-color: var(--primary-orange);
    color: white !important;
    border: 1px solid var(--primary-orange);
    border-radius: 8px;
    padding: 8px 16px;
    font-weight: 500;
    text-decoration: none;
    transition: 0.3s ease;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
.btn-back:hover {
    background-color: var(--secondary-orange);
    border-color: var(--secondary-orange);
}

/* Tombol Hapus (Merah Solid - untuk kejelasan) */
.btn-hapus-icon {
    color: #dc3545; /* Merah Solid */
    background-color: transparent;
    border: none;
    padding: 0;
    font-size: 1rem;
    cursor: pointer;
    transition: color 0.3s ease;
    align-self: flex-end;
    margin-top: 5px;
    text-decoration: none;
    font-weight: 600;
}
.btn-hapus-icon:hover {
    color: #c82333; /* Merah yang sedikit lebih gelap saat di-hover */
}


/* =========================================
   3. Item Keranjang
   ========================================= */
.card-item {
    border-radius: 12px;
    background: white;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    padding: 20px;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 20px;
    border-left: 5px solid var(--primary-orange);
}
.product-img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #f2f2f2;
}
.info { flex: 1; }
.info h5 {
    font-weight: 600;
    color: var(--text-color);
    margin-bottom: 5px;
}
.info .price {
    color: var(--primary-orange);
    font-size: 1.1rem;
    font-weight: 700;
}

/* Input Kuantitas */
.qty-item {
    width: 70px;
    text-align: center;
    border-radius: 6px;
    border: 1px solid var(--border-color);
    padding: 5px;
    transition: border-color 0.3s;
}
.qty-item:focus {
    border-color: var(--primary-orange);
    box-shadow: 0 0 0 0.25rem rgba(255, 126, 0, 0.25);
}

/* Checkbox Styling */
.chk-item {
    transform: scale(1.2);
    cursor: pointer;
    accent-color: var(--primary-orange);
}

/* =========================================
   4. Ringkasan Total
   ========================================= */
.card-summary {
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    background-color: white;
    padding: 25px;
    border: 1px solid var(--border-color);
}
.card-summary h5 {
    border-bottom: 2px solid var(--border-color);
    padding-bottom: 10px;
    margin-bottom: 15px;
    font-weight: 700;
    color: var(--text-color);
}
#totalHarga {
    font-size: 1.75rem;
    font-weight: 800;
    color: var(--primary-orange);
=======
@extends('dashboard.master')
@section('konten')

<style>
.text-orange { color: #f77f00 !important; }
.btn-orange {
    background: linear-gradient(90deg, #f77f00, #e06629);
    color: white;
    border-radius: 12px;
    font-weight: 600;
    padding: 10px 0;
    transition: all 0.3s ease;
}
.btn-orange:hover { opacity: 0.85; }

.card-item {
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    padding: 15px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
}
.product-img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 10px;
}
.info {
    flex: 1;
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
}
</style>

<div class="container py-5">
<<<<<<< HEAD

    {{-- TOMBOL KEMBALI (Oranye) --}}
    <a href="{{ route('toko.index') }}" class="btn-back mb-4 d-inline-flex align-items-center">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>

    <h2 class="text-orange-main fw-bold mb-5">Keranjang Belanja</h2>

    @if(isset($pesanan) && $pesanan->items->count() > 0)
    <div class="row">
        {{-- BAGIAN KIRI: DAFTAR ITEM --}}
        <div class="col-lg-8">
            <form id="checkoutForm" action="{{ route('pesanan.beliSekarang') }}" method="POST">
                @csrf

                @foreach($pesanan->items as $item)
                <div class="card-item" id="item-{{ $item->id }}">

                    {{-- Checkbox --}}
                    <input type="checkbox"
                        name="checkout[]"
                        value="{{ $item->id }}"
                        class="chk-item flex-shrink-0"
                        checked
                        data-id="{{ $item->id }}"
                        data-harga="{{ $item->harga }}">

                    {{-- Gambar --}}
                    <img src="{{ asset('storage/' . $item->produk->gambar) }}" class="product-img flex-shrink-0" alt="{{ $item->produk->nama_produk }}">

                    {{-- Info Produk --}}
                    <div class="info">
                        <h5 class="m-0">{{ $item->produk->nama_produk }}</h5>
                        <p class="m-0 price">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                    </div>

                    {{-- Jumlah & Hapus --}}
                    <div class="actions d-flex flex-column align-items-end flex-shrink-0">

                        <input type="number"
                            name="jumlah_{{ $item->id }}"
                            class="form-control qty-item"
                            value="{{ $item->jumlah }}"
                            min="1"
                            data-id="{{ $item->id }}"
                            data-harga="{{ $item->harga }}">

                        {{-- Tombol Hapus (Merah) --}}
                        <button type="button"
                            class="btn-hapus-icon"
                            onclick="hapusItem({{ $item->id }})">
                            <i class="fas fa-trash-alt me-1"></i> Hapus
                        </button>
                    </div>
                </div>
                @endforeach
            </form>
        </div>

        {{-- BAGIAN KANAN: RINGKASAN TOTAL --}}
        <div class="col-lg-4">
            <div class="card card-summary sticky-top" style="top: 20px;">
                <h5 class="fw-bold">Ringkasan Pesanan</h5>

                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Subtotal Produk</span>
                    <span id="subTotal" class="fw-semibold text-color">
                        Rp {{ number_format($pesanan->items->sum(fn($i)=> $i->harga * $i->jumlah), 0, ',', '.') }}
                    </span>
                </div>

                

                <hr class="my-3">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <span class="fw-bold fs-5">TOTAL BELANJA</span>
                    <span id="totalHarga" class="fw-bold text-orange-main">
                        Rp {{ number_format($pesanan->items->sum(fn($i)=> $i->harga * $i->jumlah), 0, ',', '.') }}
                    </span>
                </div>

                {{-- Tombol Checkout dengan ID untuk JS --}}
                <button type="submit" form="checkoutForm" class="btn btn-checkout w-100" id="btnCheckout">
                    <i class="fas fa-credit-card me-2"></i> BELI SEKARANG
                </button>
            </div>
        </div>
    </div>

    @else
        <p class="text-center text-muted py-5 border rounded-lg bg-light">
            <i class="fas fa-shopping-cart fa-2x mb-3 text-orange-main"></i>
            <br>Keranjang belanja Anda kosong. Yuk, cari produk favorit Anda!
        </p>
=======
    <h2 class="text-orange fw-bold mb-4">Keranjang Belanja</h2>

    @if(isset($pesanan) && $pesanan->items->count() > 0)
    <form action="{{ route('pesanan.beliSekarang') }}" method="POST">
        @csrf

        @foreach($pesanan->items as $item)
        <div class="card-item" id="item-{{ $item->id }}">

            {{-- Checkbox --}}
            <input type="checkbox"
                   name="checkout[]"
                   value="{{ $item->id }}"
                   class="chk-item"
                   checked
                   data-id="{{ $item->id }}"
                   data-harga="{{ $item->harga }}">

            {{-- Gambar Produk --}}
            <img src="{{ asset('storage/' . $item->produk->gambar) }}"
                 class="product-img">

            {{-- Info Produk --}}
            <div class="info">
                <h5>{{ $item->produk->nama_produk }}</h5>
                <p class="m-0">Harga: Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
            </div>

            {{-- Aksi --}}
            <div class="actions text-end">

                <input type="number"
                       class="form-control qty-item mb-2"
                       value="{{ $item->jumlah }}"
                       min="1"
                       data-id="{{ $item->id }}"
                       data-harga="{{ $item->harga }}">

                <button type="button"
                        class="btn btn-danger btn-sm"
                        onclick="hapusItem({{ $item->id }})">
                    Hapus
                </button>
            </div>
        </div>
        @endforeach

        {{-- Total --}}
        <div class="card p-3 mb-3">
            <h5 class="fw-bold">Total Pesanan</h5>
            <p class="m-0" id="totalHarga">
                Rp {{ number_format($pesanan->items->sum(fn($i)=> $i->harga * $i->jumlah), 0, ',', '.') }}
            </p>
        </div>

        <button type="submit" class="btn btn-orange w-100 mt-3">
            Beli Sekarang
        </button>

    </form>
    @else
        <p class="text-center text-muted py-4">Keranjang masih kosong.</p>
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
    @endif
</div>

<script>
<<<<<<< HEAD
    /* =========================================
        Hapus Item
        ========================================= */
    function hapusItem(id) {
        if (!confirm("Yakin ingin menghapus item ini dari keranjang?")) return;

        fetch('/pesanan/item/' + id, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').content : '{{ csrf_token() }}',
                "Content-Type": "application/json"
            }
        })
        .then(res => {
            if (!res.ok) throw new Error('Penghapusan gagal');
            return res.json();
        })
        .then(() => {
            const itemElement = document.getElementById("item-" + id);
            if (itemElement) {
                itemElement.remove();
                hitungTotal();
            }
            if (document.querySelectorAll('.card-item').length === 0) {
                location.reload();
            }
        })
        .catch(error => console.error('Error saat menghapus item:', error));
    }

    /* =========================================
        Hitung Total & Cek Status Tombol Checkout
        ========================================= */
    function hitungTotal() {
        let total = 0;
        let subtotalText = 0;
        const btnCheckout = document.getElementById("btnCheckout");

        document.querySelectorAll(".chk-item").forEach(chk => {
            if (chk.checked) {
                let id = chk.dataset.id;
                let harga = parseInt(chk.dataset.harga);
                let qtyInput = document.querySelector('.qty-item[data-id="'+ id +'"]');
                let qty = qtyInput ? parseInt(qtyInput.value) : 0;

                subtotalText += harga * qty;
                total += harga * qty;
            }
        });

        // Fungsi format mata uang Rupiah
        const formatRupiah = (angka) => {
            return "Rp " + angka.toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 0 });
        }

        document.getElementById("subTotal").innerText = formatRupiah(subtotalText);
        document.getElementById("totalHarga").innerText = formatRupiah(total);

        // LOGIC DISABLE/ENABLE TOMBOL CHECKOUT
        if (btnCheckout) {
            if (total > 0) {
                btnCheckout.disabled = false;
                btnCheckout.style.opacity = 1;
            } else {
                btnCheckout.disabled = true;
                btnCheckout.style.opacity = 0.6;
            }
        }
    }

    /* =========================================
        Update Qty ke DB
        ========================================= */
    document.querySelectorAll(".qty-item").forEach(qty => {
        qty.addEventListener("change", function() {
            let id = this.dataset.id;
            let jumlah = parseInt(this.value);

            if (jumlah < 1) {
                this.value = 1;
                jumlah = 1;
            }

            fetch('/pesanan/update-item/' + id, {
                method: 'POST',
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').content : '{{ csrf_token() }}',
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ jumlah })
            })
            .then(res => {
                if (!res.ok) throw new Error('Update kuantitas gagal');
                return res.json();
            })
            .then(() => hitungTotal())
            .catch(error => console.error('Error saat update kuantitas:', error));
        });
    });

    /* Checkbox Listener */
    document.querySelectorAll(".chk-item").forEach(chk => {
        chk.addEventListener("change", hitungTotal);
    });

    // Panggil hitungTotal saat halaman pertama kali dimuat
    document.addEventListener('DOMContentLoaded', hitungTotal);
=======
/* ==============================
   Hapus Item
   ============================== */
function hapusItem(id) {
    if (!confirm("Yakin ingin menghapus item ini?")) return;

    fetch('/pesanan/item/' + id, {
        method: "DELETE",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json"
        }
    })
    .then(res => res.ok ? res.json() : null)
    .then(() => {
        document.getElementById("item-" + id).remove();
        hitungTotal();
    });
}

/* ==============================
   Hitung Total Dinamis
   ============================== */
function hitungTotal() {
    let total = 0;

    document.querySelectorAll(".chk-item").forEach(chk => {
        if (chk.checked) {
            let id = chk.dataset.id;
            let harga = parseInt(chk.dataset.harga);
            let qty = parseInt(document.querySelector('.qty-item[data-id="'+ id +'"]').value);
            total += harga * qty;
        }
    });

    document.getElementById("totalHarga").innerText =
        "Rp " + total.toLocaleString('id-ID');
}

/* Event Listener */
document.querySelectorAll(".chk-item").forEach(chk => {
    chk.addEventListener("change", hitungTotal);
});

document.querySelectorAll(".qty-item").forEach(qty => {
    qty.addEventListener("input", hitungTotal);
});
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
</script>

@endsection
