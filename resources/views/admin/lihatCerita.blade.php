@extends('admin.master')

@section('konten')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h2 class="fw-bold text-orange mb-2 mb-md-0">📗 Daftar Cerita</h2>

        <div class="d-flex align-items-center gap-2 flex-wrap">
            <!-- 🔍 Form Pencarian -->
            <form action="{{ route('cerita.index') }}" method="GET" class="d-flex">
                <div class="input-group">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari judul cerita...">
                    <button class="btn btn-orange" type="submit">Cari</button>
                </div>
            </form>

            <!-- Tombol Tambah Cerita -->
            <a href="{{ route('cerita.create') }}" class="btn btn-orange ms-3">➕ Tambah Cerita</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped shadow-sm">
        <thead class="table-orange text-center">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $filteredCeritas = $ceritas->where('status', 'diterima');
            @endphp

            @forelse($filteredCeritas as $index => $c)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $c->judul }}</td>
                <td class="text-center">
                    <span class="badge bg-success">Diterima</span>
                </td>
                <td class="text-center">
                    <a href="{{ route('admin.cerita.show', $c->id) }}" class="btn btn-info btn-sm text-white">Detail</a>
                    <a href="{{ route('cerita.edit', $c->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('cerita.destroy', $c->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus cerita ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center text-muted">Tidak ada cerita ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<style>
/* Warna Oranye Utama */
.text-orange { 
    color: #e06629 !important; 
}

/* Tombol Oranye */
.btn-orange {
    background-color: #e06629 !important;
    color: white !important;
    border: none !important;
}
.btn-orange:hover {
    background-color: #c75720 !important;
    color: white !important;
}

/* Header Tabel Oranye */
.table-orange {
    background-color: #e06629 !important;
    color: white !important;
}

/* Responsive agar search dan tombol tidak menempel di layar kecil */
@media(max-width: 768px){
    .d-flex.flex-wrap { flex-direction: column !important; gap: 10px; }
}
</style>
@endsection
