@extends('admin.master')

@section('konten')
<div class="container-fluid">

    <!-- Judul Halaman -->
    <h1 class="h3 mb-4 text-gray-800">Tambah Rupa</h1>

    <!-- Pesan sukses -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <!-- Pesan error umum -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <!-- Pesan error validasi -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <div class="mb-2">
                <strong><i class="fas fa-exclamation-circle"></i> Terjadi kesalahan saat menyimpan data:</strong>
            </div>
            <ul class="mb-0 pl-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <!-- Form Tambah Rupa -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data Rupa</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('simpanRupa') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Judul -->
                        <div class="form-group">
                            <label for="judul">Judul Rupa</label>
                            <input type="text"
                                   name="judul"
                                   id="judul"
                                   class="form-control @error('judul') is-invalid @enderror"
                                   placeholder="Masukkan judul rupa"
                                   value="{{ old('judul') }}">
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tipe -->
                        <div class="form-group">
                            <label for="tipe">Tipe Rupa</label>
                            <select name="tipe" id="tipe"
                                    class="form-control @error('tipe') is-invalid @enderror">
                                <option value="">-- Pilih Tipe Rupa --</option>
                                <option value="Gambar" {{ old('tipe') == 'Gambar' ? 'selected' : '' }}>Gambar</option>
                                <option value="Video" {{ old('tipe') == 'Video' ? 'selected' : '' }}>Video</option>
                            </select>
                            @error('tipe')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- File Path -->
                        <div class="form-group">
                            <label for="file_path">Upload File</label>
                            <input type="file"
                                   name="file_path"
                                   id="file_path"
                                   class="form-control-file @error('file_path') is-invalid @enderror">
                            @error('file_path')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                Pilih tipe terlebih dahulu agar sistem tahu file apa yang diizinkan. (Maks 20MB)
                            </small>
                        </div>

                        <!-- Deskripsi -->
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Rupa</label>
                            <textarea name="deskripsi"
                                      id="deskripsi"
                                      rows="5"
                                      class="form-control @error('deskripsi') is-invalid @enderror"
                                      placeholder="Tuliskan deskripsi rupa...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tombol -->
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="{{ route('dashboard.lihatrupa') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT UNTUK BATASI FILE SESUAI TIPE -->
<script>
    document.getElementById('tipe').addEventListener('change', function () {
        const fileInput = document.getElementById('file_path');
        const tipe = this.value;

        fileInput.value = ''; // Reset input file

        if (tipe === 'Gambar') {
            fileInput.accept = 'image/*';
        } else if (tipe === 'Video') {
            fileInput.accept = 'video/*';
        } else {
            fileInput.accept = '';
        }
    });
</script>
@endsection
