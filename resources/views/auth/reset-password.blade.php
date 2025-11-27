<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --orange: #ff7a2d;
            --orange-dark: #e06629;
            --font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        /* --- CONTAINER UTAMA & PEMUSATAN FLEXBOX (Background Oranye) --- */
        body {
            font-family: var(--font-family);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 0;
            background-color: var(--orange); /* Menggunakan warna oranye penuh sebagai latar belakang */
        }

        /* --- KOTAK FORM RESET (Split Screen Card) --- */
        .reset-container {
            width: 100%;
            max-width: 900px; /* Lebar total untuk split screen */
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            overflow: hidden;
            margin: 20px;
        }

        /* 1. KOLOM IMAGE (Sisi Branding/Kiri) */
        .image-panel {
            /* Ganti dengan path gambar yang Anda gunakan */
            background: url("/images/bg-rasa.jpg") no-repeat center center;
            background-size: cover;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100%;
            padding: 30px;
        }
        .image-panel::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to top right, rgba(0,0,0,0.6), rgba(52, 58, 64, 0.4));
            z-index: 1;
        }
        .branding-content {
            position: relative;
            z-index: 2;
            color: white;
            text-align: center;
        }
        .branding-content h2 {
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 10px;
        }

        /* 2. KOLOM FORM (Sisi Kanan) */
        .form-panel {
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 450px; /* Minimal tinggi agar visualnya bagus */
        }
        .form-content {
            max-width: 380px;
            width: 100%;
            margin: 0 auto;
        }

        /* --- JUDUL & BUTTON STYLING --- */
        h3 {
            color: var(--orange-dark);
            font-weight: 700;
            font-size: 1.75rem;
            margin-bottom: 25px !important;
        }
        .form-control {
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 0.95rem;
        }
        .form-control:focus {
            border-color: var(--orange);
            box-shadow: 0 0 0 0.25rem rgba(255, 122, 45, 0.25);
        }
        .form-label {
            font-weight: 500;
            color: #555;
            margin-bottom: 5px;
        }
        .btn-primary {
            background: var(--orange) !important;
            border-color: var(--orange-dark) !important;
            border-radius: 8px;
            padding: 10px 0;
            font-size: 1rem;
            margin-top: 15px;
        }
        .btn-primary:hover {
            background: var(--orange-dark) !important;
            border-color: var(--orange-dark) !important;
        }
        a {
            color: var(--orange-dark) !important;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
        }
        a:hover {
            text-decoration: underline;
        }
        .alert-danger {
            font-size: 0.9rem;
            border-radius: 8px;
        }

        /* --- Responsive Design (Hilangkan Gambar di layar kecil) --- */
        @media (max-width: 991px) {
            .image-panel {
                display: none;
            }
            .form-panel {
                width: 100%;
                min-height: auto;
            }
            .reset-container {
                 max-width: 450px;
            }
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <div class="row g-0">

            <div class="col-lg-6 d-none d-lg-flex image-panel">
                <div class="branding-content">
                    <i class="fas fa-lock fa-3x mb-3"></i>
                    <h2>Atur Ulang Sandi Anda</h2>
                    <p class="h6 mt-3">Sandi baru Anda harus berbeda dari sandi yang pernah Anda gunakan sebelumnya.</p>
                </div>
            </div>

            <div class="col-12 col-lg-6 form-panel">
                 <div class="form-content">
                    <h3 class="text-center mb-4">Reset Password</h3>
                    <p class="text-muted mb-4 text-center">Masukkan email dan password baru kamu.</p>

                    {{-- Tampilkan error validasi --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0 text-start">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                        {{-- Laravel memerlukan token dan email (yang dikirim melalui link email reset) --}}
                        <input type="hidden" name="token" value="{{ $token ?? '' }}">

                        <div class="mb-3 text-start">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Masukkan email" required value="{{ old('email', $email ?? '') }}">
                        </div>

                        <div class="mb-3 text-start">
                            <label class="form-label">Password Baru</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan password baru" required>
                        </div>

                        <div class="mb-3 text-start">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi password baru" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                    </form>

                    <div class="mt-3 text-center">
                        <a href="{{ route('login') }}">
                            <i class="fas fa-arrow-left me-1"></i> Kembali ke Login
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>
</body>
</html>
