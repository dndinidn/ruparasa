@extends('penjual.master')

@section('konten')

<style>
    .btn-primary {
        background-color: #e06629 !important;
        border-color: #e06629 !important;
    }
    .btn-primary:hover {
        background-color: #c75822 !important;
        border-color: #c75822 !important;
    }
    .badge-primary {
        background-color: #e06629 !important;
    }
    .text-primary {
        color: #e06629 !important;
    }
</style>

<div class="container-fluid">
    <h1 class="h3 mb-4" style="color:#e06629;">Konfirmasi Pesanan</h1>

    {{-- FORM PENCARIAN --}}
    <form action="{{ route('penjual.pesanan') }}" method="GET" class="mb-3">
        <div class="input-group" style="max-width: 340px;">
            <input type="text" name="cari" class="form-control"
                placeholder="Cari user / produk / status..."
                value="{{ request('cari') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Total (Rp)</th>
                    <th>Ongkir (Rp)</th>
                    <th>Status</th>
                    <th>Item Pesanan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                @if($pesanan->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            Belum ada pesanan untuk saat ini.
                        </td>
                    </tr>
                @else
                    @foreach($pesanan as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $p->user->name ?? '-' }}</td>

                            <td class="text-right">{{ number_format($p->total,0,',','.') }}</td>

                            <td class="text-right">{{ number_format($p->ongkir,0,',','.') }}</td>

                            <td>
                                @switch($p->status)
                                    @case('dikemas')  <span class="badge badge-warning">Dikemas</span> @break
                                    @case('dikirim') <span class="badge badge-primary">Dikirim</span> @break
                                    @case('selesai') <span class="badge badge-success">Selesai</span> @break
                                    @default <span class="badge badge-secondary">{{ ucfirst($p->status) }}</span>
                                @endswitch
                            </td>

                            <td class="text-left">
                                @foreach($p->items as $item)
                                    <div>{{ $item->produk->nama_produk }} x {{ $item->jumlah }}</div>
                                @endforeach
                            </td>

                            <td>
                                <form action="{{ route('penjual.updateStatus', $p->id) }}" method="POST">
                                    @csrf

                                    <select name="status" class="form-control form-control-sm mb-1">
                                        <option value="dikemas"  {{ $p->status == 'dikemas' ? 'selected' : '' }}>Dikemas</option>
                                        <option value="dikirim" {{ $p->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                    </select>

                                    <button type="submit" class="btn btn-primary btn-sm btn-block">
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
    </div>
</div>

@endsection
