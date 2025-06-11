<?php
session_start();
require 'config.php';

// Jika pengguna sudah login, arahkan berdasarkan role
if (isset($_SESSION['user_role'])) {
    switch ($_SESSION['user_role']) {
        case 'Guru':
            header("Location: guru/dashboard.php");
            exit();
        case 'Siswa':
            header("Location: siswa/dashboard.php");
            exit();
    }
}

// Proses login
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validasi input
    if (empty($username) || empty($password)) {
        $error = "Username dan Password wajib diisi.";
    } else {
        // Query untuk mencocokkan username dan password
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && $password == $user['password']) {
            // Simpan informasi user di sesi
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];

            // Arahkan ke dashboard berdasarkan role
            if ($user['role'] === 'Guru') {
                header("Location: guru/dashboard.php");
            } elseif ($user['role'] === 'Siswa') {
                header("Location: siswa/dashboard.php");
            }
            exit();
        } else {
            $error = "Username atau Password salah.";
        }
    }
}
?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> LogIn </title> 
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="website icon" type="png" href="images/icon-online-exam.png" />
</head>
<body>
    <div class="wrapper">
        <h1>Login Sistem Ujian Online</h1>
        <?php if ($error): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST">
                <div class="input-field">
                <input type="text" name="username" required>
                <label>Enter your username</label>
                 </div>
                 <div class="input-field">
                <input type="password" name="password" required>
                <label>Enter your password</label>
                </div>
            <button type="submit"> LOGIN </button>
            <div class="register">
                <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
            </div>
        </form>
    </div>
</body>
</html>
