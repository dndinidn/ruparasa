@extends('admin.master')

@section('konten')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">✏️ Edit Video Pustaka</h4>
            <a href="{{ route('admin.video.index') }}" class="btn btn-light btn-sm">
                ← Kembali
            </a>
        </div>

        <div class="card-body">
            {{-- Pesan Error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan!</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form Edit --}}
            <form action="{{ route('admin.video.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-3">
                    <label for="judul" class="form-label fw-bold">Judul Video</label>
                    <input type="text" class="form-control" id="judul" name="judul"
                           value="{{ old('judul', $video->judul) }}" placeholder="Masukkan judul video" required>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"
                              placeholder="Masukkan deskripsi video" required>{{ old('deskripsi', $video->deskripsi) }}</textarea>
                </div>

                {{-- Video Lama --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Video Saat Ini</label>
                    <div>
                        <video width="300" controls class="rounded border">
                            <source src="{{ asset('storage/' . $video->video) }}" type="video/mp4">
                            Browser Anda tidak mendukung pemutaran video.
                        </video>
                    </div>
                </div>

                {{-- Upload Video Baru --}}
                <div class="mb-4">
                    <label for="video" class="form-label fw-bold">Ganti Video (opsional)</label>
                    <input type="file" class="form-control" id="video" name="video" accept="video/*">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengganti video.</small>
                </div>

                {{-- Tombol Simpan --}}
                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4">
                        💾 Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
