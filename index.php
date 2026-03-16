<?php

require './database/koneksi.php';
require './database/pengumuman.php';

$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : null;
if ($kategori) {
  $pengumuman = getPengumumanByKategori($conn, $kategori);
} else {
  $pengumuman = getPengumuman($conn);
}

?>

<!doctype html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mading Digital INFORSA</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="darkmode.css" />
</head>

<body>
  <!-- Header -->
  <header>
    <h1>Mading Digital <span>FT UNMUL</span></h1>
    <nav>
      <ul>
        <li><a href="?kategori=akademik">Akademik</a></li>
        <li><a href="?kategori=organisasi">Organisasi</a></li>
        <li><a href="?kategori=event">Event</a></li>
        <li><a href="pengumuman-tersimpan.html">Tersimpan</a></li>
        <li><button id="dark-mode-toggle" style="cursor:pointer; border:none; background:none; font-size: 20px;">🌙</button></li>
      </ul>
    </nav>
  </header>

  <section style="text-align: center; margin-bottom: 50px;">
    <input type="text" id="search-input" placeholder="Cari judul pengumuman..." style="padding: 10px; width: 60%; border-radius: 5px; border: 1px solid #004d40;">
  </section>

  <!-- Konten Utama -->
  <main>
    <?php if (empty($pengumuman)): ?>
      <p style="text-align: center; font-size: 18px; color: #555;">Tidak ada pengumuman untuk kategori ini.</p>
    <?php else: ?>
      <?php foreach ($pengumuman as $item): ?>
        <!-- Pengumuman -->
        <article class="pengumuman">
          <?php if ($item['belum_dibaca']): ?>
            <span class="badge">Terbaru</span>
          <?php endif; ?>
          <h2 class="judul"><?= $item['judul'] ?></h2>
          <p class="tanggal">Diposting pada: <?= $item['tanggal'] ?></p>
          <p class="deskripsi"><?= $item['deskripsi'] ?></p>
          <div style="display: flex; gap: 10px; align-items: center; justify-content: space-between;">
            <a href="pengumuman.php?slug=<?= $item['slug'] ?>" class="btn-selengkapnya">Baca Selengkapnya</a>
            <button class="btn-save" style="background-color: #004d40; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;">Simpan</button>
          </div>
        </article>
      <?php endforeach; ?>
    <?php endif; ?>
  </main>

  <!-- Footer -->
  <footer>
    <p>&copy; 2026 Mading Digital FT UNMUL. All rights reserved.</p>
  </footer>

  <script src="darkmode.js"></script>
  <script src="pencarian.js"></script>
  <script src="simpan-pengumuman.js"></script>
</body>

</html>