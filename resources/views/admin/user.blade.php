@extends('admin.master')

@section('konten')
<div class="container mt-4">

    <!-- Judul Halaman -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark">
            <i class="fas fa-users" style="color:#e06629;"></i> Daftar Pengguna Biasa
        </h3>
        <span class="badge" style="background:#e06629; color:white;">
            Total Pengguna: {{ $users->count() }}
        </span>
    </div>

    <!-- Card -->
    <div class="card shadow-lg border-0 rounded-3" style="background:white;">

<<<<<<< HEAD
        <!-- Header -->
=======
        <!-- Header CARD = ORANGE TUA -->
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
        <div class="card-header text-white" style="background:#e06629;">
            <h5 class="mb-0">
                <i class="fas fa-list"></i> Data Pengguna
            </h5>
        </div>

        <div class="card-body bg-white">
<<<<<<< HEAD

            <!-- FORM PENCARIAN -->
            <form action="{{ route('admin.user') }}" method="GET" class="mb-3">
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

=======
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
            <div class="table-responsive">

                <table class="table table-hover align-middle">

<<<<<<< HEAD
=======
                    <!-- THEAD = ORANGE MUDA -->
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
                    <thead class="text-center" style="background:#ffb98a; color:#000;">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Dibuat Pada</th>
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
                                <i class="fas fa-exclamation-circle" style="color:#e06629;"></i>
                                Belum ada pengguna yang terdaftar.
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
