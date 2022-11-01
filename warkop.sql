-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Agu 2020 pada 17.32
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warkop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `kd_bhn` varchar(100) NOT NULL,
  `nm_bhn` varchar(50) NOT NULL,
  `kategori_bhn` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bahan_baku`
--

INSERT INTO `bahan_baku` (`kd_bhn`, `nm_bhn`, `kategori_bhn`, `jumlah`) VALUES
('B01', 'Garam', 'Bumbu Dapur', 4),
('B02', 'Bawang merah', 'Sayur', 4),
('B03', 'Bawang putih', 'Sayur', 4),
('B04', 'Gula', 'Bumbu', 4),
('B05', 'Susu', 'Minuman', 4),
('B06', 'Teh', 'Minuman', 4),
('B07', 'Mie', 'Makanan', 5),
('B08', 'Nasi Putih', 'Makanan', 10),
('B09', 'Tempe', 'Makanan', 20),
('B10', 'Telur', 'Makanan', 20),
('B11', 'Tepung', 'Bumbu Dapur', 20),
('B12', 'Tahu', 'Makanan', 20),
('B13', 'Nutrisari', 'Minuman', 20),
('B14', 'ExtraJoss', 'Minuman', 20),
('B15', 'Milo', 'Minuman', 20),
('B16', 'Gooday', 'Minuman', 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `makanan`
--

CREATE TABLE `makanan` (
  `kd_makanan` varchar(5) NOT NULL,
  `kd_bahan` varchar(100) NOT NULL,
  `nm_menu` varchar(50) NOT NULL,
  `harga_mkn` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `makanan`
--

INSERT INTO `makanan` (`kd_makanan`, `kd_bahan`, `nm_menu`, `harga_mkn`, `jumlah`) VALUES
('F01', 'B01', 'Mie Goreng', 5000, 20),
('F02', 'B08', 'Nasi Goreng', 7000, 20),
('F03', 'B07', 'Indomie Rebus', 7000, 20),
('F04', 'B08', 'Nasi Telur Dadar', 7000, 20),
('F05', 'B08', 'Nasi Omelete', 7000, 20),
('F06', 'B10', 'Nasi Orak Arik', 7000, 20),
('F07', 'B09', 'Tempe Goreng', 1000, 20),
('F08', 'B11', 'Bala-Bala', 1000, 20),
('F09', 'B12', 'Gehu', 1000, 20),
('F10', 'B11', 'Cireng', 1000, 21),
('F14', 'B01', 'Nasi Ayam Goreng', 9000, 20),
('F15', 'B02', 'Nasi Omelete', 7000, 10),
('F16', 'B08', 'Nasi Ayam Goreng', 9000, 20),
('F17', 'B08', 'Nasi Ayam Goreng', 9000, 20),
('F18', 'B15', 'Susu Coklat', 9000, 5),
('F19', 'B11', 'Nasi Omelete', 9000, 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `minuman`
--

CREATE TABLE `minuman` (
  `kd_minuman` varchar(5) NOT NULL,
  `kd_bahan` varchar(100) NOT NULL,
  `nm_menu` varchar(50) NOT NULL,
  `harga_min` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `minuman`
--

INSERT INTO `minuman` (`kd_minuman`, `kd_bahan`, `nm_menu`, `harga_min`, `jumlah`) VALUES
('D01', 'B05', 'Josu', 4000, 20),
('D02', 'B06', 'Teh Manis', 4000, 20),
('D03', 'B05', 'STMJ', 4000, 20),
('D04', 'B13', 'Nutrisari', 4000, 20),
('D05', 'B05', 'Kopi Hitam', 4000, 20),
('D06', 'B16', 'Moccacino', 4000, 20),
('D07', 'B05', 'Kopi Susu', 4000, 20),
('D08', 'B15', 'Milo', 4000, 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` varchar(5) NOT NULL,
  `nm_pegawai` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `level` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nm_pegawai`, `username`, `password`, `alamat`, `level`) VALUES
('P02', 'Uton', 'pelayan', 'pelayan', 'Jl. Pahwlawan', 'pelayan'),
('P03', 'Lutfi', 'kasir', 'kasir', 'Jl. Dipatiukur', 'kasir'),
('P04', 'Akbar', 'koki', 'koki', 'Jl. Tubagus Ismail Dalam No.19C', 'koki'),
('P05', 'Rizaldi', 'pantry', 'pantry', 'Jl. Cempaka Putih', 'pantry'),
('P06', 'Aldi Lesmana', 'Bonaventura', 'Bonaventura', 'Jl. Buniawangi', 'admin'),
('P07', 'Badrul', 'bambang', '12345678', 'Jl. Imam Bonjol', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `no_pmbyr` varchar(5) NOT NULL,
  `kd_pemesanan` varchar(5) NOT NULL,
  `total_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`no_pmbyr`, `kd_pemesanan`, `total_bayar`) VALUES
('C01', 'P01', 200000),
('C02', 'P02', 210000),
('C03', 'P03', 200000),
('C04', 'P04', 15000),
('C05', 'P05', 90000),
('C06', 'P06', 18000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `kd_pemesanan` varchar(5) NOT NULL,
  `nm_pemesan` varchar(50) NOT NULL,
  `kd_makanan` varchar(5) NOT NULL,
  `kd_minuman` varchar(5) NOT NULL,
  `jumlah_mkn` int(11) NOT NULL,
  `jumlah_min` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`kd_pemesanan`, `nm_pemesan`, `kd_makanan`, `kd_minuman`, `jumlah_mkn`, `jumlah_min`, `total_harga`) VALUES
('P01', 'Bonaventura', 'F10', 'D01', 2, 2, 10000),
('P02', 'Uton', 'F02', 'D02', 1, 1, 30000),
('P03', 'Bambang', 'F01', 'D01', 1, 1, 25000),
('P04', 'Lutfi', 'F03', 'D01', 2, 2, 20000),
('P05', 'Akbar', 'F01', 'D01', 2, 2, 90000),
('P06', 'Bonaventura', 'F02', 'D05', 2, 1, 18000),
('P07', 'Bonaventura', 'F01', 'D02', 4, 2, 28000),
('P08', 'Rizaldi', 'F01', 'D01', 3, 1, 19000),
('P09', 'Rizaldi', 'F01', 'D04', 1, 3, 17000),
('P10', 'Yoseva', 'F03', 'D03', 3, 2, 29000),
('P11', 'Bonaventura', 'F03', 'D05', 3, 1, 25000),
('P12', 'Rizaldi', 'F03', 'D01', 2, 2, 22000),
('P13', 'Yoseva', 'F01', 'D02', 2, 2, 18000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`kd_bhn`);

--
-- Indeks untuk tabel `makanan`
--
ALTER TABLE `makanan`
  ADD PRIMARY KEY (`kd_makanan`) USING BTREE,
  ADD KEY `makanan_ibfk_1` (`kd_bahan`);

--
-- Indeks untuk tabel `minuman`
--
ALTER TABLE `minuman`
  ADD PRIMARY KEY (`kd_minuman`) USING BTREE,
  ADD KEY `minuman_ibfk_1` (`kd_bahan`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`no_pmbyr`),
  ADD KEY `pembayaran_ibfk_1` (`kd_pemesanan`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`kd_pemesanan`) USING BTREE,
  ADD KEY `pemesanan_ibfk_2` (`kd_minuman`) USING BTREE,
  ADD KEY `pemesanan_ibfk_1` (`kd_makanan`) USING BTREE;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `makanan`
--
ALTER TABLE `makanan`
  ADD CONSTRAINT `makanan_ibfk_1` FOREIGN KEY (`kd_bahan`) REFERENCES `bahan_baku` (`kd_bhn`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `minuman`
--
ALTER TABLE `minuman`
  ADD CONSTRAINT `minuman_ibfk_1` FOREIGN KEY (`kd_bahan`) REFERENCES `warung`.`bahan_baku` (`kd_bhn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`kd_pemesanan`) REFERENCES `pemesanan` (`kd_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `kd_makanan` FOREIGN KEY (`kd_makanan`) REFERENCES `makanan` (`kd_makanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kd_minuman` FOREIGN KEY (`kd_minuman`) REFERENCES `minuman` (`kd_minuman`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
