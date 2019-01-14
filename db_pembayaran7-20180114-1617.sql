-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jan 14, 2019 at 10:16 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pembayaran7`
--

-- --------------------------------------------------------

--
-- Table structure for table `t0101_tahunajaran`
--

CREATE TABLE `t0101_tahunajaran` (
  `id` int(11) NOT NULL,
  `AwalBulan` tinyint(4) NOT NULL,
  `AwalTahun` smallint(6) NOT NULL,
  `AkhirBulan` tinyint(4) NOT NULL,
  `AkhirTahun` smallint(6) NOT NULL,
  `TahunAjaran` varchar(11) NOT NULL,
  `Aktif` enum('Y','T') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t0101_tahunajaran`
--

INSERT INTO `t0101_tahunajaran` (`id`, `AwalBulan`, `AwalTahun`, `AkhirBulan`, `AkhirTahun`, `TahunAjaran`, `Aktif`) VALUES
(1, 7, 2018, 6, 2019, '2018 / 2019', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `t0102_sekolah`
--

CREATE TABLE `t0102_sekolah` (
  `id` int(11) NOT NULL,
  `Sekolah` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t0102_sekolah`
--

INSERT INTO `t0102_sekolah` (`id`, `Sekolah`) VALUES
(1, 'MI NURUL ULUM KARAKTER SUKOREJO BOJONEGORO'),
(2, 'MI NURUL ULUM UNGGULAN SUKOREJO BOJONEGORO');

-- --------------------------------------------------------

--
-- Table structure for table `t0103_kelas`
--

CREATE TABLE `t0103_kelas` (
  `id` int(11) NOT NULL,
  `Kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t0103_kelas`
--

INSERT INTO `t0103_kelas` (`id`, `Kelas`) VALUES
(1, 'KELAS I KH. BISRI SYANSURI'),
(2, 'KELAS I KH. WACHID HASYIM'),
(3, 'KELAS I NICOLAS OTTO'),
(4, 'KELAS I JAMES WATT'),
(5, 'KELAS II ALEXANDER GRAHAM BELL'),
(6, 'KELAS II MICHAEL FARADAY'),
(7, 'KELAS III ALBERT EINSTEIN'),
(8, 'KELAS III ALFRED NOBEL'),
(9, 'KELAS IV ISAAC NEWTON'),
(10, 'KELAS IV ALESSANDRO VOLTA'),
(11, 'KELAS V THOMAS ALFA EDISON'),
(12, 'KELAS VI GALILEO GALILEI');

-- --------------------------------------------------------

--
-- Table structure for table `t0104_daftarsiswamaster`
--

CREATE TABLE `t0104_daftarsiswamaster` (
  `id` int(11) NOT NULL,
  `tahunajaran_id` int(11) NOT NULL,
  `sekolah_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t0104_daftarsiswamaster`
--

INSERT INTO `t0104_daftarsiswamaster` (`id`, `tahunajaran_id`, `sekolah_id`, `kelas_id`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t0105_daftarsiswadetail`
--

CREATE TABLE `t0105_daftarsiswadetail` (
  `id` int(11) NOT NULL,
  `daftarsiswamaster_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t0105_daftarsiswadetail`
--

INSERT INTO `t0105_daftarsiswadetail` (`id`, `daftarsiswamaster_id`, `siswa_id`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `t0106_iuran`
--

CREATE TABLE `t0106_iuran` (
  `id` int(11) NOT NULL,
  `Iuran` varchar(100) NOT NULL,
  `Jenis` enum('Rutin','Non-Rutin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t0106_iuran`
--

INSERT INTO `t0106_iuran` (`id`, `Iuran`, `Jenis`) VALUES
(1, 'Infaq', 'Rutin'),
(2, 'Catering', 'Rutin'),
(3, 'Worksheet', 'Rutin'),
(4, 'Beasiswa Infaq', 'Rutin'),
(5, 'Dana SPM BP3MNU', 'Non-Rutin'),
(6, 'Daftar Ulang', 'Non-Rutin');

-- --------------------------------------------------------

--
-- Table structure for table `t0201_siswa`
--

CREATE TABLE `t0201_siswa` (
  `id` int(11) NOT NULL,
  `NIS` varchar(100) NOT NULL,
  `Nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t0201_siswa`
--

INSERT INTO `t0201_siswa` (`id`, `NIS`, `Nama`) VALUES
(1, '180001', 'Abdul'),
(2, '180002', 'Adi');

-- --------------------------------------------------------

--
-- Table structure for table `t0202_siswaiuran`
--

CREATE TABLE `t0202_siswaiuran` (
  `id` int(11) NOT NULL,
  `tahunajaran_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `iuran_id` int(11) NOT NULL,
  `Nilai` float(14,2) NOT NULL DEFAULT '0.00',
  `Terbayar` float(14,2) NOT NULL DEFAULT '0.00',
  `Sisa` float(14,2) NOT NULL DEFAULT '0.00',
  `P01` enum('0','1') NOT NULL DEFAULT '0',
  `P02` enum('0','1') NOT NULL DEFAULT '0',
  `P03` enum('0','1') NOT NULL DEFAULT '0',
  `P04` enum('0','1') NOT NULL DEFAULT '0',
  `P05` enum('0','1') NOT NULL DEFAULT '0',
  `P06` enum('0','1') NOT NULL DEFAULT '0',
  `P07` enum('0','1') NOT NULL DEFAULT '0',
  `P08` enum('0','1') NOT NULL DEFAULT '0',
  `P09` enum('0','1') NOT NULL DEFAULT '0',
  `P10` enum('0','1') NOT NULL DEFAULT '0',
  `P11` enum('0','1') NOT NULL DEFAULT '0',
  `P12` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t0202_siswaiuran`
--

INSERT INTO `t0202_siswaiuran` (`id`, `tahunajaran_id`, `siswa_id`, `iuran_id`, `Nilai`, `Terbayar`, `Sisa`, `P01`, `P02`, `P03`, `P04`, `P05`, `P06`, `P07`, `P08`, `P09`, `P10`, `P11`, `P12`) VALUES
(1, 1, 1, 1, 100000.00, 0.00, 0.00, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(2, 1, 1, 2, 200000.00, 0.00, 0.00, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(3, 1, 2, 1, 300000.00, 0.00, 0.00, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(4, 1, 2, 2, 350000.00, 0.00, 0.00, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(5, 1, 2, 3, 400000.00, 0.00, 0.00, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `t0301_bayarmaster`
--

CREATE TABLE `t0301_bayarmaster` (
  `id` int(11) NOT NULL,
  `tahunajaran_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `Nomor` varchar(25) NOT NULL,
  `Tanggal` date NOT NULL,
  `Total` float(14,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t0301_bayarmaster`
--

INSERT INTO `t0301_bayarmaster` (`id`, `tahunajaran_id`, `siswa_id`, `Nomor`, `Tanggal`, `Total`) VALUES
(1, 1, 1, 'BYR001', '2019-01-14', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `t0302_bayardetail`
--

CREATE TABLE `t0302_bayardetail` (
  `id` int(11) NOT NULL,
  `bayarmaster_id` int(11) NOT NULL,
  `iuran_id` int(11) NOT NULL,
  `Periode1` varchar(14) DEFAULT NULL,
  `Periode2` varchar(14) DEFAULT NULL,
  `Keterangan` varchar(100) DEFAULT NULL,
  `Jumlah` float(14,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t0302_bayardetail`
--

INSERT INTO `t0302_bayardetail` (`id`, `bayarmaster_id`, `iuran_id`, `Periode1`, `Periode2`, `Keterangan`, `Jumlah`) VALUES
(1, 1, 1, '1', '1', NULL, 100000.00),
(2, 1, 2, '1', '1', NULL, 200000.00);

-- --------------------------------------------------------

--
-- Table structure for table `t9996_employees`
--

CREATE TABLE `t9996_employees` (
  `EmployeeID` int(11) NOT NULL,
  `LastName` varchar(20) DEFAULT NULL,
  `FirstName` varchar(10) DEFAULT NULL,
  `Title` varchar(30) DEFAULT NULL,
  `TitleOfCourtesy` varchar(25) DEFAULT NULL,
  `BirthDate` datetime DEFAULT NULL,
  `HireDate` datetime DEFAULT NULL,
  `Address` varchar(60) DEFAULT NULL,
  `City` varchar(15) DEFAULT NULL,
  `Region` varchar(15) DEFAULT NULL,
  `PostalCode` varchar(10) DEFAULT NULL,
  `Country` varchar(15) DEFAULT NULL,
  `HomePhone` varchar(24) DEFAULT NULL,
  `Extension` varchar(4) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `Notes` longtext,
  `ReportsTo` int(11) DEFAULT NULL,
  `Password` varchar(50) NOT NULL DEFAULT '',
  `UserLevel` int(11) DEFAULT NULL,
  `Username` varchar(20) NOT NULL DEFAULT '',
  `Activated` enum('Y','N') NOT NULL DEFAULT 'N',
  `Profile` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t9996_employees`
--

INSERT INTO `t9996_employees` (`EmployeeID`, `LastName`, `FirstName`, `Title`, `TitleOfCourtesy`, `BirthDate`, `HireDate`, `Address`, `City`, `Region`, `PostalCode`, `Country`, `HomePhone`, `Extension`, `Email`, `Photo`, `Notes`, `ReportsTo`, `Password`, `UserLevel`, `Username`, `Activated`, `Profile`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21232f297a57a5a743894a0e4a801fc3', -1, 'admin', 'Y', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t9997_userlevels`
--

CREATE TABLE `t9997_userlevels` (
  `userlevelid` int(11) NOT NULL,
  `userlevelname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t9997_userlevels`
--

INSERT INTO `t9997_userlevels` (`userlevelid`, `userlevelname`) VALUES
(-2, 'Anonymous'),
(-1, 'Administrator'),
(0, 'Default');

-- --------------------------------------------------------

--
-- Table structure for table `t9998_userlevelpermissions`
--

CREATE TABLE `t9998_userlevelpermissions` (
  `userlevelid` int(11) NOT NULL,
  `tablename` varchar(255) NOT NULL,
  `permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t9998_userlevelpermissions`
--

INSERT INTO `t9998_userlevelpermissions` (`userlevelid`, `tablename`, `permission`) VALUES
(-2, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}cf01_home.php', 8),
(-2, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t01_tahunajaran', 0),
(-2, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t02_sekolah', 0),
(-2, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t03_kelas', 0),
(-2, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t04_siswa', 0),
(-2, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t05_daftarsiswamaster', 0),
(-2, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t06_daftarsiswadetail', 0),
(-2, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t07_spp', 0),
(-2, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t08_siswaspp', 0),
(-2, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t09_bayarmaster', 0),
(-2, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t10_bayardetail', 0),
(-2, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t95_periode', 0),
(-2, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t96_employees', 0),
(-2, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t97_userlevels', 0),
(-2, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t98_userlevelpermissions', 0),
(-2, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t99_audittrail', 0),
(-2, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}v01_siswaspp', 0),
(-2, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}v02_pembayaran', 0),
(-2, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}v03_kartuspp', 72),
(-2, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}cf01_home.php', 8),
(-2, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t0101_tahunajaran', 0),
(-2, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t0102_sekolah', 0),
(-2, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t0103_kelas', 0),
(-2, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t0104_daftarsiswamaster', 0),
(-2, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t0105_daftarsiswadetail', 0),
(-2, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t0106_iuran', 0),
(-2, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t0201_siswa', 0),
(-2, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t0202_siswaiuran', 0),
(-2, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t0301_bayarmaster', 0),
(-2, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t0302_bayardetail', 0),
(-2, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t9996_employees', 0),
(-2, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t9997_userlevels', 0),
(-2, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t9998_userlevelpermissions', 0),
(-2, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t9999_audittrail', 0),
(-2, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}cf01_home.php', 8),
(-2, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}t96_employees', 0),
(-2, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}t97_userlevels', 0),
(-2, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}t98_userlevelpermissions', 0),
(-2, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}t99_audittrail', 0),
(-2, '{a1a0c678-e4a2-462e-aa46-2c3f87d00b16}t01_tahunajaran', 0),
(-2, '{a1a0c678-e4a2-462e-aa46-2c3f87d00b16}t96_employees', 0),
(-2, '{a1a0c678-e4a2-462e-aa46-2c3f87d00b16}t97_userlevels', 0),
(-2, '{a1a0c678-e4a2-462e-aa46-2c3f87d00b16}t98_userlevelpermissions', 0),
(-2, '{a1a0c678-e4a2-462e-aa46-2c3f87d00b16}t99_audittrail', 0),
(0, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}cf01_home.php', 8),
(0, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t01_tahunajaran', 0),
(0, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t02_sekolah', 0),
(0, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t03_kelas', 0),
(0, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t04_siswa', 0),
(0, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t05_daftarsiswamaster', 0),
(0, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t06_daftarsiswadetail', 0),
(0, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t07_spp', 0),
(0, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t08_siswaspp', 0),
(0, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t09_bayarmaster', 0),
(0, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t10_bayardetail', 0),
(0, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t95_periode', 0),
(0, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t96_employees', 0),
(0, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t97_userlevels', 0),
(0, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t98_userlevelpermissions', 0),
(0, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t99_audittrail', 0),
(0, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}v01_siswaspp', 0),
(0, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}v02_pembayaran', 0),
(0, '{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}v03_kartuspp', 8),
(0, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}cf01_home.php', 0),
(0, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t0101_tahunajaran', 0),
(0, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t0102_sekolah', 0),
(0, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t0103_kelas', 0),
(0, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t0104_daftarsiswamaster', 0),
(0, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t0105_daftarsiswadetail', 0),
(0, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t0106_iuran', 0),
(0, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t0201_siswa', 0),
(0, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t0202_siswaiuran', 0),
(0, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t0301_bayarmaster', 0),
(0, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t0302_bayardetail', 0),
(0, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t9996_employees', 0),
(0, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t9997_userlevels', 0),
(0, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t9998_userlevelpermissions', 0),
(0, '{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t9999_audittrail', 0),
(0, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}cf01_home.php', 8),
(0, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}t96_employees', 0),
(0, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}t97_userlevels', 0),
(0, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}t98_userlevelpermissions', 0),
(0, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}t99_audittrail', 0),
(0, '{a1a0c678-e4a2-462e-aa46-2c3f87d00b16}t01_tahunajaran', 0),
(0, '{a1a0c678-e4a2-462e-aa46-2c3f87d00b16}t96_employees', 0),
(0, '{a1a0c678-e4a2-462e-aa46-2c3f87d00b16}t97_userlevels', 0),
(0, '{a1a0c678-e4a2-462e-aa46-2c3f87d00b16}t98_userlevelpermissions', 0),
(0, '{a1a0c678-e4a2-462e-aa46-2c3f87d00b16}t99_audittrail', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t9999_audittrail`
--

CREATE TABLE `t9999_audittrail` (
  `id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `script` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `table` varchar(255) DEFAULT NULL,
  `field` varchar(255) DEFAULT NULL,
  `keyvalue` longtext,
  `oldvalue` longtext,
  `newvalue` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t9999_audittrail`
--

INSERT INTO `t9999_audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(1, '2019-01-11 14:12:37', '/pembayaran7/login.php', 'admin', 'login', '::1', '', '', '', ''),
(2, '2019-01-11 14:13:13', '/pembayaran7/t0101_tahunajaranadd.php', '1', 'A', 't0101_tahunajaran', 'AwalBulan', '1', '', '7'),
(3, '2019-01-11 14:13:13', '/pembayaran7/t0101_tahunajaranadd.php', '1', 'A', 't0101_tahunajaran', 'AwalTahun', '1', '', '2018'),
(4, '2019-01-11 14:13:13', '/pembayaran7/t0101_tahunajaranadd.php', '1', 'A', 't0101_tahunajaran', 'AkhirBulan', '1', '', '6'),
(5, '2019-01-11 14:13:13', '/pembayaran7/t0101_tahunajaranadd.php', '1', 'A', 't0101_tahunajaran', 'AkhirTahun', '1', '', '2019'),
(6, '2019-01-11 14:13:13', '/pembayaran7/t0101_tahunajaranadd.php', '1', 'A', 't0101_tahunajaran', 'TahunAjaran', '1', '', '2018 / 2019'),
(7, '2019-01-11 14:13:13', '/pembayaran7/t0101_tahunajaranadd.php', '1', 'A', 't0101_tahunajaran', 'Aktif', '1', '', 'Y'),
(8, '2019-01-11 14:13:13', '/pembayaran7/t0101_tahunajaranadd.php', '1', 'A', 't0101_tahunajaran', 'id', '1', '', '1'),
(9, '2019-01-11 14:18:27', '/pembayaran7/t0102_sekolahadd.php', '1', 'A', 't0102_sekolah', 'Sekolah', '1', '', 'MI NURUL ULUM KARAKTER SUKOREJO BOJONEGORO'),
(10, '2019-01-11 14:18:27', '/pembayaran7/t0102_sekolahadd.php', '1', 'A', 't0102_sekolah', 'id', '1', '', '1'),
(11, '2019-01-11 14:18:40', '/pembayaran7/t0102_sekolahadd.php', '1', 'A', 't0102_sekolah', 'Sekolah', '2', '', 'MI NURUL ULUM UNGGULAN SUKOREJO BOJONEGORO'),
(12, '2019-01-11 14:18:40', '/pembayaran7/t0102_sekolahadd.php', '1', 'A', 't0102_sekolah', 'id', '2', '', '2'),
(13, '2019-01-11 14:24:49', '/pembayaran7/t0103_kelasadd.php', '1', 'A', 't0103_kelas', 'Kelas', '1', '', 'KELAS I KH. BISRI SYANSURI'),
(14, '2019-01-11 14:24:49', '/pembayaran7/t0103_kelasadd.php', '1', 'A', 't0103_kelas', 'id', '1', '', '1'),
(15, '2019-01-11 14:25:01', '/pembayaran7/t0103_kelasadd.php', '1', 'A', 't0103_kelas', 'Kelas', '2', '', 'KELAS I KH. WACHID HASYIM'),
(16, '2019-01-11 14:25:01', '/pembayaran7/t0103_kelasadd.php', '1', 'A', 't0103_kelas', 'id', '2', '', '2'),
(17, '2019-01-11 14:25:11', '/pembayaran7/t0103_kelasadd.php', '1', 'A', 't0103_kelas', 'Kelas', '3', '', 'KELAS I NICOLAS OTTO'),
(18, '2019-01-11 14:25:11', '/pembayaran7/t0103_kelasadd.php', '1', 'A', 't0103_kelas', 'id', '3', '', '3'),
(19, '2019-01-11 14:25:21', '/pembayaran7/t0103_kelasadd.php', '1', 'A', 't0103_kelas', 'Kelas', '4', '', 'KELAS I JAMES WATT'),
(20, '2019-01-11 14:25:21', '/pembayaran7/t0103_kelasadd.php', '1', 'A', 't0103_kelas', 'id', '4', '', '4'),
(21, '2019-01-11 14:25:31', '/pembayaran7/t0103_kelasadd.php', '1', 'A', 't0103_kelas', 'Kelas', '5', '', 'KELAS II ALEXANDER GRAHAM BELL'),
(22, '2019-01-11 14:25:31', '/pembayaran7/t0103_kelasadd.php', '1', 'A', 't0103_kelas', 'id', '5', '', '5'),
(23, '2019-01-11 14:25:41', '/pembayaran7/t0103_kelasadd.php', '1', 'A', 't0103_kelas', 'Kelas', '6', '', 'KELAS II MICHAEL FARADAY'),
(24, '2019-01-11 14:25:41', '/pembayaran7/t0103_kelasadd.php', '1', 'A', 't0103_kelas', 'id', '6', '', '6'),
(25, '2019-01-11 14:25:49', '/pembayaran7/t0103_kelasadd.php', '1', 'A', 't0103_kelas', 'Kelas', '7', '', 'KELAS III ALBERT EINSTEIN'),
(26, '2019-01-11 14:25:49', '/pembayaran7/t0103_kelasadd.php', '1', 'A', 't0103_kelas', 'id', '7', '', '7'),
(27, '2019-01-11 14:25:59', '/pembayaran7/t0103_kelasadd.php', '1', 'A', 't0103_kelas', 'Kelas', '8', '', 'KELAS III ALFRED NOBEL'),
(28, '2019-01-11 14:25:59', '/pembayaran7/t0103_kelasadd.php', '1', 'A', 't0103_kelas', 'id', '8', '', '8'),
(29, '2019-01-11 14:26:39', '/pembayaran7/t0103_kelasadd.php', '1', 'A', 't0103_kelas', 'Kelas', '9', '', 'KELAS IV ISAAC NEWTON'),
(30, '2019-01-11 14:26:39', '/pembayaran7/t0103_kelasadd.php', '1', 'A', 't0103_kelas', 'id', '9', '', '9'),
(31, '2019-01-11 14:26:50', '/pembayaran7/t0103_kelasadd.php', '1', 'A', 't0103_kelas', 'Kelas', '10', '', 'KELAS IV ALESSANDRO VOLTA'),
(32, '2019-01-11 14:26:50', '/pembayaran7/t0103_kelasadd.php', '1', 'A', 't0103_kelas', 'id', '10', '', '10'),
(33, '2019-01-11 14:27:00', '/pembayaran7/t0103_kelasadd.php', '1', 'A', 't0103_kelas', 'Kelas', '11', '', 'KELAS V THOMAS ALFA EDISON'),
(34, '2019-01-11 14:27:00', '/pembayaran7/t0103_kelasadd.php', '1', 'A', 't0103_kelas', 'id', '11', '', '11'),
(35, '2019-01-11 14:27:09', '/pembayaran7/t0103_kelasadd.php', '1', 'A', 't0103_kelas', 'Kelas', '12', '', 'KELAS VI GALILEO GALILEI'),
(36, '2019-01-11 14:27:09', '/pembayaran7/t0103_kelasadd.php', '1', 'A', 't0103_kelas', 'id', '12', '', '12'),
(37, '2019-01-11 14:50:16', '/pembayaran7/t0106_iuranadd.php', '1', 'A', 't0106_iuran', 'Iuran', '1', '', 'Infaq'),
(38, '2019-01-11 14:50:16', '/pembayaran7/t0106_iuranadd.php', '1', 'A', 't0106_iuran', 'Jenis', '1', '', 'Rutin'),
(39, '2019-01-11 14:50:16', '/pembayaran7/t0106_iuranadd.php', '1', 'A', 't0106_iuran', 'id', '1', '', '1'),
(40, '2019-01-11 14:50:26', '/pembayaran7/t0106_iuranadd.php', '1', 'A', 't0106_iuran', 'Iuran', '2', '', 'Catering'),
(41, '2019-01-11 14:50:26', '/pembayaran7/t0106_iuranadd.php', '1', 'A', 't0106_iuran', 'Jenis', '2', '', 'Rutin'),
(42, '2019-01-11 14:50:26', '/pembayaran7/t0106_iuranadd.php', '1', 'A', 't0106_iuran', 'id', '2', '', '2'),
(43, '2019-01-11 14:50:39', '/pembayaran7/t0106_iuranadd.php', '1', 'A', 't0106_iuran', 'Iuran', '3', '', 'Worksheet'),
(44, '2019-01-11 14:50:39', '/pembayaran7/t0106_iuranadd.php', '1', 'A', 't0106_iuran', 'Jenis', '3', '', 'Rutin'),
(45, '2019-01-11 14:50:39', '/pembayaran7/t0106_iuranadd.php', '1', 'A', 't0106_iuran', 'id', '3', '', '3'),
(46, '2019-01-11 14:50:53', '/pembayaran7/t0106_iuranadd.php', '1', 'A', 't0106_iuran', 'Iuran', '4', '', 'Beasiswa Infaq'),
(47, '2019-01-11 14:50:53', '/pembayaran7/t0106_iuranadd.php', '1', 'A', 't0106_iuran', 'Jenis', '4', '', 'Rutin'),
(48, '2019-01-11 14:50:53', '/pembayaran7/t0106_iuranadd.php', '1', 'A', 't0106_iuran', 'id', '4', '', '4'),
(49, '2019-01-11 14:51:08', '/pembayaran7/t0106_iuranadd.php', '1', 'A', 't0106_iuran', 'Iuran', '5', '', 'Dana SPM BP3MNU'),
(50, '2019-01-11 14:51:08', '/pembayaran7/t0106_iuranadd.php', '1', 'A', 't0106_iuran', 'Jenis', '5', '', 'Non-Rutin'),
(51, '2019-01-11 14:51:08', '/pembayaran7/t0106_iuranadd.php', '1', 'A', 't0106_iuran', 'id', '5', '', '5'),
(52, '2019-01-11 14:51:20', '/pembayaran7/t0106_iuranadd.php', '1', 'A', 't0106_iuran', 'Iuran', '6', '', 'Daftar Ulang'),
(53, '2019-01-11 14:51:20', '/pembayaran7/t0106_iuranadd.php', '1', 'A', 't0106_iuran', 'Jenis', '6', '', 'Non-Rutin'),
(54, '2019-01-11 14:51:20', '/pembayaran7/t0106_iuranadd.php', '1', 'A', 't0106_iuran', 'id', '6', '', '6'),
(55, '2019-01-11 14:55:48', '/pembayaran7/t0201_siswaadd.php', '1', 'A', 't0201_siswa', 'NIS', '1', '', '180001'),
(56, '2019-01-11 14:55:48', '/pembayaran7/t0201_siswaadd.php', '1', 'A', 't0201_siswa', 'Nama', '1', '', 'Abdul'),
(57, '2019-01-11 14:55:48', '/pembayaran7/t0201_siswaadd.php', '1', 'A', 't0201_siswa', 'id', '1', '', '1'),
(58, '2019-01-11 14:56:01', '/pembayaran7/t0201_siswaadd.php', '1', 'A', 't0201_siswa', 'NIS', '2', '', '180002'),
(59, '2019-01-11 14:56:01', '/pembayaran7/t0201_siswaadd.php', '1', 'A', 't0201_siswa', 'Nama', '2', '', 'Adi'),
(60, '2019-01-11 14:56:01', '/pembayaran7/t0201_siswaadd.php', '1', 'A', 't0201_siswa', 'id', '2', '', '2'),
(61, '2019-01-11 14:56:23', '/pembayaran7/t0104_daftarsiswamasteradd.php', '1', 'A', 't0104_daftarsiswamaster', 'tahunajaran_id', '1', '', '1'),
(62, '2019-01-11 14:56:23', '/pembayaran7/t0104_daftarsiswamasteradd.php', '1', 'A', 't0104_daftarsiswamaster', 'sekolah_id', '1', '', '1'),
(63, '2019-01-11 14:56:23', '/pembayaran7/t0104_daftarsiswamasteradd.php', '1', 'A', 't0104_daftarsiswamaster', 'kelas_id', '1', '', '1'),
(64, '2019-01-11 14:56:23', '/pembayaran7/t0104_daftarsiswamasteradd.php', '1', 'A', 't0104_daftarsiswamaster', 'id', '1', '', '1'),
(65, '2019-01-11 14:56:23', '/pembayaran7/t0104_daftarsiswamasteradd.php', '1', '*** Batch insert begin ***', 't0105_daftarsiswadetail', '', '', '', ''),
(66, '2019-01-11 14:56:23', '/pembayaran7/t0104_daftarsiswamasteradd.php', '1', 'A', 't0105_daftarsiswadetail', 'siswa_id', '1', '', '1'),
(67, '2019-01-11 14:56:23', '/pembayaran7/t0104_daftarsiswamasteradd.php', '1', 'A', 't0105_daftarsiswadetail', 'daftarsiswamaster_id', '1', '', '1'),
(68, '2019-01-11 14:56:23', '/pembayaran7/t0104_daftarsiswamasteradd.php', '1', 'A', 't0105_daftarsiswadetail', 'id', '1', '', '1'),
(69, '2019-01-11 14:56:23', '/pembayaran7/t0104_daftarsiswamasteradd.php', '1', 'A', 't0105_daftarsiswadetail', 'siswa_id', '2', '', '2'),
(70, '2019-01-11 14:56:23', '/pembayaran7/t0104_daftarsiswamasteradd.php', '1', 'A', 't0105_daftarsiswadetail', 'daftarsiswamaster_id', '2', '', '1'),
(71, '2019-01-11 14:56:23', '/pembayaran7/t0104_daftarsiswamasteradd.php', '1', 'A', 't0105_daftarsiswadetail', 'id', '2', '', '2'),
(72, '2019-01-11 14:56:23', '/pembayaran7/t0104_daftarsiswamasteradd.php', '1', '*** Batch insert successful ***', 't0105_daftarsiswadetail', '', '', '', ''),
(73, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', '*** Batch update begin ***', 't0202_siswaiuran', '', '', '', ''),
(74, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'tahunajaran_id', '1', '', '1'),
(75, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'iuran_id', '1', '', '1'),
(76, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'Nilai', '1', '', '100000'),
(77, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'Terbayar', '1', '', '0'),
(78, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'Sisa', '1', '', '0'),
(79, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'P01', '1', '', '0'),
(80, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'P02', '1', '', '0'),
(81, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'P03', '1', '', '0'),
(82, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'P04', '1', '', '0'),
(83, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'P05', '1', '', '0'),
(84, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'P06', '1', '', '0'),
(85, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'P07', '1', '', '0'),
(86, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'P08', '1', '', '0'),
(87, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'P09', '1', '', '0'),
(88, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'P10', '1', '', '0'),
(89, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'P11', '1', '', '0'),
(90, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'P12', '1', '', '0'),
(91, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'siswa_id', '1', '', '1'),
(92, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'id', '1', '', '1'),
(93, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'tahunajaran_id', '2', '', '1'),
(94, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'iuran_id', '2', '', '2'),
(95, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'Nilai', '2', '', '200000'),
(96, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'Terbayar', '2', '', '0'),
(97, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'Sisa', '2', '', '0'),
(98, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'P01', '2', '', '0'),
(99, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'P02', '2', '', '0'),
(100, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'P03', '2', '', '0'),
(101, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'P04', '2', '', '0'),
(102, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'P05', '2', '', '0'),
(103, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'P06', '2', '', '0'),
(104, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'P07', '2', '', '0'),
(105, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'P08', '2', '', '0'),
(106, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'P09', '2', '', '0'),
(107, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'P10', '2', '', '0'),
(108, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'P11', '2', '', '0'),
(109, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'P12', '2', '', '0'),
(110, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'siswa_id', '2', '', '1'),
(111, '2019-01-11 15:11:10', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'id', '2', '', '2'),
(112, '2019-01-11 15:11:11', '/pembayaran7/t0201_siswaedit.php', '1', '*** Batch update successful ***', 't0202_siswaiuran', '', '', '', ''),
(113, '2019-01-11 15:14:42', '/pembayaran7/t0202_siswaiuranadd.php', '1', 'A', 't0202_siswaiuran', 'tahunajaran_id', '3', '', '1'),
(114, '2019-01-11 15:14:42', '/pembayaran7/t0202_siswaiuranadd.php', '1', 'A', 't0202_siswaiuran', 'iuran_id', '3', '', '1'),
(115, '2019-01-11 15:14:42', '/pembayaran7/t0202_siswaiuranadd.php', '1', 'A', 't0202_siswaiuran', 'Nilai', '3', '', '300000'),
(116, '2019-01-11 15:14:42', '/pembayaran7/t0202_siswaiuranadd.php', '1', 'A', 't0202_siswaiuran', 'siswa_id', '3', '', '2'),
(117, '2019-01-11 15:14:42', '/pembayaran7/t0202_siswaiuranadd.php', '1', 'A', 't0202_siswaiuran', 'id', '3', '', '3'),
(118, '2019-01-11 15:14:58', '/pembayaran7/t0202_siswaiuranadd.php', '1', 'A', 't0202_siswaiuran', 'tahunajaran_id', '4', '', '1'),
(119, '2019-01-11 15:14:58', '/pembayaran7/t0202_siswaiuranadd.php', '1', 'A', 't0202_siswaiuran', 'iuran_id', '4', '', '2'),
(120, '2019-01-11 15:14:58', '/pembayaran7/t0202_siswaiuranadd.php', '1', 'A', 't0202_siswaiuran', 'Nilai', '4', '', '350000'),
(121, '2019-01-11 15:14:58', '/pembayaran7/t0202_siswaiuranadd.php', '1', 'A', 't0202_siswaiuran', 'siswa_id', '4', '', '2'),
(122, '2019-01-11 15:14:58', '/pembayaran7/t0202_siswaiuranadd.php', '1', 'A', 't0202_siswaiuran', 'id', '4', '', '4'),
(123, '2019-01-11 15:23:25', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0301_bayarmaster', 'tahunajaran_id', '1', '', '1'),
(124, '2019-01-11 15:23:25', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0301_bayarmaster', 'siswa_id', '1', '', '1'),
(125, '2019-01-11 15:23:25', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0301_bayarmaster', 'Nomor', '1', '', '0001'),
(126, '2019-01-11 15:23:25', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0301_bayarmaster', 'Tanggal', '1', '', '2019-01-11'),
(127, '2019-01-11 15:23:25', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0301_bayarmaster', 'Total', '1', '', '0'),
(128, '2019-01-11 15:23:25', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0301_bayarmaster', 'id', '1', '', '1'),
(129, '2019-01-11 15:23:25', '/pembayaran7/t0301_bayarmasteradd.php', '1', '*** Batch insert begin ***', 't0302_bayardetail', '', '', '', ''),
(130, '2019-01-11 15:23:25', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'iuran_id', '1', '', '1'),
(131, '2019-01-11 15:23:25', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Periode1', '1', '', '1'),
(132, '2019-01-11 15:23:25', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Periode2', '1', '', '1'),
(133, '2019-01-11 15:23:25', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Keterangan', '1', '', '1'),
(134, '2019-01-11 15:23:25', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Jumlah', '1', '', '1'),
(135, '2019-01-11 15:23:25', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'bayarmaster_id', '1', '', '1'),
(136, '2019-01-11 15:23:25', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'id', '1', '', '1'),
(137, '2019-01-11 15:23:25', '/pembayaran7/t0301_bayarmasteradd.php', '1', '*** Batch insert successful ***', 't0302_bayardetail', '', '', '', ''),
(138, '2019-01-11 19:12:54', '/pembayaran7/t0201_siswaedit.php', '1', '*** Batch update begin ***', 't0202_siswaiuran', '', '', '', ''),
(139, '2019-01-11 19:12:54', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'tahunajaran_id', '5', '', '1'),
(140, '2019-01-11 19:12:54', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'iuran_id', '5', '', '3'),
(141, '2019-01-11 19:12:54', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'Nilai', '5', '', '400000'),
(142, '2019-01-11 19:12:54', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'siswa_id', '5', '', '2'),
(143, '2019-01-11 19:12:54', '/pembayaran7/t0201_siswaedit.php', '1', 'A', 't0202_siswaiuran', 'id', '5', '', '5'),
(144, '2019-01-11 19:12:54', '/pembayaran7/t0201_siswaedit.php', '1', '*** Batch update successful ***', 't0202_siswaiuran', '', '', '', ''),
(145, '2019-01-11 20:29:30', '/pembayaran7/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(146, '2019-01-11 20:29:38', '/pembayaran7/login.php', 'admin', 'login', '::1', '', '', '', ''),
(147, '2019-01-11 21:01:54', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0301_bayarmaster', 'Nomor', '2', '', 'BYR002'),
(148, '2019-01-11 21:01:54', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0301_bayarmaster', 'Tanggal', '2', '', '2019-01-11'),
(149, '2019-01-11 21:01:54', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0301_bayarmaster', 'tahunajaran_id', '2', '', '1'),
(150, '2019-01-11 21:01:54', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0301_bayarmaster', 'siswa_id', '2', '', '1'),
(151, '2019-01-11 21:01:54', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0301_bayarmaster', 'Total', '2', '', '0'),
(152, '2019-01-11 21:01:54', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0301_bayarmaster', 'id', '2', '', '2'),
(153, '2019-01-11 21:01:54', '/pembayaran7/t0301_bayarmasteradd.php', '1', '*** Batch insert begin ***', 't0302_bayardetail', '', '', '', ''),
(154, '2019-01-11 21:01:54', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'iuran_id', '2', '', '1'),
(155, '2019-01-11 21:01:54', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Periode1', '2', '', 'Januari 2019'),
(156, '2019-01-11 21:01:54', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Periode2', '2', '', NULL),
(157, '2019-01-11 21:01:54', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Keterangan', '2', '', NULL),
(158, '2019-01-11 21:01:54', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Jumlah', '2', '', '100000.00'),
(159, '2019-01-11 21:01:54', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'bayarmaster_id', '2', '', '2'),
(160, '2019-01-11 21:01:54', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'id', '2', '', '2'),
(161, '2019-01-11 21:01:54', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'iuran_id', '3', '', '2'),
(162, '2019-01-11 21:01:54', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Periode1', '3', '', 'Juli 2018'),
(163, '2019-01-11 21:01:54', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Periode2', '3', '', NULL),
(164, '2019-01-11 21:01:54', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Keterangan', '3', '', NULL),
(165, '2019-01-11 21:01:54', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Jumlah', '3', '', '200000.00'),
(166, '2019-01-11 21:01:54', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'bayarmaster_id', '3', '', '2'),
(167, '2019-01-11 21:01:54', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'id', '3', '', '3'),
(168, '2019-01-11 21:01:54', '/pembayaran7/t0301_bayarmasteradd.php', '1', '*** Batch insert successful ***', 't0302_bayardetail', '', '', '', ''),
(169, '2019-01-12 01:04:08', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0301_bayarmaster', 'Nomor', '3', '', 'BYR003'),
(170, '2019-01-12 01:04:08', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0301_bayarmaster', 'Tanggal', '3', '', '2019-01-12'),
(171, '2019-01-12 01:04:08', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0301_bayarmaster', 'tahunajaran_id', '3', '', '1'),
(172, '2019-01-12 01:04:08', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0301_bayarmaster', 'siswa_id', '3', '', '1'),
(173, '2019-01-12 01:04:08', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0301_bayarmaster', 'Total', '3', '', '0'),
(174, '2019-01-12 01:04:08', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0301_bayarmaster', 'id', '3', '', '3'),
(175, '2019-01-12 01:04:08', '/pembayaran7/t0301_bayarmasteradd.php', '1', '*** Batch insert begin ***', 't0302_bayardetail', '', '', '', ''),
(176, '2019-01-12 01:04:08', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'iuran_id', '4', '', '1'),
(177, '2019-01-12 01:04:08', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Periode1', '4', '', 'Januari'),
(178, '2019-01-12 01:04:08', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Periode2', '4', '', '7'),
(179, '2019-01-12 01:04:08', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Keterangan', '4', '', NULL),
(180, '2019-01-12 01:04:08', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Jumlah', '4', '', '100000.00'),
(181, '2019-01-12 01:04:08', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'bayarmaster_id', '4', '', '3'),
(182, '2019-01-12 01:04:08', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'id', '4', '', '4'),
(183, '2019-01-12 01:04:08', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'iuran_id', '5', '', '2'),
(184, '2019-01-12 01:04:08', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Periode1', '5', '', 'Juli'),
(185, '2019-01-12 01:04:08', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Periode2', '5', '', '1'),
(186, '2019-01-12 01:04:08', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Keterangan', '5', '', NULL),
(187, '2019-01-12 01:04:08', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Jumlah', '5', '', '200000.00'),
(188, '2019-01-12 01:04:08', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'bayarmaster_id', '5', '', '3'),
(189, '2019-01-12 01:04:08', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'id', '5', '', '5'),
(190, '2019-01-12 01:04:09', '/pembayaran7/t0301_bayarmasteradd.php', '1', '*** Batch insert successful ***', 't0302_bayardetail', '', '', '', ''),
(191, '2019-01-12 01:21:03', '/pembayaran7/t0301_bayarmasterdelete.php', '1', '*** Batch delete begin ***', 't0301_bayarmaster', '', '', '', ''),
(192, '2019-01-12 01:21:03', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'id', '4', '4', ''),
(193, '2019-01-12 01:21:03', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'bayarmaster_id', '4', '3', ''),
(194, '2019-01-12 01:21:03', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'iuran_id', '4', '1', ''),
(195, '2019-01-12 01:21:03', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'Periode1', '4', 'Januari', ''),
(196, '2019-01-12 01:21:03', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'Periode2', '4', '7', ''),
(197, '2019-01-12 01:21:03', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'Keterangan', '4', NULL, ''),
(198, '2019-01-12 01:21:03', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'Jumlah', '4', '100000.00', ''),
(199, '2019-01-12 01:21:03', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'id', '5', '5', ''),
(200, '2019-01-12 01:21:03', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'bayarmaster_id', '5', '3', ''),
(201, '2019-01-12 01:21:03', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'iuran_id', '5', '2', ''),
(202, '2019-01-12 01:21:03', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'Periode1', '5', 'Juli', ''),
(203, '2019-01-12 01:21:03', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'Periode2', '5', '1', ''),
(204, '2019-01-12 01:21:03', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'Keterangan', '5', NULL, ''),
(205, '2019-01-12 01:21:03', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'Jumlah', '5', '200000.00', ''),
(206, '2019-01-12 01:21:03', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0301_bayarmaster', 'id', '3', '3', ''),
(207, '2019-01-12 01:21:03', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0301_bayarmaster', 'tahunajaran_id', '3', '1', ''),
(208, '2019-01-12 01:21:03', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0301_bayarmaster', 'siswa_id', '3', '1', ''),
(209, '2019-01-12 01:21:03', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0301_bayarmaster', 'Nomor', '3', 'BYR003', ''),
(210, '2019-01-12 01:21:03', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0301_bayarmaster', 'Tanggal', '3', '2019-01-12', ''),
(211, '2019-01-12 01:21:03', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0301_bayarmaster', 'Total', '3', '0.00', ''),
(212, '2019-01-12 01:21:03', '/pembayaran7/t0301_bayarmasterdelete.php', '1', '*** Batch delete successful ***', 't0301_bayarmaster', '', '', '', ''),
(213, '2019-01-12 01:21:07', '/pembayaran7/t0301_bayarmasterdelete.php', '1', '*** Batch delete begin ***', 't0301_bayarmaster', '', '', '', ''),
(214, '2019-01-12 01:21:07', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'id', '2', '2', ''),
(215, '2019-01-12 01:21:07', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'bayarmaster_id', '2', '2', ''),
(216, '2019-01-12 01:21:07', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'iuran_id', '2', '1', ''),
(217, '2019-01-12 01:21:07', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'Periode1', '2', 'Januari 2019', ''),
(218, '2019-01-12 01:21:07', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'Periode2', '2', NULL, ''),
(219, '2019-01-12 01:21:07', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'Keterangan', '2', NULL, ''),
(220, '2019-01-12 01:21:07', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'Jumlah', '2', '100000.00', ''),
(221, '2019-01-12 01:21:08', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'id', '3', '3', ''),
(222, '2019-01-12 01:21:08', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'bayarmaster_id', '3', '2', ''),
(223, '2019-01-12 01:21:08', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'iuran_id', '3', '2', ''),
(224, '2019-01-12 01:21:08', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'Periode1', '3', 'Juli 2018', ''),
(225, '2019-01-12 01:21:08', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'Periode2', '3', NULL, ''),
(226, '2019-01-12 01:21:08', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'Keterangan', '3', NULL, ''),
(227, '2019-01-12 01:21:08', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'Jumlah', '3', '200000.00', ''),
(228, '2019-01-12 01:21:08', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0301_bayarmaster', 'id', '2', '2', ''),
(229, '2019-01-12 01:21:08', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0301_bayarmaster', 'tahunajaran_id', '2', '1', ''),
(230, '2019-01-12 01:21:08', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0301_bayarmaster', 'siswa_id', '2', '1', ''),
(231, '2019-01-12 01:21:08', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0301_bayarmaster', 'Nomor', '2', 'BYR002', ''),
(232, '2019-01-12 01:21:08', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0301_bayarmaster', 'Tanggal', '2', '2019-01-11', ''),
(233, '2019-01-12 01:21:08', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0301_bayarmaster', 'Total', '2', '0.00', ''),
(234, '2019-01-12 01:21:08', '/pembayaran7/t0301_bayarmasterdelete.php', '1', '*** Batch delete successful ***', 't0301_bayarmaster', '', '', '', ''),
(235, '2019-01-12 01:21:12', '/pembayaran7/t0301_bayarmasterdelete.php', '1', '*** Batch delete begin ***', 't0301_bayarmaster', '', '', '', ''),
(236, '2019-01-12 01:21:12', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'id', '1', '1', ''),
(237, '2019-01-12 01:21:12', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'bayarmaster_id', '1', '1', ''),
(238, '2019-01-12 01:21:12', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'iuran_id', '1', '1', ''),
(239, '2019-01-12 01:21:12', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'Periode1', '1', '1', ''),
(240, '2019-01-12 01:21:12', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'Periode2', '1', '1', ''),
(241, '2019-01-12 01:21:12', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'Keterangan', '1', '1', ''),
(242, '2019-01-12 01:21:12', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0302_bayardetail', 'Jumlah', '1', '1.00', ''),
(243, '2019-01-12 01:21:12', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0301_bayarmaster', 'id', '1', '1', ''),
(244, '2019-01-12 01:21:12', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0301_bayarmaster', 'tahunajaran_id', '1', '1', ''),
(245, '2019-01-12 01:21:12', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0301_bayarmaster', 'siswa_id', '1', '1', ''),
(246, '2019-01-12 01:21:12', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0301_bayarmaster', 'Nomor', '1', 'BYR001', ''),
(247, '2019-01-12 01:21:12', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0301_bayarmaster', 'Tanggal', '1', '2019-01-11', ''),
(248, '2019-01-12 01:21:12', '/pembayaran7/t0301_bayarmasterdelete.php', '1', 'D', 't0301_bayarmaster', 'Total', '1', '0.00', ''),
(249, '2019-01-12 01:21:12', '/pembayaran7/t0301_bayarmasterdelete.php', '1', '*** Batch delete successful ***', 't0301_bayarmaster', '', '', '', ''),
(250, '2019-01-14 15:09:13', '/pembayaran7/login.php', 'admin', 'login', '::1', '', '', '', ''),
(251, '2019-01-14 15:39:58', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0301_bayarmaster', 'Nomor', '1', '', 'BYR001'),
(252, '2019-01-14 15:39:58', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0301_bayarmaster', 'Tanggal', '1', '', '2019-01-14'),
(253, '2019-01-14 15:39:58', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0301_bayarmaster', 'tahunajaran_id', '1', '', '1'),
(254, '2019-01-14 15:39:58', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0301_bayarmaster', 'siswa_id', '1', '', '1'),
(255, '2019-01-14 15:39:58', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0301_bayarmaster', 'Total', '1', '', '0'),
(256, '2019-01-14 15:39:58', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0301_bayarmaster', 'id', '1', '', '1'),
(257, '2019-01-14 15:39:58', '/pembayaran7/t0301_bayarmasteradd.php', '1', '*** Batch insert begin ***', 't0302_bayardetail', '', '', '', ''),
(258, '2019-01-14 15:39:58', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'iuran_id', '1', '', '1'),
(259, '2019-01-14 15:39:58', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Periode1', '1', '', '1'),
(260, '2019-01-14 15:39:58', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Periode2', '1', '', '1'),
(261, '2019-01-14 15:39:58', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Keterangan', '1', '', NULL),
(262, '2019-01-14 15:39:58', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Jumlah', '1', '', '100000.00'),
(263, '2019-01-14 15:39:58', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'bayarmaster_id', '1', '', '1'),
(264, '2019-01-14 15:39:58', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'id', '1', '', '1'),
(265, '2019-01-14 15:39:58', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'iuran_id', '2', '', '2'),
(266, '2019-01-14 15:39:58', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Periode1', '2', '', '1'),
(267, '2019-01-14 15:39:58', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Periode2', '2', '', '1'),
(268, '2019-01-14 15:39:58', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Keterangan', '2', '', NULL),
(269, '2019-01-14 15:39:58', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'Jumlah', '2', '', '200000.00'),
(270, '2019-01-14 15:39:58', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'bayarmaster_id', '2', '', '1'),
(271, '2019-01-14 15:39:58', '/pembayaran7/t0301_bayarmasteradd.php', '1', 'A', 't0302_bayardetail', 'id', '2', '', '2'),
(272, '2019-01-14 15:39:59', '/pembayaran7/t0301_bayarmasteradd.php', '1', '*** Batch insert successful ***', 't0302_bayardetail', '', '', '', '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v0301_bayarmasterdetail`
-- (See below for the actual view)
--
CREATE TABLE `v0301_bayarmasterdetail` (
`bayarmaster_id` int(11)
,`tahunajaran_id` int(11)
,`siswa_id` int(11)
,`Nomor` varchar(25)
,`Tanggal` date
,`Total` float(14,2)
,`bayardetail_id` int(11)
,`iuran_id` int(11)
,`Periode1` varchar(14)
,`Periode2` varchar(14)
,`Keterangan` varchar(100)
,`Jumlah` float(14,2)
);

-- --------------------------------------------------------

--
-- Structure for view `v0301_bayarmasterdetail`
--
DROP TABLE IF EXISTS `v0301_bayarmasterdetail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v0301_bayarmasterdetail`  AS  select `a`.`id` AS `bayarmaster_id`,`a`.`tahunajaran_id` AS `tahunajaran_id`,`a`.`siswa_id` AS `siswa_id`,`a`.`Nomor` AS `Nomor`,`a`.`Tanggal` AS `Tanggal`,`a`.`Total` AS `Total`,`b`.`id` AS `bayardetail_id`,`b`.`iuran_id` AS `iuran_id`,`b`.`Periode1` AS `Periode1`,`b`.`Periode2` AS `Periode2`,`b`.`Keterangan` AS `Keterangan`,`b`.`Jumlah` AS `Jumlah` from (`t0301_bayarmaster` `a` left join `t0302_bayardetail` `b` on((`a`.`id` = `b`.`bayarmaster_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t0101_tahunajaran`
--
ALTER TABLE `t0101_tahunajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t0102_sekolah`
--
ALTER TABLE `t0102_sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t0103_kelas`
--
ALTER TABLE `t0103_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t0104_daftarsiswamaster`
--
ALTER TABLE `t0104_daftarsiswamaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t0105_daftarsiswadetail`
--
ALTER TABLE `t0105_daftarsiswadetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t0106_iuran`
--
ALTER TABLE `t0106_iuran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t0201_siswa`
--
ALTER TABLE `t0201_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t0202_siswaiuran`
--
ALTER TABLE `t0202_siswaiuran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t0301_bayarmaster`
--
ALTER TABLE `t0301_bayarmaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t0302_bayardetail`
--
ALTER TABLE `t0302_bayardetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t9996_employees`
--
ALTER TABLE `t9996_employees`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `t9997_userlevels`
--
ALTER TABLE `t9997_userlevels`
  ADD PRIMARY KEY (`userlevelid`);

--
-- Indexes for table `t9998_userlevelpermissions`
--
ALTER TABLE `t9998_userlevelpermissions`
  ADD PRIMARY KEY (`userlevelid`,`tablename`);

--
-- Indexes for table `t9999_audittrail`
--
ALTER TABLE `t9999_audittrail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t0101_tahunajaran`
--
ALTER TABLE `t0101_tahunajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t0102_sekolah`
--
ALTER TABLE `t0102_sekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t0103_kelas`
--
ALTER TABLE `t0103_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `t0104_daftarsiswamaster`
--
ALTER TABLE `t0104_daftarsiswamaster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t0105_daftarsiswadetail`
--
ALTER TABLE `t0105_daftarsiswadetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t0106_iuran`
--
ALTER TABLE `t0106_iuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t0201_siswa`
--
ALTER TABLE `t0201_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t0202_siswaiuran`
--
ALTER TABLE `t0202_siswaiuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t0301_bayarmaster`
--
ALTER TABLE `t0301_bayarmaster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t0302_bayardetail`
--
ALTER TABLE `t0302_bayardetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t9996_employees`
--
ALTER TABLE `t9996_employees`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t9999_audittrail`
--
ALTER TABLE `t9999_audittrail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
