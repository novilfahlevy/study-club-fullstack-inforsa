<?php

require './database/koneksi.php';
require './database/main.php';

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
<main style="display: flex; flex-direction: column; align-items: center; padding: 20px;">
    <article class="pengumuman-detail">
        <h2 class="judul"><?= $pengumuman['judul'] ?></h2>
        <p class="tanggal">Diposting pada: <?= $pengumuman['tanggal'] ?></p>
        <p class="deskripsi"><?= $pengumuman['deskripsi'] ?></p>
        <button class="btn-save" style="background-color: #004d40; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;">Simpan</button>
    </article>

    <!-- Section Komentar -->
    <section class="komentar-section">
        <h3>Komentar</h3>
        <form method="post" class="form-komentar" action="tambah_komentar.php?pengumuman_id=<?= $pengumuman['id'] ?>&pengumuman_slug=<?= $slug ?>">
            <textarea id="komentar" name="komentar" rows="4" placeholder="Tulis komentar Anda" required></textarea>

            <button type="submit" class="btn-primary">Kirim Komentar</button>
        </form>

        <div class="daftar-komentar">
            <h4>Daftar Komentar</h4>
            
            <?php $komentarList = getKomentarPengumuman($conn, $pengumuman['id']); ?>
            <?php if (count($komentarList) > 0): ?>
                <?php foreach ($komentarList as $komentar): ?>
                    <div class="komentar">
                        <p><strong><?= htmlspecialchars($komentar['username']) ?></strong></p>
                        <p><?= htmlspecialchars($komentar['komentar']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Belum ada komentar.</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php require './layouts/footer.php'; ?>