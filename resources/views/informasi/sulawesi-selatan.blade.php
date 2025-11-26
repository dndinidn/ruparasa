<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Provinsi Sulawesi Selatan</title>
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
    <h1>Provinsi Sulawesi Selatan</h1>
    <p>Ibu Kota: <b>Makassar</b></p>
  </header>

  <main>
    <!-- Gambaran Umum -->
    <section>
      <h2>Gambaran Umum</h2>
      <p>
        Sulawesi Selatan (disingkat Sulsel) adalah sebuah provinsi yang terletak di bagian selatan Pulau Sulawesi, Indonesia.
        Wilayah ini mencakup semenanjung selatan Sulawesi dan Kepulauan Selayar. Ibu kotanya adalah <b>Makassar</b>.
        Provinsi ini berbatasan dengan Sulawesi Tengah dan Sulawesi Barat di utara, Teluk Bone dan Sulawesi Tenggara di timur,
        Selat Makassar di barat, dan Laut Flores di selatan.
      </p>
      <p>
        Berdasarkan sensus 2010, penduduk Sulawesi Selatan mencapai lebih dari 8 juta jiwa dan terus meningkat hingga
        sekitar 9,4 juta jiwa pada tahun 2024. Provinsi ini merupakan wilayah dengan penduduk terbanyak di Pulau Sulawesi.
      </p>
      <p>
        Pada masa perdagangan rempah-rempah (abad ke-15 hingga ke-19), Sulawesi Selatan menjadi pusat perdagangan penting
        dan pintu gerbang menuju Kepulauan Maluku. Dua kerajaan besar pernah berkuasa di wilayah ini, yaitu
        <b>Kerajaan Gowa</b> di Makassar dan <b>Kerajaan Bone</b> di Bone. 
        VOC Belanda bersekutu dengan <b>Arung Palakka</b> untuk menaklukkan Kerajaan Gowa yang dipimpin oleh
        <b>Sultan Hasanuddin</b>, yang akhirnya dipaksa menandatangani <b>Perjanjian Bungaya</b>.
      </p>
      <img src="{{ asset('assets/images/pantailosari.jpg') }}" alt="Pantai Losari Makassar">
      <p><i>Pantai Losari</i> — ikon wisata utama Kota Makassar.</p>
    </section>

    <!-- Kebudayaan -->
    <section>
      <h2>Kebudayaan</h2>
      <p>
        Masyarakat Sulawesi Selatan dikenal dengan filosofi hidup <b>siri’</b> (harga diri) dan <b>pesse</b> (empati).
        Suku Bugis, Makassar, Mandar, dan Toraja merupakan suku utama yang mendiami provinsi ini.
        Budaya Toraja terkenal di dunia melalui rumah adat <b>Tongkonan</b> dan upacara adat <b>Rambu Solo’</b>.
      </p>
    </section>

    <!-- Kuliner -->
    <section>
      <h2>Kuliner Khas</h2>
      <ul>
        <li><b>Coto Makassar</b> – sup daging sapi berbumbu kacang.</li> 
        <img src="{{ asset('assets/images/coto.jpg') }}" alt="Coto Makassar">

        <li><b>Pallubasa</b> – kuah gurih dengan kelapa sangrai.</li>
        <img src="{{ asset('assets/images/pallubasa.jpg') }}" alt="Pallubasa">

        <li><b>Konro Bakar</b> – iga sapi dengan bumbu rempah khas Bugis-Makassar.</li>
        <img src="{{ asset('assets/images/konrro.jpg') }}" alt="Konro Bakar">

      </ul>
    </section>

    <!-- Pakaian Adat & Rumah -->
    <section>
      <h2>Pakaian & Rumah Adat</h2>
      <p>
        Wanita mengenakan <b>Baju Bodo</b> berwarna cerah dengan sarung sutra, sedangkan pria mengenakan <b>Lipa’ Sabbe</b>.
        Rumah adat megah seperti <b>Balla Lompoa</b> menjadi simbol kejayaan Kerajaan Gowa.
      </p>
      <img src="{{ asset('assets/images/toraja.jpg') }}" alt="Rumah Adat Toraja">
    </section>

    <!-- Pakaian Adat Lengkap -->
    <section>
      <h2>Macam-Macam Pakaian Adat Sulawesi Selatan</h2>

      <article>
        <h3>1️⃣ Baju Bodo (Wanita Bugis-Makassar)</h3>
        <      <img src="{{ asset('assets/images/bodo.jpg') }}" alt="Baju Bodo Bugis Makassar">
        <p>
          <b>Baju Bodo</b> adalah busana wanita tradisional Bugis-Makassar, dibuat dari kain tipis berwarna cerah. 
          Warna bajunya melambangkan status sosial, misalnya merah untuk bangsawan dan jingga untuk rakyat biasa.
        </p>
      </article>

      <article>
        <h3>2️⃣ Baju La’bu (Pria Bugis)</h3>
              <img src="{{ asset('assets/images/labu.jpg') }}" alt="Baju La’bu Bugis">
        <p>
          <b>Baju La’bu</b> berupa jas berlengan panjang dengan kerah tertutup, dipadukan dengan sarung sutra <i>Lipa’ Sabbe</i>. 
          Melambangkan ketegasan dan kewibawaan pria Bugis.
        </p>
      </article>

      <article>
        <h3>3️⃣ Pokko’ & Seppa Tallung (Suku Toraja)</h3>
             <img src="{{ asset('assets/images/pokko.jpg') }}" alt="Pokko dan Seppa Tallung Toraja">
        <p>
          <b>Baju Pokko’</b> untuk wanita dan <b>Seppa Tallung</b> untuk pria, keduanya berwarna mencolok dan digunakan dalam 
          upacara adat seperti <i>Rambu Solo’</i> dan <i>Rambu Tuka’</i>.
        </p>
      </article>

      <article>
        <h3>4️⃣ Baju Bella Dada (Pria Bugis/Makassar)</h3>
       <img src="{{ asset('assets/images/bella.jpg') }}" alt="Baju Bella Dada Bugis">
        <p>
          <b>Baju Bella Dada</b> berciri belahan dada dengan kancing logam di depan, 
          dipadukan dengan celana panjang dan sarung, serta penutup kepala <i>Passapu’</i>.
        </p>
      </article>

      <article>
        <h3>5️⃣ Baju Labbu (Wanita Luwu)</h3>
              <img src="{{ asset('assets/images/labbu.jpg') }}" alt="Baju Labbu Luwu">
        <p>
          <b>Baju Labbu</b> dulunya hanya dipakai bangsawan Kerajaan Luwu. 
          Potongannya lebih ramping dari Baju Bodo dan mencerminkan keanggunan wanita Luwu.
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
