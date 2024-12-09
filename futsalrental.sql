-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 09, 2024 at 03:51 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `futsalrental`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `pemesan_id` int(11) NOT NULL,
  `lapangan_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_awal` time NOT NULL,
  `jam_akhir` time NOT NULL,
  `total_harga` int(11) NOT NULL,
  `jenis_transaksi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `pemesan_id`, `lapangan_id`, `tanggal`, `jam_awal`, `jam_akhir`, `total_harga`, `jenis_transaksi`) VALUES
(1, 2, 1, '2024-12-04', '06:00:00', '08:00:00', 300000, 'online'),
(2, 2, 2, '2024-12-04', '06:00:00', '08:00:00', 400000, 'online'),
(3, 2, 2, '2024-12-05', '07:00:00', '09:00:00', 400000, 'online'),
(31, 4, 1, '2024-12-09', '08:00:00', '10:00:00', 300000, 'online'),
(32, 1, 1, '2024-12-10', '07:00:00', '09:00:00', 300000, 'offline'),
(33, 1, 1, '2024-12-09', '06:00:00', '08:00:00', 300000, 'offline'),
(34, 5, 2, '2024-12-09', '06:00:00', '08:00:00', 400000, 'online'),
(35, 6, 2, '2024-12-09', '08:00:00', '11:00:00', 600000, 'online'),
(36, 1, 2, '2024-12-09', '11:00:00', '13:00:00', 400000, 'offline');

-- --------------------------------------------------------

--
-- Table structure for table `lapangan`
--

CREATE TABLE `lapangan` (
  `id` int(11) NOT NULL,
  `nama_lapangan` varchar(100) NOT NULL,
  `jenis_lapangan` varchar(50) NOT NULL,
  `harga_per_jam` decimal(10,2) NOT NULL,
  `status` enum('Tersedia','Tidak Tersedia') DEFAULT 'Tersedia',
  `lokasi` varchar(200) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `deskripsi` text,
  `kapasitas` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lapangan`
--

INSERT INTO `lapangan` (`id`, `nama_lapangan`, `jenis_lapangan`, `harga_per_jam`, `status`, `lokasi`, `foto`, `deskripsi`, `kapasitas`, `created_at`, `updated_at`) VALUES
(1, 'Lapangan Futsal A', 'Futsal', '150000.00', 'Tersedia', 'Jalan Sudirman', 'futsal.jpg', 'Lapangan futsal indoor berkualitas tinggi.', 10, '2024-12-03 02:24:35', '2024-12-03 05:24:49'),
(2, 'Lapangan Basket B', 'Basket', '200000.00', 'Tersedia', 'Jalan Thamrin', 'basket.jpg', 'Lapangan basket outdoor dengan fasilitas modern.', 10, '2024-12-03 02:24:35', '2024-12-03 05:24:59');

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`id`, `nama_lengkap`, `username`, `password`, `email`, `level`) VALUES
(1, 'I Nyoman Pastika', 'passtika', '$2y$10$ywR.IRHxnZEuVjMxJV6BMer2wMwy5tARDC/aTvlhBooTjbSGVk2i2', 'passtika2625@gmail.com', 'admin'),
(2, 'Asvin Andika Putra', 'asvinandika', '$2y$10$dHU4NFEO9FGTPv17OvUPKumNW4Rqb6kIPvsWuPN7L2Gmn/YcAGSkK', 'asvinandikaputra@gmail.com', 'user'),
(3, 'Budi Carlos', 'budicarr', '$2y$10$u7cScawALsr/qYD/Gz.Bfu/ZKjmFGSXo8feIveNFV1Lo1bsiZfRJq', 'budicarlos@gmial.com', 'user'),
(4, 'Perdia Santika', 'perdia', '$2y$10$qAXBQZD.GZ5L4cbcscgotenZKVcmRAyb3k4FTO9Fkzt0WFwlhVVz.', 'perdia@gmail.com', 'user'),
(5, 'Wahyu', 'wahyuu', '$2y$10$znz36Q6nyJj85gNFGEl2OOk2KtVY2tR1Knu4gMEoDuc1Tmo0TxzpK', 'wahyu2323@gmail.com', 'user'),
(6, 'mahardika putra', 'mahardika', '$2y$10$tTIN48WwHLr7G/hLGSY5we.oe1nEe5LZWSakRj6OXh6Zglbkle1IS', 'mahardika222@gmail.com', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemesan_id` (`pemesan_id`),
  ADD KEY `lapangan_id` (`lapangan_id`);

--
-- Indexes for table `lapangan`
--
ALTER TABLE `lapangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `lapangan`
--
ALTER TABLE `lapangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`pemesan_id`) REFERENCES `tb_login` (`id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`lapangan_id`) REFERENCES `lapangan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
