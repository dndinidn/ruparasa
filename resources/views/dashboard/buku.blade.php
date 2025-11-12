@extends('dashboard.master')

@section('konten')
<style>
    .header-buku {
        background: url('/images/bg-buku.png') center center/cover no-repeat;
        border-radius: 0 0 20px 20px;
        height: 300px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .header-buku .header-overlay {
        background-color: rgba(222, 215, 215, 0.4);
        padding: 40px;
        border-radius: 15px;
        text-align: center;
    }
    .title-white { color: #fff; font-weight: bold; text-shadow: 2px2px10px rgba(0,0,0,0.7);}
    .subtitle-white { color: #fff; opacity:0.95; text-shadow: 1px1px8px rgba(0,0,0,0.5);}
    .btn-orange { background:#f77f00;color:#fff;border:none;}
    .btn-orange:hover { background:#e56e00;color:#fff;}
</style>

<div class="header-buku">
    <div class="header-overlay">
        <h1 class="title-white">Daftar Buku</h1>
        <p class="subtitle-white">Kumpulan buku menarik</p>
    </div>
</div>

<div class="container my-5">
    @if($bukus->isEmpty())
        <p class="text-center text-muted">Belum ada buku yang ditambahkan.</p>
    @else
        <div class="row">
            @foreach($bukus as $buku)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100 text-center">
                        <div class="card-body">
                            <h5 class="card-title text-orange">{{ $buku->judul }}</h5>

                            <!-- Tombol buka PDF -->
                            @if($buku->file_pdf)
                                <button class="btn btn-orange mt-2" data-bs-toggle="modal" data-bs-target="#bukuModal{{ $buku->id }}">
                                    Lihat Buku
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Modal PDF -->
                <div class="modal fade" id="bukuModal{{ $buku->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-orange">{{ $buku->judul }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <embed src="{{ asset('storage/' . $buku->file_pdf) }}" type="application/pdf" width="100%" height="600px">
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
