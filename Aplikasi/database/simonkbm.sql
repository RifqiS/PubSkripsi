-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2023 at 06:34 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simonkbm`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `ID_Account` int(255) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` text NOT NULL,
  `Permission` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`ID_Account`, `Username`, `Password`, `Permission`) VALUES
(1, 'Administrator', '7b7bc2512ee1fedcd76bdc68926d4f7b', 'Administrator'),
(2, '19111009', '064e42f99ae9268f9a7adaa5f2b73984', 'Mahasiswa'),
(3, '407118203', '6009d84bacd14be0c857609ee3a53138', 'Dosen'),
(16, '19111010', '680fcabe170596924fdc2a38e6d89610', 'Mahasiswa'),
(17, '19111011', '48d7a3a512c43724bd60920b273dcd67', 'Mahasiswa'),
(18, '191110018', '191110018', 'Mahasiswa'),
(19, '191110019', '191110019', 'Mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `ID` int(10) NOT NULL,
  `NIP` varchar(32) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Kode_Dosen` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`ID`, `NIP`, `Nama`, `Kode_Dosen`) VALUES
(1, '407118203', 'Ahmad Yuunus', 'AHY'),
(2, 'Administrator', 'Administrator', 'ADM');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `ID` int(10) NOT NULL,
  `Kode_MataKuliah` varchar(16) NOT NULL,
  `NIP` varchar(32) NOT NULL,
  `Hari` varchar(10) NOT NULL,
  `Jam_Awal` time NOT NULL,
  `Jam_Akhir` time NOT NULL,
  `Kelas` varchar(6) NOT NULL,
  `Ruang` varchar(6) NOT NULL,
  `Gabungan` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`ID`, `Kode_MataKuliah`, `NIP`, `Hari`, `Jam_Awal`, `Jam_Akhir`, `Kelas`, `Ruang`, `Gabungan`) VALUES
(1, 'IFKB1282', '407118203', 'Monday', '18:15:00', '20:30:00', 'IF19K', 'B103', ''),
(6, 'IFKU0012', '407118203', 'Monday', '09:30:00', '09:30:00', 'IF19K', 'B209', 'IF19K');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `ID` int(11) NOT NULL,
  `Kode_Jurusan` varchar(6) NOT NULL,
  `Nama_Jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`ID`, `Kode_Jurusan`, `Nama_Jurusan`) VALUES
(1, 'IF', 'Informatika'),
(2, 'SI', 'Sistem Informasi');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `ID` int(10) NOT NULL,
  `Kode_Kelas` varchar(6) NOT NULL,
  `Nama_Kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`ID`, `Kode_Kelas`, `Nama_Kelas`) VALUES
(1, 'IF19A', 'Informatika 19 Reguler A'),
(2, 'IF19K', 'Informatika 19 Karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `kuisoner`
--

CREATE TABLE `kuisoner` (
  `ID_Kuis` int(10) NOT NULL,
  `NPM` varchar(16) NOT NULL,
  `Kode_MataKuliah` varchar(16) NOT NULL,
  `Q1` int(1) NOT NULL,
  `Q2` int(1) NOT NULL,
  `Q3` int(1) NOT NULL,
  `Q4` int(1) NOT NULL,
  `Q5` int(1) NOT NULL,
  `Q6` int(1) NOT NULL,
  `Q7` int(1) NOT NULL,
  `Q8` int(1) NOT NULL,
  `Q9` int(1) NOT NULL,
  `Q10` int(1) NOT NULL,
  `Keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kuisoner`
--

INSERT INTO `kuisoner` (`ID_Kuis`, `NPM`, `Kode_MataKuliah`, `Q1`, `Q2`, `Q3`, `Q4`, `Q5`, `Q6`, `Q7`, `Q8`, `Q9`, `Q10`, `Keterangan`) VALUES
(1, '19111009', 'IFKB1282', 5, 4, 5, 4, 5, 5, 4, 5, 4, 5, 'Kompeten'),
(2, '19111009', 'IFKB1282', 4, 5, 3, 4, 4, 4, 2, 4, 4, 4, 'Dosen Kompeten');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `ID` int(10) NOT NULL,
  `NPM` varchar(16) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Kode_Jurusan` varchar(6) NOT NULL,
  `Tahun_Angkatan` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`ID`, `NPM`, `Nama`, `Kode_Jurusan`, `Tahun_Angkatan`) VALUES
(1, '19111009', 'Mochamad Rifqi Sukmana', 'IF', '2019'),
(2, '19111010', 'Agus', 'IF', '2019'),
(3, '19111011', 'Asep', 'IF', '2019'),
(6, '191110018', 'Atep', 'IF', '2019'),
(7, '191110019', 'Redi', 'IF', '2019');

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `ID` int(10) NOT NULL,
  `Kode_MataKuliah` varchar(16) NOT NULL,
  `Nama_MataKuliah` varchar(100) NOT NULL,
  `SKS` int(2) NOT NULL,
  `Prasyarat` varchar(6) NOT NULL,
  `Semester` int(2) NOT NULL,
  `Jenis_MataKuliah` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`ID`, `Kode_MataKuliah`, `Nama_MataKuliah`, `SKS`, `Prasyarat`, `Semester`, `Jenis_MataKuliah`) VALUES
(13, 'IFKU0012', 'Agama', 2, '', 1, ''),
(14, 'IFKB1282', 'Algoritma dan Pemograman 1', 3, '', 1, ''),
(15, 'IFKU0032', 'Bahasa Indonesia', 2, '', 1, ''),
(16, 'IFKU0042', 'Character Building', 2, '', 1, ''),
(17, 'IFKK1232', 'Kalkulus', 3, '', 1, ''),
(18, 'IFKU0072', 'Kewarganegaraan', 2, '', 1, ''),
(19, 'IFKK1022', 'Matematika Diskrit', 2, '', 1, ''),
(20, 'IFKK1012', 'Paket Aplikasi Komputer Awan', 2, '', 1, ''),
(21, 'IFKK1032', 'Pengantar Teknologi Informasi', 2, '', 1, ''),
(22, 'IFKK1182', 'Sistem Digital', 2, '', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `monev`
--

CREATE TABLE `monev` (
  `ID_Monev` varchar(16) NOT NULL,
  `Kode_MataKuliah` varchar(16) NOT NULL,
  `Materi` varchar(100) NOT NULL,
  `Hari_Dilaksanakan` varchar(10) NOT NULL,
  `Tanggal_Dilaksanakan` date NOT NULL,
  `Hari_Pengganti` varchar(10) NOT NULL,
  `Tanggal_Pengganti` date NOT NULL,
  `Jenis_Materi` varchar(100) NOT NULL,
  `Platform` varchar(100) NOT NULL,
  `Pelaksanaan` varchar(100) NOT NULL,
  `NPM_1` varchar(16) NOT NULL,
  `Status_1` varchar(100) NOT NULL,
  `C1_1` varchar(50) NOT NULL,
  `C1_2` varchar(50) NOT NULL,
  `NPM_2` varchar(16) NOT NULL,
  `Status_2` varchar(100) NOT NULL,
  `C2_1` varchar(50) NOT NULL,
  `C2_2` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `monev`
--

INSERT INTO `monev` (`ID_Monev`, `Kode_MataKuliah`, `Materi`, `Hari_Dilaksanakan`, `Tanggal_Dilaksanakan`, `Hari_Pengganti`, `Tanggal_Pengganti`, `Jenis_Materi`, `Platform`, `Pelaksanaan`, `NPM_1`, `Status_1`, `C1_1`, `C1_2`, `NPM_2`, `Status_2`, `C2_1`, `C2_2`) VALUES
('MNV001', 'IFKB1282', 'Pengenalan Algoritma dan Pemograman', 'Monday', '2023-08-28', '', '0000-00-00', 'File Text & Audio Video', 'E-Learning UNIBI & Zoom', 'Syncronus', '19111009', 'Not Confirm', '', '', '19111010', 'Not Confirm', '', ''),
('MNV0927002', 'IFKU0012', 'Pengenalan Agama Islam', 'Monday', '2023-09-25', '', '0000-00-00', 'File Text &amp; Audio Video', 'E-Learning UNIBI &amp; Zoom', 'Synchronus', '19111009', 'Confirmed', 'Absensi', 'Penyampaian Materi', '19111011', 'Not Confirm', 'Tidak Ada Absensi', 'Tidak Ada Penyampaian Materi');

-- --------------------------------------------------------

--
-- Table structure for table `plotkelas`
--

CREATE TABLE `plotkelas` (
  `ID_Join` int(255) NOT NULL,
  `Kelas` varchar(16) NOT NULL,
  `NPM` varchar(16) NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plotkelas`
--

INSERT INTO `plotkelas` (`ID_Join`, `Kelas`, `NPM`, `Status`) VALUES
(1, 'IF19K', '19111009', 'Leader'),
(2, 'IF19K', '19111010', 'Mahasiswa'),
(3, 'IF19K', '19111011', 'Mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`ID_Account`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `kuisoner`
--
ALTER TABLE `kuisoner`
  ADD PRIMARY KEY (`ID_Kuis`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `monev`
--
ALTER TABLE `monev`
  ADD PRIMARY KEY (`ID_Monev`);

--
-- Indexes for table `plotkelas`
--
ALTER TABLE `plotkelas`
  ADD PRIMARY KEY (`ID_Join`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `ID_Account` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kuisoner`
--
ALTER TABLE `kuisoner`
  MODIFY `ID_Kuis` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `matakuliah`
--
ALTER TABLE `matakuliah`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `plotkelas`
--
ALTER TABLE `plotkelas`
  MODIFY `ID_Join` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
