-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20250713.781461fa87
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 31, 2025 at 06:50 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `list_pkl_ams`
--

-- --------------------------------------------------------

--
-- Table structure for table `asal_sekolah`
--

CREATE TABLE `asal_sekolah` (
  `id` int NOT NULL,
  `nama_sekolah` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asal_sekolah`
--

INSERT INTO `asal_sekolah` (`id`, `nama_sekolah`) VALUES
(1, 'SMKN 1 Kota Bekasi'),
(2, 'SMK Bina Budi Luhur Bogor'),
(3, 'SMKN 9 Kota Bekasi'),
(4, 'SMKN 3 Jakarta'),
(7, 'SMKN 54 Jakarta'),
(8, 'SMKN Diponegoro 1 Jakarta');

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `id` int NOT NULL,
  `nama_batch` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`id`, `nama_batch`) VALUES
(1, 'Batch 1'),
(2, 'Batch 2');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_panggilan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `periode_mulai` date DEFAULT NULL,
  `periode_selesai` date DEFAULT NULL,
  `no_telepon` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci,
  `batch_id` int NOT NULL,
  `asal_sekolah_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nama_lengkap`, `jenis_kelamin`, `nama_panggilan`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `periode_mulai`, `periode_selesai`, `no_telepon`, `email`, `keterangan`, `batch_id`, `asal_sekolah_id`) VALUES
(1, 'Krismania Dwi Harjanti', 'Perempuan', 'Nia', 'Jakarta', '2007-04-28', 'Jl. F3 Dalam RT 007/010 No.59, Kelurahan Cempaka Baru\r\nJakarta Pusat', '2025-05-01', '2025-07-30', '0851 42085187', 'niaharjanti@gmail.com', '', 2, 7),
(2, 'Siti Fatimah', 'Perempuan', 'Fatimah', 'Cirebon', '2007-05-19', 'Jl. Ancol Selatan 2 RT 008/RW 007 Sunter Agung, Tanjung PriokJakarta Utara 19350', '2025-05-01', '2025-07-30', '0812 96947152', 'sitifatimaahhhhh26@gmail.com', '', 2, 7),
(3, 'Novi Cantika Dewi', 'Perempuan', 'Novi', 'Jakarta', '2007-11-17', 'Jl. Pisangan Lama III, RT 003/ RW 006 No.75, Pisangan Timur, Kec.Pulo GadungJakarta Timur', '2025-05-01', '2025-07-30', '0895321248161', 'nopiw.ajh17@gmail.com', '', 2, 7),
(4, 'Agna Tri Khalidan', 'Laki-laki', 'Agna', 'Bekasi', '2008-04-13', 'Jl. RD.H.Umar, Cikunir No.31, JakamulyaBekasi Selatan 17146', '2025-05-01', '2025-12-30', '0812 9003 8141', 'agnatrikhalidan@gmail.com', '', 2, 1),
(5, 'Rayyan Fadli', 'Laki-laki', 'Rayyan', 'Jakarta', '2008-01-11', 'Cluster Barokah No.17, JakasampurnaBekasi Barat 17145', '2025-05-01', '2025-12-30', '0857 66345534', 'rayyanfadli11@gmail.com', '', 2, 1),
(6, 'Najwa Rizki Amelia', 'Perempuan', 'Najwa', 'Jakarta', '2008-04-04', 'Jl. Jendral Basuki Rahmat, Rt10 Rw10 No.62 Cipinang Besar Selatan, Jakarta Timur', '2025-05-14', '2025-08-14', '0812-1089-0489', 'najwaramelia@gmail.com', '', 2, 8),
(7, 'Muhammad Hawwari Al-Ghiffari', 'Laki-laki', 'Al-Ghiffari', ' Jakarta', '2007-11-24', 'Jalan Perintis Kemerdekaan. Kelapa Gading Timur Gg, Pejuang 4 RT.003/04, Jakarta Utara', '2025-05-14', '2025-08-14', '0897-4967-848', 'mhawari52@gmail.com', '', 2, 8),
(8, 'Rakha Zahran Ghafaradhi', 'Laki-laki', 'Zahran', 'Jakarta', '2008-04-02', 'Jl. Balai Rakyat 1 No 37 RT004 RW 001 Duren Sawit Jakarta Timur', '2025-05-14', '2025-08-14', '0819-7320-1184', 'rakhazhran@gmail.com', '', 2, 8),
(9, 'Aqilah Dzakiyah', 'Perempuan', 'Aqilah', 'Jakarta', '2008-02-14', 'Jatinegara lio Rt.08/03 No.11 Kec.Cakung Jakarta Timur', '2025-05-14', '2025-08-14', '0882-1037-9626', 'aqilahdzakiyah207@gmail.com', '', 2, 8),
(10, 'Mufid Ibrahim', 'Laki-laki', 'Mufid', 'Bekasi', '2008-05-05', 'Villa Indah Permai blok H5/10 RT/RW 06/36 Kel. Teluk Pucung, Kec. Bekasi Utara, Kota Bekasi 17121', '2025-07-07', '2025-09-05', '0878-8005-0632', 'nmufidibrahim@gmail.com', '', 2, 1),
(11, 'Kenzie Yasir Arrafi', 'Laki-laki', 'Kenzie', 'Bekasi', '2008-06-04', 'Jl Anggrek 5 no 342 Jakasampurna Perumnas 1, Kota Bekasi', '2025-07-07', '2025-09-05', '0812-1845-3566', 'yasirkenzie@gmail.com', '', 2, 1),
(12, 'Dimas Zully Handika', 'Laki-laki', 'Dimas', 'Jakarta', '2006-07-31', 'JL.UTAN PANJANG III, RT 004/RW 006, KELURAHAN UTAN PANJANG, KECAMATAN KEMAYORAN', '2025-07-07', '2025-09-05', '0858-8208-7798', 'dimaszully@gmail.com', '', 2, 4),
(13, 'Izul Alfi\'al Arif Darmawan', 'Laki-laki', 'Izul', 'Jakarta', '2007-12-12', 'Jl. Sunter Muara rt.17/rw.005, Kelurahan Sunter Agung, Kecamatan Tanjung Priok.', '2025-07-07', '2025-09-05', '0877-1587-3078', 'alfializul@gmail.com', '', 2, 4),
(14, 'Sophia Angela Triana Karly', 'Perempuan', 'Sophi', 'Jakarta', '2007-08-06', 'Jl.Angkasa Dalam II No.8, RT.001/RW.003, Kec. Kemayoran, Kel. Gunung Sahari Selatan', '2025-07-07', '2025-09-05', '0819-0366-4191', 'sophiakarlytugas@gmail.com', '', 2, 4),
(15, 'Siti Qonita Salma Nafisah', 'Perempuan', 'Salma', 'Jakarta', '2008-04-20', 'Jl. Kebun Jeruk 13 no 48A, Kec Tamansari, Jakarta Barat', '2025-07-07', '2025-09-05', '0857-8273-6682', 'sitiqonita.salma20@gmail.com', '', 2, 4),
(16, 'Nabila Minhatul Mawla', 'Perempuan', 'Nabila', 'Jakarta', '2007-10-26', 'Jl. Kemayoran Barat IX RT 04/ RW 09, Jakarta Pusat', '2025-07-07', '2025-09-05', '0857-8069-4445', 'nabilamawla4@gmail.com', '', 2, 4),
(17, 'Ayu Atikah Hamzah', 'Perempuan', 'Ayu', 'Jakarta', '2008-06-02', 'Jl. Skip ll RT015/RW002, Sunter Jaya, Tanjung Priok, Jakarta Utara', '2025-07-07', '2025-09-05', '0857-1705-4112', 'aaytkhz@gmail.com', '', 2, 4),
(18, 'Nabila Al-Zahra', 'Perempuan', 'Zahra', 'Jakarta', '2008-06-02', 'KP. Bugis RT004/RW004, Cempaka Baru, Kemayoran, Jakarta Pusat.', '2025-07-07', '2025-09-05', '0895-3222-96149', 'anotherzahra268@gmail.com', '', 2, 4),
(19, 'Fazar Maulana', 'Laki-laki', 'Fazar', 'Bekasi', '2007-05-14', 'Jl. Bintara 4 RT 1/ RW 1 No.28', '2024-10-21', '2025-03-31', '0895384265981', 'f4zar991@gmail.com', 'DONE', 1, 1),
(20, 'Wulandari', 'Perempuan', 'Wulan', 'Bekasi', '2006-06-04', 'Kp.Setu, Jl. Kumpi Nidan RT 005/ RW 01, Bintara Jaya, Kota Bekasi', '2024-10-21', '2025-03-31', '0895616692600', 'ulan66061@gmail.com', 'DONE', 1, 1),
(21, 'Muhammad Rassya', 'Perempuan', 'Rassya', 'Bekasi', '2006-07-13', 'Jl. Bintara 1 RT 10/ RW 002', '2024-10-21', '2025-03-31', '089603277643', 'muhammadrassya342@gmail.com', 'DONE', 1, 1),
(22, 'Risma Aisyah', 'Laki-laki', 'Risma', 'Bekasi', '2006-12-24', 'Jl. Bintara 8 RT 002/ RW 003, Bekasi Barat', '2024-10-21', '2025-03-31', '089601259011', 'rrismaaisyahh@gmail.com', 'DONE', 1, 1),
(23, 'Arya Eka Satria', 'Laki-laki', 'Arya', 'Bogor', '2007-04-04', 'Katulampa RT 04/ RW 09, Katulampa Bogor Timur, Kota Bogor', '2025-02-01', '2025-05-01', '082246091014', 'aryae3794@gmail.com', 'DONE, HANYA 1 BULAN', 1, 2),
(24, 'Ciandra Brahmana Putra', 'Laki-laki', 'Andra', 'Bandar Lampung', '2007-05-16', 'Kp.Muara RT 04/ RW 09 Sindangrasa Bogor Timur, Kota Bogor', '2025-02-01', '2025-05-01', '0895428297511', 'ciandrabrpt@gmail.com', 'DONE, HANYA 1 BULAN', 1, 2),
(25, 'M. Rehan Farel Ramadhan', 'Laki-laki', 'Rehan', 'Bogor', '2006-09-22', 'Kp. PeunDeuy RT 03/ RW 06 Pandansari, Ciawi Kabupaten Bogor', '2025-02-01', '2025-05-01', '083104155002', 'mrehanrel@gmail.com', 'DONE, HANYA 1 BULAN', 1, 2),
(26, 'Carles Rizky Irfanzah', 'Laki-laki', 'Charles', 'Bekasi', '2005-09-25', 'Kp. Utan', '2025-02-01', '2025-04-30', '082298028516', 'carlesrizky09@gmail.com', 'DONE', 1, 3),
(27, 'Arya Seno Hadi Kusuma', 'Laki-laki', 'Seno', 'Bekasi', '2005-10-27', 'Jl. Wibawamukti IV RT 003/ RW 017 Jatimekar, Jatiasih Bekasi', '2025-02-01', '2025-02-28', '085888176737', 'aryaasenoooo@gmail.com', 'dikembalikan ke sekolah/ guru karena sering tidak masuk berturut2 tanpa kabar & tdk dapat dihub.', 1, 3),
(28, 'Tubagus Satrio Nakata', 'Laki-laki', 'Rio', 'Bekasi', '2007-11-03', 'Kp. Cikunir', '2025-02-01', '2025-04-30', '0895415454151', 'riogwanteng7@gmail.com', 'DONE', 1, 3),
(29, 'Vincentinus Mayer', 'Laki-laki', 'Vincent', 'Jakarta', '2007-05-16', 'Jl. Cendana VII Blok E No.158, Cipondoh, Tangerang', '2025-03-01', '2025-04-30', '081297983637', 'vincentmayer16@gmail.com', 'Anak ke 3 dari 3 bersaudara : - bapak : debt collector - ibu : kerja swasta - kedua kakak kerja (DONE)', 1, 4),
(30, 'Fadhil Raffi Rabbani', 'Laki-laki', 'Fadhil', 'Jakarta', '2008-05-14', 'Jl. Kampung Panjang RT 05/RW 17, Kel.Rawa Panjang, Kec.Bojong Gede, Kab.Bogor', '2025-03-01', '2025-04-30', '081399928594', 'fadhillraffirabbani@gmail.com', 'Anak tunggal : - bapak : driver online - ibu : IRT (DONE)', 1, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asal_sekolah`
--
ALTER TABLE `asal_sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `batch_id` (`batch_id`),
  ADD KEY `asal_sekolah_id` (`asal_sekolah_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asal_sekolah`
--
ALTER TABLE `asal_sekolah`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`batch_id`) REFERENCES `batch` (`id`),
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`asal_sekolah_id`) REFERENCES `asal_sekolah` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
