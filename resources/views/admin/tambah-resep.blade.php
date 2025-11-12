@extends('admin.master')

@section('konten')
<div class="container-fluid">

    <!-- Judul Halaman -->
    <h1 class="h3 mb-4 text-gray-800">Tambah Rasa & Resep</h1>

    <!-- ✅ Notifikasi -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Terjadi kesalahan!</strong>
            <ul class="mb-0 mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <!-- Card Form -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Resep Kuliner Daerah</h6>
                </div>
                <div class="card-body">

                    <!-- Form -->
                    <form action="{{ route('resep.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Nama Rasa -->
                        <div class="form-group">
                            <label for="nama_rasa">Nama Rasa / Kuliner</label>
                            <input type="text" name="nama_rasa" id="nama_rasa" class="form-control" placeholder="Masukkan nama kuliner" required>
                        </div>

                        <!-- Provinsi Asal -->
                        <div class="form-group">
                            <label for="provinsi_asal">Provinsi Asal</label>
                            <select name="provinsi_asal" id="provinsi_asal" class="form-control" required>
                                <option value="">-- Pilih Provinsi Asal --</option>
                                <option value="Sulawesi Utara">Sulawesi Utara</option>
                                <option value="Gorontalo">Gorontalo</option>
                                <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                                <option value="Sulawesi Barat">Sulawesi Barat</option>
                                <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                                <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                            </select>
                        </div>

                        <!-- Resep -->
                        <div class="form-group">
                            <label for="resep">Resep</label>
                            <textarea name="resep" id="resep" rows="5" class="form-control" placeholder="Tuliskan bahan dan cara pembuatan..." required></textarea>
                        </div>

                        <!-- Sejarah Kuliner -->
                        <div class="form-group">
                            <label for="sejarah">Sejarah Kuliner Khas Daerah</label>
                            <textarea name="sejarah" id="sejarah" rows="5" class="form-control" placeholder="Tuliskan sejarah atau asal-usul kuliner..." required></textarea>
                        </div>

                        <!-- Upload Gambar -->
                        <div class="form-group">
                            <label for="gambar">Gambar Makanan</label>
                            <input type="file" name="gambar" id="gambar" class="form-control-file" accept="image/*" required>
                            <small class="text-muted">Unggah gambar dalam format JPG, PNG, atau JPEG</small>
                        </div>

                        <!-- Tombol -->
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="{{ route('resep.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- ✅ Tambahkan CKEditor --}}
<script src="https://cdn.ckeditor.com/4.22.1/full-all/ckeditor.js"></script>
<script>
CKEDITOR.replace('resep', {
    height: 250,
    toolbarGroups: [
        { name: 'clipboard', groups: ['clipboard', 'undo'] },
        { name: 'editing', groups: ['find', 'selection', 'spellchecker'] },
        { name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
        { name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align'] },
        { name: 'styles' },
        { name: 'colors' },
        { name: 'links' },
        { name: 'insert' },
        { name: 'tools' }
    ],
});

CKEDITOR.replace('sejarah', {
    height: 250,
    toolbarGroups: [
        { name: 'clipboard', groups: ['clipboard', 'undo'] },
        { name: 'editing', groups: ['find', 'selection', 'spellchecker'] },
        { name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
        { name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align'] },
        { name: 'styles' },
        { name: 'colors' },
        { name: 'links' },
        { name: 'insert' },
        { name: 'tools' }
    ],
});
</script>
@endsection
