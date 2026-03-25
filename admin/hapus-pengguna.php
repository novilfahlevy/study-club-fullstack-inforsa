<?php

require './auth.php';

if (!apakahAdminSudahLogin()) {
    header('Location: login.php');
    exit();
}

require '../database/koneksi.php';
require '../database/main.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : null;

    if (!$id) {
        header('Location: data-pengguna.php?error=data_tidak_valid');
        exit();
    }

    $success = hapusPengguna($conn, $id);

    if ($success) {
        header('Location: data-pengguna.php?success=pengguna_dihapus');
    } else {
        header('Location: data-pengguna.php?error=gagal_menghapus_pengguna');
    }
} else {
    header('Location: data-pengguna.php');
}
