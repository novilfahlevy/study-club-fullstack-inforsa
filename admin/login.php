<?php

require './auth.php';

if (apakahUserSudahLogin()) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (login($username, $password)) {
        header('Location: index.php');
        exit();
    }
}

?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Mading Digital</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-card">
            <h1>Login Admin</h1>
            <p>Masuk untuk mengelola data pengumuman.</p>

            <form method="post" class="form-grid">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" class="btn-primary">Login</button>
            </form>

            <a href="../index.php" class="link-back">Kembali ke halaman publik</a>
        </div>
    </div>
</body>

</html>
