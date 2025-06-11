<?php
session_start();
require '../config.php';
// require '../functions.php';

// check_login('Guru'); // Memastikan hanya Guru yang bisa mengakses

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question_text = $_POST['question_text'];
    $option_a = $_POST['option_a'];
    $option_b = $_POST['option_b'];
    $option_c = $_POST['option_c'];
    $option_d = $_POST['option_d'];
    $option_e = $_POST['option_e'];
    $correct_option = $_POST['correct_option'];

    $stmt = $pdo->prepare("INSERT INTO questions (question_text, option_a, option_b, option_c, option_d, option_e, correct_option) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$question_text, $option_a, $option_b, $option_c, $option_d, $option_e, $correct_option]);

    // echo "Soal berhasil ditambahkan!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Kelola Soal</title>
    <link rel="website icon" type="png" href="../images/icon-online-exam.png" />
    <style>
        /* General Reset */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            /* background: linear-gradient(135deg, #bbdefb 0%, #e3f2fd 100%); */
            color: #333;
            line-height: 1.6;
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

        /* Heading Styling */
        h1 {
            text-align: center;
            color: #1e88e5;
            margin: 20px 0;
            font-size: 29px;
            font-weight: bold;
        }

        p {
            text-align: center;
            color: #555;
            font-size: 16px;
            margin-bottom: 20px;
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
        }

        textarea, input[type="text"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        button[type="submit"] {
            width: 50%;
            padding: 12px;
            background-color: #64b5f6;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #42a5f5;
        }

        /* Table Styling */
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        table th {
            background-color: #64b5f6;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #e3f2fd;
        }

        table tr:hover {
            background-color: #bbdefb;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .navbar {
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
            }

            form {
                width: 95%;
            }

            button[type="submit"] {
                width: 80%;
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
    <a href="dashboard.php">Kembali</a>
</nav>
    
    <h1>Kelola Soal</h1>
    <table>
        <tr>
            <th>No</th>
            <th>Soal</th>
            <th>Pilihan</th>
            <th>Jawaban Benar</th>
            <th>Aksi</th>
        </tr>
        <!-- Contoh data kosong -->
        <tr>
            <td>1</td>
            <td>Contoh soal</td>
            <td>A, B, C, D, E</td>
            <td>A</td>
            <td>Hapus</td>
        </tr>
    </table>
    <form method="POST">
        <textarea name="question_text" placeholder="Masukkan soal" required></textarea><br>
        <input type="text" name="option_a" placeholder="Pilihan A" required>
        <input type="text" name="option_b" placeholder="Pilihan B" required>
        <input type="text" name="option_c" placeholder="Pilihan C" required>
        <input type="text" name="option_d" placeholder="Pilihan D" required>
        <input type="text" name="option_e" placeholder="Pilihan E" required>
        <input type="text" name="correct_option" placeholder="Jawaban Benar (A/B/C/D/E)" required><br>
        <button type="submit">Tambahkan Soal</button>
    </form>
</body>
</html>
