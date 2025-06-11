<?php
session_start();
require '../config.php';
// require '../functions.php';

// check_login('Guru');

// Handle delete action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM exam_results WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: " . $_SERVER['PHP_SELF']); // Refresh the page
    exit;
}

// Fetch data
$stmt = $pdo->query("
    SELECT 
        er.id,
        u.username, 
        er.total_correct, 
        er.total_incorrect, 
        er.final_score 
    FROM exam_results er
    JOIN users u ON er.user_id = u.id
");
$results = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Nilai Siswa</title>
    <link rel="website icon" type="png" href="../images/icon-online-exam.png" />
    <style>
        /* General Reset */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            /* background: linear-gradient(135deg, #bbdefb 0%, #e3f2fd 100%); */
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
            font-size: 14px;
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
        h1 {
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
            background-color: #64b5f6;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #42a5f5;
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

<h1>Nilai Siswa</h1>
<p>Selamat datang, Guru! Berikut adalah daftar nilai siswa.</p>

<table>
    <tr>
        <th>Username</th>
        <th>Jawaban Benar</th>
        <th>Jawaban Salah</th>
        <th>Nilai Akhir</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($results as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['username']) ?></td>
            <td><?= htmlspecialchars($row['total_correct']) ?></td>
            <td><?= htmlspecialchars($row['total_incorrect']) ?></td>
            <td><?= htmlspecialchars($row['final_score']) ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button type="submit" name="delete" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
