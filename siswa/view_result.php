<?php
session_start();
require '../config.php';
// require '../functions.php';

// check_login('Siswa');

// Ambil hasil ujian terakhir siswa
if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("SELECT total_correct, total_incorrect, final_score FROM exam_results WHERE user_id = ? ORDER BY id DESC LIMIT 1");
    $stmt->execute([$_SESSION['user_id']]);
    $result = $stmt->fetch();
} else {
    echo 'User ID tidak ditemukan. Silakan login terlebih dahulu.';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hasil Ujian Terakhir</title>
    <link rel="website icon" type="png" href="../images/icon-online-exam.png" />
    <style>
        /* General Reset */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            /* background: linear-gradient(135deg, #cce7ff 0%, #b3d9ff 100%); */
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
            z-index: 100;
        }

        .navbar h1 {
            font-size: 24px;
            margin: 0;
        }

        .navbar a {
            color: white;
            font-size: 14px;
            text-decoration: none;
            margin: 0 10px;
            padding: 8px 12px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .navbar a:hover {
            background-color: #a7cfff;
        }

        /* Content Styling */
        h1 {
            text-align: center;
            color: rgb(0, 85, 255);
            margin-top: 20px;
            font-size: 28px;
        }

        p {
            text-align: center;
            color: #555;
            font-size: 16px;
        }

        .hasil-ujian {
            width: 80%;
            margin: 20px auto;
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .hasil-ujian p {
            font-size: 18px;
            color: #333;
            margin: 10px 0;
        }

        .hasil-ujian p:first-child {
            font-weight: bold;
            color: #4fa3f7;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .navbar {
                flex-wrap: wrap;
                justify-content: center;
                gap: 0px;
            }

            h1 {
                font-size: 24px;
            }

            p {
                font-size: 14px;
            }

            .hasil-ujian {
                width: 90%;
            }
        }
    </style>
</head>
<body>
<nav class="navbar">
    <h1>Dashboard Siswa</h1>
    <a href="start_exam.php">Ikuti Ujian</a>
    <a href="view_result.php">Lihat Hasil Ujian</a>
    <a href="dashboard.php">Kembali</a>
</nav>
<h1>Hasil Ujian Terakhir</h1>
<div class="hasil-ujian">
    <?php if ($result): ?>
        <p>Jawaban Benar: <?= $result['total_correct'] ?></p>
        <p>Jawaban Salah: <?= $result['total_incorrect'] ?></p>
        <p>Nilai Akhir: <?= $result['final_score'] ?></p>
    <?php else: ?>
        <p>Anda belum mengikuti ujian.</p>
    <?php endif; ?>
</div>
</body>
</html>
