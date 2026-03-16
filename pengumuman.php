<?php

require './database/koneksi.php';
require './database/pengumuman.php';

$slug = isset($_GET['slug']) ? $_GET['slug'] : null;

if (!$slug) {
    header("Location: index.php");
    exit();
}

$pengumuman = getPengumumanBySlug($conn, $slug);

if (!$pengumuman) {
    header("Location: index.php");
    exit();
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

    <!-- Konten Utama -->
    <main>
        <article class="pengumuman-detail">
            <h2 class="judul"><?= $pengumuman['judul'] ?></h2>
            <p class="tanggal">Diposting pada: <?= $pengumuman['tanggal'] ?></p>
            <p class="deskripsi"><?= $pengumuman['deskripsi'] ?></p>
            <button class="btn-save" style="background-color: #004d40; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;">Simpan</button>
        </article>
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