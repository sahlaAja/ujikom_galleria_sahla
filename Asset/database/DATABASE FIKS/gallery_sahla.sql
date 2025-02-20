-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Feb 2025 pada 16.39
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery_sahla`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `album`
--

CREATE TABLE `album` (
  `album_id` int(11) NOT NULL,
  `nama_album` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal_buat` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `album`
--

INSERT INTO `album` (`album_id`, `nama_album`, `deskripsi`, `tanggal_buat`, `user_id`) VALUES
(1, 'my ootd', 'ootd by Sahla', '2025-02-18', 2),
(2, 'UGM dump', 'random pict in UGM', '2025-02-18', 2),
(3, 'lovely runner', 'memories with Im sol', '2025-02-18', 3),
(4, 'my dump ', 'random pict', '2025-02-18', 3),
(5, 'Im Sol dump', 'random pictures', '2025-02-18', 4),
(7, 'audri dump', 'pict by audrina', '2025-02-19', 7),
(8, 'ryan gallery', 'test', '2025-02-19', 8),
(11, 'my ootd', 'my ootd', '2025-02-19', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `foto`
--

CREATE TABLE `foto` (
  `foto_id` int(11) NOT NULL,
  `judul_foto` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal_unggah` date NOT NULL,
  `lokasi_file` varchar(255) NOT NULL,
  `album_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `foto`
--

INSERT INTO `foto` (`foto_id`, `judul_foto`, `deskripsi`, `tanggal_unggah`, `lokasi_file`, `album_id`, `user_id`) VALUES
(1, 'ootd #1', 'ootd lagi hujan', '2025-02-18', 'download (7).jpg', 1, 2),
(2, 'Im Sol', 'My gf', '2025-02-18', 'imsol2.jpg', 3, 3),
(3, 'visca barca visca catalunya', 'Juara Supercopa 2024/2025', '2025-02-18', 'FC Barcelona 💙❤️.jpg', 4, 3),
(4, 'photobooth date', 'sweet photo with Im Sol', '2025-02-18', 'lovely2.jpg', 3, 3),
(5, 'My University', 'universitas terbaik versi aku!!!', '2025-02-18', 'Universitas Gadjah Mada.jpg', 2, 2),
(6, 'Pionir 2025', 'Hari pertama pionir', '2025-02-18', 'Ppsmb pionir universitas gadjah mada ugm 2024 gsp_.jpg', 2, 2),
(7, 'My room', 'new room in Seoul', '2025-02-18', '826e4646-9ddc-406b-a266-8df2f1b36d75.jpg', 5, 4),
(8, 'SMA ERA', 'lagi nanam kapsul waktu hehe', '2025-02-18', 'lovely4.jpg', 5, 4),
(9, 'korean fried rice', 'Lagi belajar masak', '2025-02-18', 'food.jpg', 5, 4),
(10, 'foto pertama di UGM', 'foto perdana pake almet karung goni', '2025-02-18', 'UGM.jpg', 2, 2),
(11, 'ootd #2', 'blue & cream', '2025-02-18', 'ootd3.jpg', 1, 2),
(12, 'graduation day', 'resmi menamatkan game kuliah hehe', '2025-02-18', '08c10f84-47dc-4489-8f50-9193c71aaed0.jpg', 2, 2),
(13, 'ootd #3', 'ootd meeting di cafe', '2025-02-18', 'ootd2.jpg', 1, 2),
(19, 'My hoby', 'habis main sepeda di sungai Han', '2025-02-18', 'download (5).jpg', 4, 3),
(21, 'ramen with bestie', 'Akhirnya Main lagi sama mereka', '2025-02-19', 'mam ramen hihiw.jpg', 7, 7),
(23, 'panitia', 'panitia', '2025-02-19', 'panit.jpg', 8, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar_foto`
--

CREATE TABLE `komentar_foto` (
  `komentar_id` int(11) NOT NULL,
  `foto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `penerima_id` int(11) NOT NULL,
  `isi_komentar` text NOT NULL,
  `tanggal_komentar` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `komentar_foto`
--

INSERT INTO `komentar_foto` (`komentar_id`, `foto_id`, `user_id`, `penerima_id`, `isi_komentar`, `tanggal_komentar`) VALUES
(1, 6, 4, 0, 'semangat kakk!', '2025-02-17 17:00:00'),
(2, 6, 2, 0, 'makasihhh Im Sol ', '2025-02-17 17:00:00'),
(3, 3, 2, 0, 'visca barca ❤️💙', '2025-02-18 17:00:00'),
(4, 3, 3, 0, '❤️💙', '2025-02-18 17:00:00'),
(7, 12, 7, 0, 'congratulations sahlaaa!', '2025-02-18 17:00:00'),
(8, 12, 7, 0, 'nanti kita main yaaa di bandung', '2025-02-18 17:00:00'),
(9, 12, 2, 0, 'makasih auddd', '2025-02-18 17:00:00'),
(10, 12, 2, 0, 'okayy nanti aku ke bandung haha', '2025-02-18 17:00:00'),
(11, 21, 8, 0, 'test', '2025-02-18 17:00:00'),
(12, 12, 8, 0, 'test', '2025-02-18 17:00:00'),
(15, 6, 4, 2, 'halo kak', '2025-02-20 06:58:11'),
(16, 6, 4, 2, 'semangat kakkk', '2025-02-20 07:02:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `like_foto`
--

CREATE TABLE `like_foto` (
  `like_id` int(11) NOT NULL,
  `foto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `penerima_id` int(11) NOT NULL,
  `tanggal_like` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `like_foto`
--

INSERT INTO `like_foto` (`like_id`, `foto_id`, `user_id`, `penerima_id`, `tanggal_like`) VALUES
(31, 1, 2, 2, '2025-02-20'),
(32, 6, 2, 2, '2025-02-20'),
(33, 11, 2, 2, '2025-02-20'),
(37, 8, 4, 2, '2025-01-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int(11) NOT NULL,
  `penerima_id` int(11) NOT NULL,
  `pengirim_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `penerima_id`, `pengirim_id`, `message`, `is_read`, `created_at`) VALUES
(1, 2, 3, '@sunjae menyukai postingan ootd #1 Anda ', 1, '2025-02-18 04:28:31'),
(2, 3, 4, '@imsol menyukai postingan photobooth date Anda ', 1, '2025-02-18 04:37:51'),
(3, 3, 4, '@imsol menyukai postingan Im Sol Anda ', 1, '2025-02-18 04:37:54'),
(4, 2, 4, '@imsol menyukai postingan Pionir 2025 Anda ', 1, '2025-02-18 04:37:57'),
(5, 2, 4, '@imsol memberi komentar -semangat kakk!- pada postingan Pionir 2025 Anda ', 1, '2025-02-18 04:38:11'),
(6, 2, 2, '@sahlaaja memberi komentar -makasihhh Im Sol - pada postingan Pionir 2025 Anda ', 1, '2025-02-18 04:45:08'),
(7, 3, 2, '@sahlaaja menyukai postingan photobooth date Anda ', 1, '2025-02-18 04:45:34'),
(8, 3, 2, '@sahlaaja menyukai postingan My hoby Anda ', 1, '2025-02-19 02:43:05'),
(9, 2, 2, '@sahlaaja menyukai postingan the summer sea caffe Anda ', 1, '2025-02-19 02:43:17'),
(10, 2, 2, '@sahlaaja menyukai postingan My dream Car Anda ', 1, '2025-02-19 02:43:23'),
(11, 3, 2, '@sahlaaja menyukai postingan visca barca visca catalunya Anda ', 1, '2025-02-19 02:43:31'),
(12, 3, 2, '@sahlaaja memberi komentar -visca barca ❤️💙- pada postingan visca barca visca catalunya Anda ', 1, '2025-02-19 02:44:52'),
(13, 4, 2, '@sahlaaja menyukai postingan SMA ERA Anda ', 1, '2025-02-19 02:45:08'),
(14, 3, 3, '@sunjae memberi komentar -❤️💙- pada postingan visca barca visca catalunya Anda ', 1, '2025-02-19 02:46:09'),
(15, 2, 4, '@imsol menyukai postingan the summer sea caffe Anda ', 1, '2025-02-19 03:10:20'),
(16, 2, 4, '@imsol memberi komentar -ini di kota apa kak??- pada postingan the summer sea caffe Anda ', 1, '2025-02-19 03:10:36'),
(17, 2, 4, '@imsol menyukai postingan graduation day Anda ', 1, '2025-02-19 03:11:02'),
(18, 2, 4, '@imsol menyukai postingan ootd #2 Anda ', 1, '2025-02-19 03:11:07'),
(19, 2, 4, '@imsol menyukai postingan My University Anda ', 1, '2025-02-19 03:11:13'),
(20, 2, 4, '@imsol menyukai postingan first time nonton timnas in GBK Anda ', 1, '2025-02-19 03:11:17'),
(21, 2, 4, '@imsol menyukai postingan foto pertama di UGM Anda ', 1, '2025-02-19 03:11:26'),
(22, 2, 4, '@imsol menyukai postingan ootd #3 Anda ', 1, '2025-02-19 03:11:31'),
(23, 2, 4, '@imsol menyukai postingan My timnas  Anda ', 1, '2025-02-19 03:11:33'),
(24, 4, 4, '@imsol menyukai postingan SMA ERA Anda ', 1, '2025-02-19 03:11:40'),
(25, 4, 4, '@imsol menyukai postingan korean fried rice Anda ', 1, '2025-02-19 03:11:46'),
(26, 2, 4, '@imsol menyukai postingan Makkah Anda ', 1, '2025-02-19 03:11:49'),
(27, 2, 4, '@imsol menyukai postingan tulip bucket Anda ', 1, '2025-02-19 03:11:53'),
(28, 2, 1, '@admin menyukai postingan the summer sea caffe Anda ', 1, '2025-02-19 03:17:33'),
(29, 2, 7, '@audri menyukai postingan the summer sea caffe Anda ', 1, '2025-02-19 03:18:35'),
(30, 2, 7, '@audri memberi komentar -ini di gwangju ya ga sih?- pada postingan the summer sea caffe Anda ', 1, '2025-02-19 03:19:33'),
(31, 2, 7, '@audri memberi komentar -congratulations sahlaaa!- pada postingan graduation day Anda ', 1, '2025-02-19 03:20:08'),
(32, 2, 7, '@audri memberi komentar -nanti kita main yaaa di bandung- pada postingan graduation day Anda ', 1, '2025-02-19 03:25:19'),
(33, 2, 2, '@sahlaaja memberi komentar -makasih auddd- pada postingan graduation day Anda ', 1, '2025-02-19 03:26:31'),
(34, 2, 2, '@sahlaaja memberi komentar -okayy nanti aku ke bandung haha- pada postingan graduation day Anda ', 1, '2025-02-19 03:26:47'),
(35, 7, 8, '@ryan menyukai postingan ramen with bestie Anda ', 1, '2025-02-19 04:43:40'),
(36, 7, 8, '@ryan memberi komentar -test- pada postingan ramen with bestie Anda ', 1, '2025-02-19 04:43:49'),
(37, 2, 8, '@ryan memberi komentar -test- pada postingan graduation day Anda ', 1, '2025-02-19 04:47:11'),
(38, 2, 2, '@sahlaaja menyukai postingan ootd #2 Anda ', 1, '2025-02-20 11:04:48'),
(39, 2, 2, '@sahlaaja memberi komentar -badass!!- pada postingan first time nonton timnas in GBK Anda ', 1, '2025-02-20 12:27:09'),
(40, 2, 2, '@sahlaaja memberi komentar -badass- pada postingan first time nonton timnas in GBK Anda ', 1, '2025-02-20 12:28:19'),
(41, 4, 2, '@sahlaaja menyukai postingan SMA ERA Anda ', 1, '2025-02-20 12:48:25'),
(42, 2, 2, '@sahlaaja menyukai postingan ootd #1 Anda ', 1, '2025-02-20 12:49:18'),
(43, 2, 2, '@sahlaaja menyukai postingan Pionir 2025 Anda ', 1, '2025-02-20 12:49:25'),
(44, 2, 2, '@sahlaaja menyukai postingan ootd #2 Anda ', 1, '2025-02-20 12:49:27'),
(45, 2, 2, '@sahlaaja menyukai postingan first time nonton timnas in GBK Anda ', 1, '2025-02-20 12:49:29'),
(46, 2, 2, '@sahlaaja menyukai postingan the summer sea caffe Anda ', 1, '2025-02-20 12:49:31'),
(47, 2, 2, '@sahlaaja menyukai postingan My timnas  Anda ', 1, '2025-02-20 12:49:36'),
(48, 4, 2, '@sahlaaja menyukai postingan SMA ERA Anda ', 1, '2025-02-20 12:50:38'),
(49, 2, 4, '@imsol memberi komentar -halo kak- pada postingan Pionir 2025 Anda ', 1, '2025-02-20 12:58:11'),
(50, 2, 4, '@imsol memberi komentar -semangat kakkk- pada postingan Pionir 2025 Anda ', 1, '2025-02-20 13:02:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `name_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`role_id`, `name_role`) VALUES
(1, 'ADM'),
(2, 'USER');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `foto_profil` varchar(255) NOT NULL,
  `verifikasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `role_id`, `username`, `password`, `email`, `name`, `alamat`, `foto_profil`, `verifikasi`) VALUES
(1, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', 'Jaya', 'Cipageran Asri', 'admin.jpg', 1),
(2, 2, 'sahlaaja', '1dcb74b1127cad99e3ab47eee5583187', 'sahlafr10@gmail.com', 'Sahla Fadhilah R', 'jl. Puri Cipageran Indah 1 H4 47', 'user2.jpg', 1),
(3, 2, 'sunjae', '36e869447c142f993a15934e0297921d', 'sunjae@gmail.com', 'Ryu Sunjae', 'Seoul, South Korea', 'sunjae.jpg', 1),
(4, 2, 'imsol', '746d6941f39bf1df6622b99ac44e5163', 'ImSol@gmail.com', 'Im Sol', 'Gangnam, South Korea', 'sol.jpg', 1),
(5, 2, 'ajeliaaa', 'd74362f2d3b4ecd37daacf79d1bc2fa5', 'ajelia@gmail.com', 'Nadhira Azalea', 'GBR 3', 'user3.jpg', 1),
(6, 2, 'mira', '83469ed2521f07cb27804061cf244132', 'mira@gmail.com', 'Mira W', 'PCI 1 H4', 'ootd2.jpg', 0),
(7, 2, 'audri', '95bb2c66b36187d29f27b8994fd05c19', 'audri@gmail.com', 'Audrina', 'Jalan Pesantren', 'audri.jpg', 1),
(8, 2, 'ryan', '10c7ccc7a4f0aff03c915c485565b9da', 'ryan@gmail.com', 'ryan', 'Jalan Pesantren', 'admin.jpg', 1),
(9, 2, 'riri', 'c740d6848b6a342dcc26c177ea2c49fe', 'audri@gmail.com', 'riri', 'Jalan Pesantren', 'audri.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`album_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`foto_id`),
  ADD KEY `album_id` (`album_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `komentar_foto`
--
ALTER TABLE `komentar_foto`
  ADD PRIMARY KEY (`komentar_id`),
  ADD KEY `foto_id` (`foto_id`,`user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `penerima_id` (`penerima_id`);

--
-- Indeks untuk tabel `like_foto`
--
ALTER TABLE `like_foto`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `foto_id` (`foto_id`,`user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `penerima_id` (`penerima_id`);

--
-- Indeks untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `album`
--
ALTER TABLE `album`
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `foto`
--
ALTER TABLE `foto`
  MODIFY `foto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `komentar_foto`
--
ALTER TABLE `komentar_foto`
  MODIFY `komentar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `like_foto`
--
ALTER TABLE `like_foto`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `album` (`album_id`),
  ADD CONSTRAINT `foto_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `komentar_foto`
--
ALTER TABLE `komentar_foto`
  ADD CONSTRAINT `komentar_foto_ibfk_1` FOREIGN KEY (`foto_id`) REFERENCES `foto` (`foto_id`),
  ADD CONSTRAINT `komentar_foto_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `like_foto`
--
ALTER TABLE `like_foto`
  ADD CONSTRAINT `like_foto_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `like_foto_ibfk_2` FOREIGN KEY (`foto_id`) REFERENCES `foto` (`foto_id`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
