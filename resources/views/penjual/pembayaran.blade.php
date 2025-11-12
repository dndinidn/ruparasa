@extends('penjual.master')

@section('konten')
<h2 class="text-orange fw-bold mb-4">Daftar Pembayaran</h2>

@forelse($pembayaran as $p)
<div class="card mb-3">
    <div class="card-header">
        Pesanan #{{ $p->id }} - User: {{ $p->user->name }} - Total: Rp {{ number_format($p->total,0,',','.') }} - Status: {{ ucfirst($p->status) }}
    </div>
    <div class="card-body">
        <ul>
            @foreach($p->items as $item)
            <li>{{ $item->produk->nama_produk }} x {{ $item->jumlah }}</li>
            @endforeach
        </ul>
    </div>
</div>
@empty
<p class="text-muted">Belum ada pembayaran.</p>
@endforelse
@endsection
