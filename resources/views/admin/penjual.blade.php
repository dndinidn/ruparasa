@extends('admin.master')

@section('konten')
<div class="container mt-4">
    <!-- Judul Halaman -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-primary">
            <i class="fas fa-store"></i> Daftar Penjual
        </h3>
        <span class="badge bg-primary-subtle text-primary border border-primary">
            Total Penjual: {{ $penjuals->count() }}
        </span>
    </div>

    <!-- Kartu Data Penjual -->
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-list"></i> Data Penjual Terdaftar</h5>
        </div>
        <div class="card-body bg-light">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal Bergabung</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($penjuals as $index => $penjual)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $penjual->name }}</td>
                            <td>{{ $penjual->email }}</td>
                            <td class="text-center">{{ $penjual->created_at->format('d M Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                <i class="fas fa-exclamation-circle"></i> Belum ada penjual yang terdaftar.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
