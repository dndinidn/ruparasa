<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Provinsi Sulawesi Utara</title>
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
    <h1>Provinsi Sulawesi Utara</h1>
    <p>Ibu Kota: <b>Manado</b></p>
  </header>

  <main>
    <!-- Gambaran Umum -->
    <section>
      <h2>Gambaran Umum</h2>
      <p>
        Provinsi Sulawesi Utara terletak di ujung utara Pulau Sulawesi dan beribu kota di Manado. 
        Wilayah ini dikenal dengan keindahan alam lautnya, pegunungan, dan keragaman budaya yang luar biasa.
      </p>
      <p>
        Salah satu daya tarik utama Sulawesi Utara adalah <b>Taman Laut Bunaken</b>, 
        yang menjadi salah satu destinasi menyelam terbaik di dunia karena keanekaragaman hayati lautnya.
      </p>
      <img src="{{ asset('assets/images/taman-laut-bunaken.jpeg') }}" alt="Taman Laut Bunaken Manado">
      <p><i>Taman Laut Bunaken</i> — ikon wisata bahari Indonesia yang terkenal hingga mancanegara.</p>
    </section>

    <!-- Kebudayaan -->
    <section>
      <h2>Kebudayaan</h2>
      <p>
        Masyarakat Sulawesi Utara terdiri dari beragam suku seperti Minahasa, Bolaang Mongondow, dan Sangihe-Talaud, 
        dengan kekayaan tradisi dan adat yang masih dijaga hingga kini.
      </p>
      <p>
        Salah satu tradisi terkenal adalah <b>Upacara Tulude</b>, 
        upacara syukur yang berasal dari Kepulauan Sangihe sebagai bentuk rasa terima kasih kepada Tuhan atas rezeki dan kehidupan.
      </p>
      <img src="{{ asset('assets/images/upacara-tulude.jpeg') }}" alt="Upacara Tulude Sulawesi Utara">
    </section>

    <!-- Kuliner -->
    <section>
      <h2>Kuliner Khas</h2>
      <ul>
        <li><b>Tinutuan (Bubur Manado)</b> – bubur sayur khas Manado yang sehat, tanpa nasi putih, berisi labu, jagung, bayam, dan daun gedi.</li>
        <img src="{{ asset('assets/images/tinutuan.jpeg') }}" alt="Tinutuan Bubur Manado">

        <li><b>Cakalang Fufu</b> – ikan cakalang yang diasap hingga kering, disajikan dengan sambal rica-rica pedas.</li>
        <img src="{{ asset('assets/images/cakalang-fufu.jpeg') }}" alt="Cakalang Fufu Manado">

        <li><b>Pisang Goroho</b> – pisang khas Sulawesi Utara yang digoreng atau direbus, biasanya dimakan dengan sambal dabu-dabu.</li>
        <img src="{{ asset('assets/images/pisang-goroho.jpeg') }}" alt="Pisang Goroho Manado">
      </ul>
    </section>

    <!-- Pakaian Adat & Rumah -->
    <section>
      <h2>Pakaian & Rumah Adat</h2>
      <p>
        Pakaian adat Sulawesi Utara disebut <b>Laku Tepu</b> untuk pria dan <b>Kebaya Manado</b> untuk wanita, 
        melambangkan kesederhanaan, keanggunan, dan nilai-nilai budaya Minahasa.
      </p>
      <img src="{{ asset('assets/images/pakaian-adat-minahasa.jpeg') }}" alt="Pakaian Adat Sulawesi Utara">

      <p>
        Rumah adat Sulawesi Utara dikenal sebagai <b>Wale</b> atau <b>Walewangko</b>, 
        yang berbentuk rumah panggung dari kayu, melambangkan keterbukaan dan gotong royong masyarakat Minahasa.
      </p>
      <img src="{{ asset('assets/images/rumah-walewangko.jpeg') }}" alt="Rumah Adat Walewangko Sulawesi Utara">
    </section>

    <!-- Pakaian Adat Lengkap -->
    <section>
      <h2>Macam-Macam Pakaian Adat Sulawesi Utara</h2>

      <article>
        <h3>1️⃣ Laku Tepu (Pria)</h3>
        <img src="{{ asset('assets/images/laku-tepu.jpeg') }}" alt="Laku Tepu Sulawesi Utara">
        <p>
          <b>Laku Tepu</b> merupakan pakaian adat pria khas Minahasa, berbentuk jas panjang dengan hiasan sulaman emas dan penutup kepala kecil. 
          Melambangkan keberanian dan kehormatan.
        </p>
      </article>

      <article>
        <h3>2️⃣ Kebaya Manado (Wanita)</h3>
        <img src="{{ asset('assets/images/kebaya-manado.jpeg') }}" alt="Kebaya Manado Sulawesi Utara">
        <p>
          <b>Kebaya Manado</b> adalah pakaian adat wanita dengan warna cerah dan motif bunga, 
          menonjolkan kelembutan dan keanggunan perempuan Sulawesi Utara.
        </p>
      </article>

      <article>
        <h3>3️⃣ Baju Bantik</h3>
        <img src="{{ asset('assets/images/baju-bantik.jpeg') }}" alt="Baju Bantik Sulawesi Utara">
        <p>
          <b>Baju Bantik</b> digunakan oleh suku Bantik di Manado, memiliki corak khas dan biasanya digunakan dalam acara adat serta tari tradisional.
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
