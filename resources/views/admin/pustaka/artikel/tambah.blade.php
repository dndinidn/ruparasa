@extends('admin.master')

@section('konten')
<div class="container mt-4">
    <h2 class="mb-4"><i class="fas fa-newspaper mr-2"></i>Tambah Artikel Budaya</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Judul --}}
                <div class="form-group mb-3">
                    <label class="fw-bold">Judul Artikel</label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                        placeholder="Masukkan judul artikel..." value="{{ old('judul') }}">
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Penulis --}}
                <div class="form-group mb-3">
                    <label class="fw-bold">Penulis</label>
                    <input type="text" name="penulis" class="form-control @error('penulis') is-invalid @enderror"
                        placeholder="Masukkan nama penulis..." value="{{ old('penulis') }}">
                    @error('penulis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tanggal Publikasi --}}
                <div class="form-group mb-3">
                    <label class="fw-bold">Tanggal Publikasi</label>
                    <input type="date" name="tanggal_publikasi"
                        class="form-control @error('tanggal_publikasi') is-invalid @enderror"
                        value="{{ old('tanggal_publikasi') }}">
                    @error('tanggal_publikasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Upload Gambar --}}
                <div class="form-group mb-3">
                    <label class="fw-bold">Upload Gambar</label>
                    <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror">
                    <small class="text-muted">Format: JPG, PNG, JPEG (maks. 2MB)</small>
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="form-group mb-3">
                    <label class="fw-bold">Deskripsi Artikel</label>
                    <textarea name="deskripsi" id="editor" rows="6"
                        class="form-control @error('deskripsi') is-invalid @enderror"
                        placeholder="Tuliskan isi atau deskripsi artikel...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.video.index') }}" class="btn btn-secondary me-2">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Simpan Artikel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- CKEditor untuk deskripsi --}}
@push('scripts')
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor', {
        height: 300,
        removeButtons: 'PasteFromWord'
    });
</script>
@endpush
@endsection
