-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Des 2025 pada 09.10
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
-- Database: `db_mading`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `mading`
--

CREATE TABLE `mading` (
  `id_mading` int(11) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `tanggal_upload` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mading`
--

INSERT INTO `mading` (`id_mading`, `judul`, `deskripsi`, `gambar`, `kategori`, `tanggal_upload`, `id_user`, `status`) VALUES
(31, 'Yuk, Jaga Napasmu! Tips Paru-Paru Sehat & Bugar', 'ss', '5782_akademik4.jpg', 'Akademik', '2025-12-02', 19, 'approved'),
(32, 'test', 'tedt', '1733_kesehatan1.jpg', 'Kesehatan', '2025-12-02', 19, 'pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','mahasiswa') DEFAULT 'mahasiswa',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nim`, `nama_lengkap`, `password`, `role`, `created_at`) VALUES
(5, '2411102441191', 'Ishaq', '$2y$10$WKWqkVL6udtmvUh/OVNFDeb9RKL08n62N1jyrQV0p5ItSDiS.BLm6', 'admin', '2025-11-28 15:57:23'),
(15, '2411102441164', 'Andi Reza', '$2y$10$pU/zDnuaOa04W4MPm8I5Cerb8kTgnHe6RMgmoul.0yL7Ef4xCuCqC', 'admin', '2025-12-02 01:36:01'),
(18, '2411102441162', 'Alan Yahya', '$2y$10$hZCcW9XAtC3/nmt.rKbw.OUmn8qx4ZFndcutIQ66kevTU.o30QsDu', 'admin', '2025-12-02 01:45:57'),
(19, '2411102441241', 'Muhammad Fahbian', '$2y$10$3GjY4XJ.QL60iq/SkHy46OVcY7Qn5jisfjckEZQNqJ42.fOSmBejO', 'mahasiswa', '2025-12-02 01:53:55'),
(22, '2411102441046', 'Fahriandy Adithia', '$2y$10$dVxkl6rDfm54GQXAYGowH.GHpMvrGeJNWynTUNQuANQGGtGR7jBs6', 'mahasiswa', '2025-12-05 06:24:11'),
(23, '24111024411919999', 'babo', '$2y$10$tHCJSv23qHWuwI0F/6oopOWZXnQDy383hObUo3ACu.HTNZ6.uzXWq', 'mahasiswa', '2025-12-05 08:07:27');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `mading`
--
ALTER TABLE `mading`
  ADD PRIMARY KEY (`id_mading`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `mading`
--
ALTER TABLE `mading`
  MODIFY `id_mading` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `mading`
--
ALTER TABLE `mading`
  ADD CONSTRAINT `mading_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
