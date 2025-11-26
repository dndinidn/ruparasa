@extends('penjual.master')

@section('konten')
<h2 class="mb-4">Review Produk Saya</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@forelse($reviews as $review)
<div class="card mb-3 shadow-sm p-3">
    <p><strong>{{ $review->user->name ?? 'User' }}</strong> untuk <strong>{{ $review->produk->nama_produk }}</strong></p>
    <p>Rating: {{ str_repeat('★', $review->rating) }}</p>
    <p>{{ $review->komentar }}</p>
    @if($review->balasan_penjual)
        <p><strong>Balasan Penjual:</strong> {{ $review->balasan_penjual }}</p>
    @endif
    <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>

    <div class="mt-2">
        <a href="{{ route('penjual.review.balasForm', $review->id) }}" class="btn btn-sm btn-orange">Balas</a>
    </div>
</div>
@empty
<p class="text-muted">Belum ada review untuk produk Anda.</p>
@endforelse
@endsection
