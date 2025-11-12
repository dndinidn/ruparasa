@extends('dashboard.master')

@section('konten')
<style>
.text-orange { color: #f77f00 !important; }
.btn-orange { background-color: #f77f00; color: #fff; border: none; }
.btn-orange:hover { background-color: #e56e00; color: #fff; }
.table th, .table td { vertical-align: middle; }
</style>

<div class="container my-5">
    <h2 class="text-orange fw-bold mb-4">Daftar Pesanan</h2>

    @if($pesanan && $pesanan->items->count() > 0)
        <form id="formCheckout">
            @csrf
            <table class="table table-bordered">
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
                        <td>{{ $item->produk->nama_produk }}</td>
                        <td>Rp {{ number_format($item->harga,0,',','.') }}</td>
                        <td>
                            <input type="number" name="jumlah[{{ $item->id }}]" value="{{ $item->jumlah }}" min="1" class="form-control text-center" style="width:80px;">
                        </td>
                        <td>Rp {{ number_format($item->harga * $item->jumlah,0,',','.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3">
                <p><strong>Sub total pengiriman:</strong> Rp 10.000</p>
                <p><strong>Sub total pesanan:</strong> Rp {{ number_format($pesanan->items->sum(fn($i)=> $i->harga * $i->jumlah),0,',','.') }}</p>
                <p><strong>Total:</strong> Rp {{ number_format($pesanan->items->sum(fn($i)=> $i->harga * $i->jumlah) + 10000,0,',','.') }}</p>
            </div>

            <button type="submit" class="btn btn-orange mt-3 w-100" id="btnBayar">Checkout</button>
        </form>
    @else
        <p class="text-muted text-center py-4">Belum ada produk dalam pesanan.</p>
    @endif
</div>

<!-- MODAL COD -->
<div class="modal fade" id="codModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3 text-center">
        <h5 class="text-orange fw-bold mb-3">Pembayaran COD</h5>
        <p>Pesanan Anda akan dikirim. Terima kasih!</p>
        <button id="okCOD" class="btn btn-orange w-100" data-bs-dismiss="modal" href="{{ route('pesananuser.lihat') }}">Selesai</button>
    </div>
  </div>
</div>

<script>
document.getElementById('formCheckout').addEventListener('submit', function(e){
    e.preventDefault();

    // tampilkan modal COD
    var codModal = new bootstrap.Modal(document.getElementById('codModal'));
    codModal.show();

    // saat tombol modal diklik, update status dan redirect
    document.getElementById('okCOD').addEventListener('click', function(){
        fetch("{{ route('pesanan.bayar', $pesanan->id ?? 0) }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ metode_pembayaran: 'cod' })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                window.location.href = "{{ route('pesananuser.lihat') }}";
            }
        });
    }, { once: true }); // important: hanya sekali event listener
});
</script>
@endsection
