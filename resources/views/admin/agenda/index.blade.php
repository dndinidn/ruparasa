@extends('admin.master')

@section('konten')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Agenda Budaya</h3>

        <form action="{{ route('admin.agenda.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control mr-2"
                   placeholder="Cari agenda..." value="{{ request('search') }}">
            <button class="btn btn-secondary">Cari</button>
        </form>

        <a href="{{ route('admin.agenda.create') }}" class="btn btn-primary ml-2">
            Tambah Agenda
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            
            {{-- Pesan jika hasil pencarian kosong --}}
            @if(request('search') && $agendaBudaya->count() == 0)
                <p class="text-center text-muted">
                    Tidak ada agenda yang cocok dengan "<strong>{{ request('search') }}</strong>"
                </p>
            @endif

            @if($agendaBudaya->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Agenda</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($agendaBudaya as $index => $agenda)
                                <tr>
                                    <td>{{ $agendaBudaya->firstItem() + $index }}</td>
                                    <td>{{ $agenda->nama }}</td>
                                    <td>
                                        <!-- Tombol Detail -->
                                        <a href="{{ route('admin.agenda.show', $agenda->id) }}" 
                                           class="btn btn-sm btn-info text-white">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>

                                        <!-- Tombol Edit -->
                                        <a href="{{ route('admin.agenda.edit', $agenda->id) }}" 
                                           class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('admin.agenda.destroy', $agenda->id) }}" 
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus agenda ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                {{ $agendaBudaya->links() }}
            @else
                <p class="text-center text-muted">Belum ada data agenda.</p>
            @endif
        </div>
    </div>
</div>
@endsection
