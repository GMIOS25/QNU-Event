-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th10 29, 2025 lúc 08:31 AM
-- Phiên bản máy phục vụ: 9.1.0
-- Phiên bản PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qnuevent`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `AdminID` varchar(10) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `Ho` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `Ten` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `Email` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `Password` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  PRIMARY KEY (`AdminID`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`AdminID`, `Ho`, `Ten`, `Email`, `Password`) VALUES
('admin', 'YangKlee', NULL, 'dasdsads', 'admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bcsquanlylop`
--

DROP TABLE IF EXISTS `bcsquanlylop`;
CREATE TABLE IF NOT EXISTS `bcsquanlylop` (
  `MSSV` varchar(10) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `MaLop` varchar(10) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  KEY `MSSV` (`MSSV`),
  KEY `MaLop` (`MaLop`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `biendongdrl`
--

DROP TABLE IF EXISTS `biendongdrl`;
CREATE TABLE IF NOT EXISTS `biendongdrl` (
  `MaGD` int NOT NULL AUTO_INCREMENT,
  `LoaiGD` enum('Cộng','Trừ') COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `MSSV` varchar(10) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `NoiDung` text COLLATE utf8mb4_vietnamese_ci,
  `ThoiGian` datetime DEFAULT NULL,
  `SoDiem` int DEFAULT NULL,
  `MaHK` varchar(10) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  PRIMARY KEY (`MaGD`),
  KEY `MSSV` (`MSSV`),
  KEY `fk_biendongdrl_hocky` (`MaHK`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chophepsvkhoathamgia`
--

DROP TABLE IF EXISTS `chophepsvkhoathamgia`;
CREATE TABLE IF NOT EXISTS `chophepsvkhoathamgia` (
  `MaSK` int NOT NULL,
  `MaKhoa` varchar(10) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  PRIMARY KEY (`MaSK`,`MaKhoa`),
  KEY `MaKhoa` (`MaKhoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `chophepsvkhoathamgia`
--

INSERT INTO `chophepsvkhoathamgia` (`MaSK`, `MaKhoa`) VALUES
(24, 'CNTT'),
(25, 'CNTT'),
(26, 'CNTT'),
(27, 'CNTT');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diemrlsv`
--

DROP TABLE IF EXISTS `diemrlsv`;
CREATE TABLE IF NOT EXISTS `diemrlsv` (
  `MSSV` varchar(10) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `MaHK` varchar(10) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `SoDiem` int DEFAULT NULL,
  PRIMARY KEY (`MSSV`,`MaHK`),
  KEY `MaHK` (`MaHK`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dksukien`
--

DROP TABLE IF EXISTS `dksukien`;
CREATE TABLE IF NOT EXISTS `dksukien` (
  `MaLuotDK` int NOT NULL AUTO_INCREMENT,
  `MSSV` varchar(10) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `MaSK` int DEFAULT NULL,
  `ThoiGianDK` datetime DEFAULT NULL,
  `TrangThai` enum('Đăng ký','Hủy đăng ký') COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  PRIMARY KEY (`MaLuotDK`),
  KEY `MSSV` (`MSSV`),
  KEY `MaSK` (`MaSK`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `dksukien`
--

INSERT INTO `dksukien` (`MaLuotDK`, `MSSV`, `MaSK`, `ThoiGianDK`, `TrangThai`) VALUES
(23, 'sv', 24, '2025-11-25 21:58:15', 'Hủy đăng ký'),
(24, 'sv', 25, '2025-11-27 16:03:09', 'Đăng ký');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dotdanhgiarl`
--

DROP TABLE IF EXISTS `dotdanhgiarl`;
CREATE TABLE IF NOT EXISTS `dotdanhgiarl` (
  `MaDot` int NOT NULL AUTO_INCREMENT,
  `MaHK` varchar(10) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `ThoiGianMo` datetime DEFAULT NULL,
  `ThoiGianDong` datetime DEFAULT NULL,
  PRIMARY KEY (`MaDot`),
  KEY `MaHK` (`MaHK`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hocky`
--

DROP TABLE IF EXISTS `hocky`;
CREATE TABLE IF NOT EXISTS `hocky` (
  `MaHK` varchar(10) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `TenHK` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `ThoiGianBatDau` datetime DEFAULT NULL,
  `ThoiGianKetThuc` datetime DEFAULT NULL,
  PRIMARY KEY (`MaHK`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `hocky`
--

INSERT INTO `hocky` (`MaHK`, `TenHK`, `ThoiGianBatDau`, `ThoiGianKetThuc`) VALUES
('HK1(25-26)', 'Học kỳ 1 (2025-2026)', '2025-09-01 00:00:00', '2026-01-06 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoa`
--

DROP TABLE IF EXISTS `khoa`;
CREATE TABLE IF NOT EXISTS `khoa` (
  `MaKhoa` varchar(10) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `TenKhoa` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  PRIMARY KEY (`MaKhoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `khoa`
--

INSERT INTO `khoa` (`MaKhoa`, `TenKhoa`) VALUES
('CNTT', 'Khoa Công nghệ thông tin'),
('K01', 'Khoa Lý luận chính trị - Luật & Quản lý nhà nước'),
('K02', 'Khoa Khoa học tự nhiên'),
('K03', 'Khoa Khoa học xã hội & nhân văn'),
('K05', 'Khoa Giáo dục tiểu học & mầm non'),
('K06', 'Khoa Giáo dục Thể chất - Quốc phòng'),
('K07', 'Khoa Sư phạm'),
('K08', 'Khoa Kỹ thuật & Công nghệ'),
('K09', 'Khoa Toán & Thống kê'),
('K10', 'Khoa Kinh tế & Kế toán'),
('K11', 'Khoa Tài chính - Ngân hàng & Quản trị kinh doanh'),
('NN', 'Khoa ngoại ngữ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lop`
--

DROP TABLE IF EXISTS `lop`;
CREATE TABLE IF NOT EXISTS `lop` (
  `MaLop` varchar(10) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `TenLop` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `MaNganh` varchar(10) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  PRIMARY KEY (`MaLop`),
  KEY `MaNganh` (`MaNganh`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `lop`
--

INSERT INTO `lop` (`MaLop`, `TenLop`, `MaNganh`) VALUES
('CNTTK45A', 'Công nghệ thông tin K45A', 'CNTT'),
('CNTTK45B', 'Công nghệ thông tin K45B', 'CNTT'),
('CNTTK46A', 'Công nghệ thông tin K46A', 'CNTT'),
('CNTTK46B', 'Công nghệ thông tin K46B', 'CNTT'),
('CNTTK46D', 'Công nghệ thông tin K46D', 'CNTT'),
('CNTTK47A', 'Công nghệ thông tin K47A', 'CNTT'),
('CNTTK47B', 'Công nghệ thông tin K47B', 'CNTT'),
('HTTTK45A', 'Hệ thống thông tin K45A', 'HTTT'),
('HTTTK46A', 'Hệ thống thông tin K46A', 'HTTT'),
('HTTTK47A', 'Hệ thống thông tin K47A', 'HTTT'),
('KTPMK45A', 'Kỹ thuật phần mềm K45A', 'KTPM'),
('KTPMK46A', 'Kỹ thuật phần mềm K46A', 'KTPM'),
('KTPMK47A', 'Kỹ thuật phần mềm K47A', 'KTPM');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `minhchungthamgiask`
--

DROP TABLE IF EXISTS `minhchungthamgiask`;
CREATE TABLE IF NOT EXISTS `minhchungthamgiask` (
  `IDMinhChung` int NOT NULL AUTO_INCREMENT,
  `MSSV` varchar(10) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `MaSK` int DEFAULT NULL,
  `ThoiGianNop` datetime DEFAULT NULL,
  `FileMinhChung` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `TrangThai` enum('Đã duyệt','Chờ duyệt','Từ chối') COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  PRIMARY KEY (`IDMinhChung`),
  KEY `MSSV` (`MSSV`),
  KEY `MaSK` (`MaSK`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nganh`
--

DROP TABLE IF EXISTS `nganh`;
CREATE TABLE IF NOT EXISTS `nganh` (
  `MaNganh` varchar(10) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `TenNganh` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `MaKhoa` varchar(10) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  PRIMARY KEY (`MaNganh`),
  KEY `MaKhoa` (`MaKhoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `nganh`
--

INSERT INTO `nganh` (`MaNganh`, `TenNganh`, `MaKhoa`) VALUES
('ATTT', 'An toàn thông tin', 'CNTT'),
('CNTT', 'Công nghệ thông tin', 'CNTT'),
('HTTT', 'Hệ thống thông tin', 'CNTT'),
('KTPM', 'Kỹ thuật phần mềm', 'CNTT'),
('NNA', 'Ngôn ngữ Anh', 'NN');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieudanhgiarl`
--

DROP TABLE IF EXISTS `phieudanhgiarl`;
CREATE TABLE IF NOT EXISTS `phieudanhgiarl` (
  `MaDot` int NOT NULL,
  `MSSV` varchar(10) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `ThoiGianNop` datetime DEFAULT NULL,
  `JSON_Data` json DEFAULT NULL,
  `TrangThai` enum('Đã duyệt','Đã điều chỉnh','Chờ duyệt','Từ chối') COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  PRIMARY KEY (`MaDot`,`MSSV`),
  KEY `MSSV` (`MSSV`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinhvien`
--

DROP TABLE IF EXISTS `sinhvien`;
CREATE TABLE IF NOT EXISTS `sinhvien` (
  `MSSV` varchar(10) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `Ho` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `Ten` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `Email` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `Password` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `MaLop` varchar(10) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `isBanCanSu` int DEFAULT NULL,
  PRIMARY KEY (`MSSV`),
  UNIQUE KEY `Email` (`Email`),
  KEY `MaLop` (`MaLop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `sinhvien`
--

INSERT INTO `sinhvien` (`MSSV`, `Ho`, `Ten`, `Email`, `Password`, `MaLop`, `isBanCanSu`) VALUES
('4651050044', 'Nguyễn Khánh', 'Dương', 'khanhduong18072005@gmail.com', '18072005', 'CNTTK46D', NULL),
('4651050189', 'Nguyễn Yến', 'Nhi', NULL, 'haru', 'CNTTK46B', NULL),
('bcs', 'Họ tên', NULL, NULL, 'bcs', 'CNTTK46D', 1),
('sv', 'Cậu bé tê liệt', NULL, NULL, 'sv', 'CNTTK46A', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sukien`
--

DROP TABLE IF EXISTS `sukien`;
CREATE TABLE IF NOT EXISTS `sukien` (
  `MaSK` int NOT NULL AUTO_INCREMENT,
  `TenSK` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `ThoiGianMoDK` datetime DEFAULT NULL,
  `ThoiGianDongDK` datetime DEFAULT NULL,
  `ThoiGianBatDauSK` datetime DEFAULT NULL,
  `ThoiGianKetThucSK` datetime DEFAULT NULL,
  `GioiHanThamGia` int DEFAULT NULL,
  `NoiToChuc` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `DiemCong` int NOT NULL,
  `MaKhoa` varchar(10) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `GhiChu` text COLLATE utf8mb4_vietnamese_ci,
  `MaHK` varchar(10) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  PRIMARY KEY (`MaSK`),
  KEY `MaKhoa` (`MaKhoa`),
  KEY `fk_sukien_hocky` (`MaHK`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `sukien`
--

INSERT INTO `sukien` (`MaSK`, `TenSK`, `ThoiGianMoDK`, `ThoiGianDongDK`, `ThoiGianBatDauSK`, `ThoiGianKetThucSK`, `GioiHanThamGia`, `NoiToChuc`, `DiemCong`, `MaKhoa`, `GhiChu`, `MaHK`) VALUES
(24, 'Tham dự trận giao hữu bóng đá nam giữa đội tuyển ITQNU với CLB Manchester United ', '2025-11-20 00:00:00', '2025-11-25 23:59:00', '2025-11-26 08:00:00', '2025-11-26 11:30:00', 1000, 'Sân vận động Quy Nhơn', 5, 'CNTT', '', 'HK1(25-26)'),
(25, 'Hiến máu tình nguyện tháng 11 năm 2025', '2025-11-24 00:00:00', '2025-11-29 23:59:00', '2025-11-30 07:00:00', '2025-11-30 11:30:00', 500, 'Nhà thi đấu đa năng', 5, 'CNTT', 'test', 'HK1(25-26)'),
(26, 'Cường gay', '2025-01-01 00:00:00', '2025-01-01 00:00:00', '2025-01-01 00:00:00', '2025-01-01 00:01:00', 36, 'Quán phở Anh Hai, số 10 Đan Phượng, Hà Nội', 1000000, 'CNTT', '', 'HK1(25-26)'),
(27, 'Cường gay', '2025-01-01 00:00:00', '2025-01-01 00:00:00', '2025-01-01 00:00:00', '2025-01-01 00:01:00', 36, 'Quán phở Anh Hai, số 10 Đan Phượng, Hà Nội', 1000000, 'CNTT', '', 'HK1(25-26)');

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `biendongdrl`
--
ALTER TABLE `biendongdrl`
  ADD CONSTRAINT `biendongdrl_ibfk_1` FOREIGN KEY (`MSSV`) REFERENCES `sinhvien` (`MSSV`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_biendongdrl_hocky` FOREIGN KEY (`MaHK`) REFERENCES `hocky` (`MaHK`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `chophepsvkhoathamgia`
--
ALTER TABLE `chophepsvkhoathamgia`
  ADD CONSTRAINT `chophepsvkhoathamgia_ibfk_1` FOREIGN KEY (`MaSK`) REFERENCES `sukien` (`MaSK`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chophepsvkhoathamgia_ibfk_2` FOREIGN KEY (`MaKhoa`) REFERENCES `khoa` (`MaKhoa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `diemrlsv`
--
ALTER TABLE `diemrlsv`
  ADD CONSTRAINT `diemrlsv_ibfk_1` FOREIGN KEY (`MSSV`) REFERENCES `sinhvien` (`MSSV`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `diemrlsv_ibfk_2` FOREIGN KEY (`MaHK`) REFERENCES `hocky` (`MaHK`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `dksukien`
--
ALTER TABLE `dksukien`
  ADD CONSTRAINT `dksukien_ibfk_1` FOREIGN KEY (`MSSV`) REFERENCES `sinhvien` (`MSSV`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dksukien_ibfk_2` FOREIGN KEY (`MaSK`) REFERENCES `sukien` (`MaSK`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `dotdanhgiarl`
--
ALTER TABLE `dotdanhgiarl`
  ADD CONSTRAINT `dotdanhgiarl_ibfk_1` FOREIGN KEY (`MaHK`) REFERENCES `hocky` (`MaHK`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `lop`
--
ALTER TABLE `lop`
  ADD CONSTRAINT `lop_ibfk_1` FOREIGN KEY (`MaNganh`) REFERENCES `nganh` (`MaNganh`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `minhchungthamgiask`
--
ALTER TABLE `minhchungthamgiask`
  ADD CONSTRAINT `minhchungthamgiask_ibfk_1` FOREIGN KEY (`MSSV`) REFERENCES `sinhvien` (`MSSV`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `minhchungthamgiask_ibfk_2` FOREIGN KEY (`MaSK`) REFERENCES `sukien` (`MaSK`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `nganh`
--
ALTER TABLE `nganh`
  ADD CONSTRAINT `nganh_ibfk_1` FOREIGN KEY (`MaKhoa`) REFERENCES `khoa` (`MaKhoa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `phieudanhgiarl`
--
ALTER TABLE `phieudanhgiarl`
  ADD CONSTRAINT `phieudanhgiarl_ibfk_1` FOREIGN KEY (`MaDot`) REFERENCES `dotdanhgiarl` (`MaDot`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `phieudanhgiarl_ibfk_2` FOREIGN KEY (`MSSV`) REFERENCES `sinhvien` (`MSSV`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `sinhvien_ibfk_1` FOREIGN KEY (`MaLop`) REFERENCES `lop` (`MaLop`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `sukien`
--
ALTER TABLE `sukien`
  ADD CONSTRAINT `fk_sukien_hocky` FOREIGN KEY (`MaHK`) REFERENCES `hocky` (`MaHK`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sukien_ibfk_1` FOREIGN KEY (`MaKhoa`) REFERENCES `khoa` (`MaKhoa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
