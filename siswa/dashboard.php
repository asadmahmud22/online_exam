<?php
session_start();
require '../config.php';
// require '../functions.php';

// check_login('Siswa');

// echo "Selamat datang, Siswa!";

// Tombol logout
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard Siswa</title>
    <link rel="website icon" type="png" href="../images/icon-online-exam.png" />
    <style>
        /* General Reset */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            /* background: linear-gradient(135deg,rgb(255, 255, 255) 0%, #b3d9ff 100%); */
            color: #333;
            background-color:rgb(216, 216, 216);
        }

        /* Navbar Styling */
        .navbar {
            background-color: #4fa3f7;
            color: white;
            padding: 15px 2%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            left: 0;
            z-index: 100;
        }

        .navbar h1 {
            font-size: 24px;
            margin: 0;
            color: rgb(0, 85, 255);
        }

        .navbar a {
            color: white;
            font-size: 16px;
            text-decoration: none;
            margin: 0 10px;
            padding: 8px 12px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .navbar a:hover {
            background-color: #a7cfff;
        }

        .navbar form {
            display: inline;
        }

        .navbar button {
            background-color: #4fa3f7;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .navbar button:hover {
            background-color: #a7cfff;
        }

        /* Main Content */
        div {
            text-align: center;
            padding: 20px;
        }

        h1 {
            color: rgb(0, 85, 255);
            margin: 20px 0;
            font-size: 28px;
        }

        p {
            color: #555;
            font-size: 16px;
            line-height: 1.5;
            margin: 0 0 20px;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .navbar {
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
            }

            .navbar h1 {
                font-size: 20px;
            }

            .navbar a, .navbar button {
                font-size: 14px;
                padding: 6px 10px;
            }

            h1 {
                font-size: 24px;
            }

            p {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
<nav class="navbar">
    <h1>Dashboard Siswa</h1>
    <a href="start_exam.php">Ikuti Ujian</a>
    <a href="view_result.php">Lihat Hasil Ujian</a>
    <form method="POST">
        <button type="submit" name="logout">Logout</button>
    </form>
</nav>
<div>
    <h1>Selamat Datang di Halaman Dashboard Siswa!</h1>
    <p>Halo, Siswa! Kami senang menyambut Anda di platform pembelajaran ini. Pastikan Anda siap untuk menjelajahi berbagai fitur yang tersedia.</p>
    <h1>Siapkan Diri untuk Mengikuti Ujian Online!</h1>
    <p>Klik tombol "Ikuti Ujian" di atas untuk memulai ujian online Anda. Pastikan membaca setiap soal dengan cermat dan mengerjakan dengan penuh konsentrasi. Semoga sukses!</p>
</div>
</body>
</html>
