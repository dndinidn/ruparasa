@extends('admin.master')

@section('konten')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Data Rupa</h1>

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

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('updaterupa', $rupa->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Judul -->
                <div class="form-group">
                    <label for="judul">Judul Rupa</label>
                    <input type="text" name="judul" id="judul" class="form-control"
                        value="{{ old('judul', $rupa->judul) }}" required>
                </div>

                <!-- Tipe -->
                <div class="form-group">
                    <label for="tipe">Tipe Rupa</label>
                    <select name="tipe" id="tipe" class="form-control" required>
                        <option value="">-- Pilih Tipe Rupa --</option>
                        <option value="Gambar" {{ $rupa->tipe == 'Gambar' ? 'selected' : '' }}>Gambar</option>
                        <option value="Video" {{ $rupa->tipe == 'Video' ? 'selected' : '' }}>Video</option>
                        <option value="Audio" {{ $rupa->tipe == 'Audio' ? 'selected' : '' }}>Audio</option>
                        <option value="Dokumen" {{ $rupa->tipe == 'Dokumen' ? 'selected' : '' }}>Dokumen</option>
                    </select>
                </div>

                <!-- File -->
                <div class="form-group">
                    <label for="file_path">File</label><br>
                    @if ($rupa->file_path)
                        <div class="mb-2">
                            @if(Str::startsWith($rupa->tipe, 'Gambar'))
                                <img src="{{ asset('storage/' . $rupa->file_path) }}" alt="File Rupa" width="150" class="img-thumbnail">
                            @else
                                <a href="{{ asset('storage/' . $rupa->file_path) }}" target="_blank">{{ basename($rupa->file_path) }}</a>
                            @endif
                        </div>
                    @endif
                    <input type="file" name="file_path" id="file_path" class="form-control-file">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengganti file.</small>
                </div>

                <!-- Deskripsi -->
                <div class="form-group">
                    <label for="deskripsi">Deskripsi Rupa</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi', $rupa->deskripsi) }}</textarea>
                </div>

                <!-- Tombol -->
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('dashboard.lihatrupa') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
