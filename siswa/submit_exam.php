<?php
session_start();
require '../config.php';
// require '../functions.php';

// check_login('Siswa');

// Ambil jawaban siswa dari sesi
$answers = $_SESSION['answers'] ?? [];
$total_correct = 0;
$total_incorrect = 0;

// Periksa jawaban siswa
foreach ($answers as $question_id => $selected_option) {
    $stmt = $pdo->prepare("SELECT correct_option FROM questions WHERE id = ?");
    $stmt->execute([$question_id]);
    $correct_option = $stmt->fetchColumn();

    if ($selected_option === $correct_option) {
        $total_correct++;
    } else {
        $total_incorrect++;
    }
}

// Hitung nilai akhir
$total_questions = $total_correct + $total_incorrect;
$final_score = $total_questions > 0 ? ($total_correct / $total_questions) * 100 : 0;

// Simpan hasil ujian ke database
$stmt = $pdo->prepare("INSERT INTO exam_results (user_id, total_correct, total_incorrect, final_score) VALUES (?, ?, ?, ?)");
$stmt->execute([$_SESSION['user_id'], $total_correct, $total_incorrect, $final_score]);

// Hapus sesi ujian
unset($_SESSION['answers'], $_SESSION['current_question']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hasil Ujian</title>
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

        .navbar h1, .navbar p {
            margin: 0;
            font-size: 18px;
            color: rgb(0, 85, 255);
        }

        .navbar a, .navbar button {
            color: white;
            font-size: 14px;
            text-decoration: none;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            background-color: #4fa3f7;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .navbar a:hover, .navbar button:hover {
            background-color: #a7cfff;
        }

        /* Content Styling */
        .hasil-ujian {
            width: 80%;
            margin: 30px auto;
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .hasil-ujian h1 {
            text-align: center;
            color: #0066cc;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .hasil-ujian p {
            font-size: 18px;
            color: #555;
            margin: 10px 0;
            text-align: center;
        }

        .hasil-ujian a {
            display: block;
            width: fit-content;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #4fa3f7;
            color: white;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .hasil-ujian a:hover {
            background-color: #a7cfff;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .navbar {
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
            }

            .hasil-ujian {
                width: 90%;
            }

            .hasil-ujian h1 {
                font-size: 20px;
            }

            .hasil-ujian p {
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
    <form method="POST" style="margin: 0;">
        <button type="submit" name="logout">Logout</button>
    </form>
</nav>
<div class="hasil-ujian">
    <h1>Hasil Ujian</h1>
    <p>Jawaban Benar: <?= $total_correct ?></p>
    <p>Jawaban Salah: <?= $total_incorrect ?></p>
    <p>Nilai Akhir: <?= $final_score ?></p>
    <a href="dashboard.php">Kembali ke Dashboard</a>
</div>
</body>
</html>
