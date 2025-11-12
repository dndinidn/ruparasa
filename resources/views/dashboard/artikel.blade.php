@extends('dashboard.master')

@section('konten')
<style>
    .header-artikel {
        background: url('/images/bg-artikel.png') center center/cover no-repeat;
        border-radius: 0 0 20px 20px;
        position: relative;
        overflow: hidden;
        height: 300px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .header-artikel .header-overlay {
        background-color: rgba(222, 215, 215, 0.4);
        padding: 40px;
        border-radius: 15px;
        text-align: center;
    }

    .title-white {
        color: #fff;
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
        font-weight: bold;
    }

    .subtitle-white {
        color: #fff;
        opacity: 0.95;
        text-shadow: 1px 1px 8px rgba(0, 0, 0, 0.5);
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

    /* Thumbnail artikel */
    .artikel-thumbnail {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 5px;
        margin-bottom: 10px;
    }
</style>

<div class="header-artikel">
    <div class="header-overlay">
        <h1 class="title-white mb-2">Daftar Artikel</h1>
        <p class="subtitle-white">Berita dan artikel menarik untuk dibaca</p>
    </div>
</div>

<div class="container my-5">
    @if($artikels->isEmpty())
        <p class="text-center text-muted">Belum ada artikel yang ditambahkan.</p>
    @else
        <div class="row">
            @foreach($artikels as $artikel)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100 text-center">
                        <div class="card-body">
                            {{-- Hanya tampilkan gambar & judul --}}
                            @if($artikel->gambar)
                                <img src="{{ asset('storage/' . $artikel->gambar) }}" class="artikel-thumbnail">
                            @endif
                            <h5 class="card-title text-orange">{{ $artikel->judul }}</h5>

                            {{-- Tombol Lihat Detail --}}
                            <button class="btn btn-orange mt-2" data-bs-toggle="modal"
                                data-bs-target="#artikelModal{{ $artikel->id }}">
                                Lihat Detail
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal Detail -->
                <div class="modal fade" id="artikelModal{{ $artikel->id }}" tabindex="-1"
                    aria-labelledby="artikelModalLabel{{ $artikel->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-orange" id="artikelModalLabel{{ $artikel->id }}">
                                    {{ $artikel->judul }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Penulis:</strong> {{ $artikel->penulis }}</p>
                                <p><strong>Tanggal Publikasi:</strong>
                                    {{ \Carbon\Carbon::parse($artikel->tanggal_publikasi)->format('d M Y') }}</p>
                                @if($artikel->gambar)
                                    <img src="{{ asset('storage/' . $artikel->gambar) }}" class="img-fluid mb-3 rounded">
                                @endif
                                <p>{!! $artikel->deskripsi !!}</p>
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
