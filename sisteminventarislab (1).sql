-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2025 at 05:57 PM
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
-- Database: `sisteminventarislab`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `IDADMIN` int(11) NOT NULL,
  `NAMAADMIN` varchar(50) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`IDADMIN`, `NAMAADMIN`, `USERNAME`, `PASSWORD`) VALUES
(1, 'Arif Nugroho', 'arifn', 'admin2025'),
(2, 'Budi Santoso', 'budis', 'budipass'),
(3, 'Joko Widodo', 'jokow', 'presiden');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `IDBARANG` int(11) NOT NULL,
  `IDUSER` int(11) NOT NULL,
  `IDKATEGORI` int(11) NOT NULL,
  `IDPINJAM` int(11) DEFAULT NULL,
  `IDADMIN` int(11) NOT NULL,
  `NAMABARANG` varchar(50) NOT NULL,
  `JUMLAHBARANG` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`IDBARANG`, `IDUSER`, `IDKATEGORI`, `IDPINJAM`, `IDADMIN`, `NAMABARANG`, `JUMLAHBARANG`) VALUES
(101, 1, 1, 1, 1, 'Laptop Lenovo ThinkPad', 5),
(102, 2, 2, 2, 2, 'Pulpen Stabilo', 100),
(103, 3, 3, 3, 3, 'Meja Komputer', 15),
(104, 4, 4, 4, 1, 'Mouse Logitech Wireless', 30),
(105, 5, 5, 5, 2, 'Headset Gaming', 10),
(106, 6, 6, NULL, 3, 'Proyektor Epson', 2),
(107, 7, 7, 6, 1, 'Set Kabel HDMI', 20),
(108, 8, 8, 7, 2, 'Buku Panduan Python', 50),
(109, 9, 9, 8, 3, 'Joystick USB', 8),
(110, 10, 10, NULL, 1, 'Jaket Lab Informatika', 25),
(111, 11, 11, 9, 2, 'Sapu Lantai', 15),
(112, 12, 12, 10, 3, 'Lampu Meja LED', 10),
(113, 13, 13, 11, 1, 'Kertas HVS A4', 200),
(114, 14, 14, 12, 2, 'Whiteboard Portable', 3),
(115, 15, 15, 13, 3, 'Tas Laptop', 30),
(116, 1, 1, 14, 1, 'Monitor Dell 24 inch', 12),
(117, 2, 2, 15, 2, 'Spidol Whiteboard', 50),
(118, 3, 3, 16, 3, 'Kursi Kantor Ergonomis', 20),
(119, 4, 4, 17, 1, 'Baterai Alkaline', 10),
(120, 5, 5, 18, 2, 'Software Antivirus Lisensi', 10);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `IDKATEGORI` int(11) NOT NULL,
  `NAMAKATEGORI` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`IDKATEGORI`, `NAMAKATEGORI`) VALUES
(1, 'Komputer & Laptop'),
(2, 'Perangkat Jaringan'),
(3, 'Perangkat Penyimpanan'),
(4, 'Perangkat Input'),
(5, 'Perangkat Output'),
(6, 'Perangkat Lunak'),
(7, 'Alat Tulis'),
(8, 'Perlengkapan Kabel & Charger'),
(9, 'Peralatan Kebersihan Lab'),
(10, 'Peralatan Presentasi'),
(11, 'Peralatan Audio Visual'),
(12, 'Meja & Kursi Lab'),
(13, 'Peralatan Pendingin'),
(14, 'Peralatan Keamanan'),
(15, 'Lain-lain');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `IDPINJAM` int(11) NOT NULL,
  `IDUSER` int(11) NOT NULL,
  `TANGGALPINJAM` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`IDPINJAM`, `IDUSER`, `TANGGALPINJAM`) VALUES
(1, 1, '2025-01-15 08:00:00'),
(2, 2, '2025-01-16 09:30:00'),
(3, 3, '2025-01-18 13:45:00'),
(4, 4, '2025-01-20 15:00:00'),
(5, 5, '2025-02-01 10:15:00'),
(6, 6, '2025-02-05 14:30:00'),
(7, 7, '2025-02-10 09:20:00'),
(8, 8, '2025-02-12 11:00:00'),
(9, 9, '2025-02-14 16:30:00'),
(10, 10, '2025-02-20 08:45:00'),
(11, 11, '2025-03-01 09:10:00'),
(12, 12, '2025-03-05 12:30:00'),
(13, 13, '2025-03-10 13:40:00'),
(14, 14, '2025-03-15 14:00:00'),
(15, 15, '2025-03-20 10:00:00'),
(16, 1, '2025-04-01 08:30:00'),
(17, 2, '2025-04-03 11:15:00'),
(18, 3, '2025-04-07 14:00:00'),
(19, 4, '2025-04-10 15:30:00'),
(20, 5, '2025-04-12 10:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `IDKEMBALI` int(11) NOT NULL,
  `IDPINJAM` int(11) NOT NULL,
  `TANGGALKEMBALI` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`IDKEMBALI`, `IDPINJAM`, `TANGGALKEMBALI`) VALUES
(16, 1, '2025-01-25 09:00:00'),
(17, 2, '2025-01-26 10:00:00'),
(18, 3, '2025-01-28 14:00:00'),
(19, 4, '2025-02-01 16:00:00'),
(20, 5, '2025-02-10 11:00:00'),
(21, 6, '2025-02-15 15:00:00'),
(22, 7, '2025-02-20 09:00:00'),
(23, 8, '2025-02-22 13:00:00'),
(24, 9, '2025-02-25 17:00:00'),
(25, 10, '2025-02-28 10:00:00'),
(26, 11, '2025-03-10 12:00:00'),
(27, 12, '2025-03-12 14:00:00'),
(28, 13, '2025-03-17 15:00:00'),
(29, 14, '2025-03-20 16:30:00'),
(30, 15, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `IDUSER` int(11) NOT NULL,
  `IDADMIN` int(11) NOT NULL,
  `NAMAUSER` varchar(50) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(15) NOT NULL,
  `Levelpeminjam` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`IDUSER`, `IDADMIN`, `NAMAUSER`, `USERNAME`, `PASSWORD`, `Levelpeminjam`) VALUES
(1, 1, 'Hibban Ramadhan', 'hibbanr', 'hibban2025', 2),
(2, 2, 'Salsa Putri', 'salsap', 'salsa321', 2),
(3, 3, 'Doni Setiawan', 'donis', 'doni789', 2),
(4, 2, 'Rina Marlina', 'rinam', 'rina123', 1),
(5, 2, 'Eko Santoso', 'ekos', 'eko456', 1),
(6, 3, 'Tina Anggraini', 'tinaa', 'tina987', 1),
(7, 1, 'Budi Pratama', 'budip', 'budi654', 1),
(8, 2, 'Lina Herawati', 'linah', 'lina321', 1),
(9, 1, 'Joko Susanto', 'jokos', 'joko258', 1),
(10, 1, 'Sari Wulandari', 'sariw', 'sari369', 1),
(11, 2, 'Andi Saputra', 'andis', 'andi147', 1),
(12, 2, 'Rita Marlina', 'ritam', 'rita753', 1),
(13, 3, 'Nina Safitri', 'ninas', 'nina159', 1),
(14, 3, 'Wawan Kurniawan', 'wawank', 'wawan357', 1),
(15, 2, 'Dewi Anggraini', 'dewia', 'dewi951', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`IDADMIN`),
  ADD UNIQUE KEY `USERNAME` (`USERNAME`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`IDBARANG`),
  ADD KEY `IDUSER` (`IDUSER`),
  ADD KEY `IDKATEGORI` (`IDKATEGORI`),
  ADD KEY `IDPINJAM` (`IDPINJAM`),
  ADD KEY `IDADMIN` (`IDADMIN`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`IDKATEGORI`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`IDPINJAM`),
  ADD KEY `IDUSER` (`IDUSER`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`IDKEMBALI`),
  ADD KEY `IDPINJAM` (`IDPINJAM`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`IDUSER`),
  ADD UNIQUE KEY `USERNAME` (`USERNAME`),
  ADD KEY `IDADMIN` (`IDADMIN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `IDADMIN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `IDBARANG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `IDKATEGORI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `IDPINJAM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `IDKEMBALI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `IDUSER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`IDUSER`) REFERENCES `users` (`IDUSER`),
  ADD CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`IDKATEGORI`) REFERENCES `kategori` (`IDKATEGORI`),
  ADD CONSTRAINT `barang_ibfk_3` FOREIGN KEY (`IDPINJAM`) REFERENCES `peminjaman` (`IDPINJAM`),
  ADD CONSTRAINT `barang_ibfk_4` FOREIGN KEY (`IDADMIN`) REFERENCES `admin` (`IDADMIN`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`IDUSER`) REFERENCES `users` (`IDUSER`);

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`IDPINJAM`) REFERENCES `peminjaman` (`IDPINJAM`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`IDADMIN`) REFERENCES `admin` (`IDADMIN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
