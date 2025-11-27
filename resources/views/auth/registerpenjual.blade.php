<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Penjual - [Nama Perusahaan Anda]</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --orange: #ff7a2d;
            --orange-dark: #e06629;
            --font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            --dark-grey: #343a40;
        }

        body {
            font-family: var(--font-family);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 0;
            overflow-y: auto;
            background-color: var(--orange);
        }

        .register-container {
            width: 100%;
            max-width: 900px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            margin: 20px;
        }

        .form-panel {
            background-color: #ffffff;
            padding: 30px 25px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow-y: auto;
            min-height: 100%;
        }

        .form-content {
            max-width: 350px;
            width: 100%;
        }

        .image-panel {
            background: url("/images/bg-register.jpg") no-repeat center center;
            background-size: cover;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100%;
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
            padding: 20px;
            text-align: center;
        }

        .branding-content h2 {
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 15px;
        }

        .branding-content p {
            font-weight: 300;
            font-size: 1rem;
        }

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

        .card-header-brand {
            background-color: var(--orange);
            color: #fff;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 1.1rem;
            font-weight: 600;
        }

        h3.title {
            font-size: 1.75rem;
            color: var(--orange-dark);
            font-weight: 700;
            margin-bottom: 15px;
        }

        h5 {
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--orange-dark);
            margin-top: 15px;
            border-bottom: 2px solid #eee;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        .form-label {
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 4px;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 0.95rem;
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-right: none;
            border-radius: 8px 0 0 8px !important;
            color: var(--dark-grey);
        }

        /* Penyesuaian untuk dropdown kode negara */
        .input-group .form-select {
            flex: 0 0 auto;
            width: auto;
            border-radius: 8px 0 0 8px !important;
            border-right: none;
            background-color: #f8f9fa;
            color: var(--dark-grey);
            padding-right: 30px !important;
        }
        .input-group .form-control {
             border-radius: 0 8px 8px 0 !important;
        }

        .btn-primary {
            background: var(--orange) !important;
            border-color: var(--orange-dark) !important;
            padding: 10px 0;
            font-size: 1rem;
            border-radius: 8px;
            margin-top: 20px;
            font-weight: 600;
        }

        .btn-primary:hover {
            background: var(--orange-dark) !important;
        }

        .text-dark.small a {
            color: var(--orange-dark) !important;
            font-weight: 600 !important;
        }

        .alert-danger {
            font-size: 0.9rem;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 10px 15px;
            color: #842029;
            background-color: #f8d7da;
            border-color: #f5c2c7;
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

            <div class="col-12 col-lg-5 form-panel">
                <div class="form-content mx-auto">

                    <div class="card-header-brand text-center">
                        <p class="h6 mb-0">Mitra Platform</p>
                    </div>

                    <h3 class="text-center title">Daftar Akun Baru</h3>

                    {{-- BLOK NOTIFIKASI ERROR GLOBAL --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('registerpenjual.store') }}" id="registerForm">
                        @csrf

                        <h5><i class="fas fa-user-circle me-2"></i>Data Akun</h5>

                        {{-- Nama Lengkap --}}
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Anda" required value="{{ old('name') }}">
                            </div>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text">@</span>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email aktif" required value="{{ old('email') }}">
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Kata Sandi --}}
                        <div class="mb-3">
                            <label class="form-label">Kata Sandi</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Min. 8 Karakter" required>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Konfirmasi Kata Sandi --}}
                        <div class="mb-4">
                            <label class="form-label">Konfirmasi Kata Sandi</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Ulangi kata sandi" required>
                            </div>
                            @error('password_confirmation')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>


                        <h5><i class="fas fa-store me-2"></i>Informasi Toko</h5>

                        {{-- Nama Toko/Usaha --}}
                        <div class="mb-3">
                            <label class="form-label">Nama Toko/Usaha</label>
                            <input type="text" name="nama_toko" class="form-control @error('nama_toko') is-invalid @enderror" placeholder="Contoh: Toko Maju Jaya" required value="{{ old('nama_toko') }}">
                            @error('nama_toko')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Alamat Toko --}}
                        <div class="mb-3">
                            <label class="form-label">Alamat Toko</label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="2" placeholder="Alamat lengkap">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Nomor Kontak (Dengan Skrip Pembatas Input) --}}
                        <div class="mb-4">
                            <label class="form-label">Nomor Kontak</label>
                            <div class="input-group">

                                {{-- Dropdown Kode Negara --}}
                                <select name="kode_negara" class="form-select" id="kode_negara" style="max-width: 100px;" required>
                                    <option value="+62" selected>+62 🇮🇩</option>
                                    <option value="+60">+60 🇲🇾</option>
                                    <option value="+65">+65 🇸🇬</option>
                                    <option value="+66">+66 🇹🇭</option>
                                    <option value="+81">+81 🇯🇵</option>
                                    <option value="+1">+1 🇺🇸</option>
                                </select>

                                {{-- Input Nomor Telepon (type="text" dengan oninput untuk memfilter karakter non-angka) --}}
                                <input
                                    type="text"
                                    name="kontak"
                                    id="kontak"
                                    class="form-control @error('kontak') is-invalid @enderror"
                                    placeholder="Nomor handphone"
                                    value="{{ old('kontak') }}"
                                    required
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                >
                            </div>
                            @error('kontak')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <div id="kontak-validation-feedback" class="invalid-feedback" style="display: none;">Hanya angka bulat positif yang diizinkan.</div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-2">
                            <i class="fas fa-sign-in-alt me-2"></i>Daftar Sekarang
                        </button>
                    </form>

                    <p class="text-center mt-3 text-dark small">
                        Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
                    </p>
                </div>
            </div>

            <div class="col-lg-7 d-none d-lg-block image-panel">
                <div class="branding-content">
                    <i class="fas fa-handshake fa-3x mb-3"></i>
                    <h2>Bergabunglah Sebagai Mitra Sukses Kami</h2>
                    <p class="h6">Daftarkan toko Anda sekarang dan jangkau pelanggan lebih luas. Kami menyediakan platform yang kuat untuk pertumbuhan bisnis Anda.</p>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const kontakInput = document.getElementById('kontak');
            const feedbackDiv = document.getElementById('kontak-validation-feedback');

            // Skrip utama untuk membersihkan input non-angka secara real-time
            kontakInput.oninput = function() {
                // Regex: /[^0-9]/g artinya ganti semua karakter yang BUKAN (^) angka 0-9 dengan string kosong ''
                this.value = this.value.replace(/[^0-9]/g, '');
            };

            // Tambahan: Memastikan input tidak mengandung angka negatif atau desimal saat submit (validasi tambahan)
            document.getElementById('registerForm').onsubmit = function(event) {
                const value = kontakInput.value;

                // Cek apakah input mengandung string non-angka setelah pembersihan (hanya jika Anda ingin validasi yang lebih ketat)
                // Sebenarnya sudah ditangani oleh oninput, tapi ini adalah lapisan pengamanan:
                if (value.includes('.') || value.includes('-') || value === '' || isNaN(value)) {
                    // Jika validasi server Anda memerlukan pesan ini, Anda bisa mengaktifkannya
                    // kontakInput.classList.add('is-invalid');
                    // feedbackDiv.style.display = 'block';
                    // event.preventDefault();
                    // return false;
                }

                // Karena kita menggunakan oninput, kita bergantung pada validasi server (Laravel)
                // untuk memberikan pesan error yang sebenarnya jika input kosong atau di bawah batas minimum/maksimum panjang.
                return true;
            };
        });
    </script>
</body>
</html>
