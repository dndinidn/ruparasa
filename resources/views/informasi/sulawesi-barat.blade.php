<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Provinsi Sulawesi Barat</title>
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
    <h1>Provinsi Sulawesi Barat</h1>
    <p>Ibu Kota: <b>Mamuju</b></p>
  </header>

  <main>
    <!-- Gambaran Umum -->
    <section>
      <h2>Gambaran Umum</h2>
      <p>
        Sulawesi Barat (Sulbar) adalah provinsi muda di Indonesia yang berdiri pada tahun 2004. 
        Wilayahnya terletak di bagian barat Pulau Sulawesi dengan ibu kota di <b>Mamuju</b>.
      </p>
      <p>
        Provinsi ini berbatasan dengan Sulawesi Tengah di utara, Sulawesi Selatan di selatan, 
        dan Selat Makassar di barat. Meskipun provinsi baru, Sulbar memiliki potensi alam yang besar, 
        terutama di bidang pertanian, kelautan, dan pariwisata.
      </p>
      <p>
        Suku utama yang mendiami wilayah ini adalah <b>Mandar</b>, bersama dengan Bugis, Makassar, dan Toraja. 
        Sulawesi Barat terkenal dengan budaya maritimnya yang kuat dan semangat gotong royong masyarakatnya.
      </p>
      <img src="{{ asset('assets/images/pantai-mamuju.jpeg') }}" alt="Pantai Mamuju Sulawesi Barat">
      <p><i>Pantai Mamuju</i> — keindahan pesisir barat Sulawesi yang menawan.</p>
    </section>

    <!-- Kebudayaan -->
    <section>
      <h2>Kebudayaan</h2>
      <p>
        Budaya masyarakat Sulawesi Barat banyak dipengaruhi oleh tradisi suku Mandar. 
        Nilai-nilai seperti <b>siri’</b> (harga diri) dan <b>pesse</b> (solidaritas) juga menjadi bagian penting kehidupan sosialnya.  
        Tarian khas seperti <b>Tari Patuddu</b> melambangkan kelembutan dan keramahan perempuan Mandar.
      </p>
    </section>

    <!-- Kuliner -->
    <section>
      <h2>Kuliner Khas</h2>
      <ul>
        <li><b>Tetu</b> – makanan dari campuran tepung beras, santan, dan gula merah yang dibungkus daun pisang.</li>
        <img src="{{ asset('assets/images/tetu.jpeg') }}" alt="Tetu Sulawesi Barat">

        <li><b>Ubi Tumbuk</b> – hidangan sederhana dari ubi jalar tumbuk yang disajikan dengan parutan kelapa.</li>
        <img src="{{ asset('assets/images/ubi-tumbuk.jpeg') }}" alt="Ubi Tumbuk Mandar">

        <li><b>Ikan Bakar Mandar</b> – ikan laut segar dibakar dengan bumbu khas Mandar yang gurih dan pedas.</li>
        <img src="{{ asset('assets/images/ikan-bakar-mandar.jpeg') }}" alt="Ikan Bakar Mandar">
      </ul>
    </section>

    <!-- Pakaian Adat & Rumah -->
    <section>
      <h2>Pakaian & Rumah Adat</h2>
      <p>
        Pakaian adat Sulawesi Barat menonjolkan keanggunan dan kesederhanaan khas suku Mandar. 
        Rumah adat tradisionalnya disebut <b>Banua</b>, berbentuk panggung dari kayu, 
        yang mencerminkan kehidupan masyarakat pesisir yang dekat dengan laut.
      </p>
      <img src="{{ asset('assets/images/banua-mandar.jpeg') }}" alt="Rumah Adat Banua Mandar">
    </section>

    <!-- Pakaian Adat Lengkap -->
    <section>
      <h2>Macam-Macam Pakaian Adat Sulawesi Barat</h2>

      <article>
        <h3>1️⃣ Pattuqduq Towaine (Pakaian Wanita Mandar)</h3>
        <img src="{{ asset('assets/images/pattuqduq-towaine.jpeg') }}" alt="Pattuqduq Towaine Mandar">
        <p>
          <b>Pattuqduq Towaine</b> adalah pakaian wanita suku Mandar yang biasanya digunakan dalam tarian tradisional. 
          Dihiasi dengan warna-warna cerah dan perhiasan emas yang melambangkan kemakmuran.
        </p>
      </article>

      <article>
        <h3>2️⃣ Baju Pokko Mandar (Pria)</h3>
        <img src="{{ asset('assets/images/baju-pokko.jpeg') }}" alt="Baju Pokko Mandar">
        <p>
          <b>Baju Pokko</b> merupakan pakaian pria tradisional Mandar dengan desain sederhana, 
          biasanya berwarna gelap dan dipadukan dengan sarung tenun khas Mandar.
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
