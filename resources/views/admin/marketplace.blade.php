@extends('admin.master')

@section('konten')
<div class="container-fluid py-4">
    <h1 class="h3 mb-4" style="color: #e06629;">🏪 Daftar Toko & Penjual di Marketplace</h1>

    @if($toko->isEmpty())
        <div class="alert text-white text-center py-3" style="background-color: #e06629;">
            Belum ada toko yang terdaftar.
        </div>
    @else
        <div class="card shadow-sm border-0 rounded-3" style="border-top: 4px solid #e06629;">
            <div class="card-body">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="text-white text-center" style="background-color: #e06629;">
                        <tr>
                            <th>ID</th>
                            <th>Nama Toko</th>
                            <th>Nama Penjual</th>
                            <th>Email Penjual</th>
                            <th>Tanggal Bergabung</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($toko as $t)
                        <tr>
                            <td class="text-center">{{ $t->id }}</td>
                            <td>{{ $t->nama_toko }}</td>
                            <td>{{ $t->user->name ?? '-' }}</td>
                            <td>{{ $t->user->email ?? '-' }}</td>
                            <td class="text-center">
                                {{ $t->user->created_at ? $t->user->created_at->format('d M Y') : '-' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
