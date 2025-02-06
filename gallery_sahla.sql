-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Feb 2025 pada 08.51
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
(2, 'lovely runner', 'random foto with Im Sol', '2025-02-05', 3),
(3, 'sudden shower', 'memories with sunjae', '2025-02-05', 4),
(4, 'my album', 'random foto', '2025-02-05', 2),
(5, 'ootd', 'kumpulan ootd sahlaa', '2025-02-05', 2);

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
(2, 'SMA ', 'lagi nanam kapsul waktu hehe', '2025-02-05', 'lovely4.jpg', 2, 3),
(3, 'photobooth', 'foto date', '2025-02-05', 'lovely2.jpg', 3, 4),
(4, 'Im Sol', 'beautiful & cute', '2025-02-05', 'imsol2.jpg', 2, 3),
(5, 'nasi goreng ', 'nasi goreng ala korea', '2025-02-05', 'food.jpg', 4, 2),
(6, 'ootd #1', 'pinky outfit', '2025-02-05', 'user2.jpg', 5, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar_foto`
--

CREATE TABLE `komentar_foto` (
  `komentar_id` int(11) NOT NULL,
  `foto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `isi_komentar` text NOT NULL,
  `tanggal_komentar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `komentar_foto`
--

INSERT INTO `komentar_foto` (`komentar_id`, `foto_id`, `user_id`, `isi_komentar`, `tanggal_komentar`) VALUES
(1, 2, 2, 'lucu banget kakkk\r\n', '2025-02-05'),
(2, 4, 2, '😍😍😍', '2025-02-05'),
(3, 5, 2, 'buat yang mau resep nya comment yaa nanti aku drop disini!!!', '2025-02-05'),
(4, 4, 4, '🦹‍♀️🦹‍♀️🦹‍♀️', '2025-02-05'),
(5, 3, 4, 'lucuuu\r\n', '2025-02-05'),
(6, 5, 4, 'akuu mau dong kakkk', '2025-02-05'),
(7, 6, 4, 'cantik sekali kak!!', '2025-02-05'),
(8, 3, 2, 'lucu kalian bersinar banget ☀️☀️☀️☀️☀️', '2025-02-05'),
(9, 5, 2, '(1) 4 piring nasi putih dingin \r\n(2) 1 mangkuk kecil kimchi, potong tipis 75 gram \r\n(3) jamur enoki 150 gram \r\n(4) daging asap, potong tipis \r\n(5) 2 siung bawang putih, memarkan, iris halus \r\n(6) 1 sdm minyak wijen \r\n(7) 1 sdm minyak zaitun \r\n(8) 4 butir telur, masak telur mata sapi \r\n(9) 2 sdm biji wijen, sangrai \r\n(10) Garam dan gula secukupnya\r\n', '2025-02-05'),
(10, 5, 2, 'untuk cara masaknya sama ajaa kayak masak nasi goreng biasa ya im sol', '2025-02-05'),
(11, 6, 2, 'makasih im sol 🧡🧡🧡', '2025-02-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `like_foto`
--

CREATE TABLE `like_foto` (
  `like_id` int(11) NOT NULL,
  `foto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal_like` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `like_foto`
--

INSERT INTO `like_foto` (`like_id`, `foto_id`, `user_id`, `tanggal_like`) VALUES
(2, 2, 4, '2025-02-05'),
(3, 3, 3, '2025-02-05'),
(5, 4, 2, '2025-02-05'),
(6, 3, 2, '2025-02-05'),
(7, 2, 2, '2025-02-05'),
(8, 4, 4, '2025-02-05'),
(9, 6, 4, '2025-02-05'),
(10, 5, 4, '2025-02-05'),
(11, 6, 3, '2025-02-05'),
(12, 5, 3, '2025-02-05');

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
(1, 3, 3, '@sunjae menyukai postingan SMA ERA Anda ', 1, '2025-02-05 05:01:46'),
(2, 3, 4, '@imsol menyukai postingan SMA  Anda ', 1, '2025-02-05 06:41:08'),
(3, 4, 3, '@sunjae menyukai postingan photobooth Anda ', 1, '2025-02-05 06:44:54'),
(4, 3, 2, '@sahlaaja menyukai postingan SMA  Anda ', 1, '2025-02-05 06:48:12'),
(5, 3, 2, '@sahlaaja menyukai postingan Im Sol Anda ', 1, '2025-02-05 06:48:14'),
(6, 4, 2, '@sahlaaja menyukai postingan photobooth Anda ', 1, '2025-02-05 06:48:16'),
(7, 3, 2, '@sahlaaja memberi komentar -lucu banget kakkk\r\n- pada postingan SMA  Anda ', 1, '2025-02-05 06:48:42'),
(8, 3, 2, '@sahlaaja menyukai postingan SMA  Anda ', 1, '2025-02-05 06:49:18'),
(9, 3, 2, '@sahlaaja memberi komentar -😍😍😍- pada postingan Im Sol Anda ', 1, '2025-02-05 06:50:16'),
(10, 2, 2, '@sahlaaja memberi komentar -buat yang mau resep nya comment yaa nanti aku drop disini!!!- pada postingan nasi goreng  Anda ', 1, '2025-02-05 06:52:31'),
(11, 3, 4, '@imsol menyukai postingan Im Sol Anda ', 1, '2025-02-05 06:56:48'),
(12, 3, 4, '@imsol memberi komentar -🦹‍♀️🦹‍♀️🦹‍♀️- pada postingan Im Sol Anda ', 1, '2025-02-05 06:58:12'),
(13, 4, 4, '@imsol memberi komentar -lucuuu\r\n- pada postingan photobooth Anda ', 1, '2025-02-05 06:58:45'),
(14, 2, 4, '@imsol menyukai postingan ootd #1 Anda ', 1, '2025-02-05 06:59:02'),
(15, 2, 4, '@imsol menyukai postingan nasi goreng  Anda ', 1, '2025-02-05 06:59:06'),
(16, 2, 4, '@imsol memberi komentar -akuu mau dong kakkk- pada postingan nasi goreng  Anda ', 1, '2025-02-05 06:59:55'),
(17, 2, 4, '@imsol memberi komentar -cantik sekali kak!!- pada postingan ootd #1 Anda ', 1, '2025-02-05 07:00:13'),
(18, 2, 3, '@sunjae menyukai postingan ootd #1 Anda ', 1, '2025-02-05 07:01:41'),
(19, 2, 3, '@sunjae menyukai postingan nasi goreng  Anda ', 1, '2025-02-05 07:01:43'),
(20, 4, 2, '@sahlaaja memberi komentar -lucu kalian bersinar banget ☀️☀️☀️☀️☀️- pada postingan photobooth Anda ', 0, '2025-02-05 07:04:50'),
(21, 2, 2, '@sahlaaja memberi komentar -(1) 4 piring nasi putih dingin \r\n(2) 1 mangkuk kecil kimchi, potong tipis 75 gram \r\n(3) jamur enoki 150 gram \r\n(4) daging asap, potong tipis \r\n(5) 2 siung bawang putih, memarkan, iris halus \r\n(6) 1 sdm minyak wijen \r\n(7) 1 sdm ', 1, '2025-02-05 07:08:32'),
(22, 2, 2, '@sahlaaja memberi komentar -untuk cara masaknya sama ajaa kayak masak nasi goreng biasa ya im sol- pada postingan nasi goreng  Anda ', 1, '2025-02-05 07:09:13'),
(23, 2, 2, '@sahlaaja memberi komentar -makasih im sol 🧡🧡🧡- pada postingan ootd #1 Anda ', 1, '2025-02-05 07:16:13');

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
(2, 2, 'sahlaaja', '1dcb74b1127cad99e3ab47eee5583187', 'sahlafr10@gmail.com', 'Sahla Fadhilah', 'jl. Puri Cipageran Indah 1 H4 47', 'user2.jpg', 1),
(3, 2, 'sunjae', '36e869447c142f993a15934e0297921d', 'sunjae@gmail.com', 'Ryu Sunjae', 'Seoul, South Korea', 'sunjae.jpg', 1),
(4, 2, 'imsol', '746d6941f39bf1df6622b99ac44e5163', 'ImSol@gmail.com', 'Im Sol', 'Gangnam, South Korea', 'sol.jpg', 1),
(5, 2, 'ajeliaaa', 'd74362f2d3b4ecd37daacf79d1bc2fa5', 'ajelia@gmail.com', 'Nadhira Azalea', 'GBR 3', 'user3.jpg', 1);

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
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `like_foto`
--
ALTER TABLE `like_foto`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `foto_id` (`foto_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `foto`
--
ALTER TABLE `foto`
  MODIFY `foto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `komentar_foto`
--
ALTER TABLE `komentar_foto`
  MODIFY `komentar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `like_foto`
--
ALTER TABLE `like_foto`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
