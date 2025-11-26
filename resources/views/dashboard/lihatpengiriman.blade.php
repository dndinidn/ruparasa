@extends('dashboard.master')

@section('konten')
<div class="container my-5">
    <h2 class="text-orange fw-bold mb-4">Pesanan Saya</h2>

    @forelse($pesanan as $p)
        <div class="card mb-3 shadow-sm">
            <div class="card-header fw-bold">
                Pesanan #{{ $p->id }}
                <span class="float-end">Total: Rp {{ number_format($p->items->sum(fn($i) => $i->harga * $i->jumlah) + $p->ongkir,0,',','.') }}</span>
            </div>
            <div class="card-body">
                <ul>
                    @foreach($p->items as $item)
                        <li>{{ $item->produk->nama_produk }} x {{ $item->jumlah }}</li>
                    @endforeach
                </ul>
                <p>Status: <span class="fw-bold text-orange">{{ ucfirst($p->status) }}</span></p>

                <div class="d-flex gap-2 mt-2">
                    <!-- Tombol Terima jika dikirim -->
                    @if($p->status === 'dikirim')
                        <form id="form-terima-{{ $p->id }}" action="{{ route('pesanan.terima', $p->id) }}" method="POST">
                            @csrf
                            <button type="button" class="btn btn-success" onclick="konfirmasiTerima({{ $p->id }})">
                                <i class="fas fa-check"></i> Pesanan Diterima
                            </button>
                        </form>
                    @endif

                    <!-- Tombol Tambah Review jika selesai -->
                   @if($p->status === 'selesai')
    <a href="{{ route('pesanan.review', $p->id) }}" class="btn review-btn">
        <i class="bi bi-pencil-square"></i> Tambah Review
    </a>
@endif

<style>
.review-btn {
    background-color: #f77f00;
    color: #fff;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    text-decoration: none;
    display: inline-block;
}
.review-btn:hover {
    background-color: #e56e00;
    color: #fff;
}
</style>

                </div>
            </div>
        </div>
    @empty
        <p class="text-muted text-center py-4">Belum ada pengiriman.</p>
    @endforelse
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function konfirmasiTerima(id) {
    Swal.fire({
        title: 'Konfirmasi Penerimaan',
        text: 'Pastikan pesanan Anda sudah diterima dengan baik sebelum menekan tombol ini.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, pesanan sudah diterima',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('form-terima-' + id).submit();
        }
    });
}
</script>
@endsection
