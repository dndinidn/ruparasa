@extends('admin.master')

@section('konten')
<div class="container mt-4">
    <!-- Judul Halaman -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-primary">
            <i class="fas fa-users"></i> Daftar Pengguna Biasa
        </h3>
        <span class="badge bg-info text-dark">
            Total Pengguna: {{ $users->count() }}
        </span>
    </div>

    <!-- Kartu Tabel -->
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-list"></i> Data Pengguna</h5>
        </div>
        <div class="card-body bg-light">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Dibuat Pada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $user)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-center">{{ $user->created_at->format('d M Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                <i class="fas fa-exclamation-circle"></i> Belum ada pengguna yang terdaftar.
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
