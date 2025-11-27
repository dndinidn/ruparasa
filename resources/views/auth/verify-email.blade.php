@extends('Layouts.app')

@section('content')
<style>
    :root {
        --orange: #ff7a2d;
        --orange-dark: #e06629;
        --font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }

    /* Kontainer Utama Section: Mengisi sisa viewport dan memusatkan konten */
    .verification-wrapper {
        min-height: 100vh; /* Memastikan wrapper mengisi seluruh tinggi viewport */
        background-color: var(--orange);
        display: flex;
        justify-content: center;
        align-items: center; /* PUSAT UTAMA VERTICAL */
        padding: 20px 0; /* Padding vertikal agar konten tidak menempel tepi */
    }

    /* Kartu Kontainer Verifikasi */
    .verification-box {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        max-width: 450px;
        width: 90%;
        text-align: center;
    }

    .verification-box h2 {
        font-size: 1.5rem;
        color: var(--orange-dark);
        margin-bottom: 20px;
        font-weight: 700;
    }

    .verification-box p {
        font-size: 0.9rem;
        color: #555;
        margin-bottom: 20px;
    }

    .alert {
        font-size: 0.85rem;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .btn-primary {
        background: var(--orange) !important;
        border-color: var(--orange-dark) !important;
        padding: 8px 15px;
        font-size: 0.9rem;
        border-radius: 8px;
        transition: background 0.3s;
    }

    .btn-primary:hover {
        background: var(--orange-dark) !important;
    }

</style>

{{-- Wrapper Baru untuk memusatkan tampilan secara vertikal dan horizontal --}}
<div class="verification-wrapper">
    <div class="verification-box">
        <i class="fas fa-paper-plane fa-3x mb-3" style="color: var(--orange-dark);"></i>
        <h2 class="text-center">Verifikasi Email Anda</h2>

        <p>
            Sebelum melanjutkan, silakan cek email Anda untuk tautan verifikasi.
            Jika belum menerima email, klik tombol di bawah untuk kirim ulang.
        </p>

        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary w-100">
                Kirim Ulang Email Verifikasi
            </button>
        </form>
    </div>
</div>
@endsection
