@extends('admin.master')

@section('konten')
<div class="container mt-4">
    <h2 class="fw-bold mb-4">✏️ Edit Artikel</h2>

    {{-- Pesan error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif@extends('admin.master')

@section('konten')
<div class="container mt-4">
    <h2 class="fw-bold mb-4">✏️ Edit Artikel</h2>

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
            <form action="{{ route('admin.artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-3">
                    <label for="judul" class="form-label fw-semibold">Judul Artikel</label>
                    <input type="text" name="judul" id="judul" class="form-control"
                           value="{{ old('judul', $artikel->judul) }}" required>
                </div>

                {{-- Penulis --}}
                <div class="mb-3">
                    <label for="penulis" class="form-label fw-semibold">Penulis</label>
                    <input type="text" name="penulis" id="penulis" class="form-control"
                           value="{{ old('penulis', $artikel->penulis) }}" required>
                </div>

                {{-- Tanggal Publikasi --}}
                @php
                    use Illuminate\Support\Carbon;
                    $tanggal = $artikel->tanggal_publikasi
                        ? Carbon::parse($artikel->tanggal_publikasi)->format('Y-m-d')
                        : '';
                @endphp
                <div class="mb-3">
                    <label for="tanggal_publikasi" class="form-label fw-semibold">Tanggal Publikasi</label>
                    <input type="date" name="tanggal_publikasi" id="tanggal_publikasi" class="form-control"
                           value="{{ old('tanggal_publikasi', $tanggal) }}" required>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label for="deskripsi" class="form-label fw-semibold">Deskripsi Artikel</label>
                    <textarea name="deskripsi" id="editor" rows="6" class="form-control" required>{{ old('deskripsi', $artikel->deskripsi) }}</textarea>
                </div>

                {{-- Gambar --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Gambar Saat Ini</label><br>
                    @if ($artikel->gambar)
                        <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="gambar artikel" class="img-thumbnail mb-3" width="200">
                    @else
                        <p class="text-muted">Tidak ada gambar</p>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label fw-semibold">Ganti Gambar (Opsional)</label>
                    <input type="file" name="gambar" id="gambar" class="form-control">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.artikel.index') }}" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Simpan Perubahan
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


    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-3">
                    <label for="judul" class="form-label fw-semibold">Judul Artikel</label>
                    <input type="text" name="judul" id="judul" class="form-control"
                           value="{{ old('judul', $artikel->judul) }}" required>
                </div>

                {{-- Penulis --}}
                <div class="mb-3">
                    <label for="penulis" class="form-label fw-semibold">Penulis</label>
                    <input type="text" name="penulis" id="penulis" class="form-control"
                           value="{{ old('penulis', $artikel->penulis) }}" required>
                </div>

                {{-- Tanggal Publikasi --}}
                @php
    
                    $tanggal = $artikel->tanggal_publikasi
                        ? Carbon::parse($artikel->tanggal_publikasi)->format('Y-m-d')
                        : '';
                @endphp
                <div class="mb-3">
                    <label for="tanggal_publikasi" class="form-label fw-semibold">Tanggal Publikasi</label>
                    <input type="date" name="tanggal_publikasi" id="tanggal_publikasi" class="form-control"
                           value="{{ old('tanggal_publikasi', $tanggal) }}" required>
                </div>

                {{-- Isi Artikel --}}
                <div class="mb-3">
                    <label for="isi" class="form-label fw-semibold">Isi Artikel</label>
                    <textarea name="isi" id="isi" rows="6" class="form-control" required>{{ old('isi', $artikel->isi ?? $artikel->deskripsi) }}</textarea>
                </div>

                {{-- Gambar --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Gambar Saat Ini</label><br>
                    @if ($artikel->gambar)
                        <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="gambar artikel" class="img-thumbnail mb-3" width="200">
                    @else
                        <p class="text-muted">Tidak ada gambar</p>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label fw-semibold">Ganti Gambar (Opsional)</label>
                    <input type="file" name="gambar" id="gambar" class="form-control">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.artikel.index') }}" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
