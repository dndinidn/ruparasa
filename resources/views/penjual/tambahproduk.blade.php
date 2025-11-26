@extends('penjual.master')

@section('konten')
    <style>
        .text-primary {
            color: #e06629 !important;
        }

        .btn-primary {
            background-color: #e06629 !important;
            border-color: #e06629 !important;
        }

        .btn-primary:hover {
            background-color: #c75822 !important;
            border-color: #c75822 !important;
        }

        .card-header {
            background-color: #e06629 !important;
            color: #fff !important;
        }
    </style>

    <div class="container-fluid">
        <h1 class="h3 mb-4" style="color:#e06629;">Tambah Produk Kuliner</h1>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">Form Tambah Produk Kuliner Daerah</h6>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="nama_produk">Nama Produk</label>
                                <input type="text" name="nama_produk" id="nama_produk"
                                       class="form-control" placeholder="Masukkan nama produk" required>
                            </div>

                            <div class="form-group">
                                <label for="harga">Harga (Rp)</label>
                                <input type="number" name="harga" id="harga" class="form-control"
                                       placeholder="Masukkan harga produk" required>
                            </div>

                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="number" name="stok" id="stok" class="form-control"
                                       placeholder="Masukkan jumlah stok" required>
                            </div>

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi Produk</label>
                                <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control"
                                          placeholder="Tuliskan deskripsi produk" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="gambar">Gambar Produk</label>
                                <input type="file" name="gambar" id="gambar" class="form-control-file" accept="image/*">
                                <small class="text-muted">Unggah gambar JPG, JPEG, atau PNG</small>
                            </div>

                            <!-- KATEGORI BARU -->
                            <div class="form-group">
                                <label for="kategori">Kategori Produk</label>
                                <select name="kategori" id="kategori" class="form-control" required>
                                    <option value="">-- Pilih Kategori --</option>

                                    <optgroup label="Makanan Khas Sulawesi">
                                        <option value="Makanan Lokal">Makanan Lokal</option>
                                        <option value="Snack / Camilan">Snack / Camilan</option>
                                        <option value="Kue Tradisional">Kue Tradisional</option>
                                        <option value="Sambal & Bumbu">Sambal & Bumbu</option>
                                        <option value="Minuman Tradisional">Minuman Tradisional</option>
                                    </optgroup>

                                    <optgroup label="Souvenir & Kerajinan">
                                        <option value="Tenun & Songket">Tenun & Songket</option>
                                        <option value="Aksesoris Khas Sulawesi">Aksesoris Khas Sulawesi</option>
                                        <option value="Kerajinan Kayu">Kerajinan Kayu</option>
                                        <option value="Kerajinan Kerang">Kerajinan Kerang</option>
                                        <option value="Miniatur / Pajangan">Miniatur / Pajangan</option>
                                        <option value="Dekorasi Rumah">Dekorasi Rumah</option>
                                    </optgroup>

                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>

                            <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
