-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2019 at 06:54 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_10_04_095237_create_ref_pelanggans_table', 1),
(2, '2019_10_04_195213_create_ref_barangs_table', 2),
(3, '2019_10_04_195340_create_ref_barangs_table', 3),
(4, '2019_10_04_200301_create_ref_barangs_table', 4),
(5, '2019_10_04_201322_create_ta_penjualans_table', 5),
(6, '2019_10_04_202217_create_ta_detail_penjualans_table', 6),
(7, '2019_10_05_171737_create_ta_penjualans_table', 7),
(8, '2019_10_05_195135_create_ta_pembelians_table', 8),
(9, '2019_10_05_210440_create_ta_pembelians_table', 9),
(10, '2019_10_05_210540_create_ta_detail_pembelians_table', 10),
(11, '2019_10_05_212209_create_ref_distributors_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `ref_barang`
--

CREATE TABLE `ref_barang` (
  `id` int(10) NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_id` tinyint(4) NOT NULL,
  `harga_beli` double NOT NULL,
  `stok` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ref_distributor`
--

CREATE TABLE `ref_distributor` (
  `id` tinyint(4) NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ref_kategori`
--

CREATE TABLE `ref_kategori` (
  `id` smallint(4) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_kategori`
--

INSERT INTO `ref_kategori` (`id`, `kategori`, `created_at`, `updated_at`) VALUES
(1, 'Case', '2019-10-04 11:39:07', '2019-06-30 04:23:26'),
(2, 'Handsfree', '2019-10-12 06:45:01', '2019-10-12 06:45:01');

-- --------------------------------------------------------

--
-- Table structure for table `ref_pelanggan`
--

CREATE TABLE `ref_pelanggan` (
  `id` tinyint(4) NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ta_detail_pembelian`
--

CREATE TABLE `ta_detail_pembelian` (
  `id` int(10) NOT NULL,
  `no_pembelian` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barang_id` int(10) NOT NULL,
  `qty` tinyint(4) NOT NULL,
  `harga` double NOT NULL,
  `sub_total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ta_detail_penjualan`
--

CREATE TABLE `ta_detail_penjualan` (
  `id` int(10) NOT NULL,
  `no_penjualan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barang_id` int(10) NOT NULL,
  `qty` tinyint(4) NOT NULL,
  `harga` double NOT NULL,
  `sub_total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ta_history_barang`
--

CREATE TABLE `ta_history_barang` (
  `id` int(11) NOT NULL,
  `barang_id` int(10) NOT NULL,
  `qty` smallint(6) NOT NULL,
  `stok` smallint(6) DEFAULT NULL,
  `tipe` varchar(10) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `no_transaksi` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `user_id` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ta_pembelian`
--

CREATE TABLE `ta_pembelian` (
  `no_pembelian` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distributor_id` tinyint(4) NOT NULL,
  `grand_total` double NOT NULL,
  `tanggal` date DEFAULT NULL,
  `user_id` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ta_penjualan`
--

CREATE TABLE `ta_penjualan` (
  `id` int(10) UNSIGNED NOT NULL,
  `no_penjualan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pelanggan_id` tinyint(4) NOT NULL,
  `grand_total` double NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `tgl_jatuh_tempo` date NOT NULL,
  `status_pembayaran` tinyint(1) NOT NULL,
  `user_id` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Arifin Aritonang', 'admin', 'admin@gmail.com', '$2y$10$szQi4q1/t1Q2OS8q6jxk6.8FNmbJT0qC4DUWNbp0Lubq2dlYi6RTO', '1CQOCJWh399nDXiWt9zx71mjgHe90JF9viK5hVnvKbHgahQS6eEAmj9BrgZB', '2019-10-16 14:49:11', '2019-10-16 14:49:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_barang`
--
ALTER TABLE `ref_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_distributor`
--
ALTER TABLE `ref_distributor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_kategori`
--
ALTER TABLE `ref_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_pelanggan`
--
ALTER TABLE `ref_pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ta_detail_pembelian`
--
ALTER TABLE `ta_detail_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ta_detail_penjualan`
--
ALTER TABLE `ta_detail_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ta_history_barang`
--
ALTER TABLE `ta_history_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ta_pembelian`
--
ALTER TABLE `ta_pembelian`
  ADD PRIMARY KEY (`no_pembelian`);

--
-- Indexes for table `ta_penjualan`
--
ALTER TABLE `ta_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ref_barang`
--
ALTER TABLE `ref_barang`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ref_distributor`
--
ALTER TABLE `ref_distributor`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ref_kategori`
--
ALTER TABLE `ref_kategori`
  MODIFY `id` smallint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ref_pelanggan`
--
ALTER TABLE `ref_pelanggan`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ta_detail_pembelian`
--
ALTER TABLE `ta_detail_pembelian`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ta_detail_penjualan`
--
ALTER TABLE `ta_detail_penjualan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ta_history_barang`
--
ALTER TABLE `ta_history_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ta_penjualan`
--
ALTER TABLE `ta_penjualan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
