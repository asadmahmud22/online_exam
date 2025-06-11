<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password']; // Password disimpan langsung tanpa hashing
    $role = $_POST['role']; // Role: Guru atau Siswa

    // Simpan data ke database
    $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    if ($stmt->execute([$username, $password, $role])) {
        echo "Pendaftaran berhasil!";
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign-Up</title>
    <link rel="stylesheet" href="css/register.css">
    <link rel="website icon" type="png" href="images/icon-online-exam.png" />
</head>
<body>
    <form method="POST">
    <h1>Formulir Pendaftaran</h1>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>

        <label for="role">Role:</label>
        <select name="role" id="role" required>
            <!-- <option value=\"Guru\">Guru</option> -->
            <option value="Siswa">Siswa</option>
        </select><br>

        <button type="submit">Daftar</button>
        <p>Sudah punya akun? <a href="index.php">Kembali</a></p>
    </form>
</body>
</html>
