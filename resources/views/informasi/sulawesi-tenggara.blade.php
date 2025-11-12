<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Provinsi Sulawesi Tenggara</title>
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
    <h1>Provinsi Sulawesi Tenggara</h1>
    <p>Ibu Kota: <b>Kendari</b></p>
  </header>

  <main>
    <!-- Gambaran Umum -->
    <section>
      <h2>Gambaran Umum</h2>
      <p>
        Sulawesi Tenggara (Sultra) adalah provinsi di bagian tenggara Pulau Sulawesi. 
        Wilayahnya mencakup daratan utama dan beberapa gugusan pulau seperti Wakatobi dan Buton. 
        Ibu kotanya adalah <b>Kendari</b>.
      </p>
      <p>
        Provinsi ini berbatasan dengan Laut Banda di selatan, Laut Flores di barat, 
        dan Teluk Tolo di timur. Sulawesi Tenggara memiliki kekayaan alam berupa 
        hasil laut, hutan, serta tambang nikel dan emas.
      </p>
      <p>
        Wilayah ini dikenal dengan keindahan bawah lautnya, terutama di Kepulauan Wakatobi yang 
        menjadi destinasi wisata selam kelas dunia. Masyarakatnya terdiri dari berbagai suku seperti 
        <b>Tolaki, Buton, Muna, dan Moronene</b>.
      </p>
      <img src="{{ asset('assets/images/pantai-nirwana.jpeg') }}" alt="Pantai Nirwana Baubau">
      <p><i>Pantai Nirwana</i> — salah satu pantai indah di Baubau, Sulawesi Tenggara.</p>
    </section>

    <!-- Kebudayaan -->
    <section>
      <h2>Kebudayaan</h2>
      <p>
        Masyarakat Sulawesi Tenggara memiliki budaya yang sarat nilai moral dan sosial. 
        Misalnya filosofi <b>"mepokoaso"</b> dari suku Tolaki, yang berarti hidup dalam persaudaraan. 
        Tarian tradisional seperti <b>Lulo</b> menjadi simbol kebersamaan masyarakat Sultra.
      </p>
    </section>

    <!-- Kuliner -->
    <section>
      <h2>Kuliner Khas</h2>
      <ul>
        <li><b>Sinonggi</b> – makanan pokok khas suku Tolaki berbahan sagu.</li>
        <img src="{{ asset('assets/images/sinonggi.jpeg') }}" alt="Sinonggi Sulawesi Tenggara">

        <li><b>Parende</b> – ikan kuah asam pedas khas Wakatobi.</li>
        <img src="{{ asset('assets/images/parende.jpeg') }}" alt="Parende Wakatobi">

        <li><b>Kasuami</b> – makanan pengganti nasi dari parutan singkong yang dikukus, khas Buton dan Wakatobi.</li>
        <img src="{{ asset('assets/images/kasuami.jpeg') }}" alt="Kasuami Buton">
      </ul>
    </section>

    <!-- Pakaian Adat & Rumah -->
    <section>
      <h2>Pakaian & Rumah Adat</h2>
      <p>
        Pakaian adat Sulawesi Tenggara mencerminkan keanggunan dan kesopanan. 
        Rumah adat suku Tolaki disebut <b>Banua Tada</b>, yang berarti rumah berdinding miring, 
        menjadi simbol kebijaksanaan dan kearifan lokal.
      </p>
      <img src="{{ asset('assets/images/banua-tada.jpeg') }}" alt="Rumah Adat Banua Tada">
    </section>

    <!-- Pakaian Adat Lengkap -->
    <section>
      <h2>Macam-Macam Pakaian Adat Sulawesi Tenggara</h2>

      <article>
        <h3>1️⃣ Baju Babu Nggawi (Wanita Tolaki)</h3>
        <img src="{{ asset('assets/images/babu-nggawi.jpeg') }}" alt="Baju Babu Nggawi">
        <p>
          <b>Baju Babu Nggawi</b> digunakan wanita Tolaki dalam acara adat dan pernikahan. 
          Dihiasi motif emas dan perhiasan kepala <i>pabalu</i> yang melambangkan kehormatan wanita.
        </p>
      </article>

      <article>
        <h3>2️⃣ Babu Kandiu (Pria Tolaki)</h3>
        <img src="{{ asset('assets/images/babu-kandiu.jpeg') }}" alt="Babu Kandiu">
        <p>
          <b>Babu Kandiu</b> adalah pakaian pria Tolaki dengan lengan panjang dan celana longgar. 
          Biasanya dipadukan dengan sarung dan penutup kepala <i>pongko</i>.
        </p>
      </article>

      <article>
        <h3>3️⃣ Pakaian Adat Buton</h3>
        <img src="{{ asset('assets/images/pakaian-buton.jpeg') }}" alt="Pakaian Adat Buton">
        <p>
          Pakaian adat Buton dikenal dengan warna cerah dan hiasan emas. 
          Busana ini digunakan dalam upacara adat Kesultanan Buton, mencerminkan kemuliaan dan sopan santun.
        </p>
      </article>

      <article>
        <h3>4️⃣ Pakaian Adat Muna</h3>
        <img src="{{ asset('assets/images/pakaian-muna.jpeg') }}" alt="Pakaian Adat Muna">
        <p>
          Pakaian adat suku Muna memiliki motif sederhana dengan warna-warna lembut, 
          melambangkan kesederhanaan dan keharmonisan hidup.
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
