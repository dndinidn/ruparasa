@extends('admin.master')

@section('konten')
<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Detail Agenda Budaya</h4>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th width="200">Nama Agenda</th>
                    <td>: {{ $agenda->nama }}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>: {{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y') }}</td>
                </tr>
                <tr>
                    <th>Lokasi</th>
                    <td>: {{ $agenda->lokasi }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>: {{ $agenda->deskripsi }}</td>
                </tr>
            </table>

            <div class="mt-4">
                <a href="{{ route('admin.agenda.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
