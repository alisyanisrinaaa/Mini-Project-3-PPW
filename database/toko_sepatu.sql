-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2024 at 05:16 AM
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
-- Database: `toko_sepatu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'Samarinda', 5000),
(2, 'Balikpapan', 10000),
(3, 'Bontang', 15000),
(4, 'Sangatta', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(50) DEFAULT NULL,
  `password_pelanggan` varchar(150) DEFAULT NULL,
  `nama_pelanggan` varchar(50) DEFAULT NULL,
  `nohp_pelanggan` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `nohp_pelanggan`) VALUES
(1, 'alisya.nisrina@gmail.com', '12345', 'alisya nisrina', '081351669257');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti_pembayaran`) VALUES
(4, 27, 'Alisya Nisrina', 'BRI', 385000, '2024-04-02', '20240402051434Screenshot 2024-03-27 165255.png'),
(5, 28, 'Alisya Nisrina', 'BRI', 370000, '2024-04-02', '20240402062940WhatsApp Image 2024-04-01 at 7.07.37 PM.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `id_ongkir`, `tanggal_pembelian`, `total_pembelian`, `nama_kota`, `tarif`, `alamat_pengiriman`, `status_pembelian`) VALUES
(27, 1, 1, '2024-04-02', 955000, 'Samarinda', 5000, 'Bumi Sempaja, Samarinda', 'Sudah bayar'),
(28, 1, 2, '2024-04-02', 370000, 'Balikpapan', 10000, 'wrwrwrwrrw', 'Sudah bayar'),
(29, 1, 2, '2024-04-02', 380000, 'Balikpapan', 10000, 'asads', 'Pending'),
(30, 1, 2, '2024-04-02', 390000, 'Balikpapan', 10000, 'fyh', 'Pending'),
(31, 1, 1, '2024-04-02', 1125000, 'Samarinda', 5000, '', 'Pending'),
(32, 1, 2, '2024-04-04', 770000, 'Balikpapan', 10000, 'wd', 'Pending'),
(33, 1, 2, '2024-04-04', 770000, 'Balikpapan', 10000, 'wd', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `subharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`, `nama`, `harga`, `subharga`) VALUES
(34, 27, 15, 1, 'Sepatu Sneakers 0468-0288 Size 38', 370000, 370000),
(35, 27, 13, 2, 'Flat Shoes 0663-0345 Size 38', 290000, 580000),
(36, 28, 2, 1, 'Sepatu Sneakers 0468-0275 Size 37', 360000, 360000),
(37, 29, 4, 1, 'Sepatu Sneakers 0468-0294 Sise 38', 370000, 370000),
(38, 30, 1, 1, 'Sepatu Sneakers 0468-0307 Size 37', 380000, 380000),
(39, 31, 2, 1, 'Sepatu Sneakers 0468-0275 Size 37', 360000, 360000),
(40, 31, 1, 2, 'Sepatu Sneakers 0468-0307 Size 37', 380000, 760000),
(41, 32, 1, 2, 'Sepatu Sneakers 0468-0307 Size 37', 380000, 760000),
(42, 33, 1, 2, 'Sepatu Sneakers 0468-0307 Size 37', 380000, 760000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `foto_produk` varchar(100) NOT NULL,
  `deskripsi_produk` varchar(100) NOT NULL,
  `stok_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `foto_produk`, `deskripsi_produk`, `stok_produk`) VALUES
(1, 'Sepatu Sneakers 0468-0307 Size 37', 380000, 'sneakers-0468-0307.jpg', 'Size available: 37\r\nMaterial: Sintetis\r\nBerat: 2 kg\r\n\r\nSize chart (Ukuran Kaki):\r\n37 : 23 cm', 13),
(2, 'Sepatu Sneakers 0468-0275 Size 37', 360000, 'sneakers-0468-0275.jpg', 'Size available: 37\r\nMaterial: Sintetis\r\nBerat: 2 kg\r\n\r\nSize chart (Ukuran Kaki):\r\n37 : 23 cm', 20),
(3, 'Sepatu Sneakers 0468-0272 Size 40', 350000, 'sneakers-0468-0272.jpg', 'Size available: 40\r\nMaterial: Sintetis\r\nBerat: 2 kg\r\n\r\nSize chart (Ukuran Kaki):\r\n40 : 25 cm', 20),
(4, 'Sepatu Sneakers 0468-0294 Sise 38', 370000, 'sneakers-0468-0294.jpg', 'Size available: 38\r\nMaterial: Sintetis\r\nBerat: 2 kg\r\n\r\nSize chart (Ukuran Kaki):\r\n38 : 23,5 cm', 20),
(5, 'Sepatu Sneakers 0468-0285 Size 40', 390000, 'sneakers-0468-0285.jpg', 'Size available: 40\r\nMaterial: Sintetis\r\nBerat: 2 kg\r\n\r\nSize chart (Ukuran Kaki):\r\n40 : 25 cm', 20),
(6, 'Flat Shoes 0400-0222 Size 36', 320000, 'flat-0400-0222.jpg', 'Size available: 36\r\nMaterial: Sintetis\r\nBerat: 1 kg\r\n\r\nSize chart:\r\n36 : 23.5 cm\r\n\r\nLebar Dalam:\r\n3', 20),
(7, 'Flat Shoes 0663-0344 Size 37', 270000, 'flat-0663-0344.jpg', 'Size avaible: 37\r\nMaterial: Sintetis\r\nBerat: 1 kg\r\n\r\nSize chart (Ukuran Kaki):\r\n37 : 23 cm', 20),
(8, 'Flat Shoes 0608-0216 Size 37', 260000, 'flat-0608-0216.jpg', 'Size avaible: 37\r\nMaterial: Sintetis\r\nBerat: 1 kg\r\n\r\nSize chart (Ukuran Kaki):\r\n37 : 23 cm', 20),
(9, 'Pantofel Flat 0615-0130 Size 38', 280000, 'flat-0615-0130.jpg', 'Size avaible: 38\r\nMaterial: Sintetis\r\nBerat: 1 kg\r\n\r\nSize chart (Ukuran Kaki):\r\n38 : 23,5 cm', 20),
(10, 'Pantofel Heels 0615-0121 Size 38', 290000, 'pantofel-0615-0121.jpg', 'Size avaible: 38\r\nMaterial: Sintetis\r\nBerat: 1 kg\r\n\r\nSize chart (Ukuran Kaki):\r\n38 : 23,5 cm', 20),
(11, 'Sepatu Sneakers 0468-0278 Size 36', 340000, 'sneakers-0468-0278.jpg', 'Size available: 36\r\nMaterial: Sintetis\r\nBerat: 2 kg\r\n\r\nSize chart (Ukuran Kaki):\r\n36 : 23.5 cm', 20),
(12, 'Pantofel Heels 0400-0339 Size 40', 320000, 'pantofel heels-0400-0339.jpg', 'Size available: 40\r\nMaterial: Sintetis\r\nBerat: 1 kg\r\n\r\nSize chart (Ukuran Kaki):\r\n40 : 25 cm\r\n\r\nLeba', 20),
(13, 'Flat Shoes 0663-0345 Size 38', 290000, 'flat-0663-0345.jpg', 'Size available: 36\r\nMaterial: Sintetis\r\nBerat: 1 kg\r\n\r\nSize chart (Ukuran Kaki):\r\n36 : 22-22,5 cm', 20),
(15, 'Sepatu Sneakers 0468-0288 Size 38', 370000, 'sneakers-0468-0288.jpg', 'Size available: 38\r\nMaterial: Sintetis\r\nBerat: 2 kg\r\n\r\nSize chart (Ukuran Kaki):\r\n38 : 23,5 cm', 20),
(16, 'Sepatu Sneakers 0468-0274 Size 37', 360000, 'sneakers-0468-0274.jpg', 'Size available: 37\r\nMaterial: Sintetis\r\nBerat: 2 kg\r\n\r\nSize chart (Ukuran Kaki):\r\n37 : 23 cm', 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_ongkir` (`id_ongkir`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_pembelian` (`id_pembelian`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`id_ongkir`) REFERENCES `ongkir` (`id_ongkir`);

--
-- Constraints for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD CONSTRAINT `pembelian_produk_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`),
  ADD CONSTRAINT `pembelian_produk_ibfk_2` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id_pembelian`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
