@extends('dashboard.master')

@section('konten')

<!-- 🟧 HEADER DENGAN GAMBAR LATAR -->
<div class="header-resep text-center py-5 mb-5">
    <div class="header-overlay">
        <h1 class="fw-bold text-uppercase mb-2 title-white">{{ $resep->nama_rasa }}</h1>
        <p class="mb-0 subtitle-white">Menemukan cita rasa khas dari {{ $resep->provinsi_asal ?? 'Sulawesi' }}</p>
    </div>
</div>

<div class="container" style="padding-bottom: 60px;">
    <div class="row justify-content-center">
        <div class="col-lg-6"> {{-- 🔹 ukuran card pas di tengah --}}
            <div class="card shadow-sm p-3 border-0 rounded-4"> {{-- 🔹 gaya lembut --}}

                @if($resep->gambar)
                    <img src="{{ asset('storage/' . $resep->gambar) }}" class="card-img-top rounded-3 mb-3" alt="{{ $resep->nama_rasa }}" style="object-fit: cover; max-height: 350px;">
                @else
                    <img src="{{ asset('assets/images/default-resep.jpg') }}" class="card-img-top rounded-3 mb-3" alt="Default" style="object-fit: cover; max-height: 350px;">
                @endif

                <div class="card-body">
                    <h2 class="card-title fw-bold text-orange mb-3">{{ $resep->nama_rasa }}</h2>

                    {{-- 🏝️ Provinsi Asal --}}
                    @if(!empty($resep->provinsi_asal))
                        <p class="text-muted"><i class="bi bi-geo-alt-fill text-orange"></i> {{ $resep->provinsi_asal }}</p>
                    @endif

                    <h5 class="fw-semibold text-dark mt-3">Resep</h5>
                    <p class="card-text">{{ $resep->resep }}</p>

                    <h5 class="fw-semibold text-dark mt-4">Sejarah</h5>
                    <p class="card-text">{{ $resep->sejarah }}</p>

                    <a href="{{ url()->previous() }}" class="btn btn-outline-orange mt-3 rounded-pill px-4">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 🧩 Tambahan Style -->
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

body, h1, h2, h3, h4, h5, h6, p, button, input, textarea {
    font-family: 'Inter', sans-serif !important;
}

/* 🧡 HEADER DENGAN GAMBAR */
.header-resep {
    background: url('/images/bg-rasa.jpg') center center/cover no-repeat;
    border-radius: 0 0 20px 20px;
    position: relative;
    overflow: hidden;
    height: 300px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.header-resep .header-overlay {
    background-color: rgba(220, 212, 212, 0.45);
    padding: 40px;
    border-radius: 15px;
}
.title-white {
    color: #ffffff;
    text-shadow: 2px 2px 10px rgba(0,0,0,0.7);
}
.subtitle-white {
    color: #ffffff;
    opacity: 0.95;
    text-shadow: 1px 1px 8px rgba(0,0,0,0.5);
}

/* 🧡 Warna dan Tombol */
.text-orange { color: #f77f00 !important; }

.btn-outline-orange {
    border: 1px solid #f77f00;
    color: #f77f00;
    background: transparent;
}
.btn-outline-orange:hover {
    background-color: #f77f00;
    color: #fff;
}
</style>
@endsection
