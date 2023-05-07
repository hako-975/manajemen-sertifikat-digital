-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Bulan Mei 2023 pada 08.08
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
(1, 'Memahami Ajaran Agama dengan Pendekatan Sains', 'Sertifikat UNPAM', '2020-12-05', '0000-00-00', '645736cf45050-Tifanny Patriane Andari.pdf', 1),
(2, 'TOEFL Prediction Test', 'Sertifikat UNPAM', '2023-05-02', '2025-05-02', '6457372757bd4-SERTIFIKAT_TOEFL_230313081072_TIFANNY PATRIANE ANDARI.PDF', 1),
(3, 'TOEFL Prediction Test', 'Sertifikat UNPAM', '2023-04-06', '2025-04-06', '64573a8fbb1fb-SERTIFIKAT_TOEFL_230220080853_ANDRI FIRMAN SAPUTRA.pdf', 2),
(4, 'GEMASTIK 14 - Aplikasi Permainan - The Most Inspiring Teams - Andri Firman Saputra', 'Sertifikat Finalis GEMASTIK 14', '2021-10-11', '0000-00-00', '64573afbd3d85-GEMASTIK 14 - Aplikasi Permainan - The Most Inspiring Teams - Andri Firman Saputra.pdf', 2),
(5, 'Andri Firman Saputra - Desainer Multimedia Madya - sertifikat', 'Sertifikat VSGA', '2022-07-26', '2025-07-26', '64573b580ee7d-Andri Firman Saputra - Desainer Multimedia Madya - sertifikat.pdf', 2),
(6, 'Sertifikat Propesa UNPAM', 'Sertifikat UNPAM', '2020-08-29', '0000-00-00', '64573b919f018-certifikat propesa.pdf', 2),
(7, 'Sertifikat Re-cloud Challenges Alibaba &amp; Codepolitan', 'Sertifikat Re-cloud Challenges Alibaba 2021', '2021-03-06', '2023-03-06', '64573bfd919ab-certificate re-cloud challenge from alibaba cloud and codepolitan.png', 2),
(8, 'Andri Firman Saputra - Junior Network Administrator - sertifikat', 'Sertifikat VSGA', '2022-07-29', '2025-07-29', '64573c8149dd0-Andri Firman Saputra - Junior Network Administrator - sertifikat.pdf', 2),
(9, 'Sertifikat Kompetensi Junior Web Developer', 'Sertifikat VSGA', '2021-12-23', '2024-12-23', '64573cc78cf8e-Sertifikat Kompetensi JWD.pdf', 2),
(10, 'Pemanfaatan Media Digital Untuk Meningkatkan Intelektual Generasi Muda Di Pesantren Nafidatunajah', 'Sertifikat PKM	', '2022-11-12', '0000-00-00', '64573e7f30007-WhatsApp Image 2023-05-07 at 12.14.48.jpeg', 1);

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
(1, 'tifanny123', '$2y$10$4Mn5vXdCWWv8qfMb7OCx6u8Vn6FNvgAmudo82GkGtySvV0j4RA0W2', 'Tifanny Patriane Andari'),
(2, 'andri975', '$2y$10$8fi53wDgcGpmaXURt3gngOn3eEmpW6KKuteN4GuBmkyCr7Arwn.Km', 'Andri Firman Saputra');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT untuk tabel `sertifikat`
--
ALTER TABLE `sertifikat`
  MODIFY `id_sertifikat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD CONSTRAINT `sertifikat_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
