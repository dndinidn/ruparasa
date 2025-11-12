@extends('admin.master')

@section('konten')
<div class="container mt-4">
    <h2 class="fw-bold mb-4">✏️ Edit Cerita</h2>

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

    <form action="{{ route('cerita.update', $cerita->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Judul Cerita</label>
            <input type="text" name="judul" class="form-control" value="{{ $cerita->judul }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Isi Cerita</label>
            <textarea name="isi_cerita" class="form-control" rows="5" required>{{ $cerita->isi_cerita }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Gambar Cerita (Opsional)</label><br>
            @if($cerita->gambar)
                <img src="{{ asset('storage/'.$cerita->gambar) }}" width="200" class="mb-2 rounded"><br>
            @endif
            <input type="file" name="gambar" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('cerita.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
