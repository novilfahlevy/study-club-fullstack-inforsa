<?php

require './auth.php';

if (!apakahUserSudahLogin()) {
    header('Location: login.php');
    exit();
}

require '../database/koneksi.php';
require '../database/admin.php';

$daftarPengumuman = getPengumuman($conn);

?>

<?php require './layouts/header.php'; ?>

<div class="admin-container">
    <header class="admin-header">
        <div>
            <h1>Halo, <?= $_SESSION['admin_username'] ?>..</h1>
            <p>Kelola data pengumuman untuk website mading.</p>
        </div>
        <div class="header-actions">
            <a href="../index.php" class="btn-secondary">Lihat Halaman Publik</a>
            <a href="logout.php" class="btn-danger">Logout</a>
        </div>
    </header>

    <div class="toolbar">
        <a href="tambah.php" class="btn-primary">+ Tambah Pengumuman</a>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($daftarPengumuman)): ?>
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data pengumuman.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($daftarPengumuman as $index => $item): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($item['judul'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($item['tanggal'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars(ucfirst($item['kategori']), ENT_QUOTES, 'UTF-8') ?></td>
                            <td>
                                <div class="action-group">
                                    <a href="edit.php?slug=<?= urlencode($item['slug']) ?>" class="btn-small btn-edit">Edit</a>
                                    <form method="post" action="hapus.php" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        <input type="hidden" name="slug" value="<?= htmlspecialchars($item['slug'], ENT_QUOTES, 'UTF-8') ?>">
                                        <button type="submit" class="btn-small btn-delete">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require './layouts/footer.php'; ?>