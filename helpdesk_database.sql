-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2022 at 02:35 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `helpdesk`
--

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id` int(11) NOT NULL,
  `kode_departemen` varchar(100) NOT NULL,
  `nama_departemen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id`, `kode_departemen`, `nama_departemen`) VALUES
(1, 'D0001', 'ACCOUNTING'),
(2, 'D0002', 'BOARD OF DIRECTOR'),
(3, 'D0003', 'COMMERCIAL'),
(4, 'D0004', 'CPP'),
(5, 'D0005', 'DOCUMENT SHIPPING'),
(6, 'D0006', 'ENGINEERING'),
(7, 'D0007', 'ER, LEGAL & CSR'),
(8, 'D0008', 'FA'),
(9, 'D0009', 'FINANCE'),
(10, 'D0010', 'HAULING ROAD'),
(11, 'D0011', 'HCMGA'),
(12, 'D0012', 'HRGA'),
(13, 'D0013', 'HRM'),
(14, 'D0014', 'IT'),
(15, 'D0015', 'KTT'),
(16, 'D0016', 'LEGAL'),
(17, 'D0017', 'MARKETING'),
(18, 'D0018', 'MINING'),
(19, 'D0019', 'OPERATIONAL PAL-12'),
(20, 'D0020', 'PORT'),
(21, 'D0021', 'PRODUKSI ENGINEERING'),
(22, 'D0022', 'PRODUKSI ENGINEERING PORT'),
(23, 'D0023', 'PURCHASING'),
(24, 'D0024', 'QC'),
(25, 'D0025', 'SHE'),
(26, 'D0026', 'TRANSHIPMENT'),
(27, '-', '-'),
(29, 'D0001', 'ACCOUNTING'),
(30, 'D0002', 'BOARD OF DIRECTOR'),
(31, 'D0003', 'COMMERCIAL'),
(32, 'D0004', 'CPP'),
(33, 'D0005', 'DOCUMENT SHIPPING'),
(34, 'D0006', 'ENGINEERING'),
(35, 'D0007', 'ER, LEGAL & CSR'),
(36, 'D0008', 'FA'),
(37, 'D0009', 'FINANCE'),
(38, 'D0010', 'HAULING ROAD'),
(39, 'D0011', 'HCMGA'),
(40, 'D0012', 'HRGA'),
(41, 'D0013', 'HRM'),
(42, 'D0014', 'IT'),
(43, 'D0015', 'KTT'),
(44, 'D0016', 'LEGAL'),
(45, 'D0017', 'MARKETING'),
(46, 'D0018', 'MINING'),
(47, 'D0019', 'OPERATIONAL PAL-12'),
(48, 'D0020', 'PORT'),
(49, 'D0021', 'PRODUKSI ENGINEERING'),
(50, 'D0022', 'PRODUKSI ENGINEERING PORT'),
(51, 'D0023', 'PURCHASING'),
(52, 'D0024', 'QC'),
(53, 'D0025', 'SHE'),
(54, 'D0026', 'TRANSHIPMENT');

-- --------------------------------------------------------

--
-- Table structure for table `informasi`
--

CREATE TABLE `informasi` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `subject` varchar(100) NOT NULL,
  `pesan` varchar(1500) NOT NULL,
  `dari` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `informasi`
--

INSERT INTO `informasi` (`id`, `tanggal`, `subject`, `pesan`, `dari`, `created_at`, `updated_at`) VALUES
(1, '2022-01-31', 'Feedback harap di isi', 'Feedback anda menjadi penilaian kinerja kami, dimohon untuk mengisi ya kakak!', 'Nursahid Arya Suyudi', '2022-01-31 04:27:14', '2022-01-31 04:27:14'),
(2, '2022-01-31', 'Hari libur pada tanggal 20 februari', 'Ada acara Penyambutan Bos besar BMBBD', 'Nursahid Arya Suyudi', '2022-01-31 04:30:35', '2022-01-31 04:30:52');

-- --------------------------------------------------------

--
-- Table structure for table `it_support`
--

CREATE TABLE `it_support` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `alamat` varchar(1000) NOT NULL,
  `perusahaan` varchar(100) NOT NULL,
  `departemen` varchar(100) NOT NULL DEFAULT 'IT',
  `jabatan` varchar(100) NOT NULL DEFAULT 'IT SUPPORT',
  `jk` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `no_telepon` varchar(100) NOT NULL,
  `foto_profile` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `it_support`
--

INSERT INTO `it_support` (`id`, `nama`, `email`, `nik`, `alamat`, `perusahaan`, `departemen`, `jabatan`, `jk`, `tanggal_lahir`, `tempat_lahir`, `no_telepon`, `foto_profile`, `slug`, `created_at`, `updated_at`) VALUES
(1, '-', '-', '-', '-', '-', 'IT', 'IT SUPPORT', '-', '2001-01-01', '-', '-', '-', '-', '2022-01-24', '2022-01-24'),
(2, 'Kaesang', 'kaesang_pramada@gmail.com', '18630102', 'Binuang, Blok C', 'BMBBD', 'IT', 'IT SUPPORT', 'Laki-Laki', '1993-03-03', 'Jakarta utara', '082155303141', '1643317049_4676a012559c34e5a6e1.jpg', 'kaesang', '2022-01-24', '2022-01-31'),
(3, 'Novi anggi', 'Novi@gmail.com', '18263272', 'Binuang', 'BMBBD', 'IT', 'IT SUPPORT', 'Laki-Laki', '2002-01-08', 'Grogot', '082617157121', '1643623782_4d24947f3bfb063e744d.jpg', 'novi-anggi', '2022-01-31', '2022-01-31'),
(5, 'Rizal Saputera', 'rizal@gmail.com', '1872903121', 'Binuang', 'BMBBD', 'IT', 'IT SUPPORT', 'Laki-Laki', '2000-02-09', 'Palangkaraya', '082155303522', '1644328393_b0e35ae873071326ca2c.jpg', 'rizal-saputera', '2022-02-08', '2022-02-08'),
(6, 'lisa anggraini', 'lisa@gmail.com', '18630111', 'Pulau Pinang', 'BMBBD', 'IT', 'IT SUPPORT', 'Perempuan', '1988-02-17', 'Bandung', '082165361511', '1644328471_e8f03bffca5f81286970.jpg', 'lisa-anggraini', '2022-02-08', '2022-02-08'),
(7, 'Zidan', 'zidane@gmail.com', '18630222', 'Binuang', 'BMBBD', 'IT', 'IT SUPPORT', 'Laki-Laki', '1992-04-09', 'Banjarmasin', '082155303510', '1644328536_3509bc67757dc1aa58c4.jpg', 'zidan', '2022-02-08', '2022-02-08');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `kode_jabatan` varchar(100) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `kode_jabatan`, `nama_jabatan`) VALUES
(1, 'J0001', 'ACCOUNTING ADMIN'),
(2, 'J0002', 'ACCOUNTING STAFF'),
(3, 'J0003', 'ACCOUNTING SUPERVISOR'),
(4, 'J0004', 'ADMIN ACCOUNTING'),
(5, 'J0005', 'ADMIN CSR'),
(6, 'J0006', 'ADMIN GA'),
(7, 'J0007', 'ADMIN PURCHASING'),
(8, 'J0008', 'ADMIN SHE'),
(9, 'J0009', 'ADMIN STOCKPILE'),
(10, 'J0010', 'BISNIS DEVELOPMENT HEAD DIVISION'),
(11, 'J0011', 'BLASTING SUPERVISOR'),
(12, 'J0012', 'BOARD OF DIRECTOR'),
(13, 'J0013', 'CHECKER'),
(14, 'J0014', 'CHEMICAL'),
(15, 'J0015', 'COMMERCIAL ADMIN STAFF'),
(16, 'J0016', 'COMMERCIAL DEPT. HEAD'),
(17, 'J0017', 'COMMERCIAL SECTION HEAD'),
(18, 'J0018', 'COMPLIANCE LEGAL DEPT HEAD'),
(19, 'J0019', 'CP-1 CREW'),
(20, 'J0020', 'CP-1 GROUP LEADER'),
(21, 'J0021', 'CP-2 CREW'),
(22, 'J0022', 'CP-2 GROUP LEADER'),
(23, 'J0023', 'CP-4 CREW'),
(24, 'J0024', 'CP-4 GROUP LEADER'),
(25, 'J0025', 'CPP SECTION HEAD'),
(26, 'J0026', 'DEPT HEAD HRGA'),
(27, 'J0027', 'DOCUMENT SHIPPING DEPT. HEAD'),
(28, 'J0028', 'DOCUMENT SHIPPING STAFF'),
(29, 'J0029', 'DOMESTIC SUPERVISOR'),
(30, 'J0030', 'DRIVER'),
(31, 'J0031', 'ELECTRICMAN'),
(32, 'J0032', 'ENGINEERING SPECIALIST'),
(33, 'J0033', 'ENGINEERING STAFF'),
(34, 'J0034', 'ENVIRO CREW'),
(35, 'J0035', 'ENVIRO GROUP LEADER'),
(36, 'J0036', 'ER & CSR GROUP LEADER'),
(37, 'J0037', 'ER & CSR SUPERVISOR'),
(38, 'J0038', 'ER & LEGAL ADMIN'),
(39, 'J0039', 'ER SPECIALIST'),
(40, 'J0040', 'FAT DIV. HEAD'),
(41, 'J0041', 'FIELD PRODUCTION ENGINEERING CREW'),
(42, 'J0042', 'FIELD PRODUCTION ENGINEERING GROUP LEADER'),
(43, 'J0043', 'FIN & ACC ADMIN'),
(44, 'J0044', 'FIN & ACC GROUP LEADER'),
(45, 'J0045', 'FIN & ACC SECTION HEAD'),
(46, 'J0046', 'FIN & ACC SUPERVISOR'),
(47, 'J0047', 'FINANCE & BUDGET DEPT. HEAD'),
(48, 'J0048', 'FINANCE ADMIN'),
(49, 'J0049', 'FINANCE STAFF'),
(50, 'J0050', 'FINANCE SUPERVISOR'),
(51, 'J0051', 'GA GROUP LEADER'),
(52, 'J0052', 'GA SUPERVISOR'),
(53, 'J0053', 'GM MARKETING'),
(54, 'J0054', 'GROUP LEADER'),
(55, 'J0055', 'HAULING ROAD GROUP LEADER'),
(56, 'J0056', 'HR ADMIN'),
(57, 'J0057', 'HR GROUP LEADER'),
(58, 'J0058', 'HRGA ADMIN'),
(59, 'J0059', 'HRM CREW'),
(60, 'J0060', 'HRM DEPT. HEAD'),
(61, 'J0061', 'HRM GROUP LEADER'),
(62, 'J0062', 'HRM SECTION HEAD'),
(63, 'J0063', 'HRM SUPERVISOR'),
(64, 'J0064', 'HUMAS'),
(65, 'J0065', 'IT SUPPORT'),
(66, 'J0066', 'KEPALA GUDANG HANDAK'),
(67, 'J0067', 'KEPALA SECURITY'),
(68, 'J0068', 'KTT KOORDINATOR'),
(69, 'J0069', 'LEGAL STAFF'),
(70, 'J0070', 'MINE PLAN GROUP LEADER'),
(71, 'J0071', 'MONITORING CONTROL ADMIN'),
(72, 'J0072', 'MONITORING CONTROL GROUP LEADER'),
(73, 'J0073', 'OPERATIONAL DEPT. HEAD'),
(74, 'J0074', 'OPERATIONAL STAFF'),
(75, 'J0075', 'PARAMEDIC'),
(76, 'J0076', 'PORT CREW'),
(77, 'J0077', 'PORT GROUP LEADER'),
(78, 'J0078', 'PORT SECTION HEAD'),
(79, 'J0079', 'PRODUCTION ENGINEERING DEPT. HEAD'),
(80, 'J0080', 'PRODUCTION ENGINEERING PORT ADMIN'),
(81, 'J0081', 'PRODUCTION ENGINEERING PORT GROUP LEADER'),
(82, 'J0082', 'PRODUCTION ENGINEERING SECTION HEAD'),
(83, 'J0083', 'PURCHASING'),
(84, 'J0084', 'QUALITY CONTROL CREW'),
(85, 'J0085', 'QUALITY CONTROL GROUP LEADER'),
(86, 'J0086', 'QUALITY CONTROL SECTION HEAD'),
(87, 'J0087', 'QUALITY CONTROL STAFF'),
(88, 'J0088', 'SECURITY'),
(89, 'J0089', 'SECURITY ADMIN'),
(90, 'J0090', 'SENIOR TRAFFIC'),
(91, 'J0091', 'SHE DEPT. HEAD'),
(92, 'J0092', 'SHE MINING CREW'),
(93, 'J0093', 'SHE MINING GROUP LEADER'),
(94, 'J0094', 'SHE OFFICER'),
(95, 'J0095', 'SHE PORT CREW'),
(96, 'J0096', 'SHE PORT GROUP LEADER'),
(97, 'J0097', 'SHE SPECIALIST'),
(98, 'J0098', 'SHIPPING MASTER LOADING SECTION HEAD'),
(99, 'J0099', 'SITE MANAGER'),
(100, 'J0100', 'STAFF ACCOUNTING'),
(101, 'J0101', 'STAFF ENGINEERING'),
(102, 'J0102', 'STAFF LEGAL'),
(103, 'J0103', 'SURVEY CREW'),
(104, 'J0104', 'SURVEY SUPERVISOR'),
(105, 'J0105', 'TIM PENGAMANAN'),
(106, 'J0106', 'TRANSHIPMENT CREW'),
(107, 'J0107', 'TRANSHIPMENT GROUP LEADER'),
(108, 'J0108', 'TRANSHIPMENT SUPERVISOR'),
(109, '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `id_departemen` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `alamat` varchar(1000) NOT NULL,
  `perusahaan` varchar(100) NOT NULL,
  `jk` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `no_telepon` varchar(100) NOT NULL,
  `foto_profile` varchar(100) NOT NULL DEFAULT 'default.png',
  `slug` varchar(100) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `id_departemen`, `id_jabatan`, `nama`, `email`, `nik`, `alamat`, `perusahaan`, `jk`, `tanggal_lahir`, `tempat_lahir`, `no_telepon`, `foto_profile`, `slug`, `created_at`, `updated_at`) VALUES
(1, 12, 6, 'Nursahid Arya Suyudi', 'Nursahid.arya21@gmail.com', '18630757', 'Teransad, Block C, No.30', 'BMBBD', 'Laki-laki', '2000-07-05', 'Banjarmasin selatan', '082155303526', '1642962091_f280777bf318791d66f7.jpg', 'nursahid-arya-suyudi', '2022-01-23', '2022-01-31'),
(2, 16, 69, 'Sita Adistiana', 'Sita@gmail.com', '18630029', 'Binuang, Pantai Selatan', 'BMBBD', 'Perempuan', '1997-02-17', 'Palangkaraya', '082155303512', '1643009338_3d9237ce688915c5d605.png', 'sita-adistiana', '2022-01-24', '2022-01-27'),
(3, 8, 43, 'SRI', 'sri@gmail', '1003040001', 'Tapin Selatan', 'BMBBD', 'Perempuan', '2000-01-23', '-', '-', 'default.png', 'SRI-WENDA', '2022-01-31', '2022-01-31'),
(4, 9, 47, 'AINA  ', 'aina@gmail', '0202050033', 'Binuang', 'BMBBD', 'Perempuan', '2000-05-21', '-', '-', 'default.png', 'AINA-', '2022-01-31', '2022-01-31'),
(5, 2, 12, 'LUMAN ANDY ', 'luman@gmail', '0811512639', 'Banjarbaru', 'BMBBD', 'Laki-laki', '2000-04-26', '-', '-', 'default.png', 'LUMAN-ANDY', '2022-01-31', '2022-01-31'),
(6, 3, 15, 'RATNA SARI RIMBA', 'ratna@gmail', '1005080003', 'Balangan', 'BMBBD', 'Perempuan', '2000-02-21', '-', '-', 'default.png', 'RATNA-SARI', '2022-01-31', '2022-01-31'),
(7, 3, 16, 'EDWIN JULIANTIO ', 'edwin@gmail', '1005080002', 'Kotabaru', 'BMBBD', 'Laki-laki', '2000-09-22', '-', '-', 'default.png', 'EDWIN-JULIANTIO', '2022-01-31', '2022-01-31'),
(8, 4, 25, 'tri', 'tri@gmail', '0707080001', 'Jakarta', 'BMBBD', 'Laki-laki', '1999-01-20', '-', '-', 'default.png', 'TRI-MARGONO', '2022-01-31', '2022-01-31'),
(9, 3, 17, 'HANI AGUSTINA H', 'hani@gmail', '1009080009', 'Sampit', 'BMBBD', 'Perempuan', '2000-01-25', '-', '-', 'default.png', 'HANI-AGUSTINA', '2022-01-31', '2022-01-31'),
(10, 5, 27, 'WAHYU KURNIAWAN ', 'wahyu@gmail', '1009080012', 'Binuang', 'BMBBD', 'Laki-laki', '2000-01-28', '-', '-', 'default.png', 'WAHYU-KURNIAWAN', '2022-01-31', '2022-01-31'),
(11, 2, 12, 'abdul', 'abdul@gmail', '1009080005', 'Sungai Danau', 'BMBBD', 'Laki-laki', '2000-01-28', '-', '-', 'default.png', 'ABDUL-AZIS', '2022-01-31', '2022-01-31'),
(12, 19, 84, 'SAIFUL RACHMAN ', 'saiful@gmail', '1009080011', 'Bandung', 'BMBBD', 'Laki-laki', '2000-01-28', '-', '-', 'default.png', 'SAIFUL-RACHMAN', '2022-01-31', '2022-01-31'),
(13, 19, 98, 'DANY DIAN WIDIATMOKO', 'dany@gmail', '1009080007', 'Simpang ampat', 'BMBBD', 'Laki-laki', '2000-01-28', '-', '-', 'default.png', 'DANY-DIAN', '2022-01-31', '2022-01-31'),
(14, 3, 64, 'MUKTAR  ', 'muktar@gmail', '1103090002', 'Kotabaru', 'BMBBD', 'Laki-laki', '2000-01-28', '-', '-', 'default.png', 'MUKTAR-', '2022-01-31', '2022-01-31'),
(15, 26, 106, 'AHMAD WAHYU SUSANTO', 'ahmad@gmail', '0903090002', 'Sampit', 'BMBBD', 'Laki-laki', '2000-01-28', '-', '-', 'default.png', 'AHMAD-WAHYU', '2022-01-31', '2022-01-31'),
(16, 26, 107, 'KOMARUDIN  ', 'komarudin@gmail', '1003090013', 'Sungai Selatan', 'BMBBD', 'Laki-laki', '2000-01-28', '-', '-', 'default.png', 'KOMARUDIN-', '2022-01-31', '2022-01-31'),
(17, 22, 103, 'NUUR KHAALISH HASANI', 'nuur@gmail', '1110090004', 'Pantai', 'BMBBD', 'Laki-laki', '2000-01-28', '-', '-', 'default.png', 'NUUR-KHAALISH', '2022-01-31', '2022-01-31'),
(18, 25, 91, 'GIYARNO  ', 'giyarno@gmail', '1001100017', 'Banjarmasin', 'BMB', 'Laki-laki', '2000-01-28', '-', '-', 'default.png', 'GIYARNO-', '2022-01-31', '2022-01-31'),
(19, 3, 30, 'KEMEN HERMAWAN ', 'kemen@gmail', '1001100027', 'Gambut', 'BMBBD', 'Laki-laki', '2000-01-28', '-', '-', 'default.png', 'KEMEN-HERMAWAN', '2022-01-31', '2022-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_permintaan`
--

CREATE TABLE `penilaian_permintaan` (
  `id` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_permintaan` int(11) NOT NULL,
  `penilaian` varchar(50) NOT NULL,
  `komentar` varchar(1500) NOT NULL,
  `progress` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penilaian_permintaan`
--

INSERT INTO `penilaian_permintaan` (`id`, `id_karyawan`, `id_permintaan`, `penilaian`, `komentar`, `progress`) VALUES
(1, 2, 4, '', '', '90'),
(2, 2, 5, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan`
--

CREATE TABLE `permintaan` (
  `id` int(11) NOT NULL,
  `kode_permintaan` varchar(100) NOT NULL,
  `benefit` varchar(1500) NOT NULL,
  `detail_masalah` varchar(1500) NOT NULL,
  `img_lampiran` varchar(100) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_it_support` int(11) NOT NULL,
  `id_analisis` int(11) NOT NULL,
  `id_prioritas` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_lampiran` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `till_date` date NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permintaan`
--

INSERT INTO `permintaan` (`id`, `kode_permintaan`, `benefit`, `detail_masalah`, `img_lampiran`, `id_karyawan`, `id_it_support`, `id_analisis`, `id_prioritas`, `id_kategori`, `id_lampiran`, `id_status`, `start_date`, `till_date`, `created_at`, `updated_at`) VALUES
(4, 'REQ-18630029-1', 'akakka', 'aplikasi tidak berjalann', 'default.png', 2, 2, 2, 3, 1, 5, 1, '2022-02-02', '2022-02-24', '2022-02-21', '2022-02-21'),
(5, 'REQ-18630029-2', 'tidak dapat melakukan pekerjaan', 'monitor rusak', 'default.png', 2, 2, 2, 1, 1, 5, 3, '2022-02-10', '2022-03-04', '2022-02-21', '2022-02-21');

-- --------------------------------------------------------

--
-- Table structure for table `sub_permintaan`
--

CREATE TABLE `sub_permintaan` (
  `id` int(11) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `lampiran` varchar(100) NOT NULL,
  `prioritas` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_permintaan`
--

INSERT INTO `sub_permintaan` (`id`, `kategori`, `lampiran`, `prioritas`, `status`) VALUES
(1, 'Hardware', 'Budget/Circulait', 'Rendah', 'diterima'),
(2, 'Software', 'Memo', 'Sedang', 'Selesai'),
(3, 'Network', 'Proposal', 'Tinggi', 'Ditolak'),
(4, '', 'Spesifikasi/Foto', '-', 'Belum Ditanggapi'),
(5, '', 'Lain/lain', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `level_user` varchar(20) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `nik`, `level_user`, `password_hash`, `created_at`, `updated_at`) VALUES
(1, '-', '00000000', 'admin', '00000000', NULL, NULL),
(2, 'Nursahid Arya Suyudi', '18630757', 'admin', '$2y$10$S8h5ZtpQCW2VD9RkryUuc.3wDXtsyTkfa0tcd5a/Eo0BYU4.PsLnW', '2022-01-23 12:25:43', '2022-01-31 05:45:21'),
(3, 'Sita Adistiana', '18630029', 'user(Karyawan)', '$2y$10$JyL/sqEhmYmPxwVYfhQA9uD7O0DUZEb3d67na9fZSMghJMeacMsVO', '2022-01-24 01:29:29', '2022-01-27 16:01:50'),
(4, 'Kaesang', '18630102', 'user(IT)', '$2y$10$JVd2aM4XHXC4Hleps3QIkelYyGJu1dLWEn5D9hyycKWgtJFIeQVey', '2022-01-24 11:26:43', '2022-01-31 05:55:12'),
(6, 'Novi anggi', '18263272', 'user(IT)', '$2y$10$bNW.n5xR7wJcnL3cQKV0EeuwVR5XG4Jygl8JxCTR0BjwXttmfYEV6', '2022-02-03 16:12:45', '2022-02-03 16:12:45'),
(7, 'LUMAN ANDY ', '0811512639', 'user(Karyawan)', '$2y$10$Who4pMqWdlPbOgOC6nL.Ye6fexhbyBzMIiD5TXyEOu.QjrAhtnjZS', '2022-02-03 16:16:54', '2022-02-03 16:16:54'),
(8, 'KOMARUDIN  ', '1003090013', 'user(Karyawan)', '$2y$10$aMFOP7Pm6.IM3cTo65inEeJ2GgqAuscpARImNbQ7ANYha.Fv8fTZi', '2022-02-08 07:56:16', '2022-02-08 07:56:16'),
(9, 'Zidan', '18630222', 'user(IT)', '$2y$10$oh2ngsAElMbQmFmbEUppC.aa8bldmGHPv4vgG3TRXrzIdG/z77Pm6', '2022-02-08 07:56:46', '2022-02-08 07:56:46'),
(10, 'lisa anggraini', '18630111', 'user(IT)', '$2y$10$RULd7Nl4ozCZPtZO4uCTeehkkBgisNBckL6sY0yF4HNdNvGgbQSTy', '2022-02-08 07:57:11', '2022-02-08 07:57:11'),
(11, 'Rizal Saputera', '1872903121', 'user(IT)', '$2y$10$rUqhInlUSccWDGrwvtcwtuww5HkbextPaudUzja3Kzg1xTqWon9ce', '2022-02-08 07:57:34', '2022-02-08 07:57:34'),
(12, 'EDWIN JULIANTIO ', '1005080002', 'user(Karyawan)', '$2y$10$JugSb32zhKN11kBR5uCtm.eerxgby1OAlbhe2QiI0zD9gpDGGcKjm', '2022-02-08 07:58:25', '2022-02-08 07:58:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `it_support`
--
ALTER TABLE `it_support`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_departemen` (`id_departemen`),
  ADD KEY `id_departemen_2` (`id_departemen`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `penilaian_permintaan`
--
ALTER TABLE `penilaian_permintaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `id_permintaan` (`id_permintaan`);

--
-- Indexes for table `permintaan`
--
ALTER TABLE `permintaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `id_prioritas` (`id_prioritas`),
  ADD KEY `id_analisis` (`id_analisis`),
  ADD KEY `id_it_support` (`id_it_support`),
  ADD KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `id_lampiran` (`id_lampiran`);

--
-- Indexes for table `sub_permintaan`
--
ALTER TABLE `sub_permintaan`
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
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `it_support`
--
ALTER TABLE `it_support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `penilaian_permintaan`
--
ALTER TABLE `penilaian_permintaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permintaan`
--
ALTER TABLE `permintaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sub_permintaan`
--
ALTER TABLE `sub_permintaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `departemen_1` FOREIGN KEY (`id_departemen`) REFERENCES `departemen` (`id`),
  ADD CONSTRAINT `jabatan_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id`);

--
-- Constraints for table `penilaian_permintaan`
--
ALTER TABLE `penilaian_permintaan`
  ADD CONSTRAINT `karyawan_3` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_permintaan_2` FOREIGN KEY (`id_permintaan`) REFERENCES `permintaan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permintaan`
--
ALTER TABLE `permintaan`
  ADD CONSTRAINT `itsupport_1` FOREIGN KEY (`id_it_support`) REFERENCES `it_support` (`id`),
  ADD CONSTRAINT `karyawan_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`),
  ADD CONSTRAINT `permintaan_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `sub_permintaan` (`id`),
  ADD CONSTRAINT `permintaan_ibfk_3` FOREIGN KEY (`id_prioritas`) REFERENCES `sub_permintaan` (`id`),
  ADD CONSTRAINT `permintaan_ibfk_4` FOREIGN KEY (`id_status`) REFERENCES `sub_permintaan` (`id`),
  ADD CONSTRAINT `permintaan_ibfk_5` FOREIGN KEY (`id_lampiran`) REFERENCES `sub_permintaan` (`id`),
  ADD CONSTRAINT `permintaan_ibfk_6` FOREIGN KEY (`id_analisis`) REFERENCES `sub_permintaan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
