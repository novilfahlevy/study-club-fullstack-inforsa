<?php

require './database/koneksi.php';
require './database/main.php';
require './auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pengumumanId = $_GET['pengumuman_id'];
    $pengumumanSlug = $_GET['pengumuman_slug'];
    $penggunaId = $_SESSION['user_id'];

    $komentar = $_POST['komentar'];
    
    if (tambahKomentar($conn, $pengumumanId, $penggunaId, $komentar)) {
        header("Location: pengumuman.php?slug=$pengumumanSlug");
        exit();
    } else {
        echo "Gagal menambahkan komentar.";
    }
}