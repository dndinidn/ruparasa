@extends('admin.master')

@section('konten')
<div class="container mt-4">

    <!-- Judul Halaman -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark">
            <i class="fas fa-store" style="color:#e06629;"></i> Daftar Penjual
        </h3>

        <span class="badge" style="background:#e06629; color:white;">
            Total Penjual: {{ $penjuals->count() }}
        </span>
    </div>

    <!-- Kartu Data Penjual -->
    <div class="card shadow-lg border-0 rounded-3" style="background:white;">

        <!-- Header CARD ORANGE -->
        <div class="card-header text-white" style="background:#e06629;">
            <h5 class="mb-0"><i class="fas fa-list"></i> Data Penjual Terdaftar</h5>
        </div>

        <div class="card-body bg-white">
            <!-- FORM PENCARIAN -->
            <form action="{{ route('admin.penjual') }}" method="GET" class="mb-3">
                <div class="input-group" style="max-width: 330px;">
                    <input type="text" name="search" class="form-control"
                        placeholder="Cari nama / email..."
                        value="{{ request('search') }}">
                    <button class="btn btn-dark" type="submit"
                        style="background:#e06629; border-color:#e06629;">
                        Cari
                    </button>
                </div>
            </form>
            <!-- END FORM -->
            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <!-- TABLE HEAD ORANGE MUDA -->
                    <thead class="text-center" style="background:#ffb98a; color:black;">
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
                                <i class="fas fa-exclamation-circle" style="color:#e06629;"></i>
                                Belum ada penjual yang terdaftar.
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
