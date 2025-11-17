<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Akun Penjual</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --orange: #ff7a2d;
            --orange-dark: #e06629;
        }

        /* Background */
        body {
            background: url("/images/bg-register.jpg") no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            position: relative;
        }

        /* Overlay Gelap */
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.45);
            z-index: 1;
        }

        .wrapper {
            position: relative;
            z-index: 2;
            padding-top: 60px;
            padding-bottom: 60px;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0px 8px 20px rgba(0,0,0,0.3);
        }

        .form-control {
            border-radius: 10px;
        }

        /* Tombol ORANGE */
        .btn-primary {
            background: var(--orange) !important;
            border-color: var(--orange-dark) !important;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background: var(--orange-dark) !important;
            border-color: var(--orange) !important;
        }

        /* Link ORANGE */
        a, a:hover {
            color: var(--orange-dark) !important;
            text-decoration: none;
        }

        /* Warna teks jadi hitam agar jelas */
        h3, h5, label, p {
            color: #000 !important;
        }
    </style>
</head>

<body>

    <div class="container wrapper d-flex justify-content-center">
        <div class="col-md-5 col-lg-4">
            
            <div class="card p-4">
                <h3 class="text-center mb-4">Register Penjual</h3>

                <form method="POST" action="{{ route('registerpenjual.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kata Sandi</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Kata Sandi</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <hr>
                    <h5>Data Toko</h5>

                    <div class="mb-3">
                        <label class="form-label">Nama Toko</label>
                        <input type="text" name="nama_toko" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kontak</label>
                        <input type="text" name="kontak" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Daftar Sekarang</button>
                </form>

                <p class="text-center mt-3 text-dark">
                    Sudah punya akun? <a href="{{ route('login') }}">Login</a>
                </p>
            </div>

        </div>
    </div>

</body>
</html>
