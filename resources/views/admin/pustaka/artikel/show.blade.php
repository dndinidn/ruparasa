@extends('admin.master')

@section('konten')
<div class="container py-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ $artikel->judul }}</h4>
        </div>

        <div class="card-body">
            @if($artikel->gambar)
                <div class="text-center mb-3">
                    <img src="{{ asset('storage/' . $artikel->gambar) }}" 
                         alt="Gambar Artikel" 
                         class="img-fluid rounded shadow-sm" 
                         style="max-height: 400px;">
                </div>
            @endif

            <p><strong>Penulis:</strong> {{ $artikel->penulis ?? 'Tidak diketahui' }}</p>
            <p><strong>Tanggal Publikasi:</strong> 
                {{ \Carbon\Carbon::parse($artikel->tanggal_publikasi)->format('d M Y') ?? '-' }}
            </p>

            <hr>

            <div class="mt-3">
                <h5 class="fw-bold mb-2">Deskripsi Artikel:</h5>
                <div>{!! $artikel->deskripsi !!}</div>
            </div>

            <div class="mt-4">
                <a href="{{ route('admin.artikel.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
