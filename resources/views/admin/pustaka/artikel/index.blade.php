@extends('admin.master')

@section('konten')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">📰 Daftar Artikel Pustaka</h2>
        <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Artikel
        </a>
    </div>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Jika tidak ada artikel --}}
    @if ($artikels->isEmpty())
        <div class="alert alert-info text-center">
            Belum ada artikel yang ditambahkan.
        </div>
    @else
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th style="width:5%">#</th>
                                <th style="width:60%">Judul</th>
                                <th style="width:35%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($artikels as $index => $artikel)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="fw-semibold">{{ $artikel->judul }}</td>
                                    <td>
                                        {{-- Tombol Detail --}}
                                        <a href="{{ route('admin.artikel.show', $artikel->id) }}" 
                                           class="btn btn-info btn-sm text-white me-1">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>

                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('admin.artikel.edit', $artikel->id) }}" 
                                           class="btn btn-warning btn-sm me-1">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>

                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('admin.artikel.destroy', $artikel->id) }}" 
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
