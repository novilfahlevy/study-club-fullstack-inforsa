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

<?php require './layouts/header.php'; ?>

<!-- Konten Utama -->
<main>
    <article class="pengumuman-detail">
        <h2 class="judul"><?= $pengumuman['judul'] ?></h2>
        <p class="tanggal">Diposting pada: <?= $pengumuman['tanggal'] ?></p>
        <p class="deskripsi"><?= $pengumuman['deskripsi'] ?></p>
        <button class="btn-save" style="background-color: #004d40; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;">Simpan</button>
    </article>
</main>

<?php require './layouts/footer.php'; ?>