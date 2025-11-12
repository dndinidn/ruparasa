@extends('admin.master')

@section('konten')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">✏️ Edit Buku</h2>
        <a href="{{ route('admin.buku.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle me-1"></i> Kembali
        </a>
    </div>

    {{-- Pesan error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Buku</label>
                    <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $buku->judul) }}" required>
                </div>

                {{-- Penulis --}}
                <div class="mb-3">
                    <label for="penulis" class="form-label">Penulis</label>
                    <input type="text" name="penulis" id="penulis" class="form-control" value="{{ old('penulis', $buku->penulis) }}" required>
                </div>

                {{-- PDF --}}
                <div class="mb-3">
                    <label for="file_pdf" class="form-label">Upload PDF</label>
                    <input type="file" name="file_pdf" id="file_pdf" class="form-control" accept="application/pdf">

                    @if($buku->file_pdf)
                        <p class="mt-2">PDF saat ini:</p>
                        <embed src="{{ asset('storage/' . $buku->file_pdf) }}" type="application/pdf" width="300" height="350">
                        <p class="mt-1">
                            <a href="{{ asset('storage/' . $buku->file_pdf) }}" target="_blank" class="btn btn-outline-primary btn-sm">Lihat PDF di tab baru</a>
                        </p>
                    @endif
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control" required>{{ old('deskripsi', $buku->deskripsi) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Update Buku
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
