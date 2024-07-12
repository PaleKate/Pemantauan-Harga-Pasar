-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jul 2024 pada 19.40
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saharga`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `administrator`
--

CREATE TABLE `administrator` (
  `id` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `wa` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `administrator`
--

INSERT INTO `administrator` (`id`, `username`, `email`, `password`, `wa`, `level`) VALUES
('245ba5e67c9fb4fadc303427eef9fa785b3224a4', 'Pasar Manonjaya', 'pasarmanonjaya@gmail.com', '$2y$10$yyQsylG.QHvP0Y3gkvxOX.YmC32GnFx9ZhOSD9ThZcDCByeyeOC9W', '085659506260', 'Manonjaya'),
('2ae76949b8a6126beb83601c1156e8edf1f5a308', 'Pasar Taraju', 'pasartaraju@gmail.com', '$2y$10$R3fFxmbJJ8pkqKkn4PDhiOxnB8BCxC99A0.llRp9bZhZsCTOmlzW6', '085161584626', 'Taraju'),
('42fdd66d9a7ba8e267e844c9578c69883fd3a221', 'Pasar Ciawi', 'pasarciawi@gmail.com', '$2y$10$6odNP1t.Z6JJHb6tJIHeS.ggIx9okSIh5AcrBkyqgwQ5NUdDHUd4S', '085161584626', 'Ciawi'),
('42fdd66d9a7ba8e267e844c9578c69883fd3a22c', 'Pasar Singaparna', 'pasarsingaparna@gmail.com', '$2y$10$jHMUWTgfQQWFfNOkmgwRw.ogUnPKhOS12Mu2AOBTwPBWZmo82Znze', '085659506260', 'Singaparna'),
('bc07ae8761655d1ae47c32f929082719525c5ce3', 'PSDA', 'psda@gmail.com', '$2y$10$HYB.SxSu2bfy/.oLKDjwue92/9NDxCx345XwFcUIIE6vRdP37zU6K', '085659506260', 'Bidek'),
('d15010cce274850bca0bf6c03d4a9bb022b55c45', 'Pasar Cikatomas', 'pasarcikatomas@gmail.com', '$2y$10$mxY/0FeiHaKKzekH3GEATek.c2TkL21JltF9FqV7wlcBjZb/jH9l2', '085659506260', 'Cikatomas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `harga`
--

CREATE TABLE `harga` (
  `id_bahan` varchar(255) NOT NULL,
  `tgl` date NOT NULL,
  `pasar` varchar(255) NOT NULL,
  `beras_p` varchar(255) NOT NULL,
  `beras_m` varchar(255) NOT NULL,
  `gula` varchar(255) NOT NULL,
  `bimoli` varchar(255) NOT NULL,
  `minyak_c` varchar(255) NOT NULL,
  `minyak_k` varchar(255) NOT NULL,
  `sapi` varchar(255) NOT NULL,
  `ayam_b` varchar(255) NOT NULL,
  `ayam_k` varchar(255) NOT NULL,
  `telur` varchar(255) NOT NULL,
  `susu_b` varchar(255) NOT NULL,
  `susu_i` varchar(255) NOT NULL,
  `susu_d` varchar(255) NOT NULL,
  `jagung_p` varchar(255) NOT NULL,
  `jagung_t` varchar(255) NOT NULL,
  `garam` varchar(255) NOT NULL,
  `tepung` varchar(255) NOT NULL,
  `kacang_k` varchar(255) NOT NULL,
  `kacang_h` varchar(255) NOT NULL,
  `kacang_t` varchar(255) NOT NULL,
  `blueband` varchar(255) NOT NULL,
  `mie` varchar(255) NOT NULL,
  `cabe_mb` varchar(255) NOT NULL,
  `cabe_hb` varchar(255) NOT NULL,
  `cabe_rh` varchar(255) NOT NULL,
  `cabe_rm` varchar(255) NOT NULL,
  `wortel` varchar(255) NOT NULL,
  `kol` varchar(255) NOT NULL,
  `buncis` varchar(255) NOT NULL,
  `bawang_m` varchar(255) NOT NULL,
  `bawang_p` varchar(255) NOT NULL,
  `ikan_asin` varchar(255) NOT NULL,
  `kentang` varchar(255) NOT NULL,
  `gula_merah` varchar(255) NOT NULL,
  `kelapa` varchar(255) NOT NULL,
  `gas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `harga`
--

INSERT INTO `harga` (`id_bahan`, `tgl`, `pasar`, `beras_p`, `beras_m`, `gula`, `bimoli`, `minyak_c`, `minyak_k`, `sapi`, `ayam_b`, `ayam_k`, `telur`, `susu_b`, `susu_i`, `susu_d`, `jagung_p`, `jagung_t`, `garam`, `tepung`, `kacang_k`, `kacang_h`, `kacang_t`, `blueband`, `mie`, `cabe_mb`, `cabe_hb`, `cabe_rh`, `cabe_rm`, `wortel`, `kol`, `buncis`, `bawang_m`, `bawang_p`, `ikan_asin`, `kentang`, `gula_merah`, `kelapa`, `gas`) VALUES
('429ac549fcc17fc87711cf6a62d063d1a16d7240', '2023-08-29', 'Ciawi', '12500', '11500', '15000', '20000', '15000', '14000', '130000', '38000', '60000', '32000', '13000', '12000', '23000', '10000', '5000', '3000', '11000', '15000', '24000', '28000', '7000', '2850', '70000', '30000', '35000', '40000', '10000', '6000', '12000', '40000', '30000', '45000', '15000', '20000', '6000', '16000'),
('429ac549fcc17fc87711cf6a62d063d1a16d724d', '2023-08-28', 'Ciawi', '12500', '11500', '15000', '20000', '15000', '14000', '130000', '38000', '60000', '32000', '13000', '12000', '23000', '10000', '5000', '3000', '11000', '15000', '24000', '28000', '7000', '2850', '70000', '30000', '35000', '40000', '10000', '6000', '12000', '40000', '30000', '45000', '15000', '20000', '6000', '16000'),
('588b775ed25a1b9b21f3d0119fdcb29ddbfd1c34', '2023-08-29', 'Cikatomas', '12000', '10500', '14000', '22500', '15500', '15000', '120000', '38000', '62000', '31000', '10000', '9500', '23000', '10000', '5100', '3000', '10000', '12000', '28000', '36000', '17000', '2850', '80000', '22000', '22000', '45000', '14000', '7000', '12000', '30000', '30000', '40000', '18000', '22000', '4000', '27000'),
('588b775ed25a1b9b21f3d0119fdcb29ddbfd1c3d', '2023-08-28', 'Cikatomas', '12000', '10500', '14000', '22500', '15500', '15000', '120000', '38000', '62000', '31000', '10000', '9500', '23000', '10000', '5100', '3000', '10000', '12000', '28000', '36000', '17000', '2850', '80000', '22000', '22000', '45000', '14000', '7000', '12000', '30000', '30000', '40000', '18000', '22000', '4000', '27000'),
('5b34d01b311932269475a6f58b53213e00f5ac22', '2023-08-28', 'Manonjaya', '12500', '11000', '14500', '22000', '15000', '18000', '135000', '36000', '70000', '33000', '13000', '12500', '23000', '12000', '5100', '2500', '11500', '16000', '28000', '32000', '11000', '2850', '90000', '30000', '40000', '60000', '14000', '7000', '12000', '34000', '36000', '17000', '16000', '25000', '5000', '20000'),
('5b34d01b311932269475a6f58b53213e00f5ac2c', '2023-08-29', 'Manonjaya', '12500', '11000', '14500', '22000', '15000', '18000', '135000', '36000', '70000', '33000', '13000', '12500', '23000', '12000', '5100', '2500', '11500', '16000', '28000', '32000', '11000', '2850', '90000', '30000', '40000', '60000', '14000', '7000', '12000', '34000', '36000', '17000', '16000', '25000', '5000', '20000'),
('5f6adba8492d44bb6c66126d4ea27498f0414ef5', '2023-08-29', 'Taraju', '13000', '12500', '18000', '22500', '16000', '18500', '135000', '36000', '50000', '31000', '12500', '12000', '23000', '10000', '5000', '2500', '11000', '30000', '20000', '25000', '18000', '2850', '90000', '30000', '40000', '60000', '14000', '7000', '12000', '34000', '36000', '17000', '16000', '25000', '5000', '20000'),
('5f6adba8492d44bb6c66126d4ea27498f0414efk', '2023-08-28', 'Taraju', '13000', '12500', '18000', '22500', '16000', '18500', '135000', '36000', '50000', '31000', '12500', '12000', '23000', '10000', '5000', '2500', '11000', '30000', '20000', '25000', '18000', '2850', '90000', '30000', '40000', '60000', '14000', '7000', '12000', '34000', '36000', '17000', '16000', '25000', '5000', '20000'),
('73b6cef291749052e11f2ce32a915e25b764693e', '2023-08-05', 'Singaparna', '12400', '11300', '14800', '21200', '15100', '16000', '141000', '34200', '60000', '28000', '12100', '11200', '25400', '10400', '5640', '2600', '10900', '16600', '25000', '28800', '20200', '23880', '60000', '33000', '37000', '56000', '12000', '6600', '10200', '31800', '30800', '49600', '17200', '22200', '4500', '21400'),
('73b6cef291749052e11f2ce32a915e25b7646asdd', '2023-08-06', 'Singaparna', '12500', '11300', '14800', '21200', '15100', '16000', '141000', '34200', '60000', '28000', '12100', '11200', '25400', '10400', '5640', '2600', '10900', '16600', '25000', '28800', '20200', '23880', '60000', '33000', '37000', '56000', '12000', '6600', '10200', '31800', '30800', '49600', '17200', '22200', '4500', '21400'),
('73b6cef291749052e11f2ce32a915e25b7646dea', '2023-08-28', 'Singaparna', '12400', '11300', '14800', '21200', '15100', '16000', '141000', '34200', '60000', '28000', '12100', '11200', '25400', '10400', '5640', '2600', '10900', '16600', '25000', '28800', '20200', '23880', '60000', '33000', '37000', '56000', '12000', '6600', '10200', '31800', '30800', '49600', '17200', '22200', '4500', '21400'),
('8d58c803bdaefd24a90e1950b397a145ba9b9610', '2023-08-05', 'Taraju', '12600', '11500', '15000', '20000', '15000', '14000', '130000', '38000', '60000', '32000', '13000', '12000', '23000', '10000', '5000', '3000', '11000', '15000', '24000', '28000', '7000', '2850', '70000', '30000', '35001', '40001', '10001', '6001', '12001', '40001', '30001', '45001', '15001', '20001', '6001', '16001'),
('8d58c803bdaefd24a90e1950b397a145ba9b9611', '2023-08-05', 'Manonjaya', '12700', '11500', '15000', '20000', '15000', '14000', '130000', '38000', '60000', '32000', '13000', '12000', '23000', '10000', '5000', '3000', '11000', '15000', '24000', '28000', '7000', '2850', '70000', '30000', '35001', '40001', '10001', '6001', '12001', '40001', '30001', '45001', '15001', '20001', '6001', '16001'),
('8d58c803bdaefd24a90e1950b397a145ba9b9612', '2023-08-05', 'Cikatomas', '12800', '11500', '15000', '20000', '15000', '14000', '130000', '38000', '60000', '32000', '13000', '12000', '23000', '10000', '5000', '3000', '11000', '15000', '24000', '28000', '7000', '2850', '70000', '30000', '35001', '40001', '10001', '6001', '12001', '40001', '30001', '45001', '15001', '20001', '6001', '16001'),
('8d58c803bdaefd24a90e1950b397a145ba9b96c9', '2023-08-05', 'Ciawi', '12500', '11500', '15000', '20000', '15000', '14000', '130000', '38000', '60000', '32000', '13000', '12000', '23000', '10000', '5000', '3000', '11000', '15000', '24000', '28000', '7000', '2850', '70000', '30000', '35001', '40001', '10001', '6001', '12001', '40001', '30001', '45001', '15001', '20001', '6001', '16001'),
('8d58c803bdaefd24a90e1950b397a145ba9b96sdq', '2023-08-06', 'Ciawi', '12500', '11500', '15000', '20000', '15000', '14000', '130000', '38000', '60000', '32000', '13000', '12000', '23000', '10000', '5000', '3000', '11000', '15000', '24000', '28000', '7000', '2850', '70000', '30000', '35001', '40001', '10001', '6001', '12001', '40001', '30001', '45001', '15001', '20001', '6001', '16001'),
('8d58c803bdaefd24a90e1950b397a145ba9bdswq', '2023-08-06', 'Taraju', '12600', '11500', '15000', '20000', '15000', '14000', '130000', '38000', '60000', '32000', '13000', '12000', '23000', '10000', '5000', '3000', '11000', '15000', '24000', '28000', '7000', '2850', '70000', '30000', '35001', '40001', '10001', '6001', '12001', '40001', '30001', '45001', '15001', '20001', '6001', '16001'),
('8d58c803bdaefd24a90e1950b397a145ba9bjduo', '2023-08-06', 'Cikatomas', '12800', '11500', '15000', '20000', '15000', '14000', '130000', '38000', '60000', '32000', '13000', '12000', '23000', '10000', '5000', '3000', '11000', '15000', '24000', '28000', '7000', '2850', '70000', '30000', '35001', '40001', '10001', '6001', '12001', '40001', '30001', '45001', '15001', '20001', '6001', '16001'),
('8d58c803bdaefd24a90e1950b397a145ba9bkdjl', '2023-08-06', 'Manonjaya', '12700', '11500', '15000', '20000', '15000', '14000', '130000', '38000', '60000', '32000', '13000', '12000', '23000', '10000', '5000', '3000', '11000', '15000', '24000', '28000', '7000', '2850', '70000', '30000', '35001', '40001', '10001', '6001', '12001', '40001', '30001', '45001', '15001', '20001', '6001', '16001'),
('e872d313aa68493090c0376159a2bdf709446c49', '2023-08-29', 'Singaparna', '12000', '11000', '14000', '21000', '15000', '16000', '130000', '38000', '40000', '31000', '12500', '10000', '8000', '2000', '11000', '15000', '25000', '30000', '30000', '2850', '70000', '20000', '36000', '30000', '8000', '5000', '10000', '30000', '36000', '60000', '18000', '22000', '5000', '23000', '5000', '23000'),
('f1962e25b19e339e0dfe48a4d773c5798dbe6c12', '2024-06-03', 'Ciawi', '1000000', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `het`
--

CREATE TABLE `het` (
  `id_het` varchar(255) NOT NULL,
  `beras_p` varchar(255) NOT NULL,
  `beras_m` varchar(255) NOT NULL,
  `gula` varchar(255) NOT NULL,
  `bimoli` varchar(255) NOT NULL,
  `minyak_c` varchar(255) NOT NULL,
  `minyak_k` varchar(255) NOT NULL,
  `sapi` varchar(255) NOT NULL,
  `ayam_b` varchar(255) NOT NULL,
  `ayam_k` varchar(255) NOT NULL,
  `telur` varchar(255) NOT NULL,
  `susu_b` varchar(255) NOT NULL,
  `susu_i` varchar(255) NOT NULL,
  `susu_d` varchar(255) NOT NULL,
  `jagung_p` varchar(255) NOT NULL,
  `jagung_t` varchar(255) NOT NULL,
  `garam` varchar(255) NOT NULL,
  `tepung` varchar(255) NOT NULL,
  `kacang_k` varchar(255) NOT NULL,
  `kacang_h` varchar(255) NOT NULL,
  `kacang_t` varchar(255) NOT NULL,
  `blueband` varchar(255) NOT NULL,
  `mie` varchar(255) NOT NULL,
  `cabe_mb` varchar(255) NOT NULL,
  `cabe_hb` varchar(255) NOT NULL,
  `cabe_rh` varchar(255) NOT NULL,
  `cabe_rm` varchar(255) NOT NULL,
  `wortel` varchar(255) NOT NULL,
  `kol` varchar(255) NOT NULL,
  `buncis` varchar(255) NOT NULL,
  `bawang_m` varchar(255) NOT NULL,
  `bawang_p` varchar(255) NOT NULL,
  `ikan_asin` varchar(255) NOT NULL,
  `kentang` varchar(255) NOT NULL,
  `gula_merah` varchar(255) NOT NULL,
  `kelapa` varchar(255) NOT NULL,
  `gas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `het`
--

INSERT INTO `het` (`id_het`, `beras_p`, `beras_m`, `gula`, `bimoli`, `minyak_c`, `minyak_k`, `sapi`, `ayam_b`, `ayam_k`, `telur`, `susu_b`, `susu_i`, `susu_d`, `jagung_p`, `jagung_t`, `garam`, `tepung`, `kacang_k`, `kacang_h`, `kacang_t`, `blueband`, `mie`, `cabe_mb`, `cabe_hb`, `cabe_rh`, `cabe_rm`, `wortel`, `kol`, `buncis`, `bawang_m`, `bawang_p`, `ikan_asin`, `kentang`, `gula_merah`, `kelapa`, `gas`) VALUES
('42fdd66d9a7ba8e267e844c9578c69883fd3a0loe', '12800', '9450', '14000', '0', '14000', '0', '135000', '30000', '0', '29000', '0', '0', '0', '10000', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '16000');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `harga`
--
ALTER TABLE `harga`
  ADD PRIMARY KEY (`id_bahan`);

--
-- Indeks untuk tabel `het`
--
ALTER TABLE `het`
  ADD PRIMARY KEY (`id_het`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
