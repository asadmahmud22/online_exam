-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2025 at 01:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_exam_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `selected_option` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_correct` int(11) NOT NULL,
  `total_incorrect` int(11) NOT NULL,
  `final_score` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `option_e` varchar(255) NOT NULL,
  `correct_option` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question_text`, `option_a`, `option_b`, `option_c`, `option_d`, `option_e`, `correct_option`) VALUES
(1, 'Apa yang dimaksud dengan perangkat keras komputer?', 'A. Sistem operasi yang digunakan komputer', 'B. Bagian fisik komputer yang dapat dilihat dan disentuh', 'C. Program yang digunakan untuk menjalankan komputer', 'D. Data yang disimpan di komputer', 'E. Bahasa pemrograman komputer', 'B'),
(2, 'Apa fungsi utama dari CPU dalam komputer?', 'A. Menyimpan data secara permanen', 'B. Mengolah dan memproses data', 'C. Menghubungkan komputer ke jaringan', 'D. Menampilkan informasi pada layar', 'E. Mencetak dokumen', 'B'),
(3, 'Manakah yang termasuk dalam perangkat lunak sistem?\r\n', 'A. Microsoft Word', 'B. Adobe Photoshop', 'C. Windows 10', 'D. Google Chrome', 'E. CorelDRAW', 'C'),
(4, 'Apa kepanjangan dari LAN dalam jaringan komputer?', 'A. Local Area Network', 'B. Long Access Network', 'C. Large Area Network', 'D. Linear Access Network', 'E. Local Application Network', 'A'),
(5, 'Apa fungsi dari firewall dalam jaringan komputer?', 'A. Mempercepat koneksi internet', 'B. Meningkatkan kualitas sinyal', 'C. Melindungi jaringan dari akses yang tidak sah', 'D. Mengatur bandwidth jaringan', 'E. Menyimpan data secara aman', 'C'),
(6, 'Manakah yang merupakan bahasa pemrograman?', 'A. HTML', 'B. JavaScript', 'C. CSS', 'D. PHP', 'E. Semua jawaban benar', 'E'),
(7, 'Apa tujuan utama dari cloud computing?', 'A. Meningkatkan kecepatan perangkat keras', 'B. Menyediakan antivirus terbaik', 'C. Mempercepat proses pemrograman', 'D. Menyimpan dan mengakses data melalui internet', 'E. Membuat jaringan lokal', 'D'),
(8, 'Apa yang dimaksud dengan phishing?', 'A. Penipuan untuk mencuri informasi sensitif melalui email atau situs palsu', 'B. Serangan yang menargetkan perangkat keras komputer', 'C. Program untuk mengamankan data pengguna', 'D. Proses pengumpulan data dari internet', 'E. Teknik untuk mempercepat koneksi internet', 'B'),
(9, 'Apa fungsi utama dari RAM dalam komputer?', 'A. Mengolah data grafik', 'B. Menyimpan data secara permanen', 'C. Menjalankan aplikasi komputer', 'D. Menyimpan data sementara saat komputer digunakan', 'E. Meningkatkan daya tahan baterai', 'D'),
(10, 'Apa perbedaan utama antara HTTP dan HTTPS?', 'A. HTTPS lebih cepat daripada HTTP', 'C. HTTP hanya digunakan untuk situs media sosial', 'C. HTTPS menggunakan enkripsi untuk keamanan data', 'D. HTTPS adalah versi lama dari HTTP', 'E. HTTP digunakan untuk perangkat mobile', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Guru','Siswa','Pengunjung') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'guru', 'guru', 'Guru'),
(2, 'asad', 'asadmhd', 'Siswa'),
(3, 'agus', 'agus', 'Siswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD CONSTRAINT `exam_results_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
