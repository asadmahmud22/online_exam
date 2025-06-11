<?php
require 'config.php';

// Data pengguna baru
$username = 'guru1'; // Ganti dengan username
$password = 'password123'; // Ganti dengan password
$role = 'Guru'; // Pilih 'Guru' atau 'Siswa'

// Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Simpan data ke database
$stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
if ($stmt->execute([$username, $hashedPassword, $role])) {
    echo "Pengguna berhasil ditambahkan!";
} else {
    echo "Gagal menambahkan pengguna.";
}
?>
