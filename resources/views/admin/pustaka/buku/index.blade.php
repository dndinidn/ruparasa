@extends('admin.master')

@section('konten')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h2 class="fw-bold mb-2 mb-md-0">📚 Daftar Buku</h2>

        <div class="d-flex align-items-center gap-2 flex-wrap">
            <!-- Form Pencarian -->
            <form action="{{ route('admin.buku.index') }}" method="GET" class="d-flex">
                <div class="input-group">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari judul buku...">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </form>

            <!-- Tombol Tambah Buku -->
            <a href="{{ route('admin.buku.create') }}" class="btn btn-primary shadow-sm ms-2">Tambah Buku</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($bukus->isEmpty())
        <div class="alert alert-info text-center">Tidak ada buku ditemukan.</div>
    @else
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-center">
                        <thead class="table-dark">
                            <tr>
                                <th style="width:5%">#</th>
                                <th style="width:45%">Judul</th>
                                <th style="width:50%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bukus as $index => $buku)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="text-start">{{ $buku->judul }}</td>
                                    <td>
                                        <a href="{{ route('admin.buku.show', $buku->id) }}" class="btn btn-info btn-sm mb-1">Detail</a>
                                        <a href="{{ route('admin.buku.edit', $buku->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                                        <form action="{{ route('admin.buku.destroy', $buku->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Hapus</button>
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
