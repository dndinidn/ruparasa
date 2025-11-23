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
}
</style>

<div class="container py-5">
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
    @endif
</div>

<script>
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
</script>

@endsection
