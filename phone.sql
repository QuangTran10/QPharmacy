-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2022 at 02:06 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phone`
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
(1, 1, 1, 0, 33390000, 33390000);

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
-- Table structure for table `chitietphieunhap`
--

CREATE TABLE `chitietphieunhap` (
  `MaPhieu` int(11) NOT NULL,
  `MSHH` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `DonGia` double NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chitietphieunhap`
--

INSERT INTO `chitietphieunhap` (`MaPhieu`, `MSHH`, `SoLuong`, `DonGia`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 32000000, '2022-11-23 14:40:49', '2022-11-23 14:40:49');

--
-- Triggers `chitietphieunhap`
--
DELIMITER $$
CREATE TRIGGER `insert_chitietphieutnhap` BEFORE INSERT ON `chitietphieunhap` FOR EACH ROW UPDATE hanghoa SET SoLuongHang = SoLuongHang + new.SoLuong WHERE MSHH = new.MSHH
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `danhmuc`
--

CREATE TABLE `danhmuc` (
  `MaDM` int(11) NOT NULL,
  `TenDanhMuc` varchar(255) NOT NULL,
  `MaLoaiHang` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `danhmuc`
--

INSERT INTO `danhmuc` (`MaDM`, `TenDanhMuc`, `MaLoaiHang`, `created_at`, `updated_at`) VALUES
(1, 'Android', 1, '2022-11-23 07:23:25', '2022-11-23 07:23:25'),
(2, 'Iphone( IOS)', 1, '2022-11-23 07:23:44', '2022-11-23 07:23:44'),
(3, 'Điện thoại phổ thông', 1, '2022-11-23 07:23:56', '2022-11-23 07:23:56'),
(4, 'Sạc dự phòng', 5, '2022-11-23 07:25:52', '2022-11-23 07:25:52'),
(5, 'Ốp lưng', 5, '2022-11-23 07:29:32', '2022-11-23 07:29:32'),
(6, 'Cáp, sạc', 5, '2022-11-23 07:29:41', '2022-11-23 07:29:41'),
(7, 'Tai nghe Bluetooth', 3, '2022-11-23 07:30:17', '2022-11-23 07:30:17'),
(8, 'Tai nghe có dây', 3, '2022-11-23 08:12:35', '2022-11-23 08:12:35'),
(9, 'Macbook', 2, '2022-11-23 08:12:01', '2022-11-23 08:12:01'),
(10, 'Laptop Gaming', 2, '2022-11-23 08:12:59', '2022-11-23 08:12:59'),
(11, 'Laptop văn phòng', 2, '2022-11-23 08:12:51', '2022-11-23 08:12:51');

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
  `TinhTrang` int(15) DEFAULT NULL,
  `GhiChu` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `MaThanhToan` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dathang`
--

INSERT INTO `dathang` (`SoDonDH`, `MSKH`, `MSNV`, `HoTen`, `SDT`, `DiaChiGH`, `ThanhTien`, `NgayDH`, `NgayGH`, `TinhTrang`, `GhiChu`, `MaThanhToan`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Trần Thanh Quang', '0859083181', '180 Triệu Nương, Thị trấn Mỹ Xuyên, huyện Mỹ Xuyên, tỉnh Sóc Trăng', 33390000, '2022-11-23 19:40:10', NULL, 3, NULL, 1, '2022-11-23 19:40:10', '2022-11-23 19:40:10');

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
(1, 1, 'Trần Thanh Quang', '0859083181', '180 Triệu Nương, Thị trấn Mỹ Xuyên, huyện Mỹ Xuyên, tỉnh Sóc Trăng');

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
  `MaNSX` int(11) DEFAULT NULL,
  `MaDM` int(11) NOT NULL,
  `MoTa` mediumblob DEFAULT NULL,
  `HinhAnh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TrangThai` int(11) NOT NULL,
  `TG_Tao` datetime NOT NULL,
  `TG_CapNhat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hanghoa`
--

INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `Gia`, `GiamGia`, `SoLuongHang`, `MaNSX`, `MaDM`, `MoTa`, `HinhAnh`, `TrangThai`, `TG_Tao`, `TG_CapNhat`) VALUES
(1, 'iPhone 14 Pro Max 128GB | Chính hãng VN/A', 33390000, 0, 10, 1, 2, 0x3c703e6950686f6e652031342050726f204d6178206c266167726176653b206de1baab7520666c616773686970206ee1bb95692062e1baad74206e68e1baa5742063e1bba761204170706c652074726f6e67206ce1baa76e207472e1bb9f206ce1baa169206ec4836d20323032322076e1bb9b69206e6869e1bb81752063e1baa369207469e1babf6e2076e1bb812063266f636972633b6e67206e6768e1bb872063c5a96e67206e68c6b02076e1babb206e676f266167726176653b692063616f2063e1baa5702c2073616e67206368e1baa36e682068e1bba3702076e1bb9b69206775207468e1baa96d206de1bbb920c491e1baa169206368267561637574653b6e672e204e68e1bbaf6e6720636869e1babf6320c49169e1bb876e2074686fe1baa16920c491e1babf6e2074e1bbab206e68266167726176653b2054266161637574653b6f204b687579e1babf74206e68e1baad6e20c491c6b0e1bba3632072e1baa574206e6869e1bb81752073e1bbb1206be1bbb32076e1bb8d6e672063e1bba761207468e1bb8b207472c6b0e1bb9d6e67206e6761792074e1bbab206b6869206368c6b061207261206de1baaf742e2056e1baad79206c69e1bb8775206e68e1bbaf6e6720636869e1babf6320666c61677368697020c491e1babf6e2074e1bbab2063266f636972633b6e672074792063266f636972633b6e67206e6768e1bb872068266167726176653b6e6720c491e1baa775207468e1babf206769e1bb9b69206e266167726176653b792063266f61637574653b206c266167726176653b6d2062e1baa16e207468e1baa5742076e1bb8d6e673f2043267567726176653b6e67206b68266161637574653b6d207068266161637574653b206e68e1bbaf6e6720c49169e1bb8175207468267561637574653b2076e1bb8b2076e1bb81206950686f6e652031342050726f204d617820e1bb9f2062266167726176653b69207669e1babf742064c6b0e1bb9b6920c4912661636972633b79206e68266561637574653b2e3c2f703e, 'b_c_1_91669164807.png', 1, '2022-11-23 07:53:27', '2022-11-23 15:34:11'),
(2, 'iPhone 14 Pro Max 256GB | Chính hãng VN/A', 37490000, 0, 0, 1, 2, NULL, 'b_c_1_111669165729.png', 0, '2022-11-23 08:08:49', '2022-11-23 08:08:49'),
(3, 'Apple MacBook Air M1 256GB 2020 I Chính hãng Apple Việt Nam', 22790000, 0, 0, 7, 9, 0x3c68323e3c7374726f6e673e4d6163626f6f6b20416972204d312032303230202d2053616e67207472e1bb8d6e672c2074696e682074e1babf2c206869e1bb8775206ec4836e67206b68e1bba76e673c2f7374726f6e673e3c2f68323e0d0a0d0a3c703e4c266167726176653b2064266f67726176653b6e672073e1baa36e207068e1baa96d2063266f61637574653b20746869e1babf74206be1babf206de1bb8f6e67206e68e1bab92c2073616e67207472e1bb8d6e672076266167726176653b2074696e682074e1babf2063267567726176653b6e672076e1bb9b6920c491266f61637574653b206c266167726176653b206769266161637574653b207468266167726176653b6e68207068e1baa369206368c4836e67206e2665636972633b6e204d6163426f6f6b2041697220c491266174696c64653b207468752068267561637574653b7420c491c6b0e1bba36320c491266f636972633b6e6720c491e1baa36f206e67c6b0e1bb9d692064267567726176653b6e6720792665636972633b75207468266961637574653b63682076266167726176653b206ce1bbb161206368e1bb8d6e2e204de1bb99742074726f6e67206e68e1bbaf6e67207068692665636972633b6e2062e1baa36e206de1bb9b69206e68e1baa574206d266167726176653b206b68266161637574653b63682068266167726176653b6e67206b68266f636972633b6e67207468e1bb832062e1bb8f20717561206b686920c491e1babf6e2076e1bb9b692043656c6c70686f6e655320c491266f61637574653b206c266167726176653b266e6273703b3c7374726f6e673e4d6163426f6f6b20416972204d313c2f7374726f6e673e2e2044c6b0e1bb9b6920c4912661636972633b79206c266167726176653b20636869207469e1babf742076e1bb8120746869e1babf74206be1babf2c2063e1baa5752068266967726176653b6e682063e1bba761206d266161637574653b792e3c2f703e0d0a0d0a3c68333e3c7374726f6e673e546869e1babf74206be1babf2074696e682074e1babf2c206368e1baa574206c69e1bb8775206e68266f636972633b6d2062e1bb816e2062e1bb893c2f7374726f6e673e3c2f68333e0d0a0d0a3c703e3c7374726f6e673e4d6163426f6f6b20416972266e6273703b32303230204d313c2f7374726f6e673e266e6273703b6de1bb9b692076e1baab6e206c75266f636972633b6e2074752661636972633b6e207468e1bba720747269e1babf74206c267961637574653b20746869e1babf74206be1babf2076e1bb9b69206e68e1bbaf6e6720c491c6b0e1bb9d6e67206e266561637574653b7420c491c6a16e206e68c6b06e672076266f636972633b2063267567726176653b6e672073616e67207472e1bb8d6e672e204d266161637574653b792063266f61637574653b20c491e1bb99206de1bb8f6e67206e68e1bab9206368e1bb8920312c32396b672076266167726176653b2063266161637574653b632063e1baa16e68207472266167726176653b6e207669e1bb816e206b6869e1babf6e20746869e1babf742062e1bb8b207472e1bb9f206e2665636972633b6e20c491e1bab9702068c6a16e2076266167726176653b2063616f2063e1baa5702068c6a16e2e3c2f703e, 'macbook-air-gold-select-201810_41669165894.jpg', 0, '2022-11-23 08:11:34', '2022-11-23 08:13:22');

-- --------------------------------------------------------

--
-- Table structure for table `hinhanh`
--

CREATE TABLE `hinhanh` (
  `id` int(11) NOT NULL,
  `MSHH` int(11) NOT NULL,
  `HinhAnh` varchar(300) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hinhanh`
--

INSERT INTO `hinhanh` (`id`, `MSHH`, `HinhAnh`, `created_at`, `updated_at`) VALUES
(1, 1, 't_m_181669164807.png', '2022-11-23 07:53:27', '2022-11-23 07:53:27'),
(2, 1, 'v_ng_18_11669164807.png', '2022-11-23 07:53:27', '2022-11-23 07:53:27'),
(3, 1, 'x_m_251669165617.png', '2022-11-23 08:06:57', '2022-11-23 08:06:57'),
(4, 2, 't_m_201669165729.png', '2022-11-23 08:08:49', '2022-11-23 08:08:49'),
(5, 2, 'v_ng_201669165729.png', '2022-11-23 08:08:49', '2022-11-23 08:08:49'),
(6, 2, 'x_m_261669165729.png', '2022-11-23 08:08:49', '2022-11-23 08:08:49'),
(7, 3, 'macbook-air-space-gray-select-2018101669165894.jpg', '2022-11-23 08:11:34', '2022-11-23 08:11:34');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `MSKH` int(11) NOT NULL,
  `HoTenKH` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
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
(1, 'Trần Thanh Quang', 1, 29, 10, 2000, '0859083181', 'qtran8219@gmail.com', 'quangquang', '25d55ad283aa400af464c76d713c07ad', 1, '2022-11-23 18:30:19', '2022-11-23 18:30:19');

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
(1, 'Điện Thoại', 1, '2022-11-23 07:19:39', '2022-11-23 07:19:39'),
(2, 'Laptop', 1, '2022-11-23 07:19:44', '2022-11-23 07:19:44'),
(3, 'Âm Thanh', 1, '2022-11-23 07:20:03', '2022-11-23 07:20:03'),
(4, 'Đồng Hồ', 1, '2022-11-23 07:20:10', '2022-11-23 07:20:10'),
(5, 'Phụ Kiện', 1, '2022-11-23 07:20:17', '2022-11-23 07:20:17');

-- --------------------------------------------------------

--
-- Table structure for table `nhacungcap`
--

CREATE TABLE `nhacungcap` (
  `MaNCC` int(11) NOT NULL,
  `TenNCC` varchar(255) NOT NULL,
  `DiaChi` text NOT NULL,
  `SDT` varchar(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nhacungcap`
--

INSERT INTO `nhacungcap` (`MaNCC`, `TenNCC`, `DiaChi`, `SDT`, `created_at`, `updated_at`) VALUES
(1, 'Cửa Hàng Điện Thoại Iphone Vinh Shop', '87 Bis Đinh Tiên Hoàng, Phường 3, Quận Bình Thạnh, Tp. Hồ Chí Minh (TPHCM) , Việt Nam', '0909012346', '2022-11-23 14:10:15', '2022-11-23 14:30:11'),
(2, 'Hệ Thống Phân Phối Chính Hãng Xiaomi - Công Ty TNHH Mi Home', '261 Lê Lợi, P. Lê Lợi, Q. Ngô Quyền,Tp. Hải Phòng', '0888888261', '2022-11-23 14:14:30', '2022-11-23 14:14:30'),
(3, 'Thegioididong.com', 'Tòa nhà MWG - Lô T2-1.2, Đường D1, Khu Công nghệ Cao, P. Tân Phú, Thành phố Thủ Đức, Thành phố Hồ Chí Minh', '02838125960', '2022-11-23 14:17:05', '2022-11-23 14:17:05'),
(4, 'CellphoneS', '350-352 Võ Văn Kiệt, Phường Cô Giang, Quận 1, Thành phố Hồ Chí Minh', '02871089666', '2022-11-23 14:18:35', '2022-11-23 14:18:35');

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
(1, 'Hoàng Phúc', 1, 'phuc12345@gmail.com', 'Phường Hưng Lợi, Quận Ninh Kiều, Thành phố Cần Thơ ', '0919020017 ', 8, 11, 2000, 'Admin', 'phucphuc', 'e10adc3949ba59abbe56e057f20f883e', '', 1, '2022-11-22 12:22:18');

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
(1, 'Iphone', 1, '2022-11-22 18:27:28', '2022-11-22 18:27:28'),
(2, 'Samsung', 1, '2022-11-22 18:27:40', '2022-11-22 18:27:40'),
(3, 'Oppo', 1, '2022-11-22 18:29:25', '2022-11-22 18:29:25'),
(4, 'Vivo', 1, '2022-11-22 18:29:33', '2022-11-22 18:29:33'),
(5, 'Xiaomi', 1, '2022-11-22 18:29:43', '2022-11-22 18:29:43'),
(6, 'Realmi', 1, '2022-11-22 18:29:56', '2022-11-22 18:30:06'),
(7, 'MAC', 1, '2022-11-23 07:31:31', '2022-11-23 07:31:31'),
(8, 'HP', 1, '2022-11-23 07:31:35', '2022-11-23 07:31:35'),
(9, 'Dell', 1, '2022-11-23 07:31:40', '2022-11-23 07:31:40'),
(10, 'ASUS', 1, '2022-11-23 07:31:46', '2022-11-23 07:31:46'),
(11, 'MSI', 1, '2022-11-23 07:32:05', '2022-11-23 07:32:05'),
(12, 'Khác', 1, '2022-11-23 07:33:08', '2022-11-23 07:33:08');

-- --------------------------------------------------------

--
-- Table structure for table `phieunhap`
--

CREATE TABLE `phieunhap` (
  `MaPhieu` int(11) NOT NULL,
  `MSNV` int(11) NOT NULL,
  `ThanhTien` int(11) NOT NULL,
  `NgayLap` datetime NOT NULL,
  `MaNCC` int(11) NOT NULL,
  `GhiChu` text DEFAULT NULL,
  `TinhTrang` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phieunhap`
--

INSERT INTO `phieunhap` (`MaPhieu`, `MSNV`, `ThanhTien`, `NgayLap`, `MaNCC`, `GhiChu`, `TinhTrang`, `created_at`, `updated_at`) VALUES
(1, 1, 320000000, '2022-11-23 14:40:49', 4, NULL, 1, '2022-11-23 14:40:49', '2022-11-23 14:40:49');

-- --------------------------------------------------------

--
-- Table structure for table `thanhtoan`
--

CREATE TABLE `thanhtoan` (
  `MaThanhToan` int(11) NOT NULL,
  `TT_Ten` varchar(200) NOT NULL,
  `TT_DienGiai` text DEFAULT NULL,
  `TT_TrangThai` tinyint(4) NOT NULL,
  `TT_BankCode` varchar(255) NOT NULL,
  `TT_Code` varchar(255) NOT NULL,
  `TT_ResponseCode` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `thanhtoan`
--

INSERT INTO `thanhtoan` (`MaThanhToan`, `TT_Ten`, `TT_DienGiai`, `TT_TrangThai`, `TT_BankCode`, `TT_Code`, `TT_ResponseCode`, `created_at`, `updated_at`) VALUES
(1, 'Thanh Toán Khi Nhận Hàng', 'Thanh toan don hang', 0, '2910', 'QT2910', '0', '2022-11-23 19:40:10', '2022-11-23 19:40:10');

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
-- Indexes for table `chitietphieunhap`
--
ALTER TABLE `chitietphieunhap`
  ADD KEY `MaPhieu` (`MaPhieu`),
  ADD KEY `MSHH` (`MSHH`);

--
-- Indexes for table `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`MaDM`),
  ADD KEY `MaLoai` (`MaLoaiHang`);

--
-- Indexes for table `dathang`
--
ALTER TABLE `dathang`
  ADD PRIMARY KEY (`SoDonDH`),
  ADD KEY `MSKH` (`MSKH`),
  ADD KEY `MSNV` (`MSNV`),
  ADD KEY `MaThanhToan` (`MaThanhToan`);

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
  ADD KEY `hanghoa_ibfk_2` (`MaNSX`),
  ADD KEY `MaDM` (`MaDM`);

--
-- Indexes for table `hinhanh`
--
ALTER TABLE `hinhanh`
  ADD PRIMARY KEY (`id`),
  ADD KEY `MSHH` (`MSHH`);

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
-- Indexes for table `nhacungcap`
--
ALTER TABLE `nhacungcap`
  ADD PRIMARY KEY (`MaNCC`);

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
-- Indexes for table `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD PRIMARY KEY (`MaPhieu`),
  ADD KEY `MSNV` (`MSNV`),
  ADD KEY `MaNCC` (`MaNCC`);

--
-- Indexes for table `thanhtoan`
--
ALTER TABLE `thanhtoan`
  ADD PRIMARY KEY (`MaThanhToan`);

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
  MODIFY `MaBinhLuan` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `MaDM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `dathang`
--
ALTER TABLE `dathang`
  MODIFY `SoDonDH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `diachikh`
--
ALTER TABLE `diachikh`
  MODIFY `MaDC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hanghoa`
--
ALTER TABLE `hanghoa`
  MODIFY `MSHH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hinhanh`
--
ALTER TABLE `hinhanh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MSKH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loaihanghoa`
--
ALTER TABLE `loaihanghoa`
  MODIFY `MaLoaiHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nhacungcap`
--
ALTER TABLE `nhacungcap`
  MODIFY `MaNCC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `MSNV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nhasanxuat`
--
ALTER TABLE `nhasanxuat`
  MODIFY `MaNSX` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `phieunhap`
--
ALTER TABLE `phieunhap`
  MODIFY `MaPhieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `thanhtoan`
--
ALTER TABLE `thanhtoan`
  MODIFY `MaThanhToan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `yeuthich`
--
ALTER TABLE `yeuthich`
  MODIFY `Ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
-- Constraints for table `chitietphieunhap`
--
ALTER TABLE `chitietphieunhap`
  ADD CONSTRAINT `chitietphieunhap_ibfk_1` FOREIGN KEY (`MaPhieu`) REFERENCES `phieunhap` (`MaPhieu`),
  ADD CONSTRAINT `chitietphieunhap_ibfk_2` FOREIGN KEY (`MSHH`) REFERENCES `hanghoa` (`MSHH`);

--
-- Constraints for table `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD CONSTRAINT `danhmuc_ibfk_1` FOREIGN KEY (`MaLoaiHang`) REFERENCES `loaihanghoa` (`MaLoaiHang`);

--
-- Constraints for table `dathang`
--
ALTER TABLE `dathang`
  ADD CONSTRAINT `dathang_ibfk_1` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`),
  ADD CONSTRAINT `dathang_ibfk_2` FOREIGN KEY (`MSNV`) REFERENCES `nhanvien` (`MSNV`),
  ADD CONSTRAINT `dathang_ibfk_3` FOREIGN KEY (`MaThanhToan`) REFERENCES `thanhtoan` (`MaThanhToan`);

--
-- Constraints for table `diachikh`
--
ALTER TABLE `diachikh`
  ADD CONSTRAINT `diachikh_ibfk_1` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`);

--
-- Constraints for table `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD CONSTRAINT `hanghoa_ibfk_2` FOREIGN KEY (`MaNSX`) REFERENCES `nhasanxuat` (`MaNSX`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `hanghoa_ibfk_3` FOREIGN KEY (`MaDM`) REFERENCES `danhmuc` (`MaDM`);

--
-- Constraints for table `hinhanh`
--
ALTER TABLE `hinhanh`
  ADD CONSTRAINT `hinhanh_ibfk_1` FOREIGN KEY (`MSHH`) REFERENCES `hanghoa` (`MSHH`);

--
-- Constraints for table `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD CONSTRAINT `phieunhap_ibfk_1` FOREIGN KEY (`MSNV`) REFERENCES `nhanvien` (`MSNV`),
  ADD CONSTRAINT `phieunhap_ibfk_2` FOREIGN KEY (`MaNCC`) REFERENCES `nhacungcap` (`MaNCC`);

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
