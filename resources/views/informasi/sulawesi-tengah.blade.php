<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Provinsi Sulawesi Tengah</title>
  <style>
    :root {
      --primary-blue: #0f3b57;
      --accent-orange: #f97316;
      --light-bg: #fdfaf6;
      --text-dark: #1e293b;
    }

    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      margin: 0;
      background: var(--light-bg);
      color: var(--text-dark);
    }

    header {
      background: linear-gradient(135deg, var(--primary-blue), #1e6091);
      color: white;
      text-align: center;
      padding: 40px 20px;
    }

    header h1 {
      font-size: 2rem;
      margin-bottom: 8px;
    }

    header p {
      margin: 0;
      font-size: 1.1rem;
      color: #e2e8f0;
    }

    main {
      max-width: 900px;
      margin: 40px auto;
      background: white;
      border-radius: 14px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.1);
      padding: 30px;
    }

    h2 {
      color: var(--primary-blue);
      border-left: 5px solid var(--accent-orange);
      padding-left: 10px;
      margin-bottom: 10px;
    }

    h3 {
      color: var(--accent-orange);
      margin-top: 20px;
    }

    img {
      width: 100%;
      border-radius: 12px;
      margin: 15px 0;
    }

    ul {
      padding-left: 20px;
    }

    a.kembali {
      display: inline-block;
      margin-top: 25px;
      background: var(--accent-orange);
      color: white;
      text-decoration: none;
      padding: 10px 18px;
      border-radius: 8px;
      font-weight: 600;
      transition: background 0.3s;
    }

    a.kembali:hover {
      background: #ea580c;
    }

    footer {
      text-align: center;
      color: #64748b;
      font-size: 0.9rem;
      padding: 20px 0 40px;
    }
  </style>
</head>
<body>
  <header>
    <h1>Provinsi Sulawesi Tengah</h1>
    <p>Ibu Kota: <b>Palu</b></p>
  </header>

  <main>
    <!-- Gambaran Umum -->
    <section>
      <h2>Gambaran Umum</h2>
      <p>
        Sulawesi Tengah adalah provinsi yang terletak di bagian tengah Pulau Sulawesi, Indonesia.
        Wilayahnya memiliki bentang alam yang sangat beragam — mulai dari pegunungan, lembah, hingga pesisir pantai.
        Ibu kotanya adalah <b>Palu</b>.
      </p>
      <p>
        Provinsi ini berbatasan dengan Sulawesi Utara di utara, Sulawesi Barat di barat,
        Sulawesi Selatan dan Tenggara di selatan, serta Laut Maluku di timur.
        Luas wilayahnya sekitar 68.000 km² dengan penduduk lebih dari 3 juta jiwa.
      </p>
      <p>
        Sulawesi Tengah dikenal dengan keindahan alam dan kekayaan budaya suku-suku lokal,
        seperti <b>Kaili</b>, <b>Banggai</b>, <b>Buol</b>, dan <b>Mori</b>.
        Selain itu, daerah ini memiliki sejarah panjang sejak masa kerajaan-kerajaan lokal
        hingga masa perjuangan kemerdekaan Indonesia.
      </p>
      <img src="{{ asset('assets/images/palu.jpg') }}" alt="Kota Palu">
      <p><i>Kota Palu</i> — pusat pemerintahan dan ekonomi Sulawesi Tengah.</p>
    </section>

    <!-- Kebudayaan -->
    <section>
      <h2>Kebudayaan</h2>
      <p>
        Masyarakat Sulawesi Tengah menjunjung tinggi nilai <b>nosarara nosabatutu</b> 
        yang berarti “bersaudara dan bersatu”.
        Suku-suku di daerah ini memiliki bahasa dan tradisi yang beragam, namun tetap saling menghormati.
      </p>
      <p>
        Upacara adat seperti <b>Vunja</b> dan <b>Nosarara Nosabatutu</b> masih sering dilaksanakan
        sebagai bentuk penghormatan terhadap leluhur dan kebersamaan antarwarga.
      </p>
    </section>

    <!-- Kuliner -->
    <section>
      <h2>Kuliner Khas</h2>
      <ul>
        <li><b>Kaledo</b> – kaki sapi dengan kuah asam pedas khas Palu.</li> 
        <img src="{{ asset('assets/images/kaledo.jpg') }}" alt="Kaledo Palu">

        <li><b>Uta Kelo</b> – ikan kuah santan pedas khas Donggala.</li>
        <img src="{{ asset('assets/images/uta.webp') }}" alt="Uta Kelo">

        <li><b>Sinole</b> – makanan pokok tradisional dari tepung sagu.</li>
        <img src="{{ asset('assets/images/sinole.jpeg') }}" alt="Sinole Sulawesi Tengah">
      </ul>
    </section>

    <!-- Pakaian Adat & Rumah -->
    <section>
      <h2>Pakaian & Rumah Adat</h2>
      <p>
        Pakaian adat Sulawesi Tengah sangat beragam, di antaranya <b>Nggembe</b> untuk wanita dan <b>Koje</b> untuk pria.
        Rumah adatnya disebut <b>Rumah Tambi</b>, berbentuk panggung dengan atap tinggi.
        Arsitektur rumah ini disesuaikan dengan kondisi alam pegunungan dan berfungsi untuk perlindungan dari binatang liar.
      </p>
        <img src="{{ asset('assets/images/pakaian.webp') }}" alt="Pakaian Adat">
        <img src="{{ asset('assets/images/rumahadat.jpg') }}" alt="Rumah Adat">

    </section>

    <!-- Pakaian Adat Lengkap -->
    <section>
      <h2>Macam-Macam Pakaian Adat Sulawesi Tengah</h2>

      <article>
        <h3>1️⃣ Pakaian Nggembe (Wanita Kaili)</h3>
        <img src="{{ asset('assets/images/nggembe.jpeg') }}" alt="Pakaian Nggembe">
        <p>
          <b>Nggembe</b> adalah pakaian wanita Kaili berupa baju longgar tanpa kerah dengan hiasan benang emas di tepinya.
          Biasanya dipadukan dengan sarung berwarna cerah dan perhiasan kepala.
        </p>
      </article>

      <article>
        <h3>2️⃣ Pakaian Koje (Pria Kaili)</h3>
        <img src="{{ asset('assets/images/koje.jpeg') }}" alt="Pakaian Koje Pria Kaili">
        <p>
          <b>Koje</b> adalah pakaian pria berbentuk jas tertutup yang dipadukan dengan sarung tenun.
          Melambangkan kewibawaan dan kesopanan laki-laki Kaili.
        </p>
      </article>

      <article>
        <h3>3️⃣ Pakaian Suku Lore</h3>
        <img src="{{ asset('assets/images/lore.jpeg') }}" alt="Pakaian Suku Lore">
        <p>
          Busana adat suku Lore biasanya digunakan pada upacara adat dan perayaan panen.
          Warna dominannya merah dan hitam, menggambarkan keberanian dan kekuatan.
        </p>
      </article>

      <article>
        <h3>4️⃣ Pakaian Banggai</h3>
        <img src="{{ asset('assets/images/banggai.jpeg') }}" alt="Pakaian Banggai">
        <p>
          Pakaian adat Banggai menggunakan bahan sutra dengan hiasan khas laut,
          mencerminkan kehidupan masyarakat pesisir dan pelaut di wilayah Banggai.
        </p>
      </article>

      <article>
        <h3>5️⃣ Pakaian Buol</h3>
        <img src="{{ asset('assets/images/buol.jpeg') }}" alt="Pakaian Buol">
        <p>
          Pakaian adat Buol memiliki motif geometris yang khas dengan perpaduan warna cerah.
          Biasanya dikenakan dalam acara adat dan pernikahan.
        </p>
      </article>

    </section>

    <a href="/home" class="kembali">⬅ Kembali ke Peta</a>
  </main>

  <footer>
    RupaRasa Sulawesi © 2025 | Menjaga Budaya Nusantara
  </footer>
</body>
</html>
