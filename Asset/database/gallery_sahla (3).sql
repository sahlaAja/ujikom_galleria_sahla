-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Feb 2025 pada 06.05
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
(6, 'random dump', 'kumpulan foto sahla', '2025-02-18', 2);

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
(14, 'Makkah', 'night in Makkah', '2025-02-18', 'ALLAH’IN EVİ (KABBE)🕋.jpg', 6, 2),
(15, 'My dream Car', 'sholawatin dulu aja ya ga?!', '2025-02-18', '🎀 Dreamy Day Out in a Pink Porsche 918 Spyder 🎀.jpg', 6, 2),
(16, 'first time nonton timnas in GBK', 'Indonesia VS Jepang', '2025-02-18', 'LA GRANDE INDONESIA.jpg', 6, 2),
(17, 'My timnas ', 'Bangga banget bisa menang lawan Arab', '2025-02-18', '4e4bbe76-7166-4be5-86e8-0f7707ba8761.jpg', 6, 2),
(18, 'tulip bucket', 'my favorite flower', '2025-02-18', 'flower.jpg', 6, 2),
(19, 'My hoby', 'habis main sepeda di sungai Han', '2025-02-18', 'download (5).jpg', 4, 3),
(20, 'the summer sea caffe', 'cafe in south korea', '2025-02-18', 'cafe.jpg', 6, 2);

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
(1, 6, 4, 'semangat kakk!', '2025-02-18'),
(2, 6, 2, 'makasihhh Im Sol ', '2025-02-18');

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
(1, 1, 3, '2025-02-18'),
(2, 4, 4, '2025-02-18'),
(3, 2, 4, '2025-02-18'),
(4, 6, 4, '2025-02-18'),
(5, 4, 2, '2025-02-18');

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
(7, 3, 2, '@sahlaaja menyukai postingan photobooth date Anda ', 1, '2025-02-18 04:45:34');

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
(2, 2, 'sahlaaja', '1dcb74b1127cad99e3ab47eee5583187', 'sahlafr10@gmail.com', 'Sahla Fadhilah Rahim', 'jl. Puri Cipageran Indah 1 H4 47', 'user2.jpg', 1),
(3, 2, 'sunjae', '36e869447c142f993a15934e0297921d', 'sunjae@gmail.com', 'Ryu Sunjae', 'Seoul, South Korea', 'sunjae.jpg', 1),
(4, 2, 'imsol', '746d6941f39bf1df6622b99ac44e5163', 'ImSol@gmail.com', 'Im Sol', 'Gangnam, South Korea', 'sol.jpg', 1),
(5, 2, 'ajeliaaa', 'd74362f2d3b4ecd37daacf79d1bc2fa5', 'ajelia@gmail.com', 'Nadhira Azalea', 'GBR 3', 'user3.jpg', 1),
(6, 2, 'mira', '83469ed2521f07cb27804061cf244132', 'mira@gmail.com', 'Mira W', 'PCI 1 H4', 'ootd2.jpg', 0);

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
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `foto`
--
ALTER TABLE `foto`
  MODIFY `foto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `komentar_foto`
--
ALTER TABLE `komentar_foto`
  MODIFY `komentar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `like_foto`
--
ALTER TABLE `like_foto`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
