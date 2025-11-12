@extends('admin.master')

@section('konten')
<div class="container py-4">

    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white">
            <h4 class="mb-0">{{ $video->judul }}</h4>
        </div>

        <div class="card-body">
            <h5 class="text-muted mb-3">Deskripsi:</h5>
            <p>{{ $video->deskripsi ?? 'Tidak ada deskripsi.' }}</p>

            <hr>

            <h5 class="text-muted mb-3">Tonton Video:</h5>
            @if($video->video)
                <video controls class="w-100 rounded shadow-sm" style="max-height: 500px;">
                    <source src="{{ asset('storage/' . $video->video) }}" type="video/mp4">
                    Browser kamu tidak mendukung tag video.
                </video>
            @else
                <p class="text-danger">Video tidak tersedia.</p>
            @endif

            <div class="mt-4">
                <a href="{{ route('admin.video.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
