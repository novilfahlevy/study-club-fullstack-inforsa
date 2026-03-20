<?php

require './auth.php';

if (!apakahUserSudahLogin()) {
    header('Location: login.php');
    exit();
}

require '../database/koneksi.php';
require '../database/admin.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

$slug = isset($_POST['slug']) ? trim($_POST['slug']) : '';
if ($slug === '') {
    header('Location: index.php?pesan=hapus_gagal');
    exit();
}

$sukses = hapusPengumuman($conn, $slug);
if ($sukses) {
    header('Location: index.php?pesan=hapus_sukses');
    exit();
}

header('Location: index.php?pesan=hapus_gagal');
exit();
