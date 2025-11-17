@extends('admin.master')

@section('konten')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-orange">📗 Daftar Cerita</h2>
        <a href="{{ route('cerita.create') }}" class="btn btn-orange">➕ Tambah Cerita</a>
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
            @php $filteredCeritas = $ceritas->where('status', 'diterima'); @endphp

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
                <td colspan="4" class="text-center text-muted">Belum ada cerita</td>
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
</style>
@endsection
