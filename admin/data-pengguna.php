<?php

require './auth.php';

if (!apakahAdminSudahLogin()) {
    header('Location: login.php');
    exit();
}

require '../database/koneksi.php';
require '../database/main.php';

$daftarPengguna = getDaftarPengguna($conn);

?>

<?php require './layouts/header.php'; ?>

<div class="admin-container">
    <header class="admin-header">
        <div>
            <h1>Data Pengguna</h1>
            <p>Kelola akun-akun pengguna yang terdaftar di website Mading FT Unmul.</p>
        </div>
        <div class="header-actions">
            <a href="../index.php" class="btn-secondary">Lihat Halaman Publik</a>
            <a href="logout.php" class="btn-danger">Logout</a>
        </div>
    </header>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Tanggal Mendaftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($daftarPengguna)): ?>
                    <tr>
                        <td colspan="4" class="text-center">Belum ada data pengguna.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($daftarPengguna as $index => $item): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($item['username'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= date('d F Y H:i', strtotime($item['tanggal_mendaftar'])) ?></td>
                            <td>
                                <div class="action-group">
                                    <form method="post" action="hapus-pengguna.php" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus pengguna ini? Akun <?= htmlspecialchars($item['username'], ENT_QUOTES, 'UTF-8') ?> akan dihapus secara permanen.');">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8') ?>">
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
