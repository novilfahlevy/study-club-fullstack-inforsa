<?php

require './auth.php';

require './database/koneksi.php';
require './database/main.php';

$error = ''; // Initialize error message
$success = ''; // Initialize success message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $password_confirm = isset($_POST['password_confirm']) ? $_POST['password_confirm'] : '';

    // Validation
    if (empty($username)) {
        $error = 'Username harus diisi.';
    } elseif (strlen($username) < 3) {
        $error = 'Username minimal harus 3 karakter.';
    } elseif (strlen($username) > 250) {
        $error = 'Username maksimal 250 karakter.';
    } elseif (usernameExist($conn, $username)) {
        $error = 'Username sudah terdaftar. Silakan gunakan username lain.';
    } elseif (empty($password)) {
        $error = 'Password harus diisi.';
    } elseif (strlen($password) < 6) {
        $error = 'Password minimal harus 6 karakter.';
    } elseif ($password !== $password_confirm) {
        $error = 'Password dan konfirmasi password tidak sama.';
    } else {
        // Insert new user
        if (tambahPengguna($conn, $username, $password)) {
            $success = 'Registrasi berhasil! Silakan login dengan akun Anda.';
            // Redirect ke login setelah 2 detik
            header('Refresh: 2; url=login.php');
        } else {
            $error = 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.';
        }
    }
}

?>

<?php require './layouts/header.php'; ?>

<div class="auth-wrapper">
    <div class="auth-card">
        <h1>Daftar Akun</h1>
        <p>Buat akun baru untuk berinteraksi dengan sesama mahasiswa.</p>

        <?php if ($error): ?>
            <div class="alert alert-error"> <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?> </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success"> <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?> </div>
        <?php endif; ?>

        <?php if (!$success): ?>
        <form method="post" class="form-grid">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Minimum 3 karakter" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Minimum 6 karakter" required>

            <label for="password_confirm">Konfirmasi Password</label>
            <input type="password" id="password_confirm" name="password_confirm" placeholder="Ulangi password Anda" required>

            <button type="submit" class="btn-primary">Daftar</button>
        </form>

        <a href="login.php" class="link-back">Sudah punya akun? Login di sini</a>
        <?php endif; ?>
    </div>
</div>

<?php require './layouts/footer.php'; ?>
