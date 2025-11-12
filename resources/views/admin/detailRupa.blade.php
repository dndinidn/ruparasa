@extends('admin.master')

@section('konten')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Detail Rupa</h1>

    <div class="card shadow p-4">
        <h3 class="fw-bold mb-3">{{ $rupa->judul }}</h3>
        <p><strong>Tipe:</strong> {{ $rupa->tipe }}</p>

        <div class="my-3">
            <strong>Preview:</strong>
            <div class="mt-2">
                @if ($rupa->file_path)
                    @php
                        $ext = strtolower(pathinfo($rupa->file_path, PATHINFO_EXTENSION));
                    @endphp

                    @if (in_array($ext, ['jpg', 'jpeg', 'png']))
                        <!-- ✅ Gambar bisa ditekan untuk muncul popup -->
                        <img src="{{ asset('storage/' . $rupa->file_path) }}"
                             alt="{{ $rupa->judul }}"
                             class="img-thumbnail rounded shadow-sm"
                             style="max-width: 400px; object-fit: cover; cursor: pointer;"
                             onclick="bukaGambar('{{ asset('storage/' . $rupa->file_path) }}')">
                    @elseif (in_array($ext, ['mp4', 'mov', 'avi']))
                        <video controls width="400" class="rounded shadow-sm">
                            <source src="{{ asset('storage/' . $rupa->file_path) }}" type="video/mp4">
                            Browser Anda tidak mendukung video.
                        </video>
                    @else
                        <a href="{{ asset('storage/' . $rupa->file_path) }}" target="_blank">Lihat File</a>
                    @endif
                @else
                    <p class="text-muted">Tidak ada file</p>
                @endif
            </div>
        </div>

        <div class="my-3">
            <strong>Deskripsi:</strong>
            <p class="mt-2 text-justify">{{ $rupa->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
        </div>

        <a href="{{ route('dashboard.lihatrupa') }}" class="btn btn-secondary mt-3">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<!-- ✅ POPUP Gambar -->
<div id="gambarPopup" class="popup-overlay" onclick="tutupGambar(event)">
    <span class="close-btn" onclick="tutupGambar(event)">✖</span>
    <img id="popupImage" src="" alt="Gambar Rupa" class="popup-image">
</div>

<!-- ✅ STYLE -->
<style>
.popup-overlay {
    display: none;
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.8);
    justify-content: center;
    align-items: center;
    z-index: 1050;
}
.popup-overlay.active {
    display: flex;
}
.popup-image {
    max-width: 90%;
    max-height: 90%;
    border-radius: 10px;
    box-shadow: 0 4px 30px rgba(255, 255, 255, 0.3);
}
.close-btn {
    position: absolute;
    top: 30px;
    right: 40px;
    font-size: 35px;
    color: white;
    cursor: pointer;
    background: rgba(0,0,0,0.5);
    border-radius: 50%;
    width: 45px;
    height: 45px;
    text-align: center;
    line-height: 45px;
}
.close-btn:hover {
    background: rgba(255,255,255,0.2);
}
</style>

<!-- ✅ SCRIPT -->
<script>
function bukaGambar(src) {
    const overlay = document.getElementById('gambarPopup');
    const img = document.getElementById('popupImage');
    img.src = src;
    overlay.classList.add('active');
}

function tutupGambar(event) {
    if (event.target.id === 'gambarPopup' || event.target.classList.contains('close-btn')) {
        const overlay = document.getElementById('gambarPopup');
        overlay.classList.remove('active');
        document.getElementById('popupImage').src = '';
    }
}
</script>
@endsection
