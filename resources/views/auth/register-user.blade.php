<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --orange: #ff7a2d;
            --orange-dark: #e06629;
            --font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        /* CONTAINER UTAMA: Full screen, background ORANGE */
        body {
            font-family: var(--font-family);
            min-height: 100vh;
            display: flex;
            align-items: stretch;
            margin: 0;
            padding: 0;
            overflow-y: auto;
            background-color: var(--orange);
            justify-content: center;
            align-items: center;
        }

        /* Kartu Kontainer Utama (Floating Card) */
        .register-container {
            width: 100%;
            max-width: 850px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            margin: 20px;
        }

        /* 1. KOLOM FORM */
        .form-panel {
            padding: 40px 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 100%;
        }

        .form-content {
            max-width: 350px;
            width: 100%;
        }

        /* 2. KOLOM IMAGE */
        .image-panel {
            background: url("/images/bg-rasa.jpg") no-repeat center center;
            background-size: cover;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 450px;
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
            padding: 15px;
            text-align: center;
        }

        .branding-content h2 {
            font-weight: 700;
            font-size: 1.75rem;
            margin-bottom: 10px;
        }

        .branding-content p {
            font-weight: 300;
            font-size: 0.9rem;
        }

        /* --- Responsive Design --- */
        @media (max-width: 991px) {
            .image-panel {
                display: none;
            }
            .form-panel {
                width: 100% !important;
                padding: 30px;
            }
            .form-content {
                max-width: 400px;
            }
            .register-container {
                max-width: 450px;
            }
        }

        /* --- Styling Form Elements --- */

        h3.title {
            font-size: 1.75rem;
            color: var(--orange-dark);
            font-weight: 700;
            margin-bottom: 25px;
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 4px;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 0.95rem;
            height: auto;
        }

        /* Highlight border saat error */
        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }

        .btn-primary {
            background: var(--orange) !important;
            border-color: var(--orange-dark) !important;
            padding: 10px 0;
            font-size: 1rem;
            border-radius: 8px;
            margin-top: 15px;
            font-weight: 600;
        }

        .btn-primary:hover {
            background: var(--orange-dark) !important;
        }

        /* Link ORANGE */
        a, a:hover {
            color: var(--orange-dark) !important;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .text-center.mt-3 {
            font-size: 0.9rem;
        }

        /* Styling untuk Alert Error */
        .alert-danger {
            font-size: 0.9rem;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 10px 15px;
        }
        .alert-danger ul {
            padding-left: 20px;
            margin-bottom: 0;
            text-align: left;
        }
        .invalid-feedback {
            font-size: 0.8rem;
            margin-top: 5px;
        }
    </style>
</head>

<body>

    <div class="register-container">
        <div class="row g-0">

            <div class="col-lg-6 d-none d-lg-block image-panel">
                <div class="branding-content">
                    <i class="fas fa-user-plus fa-2x mb-2"></i>
                    <h2>Daftar Akun Pengguna Baru</h2>
                    <p class="h6">Akses penuh ke semua fitur platform. Proses cepat, hanya butuh beberapa detik.</p>
                </div>
            </div>

            <div class="col-12 col-lg-6 form-panel">
                <div class="form-content mx-auto">

                    <h3 class="text-center title">Register Akun</h3>

                    {{-- 🛑 1. BLOK UNTUK MENAMPILKAN SEMUA ERROR (Global Alert) --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register-user.store') }}">
                        @csrf

                        {{-- 🛑 2. NAMA LENGKAP --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Masukkan Nama Anda" required autofocus value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 🛑 3. ALAMAT EMAIL --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="contoh@email.com" required value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 🛑 4. KATA SANDI --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Minimal 8 Karakter" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 🛑 5. KONFIRMASI KATA SANDI --}}
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Ulangi Kata Sandi" required>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Daftar</button>
                    </form>
                    <p class="text-center mt-3">
                        Sudah punya akun?
                        <a href="{{ route('login') }}">Login</a>
                    </p>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>
</body>
</html>
