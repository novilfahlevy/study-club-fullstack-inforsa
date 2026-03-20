<?php

require './auth.php';

if (apakahUserSudahLogin()) {
    header('Location: index.php');
    exit();
}

require '../database/koneksi.php';
require '../database/admin.php';

$error = ''; // Initialize error message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $akunAdmin = getAkunAdmin($conn, $username);

    if ($akunAdmin && $password == $akunAdmin['password']) {
        login($username);
        header('Location: index.php');
        exit();
    } else {
        $error = 'Username atau password salah.'; // Provide feedback on failure
    }
}

?>

<?php require './layouts/header.php'; ?>

<div class="auth-wrapper">
    <div class="auth-card">
        <h1>Login Admin</h1>
        <p>Masuk untuk mengelola data pengumuman.</p>

        <?php if ($error): ?>
            <div class="alert alert-error"> <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?> </div>
        <?php endif; ?>

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

<?php require './layouts/footer.php'; ?>