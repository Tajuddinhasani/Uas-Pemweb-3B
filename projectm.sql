-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Des 2023 pada 08.24
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_product`
--

CREATE TABLE `data_product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_type` enum('Auto','Manual') NOT NULL,
  `thumbnail` varchar(100) NOT NULL,
  `product_status` enum('Active','Inactive') NOT NULL,
  `product_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_product`
--

INSERT INTO `data_product` (`id`, `product_name`, `product_code`, `product_type`, `thumbnail`, `product_status`, `product_description`) VALUES
(43, 'Free Fire', 'FF', 'Auto', 'ff.png', 'Active', 'FF');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `data_id` varchar(128) NOT NULL,
  `zone_id` varchar(128) NOT NULL,
  `nominal` enum('86 Diamonds','172 Diamonds','257 Diamonds','344 Diamonds','429 Diamonds') NOT NULL,
  `payment_method` enum('Bank BCA','QRIS','VA Mandiri','VA BNI','Alfamart') NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp_column` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `data_id`, `zone_id`, `nominal`, `payment_method`, `phone_number`, `user_id`, `timestamp_column`) VALUES
(2, '5555555', '5555', '86 Diamonds', 'VA BNI', '23424242', 1, '2023-12-17 04:51:45'),
(3, '777777', '777', '257 Diamonds', 'Bank BCA', '43535', 2, '2023-12-17 04:51:45'),
(4, '0000000000', '00000', '429 Diamonds', 'VA BNI', '0774555555', 2, '2023-12-17 04:51:45'),
(5, '53653464', '56456', '172 Diamonds', 'Bank BCA', '67467567', 1, '2023-12-17 05:25:51'),
(6, '555555555', '54545', '86 Diamonds', 'QRIS', '76567567', 2, '2023-12-17 13:26:55'),
(7, '555555555', '54545', '86 Diamonds', 'QRIS', '76567567', 2, '2023-12-17 13:31:10'),
(8, '000000000', '00000', '172 Diamonds', 'QRIS', '000000000', 2, '2023-12-17 13:33:25'),
(9, '11111111111', '11111', '429 Diamonds', 'QRIS', '11111111111', 2, '2023-12-17 13:34:32'),
(10, '87654321', '1234', '429 Diamonds', 'Bank BCA', '0857778876', 2, '2023-12-18 03:09:10'),
(11, '2222222222', '222', '172 Diamonds', 'Alfamart', '343434', 2, '2023-12-18 03:16:38'),
(12, '76668686', '6677', '86 Diamonds', 'QRIS', '898', 1, '2023-12-24 04:52:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `phone`) VALUES
(1, 'admin', '$2y$10$asLoeSCWNAbTzsqB88hyluNUu.ge9QWZ4OfJATK2rlMBz9EdGI0t2', '099776856'),
(2, 'denif', '$2y$10$ACmWtdmIx.SwvssTXWJI8.EavqORsVqLGoFeexjKgqu.7OdTYhLI6', '098677867676');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_product`
--
ALTER TABLE `data_product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_product`
--
ALTER TABLE `data_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
