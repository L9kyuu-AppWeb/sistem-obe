-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 04, 2025 at 02:58 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_obe`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_kajian`
--

CREATE TABLE `bahan_kajian` (
  `id_bahan_kajian` int NOT NULL,
  `kode` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `id_fakultas` int NOT NULL,
  `id_program_studi` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `bahan_kajian`
--

INSERT INTO `bahan_kajian` (`id_bahan_kajian`, `kode`, `keterangan`, `id_fakultas`, `id_program_studi`) VALUES
(4, 'BK01', 'Virtual System and Services', 3, 3),
(5, 'BK02', 'Internet of things', 3, 3),
(6, 'BK03', 'Computer Network', 3, 3),
(7, 'BK04', 'Integrated System Technology', 3, 3),
(8, 'BK05', 'Platform Technologies', 3, 3),
(9, 'BK06', 'Platform-based application development', 3, 3),
(10, 'BK07', 'Cybersecurity Principles\r\n', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `bahan_kajian_detail`
--

CREATE TABLE `bahan_kajian_detail` (
  `id_bahan_kajian_detail` int NOT NULL,
  `id_bahan_kajian` int NOT NULL,
  `id_capaian_pembelajaran_lulusan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `bahan_kajian_detail`
--

INSERT INTO `bahan_kajian_detail` (`id_bahan_kajian_detail`, `id_bahan_kajian`, `id_capaian_pembelajaran_lulusan`) VALUES
(4, 4, 5),
(5, 4, 8),
(6, 5, 7),
(7, 6, 7),
(8, 7, 7);

-- --------------------------------------------------------

--
-- Table structure for table `capaian_pembelajaran_lulusan`
--

CREATE TABLE `capaian_pembelajaran_lulusan` (
  `id_capaian_pembelajaran_lulusan` int NOT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `keterangan` text,
  `id_fakultas` int DEFAULT NULL,
  `id_program_studi` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `capaian_pembelajaran_lulusan`
--

INSERT INTO `capaian_pembelajaran_lulusan` (`id_capaian_pembelajaran_lulusan`, `kode`, `keterangan`, `id_fakultas`, `id_program_studi`) VALUES
(4, 'CPL01', 'Mempunyai pengetahuan matematika, computing, dan ilmu pengetahuan lain yang relevan untuk menyelesaikan permasalahan computing yang kompleks dengan pendekatan teknologi informasi.', 3, 3),
(5, 'CPL02', 'Mampu menganalisis, mengidentifikasi, dan mendefinisikan permasalahan computing yang kompleks, dan memberikan pendekatan teknologi informasi sebagai solusi penyelesaian permasalahan tersebut.', 3, 3),
(6, 'CPL03', 'Mampu merancang, mengimplementasi, dan mengevaluasi solusi berbasis computing yang sesuai dengan kebutuhan dan solusi teknologi informasi yang diusulkan menggunakan sumberdaya, sarana, dan cara-cara computing modern.', 3, 3),
(7, 'CPL04', 'Mampu memilih, mengintegrasikan, dan mengadministrasikan infrastruktur teknologi informasi sebagai solusi penyelesaian permasalahan computing yang kompleks.', 3, 3),
(8, 'CPL05', 'Mampu mengimplementasikan, mengelola, dan mengamankan sistem dan informasi yang didistribusikan melalui jaringan komputer untuk menjamin kerahasiaan, integritas, dan ketersediaan informasi.', 3, 3),
(9, 'CPL06', 'Mampu menunjukan sikap jujur, berintegritas,  sadar privasi dan taat hukum dalam menjalankan profesinya.', 3, 3),
(10, 'CPL07', 'Mampu berkomunikasi dan bekerja sama secara efektif baik sebagai anggota maupun pemimpin unit kerja dalam organisasi.', 3, 3),
(11, 'CPL08', 'Mampu berfikir kritis dan sistematis dalam menyusun deskripsi saintifik berupa karya ilmiah.', 3, 3),
(12, 'CPL09', 'Mampu merancang, mengimplementasi dan mengevaluasi tata kelola teknologi informasi dengan mempertimbangkan kebutuhan user.', 3, 3),
(13, 'CPL10', 'Mampu merancang, membuat, mengoperasikan, dan mengevaluasi perangkat lunak untuk memberikan solusi atas permasalahan yang dihadapi user.', 3, 3),
(14, 'CPL11', 'Mampu menganalisis, mengidentifikasi, dan mendefinisikan kebutuhan perangkat lunak dan perangkat keras di berbagai sistem berbasis komputer.', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `capaian_pembelajaran_lulusan_detail`
--

CREATE TABLE `capaian_pembelajaran_lulusan_detail` (
  `id_capaian_pembelajaran_lulusan_detail` int NOT NULL,
  `id_capaian_pembelajaran_lulusan` int NOT NULL,
  `id_profil_lulusan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `capaian_pembelajaran_lulusan_detail`
--

INSERT INTO `capaian_pembelajaran_lulusan_detail` (`id_capaian_pembelajaran_lulusan_detail`, `id_capaian_pembelajaran_lulusan`, `id_profil_lulusan`) VALUES
(7, 4, 6),
(8, 4, 8),
(9, 4, 9),
(10, 4, 10),
(11, 5, 6),
(12, 5, 8),
(13, 6, 7);

-- --------------------------------------------------------

--
-- Table structure for table `cpmk`
--

CREATE TABLE `cpmk` (
  `id_cpmk` int NOT NULL,
  `id_capaian_pembelajaran_lulusan` int NOT NULL,
  `kode` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `id_fakultas` int NOT NULL,
  `id_program_studi` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cpmk`
--

INSERT INTO `cpmk` (`id_cpmk`, `id_capaian_pembelajaran_lulusan`, `kode`, `keterangan`, `id_fakultas`, `id_program_studi`) VALUES
(8, 4, 'CPMK011', 'Mampu menguasai konsep dasar matematika dan statistika.', 3, 3),
(9, 4, 'CPMK012', 'Mampu menguasai konsep dasar computing dalam bidang teknologi informasi.', 3, 3),
(10, 4, 'CPMK013', 'Mampu menguasai konsep dasar keahlian khusus dalam bidang teknologi informasi.', 3, 3),
(11, 4, 'CPMK014', 'Mampu menyelesaikan permasalahan computing yang kompleks dengan pendekatan teknologi informasi.', 3, 3),
(12, 5, 'CPMK021', 'Mampu menganalisis, mengidentifikasi dan mendefinisikan permasalahan computing yang kompleks.', 3, 3),
(13, 5, 'CPMK022', 'Mampu memberikan pendekatan teknologi informasi sebagai solusi penyelesaian permasalah tersebut.', 3, 3),
(14, 6, 'CPMK031', 'Mampu merancang solusi berbasis computing yang sesuai dengan kebutuhan dan solusi teknologi informasi yang diusulkan menggunakan sumberdaya, sarana dan cara-cara computing modern.', 3, 3),
(15, 6, 'CPMK032', 'Mampu mengimplementasikan solusi berbasis computing yang sesuai dengan kebutuhan dan solusi teknologi informasi yang diusulkan menggunakan sumberdaya, sarana dan cara-cara computing modern.', 3, 3),
(16, 6, 'CPMK033', 'Mampu mengevaluasi solusi berbasis computing yang sesuai dengan kebutuhan dan solusi teknologi informasi yang diusulkan menggunakan sumberdaya, sarana dan cara-cara computing modern.', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` int NOT NULL,
  `nidn` varchar(50) DEFAULT NULL,
  `nuptk` varchar(50) DEFAULT NULL,
  `keterangan` text,
  `id_fakultas` int DEFAULT NULL,
  `id_program_studi` int DEFAULT NULL,
  `status` enum('Internal','Eksternal') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `nidn`, `nuptk`, `keterangan`, `id_fakultas`, `id_program_studi`, `status`) VALUES
(3, '1234567890', '2021123456', 'Dr. Ahmad Fauzi, M.Kom', 3, 3, 'Internal'),
(4, '0987654321', '2021654321', 'Ir. Budi Santoso, M.T', 3, 3, 'Eksternal'),
(5, '1122334455', '2021987654', 'Prof. Siti Aminah, Ph.D', 3, 3, 'Internal'),
(6, '6677889900', '2021765432', 'Dr. Rina Handayani, M.Kom', 3, 3, 'Eksternal'),
(7, '3344556677', '2021432167', 'Dr. Andi Saputra, M.T', 3, 3, 'Internal'),
(8, '5566778899', '2021998877', 'Dr. Lestari Dewi, M.Kom', 3, 3, 'Internal'),
(9, '7788990011', '2021223344', 'Dr. Bambang Prasetyo, M.Kom', 3, 3, 'Eksternal'),
(10, '8899001122', '2021778899', 'Dr. Nabila Zahra, M.Kom', 3, 3, 'Internal');

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id_fakultas` int NOT NULL,
  `nama_fakultas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id_fakultas`, `nama_fakultas`) VALUES
(3, 'Saintek dan Teknologi'),
(4, 'Fakultas Teknik'),
(5, 'Fakultas Ilmu Komputer'),
(6, 'Fakultas Ekonomi dan Bisnis');

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `id_matakuliah` int NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `sks` int DEFAULT NULL,
  `semester` tinyint DEFAULT NULL,
  `tanggal_penyusunan` date DEFAULT NULL,
  `id_dosen_pengembang_rps` int DEFAULT NULL,
  `id_dosen_ketua_program_studi` int DEFAULT NULL,
  `deskripsi_singkat` text,
  `tautan_kelas_daring` varchar(255) DEFAULT NULL,
  `id_fakultas` int DEFAULT NULL,
  `id_program_studi` int DEFAULT NULL
) ;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`id_matakuliah`, `keterangan`, `kode`, `sks`, `semester`, `tanggal_penyusunan`, `id_dosen_pengembang_rps`, `id_dosen_ketua_program_studi`, `deskripsi_singkat`, `tautan_kelas_daring`, `id_fakultas`, `id_program_studi`) VALUES
(16, 'Pemrograman Dasar', 'MK001', 3, 1, '2024-01-15', 3, 4, 'Mempelajari dasar-dasar pemrograman menggunakan bahasa Python.', 'https://kelas.daring/mk001', 3, 3),
(17, 'Struktur Data', 'MK002', 4, 2, '2024-02-20', 5, 6, 'Mempelajari struktur data seperti list, stack, queue, dan tree.', 'https://kelas.daring/mk002', 3, 3),
(18, 'Basis Data', 'MK003', 3, 3, '2024-03-10', 7, 8, 'Memahami konsep dan implementasi basis data relasional.', 'https://kelas.daring/mk003', 3, 3),
(19, 'Sistem Operasi', 'MK004', 3, 4, '2024-04-05', 9, 10, 'Mempelajari konsep dasar sistem operasi dan manajemen sumber daya.', 'https://kelas.daring/mk004', 3, 3),
(20, 'Jaringan Komputer', 'MK005', 3, 5, '2024-05-15', 4, 5, 'Dasar-dasar jaringan komputer dan protokol komunikasi.', 'https://kelas.daring/mk005', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah_sub_cpmk`
--

CREATE TABLE `matakuliah_sub_cpmk` (
  `id_matakuliah_sub_cpmk` int NOT NULL,
  `id_matakuliah` int NOT NULL,
  `id_sub_cpmk` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `matakuliah_sub_cpmk`
--

INSERT INTO `matakuliah_sub_cpmk` (`id_matakuliah_sub_cpmk`, `id_matakuliah`, `id_sub_cpmk`) VALUES
(1, 16, 1),
(2, 16, 5),
(3, 16, 6),
(4, 16, 11),
(5, 16, 18),
(6, 16, 19),
(7, 16, 14),
(8, 16, 15),
(9, 16, 3);

-- --------------------------------------------------------

--
-- Table structure for table `organisasi_matakuliah`
--

CREATE TABLE `organisasi_matakuliah` (
  `id_organisasi_matakuliah` int NOT NULL,
  `keterangan` text,
  `id_fakultas` int DEFAULT NULL,
  `id_program_studi` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profil_lulusan`
--

CREATE TABLE `profil_lulusan` (
  `id_profil_lulusan` int NOT NULL,
  `kode` varchar(5) NOT NULL,
  `keterangan` text NOT NULL,
  `id_fakultas` int NOT NULL,
  `id_program_studi` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `profil_lulusan`
--

INSERT INTO `profil_lulusan` (`id_profil_lulusan`, `kode`, `keterangan`, `id_fakultas`, `id_program_studi`) VALUES
(6, 'PL01', 'Profesional teknologi informasi yang mampu menggunakan pengetahuan computing untuk menganalisis permasalahan computing yang kompleks dan memberikan solusi dengan pendekatan teknologi informasi.', 3, 3),
(7, 'PL02', 'Profesional teknologi informasi yang mampu merancang, mengimplementasi, mengintegrasi, mengevaluasi sistem berbasis komputer, termasuk aspek keamanan komputer/siber.', 3, 3),
(8, 'PL03', 'Profesional teknologi informasi yang memilki kemampuan dalam tata kelola teknologi informasi dengan mempertimbangkan kebutuhan user.', 3, 3),
(9, 'PL04', 'Profesional teknologi informasi yang mampu berkomunikasi dan bekerja sama secara efektif baik sebagai anggota maupun pemimpin unit kerja dalam organisasi.', 3, 3),
(10, 'PL05', 'Profesional teknologi informasi yang memiliki sikap jujur, berintegritas,  sadar privasi dan taat hukum dalam menjalankan profesinya.', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `program_studi`
--

CREATE TABLE `program_studi` (
  `id_program_studi` int NOT NULL,
  `nama_prodi` varchar(100) NOT NULL,
  `id_fakultas` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `program_studi`
--

INSERT INTO `program_studi` (`id_program_studi`, `nama_prodi`, `id_fakultas`) VALUES
(3, 'Teknologi Informasi', 3),
(4, 'Sistem Informasi', 3);

-- --------------------------------------------------------

--
-- Table structure for table `sub_cpmk`
--

CREATE TABLE `sub_cpmk` (
  `id_sub_cpmk` int NOT NULL,
  `id_cpmk` int NOT NULL,
  `kode` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `id_fakultas` int NOT NULL,
  `id_program_studi` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sub_cpmk`
--

INSERT INTO `sub_cpmk` (`id_sub_cpmk`, `id_cpmk`, `kode`, `keterangan`, `id_fakultas`, `id_program_studi`) VALUES
(1, 8, 'SUB-CPMK0111', 'Mampu menjelaskan konsep dasar matematika dan statistika.', 3, 3),
(2, 8, 'SUB-CPMK0112', 'Mampu mengimplentasikan konsep dasar matematika dan statistika.', 3, 3),
(3, 8, 'SCPMK081', 'Menggunakan logika matematika dalam pemrograman.', 3, 3),
(4, 8, 'SCPMK082', 'Menghitung peluang dalam studi kasus data.', 3, 3),
(5, 9, 'SCPMK091', 'Memahami arsitektur komputer dasar.', 3, 3),
(6, 9, 'SCPMK092', 'Menjelaskan konsep algoritma dasar.', 3, 3),
(7, 10, 'SCPMK101', 'Menguasai dasar-dasar pengembangan web.', 3, 3),
(8, 10, 'SCPMK102', 'Mengimplementasikan program sederhana dengan bahasa pemrograman.', 3, 3),
(9, 11, 'SCPMK111', 'Mengidentifikasi kebutuhan pengguna untuk solusi IT.', 3, 3),
(10, 11, 'SCPMK112', 'Menganalisis permasalahan dengan pendekatan teknologi.', 3, 3),
(11, 11, 'SCPMK113', 'Mengusulkan solusi inovatif berbasis IT.', 3, 3),
(12, 12, 'SCPMK121', 'Mengumpulkan data untuk identifikasi masalah.', 3, 3),
(13, 12, 'SCPMK122', 'Membuat deskripsi masalah secara sistematis.', 3, 3),
(14, 13, 'SCPMK131', 'Memilih teknologi yang sesuai untuk masalah tertentu.', 3, 3),
(15, 13, 'SCPMK132', 'Menyusun solusi berdasarkan pendekatan komputasi.', 3, 3),
(16, 14, 'SCPMK141', 'Membuat rancangan arsitektur sistem.', 3, 3),
(17, 14, 'SCPMK142', 'Memilih metode pengembangan perangkat lunak yang tepat.', 3, 3),
(18, 15, 'SCPMK151', 'Mengembangkan sistem sesuai spesifikasi kebutuhan.', 3, 3),
(19, 15, 'SCPMK152', 'Mengintegrasikan komponen sistem secara efisien.', 3, 3),
(20, 16, 'SCPMK161', 'Menggunakan metrik evaluasi sistem.', 3, 3),
(21, 16, 'SCPMK162', 'Melakukan uji coba dan validasi hasil implementasi.', 3, 3),
(22, 16, 'SCPMK163', 'Menyusun laporan evaluasi sistem berbasis IT.', 3, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_kajian`
--
ALTER TABLE `bahan_kajian`
  ADD PRIMARY KEY (`id_bahan_kajian`),
  ADD KEY `id_fakultas` (`id_fakultas`),
  ADD KEY `id_program_studi` (`id_program_studi`);

--
-- Indexes for table `bahan_kajian_detail`
--
ALTER TABLE `bahan_kajian_detail`
  ADD PRIMARY KEY (`id_bahan_kajian_detail`),
  ADD KEY `id_bahan_kajian` (`id_bahan_kajian`),
  ADD KEY `id_capaian_pembelajaran_lulusan` (`id_capaian_pembelajaran_lulusan`);

--
-- Indexes for table `capaian_pembelajaran_lulusan`
--
ALTER TABLE `capaian_pembelajaran_lulusan`
  ADD PRIMARY KEY (`id_capaian_pembelajaran_lulusan`);

--
-- Indexes for table `capaian_pembelajaran_lulusan_detail`
--
ALTER TABLE `capaian_pembelajaran_lulusan_detail`
  ADD PRIMARY KEY (`id_capaian_pembelajaran_lulusan_detail`),
  ADD KEY `id_capaian_pembelajaran_lulusan` (`id_capaian_pembelajaran_lulusan`),
  ADD KEY `id_profil_lulusan` (`id_profil_lulusan`);

--
-- Indexes for table `cpmk`
--
ALTER TABLE `cpmk`
  ADD PRIMARY KEY (`id_cpmk`),
  ADD KEY `fk_cpl` (`id_capaian_pembelajaran_lulusan`),
  ADD KEY `fk_fakultas` (`id_fakultas`),
  ADD KEY `fk_program_studi` (`id_program_studi`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id_fakultas`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`id_matakuliah`),
  ADD KEY `id_dosen_pengembang_rps` (`id_dosen_pengembang_rps`),
  ADD KEY `id_dosen_ketua_program_studi` (`id_dosen_ketua_program_studi`),
  ADD KEY `id_fakultas` (`id_fakultas`),
  ADD KEY `id_program_studi` (`id_program_studi`);

--
-- Indexes for table `matakuliah_sub_cpmk`
--
ALTER TABLE `matakuliah_sub_cpmk`
  ADD PRIMARY KEY (`id_matakuliah_sub_cpmk`),
  ADD KEY `fk_matakuliah_sub_cpmk_matakuliah` (`id_matakuliah`),
  ADD KEY `fk_matakuliah_sub_cpmk_sub_cpmk` (`id_sub_cpmk`);

--
-- Indexes for table `organisasi_matakuliah`
--
ALTER TABLE `organisasi_matakuliah`
  ADD PRIMARY KEY (`id_organisasi_matakuliah`),
  ADD KEY `fk_organisasi_fakultas` (`id_fakultas`),
  ADD KEY `fk_organisasi_program` (`id_program_studi`);

--
-- Indexes for table `profil_lulusan`
--
ALTER TABLE `profil_lulusan`
  ADD PRIMARY KEY (`id_profil_lulusan`),
  ADD KEY `id_fakultas` (`id_fakultas`),
  ADD KEY `id_program_studi` (`id_program_studi`);

--
-- Indexes for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD PRIMARY KEY (`id_program_studi`),
  ADD KEY `id_fakultas` (`id_fakultas`);

--
-- Indexes for table `sub_cpmk`
--
ALTER TABLE `sub_cpmk`
  ADD PRIMARY KEY (`id_sub_cpmk`),
  ADD KEY `id_cpmk` (`id_cpmk`),
  ADD KEY `id_fakultas` (`id_fakultas`),
  ADD KEY `id_program_studi` (`id_program_studi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan_kajian`
--
ALTER TABLE `bahan_kajian`
  MODIFY `id_bahan_kajian` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bahan_kajian_detail`
--
ALTER TABLE `bahan_kajian_detail`
  MODIFY `id_bahan_kajian_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `capaian_pembelajaran_lulusan`
--
ALTER TABLE `capaian_pembelajaran_lulusan`
  MODIFY `id_capaian_pembelajaran_lulusan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `capaian_pembelajaran_lulusan_detail`
--
ALTER TABLE `capaian_pembelajaran_lulusan_detail`
  MODIFY `id_capaian_pembelajaran_lulusan_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cpmk`
--
ALTER TABLE `cpmk`
  MODIFY `id_cpmk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id_fakultas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `matakuliah`
--
ALTER TABLE `matakuliah`
  MODIFY `id_matakuliah` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `matakuliah_sub_cpmk`
--
ALTER TABLE `matakuliah_sub_cpmk`
  MODIFY `id_matakuliah_sub_cpmk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `organisasi_matakuliah`
--
ALTER TABLE `organisasi_matakuliah`
  MODIFY `id_organisasi_matakuliah` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `profil_lulusan`
--
ALTER TABLE `profil_lulusan`
  MODIFY `id_profil_lulusan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `program_studi`
--
ALTER TABLE `program_studi`
  MODIFY `id_program_studi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_cpmk`
--
ALTER TABLE `sub_cpmk`
  MODIFY `id_sub_cpmk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bahan_kajian`
--
ALTER TABLE `bahan_kajian`
  ADD CONSTRAINT `bahan_kajian_ibfk_1` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id_fakultas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bahan_kajian_ibfk_2` FOREIGN KEY (`id_program_studi`) REFERENCES `program_studi` (`id_program_studi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bahan_kajian_detail`
--
ALTER TABLE `bahan_kajian_detail`
  ADD CONSTRAINT `bahan_kajian_detail_ibfk_1` FOREIGN KEY (`id_bahan_kajian`) REFERENCES `bahan_kajian` (`id_bahan_kajian`) ON DELETE CASCADE,
  ADD CONSTRAINT `bahan_kajian_detail_ibfk_2` FOREIGN KEY (`id_capaian_pembelajaran_lulusan`) REFERENCES `capaian_pembelajaran_lulusan` (`id_capaian_pembelajaran_lulusan`) ON DELETE CASCADE;

--
-- Constraints for table `capaian_pembelajaran_lulusan_detail`
--
ALTER TABLE `capaian_pembelajaran_lulusan_detail`
  ADD CONSTRAINT `capaian_pembelajaran_lulusan_detail_ibfk_1` FOREIGN KEY (`id_capaian_pembelajaran_lulusan`) REFERENCES `capaian_pembelajaran_lulusan` (`id_capaian_pembelajaran_lulusan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `capaian_pembelajaran_lulusan_detail_ibfk_2` FOREIGN KEY (`id_profil_lulusan`) REFERENCES `profil_lulusan` (`id_profil_lulusan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cpmk`
--
ALTER TABLE `cpmk`
  ADD CONSTRAINT `fk_cpl` FOREIGN KEY (`id_capaian_pembelajaran_lulusan`) REFERENCES `capaian_pembelajaran_lulusan` (`id_capaian_pembelajaran_lulusan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_fakultas` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id_fakultas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_program_studi` FOREIGN KEY (`id_program_studi`) REFERENCES `program_studi` (`id_program_studi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD CONSTRAINT `matakuliah_ibfk_1` FOREIGN KEY (`id_dosen_pengembang_rps`) REFERENCES `dosen` (`id_dosen`),
  ADD CONSTRAINT `matakuliah_ibfk_2` FOREIGN KEY (`id_dosen_ketua_program_studi`) REFERENCES `dosen` (`id_dosen`),
  ADD CONSTRAINT `matakuliah_ibfk_3` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id_fakultas`),
  ADD CONSTRAINT `matakuliah_ibfk_4` FOREIGN KEY (`id_program_studi`) REFERENCES `program_studi` (`id_program_studi`);

--
-- Constraints for table `matakuliah_sub_cpmk`
--
ALTER TABLE `matakuliah_sub_cpmk`
  ADD CONSTRAINT `fk_matakuliah_sub_cpmk_matakuliah` FOREIGN KEY (`id_matakuliah`) REFERENCES `matakuliah` (`id_matakuliah`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_matakuliah_sub_cpmk_sub_cpmk` FOREIGN KEY (`id_sub_cpmk`) REFERENCES `sub_cpmk` (`id_sub_cpmk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `organisasi_matakuliah`
--
ALTER TABLE `organisasi_matakuliah`
  ADD CONSTRAINT `fk_organisasi_fakultas` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id_fakultas`),
  ADD CONSTRAINT `fk_organisasi_program` FOREIGN KEY (`id_program_studi`) REFERENCES `program_studi` (`id_program_studi`);

--
-- Constraints for table `profil_lulusan`
--
ALTER TABLE `profil_lulusan`
  ADD CONSTRAINT `profil_lulusan_ibfk_1` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id_fakultas`),
  ADD CONSTRAINT `profil_lulusan_ibfk_2` FOREIGN KEY (`id_program_studi`) REFERENCES `program_studi` (`id_program_studi`);

--
-- Constraints for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD CONSTRAINT `program_studi_ibfk_1` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id_fakultas`);

--
-- Constraints for table `sub_cpmk`
--
ALTER TABLE `sub_cpmk`
  ADD CONSTRAINT `sub_cpmk_ibfk_1` FOREIGN KEY (`id_cpmk`) REFERENCES `cpmk` (`id_cpmk`) ON DELETE CASCADE,
  ADD CONSTRAINT `sub_cpmk_ibfk_2` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id_fakultas`) ON DELETE CASCADE,
  ADD CONSTRAINT `sub_cpmk_ibfk_3` FOREIGN KEY (`id_program_studi`) REFERENCES `program_studi` (`id_program_studi`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
