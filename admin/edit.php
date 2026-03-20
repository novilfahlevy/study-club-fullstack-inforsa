<?php
require './auth.php';

if (!apakahUserSudahLogin()) {
    header('Location: login.php');
    exit();
}

require '../database/koneksi.php';
require '../database/admin.php';

$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
if ($slug === '') {
    header('Location: index.php');
    exit();
}

$dataLama = getPengumumanBySlug($conn, $slug);
if (!$dataLama) {
    header('Location: index.php?pesan=edit_gagal');
    exit();
}

$error = '';
$kategoriValid = ['akademik', 'organisasi', 'event'];
$formData = [
    'judul' => $dataLama['judul'],
    'tanggal' => substr($dataLama['tanggal'], 0, 10),
    'deskripsi' => $dataLama['deskripsi'],
    'kategori' => $dataLama['kategori'],
    'belum_dibaca' => (int) $dataLama['belum_dibaca']
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData['judul'] = isset($_POST['judul']) ? trim($_POST['judul']) : '';
    $formData['tanggal'] = isset($_POST['tanggal']) ? trim($_POST['tanggal']) : '';
    $formData['deskripsi'] = isset($_POST['deskripsi']) ? trim($_POST['deskripsi']) : '';
    $formData['kategori'] = isset($_POST['kategori']) ? trim($_POST['kategori']) : '';
    $formData['belum_dibaca'] = isset($_POST['belum_dibaca']) ? 1 : 0;

    if (
        $formData['judul'] === '' ||
        $formData['tanggal'] === '' ||
        $formData['deskripsi'] === '' ||
        !in_array($formData['kategori'], $kategoriValid, true)
    ) {
        $error = 'Semua field wajib diisi dengan benar.';
    } else {
        $sukses = updatePengumuman($conn, $slug, $formData);
        if ($sukses) {
            header('Location: index.php?pesan=edit_sukses');
            exit();
        }

        $error = 'Gagal memperbarui data pengumuman.';
    }
}

require './layouts/header.php';
?>

<div class="admin-container">
    <header class="admin-header">
        <div>
            <h1>Halo, <?= $_SESSION['admin_username'] ?>..</h1>
            <p>Edit data pengumuman untuk website mading.</p>
        </div>
        <div class="header-actions">
            <a href="index.php" class="btn-secondary">Kembali</a>
        </div>
    </header>

    <?php if ($error): ?>
        <div class="alert alert-error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <form method="post" class="form-card">
        <label for="judul">Judul</label>
        <input type="text" id="judul" name="judul" value="<?= htmlspecialchars($formData['judul'], ENT_QUOTES, 'UTF-8') ?>" required>

        <label for="tanggal">Tanggal</label>
        <input type="date" id="tanggal" name="tanggal" value="<?= htmlspecialchars($formData['tanggal'], ENT_QUOTES, 'UTF-8') ?>" required>

        <label for="kategori">Kategori</label>
        <select id="kategori" name="kategori" required>
            <option value="akademik" <?= $formData['kategori'] === 'akademik' ? 'selected' : '' ?>>Akademik</option>
            <option value="organisasi" <?= $formData['kategori'] === 'organisasi' ? 'selected' : '' ?>>Organisasi</option>
            <option value="event" <?= $formData['kategori'] === 'event' ? 'selected' : '' ?>>Event</option>
        </select>

        <label for="deskripsi">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" rows="6" required><?= htmlspecialchars($formData['deskripsi'], ENT_QUOTES, 'UTF-8') ?></textarea>

        <button type="submit" class="btn-primary">Update Data</button>
    </form>
</div>

<?php
require './layouts/footer.php';
?>
