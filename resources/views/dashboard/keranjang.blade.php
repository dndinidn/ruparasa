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
.btn-orange:hover {
    opacity: 0.85;
}

.card-item {
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    padding: 15px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.card-item input[type="number"] {
    width: 60px;
}

.card-item .info {
    flex-grow: 1;
    margin-left: 15px;
}

.card-item .actions {
    text-align: right;
    display: flex;
    flex-direction: column;
    gap: 5px;
}
</style>

<div class="container py-5">
    <h2 class="text-orange fw-bold mb-4">Keranjang Belanja</h2>

    @if($pesanan && $pesanan->items->count() > 0)
        <form action="{{ route('pesanan.checkout') }}" method="POST">
            @csrf

            @foreach($pesanan->items as $item)
            <div class="card-item" id="item-{{ $item->id }}">
                <div>
                    <input type="checkbox" name="checkout[]" value="{{ $item->id }}" checked>
                </div>
                <div class="info">
                    <h5>{{ $item->produk->nama_produk }}</h5>
                    <p>Harga: Rp {{ number_format($item->harga,0,',','.') }}</p>
                </div>
                <div class="actions">
                    <input type="number" name="jumlah[{{ $item->id }}]" value="{{ $item->jumlah }}" min="1" class="form-control mb-2">
                    <button type="button" class="btn btn-danger btn-sm" onclick="hapusItem({{ $item->id }})">Hapus</button>
                </div>
            </div>
            @endforeach

            <button type="submit" class="btn btn-orange w-100 mt-3">Checkout</button>
        </form>
    @else
        <p class="text-center text-muted py-4">Keranjang masih kosong.</p>
    @endif
</div>

<script>
function hapusItem(itemId){
    if(confirm('Apakah Anda yakin ingin menghapus item ini?')){
        fetch('/pesanan/item/' + itemId, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(res => {
            if(res.ok){
                document.getElementById('item-' + itemId).remove();
            }
        });
    }
}
</script>
@endsection
