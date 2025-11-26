@extends('admin.master')

@section('konten')
<div class="container mt-4">
    <h2 class="fw-bold mb-4">📝 Ubah Status Cerita</h2>

    <form action="{{ route('admin.cerita.status', $cerita->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="judul" class="form-label">Judul Cerita</label>
            <input type="text" class="form-control" value="{{ $cerita->judul }}" disabled>
        </div>

        <div class="mb-3">
            <label for="isi_cerita" class="form-label">Isi Cerita</label>
            <textarea class="form-control" rows="5" disabled>{{ $cerita->isi_cerita }}</textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="diterima" {{ $cerita->status=='diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="ditolak" {{ $cerita->status=='ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="jawaban_admin" class="form-label">Jawaban Admin</label>
            <textarea name="jawaban_admin" class="form-control" rows="3">{{ old('jawaban_admin', $cerita->jawaban_admin) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update Status</button>
        <a href="{{ route('admin.cerita.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
