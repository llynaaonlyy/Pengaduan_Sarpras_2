-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 17, 2025 at 01:41 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengaduan_sarpras`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id_item` int NOT NULL,
  `nama_item` varchar(200) NOT NULL,
  `lokasi` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `nama_foto` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id_item`, `nama_item`, `lokasi`, `deskripsi`, `foto`, `nama_foto`) VALUES
(1, 'AC', 'R. Wijaya Kusuma, R. Kepsek, R.Wakepsek, R.Guru, R. BK, Lab 1-20', 'Air Conditioner', '1763231691_56937d3efc84920d7618.jpg', NULL),
(2, 'Kursi Besi', 'R. Wijaya Kusuma, R. Kepsek, R.Wakepsek, R.Guru, R. BK, Lab 1-20', 'Kursi Tumpuk Besi', '1763231714_db1a35b366c51d68f9fa.jpg', NULL),
(3, 'Meja Kaca', 'R. Wijaya Kusuma, R. Kepsek, R.Wakepsek, R.Guru, R. BK, Lab 1-20', 'Meja Kaca Besar', '1763231732_f159492665c2c44e0556.jpeg', NULL),
(4, 'Proyektor', 'Semua Ruang Kelas dan Lab', 'Proyektor gantung', NULL, NULL),
(5, 'Layar Proyektor', 'R. Wijaya Kusuma', 'Layar Proyektor gantung dan berdiri', NULL, NULL),
(6, 'Lampu', 'Semua ruang kelas', 'Lampu 5 whatt', '1763231807_a25b930a751c71bee414.jpg', NULL),
(7, 'Papan Tulis', 'Semua ruang kelas', 'Papan tulis putih', '1763231824_6d303bd5f3c9bc8a389b.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` int NOT NULL,
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `dibuat_pada` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `tanggal_awal`, `tanggal_akhir`, `dibuat_pada`) VALUES
(3, '2025-11-12', '2025-11-17', '2025-11-15 15:24:47');

-- --------------------------------------------------------

--
-- Table structure for table `list_lokasi`
--

CREATE TABLE `list_lokasi` (
  `id_list` int NOT NULL,
  `id_lokasi` int NOT NULL,
  `id_item` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `list_lokasi`
--

INSERT INTO `list_lokasi` (`id_list`, `id_lokasi`, `id_item`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(10, 10, 1),
(11, 11, 1),
(12, 12, 1),
(13, 13, 1),
(14, 1, 2),
(15, 4, 2),
(16, 5, 2),
(17, 6, 2),
(18, 7, 2),
(19, 8, 2),
(20, 9, 2),
(21, 10, 2),
(22, 11, 2),
(23, 12, 2),
(24, 13, 2),
(25, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id_lokasi` int NOT NULL,
  `nama_lokasi` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id_lokasi`, `nama_lokasi`) VALUES
(1, 'Ruang Wijaya Kusuma'),
(2, 'Ruang Kepala Sekolah'),
(3, 'Ruang Wakil Kepala Sekolah'),
(4, 'Ruang Tata Usaha'),
(5, 'Ruang Guru Normada'),
(6, 'Ruang Bimbingan Konseling'),
(7, 'Ruang Guru AKL'),
(8, 'Ruang Guru LPS'),
(9, 'Ruang Guru MP'),
(10, 'Ruang Guru Pemasaran'),
(11, 'Ruang Guru DKV 1'),
(12, 'Ruang Guru RPL'),
(13, 'Ruang Guru TKJ'),
(14, 'Ruang 1');

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id_pengaduan` int NOT NULL,
  `nama_pengaduan` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `lokasi` varchar(200) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `nama_foto` varchar(255) DEFAULT NULL,
  `status` enum('Diajukan','Ditolak','Disetujui','Diproses','Selesai') NOT NULL,
  `id_user` int NOT NULL,
  `id_petugas` int NOT NULL,
  `id_item` int DEFAULT NULL,
  `tgl_pengajuan` timestamp NOT NULL,
  `tgl_selesai` timestamp NULL DEFAULT NULL,
  `saran_petugas` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id_pengaduan`, `nama_pengaduan`, `deskripsi`, `lokasi`, `foto`, `nama_foto`, `status`, `id_user`, `id_petugas`, `id_item`, `tgl_pengajuan`, `tgl_selesai`, `saran_petugas`) VALUES
(8, 'Ac Kedinginan', 'qwdd', '9', '1763016263_6e2e36bcae7f0df904e6.jpg', NULL, 'Diajukan', 12, 1, 1, '2025-11-12 23:44:23', NULL, ''),
(12, 'lampu mati', '', 'ruang guru', '1763228727_9eb6ddd183d48567df19.jpg', NULL, 'Selesai', 12, 1, NULL, '2025-11-15 10:45:27', '2025-11-15 17:00:00', 'sudah selesai.'),
(15, 'air ', 'air tidak mau mengalir, mungkin karena habis', '13', '1763357385_2f12c5d1d290f07ee5d9.jpg', NULL, 'Selesai', 12, 1, 1, '2025-11-16 22:29:45', '2025-11-16 17:00:00', 'sudah selesai yaaa'),
(16, 'Gelas', 'gelas tongji pecah', '', '1763385907_2ea1e05915f47881e97e.png', NULL, 'Diajukan', 12, 1, 2, '2025-11-17 06:25:07', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int NOT NULL,
  `nama` varchar(200) NOT NULL,
  `gender` enum('P','L') NOT NULL,
  `telp` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama`, `gender`, `telp`) VALUES
(1, 'Inara', 'P', '081234567890'),
(2, 'Lanu', 'L', '087391764419');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id_rating` int NOT NULL,
  `id_user` int NOT NULL,
  `id_pengaduan` int NOT NULL,
  `rating` int NOT NULL COMMENT '1-5',
  `ulasan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temporary_item`
--

CREATE TABLE `temporary_item` (
  `id_temporary` int NOT NULL,
  `id_item` int DEFAULT NULL,
  `nama_barang_baru` varchar(200) NOT NULL,
  `lokasi_barang_baru` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `temporary_item`
--

INSERT INTO `temporary_item` (`id_temporary`, `id_item`, `nama_barang_baru`, `lokasi_barang_baru`) VALUES
(6, NULL, 'lampu', 'ruang guru'),
(7, NULL, 'tes', 'surga');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_pengguna` varchar(100) NOT NULL,
  `role` enum('Admin','Petugas','Guru','Siswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_pengguna`, `role`) VALUES
(11, 'petugas1', 'petugas1', 'Pak Sobri', 'Petugas'),
(12, 'guru1', 'guru1', 'Bu Guru', 'Guru'),
(13, 'admin', 'admin', 'Admin', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id_item`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `list_lokasi`
--
ALTER TABLE `list_lokasi`
  ADD PRIMARY KEY (`id_list`),
  ADD KEY `id_lokasi` (`id_lokasi`),
  ADD KEY `id_item` (`id_item`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_petugas` (`id_petugas`),
  ADD KEY `id_item` (`id_item`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id_rating`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_pengaduan` (`id_pengaduan`);

--
-- Indexes for table `temporary_item`
--
ALTER TABLE `temporary_item`
  ADD PRIMARY KEY (`id_temporary`) USING BTREE,
  ADD KEY `tempoary_item_ibfk_1` (`id_item`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id_item` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `list_lokasi`
--
ALTER TABLE `list_lokasi`
  MODIFY `id_list` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id_lokasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id_rating` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temporary_item`
--
ALTER TABLE `temporary_item`
  MODIFY `id_temporary` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `list_lokasi`
--
ALTER TABLE `list_lokasi`
  ADD CONSTRAINT `list_lokasi_ibfk_1` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi` (`id_lokasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `list_lokasi_ibfk_2` FOREIGN KEY (`id_item`) REFERENCES `items` (`id_item`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `pengaduan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengaduan_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengaduan_ibfk_3` FOREIGN KEY (`id_item`) REFERENCES `items` (`id_item`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`id_pengaduan`) REFERENCES `pengaduan` (`id_pengaduan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
