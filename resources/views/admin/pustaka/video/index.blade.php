@extends('admin.master')

@section('konten')
<div class="container-fluid py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h4 font-weight-bold text-primary mb-0">Daftar Video Pustaka</h2>
            <p class="text-muted mb-0">Kelola koleksi video dokumenter budaya secara efisien.</p>
        </div>
        <a href="{{ route('admin.video.create') }}" class="btn btn-primary shadow-sm">Tambah Video</a>
    </div>

    <!-- Alert sukses -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <!-- Data Table -->
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold">Data Video</h6>
            <span class="badge badge-light">{{ $videos->count() }} Video</span>
        </div>

        <div class="card-body bg-white">
            @if ($videos->isEmpty())
                <div class="text-center py-5 text-muted">Belum ada video yang ditambahkan.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-primary text-dark">
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($videos as $index => $video)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="font-weight-bold text-primary">{{ $video->judul }}</td>

                                    <!-- Aksi -->
                                    <td>
                                        <a href="{{ route('admin.video.show', $video->id) }}" class="btn btn-sm btn-info text-white me-1">Detail</a>
                                        <a href="{{ route('admin.video.edit', $video->id) }}" class="btn btn-sm btn-warning me-1">Edit</a>

                                        <form action="{{ route('admin.video.destroy', $video->id) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus video ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
