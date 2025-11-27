<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
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
        .forgot-container {
            width: 100%;
            max-width: 800px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            margin: 20px;
        }

        /* 1. KOLOM FORM (Sisi Kanan) */
        .form-panel { padding: 30px 25px; display: flex; flex-direction: column; justify-content: center; min-height: 100%; }
        .form-content { max-width: 350px; width: 100%; }

        /* 2. KOLOM IMAGE (Sisi Branding/Kiri) */
        .image-panel {
            background: url("/images/bg-rasa.jpg") no-repeat center center;
            background-size: cover;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100%;
        }
        .image-panel::before { content: ""; position: absolute; inset: 0; background: linear-gradient(to top right, rgba(0,0,0,0.6), rgba(52, 58, 64, 0.4)); z-index: 1; }
        .branding-content { position: relative; z-index: 2; color: white; padding: 15px; text-align: center; }
        .branding-content h2 { font-weight: 700; font-size: 1.75rem; margin-bottom: 10px; }
        .branding-content p { font-weight: 300; font-size: 0.9rem; }

        /* --- Responsive Design --- */
        @media (max-width: 991px) {
            .image-panel { display: none; }
            .form-panel { width: 100% !important; padding: 25px; }
            .form-content { max-width: 400px; }
            .forgot-container { max-width: 450px; }
        }

        /* --- Styling Form Elements --- */
        h3.title { font-size: 1.5rem; margin-bottom: 25px; color: var(--orange-dark); font-weight: 700; }
        .form-label { font-size: 0.85rem; font-weight: 500; margin-bottom: 4px; }
        .form-control { border-radius: 8px; padding: 8px 10px; font-size: 0.9rem; height: auto; }
        .mb-3 { margin-bottom: 1.5rem !important; }
        .btn-primary { background: var(--orange) !important; border-color: var(--orange-dark) !important; padding: 8px 0; font-size: 0.95rem; border-radius: 8px; margin-top: 10px; }
        .btn-primary:hover { background: var(--orange-dark) !important; }
        a { color: var(--orange-dark) !important; text-decoration: none; font-weight: 500; font-size: 0.9rem; }
        a:hover { text-decoration: underline; }
        .text-muted { font-size: 0.85rem; }

        /* Modal Custom Style */
        .modal-header, .modal-footer { border: none; }
        .modal-title { color: var(--orange-dark); font-weight: 700; }

        /* Modifikasi Tombol di Modal Footer */
        .modal-footer {
             padding-top: 0;
             padding-bottom: 20px;
             padding-left: 20px;
             padding-right: 20px;
        }
        .modal-footer .btn-primary {
            background-color: var(--orange);
            border-color: var(--orange-dark);
            padding: 10px 0; /* Menambah padding vertikal */
            font-size: 1rem; /* Membuat teks tombol sedikit lebih besar */
        }

        /* Menyesuaikan teks di modal body untuk tampilan profesional */
        .modal-body h4 {
            font-weight: 600; /* Sedikit lebih tebal dari normal */
            color: #333;
            margin-bottom: 15px;
        }
        .modal-body p {
            line-height: 1.6; /* Spasi antar baris lebih baik */
            color: #555;
            margin-bottom: 10px;
        }
        .modal-body .small.text-muted {
            font-size: 0.8rem; /* Sedikit lebih kecil agar fokus ke pesan utama */
            color: #777 !important;
        }

    </style>
</head>

<body>

    <div class="forgot-container">
        <div class="row g-0">

            <div class="col-lg-7 d-none d-lg-block image-panel">
                <div class="branding-content">
                    <i class="fas fa-envelope fa-2x mb-2"></i>
                    <h2>Reset Sandi Anda</h2>
                    <p class="h6">Kami akan membantu Anda mendapatkan kembali akses ke akun. Cek email Anda untuk tautan reset.</p>
                </div>
            </div>

            <div class="col-12 col-lg-5 form-panel">
                <div class="form-content mx-auto">

                    <h3 class="text-center title">Lupa Password</h3>
                    <p class="text-muted mb-4 text-center">Masukkan email kamu. Kami akan mengirim link untuk reset password.</p>

                    {{-- Form kirim email reset --}}
                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="mb-3 text-start">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email aktif" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Kirim Link Reset Password</button>
                    </form>

                    <div class="mt-4 text-center">
                        <a href="{{ route('login') }}"><i class="fas fa-arrow-left me-2"></i>Kembali ke Login</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- MODAL POP-UP SUKSES --}}
    @if (session('success'))
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel"><i class="fas fa-check-circle me-2" style="color: var(--orange-dark);"></i> Proses Berhasil!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <i class="fas fa-envelope-open-text fa-4x mb-4" style="color: var(--orange);"></i>

                    {{-- PESAN UTAMA DALAM BAHASA INDONESIA, TANPA MARKDOWN ** --}}
                    <h4 class="mb-3">
                        Link Reset Sandi Telah Dikirim
                    </h4>

                    <p class="mb-2">
                        Kami telah mengirimkan tautan untuk mengatur ulang kata sandi Anda ke email
                        <strong>{{ session('email') ?? 'yang Anda masukkan' }}</strong>.
                    </p>
                    <p class="small text-muted mb-4">
                        Silakan periksa folder *inbox* atau folder *spam* email Anda.
                    </p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary w-100" data-bs-dismiss="modal">
                        Oke, Saya Mengerti
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>

    {{-- SCRIPT OTOMATIS MEMUNCULKAN MODAL --}}
    @if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var modalElement = document.getElementById('successModal');

            if (modalElement) {
                var successModal = new bootstrap.Modal(modalElement);
                successModal.show();
            }
        });
    </script>
    @endif
</body>
</html>
