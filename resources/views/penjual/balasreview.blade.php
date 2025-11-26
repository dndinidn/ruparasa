@extends('penjual.master')

@section('konten')
<div class="container my-5">
    <h2 class="mb-4">Balas Review Produk: {{ $review->produk->nama_produk }}</h2>

    <div class="card mb-3 p-3">
        <p><strong>{{ $review->user->name ?? 'User' }}</strong> berkata:</p>
        <p>{{ $review->komentar }}</p>
    </div>

    <form action="{{ route('penjual.review.balasSubmit', $review->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Balasan Anda</label>
            <textarea name="balasan_penjual" class="form-control" rows="3" required>{{ $review->balasan_penjual }}</textarea>
        </div>
        <button type="submit" class="btn btn-orange">Kirim Balasan</button>
        <a href="{{ route('penjual.review.index') }}" class="btn btn-outline-orange">Kembali</a>
    </form>
</div>
@endsection
