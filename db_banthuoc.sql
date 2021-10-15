-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2021 at 02:10 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_banthuoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `binhluan`
--

CREATE TABLE `binhluan` (
  `MaBinhLuan` int(30) NOT NULL,
  `ThoiGian` datetime NOT NULL,
  `NoiDung` text NOT NULL,
  `DanhGia` int(11) NOT NULL,
  `MSKH` int(11) NOT NULL,
  `MSHH` int(11) NOT NULL,
  `TrangThai` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `binhluan`
--

INSERT INTO `binhluan` (`MaBinhLuan`, `ThoiGian`, `NoiDung`, `DanhGia`, `MSKH`, `MSHH`, `TrangThai`) VALUES
(1, '2021-10-01 09:45:30', 'Sản phẩm rất tốt', 4, 4, 23, 1),
(2, '2021-10-01 10:24:45', 'Giao hàng nhanh, Sản phẩm chất lượng', 5, 4, 23, 1),
(3, '2021-10-02 09:15:45', 'Sản phẩm rất tốt', 5, 4, 27, 1),
(6, '2021-10-02 09:18:43', 'Giao hàng nhanh chóng', 5, 4, 25, 1),
(7, '2021-10-02 09:21:12', 'Sản phẩm sử dụng an toàn', 3, 4, 41, 1),
(9, '2021-10-02 09:27:43', 'Giao hàng nhanh chóng', 5, 4, 41, 1),
(11, '2021-10-02 10:29:21', 'Sản phẩm rất tiện lợi', 4, 4, 22, 1),
(12, '2021-10-03 09:40:36', 'Sản phẩm rất tốt', 1, 5, 23, 1);

-- --------------------------------------------------------

--
-- Table structure for table `chitietdathang`
--

CREATE TABLE `chitietdathang` (
  `SoDonDH` int(11) NOT NULL,
  `MSHH` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `GiamGia` double NOT NULL,
  `GiaDatHang` int(11) NOT NULL,
  `ThanhTien` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chitietdathang`
--

INSERT INTO `chitietdathang` (`SoDonDH`, `MSHH`, `SoLuong`, `GiamGia`, `GiaDatHang`, `ThanhTien`) VALUES
(13, 16, 2, 0, 96000, 192000),
(13, 24, 1, 0, 102300, 102300),
(14, 22, 3, 0, 29500, 88500),
(14, 24, 1, 0, 102300, 102300),
(15, 37, 1, 0, 54900, 54900),
(15, 38, 2, 0, 25800, 51600),
(16, 22, 1, 0, 29500, 29500),
(16, 26, 1, 0, 34900, 34900),
(17, 16, 1, 0, 96000, 96000),
(18, 31, 1, 0, 20500, 20500),
(18, 32, 1, 0, 46000, 46000),
(18, 34, 4, 0, 64000, 256000),
(18, 35, 1, 0, 21000, 21000),
(20, 16, 2, 0.2, 96000, 153600),
(20, 22, 1, 0, 29500, 29500);

--
-- Triggers `chitietdathang`
--
DELIMITER $$
CREATE TRIGGER `sua_hang` AFTER UPDATE ON `chitietdathang` FOR EACH ROW update hanghoa set SoLuongHang=(SoLuongHang-new.SoLuong+old.SoLuong) where MSHH=old.MSHH
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `them_hang` AFTER INSERT ON `chitietdathang` FOR EACH ROW UPDATE hanghoa set SoLuongHang=SoLuongHang-new.SoLuong where MSHH=new.MSHH
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `xoa_hang` AFTER DELETE ON `chitietdathang` FOR EACH ROW update hanghoa set SoLuongHang=SoLuongHang+old.SoLuong where MSHH=old.MSHH
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `chitietphieuthu`
--

CREATE TABLE `chitietphieuthu` (
  `MaPhieu` int(11) NOT NULL,
  `MSHH` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `DonGia` double NOT NULL,
  `TG_Tao` datetime NOT NULL,
  `TG_CapNhat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chitietphieuthu`
--

INSERT INTO `chitietphieuthu` (`MaPhieu`, `MSHH`, `SoLuong`, `DonGia`, `TG_Tao`, `TG_CapNhat`) VALUES
(2, 16, 10, 96000, '2021-09-24 12:12:38', '2021-09-24 12:12:38'),
(2, 20, 50, 19200, '2021-09-24 12:12:38', '2021-09-24 12:12:38'),
(2, 21, 20, 36500, '2021-09-24 12:12:38', '2021-09-24 12:12:38'),
(2, 23, 20, 116100, '2021-09-24 12:12:38', '2021-09-24 12:12:38'),
(3, 18, 10, 20000, '2021-09-25 15:13:58', '2021-09-25 15:13:58'),
(3, 22, 20, 29500, '2021-09-25 15:13:58', '2021-09-25 15:13:58'),
(3, 24, 10, 102300, '2021-09-25 15:13:58', '2021-09-25 15:13:58'),
(3, 25, 20, 115000, '2021-09-25 15:13:58', '2021-09-25 15:13:58'),
(3, 26, 20, 34900, '2021-09-25 15:13:58', '2021-09-25 15:13:58'),
(3, 27, 20, 87100, '2021-09-25 15:13:58', '2021-09-25 15:13:58'),
(3, 28, 10, 14900, '2021-09-25 15:13:58', '2021-09-25 15:13:58'),
(3, 29, 10, 415700, '2021-09-25 15:13:58', '2021-09-25 15:13:58'),
(4, 33, 10, 54200, '2021-09-28 09:40:46', '2021-09-28 09:40:46'),
(4, 34, 20, 64000, '2021-09-28 09:40:46', '2021-09-28 09:40:46'),
(4, 35, 10, 21000, '2021-09-28 09:40:46', '2021-09-28 09:40:46'),
(4, 36, 10, 72500, '2021-09-28 09:40:46', '2021-09-28 09:40:46'),
(4, 37, 20, 54900, '2021-09-28 09:40:46', '2021-09-28 09:40:46'),
(5, 31, 20, 20500, '2021-09-28 09:42:09', '2021-09-28 09:42:09'),
(5, 32, 20, 46000, '2021-09-28 09:42:09', '2021-09-28 09:42:09'),
(6, 30, 20, 348900, '2021-09-28 09:47:41', '2021-09-28 09:47:41'),
(6, 38, 20, 25800, '2021-09-28 09:47:41', '2021-09-28 09:47:41');

-- --------------------------------------------------------

--
-- Table structure for table `dathang`
--

CREATE TABLE `dathang` (
  `SoDonDH` int(11) NOT NULL,
  `MSKH` int(11) NOT NULL,
  `MSNV` int(11) DEFAULT NULL,
  `HoTen` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `SDT` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `DiaChiGH` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ThanhTien` double NOT NULL,
  `NgayDH` datetime NOT NULL,
  `NgayGH` datetime DEFAULT NULL,
  `LoaiGH` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `TinhTrang` int(15) DEFAULT NULL,
  `TG_Tao` datetime NOT NULL,
  `TG_CapNhat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dathang`
--

INSERT INTO `dathang` (`SoDonDH`, `MSKH`, `MSNV`, `HoTen`, `SDT`, `DiaChiGH`, `ThanhTien`, `NgayDH`, `NgayGH`, `LoaiGH`, `TinhTrang`, `TG_Tao`, `TG_CapNhat`) VALUES
(13, 4, 1, 'Trần Thanh Quang', '0859083181', 'Ký túc xá A Đại học cần thơ', 324300, '2021-09-25 15:52:46', NULL, 'cash', 2, '2021-09-25 15:52:46', '2021-09-25 15:52:46'),
(14, 4, NULL, 'Trần Thanh Quang', '0859083181', 'Ký túc xá A Đại học cần thơ', 220800, '2021-09-25 15:55:13', NULL, 'cash', 3, '2021-09-25 15:55:13', '2021-09-25 15:55:13'),
(15, 5, 2, 'Trần Thanh Tân', '0918151004', '180 Triệu Nương, Thị trấn Mỹ Xuyên, huyện Mỹ Xuyên, tỉnh Sóc Trăng', 136500, '2021-10-04 18:51:42', NULL, 'cash', 1, '2021-10-04 18:51:42', '2021-10-04 18:51:42'),
(16, 5, 1, 'Trần Thanh Tân', '0918151004', '180 Triệu Nương, Thị trấn Mỹ Xuyên, huyện Mỹ Xuyên, tỉnh Sóc Trăng', 94400, '2021-10-09 14:07:17', NULL, 'cash', 1, '2021-10-09 14:07:17', '2021-10-09 14:07:17'),
(17, 5, 1, 'Trần Thanh Tân', '0918151004', '180 Triệu Nương, Thị trấn Mỹ Xuyên, huyện Mỹ Xuyên, tỉnh Sóc Trăng', 126000, '2021-10-09 14:09:20', NULL, 'cash', 1, '2021-10-09 14:09:20', '2021-10-09 14:09:20'),
(18, 5, 1, 'Trần Thanh Tân', '0918151004', '180 Triệu Nương, Thị trấn Mỹ Xuyên, huyện Mỹ Xuyên, tỉnh Sóc Trăng', 373500, '2021-10-11 07:59:31', NULL, 'cash', 1, '2021-10-11 07:59:31', '2021-10-11 07:59:31'),
(20, 4, 1, 'Trần Thanh Tân', '0859083181', '180 Triệu Nương, Thị trấn Mỹ Xuyên, huyện Mỹ Xuyên, tỉnh Sóc Trăng', 213100, '2021-10-12 16:05:12', NULL, 'cash', 1, '2021-10-12 16:05:12', '2021-10-12 16:05:12');

-- --------------------------------------------------------

--
-- Table structure for table `diachikh`
--

CREATE TABLE `diachikh` (
  `MaDC` int(11) NOT NULL,
  `MSKH` int(11) NOT NULL,
  `HoTen` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `SDT` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `DiaChi` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `diachikh`
--

INSERT INTO `diachikh` (`MaDC`, `MSKH`, `HoTen`, `SDT`, `DiaChi`) VALUES
(15, 4, 'Trần Thanh Quang', '0859083181', 'Ký túc xá A Đại học cần thơ'),
(16, 4, 'Trần Thanh Tân', '0859083181', '180 Triệu Nương, Thị trấn Mỹ Xuyên, huyện Mỹ Xuyên, tỉnh Sóc Trăng'),
(17, 5, 'Trần Thanh Tân', '0918151004', '180 Triệu Nương, Thị trấn Mỹ Xuyên, huyện Mỹ Xuyên, tỉnh Sóc Trăng');

-- --------------------------------------------------------

--
-- Table structure for table `hanghoa`
--

CREATE TABLE `hanghoa` (
  `MSHH` int(11) NOT NULL,
  `TenHH` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Gia` int(10) NOT NULL,
  `GiamGia` double NOT NULL DEFAULT 0,
  `SoLuongHang` int(10) NOT NULL,
  `MaLoaiHang` int(11) NOT NULL,
  `MaNSX` int(11) NOT NULL,
  `MaPhieu` int(11) DEFAULT NULL,
  `MoTa` mediumblob DEFAULT NULL,
  `hinhanh1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TrangThai` int(11) NOT NULL,
  `TG_Tao` datetime NOT NULL,
  `TG_CapNhat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hanghoa`
--

INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `Gia`, `GiamGia`, `SoLuongHang`, `MaLoaiHang`, `MaNSX`, `MaPhieu`, `MoTa`, `hinhanh1`, `TrangThai`, `TG_Tao`, `TG_CapNhat`) VALUES
(16, 'Paralmax Extra Boston (H/180v)', 96000, 0.1, 5, 9, 1, 2, NULL, 'name646-6879748321631017891.png', 1, '2021-09-07 19:31:31', '2021-10-12 16:19:21'),
(18, 'Gentrisone Cream Shinpoong', 20000, 0, 10, 13, 4, 3, NULL, 'name2157-5251678401631163176.png', 1, '2021-09-09 11:52:56', '2021-09-10 14:39:06'),
(20, 'Bông Y Tế Bạch Tuyết 100g', 19200, 0, 50, 15, 5, 2, NULL, 'name2008-8166521601631163639.png', 1, '2021-09-09 12:00:39', '2021-09-09 12:00:39'),
(21, 'Hapacol 250mg Dhg (H/24g)', 36500, 0.1, 20, 9, 6, 2, NULL, 'name1166-1107908311631163884.png', 1, '2021-09-09 12:04:44', '2021-10-12 16:22:00'),
(22, 'Hapacol 150mg Dhg (H/24g)', 29500, 0, 15, 9, 6, 3, NULL, 'name70-166180001631163927.png', 1, '2021-09-09 12:05:27', '2021-09-09 12:05:27'),
(23, 'Alaxan United (H/25v/4v) (Xé)', 116100, 0, 20, 9, 8, 2, NULL, 'name742-408787161631164013.png', 1, '2021-09-09 12:06:53', '2021-09-09 12:06:53'),
(24, 'Kremil-S United (H/100v)', 102300, 0, 8, 18, 8, 3, NULL, 'name2352-8295972491631164128.png', 1, '2021-09-09 12:08:48', '2021-09-09 12:09:33'),
(25, 'Decolgen Nd United Pharma (H/100v)', 115000, 0, 20, 19, 8, 3, NULL, 'name1021-8435806961631164252.png', 1, '2021-09-09 12:10:52', '2021-09-09 12:11:34'),
(26, 'Glotadol 500mg Abbott (Hộp/100viên Nén)(Hồng)', 34900, 0, 19, 9, 9, 3, NULL, 'name1384-7286234041631258196.png', 1, '2021-09-10 14:16:36', '2021-09-10 14:17:40'),
(27, 'Glotadol 650 Paracetamol (Chai/200viên Nén)', 87100, 0, 20, 9, 9, 3, NULL, 'name6931-8286788751631258322.png', 1, '2021-09-10 14:18:42', '2021-09-10 14:35:51'),
(28, 'Acyclovir Cream Stella (Tube/5gram)', 14900, 0, 10, 13, 10, 3, 0x416379636c6f766972206cc3a0206de1bb9974206368e1baa5742074c6b0c6a16e672074e1bbb1206e75636c656f73696420707572696e2074e1bb956e672068e1bba3702076e1bb9b6920686fe1baa1742074c3ad6e6820e1bba963206368e1babf20696e20766974726f2076c3a020696e207669766f207669727573204865727065732073696d706c65782074797020312c2074797020322076c3a0207669727573205661726963656c6c612d7a6f737465, '2021c7d1724b046972a420b758461bab1631708759.png', 1, '2021-09-15 19:25:59', '2021-09-15 19:25:59'),
(29, 'Kem Dưỡng Ẩm, Tái Tạo Da Rapider Turkey (T/66ml)(Date 08/2022)', 415700, 0, 10, 13, 11, 3, 0x4b656d2062c3b46920646120524150494445520d0a0d0a2d2053e1baa36e207068e1baa96d2073e1bbad2064e1bba56e672063c3b46e67207468e1bba963204d6f666578204f696c20c491e1bb996320717579e1bb816e2e0d0a0d0a2d20c490c6b0e1bba363206cc6b0752068c3a06e682074e1baa169204368c3a27520c382752e0d0a0d0a2d20436869e1babf74207875e1baa5742074e1bbab207468e1baa36f2064c6b0e1bba36320746869c3aa6e206e6869c3aa6e2e, '202159f7bb9510ed511794db986b44101631709297.png', 1, '2021-09-15 19:34:57', '2021-09-15 19:36:22'),
(30, 'Orlistat 120mg Capsules Stada (H/42v)', 348900, 0, 20, 17, 13, 6, 0x43c3b46e672064e1bba56e6720284368e1bb8920c491e1bb8b6e68290d0a4f726c69737461742064c6b0e1bba363206368e1bb8920c491e1bb8b6e682068e1bb97207472e1bba32063c3b96e672076e1bb9b69206368e1babf20c491e1bb9920c4836e206769e1baa36d206e68e1bab92063616c6f2074726f6e6720c49169e1bb8175207472e1bb8b2062e1bb876e68206e68c3a26e2062c3a96f207068c3ac2063c3b3206368e1bb892073e1bb91206b68e1bb91692063c6a1207468e1bb832028424d4920e289a5203330206b672f6dc2b22920686fe1bab7632062e1bb876e68206e68c3a26e207468e1bbab612063c3a26e2028424d4920e289a5203238206b672f6dc2b229206bc3a86d207468656f2063c3a1632079e1babf752074e1bb91206e6775792063c6a120286e68c6b02063616f20687579e1babf7420c3a1702c20c491c3a169207468c3a16f20c491c6b0e1bb9d6e672c2074c4836e67206c6970696420687579e1babf74292e204ec3aa6e206e67c6b06e6720c49169e1bb8175207472e1bb8b2076e1bb9b69206f726c697374617420736175203132207475e1baa76e206ee1babf752062e1bb876e68206e68c3a26e206b68c3b46e67207468e1bb83206769e1baa36d2074e1bb916920746869e1bb8375203525207472e1bb8d6e67206cc6b0e1bba36e672063c6a1207468e1bb8320736f2076e1bb9b69206b6869206de1bb9b692062e1baaf7420c491e1baa77520c49169e1bb8175207472e1bb8b2e, 'name12790-7584115231632796036.png', 1, '2021-09-28 09:27:16', '2021-09-28 09:27:52'),
(31, 'Stadovas Amlodipin 5mg Stella (H/30v)', 20500, 0, 19, 17, 10, 5, NULL, 'name5766-4551056001632796173.png', 1, '2021-09-28 09:29:33', '2021-09-28 09:29:33'),
(32, 'Pantostad 40 Pantoprazole 40mg Stella (Hộp/28 Viên Nang)', 46000, 0, 19, 17, 10, 5, NULL, 'name7434-1081516781632796280.png', 1, '2021-09-28 09:31:20', '2021-09-28 09:31:20'),
(33, 'Nifedipin T20 Retard 20mg Stella (H/100v)', 54200, 0, 10, 17, 14, 4, NULL, 'name3545-4303203571632796337.png', 1, '2021-09-28 09:32:17', '2021-09-28 09:35:44'),
(34, 'Amoxicillin 500 Brawn (H/100v)', 64000, 0, 16, 12, 14, 4, NULL, 'name4126-3717625361634026305.png', 0, '2021-09-28 09:35:14', '2021-10-12 15:11:45'),
(35, 'Meloxicam Tablets Bp 7.5mg Brawn (H/100v)', 21000, 0, 9, 20, 14, 4, NULL, 'name8651-3837673881632796597.png', 1, '2021-09-28 09:36:37', '2021-09-28 09:36:37'),
(36, 'Ampicillin 500 Brawn (H/100v)', 72500, 0, 10, 12, 14, 4, NULL, 'name1046-3806588201632796649.png', 1, '2021-09-28 09:37:29', '2021-09-28 09:37:29'),
(37, 'Băng Cá Nhân Hansaplast Elastic (H/100m)', 54900, 0, 19, 15, 14, 4, NULL, 'name14184-8877950471632796701.png', 1, '2021-09-28 09:38:21', '2021-09-28 09:38:21'),
(38, 'Omeprazole 20mg Stada (Hộp/30 Viên)', 25800, 0, 18, 18, 13, 6, NULL, '2021ebe7e4a54731895966bfead34f681632797199.png', 1, '2021-09-28 09:46:39', '2021-09-28 09:46:39'),
(39, 'Bio Acimin Gold Việt Đức (H/30g)', 129800, 0, 10, 11, 15, NULL, NULL, 'name1340-1449777731632797396.png', 1, '2021-09-28 09:49:56', '2021-09-28 09:49:56'),
(40, 'Bio-Acimin Fiber Việt Đức (H/30g) (Xanh Lá)', 120000, 0, 10, 11, 15, NULL, NULL, 'name1496-5262946911632797455.png', 1, '2021-09-28 09:50:55', '2021-09-28 09:50:55'),
(41, 'Decumar Gel Cvi Pharma (Tuýp/20gr)', 65300, 0, 5, 14, 16, NULL, NULL, '20217ccacbfccba4ac213b2ceaf370271632797647.png', 1, '2021-09-28 09:54:07', '2021-09-28 09:54:07'),
(42, 'Kem Yoosun Rau Má Đại Bắc (Tube/25g) (Xanh)', 19500, 0, 10, 14, 16, NULL, NULL, 'name1304-6091326511632797697.png', 1, '2021-09-28 09:54:57', '2021-09-28 09:54:57'),
(43, 'Sữa Rửa Mặt Cetaphil (C/125ml)', 111900, 0, 5, 14, 17, NULL, NULL, 'name1271-8615288091632797815.png', 1, '2021-09-28 09:56:55', '2021-09-28 09:56:55'),
(44, 'Sữa Tắm Gội Cetaphil Baby Gentle (2 In 1) (C/230ml)', 124000, 0, 5, 14, 17, NULL, NULL, 'name9236-5261549651632797863.png', 1, '2021-09-28 09:57:43', '2021-09-28 09:57:43'),
(45, 'Kem Cetaphil Face&Body Cream (H/50gr)', 228000, 0, 5, 14, 17, NULL, NULL, '20212319576c6f6de93f8b6c6312a4081632797912.png', 1, '2021-09-28 09:58:32', '2021-09-28 09:58:32'),
(46, 'Lotion Cetaphil Daily Facial Moist Spf15 (C/118ml)', 400000, 0, 5, 14, 17, NULL, NULL, 'name9215-8655821731632797991.png', 1, '2021-09-28 09:59:51', '2021-09-28 09:59:51');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `MSKH` int(11) NOT NULL,
  `HoTenKH` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `GioiTinh` int(11) NOT NULL,
  `Ngay` int(11) NOT NULL,
  `Thang` int(11) NOT NULL,
  `Nam` int(11) NOT NULL,
  `SoDienThoai` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `TaiKhoan` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `MatKhau` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `HoatDong` tinyint(4) NOT NULL,
  `TG_Tao` datetime NOT NULL,
  `TG_CapNhat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`MSKH`, `HoTenKH`, `GioiTinh`, `Ngay`, `Thang`, `Nam`, `SoDienThoai`, `Email`, `TaiKhoan`, `MatKhau`, `HoatDong`, `TG_Tao`, `TG_CapNhat`) VALUES
(4, 'Trần Thanh Quang', 1, 29, 10, 2000, '0859083181', 'qtran8219@gmail.com', 'quangquang', '790f377a3eccd349efa09e24e3df7a01', 1, '2021-09-13 09:57:08', '2021-09-17 13:42:24'),
(5, 'Trần Thanh Tân', 0, 11, 8, 2010, '0859083182', 'thanhtan1108@gmail.com', 'tan', 'e10adc3949ba59abbe56e057f20f883e', 1, '2021-10-03 09:35:00', '2021-10-03 09:35:00'),
(6, 'Nguyễn Văn Entony', 1, 7, 7, 2000, '0859083182', 'entony@gmail.com.vn', 'nguyenvanentony', '25d55ad283aa400af464c76d713c07ad', 1, '2021-10-11 16:43:29', '2021-10-11 16:43:29');

-- --------------------------------------------------------

--
-- Table structure for table `lienhe`
--

CREATE TABLE `lienhe` (
  `DiaChi` text NOT NULL,
  `Email` varchar(255) NOT NULL,
  `SoDienThoai` varchar(11) NOT NULL,
  `Open` time NOT NULL,
  `Close` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lienhe`
--

INSERT INTO `lienhe` (`DiaChi`, `Email`, `SoDienThoai`, `Open`, `Close`) VALUES
('27 Hai Bà Trưng, Phường 3, Thành phố Sóc Trăng', 'qtran8219@gmail.com', '0859083181', '08:00:00', '21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `loaihanghoa`
--

CREATE TABLE `loaihanghoa` (
  `MaLoaiHang` int(11) NOT NULL,
  `TenLoaiHang` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `TinhTrang` int(11) NOT NULL,
  `TG_Tao` datetime NOT NULL,
  `TG_CapNhat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `loaihanghoa`
--

INSERT INTO `loaihanghoa` (`MaLoaiHang`, `TenLoaiHang`, `TinhTrang`, `TG_Tao`, `TG_CapNhat`) VALUES
(9, 'Giảm Đau-Hạ Sốt', 1, '2021-09-06 09:07:49', '2021-09-20 03:24:47'),
(10, 'Kháng Sinh', 1, '2021-09-06 09:08:20', '2021-09-06 09:08:20'),
(11, 'Đường Ruột', 1, '2021-09-06 09:08:34', '2021-09-06 09:08:34'),
(12, 'Kháng Vi Sinh Vật', 1, '2021-09-06 09:08:44', '2021-09-28 09:33:56'),
(13, 'Da Liễu', 1, '2021-09-06 09:08:51', '2021-09-06 09:08:51'),
(14, 'Mỹ Phẩm', 1, '2021-09-06 09:09:00', '2021-09-06 09:09:00'),
(15, 'Vật Tư Y Tế', 1, '2021-09-06 09:09:04', '2021-09-09 13:58:08'),
(17, 'Tim Mạch', 1, '2021-09-07 04:45:53', '2021-09-07 04:45:53'),
(18, 'Dạ Dày', 1, '2021-09-09 12:09:21', '2021-09-09 12:09:21'),
(19, 'Ho, Cảm Cúm', 1, '2021-09-09 12:11:24', '2021-09-09 12:11:24'),
(20, 'Cơ Xương Khớp', 1, '2021-09-20 03:12:50', '2021-09-20 03:12:50');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MSNV` int(11) NOT NULL,
  `HoTenNV` varchar(50) NOT NULL,
  `GioiTinh` int(12) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `DiaChi` varchar(100) NOT NULL,
  `SDT` varchar(11) NOT NULL,
  `Ngay` int(11) NOT NULL,
  `Thang` int(11) NOT NULL,
  `Nam` int(11) NOT NULL,
  `ChucVu` varchar(50) NOT NULL,
  `TaiKhoan` varchar(30) NOT NULL,
  `MatKhau` varchar(60) NOT NULL,
  `Avatar` varchar(40) NOT NULL,
  `HoatDong` tinyint(4) NOT NULL,
  `TGTao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`MSNV`, `HoTenNV`, `GioiTinh`, `Email`, `DiaChi`, `SDT`, `Ngay`, `Thang`, `Nam`, `ChucVu`, `TaiKhoan`, `MatKhau`, `Avatar`, `HoatDong`, `TGTao`) VALUES
(1, 'Trần Thanh Quang', 1, 'qtran8219@gmail.com', 'Sóc trăng', '0859083181', 29, 10, 2000, 'Admin', 'quang', 'e10adc3949ba59abbe56e057f20f883e', 'avatar_macdinh.jpeg', 1, '2021-09-03 09:38:28'),
(2, 'Trần Phú Vinh', 1, 'vinhvinh2000@gmail.com', 'Kiên Giang', '0859083170', 5, 10, 2000, 'Nhân Viên', 'vinh', '81dc9bdb52d04dc20036dbd8313ed055', 'avatar_macdinh.jpeg', 1, '2021-10-06 14:13:18'),
(3, 'Nguyễn Văn Entony', 1, 'entony@gmail.com.vn', 'Bến Tre', '0918151004', 15, 7, 2000, 'Nhân Viên', 'nguyenvanentony2000', '81dc9bdb52d04dc20036dbd8313ed055', 'hinh-nen-dep-cute-21633695866.jpg', 1, '2021-10-08 09:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `nhasanxuat`
--

CREATE TABLE `nhasanxuat` (
  `MaNSX` int(11) NOT NULL,
  `TenNSX` text NOT NULL,
  `TinhTrang` int(11) NOT NULL,
  `TG_Tao` datetime NOT NULL,
  `TG_CapNhat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nhasanxuat`
--

INSERT INTO `nhasanxuat` (`MaNSX`, `TenNSX`, `TinhTrang`, `TG_Tao`, `TG_CapNhat`) VALUES
(1, 'Công Ty Cổ Phần Dược Phẩm Boston Việt Nam', 1, '2021-09-07 05:08:39', '2021-09-21 08:01:01'),
(3, 'Công Ty Cổ Phần VRG Khải Hoàn', 1, '2021-09-07 05:35:38', '2021-09-07 05:35:38'),
(4, 'Công Ty TNHH Daewoo Pharm', 1, '2021-09-08 09:43:58', '2021-09-08 09:43:58'),
(5, 'Công Ty CP Bông Bạch Tuyết', 1, '2021-09-09 11:54:16', '2021-09-09 11:54:16'),
(6, 'Công Ty Cổ Phần Dược Hậu Giang', 1, '2021-09-09 12:01:14', '2021-09-09 12:01:14'),
(7, 'Công Ty Cổ Phần US Pharma USA', 1, '2021-09-09 12:01:41', '2021-09-09 12:01:41'),
(8, 'United Laboratories', 1, '2021-09-09 12:06:20', '2021-09-09 12:06:20'),
(9, 'Công Ty Abbott Laboratories S.A', 1, '2021-09-10 14:17:31', '2021-09-10 14:17:31'),
(10, 'Công Ty TNHH Liên Doanh Stellapharm', 1, '2021-09-15 19:25:14', '2021-09-15 19:25:14'),
(11, 'BOTAFARMA HEALTH PRODCUTS LIMITED COMPANY OF COMMERCE AND INDUSTRY', 1, '2021-09-15 19:36:01', '2021-09-15 19:36:01'),
(13, 'Công Ty TNHH Stada Việt Nam', 1, '2021-09-28 09:27:37', '2021-09-28 09:27:37'),
(14, 'Công Ty TNHH Brawn Laboratories', 1, '2021-09-28 09:35:30', '2021-09-28 09:35:30'),
(15, 'Công Ty Cổ Phần Khoa Học CNC Việt Đức', 1, '2021-09-28 09:49:11', '2021-09-28 09:49:11'),
(16, 'Công Ty TNHH Đại Bắc', 1, '2021-09-28 09:53:04', '2021-09-28 09:53:04'),
(17, 'Công Ty Galderma Laboratories', 1, '2021-09-28 09:56:20', '2021-09-28 09:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `phieuthu`
--

CREATE TABLE `phieuthu` (
  `MaPhieu` int(11) NOT NULL,
  `NguoiNP` varchar(60) NOT NULL,
  `ThanhTien` double DEFAULT NULL,
  `NgayLap` datetime NOT NULL,
  `NCC` text NOT NULL,
  `GhiChu` text DEFAULT NULL,
  `TinhTrang` int(11) NOT NULL,
  `TG_Tao` datetime NOT NULL,
  `TG_CapNhat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phieuthu`
--

INSERT INTO `phieuthu` (`MaPhieu`, `NguoiNP`, `ThanhTien`, `NgayLap`, `NCC`, `GhiChu`, `TinhTrang`, `TG_Tao`, `TG_CapNhat`) VALUES
(2, 'Trần Thanh Quang', 4972000, '2021-09-24 12:12:38', 'Nhà Thuốc MT', NULL, 1, '2021-09-24 12:12:38', '2021-09-24 12:12:38'),
(3, 'Trần Thanh Quang', 10859000, '2021-09-25 15:13:58', 'Công ty Dược Hậu Giang', NULL, 1, '2021-09-25 15:13:58', '2021-09-25 15:13:58'),
(4, 'Trần Thanh Quang', 3855000, '2021-09-28 09:40:46', 'Công Ty TNHH Brawn Laboratories', NULL, 1, '2021-09-28 09:40:46', '2021-09-28 09:40:46'),
(5, 'Trần Thanh Quang', 1330000, '2021-09-28 09:42:09', 'Công Ty TNHH Liên Doanh Stellapharm', NULL, 1, '2021-09-28 09:42:09', '2021-09-28 09:42:09'),
(6, 'Trần Thanh Quang', 7494000, '2021-09-28 09:47:41', 'Công Ty TNHH Stada Việt Nam', NULL, 1, '2021-09-28 09:47:41', '2021-09-28 09:47:41');

-- --------------------------------------------------------

--
-- Table structure for table `yeuthich`
--

CREATE TABLE `yeuthich` (
  `Ma` int(11) NOT NULL,
  `MSHH` int(11) NOT NULL,
  `MSKH` int(11) NOT NULL,
  `TG_tao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `yeuthich`
--

INSERT INTO `yeuthich` (`Ma`, `MSHH`, `MSKH`, `TG_tao`) VALUES
(5, 23, 4, '2021-09-27 09:15:25'),
(7, 26, 4, '2021-09-27 09:23:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`MaBinhLuan`),
  ADD KEY `MSHH` (`MSHH`),
  ADD KEY `MSKH` (`MSKH`);

--
-- Indexes for table `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD PRIMARY KEY (`SoDonDH`,`MSHH`),
  ADD KEY `MSHH` (`MSHH`);

--
-- Indexes for table `chitietphieuthu`
--
ALTER TABLE `chitietphieuthu`
  ADD PRIMARY KEY (`MaPhieu`,`MSHH`),
  ADD KEY `MSHH` (`MSHH`);

--
-- Indexes for table `dathang`
--
ALTER TABLE `dathang`
  ADD PRIMARY KEY (`SoDonDH`),
  ADD KEY `MSKH` (`MSKH`),
  ADD KEY `MSNV` (`MSNV`);

--
-- Indexes for table `diachikh`
--
ALTER TABLE `diachikh`
  ADD PRIMARY KEY (`MaDC`),
  ADD KEY `MSKH` (`MSKH`);

--
-- Indexes for table `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD PRIMARY KEY (`MSHH`),
  ADD KEY `MaLoaiHang` (`MaLoaiHang`),
  ADD KEY `MaNSX` (`MaNSX`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MSKH`);

--
-- Indexes for table `loaihanghoa`
--
ALTER TABLE `loaihanghoa`
  ADD PRIMARY KEY (`MaLoaiHang`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MSNV`);

--
-- Indexes for table `nhasanxuat`
--
ALTER TABLE `nhasanxuat`
  ADD PRIMARY KEY (`MaNSX`);

--
-- Indexes for table `phieuthu`
--
ALTER TABLE `phieuthu`
  ADD PRIMARY KEY (`MaPhieu`);

--
-- Indexes for table `yeuthich`
--
ALTER TABLE `yeuthich`
  ADD PRIMARY KEY (`Ma`),
  ADD KEY `MSHH` (`MSHH`),
  ADD KEY `MSKH` (`MSKH`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `MaBinhLuan` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `dathang`
--
ALTER TABLE `dathang`
  MODIFY `SoDonDH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `diachikh`
--
ALTER TABLE `diachikh`
  MODIFY `MaDC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `hanghoa`
--
ALTER TABLE `hanghoa`
  MODIFY `MSHH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MSKH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `loaihanghoa`
--
ALTER TABLE `loaihanghoa`
  MODIFY `MaLoaiHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `MSNV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nhasanxuat`
--
ALTER TABLE `nhasanxuat`
  MODIFY `MaNSX` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `phieuthu`
--
ALTER TABLE `phieuthu`
  MODIFY `MaPhieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `yeuthich`
--
ALTER TABLE `yeuthich`
  MODIFY `Ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `binhluan_ibfk_1` FOREIGN KEY (`MSHH`) REFERENCES `hanghoa` (`MSHH`),
  ADD CONSTRAINT `binhluan_ibfk_2` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`);

--
-- Constraints for table `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD CONSTRAINT `chitietdathang_ibfk_1` FOREIGN KEY (`MSHH`) REFERENCES `hanghoa` (`MSHH`),
  ADD CONSTRAINT `chitietdathang_ibfk_2` FOREIGN KEY (`SoDonDH`) REFERENCES `dathang` (`SoDonDH`);

--
-- Constraints for table `chitietphieuthu`
--
ALTER TABLE `chitietphieuthu`
  ADD CONSTRAINT `chitietphieuthu_ibfk_1` FOREIGN KEY (`MaPhieu`) REFERENCES `phieuthu` (`MaPhieu`),
  ADD CONSTRAINT `chitietphieuthu_ibfk_2` FOREIGN KEY (`MSHH`) REFERENCES `hanghoa` (`MSHH`);

--
-- Constraints for table `dathang`
--
ALTER TABLE `dathang`
  ADD CONSTRAINT `dathang_ibfk_1` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`),
  ADD CONSTRAINT `dathang_ibfk_2` FOREIGN KEY (`MSNV`) REFERENCES `nhanvien` (`MSNV`);

--
-- Constraints for table `diachikh`
--
ALTER TABLE `diachikh`
  ADD CONSTRAINT `diachikh_ibfk_1` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`);

--
-- Constraints for table `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD CONSTRAINT `hanghoa_ibfk_1` FOREIGN KEY (`MaLoaiHang`) REFERENCES `loaihanghoa` (`MaLoaiHang`),
  ADD CONSTRAINT `hanghoa_ibfk_2` FOREIGN KEY (`MaNSX`) REFERENCES `nhasanxuat` (`MaNSX`);

--
-- Constraints for table `yeuthich`
--
ALTER TABLE `yeuthich`
  ADD CONSTRAINT `yeuthich_ibfk_1` FOREIGN KEY (`MSHH`) REFERENCES `hanghoa` (`MSHH`),
  ADD CONSTRAINT `yeuthich_ibfk_2` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
