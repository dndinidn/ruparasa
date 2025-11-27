<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Akun</title>
<<<<<<< HEAD
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
=======
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a

    <style>
        :root {
            --orange: #ff7a2d;
            --orange-dark: #e06629;
<<<<<<< HEAD
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
            /* Latar belakang utama: Oranye */
            background-color: var(--orange);
            justify-content: center;
            align-items: center;
        }

        /* Kartu Kontainer Utama (Floating Card) */
        .login-container {
            width: 100%;
            max-width: 800px; /* Ukuran total container ramping */
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            margin: 20px;
        }

        /* 1. KOLOM FORM (Kanan/Kiri) */
        .form-panel {
            padding: 25px 20px; /* Padding form ringkas */
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 100%;
        }

        /* Membatasi lebar konten form */
        .form-content {
            max-width: 350px;
            width: 100%;
        }

        /* 2. KOLOM IMAGE (Sisi Branding) */
        .image-panel {
            /* Ganti dengan URL gambar bertema yang sesuai */
            background: url("images/bg-rasa.jpg") no-repeat center center;
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
            /* Overlay untuk meningkatkan kontras teks */
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
                padding: 25px;
            }
            .form-content {
                max-width: 400px;
            }
            .login-container {
                max-width: 450px;
            }
        }


        /* --- Styling Form Elements (Ringkas) --- */

        h3.title {
            font-size: 1.5rem;
            margin-bottom: 25px;
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 4px;
        }

        .form-control {
            border-radius: 8px;
            padding: 8px 10px;
            font-size: 0.9rem;
            height: auto;
        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }

        .btn-primary {
            background: var(--orange) !important;
            border-color: var(--orange-dark) !important;
            padding: 8px 0;
            font-size: 0.95rem;
            border-radius: 8px;
            margin-top: 10px;
=======
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
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
        }

        .btn-primary:hover {
            background: var(--orange-dark) !important;
<<<<<<< HEAD
        }

        /* Link ORANGE */
        a, a:hover {
            color: var(--orange-dark) !important;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
        }

        /* Dropdown Register */
        .dropdown-menu {
             border-radius: 8px;
             font-size: 0.9rem;
        }

        .dropdown-item:hover {
             background-color: var(--orange) !important;
             color: white !important;
        }

        .mt-3.text-center {
            font-size: 0.85rem;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="row g-0">

            <div class="col-lg-7 d-none d-lg-block image-panel">
                <div class="branding-content">
                    <i class="fas fa-lock fa-2x mb-2"></i>
                    <h2>Selamat Datang Kembali!</h2>
                    <p class="h6">Masuk ke akun Anda untuk melanjutkan aktivitas. Akses cepat dan aman.</p>
                </div>
            </div>

            <div class="col-12 col-lg-5 form-panel">
                <div class="form-content mx-auto">

                    <h3 class="text-center title">Login Akun</h3>

                    {{-- Pesan sukses dari register --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show small" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Pesan error --}}
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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

                        <ul class="dropdown-menu" aria-labelledby="dropdownRegister">
                            <li><a class="dropdown-item" href="{{ route('register-user') }}">Register sebagai User</a></li>
                            <li><a class="dropdown-item" href="{{ route('registerpenjual') }}">Register sebagai Penjual</a></li>
                        </ul>
                    </div>

                    <div class="mt-3 text-center">
                        <a href="{{ route('password.request') }}">Lupa Password?</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>
=======
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

                <ul class="dropdown-menu" aria-labelledby="dropdownRegister">
                    <li><a class="dropdown-item" href="{{ route('register-user') }}">Register sebagai User</a></li>
                    <li><a class="dropdown-item" href="{{ route('registerpenjual') }}">Register sebagai Penjual</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
</body>
</html>
