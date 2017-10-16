-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2017 at 05:07 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `uhbk`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE IF NOT EXISTS `guru` (
  `nip` varchar(18) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(2) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nip`, `nama`, `jabatan`, `password`, `status`) VALUES
('12345', 'Muhammad Soleh', '2', '827ccb0eea8a706c4c34a16891f84e7b', '1'),
('21255', 'Budi Hartono', '1', '', ''),
('2736', 'Muhaimin Muhammad', '1', '47fd3c87f42f55d4b233417d49c34783', '');

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE IF NOT EXISTS `hasil` (
`id_hasil` int(11) NOT NULL,
  `id_ajar` int(4) NOT NULL,
  `nis` varchar(10) NOT NULL,
  `id_ujian` varchar(5) NOT NULL,
  `waktu` varchar(10) NOT NULL,
  `nilai` varchar(3) NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `id_ajar`, `nis`, `id_ujian`, `waktu`, `nilai`, `status`) VALUES
(4, 0, '2737', 'IPA', '0', '', ''),
(5, 0, '1236', 'IPA', '0', '', ''),
(6, 0, '51371', 'IPA', '0', '', ''),
(7, 0, '4456', 'IPA', '454', '', ''),
(8, 0, '808', 'IPA', '72', '', ''),
(10, 0, '808', 'BI', '0', '', ''),
(11, 0, '51371', 'BI', '0', '', ''),
(14, 0, '2736', 'BI', '1056', '', ''),
(18, 0, '2736', 'IPA', '3060', '', ''),
(19, 0, '2736', 'TIK', '2945', '', ''),
(20, 0, '4456', 'BI', '3366', '', ''),
(21, 0, '12', 'BI', '2866', '', ''),
(22, 2, '1245', 'BI', '3593', '60', '2');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE IF NOT EXISTS `jawaban` (
`id_jawaban` int(4) NOT NULL,
  `id_ajar` int(4) NOT NULL,
  `id_soal` varchar(10) NOT NULL,
  `nis` varchar(10) NOT NULL,
  `id_ujian` varchar(5) NOT NULL,
  `jawaban` varchar(2) NOT NULL,
  `skor` varchar(2) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id_jawaban`, `id_ajar`, `id_soal`, `nis`, `id_ujian`, `jawaban`, `skor`) VALUES
(1, 0, '8', '2736', 'IPA', 'D', '0'),
(2, 0, '7', '2736', 'IPA', 'B', '0'),
(3, 0, '6', '2736', 'IPA', 'A', '1'),
(4, 0, '1', '2736', 'IPA', 'A', '1'),
(5, 0, '5', '2736', 'IPA', 'A', '1'),
(6, 0, '8', '2737', 'IPA', 'A', '1'),
(7, 0, '7', '2737', 'IPA', 'C', '0'),
(8, 0, '6', '2737', 'IPA', 'C', '0'),
(9, 0, '1', '2737', 'IPA', 'C', '0'),
(10, 0, '5', '2737', 'IPA', 'C', '0'),
(11, 0, '8', '1236', 'IPA', 'B', '0'),
(12, 0, '5', '1236', 'IPA', 'A', '1'),
(13, 0, '7', '1236', 'IPA', 'D', '0'),
(14, 0, '1', '1236', 'IPA', 'B', '0'),
(15, 0, '6', '1236', 'IPA', 'A', '1'),
(16, 0, '7', '51371', 'IPA', 'D', '0'),
(17, 0, '6', '51371', 'IPA', 'D', '0'),
(18, 0, '8', '51371', 'IPA', 'D', '0'),
(19, 0, '1', '51371', 'IPA', 'D', '0'),
(20, 0, '5', '51371', 'IPA', 'D', '0'),
(21, 0, '7', '4456', 'IPA', 'D', '0'),
(22, 0, '8', '808', 'IPA', 'A', '1'),
(23, 0, '1', '808', 'IPA', 'A', '1'),
(24, 0, '5', '808', 'IPA', 'A', '1'),
(25, 0, '7', '808', 'IPA', 'A', '1'),
(26, 0, '6', '808', 'IPA', 'A', '1'),
(42, 0, '25', '2736', 'TIK', 'D', '1'),
(43, 0, '28', '2736', 'TIK', 'D', '0'),
(44, 0, '27', '2736', 'TIK', 'D', '0'),
(45, 0, '26', '2736', 'TIK', 'B', '0'),
(46, 0, '23', '2736', 'TIK', 'C', '0'),
(47, 0, '15', '2736', 'IPA', 'A', '1'),
(53, 0, '30', '2736', 'BI', 'A', '1'),
(54, 0, '31', '2736', 'BI', 'B', '0'),
(55, 0, '33', '2736', 'BI', 'A', '1'),
(56, 0, '35', '2736', 'BI', 'A', '1'),
(57, 0, '32', '2736', 'BI', 'A', '1'),
(58, 0, '33', '4456', 'BI', 'A', '1'),
(59, 0, '35', '4456', 'BI', 'A', '1'),
(60, 0, '31', '4456', 'BI', 'C', '1'),
(61, 0, '32', '4456', 'BI', 'A', '1'),
(62, 0, '30', '4456', 'BI', 'A', '1'),
(63, 0, '30', '12', 'BI', 'A', '1'),
(64, 0, '33', '12', 'BI', 'A', '1'),
(65, 0, '31', '12', 'BI', 'C', '1'),
(66, 0, '32', '12', 'BI', 'A', '1'),
(67, 0, '35', '12', 'BI', 'A', '1'),
(68, 2, '35', '1245', 'BI', 'A', '1'),
(69, 2, '33', '1245', 'BI', 'D', '0'),
(70, 2, '30', '1245', 'BI', 'A', '1'),
(71, 2, '31', '1245', 'BI', 'C', '1'),
(72, 2, '32', '1245', 'BI', 'D', '0');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
`id_kelas` int(3) NOT NULL,
  `tingkat` varchar(2) NOT NULL,
  `kelas` varchar(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `tingkat`, `kelas`) VALUES
(1, '7', '7 A'),
(2, '7', '7 B'),
(3, '7', '7 C'),
(4, '7', '7 D'),
(5, '7', '7 E'),
(6, '7', '7 F'),
(7, '7', '7 G'),
(8, '7', '7 H'),
(10, '9', '9 A'),
(11, '8', '8 B');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `nis` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_kelas` varchar(5) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `nama`, `id_kelas`, `password`, `status`) VALUES
('1245', 'Kurniawan Ashar', '6', '5eac43aceba42c8757b54003a58277b5', '1'),
('1256', 'Andrianto', '6', 'c20ad4d76fe97759aa27a0c99bff6710', ''),
('2736', 'Hasan Sadikin', '1', '47fd3c87f42f55d4b233417d49c34783', ''),
('4456', 'Muslih', '1', '8ab8dff7441eda91aa7bb26becb3afd3', ''),
('4568', 'Kurniawan', '4', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE IF NOT EXISTS `soal` (
`id_soal` int(4) NOT NULL,
  `id_ujian` varchar(4) NOT NULL,
  `soal` varchar(100) NOT NULL,
  `a` varchar(30) NOT NULL,
  `b` varchar(30) NOT NULL,
  `c` varchar(30) NOT NULL,
  `d` varchar(30) NOT NULL,
  `kunci` varchar(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id_soal`, `id_ujian`, `soal`, `a`, `b`, `c`, `d`, `kunci`) VALUES
(5, 'IPA', 'Penemu Lampu Pijar adalah', 'Thomas Alfa Edison', 'Baden Powell', 'Ki Hajar Dewantara', 'Alfiah', 'B'),
(6, 'IPA', 'Kipas merupakan contoh perubahan dari energi listrik menjadi energi', 'Gerak', 'Listrik', 'Api', 'Doraemom', 'A'),
(7, 'IPA', 'Apaka kepanjangan dari Kg', 'Kilogram', 'Inci', 'Meter', 'Binary', 'A'),
(8, 'IPA', 'Apa satuan dari kuat arus listrik', 'Ampere', 'Meter', 'Cm', 'Km', 'A'),
(15, 'IPA', 'Satuan Internasional dari massa adalah', 'Kg', 'Ons', 'Gram', 'Meter', 'A'),
(23, 'TIK', 'Apa nama komputer tipis yang menyerupai HP', 'Buku', 'HP', 'Tablet', 'PC', 'B'),
(24, 'IPA', 'Apa nama anak katak', 'cindil', 'monyet', 'kutuk', 'harimau', 'A'),
(25, 'TIK', 'Apa nama komputer PC prtama kali', 'UNIVAC', 'IBM', 'APAC', 'APPLE II', 'D'),
(26, 'TIK', 'Apa kepanjangan Modem', 'Monster De Monsterius', 'Model Demitri', 'Modulator de modulator', 'Moving Deal', 'C'),
(27, 'TIK', 'Untuk menjelajahi dunia maya membutuhkan aplikasi', 'Ms. Office', 'Browser', 'Tune Up Utility', 'Antivirus', 'B'),
(29, 'TIK', 'IP merupakan kepanjangan dari', 'Internet Protokol', 'Internet Profider', 'Internet President', 'Internet Plastisol', 'A'),
(30, 'BI', 'Apa singkatan dari Dewan Perwakilan Rakyat', 'DPR', 'MPR', 'KPU', 'KPK', 'A'),
(31, 'BI', 'Sinonim dari Pria', 'Wanita', 'Waria', 'Laki-laki', 'Anak-anak', 'C'),
(32, 'BI', 'a', 'a', 'a', 'a', 'a', 'A'),
(33, 'BI', 'b', 'b', 'b', 'b', 'b', 'A'),
(35, 'BI', 'c', 'c', 'c', 'c', 'c', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `t_ajaran`
--

CREATE TABLE IF NOT EXISTS `t_ajaran` (
  `id_ajar` int(2) NOT NULL,
  `t_ajaran` varchar(10) NOT NULL,
  `semester` varchar(5) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_ajaran`
--

INSERT INTO `t_ajaran` (`id_ajar`, `t_ajaran`, `semester`, `status`) VALUES
(1, '2015/2016', 'Gasal', 0),
(2, '2015/2016', 'Genap', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_paralel`
--

CREATE TABLE IF NOT EXISTS `t_paralel` (
  `nis` varchar(10) NOT NULL,
  `id_kelas` varchar(2) NOT NULL,
  `id_ajar` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_paralel`
--

INSERT INTO `t_paralel` (`nis`, `id_kelas`, `id_ajar`) VALUES
('1245', '1', '2');

-- --------------------------------------------------------

--
-- Table structure for table `ujian`
--

CREATE TABLE IF NOT EXISTS `ujian` (
  `id_ujian` varchar(10) NOT NULL,
  `mapel` varchar(100) NOT NULL,
  `kd` varchar(50) NOT NULL,
  `jumlah_soal` int(4) NOT NULL,
  `waktu` varchar(5) NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ujian`
--

INSERT INTO `ujian` (`id_ujian`, `mapel`, `kd`, `jumlah_soal`, `waktu`, `status`) VALUES
('BI', 'Bahasa Indonesia', '1.2 Membaca cepat', 5, '3660', '1'),
('IPA', 'Ilmu Pengetahuan Alam', '1.3 Pengukuran', 5, '7200', '0'),
('TIK', 'Teknologi Informasi dan Komunikasi', '1.1 Microsoft excel', 5, '7200', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
 ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
 ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
 ADD PRIMARY KEY (`id_jawaban`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
 ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
 ADD PRIMARY KEY (`nis`), ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
 ADD PRIMARY KEY (`id_soal`);

--
-- Indexes for table `t_ajaran`
--
ALTER TABLE `t_ajaran`
 ADD PRIMARY KEY (`id_ajar`);

--
-- Indexes for table `ujian`
--
ALTER TABLE `ujian`
 ADD PRIMARY KEY (`id_ujian`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
MODIFY `id_jawaban` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
MODIFY `id_kelas` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
MODIFY `id_soal` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
