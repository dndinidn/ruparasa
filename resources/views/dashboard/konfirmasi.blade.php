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

.card {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    margin-bottom: 20px;
}

.table th, .table td {
    vertical-align: middle;
}

.product-img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
}
</style>

<div class="container my-5">
    <h2 class="text-orange fw-bold mb-4">Konfirmasi Pesanan</h2>

    @if($pesanan && $pesanan->items->count() > 0)
        <div class="card p-4">
            <table class="table table-bordered align-middle mb-3">
                <thead class="table-light">
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pesanan->items as $item)
                    <tr>
                        <td class="d-flex align-items-center">
                            <img src="{{ asset('storage/' . $item->produk->gambar) }}" class="product-img me-2">
                            {{ $item->produk->nama_produk }}
                        </td>
                        <td>Rp {{ number_format($item->harga,0,',','.') }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>Rp {{ number_format($item->harga * $item->jumlah,0,',','.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Ringkasan --}}
            <div class="mt-3 mb-3">
                <p><strong>Alamat:</strong> {{ $pesanan->alamat }}, {{ $pesanan->kota }}, {{ $pesanan->provinsi }}</p>
                <p><strong>Sub total pesanan:</strong> Rp {{ number_format($pesanan->items->sum(fn($i)=> $i->harga * $i->jumlah),0,',','.') }}</p>
                <p><strong>Ongkir:</strong> Rp {{ number_format($pesanan->ongkir ?? 0,0,',','.') }}</p>
                <p><strong>Total:</strong> Rp {{ number_format($pesanan->total ?? $pesanan->items->sum(fn($i)=> $i->harga * $i->jumlah),0,',','.') }}</p>
            </div>

            {{-- Tombol Checkout / Pesan --}}
            <button id="btnBayar" class="btn btn-orange w-100 fw-semibold">Checkout</button>
        </div>
    @else
        <p class="text-center text-muted py-4">Belum ada pesanan.</p>
    @endif
</div>

{{-- MODAL COD --}}
<div class="modal fade" id="codModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3 text-center">
        <h5 class="text-orange fw-bold mb-3">Pesanan Berhasil</h5>
        <p>Pesanan Anda akan dikirim (COD). Terima kasih!</p>
        <button id="okCOD" class="btn btn-orange w-100" data-bs-dismiss="modal">Selesai</button>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('btnBayar')?.addEventListener('click', function(){
    var codModal = new bootstrap.Modal(document.getElementById('codModal'));
    codModal.show();

    document.getElementById('okCOD')?.addEventListener('click', function(){
    fetch("/pesanan/bayar/{{ $pesanan->id }}", {
    method: "POST",
    headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" }
})

        .then(res => res.json())
        .then(data => {
            if(data.success){
                Swal.fire({
                    icon: 'success',
                    title: 'Pesanan Berhasil!',
                    text: 'Pesanan Anda telah dibuat (COD).',
                    confirmButtonColor: '#f77f00',
                }).then(() => {
                    window.location.href = "{{ route('pesananuser.lihat') }}";
                });
            }
        });
    }, { once: true });
});
</script>

@endsection
