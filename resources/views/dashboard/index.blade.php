@extends('dashboard.master')
@section('konten')

<div class="hero overlay">
	<div class="img-bg rellax">
		<img src="{{ asset('assets/images/bg-home2.jpg') }}" alt="Image" class="img-fluid">
	</div>

	<div class="container">
		<div class="row align-items-center justify-content-start">
			<div class="col-lg-5">
				<h1 class="heading" data-aos="fade-up">Jelajahi Keberagaman Menarik di Pulau Sulawesi</h1>
				<p class="mb-5" data-aos="fade-up">
					Sulawesi, pulau dengan sejuta pesona! Temukan keindahan pantainya, keramahan masyarakatnya, dan kekayaan budayanya yang unik.
				</p>

				<div data-aos="fade-up">
					<a href="https://youtu.be/i0IFWilci1c?si=-pDsYHf6NFfzhuvt"
					   class="play-button align-items-center d-flex glightbox3">
						<span class="icon-button me-3">
							<span class="icon-play"></span>
						</span>
						<span class="caption">Sejarah Sulawesi</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="section section-2">
	<div class="container">
		<div class="row align-items-center justify-content-between">
			<div class="col-lg-6 order-lg-2 mb-5 mb-lg-0">
				{{-- <div class="image-stack mb-5 mb-lg-0">
					<div class="image-stack__item image-stack__item--bottom" data-aos="fade-up">
						<img src="{{ asset('images/img_v_1.jpg') }}" alt="Image" class="img-fluid rellax">
					</div>
					<div class="image-stack__item image-stack__item--top" data-aos="fade-up" data-aos-delay="100" data-rellax-percentage="0.5">
						<img src="{{ asset('images/img_v_2.jpg') }}" alt="Image" class="img-fluid">
					</div>
				</div> --}}
			</div>
			<div class="col-lg-4 order-lg-1">
				<!-- Anda bisa menambahkan konten tambahan di sini jika diperlukan -->
			</div>
		</div>
	</div>
</div>

{{-- ====== PETA INTERAKTIF PULAU SULAWESI ====== --}}
<div class="section section-map my-3"> {{-- 🔹 ubah dari my-5 ke my-3 agar jaraknya lebih kecil --}}
	<div class="container text-center">
		<h2>🗾 Peta Interaktif Pulau Sulawesi</h2>
		<p>Klik salah satu wilayah untuk melihat informasi selengkapnya.</p>
		<div id="map"></div>
	</div>
</div>
{{-- ====== RESEP TERBARU ====== --}}
<!-- <div class="section section-resep my-5">
    <div class="container">
        <h2 class="text-center mb-4">🍽️ Resep Terbaru</h2>
        <div class="row">

            @foreach($reseps as $resep)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if($resep->gambar)
                            <img src="{{ asset('storage/' . $resep->gambar) }}" class="card-img-top" alt="{{ $resep->nama_rasa }}">
                        @else
                            <img src="{{ asset('assets/images/default-resep.jpg') }}" class="card-img-top" alt="Default">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $resep->nama_rasa }}</h5>
                            <p class="card-text text-truncate">{{ $resep->resep }}</p>
                            <a href="{{ route('resep.show.frontend', $resep->id) }}" class="btn btn-primary mt-auto">Lihat Resep</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div> -->

<<<<<<< HEAD
       
=======
        <div class="text-center mt-4">
            <a href="{{ route('resep.index.frontend') }}" class="btn btn-outline-primary">See More</a>
        </div>
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
    </div>
</div>

{{-- ====== CSS UNTUK PETA ====== --}}
<style>
	#map {
		height: 400px;
		width: 80%;
		margin: 10px auto 0 auto; /* 🔹 margin atas dikurangi agar lebih naik */
		border-radius: 12px;
		box-shadow: 0 4px 12px rgba(0,0,0,0.1);
		transition: all 0.3s ease;
	}
	#map:hover {
		box-shadow: 0 6px 16px rgba(0,0,0,0.15);
	}
	@media (max-width: 768px) {
		#map {
			height: 300px;
			width: 95%;
			margin-top: 5px;
		}
	}
</style>

{{-- ====== LEAFLET JS DAN SCRIPT PETA ====== --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
	document.addEventListener("DOMContentLoaded", () => {
		const map = L.map('map', {
			minZoom: 6,
			maxZoom: 10,
			maxBounds: [
				[-7.5, 116.5],
				[2.5, 126.5]
			]
		}).setView([-1.5, 120.0], 6.3);

		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; OpenStreetMap contributors'
		}).addTo(map);

		const wilayah = [
			{ name: "Sulawesi Selatan", capital: "Makassar", coords: [-5.1354, 119.4238], link: "/informasi/sulawesi-selatan" },
			{ name: "Sulawesi Utara", capital: "Manado", coords: [1.4931, 124.8413], link: "/informasi/sulawesi-utara" },
			{ name: "Sulawesi Barat", capital: "Mamuju", coords: [-2.6769, 118.8576], link: "/informasi/sulawesi-barat" },
			{ name: "Sulawesi Tengah", capital: "Palu", coords: [-0.9058, 119.8707], link: "/informasi/sulawesi-tengah" },
			{ name: "Sulawesi Tenggara", capital: "Kendari", coords: [-3.9776, 122.5149], link: "/informasi/sulawesi-tenggara" },
			{ name: "Gorontalo", capital: "Gorontalo", coords: [0.5333, 123.0667], link: "/informasi/gorontalo" }
		];

		wilayah.forEach(w => {
			L.marker(w.coords).addTo(map)
				.bindPopup(`
					<b>${w.name}</b><br>
					Ibu Kota: <b>${w.capital}</b><br>
					<a href="${w.link}">Lihat Informasi Selengkapnya</a>
				`);
		});
	});
</script>

@endsection
