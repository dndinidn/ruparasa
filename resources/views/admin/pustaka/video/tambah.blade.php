@extends('admin.master') {{-- pastikan layout admin kamu sesuai, ubah jika berbeda --}}

@section('konten')
<div class="container-fluid">

    <!-- Judul Halaman -->
    <h1 class="h3 mb-4 text-gray-800">Tambah Video Dokumenter</h1>

    <!-- Card Form Tambah Video -->
    <div class="card shadow mb-4">
        <div class="card-body">

            <form action="{{ route('admin.video.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Judul -->
                <div class="form-group">
                    <label for="judul">Judul Video</label>
                    <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul video" required>
                </div>

                <!-- Upload Video -->
                <div class="form-group">
                    <label for="video">Upload Video</label>
                    <input type="file" name="video" id="video" class="form-control-file" accept="video/*" required>
                    <small class="text-muted">Format yang didukung: MP4, AVI, MOV, MKV</small>
                </div>

                <!-- Deskripsi -->
                <div class="form-group">
                    <label for="deskripsi">Deskripsi Video</label>
                    <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control" placeholder="Tuliskan deskripsi singkat video..." required></textarea>
                </div>

                <!-- Tombol Aksi -->
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
                    <a href="{{ route('admin.video.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i> Batal</a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
