<?php
session_start();
require '../config.php';

// check_login('Guru');

// Handle Create Question
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_question'])) {
    $stmt = $pdo->prepare("INSERT INTO questions (question_text, option_a, option_b, option_c, option_d, option_e, correct_option) 
                           VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['question_text'],
        $_POST['option_a'],
        $_POST['option_b'],
        $_POST['option_c'],
        $_POST['option_d'],
        $_POST['option_e'],
        $_POST['correct_option']
    ]);
    header("Location: data_question.php");
    exit();
}

// Handle Delete Question
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_question'])) {
    $stmt = $pdo->prepare("DELETE FROM questions WHERE id = ?");
    $stmt->execute([$_POST['question_id']]);
    header("Location: data_question.php");
    exit();
}

// Fetch Questions
$stmt = $pdo->query("SELECT * FROM questions");
$questions = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Questions</title>
    <link rel="website icon" type="png" href="../images/icon-online-exam.png" />
    <style>
        /* General Reset */
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

        /* Headings */
        h1, h2 {
            text-align: center;
            color: #1e88e5;
            margin: 20px 0;
        }

        p {
            text-align: center;
            color: #555;
            font-size: 16px;
            margin-bottom: 20px;
        }

        /* Table Styling */
        table {
            width: 90%;
            margin: 0 auto;
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

        /* Buttons */
        button {
            background-color: #42a5f5;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #1e88e5;
        }

        form {
            display: inline;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .navbar {
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
            }

            table {
                width: 100%;
                font-size: 12px;
            }

            button {
                font-size: 12px;
                padding: 6px 10px;
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

<h1>Selamat datang, Guru!</h1>
<h2>All Questions</h2>
<p>Selamat datang, Guru! Silakan kelola soal-soal Anda di tabel di bawah ini.</p>

<table>
    <tr>
        <th>ID</th>
        <th>Question</th>
        <th>Option A</th>
        <th>Option B</th>
        <th>Option C</th>
        <th>Option D</th>
        <th>Option E</th>
        <th>Correct Answer</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($questions as $question): ?>
        <tr>
            <td><?= $question['id'] ?></td>
            <td><?= htmlspecialchars($question['question_text']) ?></td>
            <td><?= htmlspecialchars($question['option_a']) ?></td>
            <td><?= htmlspecialchars($question['option_b']) ?></td>
            <td><?= htmlspecialchars($question['option_c']) ?></td>
            <td><?= htmlspecialchars($question['option_d']) ?></td>
            <td><?= htmlspecialchars($question['option_e']) ?></td>
            <td><?= htmlspecialchars($question['correct_option']) ?></td>
            <td>
                <form method="POST">
                    <input type="hidden" name="question_id" value="<?= $question['id'] ?>">
                    <button type="submit" name="delete_question" onclick="return confirm('Are you sure you want to delete this question?')">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
