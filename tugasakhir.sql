-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2018 at 12:53 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugasakhir`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID_ADMIN` varchar(10) NOT NULL,
  `USERNAME_ADMIN` varchar(50) DEFAULT NULL,
  `PASSWORD_ADMIN` varchar(50) DEFAULT NULL,
  `NAMA_ADMIN` varchar(50) DEFAULT NULL,
  `JENKEL` enum('PRIA','PEREMPUAN') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID_ADMIN`, `USERNAME_ADMIN`, `PASSWORD_ADMIN`, `NAMA_ADMIN`, `JENKEL`) VALUES
('AD01', 'admin', 'admin', 'Super Admin', 'PEREMPUAN');

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `ID_ALTERNATIF` varchar(10) NOT NULL,
  `ID_ADMIN` varchar(10) NOT NULL,
  `ID_PRODI` varchar(10) NOT NULL,
  `ALTERNATIF` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hasilpeminatan`
--

CREATE TABLE `hasilpeminatan` (
  `ID_PEMINATAN` varchar(10) NOT NULL,
  `ID_MHS` varchar(10) NOT NULL,
  `HASILPEMINATAN` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hasiltkd`
--

CREATE TABLE `hasiltkd` (
  `ID_HASIL` varchar(10) NOT NULL,
  `ID_MHS` varchar(10) NOT NULL,
  `ID_ALTERNATIF` varchar(10) NOT NULL,
  `HASIL` int(11) DEFAULT NULL,
  `TANGGAL` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `ID_KRITERIA` varchar(10) NOT NULL,
  `ID_ADMIN` varchar(10) NOT NULL,
  `ID_ALTERNATIF` varchar(10) DEFAULT NULL,
  `SKS` int(11) DEFAULT NULL,
  `KRITERIA` varchar(50) DEFAULT NULL,
  `BOBOT` int(11) DEFAULT NULL,
  `STATUS` enum('AKTIF','NONAKTIF') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `ID_MHS` varchar(10) NOT NULL,
  `ID_PEMINATAN` varchar(10) DEFAULT NULL,
  `ID_PRODI` varchar(10) NOT NULL,
  `FOTO_MHS` varchar(1024) DEFAULT NULL,
  `TRANSKIP_NILAI` varchar(1024) DEFAULT NULL,
  `NAMA_DEPAN` varchar(100) DEFAULT NULL,
  `NAMA_BELAKANG` varchar(100) DEFAULT NULL,
  `NIM_MHS` varchar(20) DEFAULT NULL,
  `ANGKATAN` int(4) NOT NULL,
  `USERNAME_MHS` varchar(50) DEFAULT NULL,
  `PASSWORD_MHS` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nilai_mk`
--

CREATE TABLE `nilai_mk` (
  `ID_MK` varchar(10) NOT NULL,
  `ID_MHS` varchar(10) NOT NULL,
  `ID_ALTERNATIF` varchar(10) NOT NULL,
  `ID_KRITERIA` varchar(10) DEFAULT NULL,
  `GRADE` varchar(10) DEFAULT NULL,
  `NILAI` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `ID_PRODI` varchar(10) NOT NULL,
  `ID_ADMIN` varchar(10) NOT NULL,
  `KODE_PRODI` varchar(4) NOT NULL,
  `NAMA_PRODI` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soal_tkd`
--

CREATE TABLE `soal_tkd` (
  `ID_SOAL` int(11) NOT NULL,
  `ID_ADMIN` varchar(10) NOT NULL,
  `ID_ALTERNATIF` varchar(10) DEFAULT NULL,
  `SOAL` varchar(1024) DEFAULT NULL,
  `FOTO` varchar(1024) DEFAULT NULL,
  `JAWABAN1` varchar(1024) DEFAULT NULL,
  `JAWABAN2` varchar(1024) DEFAULT NULL,
  `JAWABAN3` varchar(1024) DEFAULT NULL,
  `JAWABAN_BENAR` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID_ADMIN`);

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`ID_ALTERNATIF`),
  ADD KEY `FK_MEMPUNYAINILAIMK` (`ID_ADMIN`),
  ADD KEY `ID_PRODI` (`ID_PRODI`);

--
-- Indexes for table `hasilpeminatan`
--
ALTER TABLE `hasilpeminatan`
  ADD PRIMARY KEY (`ID_PEMINATAN`),
  ADD UNIQUE KEY `ID_MHS_2` (`ID_MHS`),
  ADD UNIQUE KEY `ID_PEMINATAN` (`ID_PEMINATAN`),
  ADD KEY `ID_MHS` (`ID_MHS`);

--
-- Indexes for table `hasiltkd`
--
ALTER TABLE `hasiltkd`
  ADD PRIMARY KEY (`ID_HASIL`),
  ADD KEY `FK_MEMPUNYAIHASILTKD` (`ID_MHS`),
  ADD KEY `ID_ALTERNATIF` (`ID_ALTERNATIF`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`ID_KRITERIA`),
  ADD KEY `FK_MEMPUNYAI` (`ID_ALTERNATIF`),
  ADD KEY `FK_MENGELOLAKRITERIA` (`ID_ADMIN`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`ID_MHS`),
  ADD UNIQUE KEY `ID_PEMINATAN_2` (`ID_PEMINATAN`),
  ADD KEY `ID_PEMINATAN` (`ID_PEMINATAN`),
  ADD KEY `ID_PRODI` (`ID_PRODI`);

--
-- Indexes for table `nilai_mk`
--
ALTER TABLE `nilai_mk`
  ADD PRIMARY KEY (`ID_MK`),
  ADD KEY `FK_KRITERIANILAI` (`ID_KRITERIA`),
  ADD KEY `FK_MEMILIKINILAI` (`ID_MHS`),
  ADD KEY `ID_ALTERNATIF` (`ID_ALTERNATIF`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`ID_PRODI`),
  ADD KEY `ID_ADMIN` (`ID_ADMIN`);

--
-- Indexes for table `soal_tkd`
--
ALTER TABLE `soal_tkd`
  ADD PRIMARY KEY (`ID_SOAL`),
  ADD KEY `FK_MEMILIKI` (`ID_ALTERNATIF`),
  ADD KEY `FK_MENGELOLASOAL` (`ID_ADMIN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `soal_tkd`
--
ALTER TABLE `soal_tkd`
  MODIFY `ID_SOAL` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD CONSTRAINT `alternatif_ibfk_1` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`),
  ADD CONSTRAINT `alternatif_ibfk_2` FOREIGN KEY (`ID_PRODI`) REFERENCES `prodi` (`ID_PRODI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hasilpeminatan`
--
ALTER TABLE `hasilpeminatan`
  ADD CONSTRAINT `hasilpeminatan_ibfk_1` FOREIGN KEY (`ID_MHS`) REFERENCES `mahasiswa` (`ID_MHS`);

--
-- Constraints for table `hasiltkd`
--
ALTER TABLE `hasiltkd`
  ADD CONSTRAINT `hasiltkd_ibfk_1` FOREIGN KEY (`ID_ALTERNATIF`) REFERENCES `alternatif` (`ID_ALTERNATIF`),
  ADD CONSTRAINT `hasiltkd_ibfk_2` FOREIGN KEY (`ID_MHS`) REFERENCES `mahasiswa` (`ID_MHS`);

--
-- Constraints for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD CONSTRAINT `kriteria_ibfk_1` FOREIGN KEY (`ID_ALTERNATIF`) REFERENCES `alternatif` (`ID_ALTERNATIF`),
  ADD CONSTRAINT `kriteria_ibfk_2` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`);

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`ID_PEMINATAN`) REFERENCES `hasilpeminatan` (`ID_PEMINATAN`),
  ADD CONSTRAINT `mahasiswa_ibfk_2` FOREIGN KEY (`ID_PRODI`) REFERENCES `prodi` (`ID_PRODI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nilai_mk`
--
ALTER TABLE `nilai_mk`
  ADD CONSTRAINT `nilai_mk_ibfk_1` FOREIGN KEY (`ID_ALTERNATIF`) REFERENCES `alternatif` (`ID_ALTERNATIF`),
  ADD CONSTRAINT `nilai_mk_ibfk_2` FOREIGN KEY (`ID_KRITERIA`) REFERENCES `kriteria` (`ID_KRITERIA`),
  ADD CONSTRAINT `nilai_mk_ibfk_3` FOREIGN KEY (`ID_MHS`) REFERENCES `mahasiswa` (`ID_MHS`);

--
-- Constraints for table `prodi`
--
ALTER TABLE `prodi`
  ADD CONSTRAINT `prodi_ibfk_1` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `soal_tkd`
--
ALTER TABLE `soal_tkd`
  ADD CONSTRAINT `soal_tkd_ibfk_1` FOREIGN KEY (`ID_ALTERNATIF`) REFERENCES `alternatif` (`ID_ALTERNATIF`),
  ADD CONSTRAINT `soal_tkd_ibfk_2` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
