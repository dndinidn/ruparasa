<!-- /*
* Template Name: Sterial
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="author" content="Untree.co">
	<link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}">

	<meta name="description" content="" />
	<meta name="keywords" content="bootstrap, bootstrap5" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Brygada+1918:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@400;700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="{{ asset('assets/fonts/icomoon/style.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/fonts/flaticon/font/flaticon.css') }}">

	<link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/flatpickr.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/glightbox.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

	<title>RupaRasa &mdash; Free Bootstrap 5 Website Template by Untree.co</title>
</head>
<body>
@include('dashboard.navbar')
@yield('konten')


	<div class="site-footer">
		<div class="container">

			<div class="row">
				<div class="col-lg-4">
				
				</div>

				<div class="col-lg-2 ml-auto">
					<div class="widget">
						<h3>Links</h3>
						<ul class="list-unstyled float-left links">
							<li><a href="/home">Home</a></li>
							<li><a href="/toko">Marketplace</a></li>
							<li><a href="/profil">Profil</a></li>
							<li><a href="/rupa">Rupa</a></li>
							<li><a href="/rasa">Rasa</a></li>
						</ul>
					</div>
				</div>

				

				<div class="col-lg-3">
					<div class="widget">
						<h3>Contact</h3>
						<address>4Majene, Sulawesi Barat</address>
						<ul class="list-unstyled links mb-4">
							<li><a href="tel://11234567890">+62-456-7890</a></li>
	
							<li><a href="mailto: rupara002@gmail.com">rupara002@gmail.com</a></li>
						</ul>
					</div>
				</div>

			</div>

			<div class="row mt-5">
				<div class="col-12 text-center">
					<p class="mb-0">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved <a href="https:/themewagon.com" target="_blank">Ruparasa</a>
					</p>
				</div>
			</div>
		</div>
	</div>

	<!-- Preloader -->
	<div id="overlayer"></div>
	<div class="loader">
		<div class="spinner-border text-primary" role="status">
			<span class="visually-hidden">Loading...</span>
		</div>
	</div>

	<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('assets/js/tiny-slider.js') }}"></script>
	<script src="{{ asset('assets/js/aos.js') }}"></script>
	<script src="{{ asset('assets/js/navbar.js') }}"></script>
	<script src="{{ asset('assets/js/counter.js') }}"></script>
	<script src="{{ asset('assets/js/rellax.js') }}"></script>
	<script src="{{ asset('assets/js/flatpickr.js') }}"></script>
	<script src="{{ asset('assets/js/glightbox.min.js') }}"></script>
	<script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>
