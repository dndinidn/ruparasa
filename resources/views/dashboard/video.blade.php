@extends('dashboard.master') {{-- Layout user --}}

@section('konten')
<style>
    /* 🔸 HEADER VIDEO */
    .header-video {
        background: url('/images/bg-video.png') center center/cover no-repeat;
        border-radius: 0 0 20px 20px;
        position: relative;
        overflow: hidden;
        height: 300px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .header-video .header-overlay {
        background-color: rgba(222, 215, 215, 0.4);
        padding: 40px;
        border-radius: 15px;
        text-align: center;
    }

    .title-white {
        color: #fff;
        text-shadow: 2px 2px 10px rgba(0,0,0,0.7);
        font-weight: bold;
    }

    .subtitle-white {
        color: #fff;
        opacity: 0.95;
        text-shadow: 1px 1px 8px rgba(0,0,0,0.5);
    }

    .text-orange { color: #f77f00 !important; }

    /* Tombol oranye */
    .btn-orange {
        background-color: #f77f00;
        color: #fff;
        border: none;
    }
    .btn-orange:hover {
        background-color: #e56e00;
        color: #fff;
    }

    /* Frame pertama video di card */
    .video-frame {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 5px;
        cursor: pointer;
        background-color: #000;
    }
</style>

{{-- HEADER --}}
<div class="header-video">
    <div class="header-overlay">
        <h1 class="title-white mb-2">Daftar Video</h1>
        <p class="subtitle-white">Kumpulan video edukasi dan hiburan</p>
    </div>
</div>

{{-- LIST VIDEO --}}
<div class="container my-5">
    @if($videos->isEmpty())
        <p class="text-center text-muted">Belum ada video yang ditambahkan.</p>
    @else
        <div class="row">
            @foreach($videos as $video)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100 text-center">
                        <div class="card-body">
                            <!-- Video frame pertama saja, tidak diputar -->
                            <video class="video-frame mb-3" preload="metadata" muted>
                                <source src="{{ asset('storage/' . $video->video) }}" type="video/mp4">
                                Browser tidak mendukung video.
                            </video>

                            <!-- Judul & Deskripsi -->
                            <h5 class="card-title text-orange">{{ $video->judul }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($video->deskripsi, 100) }}</p>

                            <!-- Tombol modal -->
                            <button class="btn btn-orange mt-2" data-bs-toggle="modal"
                                data-bs-target="#videoModal{{ $video->id }}">
                                Lihat Video
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal Detail Video -->
                <div class="modal fade" id="videoModal{{ $video->id }}" tabindex="-1"
                    aria-labelledby="videoModalLabel{{ $video->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-orange" id="videoModalLabel{{ $video->id }}">
                                    {{ $video->judul }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body text-center">
                                <!-- Video baru bisa diputar di modal -->
                                <video width="100%" height="400" controls class="rounded mb-3">
                                    <source src="{{ asset('storage/' . $video->video) }}" type="video/mp4">
                                    Browser tidak mendukung video tag.
                                </video>
                                <p class="text-muted">{{ $video->deskripsi }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
