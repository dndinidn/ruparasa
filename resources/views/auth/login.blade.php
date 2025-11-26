<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --orange: #ff7a2d;
            --orange-dark: #e06629;
        }

        body {
            background: url("https://picsum.photos/1920/1080?blur=3") no-repeat center center fixed;
            background-size: cover;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            max-width: 400px;
            margin: 80px auto;
        }

        /* Tombol utama jadi ORANGE */
        .btn-primary {
            background: var(--orange) !important;
            border-color: var(--orange-dark) !important;
        }

        .btn-primary:hover {
            background: var(--orange-dark) !important;
            border-color: var(--orange) !important;
        }

        /* Link Register warna ORANGE */
        a, a:hover {
            color: var(--orange-dark) !important;
            text-decoration: none;
        }

        /* Dropdown item hover ORANGE */
        .dropdown-item:hover {
            background-color: var(--orange) !important;
            color: white !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h3 class="text-center mb-4">Login</h3>

            {{-- Pesan sukses dari register --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Pesan error --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>

            <div class="mt-3 text-center dropdown">
                Belum punya akun?
                <a href="#" class="dropdown-toggle" id="dropdownRegister"
                   data-bs-toggle="dropdown" aria-expanded="false">
                   Register
                </a>
                <div class="mt-2 text-center">
    <a href="{{ route('password.request') }}">Lupa Password?</a>
</div>

                <ul class="dropdown-menu" aria-labelledby="dropdownRegister">
                    <li><a class="dropdown-item" href="{{ route('register-user') }}">Register sebagai User</a></li>
                    <li><a class="dropdown-item" href="{{ route('registerpenjual') }}">Register sebagai Penjual</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
