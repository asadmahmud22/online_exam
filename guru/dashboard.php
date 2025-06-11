<?php
session_start();
require '../config.php';
// require '../functions.php';

// check_login('Guru'); // Memastikan hanya Guru yang bisa mengakses

// echo "Selamat datang, Guru!";

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
    <title>Dashboard Guru</title>
    <link rel="website icon" type="png" href="../images/icon-online-exam.png" />
    <style>
        /* Reset and body styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            /* background: linear-gradient(135deg, #e3f2fd 0%, #90caf9 100%); */
            color: #333;
            background-color:rgb(216, 216, 216);

        }

        /* Navbar Styling */
        .navbar {
            background-color: #64b5f6;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
            background-color: #42a5f5;
        }

        .navbar form {
            align-self: center;
        }

        .navbar button {
            background-color: #42a5f5;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .navbar button:hover {
            background-color: #1e88e5;
        }

        /* Main content styling */
        h1 {
            text-align: center;
            color: #1976d2;
            margin: 20px 0;
        }

        p {
            text-align: center;
            color: #555;
            font-size: 16px;
            margin: 0 20px;
            line-height: 1.6;
        }

        /* Responsive design */
        @media (max-width: 600px) {
            .navbar {
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
            }

            .navbar a {
                font-size: 14px;
                padding: 6px 10px;
            }

            .navbar button {
                font-size: 14px;
                padding: 6px 12px;
            }

            p {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>Dashboard Guru</h1>
        <a href="manage_questions.php">Kelola Soal</a>
        <a href="data_question.php">Lihat Data Soal</a>
        <a href="view_students.php">Lihat Data Siswa</a>
        <a href="view_results.php">Lihat Nilai Siswa</a>
        <form method="POST">
            <button type="submit" name="logout">Logout</button>
        </form>
    </nav>
    <br><br><br>
    <h1>Selamat Datang di Halaman Dashboard Guru!</h1>
    <p>Terima kasih telah bergabung di platform kami. Di halaman ini, Anda dapat dengan mudah mengelola ujian online, memantau hasil siswa, dan mengakses berbagai fitur untuk mendukung pembelajaran. Ayo mulai dengan memilih menu di atas untuk mengakses fitur-fitur yang Anda butuhkan!</p>
</body>
</html>
