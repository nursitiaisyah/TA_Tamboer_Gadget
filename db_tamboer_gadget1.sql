-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2024 at 04:59 PM
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
-- Database: `db_tamboer_gadget1`
--

-- --------------------------------------------------------

--
-- Table structure for table `faktur_penjualan`
--

CREATE TABLE `faktur_penjualan` (
  `id_faktur` int(11) NOT NULL,
  `kode_penjualan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faktur_penjualan`
--

INSERT INTO `faktur_penjualan` (`id_faktur`, `kode_penjualan`) VALUES
(1, 'PNJ0001'),
(13, 'PNJ0002'),
(14, 'PNJ0003'),
(15, 'PNJ0004'),
(16, 'PNJ0005'),
(17, 'PNJ0006'),
(18, 'PNJ0007'),
(19, 'PNJ0008'),
(20, 'PNJ0009'),
(21, 'PNJ0010'),
(22, 'PNJ0011');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_keuangan`
--

CREATE TABLE `laporan_keuangan` (
  `id_keuangan` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `total_penjualan` decimal(15,2) DEFAULT 0.00,
  `total_pengeluaran` decimal(15,2) DEFAULT 0.00,
  `total_pemasukan` decimal(15,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id_pemasukan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `sumber_dana` varchar(50) DEFAULT NULL,
  `jumlah` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemasukan`
--

INSERT INTO `pemasukan` (`id_pemasukan`, `tanggal`, `keterangan`, `sumber_dana`, `jumlah`) VALUES
(2, '2024-11-14', 'Modal Awal', 'Dana Pribadi', 50000000.00),
(5, '2024-12-03', 'Keuntungan Bulan Nov', 'Penjualan', 77000000.00),
(6, '2024-12-05', 'Hasil Penjualan Bulan November', 'Hasil Penjualan Bulan November', 1000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_satuan` decimal(15,2) NOT NULL,
  `total_harga` decimal(15,2) GENERATED ALWAYS AS (`jumlah` * `harga_satuan`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `tanggal`, `keterangan`, `jumlah`, `harga_satuan`) VALUES
(7, '2024-11-02', 'Biaya Iklan Media Sosial', 1, 500000.00),
(8, '2024-11-03', 'Pembelian Etalase Baru', 1, 2500000.00),
(9, '2024-11-04', 'Biaya Pemeliharaan Toko', 1, 750000.00),
(12, '2024-12-10', 'Iklan Media Sosial', 1, 200000.00);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `id_faktur` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_pembeli` varchar(255) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `id_varian` int(11) DEFAULT NULL,
  `harga_jual` decimal(10,2) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `metode_pembayaran` enum('Tunai','Transfer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `id_faktur`, `tanggal`, `id_user`, `nama_pembeli`, `no_hp`, `id_varian`, `harga_jual`, `jumlah`, `total_harga`, `metode_pembayaran`) VALUES
(32, 20, '2024-12-27', 18, 'Irwansyah', '086456778568', 41, 10000000.00, 1, 10000000.00, 'Transfer'),
(33, 21, '2024-12-27', 18, 'Roni', '08233546781', 43, 10008000.00, 1, 10008000.00, 'Tunai'),
(34, 22, '2024-12-27', 18, 'Irwansyah', '086456778568', 41, 10000000.00, 1, 10000000.00, 'Tunai');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_hp` varchar(20) NOT NULL,
  `merek` varchar(15) NOT NULL,
  `model` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_hp`, `merek`, `model`) VALUES
(13, 'Galaxy S21', 'Samsung', 'S21-Base'),
(14, 'iPhone 13', 'Apple', '13-Pro'),
(15, 'Mi 11', 'Xiaomi', '11-Ultra'),
(16, 'Reno5', 'Oppo', 'Reno5-A'),
(19, 'P40', 'Huawei', 'P40-Pro'),
(20, 'OnePlus 9', 'OnePlus', '9-Pro'),
(21, 'Pixel 5', 'Google', '5-XL'),
(22, 'Xperia 5 II', 'Sony', '5-II'),
(23, 'Galaxy A55', 'Samsung', 'A55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('pemilik','pegawai') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `reset_code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `email`, `password`, `role`, `created_at`, `updated_at`, `reset_code`) VALUES
(17, 'Nur Siti Aisyah', 'aisyah', 'nur617859@gmail.com', '$2y$10$ppNXFoIEFQGPX4u8Zuyih.ogN3vegWnRkGmxkfM93wfPRo/y3ZYo.', 'pemilik', '2024-12-21 09:38:02', '2024-12-21 09:38:02', NULL),
(18, 'Rendy', 'rendy', 'aisyahnrst9@gmail.com', '$2y$10$qeBSGEH8lIBPeMJaZ6qWMe9DR6QydFoZGxAAbtOPRQudg93FnUqD.', 'pegawai', '2024-12-21 09:41:43', '2024-12-27 22:54:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `varian`
--

CREATE TABLE `varian` (
  `id_varian` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `ram` varchar(10) DEFAULT NULL,
  `warna` varchar(50) DEFAULT NULL,
  `penyimpanan` varchar(10) DEFAULT NULL,
  `kondisi` enum('Baru','Bekas') NOT NULL DEFAULT 'Baru',
  `harga_masuk` decimal(15,2) NOT NULL,
  `harga_jual` decimal(15,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `status` enum('Tersedia','Kosong') DEFAULT 'Tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `varian`
--

INSERT INTO `varian` (`id_varian`, `id_produk`, `ram`, `warna`, `penyimpanan`, `kondisi`, `harga_masuk`, `harga_jual`, `stok`, `status`) VALUES
(41, 13, '8GB', 'Phantom Gray', '64GB', 'Baru', 9500000.00, 10000000.00, 5, 'Tersedia'),
(43, 15, '6GB', 'Gray', '128GB', 'Baru', 9000000.00, 10008000.00, 9, 'Tersedia'),
(44, 16, '8GB', 'White', '128GB', 'Baru', 9200000.00, 9800000.00, 4, 'Tersedia'),
(48, 20, '8GB', 'Green', '128GB', 'Bekas', 8500000.00, 9000000.00, 4, 'Tersedia'),
(52, 14, '8GB', 'Gold', '128GB', 'Bekas', 7500000.00, 8000000.00, 5, 'Tersedia'),
(53, 15, '4GB', 'White', '64GB', 'Baru', 5000000.00, 5500000.00, 15, 'Tersedia'),
(54, 23, '8', 'Blue', '128', 'Baru', 4000000.00, 5000000.00, 0, 'Tersedia'),
(55, 23, '12', 'Navy', '256', 'Baru', 5000000.00, 6000000.00, 0, 'Tersedia'),
(56, 13, '8GB', 'Putih', '128GB', 'Bekas', 2000000.00, 3000000.00, 1, 'Tersedia'),
(57, 14, '8GB', 'Putih', '128GB', 'Baru', 9000000.00, 10000000.00, 16, 'Tersedia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faktur_penjualan`
--
ALTER TABLE `faktur_penjualan`
  ADD PRIMARY KEY (`id_faktur`),
  ADD UNIQUE KEY `kode_penjualan` (`kode_penjualan`);

--
-- Indexes for table `laporan_keuangan`
--
ALTER TABLE `laporan_keuangan`
  ADD PRIMARY KEY (`id_keuangan`);

--
-- Indexes for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id_pemasukan`),
  ADD KEY `tanggal` (`tanggal`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `tanggal` (`tanggal`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD UNIQUE KEY `kode_penjualan` (`id_faktur`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_varian` (`id_varian`),
  ADD KEY `id_faktur` (`id_faktur`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `varian`
--
ALTER TABLE `varian`
  ADD PRIMARY KEY (`id_varian`),
  ADD KEY `varian_ibfk_1` (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faktur_penjualan`
--
ALTER TABLE `faktur_penjualan`
  MODIFY `id_faktur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `laporan_keuangan`
--
ALTER TABLE `laporan_keuangan`
  MODIFY `id_keuangan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id_pemasukan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `varian`
--
ALTER TABLE `varian`
  MODIFY `id_varian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`id_varian`) REFERENCES `varian` (`id_varian`),
  ADD CONSTRAINT `penjualan_ibfk_3` FOREIGN KEY (`id_faktur`) REFERENCES `faktur_penjualan` (`id_faktur`);

--
-- Constraints for table `varian`
--
ALTER TABLE `varian`
  ADD CONSTRAINT `varian_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
