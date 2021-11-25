-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2021 at 05:12 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `modernmeds`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `username` varchar(64) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `total_pcs` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `username`, `id_produk`, `total_pcs`) VALUES
(43, 'yunusmail', 1, 1),
(44, 'yunusmail', 5, 1),
(58, 'emilliaef', 7, 1),
(64, 'yahyamahen', 3, 1),
(65, 'yahyamahen', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `username` varchar(64) NOT NULL,
  `PASSWORD` varchar(512) DEFAULT NULL,
  `nama_lengkap` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `gender` varchar(16) DEFAULT NULL,
  `alamat` varchar(128) DEFAULT NULL,
  `kota` varchar(64) DEFAULT NULL,
  `no_telp` varchar(16) DEFAULT NULL,
  `paypal_id` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`username`, `PASSWORD`, `nama_lengkap`, `email`, `tgl_lahir`, `gender`, `alamat`, `kota`, `no_telp`, `paypal_id`) VALUES
('emilliaef', '$2y$10$WHCjlOcNlDUZNJEXFjlWnu1yU1IMY574WjflZgbuZCgjRnSMfkQ.G', 'Emillia Eka Firnanda', 'emilliaekaf@gmail.com', '0000-00-00', 'Perempuan', 'Jl. Randuagung No. 69, Kel. Sidotopo Wetan, Kec. Kenjeran, Kota Surabaya, Jawa Timur 60211', 'Surabaya', '081554343524', '5424511175'),
('pyxsor', '$2y$10$llhC4SAr7ZzEn7XBh7UqM./7xx.hrItjxxqsfVu9VNrW3BfMatH4.', 'Handie Pramana Putra', 'hanzdeveloper@gmail.com', '0000-00-00', 'Laki-laki', 'Jl. Simorejo sawah XII, Kel. Sawahan, Kec. Sukomanunggan, Kota Surabaya, Jawa Timur', 'Surabaya', '081332049634', '5120201189'),
('yahyamahen', '$2y$10$G4s1KOpQ0jddxzcrpvdfV.0VvUgH/8I0ow7eaoX86e1vKmwFifYXu', 'Rizqi Yahya Mahendra', 'kiky.mahendra21@gmail.com', '0000-00-00', 'Laki-laki', 'Jl. Lakarsantri 1 No. 3 RT001 RW001, Kel. Lakarsantri, Kec. Lakarsantri, Kota Surabaya, Jawa Timur 60211, Indonesia', 'Surabaya', '085649572121', '54161144512'),
('yunusmail', '$2y$10$PgyIFGmMS8YgtY7znwrmmuurYwXcoI/uWAHcb9kFLF3qXpskNJbGW', 'Yunus Oktavianto Ismail', 'yunusismail99@gmail.com', '0000-00-00', 'Laki-laki', 'Jl. Jambangan No. 5, Kel. Jambangan, Kec. Jambangan, Kota Surabaya, Jawa Timur', 'Surabaya', '085850660031', '5125115029');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `kode_pemesanan` varchar(32) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `username` varchar(64) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `total_pcs` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `metode_pembayaran` varchar(16) DEFAULT NULL,
  `nota_pemesanan` varchar(512) DEFAULT NULL,
  `waktu_pemesanan` timestamp NULL DEFAULT NULL,
  `status_pemesanan` varchar(32) DEFAULT NULL,
  `catatan_pemesanan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `kode_pemesanan`, `id_user`, `username`, `id_produk`, `total_pcs`, `total`, `metode_pembayaran`, `nota_pemesanan`, `waktu_pemesanan`, `status_pemesanan`, `catatan_pemesanan`) VALUES
(1, 'PG8539', NULL, 'emilliaef', 1, 2, 40395, 'debit', 'emilliaef_PG8539.pdf', '2021-10-27 05:47:31', 'Pesanan Selesai', 'asd123'),
(2, 'PG4775', NULL, 'emilliaef', 1, 2, 70000, 'Cash', 'emilliaef_PG4775.pdf', '2021-10-27 05:47:54', 'Pesanan Selesai', 'asd123'),
(3, 'PG4775', NULL, 'emilliaef', 2, 3, 70000, 'Cash', 'emilliaef_PG4775.pdf', '2021-10-27 05:47:54', 'Pesanan Selesai', 'asd123'),
(4, 'PG7138', NULL, 'yahyamahen', 1, 1, 40299, 'debit', 'yahyamahen_PG7138.pdf', '2021-10-27 05:48:43', 'Pesanan Selesai', 'awd123'),
(5, 'PG7138', NULL, 'yahyamahen', 2, 2, 40299, 'debit', 'yahyamahen_PG7138.pdf', '2021-10-27 05:48:43', 'Pesanan Selesai', 'awd123'),
(6, 'PG1987', NULL, 'yahyamahen', 2, 2, 20000, 'Cash', 'yahyamahen_PG1987.pdf', '2021-10-27 05:49:11', 'Pesanan Selesai', 'asd123'),
(11, 'PG8050', NULL, 'yahyamahen', 2, 1, 30394, 'debit', 'yahyamahen_PG8050.pdf', '2021-10-28 14:21:45', 'Pesanan Selesai', 'Mau transaksi debit'),
(12, 'PG8050', NULL, 'yahyamahen', 1, 1, 30394, 'debit', 'yahyamahen_PG8050.pdf', '2021-10-28 14:21:45', 'Pesanan Selesai', 'Mau transaksi debit'),
(13, 'PG3905', NULL, 'emilliaef', 2, 3, 30000, 'cash', 'emilliaef_PG3905.pdf', '2021-10-28 14:35:15', 'Pesanan Selesai', 'Ketoko sekitar pukul 21.35'),
(14, 'PG4123', NULL, 'emilliaef', 2, 2, 20408, 'debit', 'emilliaef_PG4123.pdf', '2021-10-28 14:35:58', 'Pesanan Selesai', ''),
(15, 'PG481', NULL, 'emilliaef', 2, 2, 20342, 'debit', 'emilliaef_PG481.pdf', '2021-10-28 14:54:16', 'Pesanan Selesai', 'Melewati Paypal'),
(16, 'PG8210', NULL, 'pyxsor', 2, 1, 10277, 'debit', 'pyxsor_PG8210.pdf', '2021-10-28 15:21:35', 'Pesanan Selesai', 'gas los ndang tuku, puyeng'),
(17, 'PG2677', NULL, 'yunusmail', 1, 1, 100000, 'cash', 'yunusmail_PG2677.pdf', '2021-10-28 18:32:26', 'Pesanan Selesai', 'Yok yok miber yok'),
(18, 'PG2677', NULL, 'yunusmail', 3, 1, 100000, 'cash', 'yunusmail_PG2677.pdf', '2021-10-28 18:32:26', 'Pesanan Selesai', 'Yok yok miber yok'),
(19, 'PG2677', NULL, 'yunusmail', 6, 20, 100000, 'cash', 'yunusmail_PG2677.pdf', '2021-10-28 18:32:26', 'Pesanan Selesai', 'Yok yok miber yok'),
(20, 'PG1252', NULL, 'pyxsor', 1, 1, 205020, 'debit', 'pyxsor_PG1252.pdf', '2021-10-28 18:35:40', 'Pesanan Selesai', ''),
(21, 'PG1252', NULL, 'pyxsor', 3, 2, 205020, 'debit', 'pyxsor_PG1252.pdf', '2021-10-28 18:35:40', 'Pesanan Selesai', ''),
(22, 'PG1252', NULL, 'pyxsor', 4, 3, 205020, 'debit', 'pyxsor_PG1252.pdf', '2021-10-28 18:35:40', 'Pesanan Selesai', ''),
(23, 'PG1649', NULL, 'yahyamahen', 8, 4, 236058, 'debit', 'yahyamahen_PG1649.pdf', '2021-10-28 18:42:10', 'Pesanan Selesai', 'Yok yok ngobat'),
(24, 'PG1649', NULL, 'yahyamahen', 5, 2, 236058, 'debit', 'yahyamahen_PG1649.pdf', '2021-10-28 18:42:10', 'Pesanan Selesai', 'Yok yok ngobat'),
(25, 'PG1649', NULL, 'yahyamahen', 7, 3, 236058, 'debit', 'yahyamahen_PG1649.pdf', '2021-10-28 18:42:10', 'Pesanan Selesai', 'Yok yok ngobat'),
(27, 'PG5439', NULL, 'yahyamahen', 8, 2, 116247, 'debit', 'yahyamahen_PG5439.pdf', '2021-11-24 13:34:24', 'Pesanan Selesai', 'Kirim cepat'),
(28, 'PG5439', NULL, 'yahyamahen', 5, 2, 116247, 'debit', 'yahyamahen_PG5439.pdf', '2021-11-24 13:34:24', 'Pesanan Selesai', 'Kirim cepat'),
(30, 'PG7170', NULL, 'yahyamahen', 4, 1, 147000, 'cash', 'yahyamahen_PG7170.pdf', '2021-11-25 02:59:31', 'Pesanan Selesai', 'Kirim Cepat Gan'),
(31, 'PG7170', NULL, 'yahyamahen', 7, 1, 147000, 'cash', 'yahyamahen_PG7170.pdf', '2021-11-25 02:59:31', 'Pesanan Selesai', 'Kirim Cepat Gan'),
(32, 'PG7170', NULL, 'yahyamahen', 8, 1, 147000, 'cash', 'yahyamahen_PG7170.pdf', '2021-11-25 02:59:31', 'Pesanan Selesai', 'Kirim Cepat Gan'),
(34, 'PG7170', NULL, 'yahyamahen', 6, 2, 147000, 'cash', 'yahyamahen_PG7170.pdf', '2021-11-25 02:59:31', 'Pesanan Selesai', 'Kirim Cepat Gan');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(128) DEFAULT NULL,
  `kategori` varchar(64) DEFAULT NULL,
  `deskripsi_produk` varchar(1024) DEFAULT NULL,
  `harga_produk` int(11) DEFAULT NULL,
  `stok_produk` int(11) DEFAULT NULL,
  `gambar` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `kategori`, `deskripsi_produk`, `harga_produk`, `stok_produk`, `gambar`) VALUES
(1, 'OBH Combi', 'Obat Cair', 'Obat batuk berdahak untuk dewasa', 20000, 1, '1_OBH Combi_6178a8a7bec5e.jpg'),
(2, 'Panadol MX', 'Tablet', 'Obat sakit kepala ringan', 10000, 4, '2_Panadol MX_6178a8b9e7a30.jpeg'),
(3, 'Mylanta Maag', 'Obat Cair', 'Obat cair mylanta, takaran minuman 2x1 sehari', 40000, 1, '_Mylanta Maag_617ad2b0e7ad2.jpg'),
(4, 'Combantrin', 'Obat Cair', 'Obat cacing untuk semua umur', 35000, 1, '_Combantrin_617ad2eb67bee.jpg'),
(5, 'Bodrex Extra', 'Tablet', 'Obat sakit kepala tablet, anjuran minuiman 2x1 hari', 4000, 11, 'Bodrex Extra_617ad37c4960c.jpg'),
(6, 'CTM', 'Tablet', 'Obat gatal, membuat efek ngantuk! hatihati', 2000, 18, 'CTM_617ad3b9ec331.jpg'),
(7, 'Mixagrip Flu', 'Tablet', 'Mixagrip Flu untuk meredakan flu, pilek dan bersin', 4000, 26, 'Mixagrip Flu_617ad4086d5d6.jpg'),
(8, 'Paramex', 'Tablet', 'Obat sakit kepala tablet, anjuran minuiman 2x1 hari', 4000, 23, 'Paramex_617ad98b2dc6f.jpg'),
(21, 'Enervon C-30', 'Pil', 'Vitamin untuk menguatkan metabolisme tubuh', 5000, 21, '123_619faefce0eaf.jpg'),
(22, 'Paracetamol', 'Tablet', 'Obat anti nyeri, meredakan demam', 6000, 5, 'Paracetamol_619fafa009f15.jpg'),
(23, 'Combantrin', 'Tablet', 'Obat Cacing Dewasa Tablet', 16000, 10, 'Combantrin_619fb2ae5fd18.jpeg'),
(24, 'Amoxilin', 'Tablet', 'Obat anti nyeri, untuk gigi', 5000, 40, 'Amoxilin_619fb552bda0a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(64) DEFAULT NULL,
  `PASSWORD` varchar(512) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `PASSWORD`, `email`) VALUES
(1, 'admin', '$2y$10$HBCqmo/yHBS3q01tEtemDuANHmc2BiXwxauqNmyJuZSspcjAbzlp.', 'admin@admin'),
(2, 'admin2', '$2y$10$Yj4kizgZuwT5tNfmZIaqTOTVs0e07nVyaKZYWUSq0RlOzwGE8e73a', 'admin2@admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `username` (`username`),
  ADD KEY `id_produk` (`id_produk`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`username`) REFERENCES `customers` (`username`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`username`) REFERENCES `customers` (`username`),
  ADD CONSTRAINT `pemesanan_ibfk_3` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
