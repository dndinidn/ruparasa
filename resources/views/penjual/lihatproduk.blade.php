@extends('penjual.master')

@section('konten')

<style>
    /* WARNA ORANYE */
    .text-orange {
        color: #e06629 !important;
    }

    .btn-orange {
        background-color: #e06629 !important;
        border-color: #e06629 !important;
        color: #fff !important;
    }

    .btn-orange:hover {
        background-color: #cc5a25 !important;
    }

    .card-header-orange {
        background-color: #e06629 !important;
        color: white !important;
    }
</style>

<div class="container-fluid">

    <h1 class="h3 mb-4 text-orange">Daftar Produk Kuliner</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center card-header-orange">
            <h6 class="m-0 font-weight-bold">Data Produk</h6>
            <a href="{{ route('produk.create') }}" class="btn btn-orange btn-sm">
                <i class="fas fa-plus"></i> Tambah Produk
            </a>
        </div>

        <div class="card-body">
<<<<<<< HEAD
            <div class="card-body">

    {{-- FORM PENCARIAN --}}
    <form action="{{ route('produk.index') }}" method="GET" class="mb-3 d-flex justify-content-end">
        <input type="text" name="search" class="form-control w-25 mr-2" 
               placeholder="Cari produk..." value="{{ request('search') }}">
        <button class="btn btn-orange" type="submit">
            <i class="fas fa-search"></i> Cari
        </button>
    </form>

=======
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
            @if($produks->isEmpty())
                <p class="text-center text-muted">Belum ada data produk.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead style="background-color:#ffe4d6">
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
<<<<<<< HEAD
                                <th>Kategori</th>
=======
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produks as $index => $produk)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $produk->nama_produk }}</td>
                                    <td>
<<<<<<< HEAD
                                        <span class="badge badge-warning p-2" style="font-size: 13px;">
                                            {{ $produk->kategori ?? 'Tidak Ada Kategori' }}
                                        </span>
                                    </td>

                                    <td>
=======
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
                                        <a href="{{ route('produk.show', $produk->id) }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>

                                        <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

<<<<<<< HEAD
                                        <form action="{{ route('produk.destroy', $produk->id) }}" method="POST"
                                              class="d-inline"
=======
                                        <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" class="d-inline"
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
                                              onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
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
