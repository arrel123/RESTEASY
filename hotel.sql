-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2024 at 04:26 PM
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
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id` varchar(11) NOT NULL,
  `tipe` varchar(100) NOT NULL,
  `kasur` varchar(100) NOT NULL,
  `fasilitas` text NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `rekomendasi` tinyint(1) DEFAULT 0,
  `tersedia` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id`, `tipe`, `kasur`, `fasilitas`, `harga`, `gambar`, `rekomendasi`, `tersedia`) VALUES
('DX001', 'Deluxe', 'Single', 'TV, AC, Wi-Fi, Toilet, Sarapan', 1000000.00, 'download.jpg', 1, 1),
('ST001', 'Standard', 'Single', 'AC, WC, Wi-Fi, Televisi', 500000.00, 'download.jpg', 1, 1),
('ST002', 'Standard', 'Single', 'AC, Wi-Fi, Televisi, Kamar mandi', 550000.00, 'download.jpg', 0, 0),
('SU001', 'Suite', 'Twin', 'Ya', 1600000.00, 'download.jpg', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  `adults` int(11) DEFAULT NULL,
  `children` int(11) DEFAULT NULL,
  `room_id` varchar(255) DEFAULT NULL,
  `request` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `invoice` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `total` bigint(20) NOT NULL,
  `status` enum('Pending','Selesai','Batal') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nomor` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('pelanggan','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `nama`, `alamat`, `nomor`, `password`, `role`) VALUES
('ahmad181@gmail.com', '', '', '089674577035', '$2y$10$SR5vIIehvbvueUoON0UJDutiHoRTW0r3UB8qY7MA1qE96ThibAIVa', 'pelanggan'),
('rafiakhbar17@gmail.com', 'Rafi Akhbar Dirgahayuri', 'Baloi Blok III', '08987654321', '$2y$10$6TdZjTvok5G3xFnvMCFMuOzpKDPvXsSbule2vnP4v5Hciz9SXs9xq', 'pelanggan'),
('resteasyltd@gmail.com', 'Rafi Akhbar Dirgahayuri', 'Baloi Blok 2', '081212121212', '$2y$10$PViAio/U8eYmxvxARV38T.CimTDSS0KY/rmNKMkl0r4IYM35XH1M.', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`invoice`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `kamar` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
