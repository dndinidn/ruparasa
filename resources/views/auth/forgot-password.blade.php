<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --orange: #ff7a2d;
            --orange-dark: #e06629;
        }

        body {
            background: url("/images/bg-login.jpg") no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
        }

        .forgot-box {
            background: rgba(255, 255, 255, 0.95);
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
            max-width: 400px;
            margin: 80px auto;
        }

        .btn-primary {
            background: var(--orange) !important;
            border-color: var(--orange-dark) !important;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background: var(--orange-dark) !important;
            border-color: var(--orange) !important;
        }

        a, a:hover {
            color: var(--orange) !important;
            text-decoration: none;
        }

        h3 {
            color: var(--orange-dark);
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="forgot-box text-center">
            <h3 class="mb-4">Lupa Password</h3>
            <p class="text-muted mb-4">Masukkan email kamu. Kami akan mengirim link untuk reset password.</p>

            {{-- Notifikasi sukses --}}
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Form kirim email reset --}}
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="mb-3 text-start">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Kirim Link Reset Password</button>
            </form>

            <div class="mt-3">
                <a href="{{ route('login') }}">Kembali ke Login</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
