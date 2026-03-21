<?php

require_once './auth.php';

?>

<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mading Digital INFORSA</title>
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/darkmode.css" />
</head>

<body>
    <!-- Header -->
    <header>
        <h1>Mading Digital <span>FT UNMUL</span></h1>
        <nav>
            <?php if (apakahUserSudahLogin()) : ?>
                <span>Selamat datang, <?= $_SESSION['user_username'] ?>!</span>
            <?php endif; ?>
            
            <ul>
                <?php if (apakahUserSudahLogin()) : ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else : ?>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
                <li><a href="?kategori=akademik">Akademik</a></li>
                <li><a href="?kategori=organisasi">Organisasi</a></li>
                <li><a href="?kategori=event">Event</a></li>
                <li><a href="pengumuman-tersimpan.php">Tersimpan</a></li>
                <li><button id="dark-mode-toggle" style="cursor:pointer; border:none; background:none; font-size: 20px;">🌙</button></li>
            </ul>
        </nav>
    </header>