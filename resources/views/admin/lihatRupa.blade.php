@extends('admin.master')

@section('konten')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Daftar Rupa</h1>

<<<<<<< HEAD
=======
    <!-- Pesan sukses -->
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

<<<<<<< HEAD
=======
    <!-- Pesan error -->
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <div class="card shadow mb-4">
<<<<<<< HEAD

        <!-- HEADER -->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Rupa</h6>

=======
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Rupa</h6>
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
            <a href="{{ route('tambah.rupa') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Rupa
            </a>
        </div>

<<<<<<< HEAD
        <!-- FORM SEARCH (DIBAWAH TAMBAH RUPA) -->
        <div class="p-3">
            <form method="GET" action="{{ route('dashboard.lihatrupa') }}">
                <div class="input-group">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="form-control" placeholder="Cari judul rupa...">
                    <div class="input-group-append">
                        <button class="btn btn-primary">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>

=======
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
        <div class="card-body">
            @if($rupa->isEmpty())
                <p class="text-center text-muted">Belum ada data rupa.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rupa as $index => $rp)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $rp->judul }}</td>
                                    <td>
                                        <a href="{{ route('detail.rupa', $rp->id) }}" class="btn btn-warning btn-sm mb-1">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
<<<<<<< HEAD

                                        <a href="{{ route('editrupa', $rp->id) }}" class="btn btn-info btn-sm mb-1">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        <form action="{{ route('hapus.rupa', $rp->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus data rupa ini?')">
=======
                                        <a href="{{ route('editrupa', $rp->id) }}" class="btn btn-info btn-sm mb-1">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('hapus.rupa', $rp->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data rupa ini?')">
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
<<<<<<< HEAD

=======
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
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
