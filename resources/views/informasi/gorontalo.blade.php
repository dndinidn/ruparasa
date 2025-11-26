<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Provinsi Gorontalo</title>
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
    <h1>Provinsi Gorontalo</h1>
    <p>Ibu Kota: <b>Gorontalo</b></p>
  </header>

  <main>
    <!-- Gambaran Umum -->
    <section>
      <h2>Gambaran Umum</h2>
      <p>
        Provinsi Gorontalo terletak di bagian utara Pulau Sulawesi dan berbatasan langsung dengan Sulawesi Utara dan Teluk Tomini. 
        Gorontalo dikenal sebagai daerah yang memiliki julukan <b>Serambi Madinah</b> karena kuatnya nilai-nilai keislaman di masyarakatnya.
      </p>
      <p>
        Provinsi ini memiliki potensi besar di sektor pertanian, perikanan, dan pariwisata. 
        Keindahan pantainya, seperti <b>Pantai Olele</b> dan <b>Pantai Botutonuo</b>, menarik banyak wisatawan lokal maupun mancanegara.
      </p>
      <img src="{{ asset('assets/images/pantai-olele.jpeg') }}" alt="Pantai Olele Gorontalo">
      <p><i>Pantai Olele</i> — surga bawah laut yang menjadi ikon wisata Gorontalo.</p>
    </section>

    <!-- Kebudayaan -->
    <section>
      <h2>Kebudayaan</h2>
      <p>
        Kebudayaan Gorontalo sangat kental dengan tradisi dan nilai-nilai Islam. 
        Masyarakatnya menjunjung tinggi adat <b>Adati hula-hula’a to syara’a, syara’a hula-hula’a to Qur’ani</b>, 
        yang berarti “adat bersendikan syariat, dan syariat bersendikan Al-Qur’an”.
      </p>
      <p>
        Seni tari dan musik tradisional seperti <b>Tari Saronde</b> menjadi lambang kebersamaan dan sukacita, 
        biasanya ditampilkan dalam acara pernikahan adat.
      </p>
    </section>

    <!-- Kuliner -->
    <section>
      <h2>Kuliner Khas</h2>
      <ul>
        <li><b>Binte Biluhuta</b> – sup jagung khas Gorontalo yang dicampur dengan ikan cakalang dan udang.</li>
        <img src="{{ asset('assets/images/binte-biluhuta.jpeg') }}" alt="Binte Biluhuta Gorontalo">

        <li><b>Ilabulo</b> – olahan hati ayam dan tepung sagu yang dibungkus daun pisang, mirip pepes.</li>
        <img src="{{ asset('assets/images/ilabulo.jpeg') }}" alt="Ilabulo Gorontalo">

        <li><b>Tili Aya</b> – makanan manis dari telur dan gula merah, biasa disajikan dalam upacara adat.</li>
        <img src="{{ asset('assets/images/tili-aya.jpeg') }}" alt="Tili Aya Gorontalo">
      </ul>
    </section>

    <!-- Pakaian Adat & Rumah -->
    <section>
      <h2>Pakaian & Rumah Adat</h2>
      <p>
        Pakaian adat Gorontalo menggambarkan keanggunan dan kehormatan, dengan warna-warna cerah seperti kuning emas dan ungu. 
        Rumah adat tradisionalnya disebut <b>Dulohupa</b>, yang memiliki atap melengkung tinggi sebagai simbol musyawarah dan kebersamaan masyarakat Gorontalo.
      </p>
      <img src="{{ asset('assets/images/rumah-dulohupa.jpeg') }}" alt="Rumah Adat Dulohupa Gorontalo">
    </section>

    <!-- Pakaian Adat Lengkap -->
    <section>
      <h2>Macam-Macam Pakaian Adat Gorontalo</h2>

      <article>
        <h3>1️⃣ Biliu (Wanita)</h3>
        <img src="{{ asset('assets/images/biliu.jpeg') }}" alt="Pakaian Biliu Gorontalo">
        <p>
          <b>Biliu</b> adalah pakaian adat wanita Gorontalo yang biasanya digunakan dalam pernikahan. 
          Warnanya mencerminkan karakter: kuning untuk bangsawan, hijau untuk kesuburan, dan ungu untuk kebijaksanaan.
        </p>
      </article>

      <article>
        <h3>2️⃣ Paluwala (Pria)</h3>
        <img src="{{ asset('assets/images/paluwala.jpeg') }}" alt="Pakaian Paluwala Gorontalo">
        <p>
          <b>Paluwala</b> adalah pakaian adat pria Gorontalo, berbentuk jas panjang dengan celana longgar, 
          biasanya dipadukan dengan penutup kepala khas yang disebut <i>Panggoba</i>.
        </p>
      </article>

      <article>
        <h3>3️⃣ Makuta</h3>
        <img src="{{ asset('assets/images/makuta.jpeg') }}" alt="Makuta Gorontalo">
        <p>
          <b>Makuta</b> merupakan mahkota pengantin wanita Gorontalo yang terbuat dari logam berwarna emas, 
          melambangkan kemuliaan dan kehormatan keluarga.
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
