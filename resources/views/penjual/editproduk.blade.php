@extends('penjual.master')

@section('konten')
@php
    use Illuminate\Support\Facades\Auth;
@endphp

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Produk Kuliner</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" name="penjual_id" value="{{ Auth::user()->penjual->id ?? '' }}">

                <div class="form-group">
                    <label for="nama_produk">Nama Produk</label>
                    <input type="text" name="nama_produk" id="nama_produk" class="form-control"
                        value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                </div>

                <div class="form-group">
                    <label for="harga">Harga (Rp)</label>
                    <input type="number" name="harga" id="harga" class="form-control"
                        value="{{ old('harga', $produk->harga) }}" required min="1" step="1">
                </div>

                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" name="stok" id="stok" class="form-control"
                        value="{{ old('stok', $produk->stok) }}" required min="1" step="1">
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi Produk</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5" required>{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                </div>

                <!-- 🔹 Tambah Kategori -->
                <div class="form-group">
                    <label for="kategori">Kategori Produk</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>

                        <optgroup label="Makanan Khas Sulawesi">
                            <option value="Makanan Lokal" {{ $produk->kategori == "Makanan Lokal" ? "selected" : "" }}>Makanan Lokal</option>
                            <option value="Snack / Camilan" {{ $produk->kategori == "Snack / Camilan" ? "selected" : "" }}>Snack / Camilan</option>
                            <option value="Kue Tradisional" {{ $produk->kategori == "Kue Tradisional" ? "selected" : "" }}>Kue Tradisional</option>
                            <option value="Sambal & Bumbu" {{ $produk->kategori == "Sambal & Bumbu" ? "selected" : "" }}>Sambal & Bumbu</option>
                            <option value="Minuman Tradisional" {{ $produk->kategori == "Minuman Tradisional" ? "selected" : "" }}>Minuman Tradisional</option>
                        </optgroup>

                        <optgroup label="Souvenir & Kerajinan">
                            <option value="Tenun & Songket" {{ $produk->kategori == "Tenun & Songket" ? "selected" : "" }}>Tenun & Songket</option>
                            <option value="Aksesoris Khas Sulawesi" {{ $produk->kategori == "Aksesoris Khas Sulawesi" ? "selected" : "" }}>Aksesoris Khas Sulawesi</option>
                            <option value="Kerajinan Kayu" {{ $produk->kategori == "Kerajinan Kayu" ? "selected" : "" }}>Kerajinan Kayu</option>
                            <option value="Kerajinan Kerang" {{ $produk->kategori == "Kerajinan Kerang" ? "selected" : "" }}>Kerajinan Kerang</option>
                            <option value="Miniatur / Pajangan" {{ $produk->kategori == "Miniatur / Pajangan" ? "selected" : "" }}>Miniatur / Pajangan</option>
                            <option value="Dekorasi Rumah" {{ $produk->kategori == "Dekorasi Rumah" ? "selected" : "" }}>Dekorasi Rumah</option>
                        </optgroup>
                    </select>
                </div>
                <!-- END Kategori -->

                <div class="form-group">
                    <label for="gambar">Gambar Produk</label><br>

                    @if ($produk->gambar)
                        <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}"
                             width="150" class="img-thumbnail mb-2" id="preview-gambar" style="cursor: pointer;">
                    @endif

                    <input type="file" name="gambar" id="gambar" class="form-control-file mt-2">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar</small>
                </div>

                <button type="submit" class="btn btn-success" id="btnSubmit">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>

                <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

            </form>
        </div>
    </div>
</div>

<!-- 🔹 Modal Popup Gambar -->
<div id="popupGambar" style="display:none; position:fixed; z-index:1000;
    left:0; top:0; width:100%; height:100%;
    background-color:rgba(0,0,0,0.7); justify-content:center; align-items:center;">
    <span id="closePopup" style="position:absolute; top:30px; right:50px; color:white; font-size:35px; cursor:pointer;">&times;</span>
    <img id="gambarPopup" src="{{ asset('storage/' . $produk->gambar) }}"
         style="max-width:80%; max-height:80%; border-radius:10px;">
</div>

<script>
    // ============================
    // 1. VALIDASI HANYA ANGKA BULAT POSITIF
    // ============================
    document.getElementById("harga").addEventListener("input", function () {
        this.value = this.value.replace(/[^0-9]/g, "");
        if (this.value < 1) this.value = "";
    });

    document.getElementById("stok").addEventListener("input", function () {
        this.value = this.value.replace(/[^0-9]/g, "");
        if (this.value < 1) this.value = "";
    });

    // ============================
    // 2. DISABLE SUBMIT JIKA TIDAK ADA PERUBAHAN
    // ============================
    const form = document.querySelector("form");
    const submitBtn = document.getElementById("btnSubmit");

    // Simpan data awal form
    const initialData = new FormData(form);

    function isFormChanged() {
        const currentData = new FormData(form);

        for (let [key, value] of currentData.entries()) {
            if (initialData.get(key) !== value) {
                return true;
            }
        }
        return false;
    }

    // Disable saat awal
    submitBtn.disabled = true;

    // Pantau perubahan
    form.addEventListener("input", () => {
        submitBtn.disabled = !isFormChanged();
    });

    // ============================
    // 3. POPUP GAMBAR
    // ============================
    const img = document.getElementById("preview-gambar");
    const modal = document.getElementById("popupGambar");
    const closeBtn = document.getElementById("closePopup");

    if (img) {
        img.onclick = function() {
            modal.style.display = "flex";
        }
    }

    closeBtn.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    };
</script>
@endsection
