@extends('dashboard.master')

@section('konten')
<div class="container my-5">
    <h2 class="text-orange fw-bold mb-4">Tambah Review Pesanan #{{ $pesanan->id }}</h2>

    <form action="{{ route('pesanan.submitReview', $pesanan->id) }}" method="POST">
        @csrf
        @foreach($pesanan->items as $item)
            <div class="card mb-3 shadow-sm p-3">
                <h5>{{ $item->produk->nama_produk }}</h5>
                <input type="hidden" name="produk_id[]" value="{{ $item->produk->id }}">
                <div class="mb-2">
                    <label class="form-label">Rating (1-5)</label>
                    <select name="rating[]" class="form-control" required>
                        <option value="">Pilih rating</option>
                        <option value="1">1 ★</option>
                        <option value="2">2 ★★</option>
                        <option value="3">3 ★★★</option>
                        <option value="4">4 ★★★★</option>
                        <option value="5">5 ★★★★★</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label class="form-label">Komentar</label>
                    <textarea name="komentar[]" class="form-control" rows="2" required></textarea>
                </div>
            </div>
        @endforeach
        <!-- Alert sukses review -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif


        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-orange">Kirim Review</button>
            <a href="{{ route('pesanan.index') }}" class="btn btn-outline-orange">Kembali</a>
        </div>
    </form>
</div>

<style>
.btn-orange { 
    background-color: #f77f00; 
    color: #fff; 
    border: none;
}
.btn-orange:hover { 
    background-color: #e56e00; 
    color: #fff; 
}
</style>
@endsection
