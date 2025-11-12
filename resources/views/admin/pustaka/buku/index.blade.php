@extends('admin.master')

@section('konten')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">📚 Daftar Buku</h2>
        <a href="{{ route('admin.buku.create') }}" class="btn btn-primary shadow-sm">Tambah Buku</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($bukus->isEmpty())
        <div class="alert alert-info text-center">Belum ada buku yang ditambahkan.</div>
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
