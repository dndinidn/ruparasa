@extends('penjual.master')

@section('konten')

<style>
    .badge-primary {
        background-color: #e06629 !important;
    }
    .text-primary {
        color: #e06629 !important;
    }
    h1 {
        color: #e06629 !important;
    }
</style>

<div class="container-fluid">
    <h1 class="h3 mb-4">Daftar Pesanan</h1>

<<<<<<< HEAD
    {{-- Form Pencarian --}}
    <form action="{{ route('pesanan.lihat') }}" method="GET" class="mb-3">
        <div class="input-group" style="max-width: 320px;">
            <input type="text" name="cari" class="form-control"
                   placeholder="Cari nomor pesanan / status..."
                   value="{{ request('cari') }}">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    Cari
                </button>
            </div>
        </div>
    </form>

=======
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
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
                    <th>Nomor Pesanan</th>
                    <th>Total (Rp)</th>
                    <th>Ongkir (Rp)</th>
                    <th>Status</th>
                    <th>Item Pesanan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                @forelse($pesanan as $index => $p)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>#{{ $p->id }}</td>

                        <td class="text-right">{{ number_format($p->total,0,',','.') }}</td>
<<<<<<< HEAD
                        {{-- <td class="text-right">{{ number_format($p->ongkir,0,',','.') }}</td> --}}
<td class="text-right">Rp 15.000</td>
=======
                        <td class="text-right">{{ number_format($p->ongkir,0,',','.') }}</td>

>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
                        <td>
                            @if($p->status == 'menunggu_konfirmasi')
                                <span class="badge badge-secondary">Menunggu Konfirmasi</span>

                            @elseif($p->status == 'dikemas')
                                <span class="badge badge-warning">Dikemas</span>

                            @elseif($p->status == 'dikirim')
                                <span class="badge badge-primary">Dikirim</span>

                            @elseif($p->status == 'selesai')
                                <span class="badge badge-success">Selesai</span>

                            @else
                                <span class="badge badge-secondary">{{ ucfirst($p->status) }}</span>

                            @endif
                        </td>

                        <td class="text-left">
                            <ul class="mb-0">
                                @foreach($p->items as $item)
                                    <li>{{ $item->produk->nama_produk }}</li>
                                @endforeach
                            </ul>
                        </td>

                        <td>
<<<<<<< HEAD
                            <form action="{{ route('pesanan.hapus', $p->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">

=======
                            <form action="{{ route('pesanan.hapus', $p->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                                
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>

                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Belum ada pesanan dikirim.
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>

@endsection
