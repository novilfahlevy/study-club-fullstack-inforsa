<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pengumuman - Mading Digital</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>
    <?php if (apakahAdminSudahLogin()): ?>
        <nav class="admin-navbar">
            <div class="navbar-container">
                <div class="navbar-brand">
                    <h2>Admin Mading</h2>
                </div>
                <ul class="navbar-menu">
                    <li><a href="index.php" class="navbar-link">Pengumuman</a></li>
                    <li><a href="data-pengguna.php" class="navbar-link">Data Pengguna</a></li>
                </ul>
            </div>
        </nav>
    <?php endif; ?>