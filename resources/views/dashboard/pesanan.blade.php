<<<<<<< HEAD
@extends('dashboard.layout')
=======
@extends('dashboard.master')
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a

@section('konten')
<style>
.text-orange { color: #f77f00 !important; }

.btn-orange {
    background: linear-gradient(90deg, #f77f00, #e06629);
    color: white;
    border-radius: 12px;
    font-weight: 600;
    padding: 10px 0;
    transition: all 0.3s ease;
}
<<<<<<< HEAD
.btn-orange:hover { opacity: 0.85; }

/* Gaya untuk tombol kembali */
.btn-back {
    color: #f77f00;
    border: 1px solid #f77f00;
    background-color: transparent;
    border-radius: 12px;
    padding: 8px 15px;
    font-weight: 600;
    transition: all 0.3s ease;
}
.btn-back:hover {
    background-color: #fff3e0; /* Sedikit latar belakang saat hover */
    color: #e06629;
}


.card { border-radius: 20px; overflow: hidden; }

.table th, .table td { vertical-align: middle; }
=======
.btn-orange:hover {
    opacity: 0.85;
}

.card {
    border-radius: 20px;
    overflow: hidden;
}

.table th, .table td {
    vertical-align: middle;
}
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
</style>

<div class="container my-5">
    <h2 class="text-orange fw-bold mb-4">Daftar Pesanan</h2>

    @if($pesanan)
        @php
<<<<<<< HEAD
            // Pastikan $pesanan->items->first() tidak null sebelum mengakses properti
            $item = $pesanan->items->first();
            $subtotal = $pesanan->items->sum(fn($i) => $i->harga * $i->jumlah);
            $ongkir = 15000;
            // Pastikan $item tidak null sebelum mengakses $item->produk
            $stokHabis = $item && $item->produk->stok < $item->jumlah;
=======
            $item = $pesanan->items->first();
            $subtotal = $pesanan->items->sum(fn($i) => $i->harga * $i->jumlah);
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
        @endphp

        <div class="card shadow-sm border-0 p-4">

<<<<<<< HEAD
            @if($item)
            {{-- TOMBOL KEMBALI: Sudah diperbaiki untuk meneruskan ID produk --}}
            <div class="mb-3">
                <a href="{{ route('produk.detail', $item->produk->id) }}" class="btn btn-back d-inline-flex align-items-center">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Detail Produk
                </a>
            </div>
            <hr class="mt-0 mb-3" />
            @endif

=======
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
            <table class="table table-bordered align-middle mb-3">
                <thead class="table-light">
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
<<<<<<< HEAD
                        <th>Stok</th>
=======
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
                    </tr>
                </thead>
                <tbody>
                    @if($item)
                    <tr>
                        <td>{{ $item->produk->nama_produk }}</td>
                        <td>Rp {{ number_format($item->harga,0,',','.') }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>Rp {{ number_format($item->harga * $item->jumlah,0,',','.') }}</td>
<<<<<<< HEAD
                        <td>{{ $item->produk->stok }}</td>
=======
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
                    </tr>
                    @endif
                </tbody>
            </table>

<<<<<<< HEAD
            <div class="mt-3 mb-3">
                <p><strong>Alamat:</strong> {{ $pesanan->alamat }}, {{ $pesanan->kota }}, {{ $pesanan->provinsi }}</p>
                <p><strong>Sub total produk:</strong> Rp {{ number_format($subtotal,0,',','.') }}</p>
                <p><strong>Ongkir:</strong> Rp {{ number_format($ongkir,0,',','.') }}</p>
                <p><strong>Total Pembayaran:</strong> Rp {{ number_format($subtotal + $ongkir,0,',','.') }}</p>
            </div>
=======
            {{-- Ringkasan --}}
            <div class="mt-3 mb-3">
@php
    $ongkir = 15000;
@endphp
                <p><strong>Alamat:</strong> {{ $pesanan->alamat }}, {{ $pesanan->kota }}, {{ $pesanan->provinsi }}</p>

<p><strong>Sub total pesanan:</strong> Rp {{ number_format($subtotal + $ongkir,0,',','.') }}</p>
<p><strong>Ongkir:</strong> Rp {{ number_format($ongkir,0,',','.') }}</p>
<p><strong>Total:</strong> Rp {{ number_format($subtotal + $ongkir,0,',','.') }}</p>

                  </div>
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a

            <button
                id="btnBayar"
                data-id="{{ $pesanan->id }}"
<<<<<<< HEAD
                class="btn btn-orange w-100 fw-semibold"
                @if($stokHabis) disabled @endif>
                @if($stokHabis)
                    Stok Habis
                @else
                    Checkout
                @endif
=======
                class="btn btn-orange w-100 fw-semibold">
                Checkout
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
            </button>

        </div>
    @else
        <p class="text-center text-muted py-4">Belum ada pesanan.</p>
    @endif
</div>

{{-- MODAL COD --}}
<div class="modal fade" id="codModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3 text-center">
        <h5 class="text-orange fw-bold mb-3">Pesanan Berhasil</h5>
        <p>Pesanan Anda akan diproses (COD). Terima kasih!</p>
        <button id="okCOD" class="btn btn-orange w-100" data-bs-dismiss="modal">Selesai</button>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<<<<<<< HEAD
{{-- Pastikan Anda juga sudah menyertakan library Font Awesome untuk ikon panah --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>

<script>
document.getElementById('btnBayar')?.addEventListener('click', function() {

    var pesananId = this.dataset.id;
    var stokHabis = {{ $stokHabis ? 'true' : 'false' }};

    if(stokHabis){
        Swal.fire({
            icon: 'warning',
            title: 'Stok Habis!',
            text: 'Produk yang Anda pilih tidak mencukupi stok.',
            confirmButtonColor: '#f77f00'
        });
        return;
    }

    // Tampilkan modal COD
=======

<script>
document.getElementById('btnBayar').addEventListener('click', function() {

    var pesananId = this.dataset.id;

    // Tampilkan modal
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
    var codModal = new bootstrap.Modal(document.getElementById('codModal'));
    codModal.show();

    document.getElementById('okCOD').addEventListener('click', function() {

<<<<<<< HEAD
        // Pastikan $item sudah didefinisikan sebelum mengakses propertinya di script ini
        @if($item)
        fetch("{{ route('pesananuser.bayar') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                produk_id: "{{ $item->produk->id }}",
                harga: "{{ $item->harga }}",
                jumlah: "{{ $item->jumlah }}"
            })
        })
=======
     fetch("{{ route('pesananuser.bayar') }}", {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": "{{ csrf_token() }}"
    },
   body: JSON.stringify({
    produk_id: "{{ $item->produk->id }}",
    harga: "{{ $item->harga }}",
    jumlah: "{{ $item->jumlah }}"
})

})

>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
        .then(res => res.json())
        .then(data => {
            if(data.success){
                Swal.fire({
                    icon: 'success',
                    title: 'Pesanan Berhasil!',
                    text: 'Pesanan Anda telah dikonfirmasi (COD).',
                    confirmButtonColor: '#f77f00',
                }).then(() => {
                    window.location.href = "{{ route('pesananuser.lihat') }}";
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: data.message || 'Terjadi kesalahan.',
                    confirmButtonColor: '#f77f00',
                });
            }
        })
        .catch(err => {
            console.error(err);
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Terjadi kesalahan saat memproses pesanan.',
                confirmButtonColor: '#f77f00',
            });
        });
<<<<<<< HEAD
        @endif
    }, { once: true });

});
</script>

@endsection
=======

    }, { once: true });

});

</script>

@endsection
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
