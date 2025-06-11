<?php
session_start();
require '../config.php';
// require '../functions.php';

// check_login('Siswa');

// Mengambil semua soal ujian
$stmt = $pdo->query("SELECT * FROM questions ORDER BY RAND()");
$questions = $stmt->fetchAll();

// Inisialisasi jawaban siswa dalam sesi jika belum diatur
if (!isset($_SESSION['answers'])) {
    $_SESSION['answers'] = [];
}

// Proses penyimpanan jawaban
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    foreach ($_POST['answers'] as $question_id => $selected_option) {
        $_SESSION['answers'][$question_id] = $selected_option;
    }

    // Redirect ke halaman submit untuk memproses hasil ujian
    header("Location: submit_exam.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ujian Online</title>
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
            color: rgb(0, 85, 255);
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

        /* Page Content */
        h1 {
            text-align: center;
            color: rgb(0, 85, 255);
            margin: 20px 0;
            font-size: 28px;
        }

        p {
            text-align: center;
            color: #555;
            font-size: 16px;
        }

        .exam {
            width: 80%;
            margin: 20px auto;
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .question {
            border-bottom: 1px solid #4fa3f7;
            padding-bottom: 10px;
        }

        .question:last-child {
            border-bottom: none;
        }

        label {
            display: block;
            margin: 5px 0;
            color: #333;
        }

        /* Button Styling */
        .button {
            text-align: center;
            margin-top: 20px;
        }

        button {
            background-color: #4fa3f7;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #a7cfff;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .exam {
                width: 90%;
            }

            h1 {
                font-size: 24px;
            }

            p {
                font-size: 14px;
            }

            button {
                font-size: 14px;
                padding: 8px 16px;
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

<h1>Ujian Online</h1>
<p>Selamat datang, Siswa!</p>
<div class="exam">
    <form method="POST">
        <?php foreach ($questions as $index => $question): ?>
            <div class="question">
                <p><strong><?= ($index + 1) ?>. <?= htmlspecialchars($question['question_text']) ?></strong></p>
                <input type="hidden" name="question_ids[]" value="<?= $question['id'] ?>">
                <label>
                    <input type="radio" name="answers[<?= $question['id'] ?>]" value="A"
                        <?= (isset($_SESSION['answers'][$question['id']]) && $_SESSION['answers'][$question['id']] == 'A') ? 'checked' : '' ?>>
                    <?= htmlspecialchars($question['option_a']) ?>
                </label>
                <label>
                    <input type="radio" name="answers[<?= $question['id'] ?>]" value="B"
                        <?= (isset($_SESSION['answers'][$question['id']]) && $_SESSION['answers'][$question['id']] == 'B') ? 'checked' : '' ?>>
                    <?= htmlspecialchars($question['option_b']) ?>
                </label>
                <label>
                    <input type="radio" name="answers[<?= $question['id'] ?>]" value="C"
                        <?= (isset($_SESSION['answers'][$question['id']]) && $_SESSION['answers'][$question['id']] == 'C') ? 'checked' : '' ?>>
                    <?= htmlspecialchars($question['option_c']) ?>
                </label>
                <label>
                    <input type="radio" name="answers[<?= $question['id'] ?>]" value="D"
                        <?= (isset($_SESSION['answers'][$question['id']]) && $_SESSION['answers'][$question['id']] == 'D') ? 'checked' : '' ?>>
                    <?= htmlspecialchars($question['option_d']) ?>
                </label>
                <label>
                    <input type="radio" name="answers[<?= $question['id'] ?>]" value="E"
                        <?= (isset($_SESSION['answers'][$question['id']]) && $_SESSION['answers'][$question['id']] == 'E') ? 'checked' : '' ?>>
                    <?= htmlspecialchars($question['option_e']) ?>
                </label>
            </div>
        <?php endforeach; ?>
        <div class="button">
            <button type="submit" name="submit">Submit</button>
        </div>
    </form>
</div>
</body>
</html>
