-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2019 at 07:44 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus_rpl`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar_buku`
--

CREATE TABLE `daftar_buku` (
  `kode_buku` int(11) NOT NULL,
  `judul_buku` varchar(100) NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daftar_buku`
--

INSERT INTO `daftar_buku` (`kode_buku`, `judul_buku`, `pengarang`, `kategori`) VALUES
(1001, 'Cara Sehat Memelihara Janggut', 'Mr. StackOverFlow', 'Kesehatan'),
(1112, 'Ilmu Mengetahui Dia', 'Doctor Strange', 'Filsafat'),
(10101, 'Misteri Di bawah kasur Thanos', 'Anak buah Ant Man', 'Kedokteran');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjam` int(11) NOT NULL,
  `nama_peminjam` varchar(100) NOT NULL,
  `alamat_peminjam` text NOT NULL,
  `tanggal_peminjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `denda` int(11) DEFAULT NULL,
  `status_peminjam` varchar(111) NOT NULL,
  `username` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjam`, `nama_peminjam`, `alamat_peminjam`, `tanggal_peminjam`, `tanggal_kembali`, `denda`, `status_peminjam`, `username`) VALUES
(16, 'Ao Chan', 'SMK TELKOM JAKARTA', '2019-04-09', '2019-04-12', NULL, 'DIPINJAM', 'rpl_mantap'),
(17, 'bambang', 'SMK TELKOM JAKARTA', '2019-04-09', '2019-04-12', NULL, 'DIKEMBALIKAN', 'rpl'),
(18, 'Ao Chan', 'SMK TELKOM JAKARTA', '2019-04-09', '2019-04-12', NULL, 'DIPINJAM', 'rpl_mantap');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_detail`
--

CREATE TABLE `peminjaman_detail` (
  `id_peminjam` int(11) NOT NULL,
  `kode_buku` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman_detail`
--

INSERT INTO `peminjaman_detail` (`id_peminjam`, `kode_buku`, `jumlah`) VALUES
(16, 1001, 1),
(16, 1112, 1),
(16, 10101, 1),
(17, 10101, 1),
(17, 1112, 2),
(18, 1001, 1),
(18, 1112, 2);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_temp`
--

CREATE TABLE `peminjaman_temp` (
  `id_peminjam_temp` int(11) NOT NULL,
  `kode_buku` int(11) NOT NULL,
  `id_session` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_peminjam_temp` date NOT NULL,
  `tanggal_kembali_temp` date NOT NULL,
  `stok_temp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock_buku`
--

CREATE TABLE `stock_buku` (
  `nomor_rak` varchar(50) NOT NULL,
  `jumlah_buku` int(11) NOT NULL,
  `kode_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_buku`
--

INSERT INTO `stock_buku` (`nomor_rak`, `jumlah_buku`, `kode_buku`) VALUES
('8D', 89, 1001),
('E45', 195, 1112),
('A67', 1998, 10101);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `alamat`, `status`) VALUES
(1, 'bambang', 'rpl', 'admin', 'SMK TELKOM JAKARTA', 'user'),
(2, 'Iqbaale', 'rpl_bisa', 'admin', 'SMK TELKOM JAKARTA', 'administrator'),
(7, 'Ao Chan', 'rpl_mantap', 'admin', 'SMK TELKOM JAKARTA', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_buku`
--
ALTER TABLE `daftar_buku`
  ADD PRIMARY KEY (`kode_buku`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjam`);

--
-- Indexes for table `peminjaman_temp`
--
ALTER TABLE `peminjaman_temp`
  ADD PRIMARY KEY (`id_peminjam_temp`);

--
-- Indexes for table `stock_buku`
--
ALTER TABLE `stock_buku`
  ADD PRIMARY KEY (`kode_buku`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `peminjaman_temp`
--
ALTER TABLE `peminjaman_temp`
  MODIFY `id_peminjam_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
