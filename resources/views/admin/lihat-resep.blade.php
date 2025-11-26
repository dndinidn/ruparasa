@extends('admin.master')

@section('konten')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Daftar Rasa & Resep Kuliner</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <div class="card shadow mb-4">

        <!-- HEADER -->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Resep</h6>

            <a href="{{ route('resep.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Resep
            </a>
        </div>

        <!-- FORM SEARCH DI BAWAH TAMBAH RESEP -->
        <div class="p-3">
            <form method="GET" action="{{ route('resep.index') }}">
                <div class="input-group">
                    <input type="text" name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Cari nama kuliner...">

                    <div class="input-group-append">
                        <button class="btn btn-primary">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body">
            @if($reseps->isEmpty())
                <p class="text-center text-muted">Belum ada data resep.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Kuliner</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reseps as $index => $resep)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $resep->nama_rasa }}</td>
                                    <td>
                                        <a href="{{ route('resep.detail', $resep->id) }}" class="btn btn-warning btn-sm mb-1">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>

                                        <a href="{{ route('resep.edit', $resep->id) }}" class="btn btn-info btn-sm mb-1">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        <form action="{{ route('resep.destroy', $resep->id) }}" method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus resep ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
