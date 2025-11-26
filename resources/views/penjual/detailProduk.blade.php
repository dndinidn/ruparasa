@extends('penjual.master')

@section('konten')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Detail Produk Kuliner</h1>

    <div class="card shadow p-4">
        <h3 class="fw-bold mb-3">{{ $produk->nama_produk }}</h3>

        <div class="mb-3">
            <strong>Harga:</strong>
            <p class="mt-2">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
        </div>

        <div class="mb-3">
            <strong>Stok:</strong>
            <p class="mt-2">{{ $produk->stok }}</p>
        </div>

        <div class="mb-3">
            <strong>Deskripsi:</strong>
            <p class="mt-2 text-justify">{{ $produk->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
        </div>

        <div class="mb-3">
            <strong>Gambar:</strong>
            <div class="mt-2">
                @if ($produk->gambar)
                    <img src="{{ asset('storage/' . $produk->gambar) }}"
                         alt="{{ $produk->nama_produk }}"
                         class="img-thumbnail rounded shadow"
                         style="max-width: 400px; cursor: pointer;"
                         id="previewImage">
                @else
                    <p class="text-muted">Tidak ada gambar</p>
                @endif
            </div>
        </div>

        <a href="{{ route('produk.index') }}" class="btn btn-secondary mt-3">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

{{-- Modal Popup Gambar --}}
<div id="imageModal" class="modal" style="
    display: none;
    position: fixed;
    z-index: 1050;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.8);
">
    <span id="closeModal" style="
        position: absolute;
        top: 15px;
        right: 35px;
        color: #fff;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
    ">&times;</span>
    <div style="display: flex; justify-content: center; align-items: center; height: 100%;">
        <img id="modalImage" src="" style="max-width: 90%; max-height: 80%; border-radius: 10px; box-shadow: 0 0 20px #000;">
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('imageModal');
        const img = document.getElementById('previewImage');
        const modalImg = document.getElementById('modalImage');
        const close = document.getElementById('closeModal');

        if (img) {
            img.onclick = function () {
                modal.style.display = 'block';
                modalImg.src = this.src;
            }
        }

        close.onclick = function () {
            modal.style.display = 'none';
        }

        window.onclick = function (event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }
    });
</script>
@endsection
