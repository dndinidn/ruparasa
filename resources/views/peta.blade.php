<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Peta Pulau Sulawesi Saja</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #eef2ff;
            margin: 0;
        }
        h2 {
            color: #1e3a8a;
            margin-top: 20px;
        }
        #map {
            height: 600px;
            width: 90%;
            margin: auto;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <h2>🗾 Peta Interaktif Pulau Sulawesi</h2>
    <p>Klik salah satu wilayah untuk melihat informasi selengkapnya.</p>
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Inisialisasi peta dan set view di tengah Pulau Sulawesi
        const map = L.map('map', {
            minZoom: 6,
            maxZoom: 10,
            maxBounds: [
                [-7.5, 116.5],  // Barat Daya (batas bawah kiri)
                [2.5, 126.5]    // Timur Laut (batas atas kanan)
            ]
        }).setView([-1.5, 120.0], 6.3);

        // Tambahkan layer OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Tambahkan data wilayah + ibu kota
        const wilayah = [
            { name: "Sulawesi Selatan", capital: "Makassar", coords: [-5.1354, 119.4238], link: "/informasi/sulawesi-selatan" },
            { name: "Sulawesi Utara", capital: "Manado", coords: [1.4931, 124.8413], link: "/informasi/sulawesi-utara" },
            { name: "Sulawesi Barat", capital: "Mamuju", coords: [-2.6769, 118.8576], link: "/informasi/sulawesi-barat" },
            { name: "Sulawesi Tengah", capital: "Palu", coords: [-0.9058, 119.8707], link: "/informasi/sulawesi-tengah" },
            { name: "Sulawesi Tenggara", capital: "Kendari", coords: [-3.9776, 122.5149], link: "/informasi/sulawesi-tenggara" },
            { name: "Gorontalo", capital: "Gorontalo", coords: [0.5333, 123.0667], link: "/informasi/gorontalo" }
        ];

        // Loop marker + popup
        wilayah.forEach(w => {
            L.marker(w.coords).addTo(map)
                .bindPopup(`
                    <b>${w.name}</b><br>
                    Ibu Kota: <b>${w.capital}</b><br>
                    <a href="${w.link}">Lihat Informasi Selengkapnya</a>
                `);
        });
    </script>
</body>
</html>
