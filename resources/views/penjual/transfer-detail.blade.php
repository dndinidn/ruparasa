@extends('penjual.master')

@section('konten')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Pesanan Transfer / BRIVA</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Pesanan #{{ $pesanan->id }}</h6>
        </div>
        <div class="card-body">
            <p><strong>User:</strong> {{ $pesanan->user->name }}</p>
            <p><strong>Total:</strong> Rp {{ number_format($pesanan->total,0,',','.') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($pesanan->status) }}</p>

            <h6>Item Pesanan:</h6>
            <ul>
                @foreach($pesanan->items as $item)
                    <li>{{ $item->produk->nama_produk }} x {{ $item->jumlah }}</li>
                @endforeach
            </ul>

            @if($pesanan->status == 'menunggu_konfirmasi')
                <form action="{{ route('penjual.konfirmasi', $pesanan->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning">Konfirmasi Transfer</button>
                </form>
            @else
                <span class="badge badge-success">Sudah dikonfirmasi</span>
            @endif
        </div>
    </div>
</div>
@endsection
