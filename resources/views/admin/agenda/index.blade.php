@extends('admin.master')

@section('konten')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Agenda Budaya</h3>
<<<<<<< HEAD

        <form action="{{ route('admin.agenda.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control mr-2"
                   placeholder="Cari agenda..." value="{{ request('search') }}">
            <button class="btn btn-secondary">Cari</button>
        </form>

        <a href="{{ route('admin.agenda.create') }}" class="btn btn-primary ml-2">
            Tambah Agenda
        </a>
=======
        <a href="{{ route('admin.agenda.create') }}" class="btn btn-primary">Tambah Agenda</a>
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
<<<<<<< HEAD
            
            {{-- Pesan jika hasil pencarian kosong --}}
            @if(request('search') && $agendaBudaya->count() == 0)
                <p class="text-center text-muted">
                    Tidak ada agenda yang cocok dengan "<strong>{{ request('search') }}</strong>"
                </p>
            @endif

=======
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
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
<<<<<<< HEAD
                                        <a href="{{ route('admin.agenda.show', $agenda->id) }}" 
                                           class="btn btn-sm btn-info text-white">
=======
                                        <a href="{{ route('admin.agenda.show', $agenda->id) }}" class="btn btn-sm btn-info text-white">
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
                                            <i class="fas fa-eye"></i> Detail
                                        </a>

                                        <!-- Tombol Edit -->
<<<<<<< HEAD
                                        <a href="{{ route('admin.agenda.edit', $agenda->id) }}" 
                                           class="btn btn-sm btn-warning">
=======
                                        <a href="{{ route('admin.agenda.edit', $agenda->id) }}" class="btn btn-sm btn-warning">
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        <!-- Tombol Hapus -->
<<<<<<< HEAD
                                        <form action="{{ route('admin.agenda.destroy', $agenda->id) }}" 
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus agenda ini?');">
=======
                                        <form action="{{ route('admin.agenda.destroy', $agenda->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus agenda ini?');">
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
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
