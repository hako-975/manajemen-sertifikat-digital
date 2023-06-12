-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jun 2023 pada 03.51
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manajemen_sertifikat_digital`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_sertifikat` int(11) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_sertifikat`, `nilai`) VALUES
(1, 1, 0),
(2, 2, 410),
(3, 3, 0),
(4, 4, 0),
(5, 5, 457);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sertifikat`
--

CREATE TABLE `sertifikat` (
  `id_sertifikat` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_diterima` date NOT NULL,
  `tanggal_kedaluwarsa` date DEFAULT NULL,
  `file_sertifikat` text NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sertifikat`
--

INSERT INTO `sertifikat` (`id_sertifikat`, `judul`, `keterangan`, `tanggal_diterima`, `tanggal_kedaluwarsa`, `file_sertifikat`, `id_user`) VALUES
(1, 'Memahami Ajaran Agama dengan Pendekatan Sains', 'Sertifikat UNPAM', '2020-05-12', '0000-00-00', '64837bf420934-Tifanny Patriane Andari.pdf', 3),
(2, 'TOEFL Prediction Test', 'Sertifikat UNPAM', '2023-02-05', '2025-02-05', '64837c3a26a16-SERTIFIKAT_TOEFL_230313081072_TIFANNY PATRIANE ANDARI.PDF', 3),
(3, 'Pemanfaatan Media Digital Untuk Meningkatkan Intelektual Generasi Muda Di Pesantren Nafidatunajah', 'Sertifikat PKM', '2022-12-11', '0000-00-00', '64837c994962b-WhatsApp Image 2023-05-07 at 12.14.48.jpeg', 3),
(4, 'GEMASTIK 14 - Aplikasi Permainan - The Most Inspiring Teams - Andri Firman Saputra', 'Sertifikat Finalis GEMASTIK 14', '2021-11-10', '0000-00-00', '64837f1d5e4d4-GEMASTIK 14 - Aplikasi Permainan - The Most Inspiring Teams - Andri Firman Saputra.pdf', 2),
(5, 'TOEFL Prediction Test', 'Sertifikat UNPAM', '2023-06-04', '2025-06-04', '64837f8b94cca-SERTIFIKAT_TOEFL_230220080853_ANDRI FIRMAN SAPUTRA.pdf', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'admin', '$2y$10$IM7RIy5/LVRc4TQY200Ka.7ZVC5itU6aA23wsBEJqpFu4X7re9LKO', 'Administrator'),
(2, 'andri123', '$2y$10$dbrxmJeuKv/ohvIEUTiAxuY.K6lQaSdx6VLp9l.eISODcYPT35cae', 'Andri Firman Saputra'),
(3, 'tifanny123', '$2y$10$DKRBz2iuLDrHKEW1N0XZk.R2iZJ92kUoF0Ca00tAoyucImGTfFMvi', 'Tifanny Patriane Andari');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `id_sertifikat` (`id_sertifikat`);

--
-- Indeks untuk tabel `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD PRIMARY KEY (`id_sertifikat`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `sertifikat`
--
ALTER TABLE `sertifikat`
  MODIFY `id_sertifikat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_sertifikat`) REFERENCES `sertifikat` (`id_sertifikat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD CONSTRAINT `sertifikat_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
