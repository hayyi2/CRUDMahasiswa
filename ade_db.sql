-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 15 Des 2017 pada 13.14
-- Versi Server: 5.7.9
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ade_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

DROP TABLE IF EXISTS `mahasiswa`;
CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tanggal_lahir` varchar(10) NOT NULL,
  `jenjang` varchar(50) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `seleksi` varchar(100) NOT NULL,
  `nomor` varchar(20) NOT NULL,
  PRIMARY KEY (`id_mahasiswa`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nim`, `nama`, `tanggal_lahir`, `jenjang`, `jurusan`, `prodi`, `seleksi`, `nomor`) VALUES
(1, '123123123', 'Keroro Gunsou', '12-23-2901', 'S1/Filkom', 'Teknik Informatika', 'Teknik Informatika', 'Mandiri', '34563456345'),
(2, 'update', 'Keror Kero', 'update', 'update', 'update', 'update', 'update', '4352345'),
(4, 'updateadf', 'updateasdf', 'updateasdf', 'updateasdf', 'updateasdf', 'updateasdf', 'updateasdf', 'updateasdf'),
(7, '354134123', 'New Data', 'dsfasfd', 'asdfasdf', 'asdfadsf', 'dsfgafg', 'dafgadf', 'adfgsdaf'),
(8, '53452345', 'test', 'asdf', 'adfasdf', 'adfasdfasdf', 'asdfasdf', 'adfasdf', 'dfgasdf');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
