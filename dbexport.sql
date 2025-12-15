-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 15, 2025 lúc 02:01 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

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

CREATE TABLE `admin` (
  `AdminID` varchar(10) NOT NULL,
  `Ho` varchar(100) DEFAULT NULL,
  `Ten` varchar(100) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`AdminID`, `Ho`, `Ten`, `Email`, `Password`) VALUES
('admin', 'NGUYỄN KHÁNH', 'DƯƠNG', 'duong4651050044@st.qnu.edu.vn', 'admin'),
('admintest', 'Admin', 'Test', 'xxx@abc.com', 'admin123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bcsquanlylop`
--

CREATE TABLE `bcsquanlylop` (
  `MSSV` varchar(10) DEFAULT NULL,
  `MaLop` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `bcsquanlylop`
--

INSERT INTO `bcsquanlylop` (`MSSV`, `MaLop`) VALUES
('bcs', 'CNTTK46D'),
('4651050245', 'CNTTK46D'),
('bcs', 'CNTTK46B');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `biendongdrl`
--

CREATE TABLE `biendongdrl` (
  `MaGD` int(11) NOT NULL,
  `LoaiGD` enum('Cộng','Trừ') DEFAULT NULL,
  `MSSV` varchar(10) DEFAULT NULL,
  `NoiDung` text DEFAULT NULL,
  `ThoiGian` datetime DEFAULT NULL,
  `SoDiem` int(11) DEFAULT NULL,
  `MaHK` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chophepsvkhoathamgia`
--

CREATE TABLE `chophepsvkhoathamgia` (
  `MaSK` int(11) NOT NULL,
  `MaKhoa` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `chophepsvkhoathamgia`
--

INSERT INTO `chophepsvkhoathamgia` (`MaSK`, `MaKhoa`) VALUES
(24, 'CNTT'),
(25, 'CNTT'),
(26, 'CNTT'),
(27, 'CNTT'),
(28, 'CNTT'),
(28, 'K09'),
(29, 'CNTT'),
(29, 'K01'),
(29, 'K02'),
(29, 'K03'),
(29, 'K05'),
(29, 'K06'),
(29, 'K07'),
(29, 'K08'),
(29, 'K09'),
(29, 'K10'),
(29, 'K11'),
(29, 'NN'),
(31, 'CNTT'),
(31, 'K01'),
(31, 'K02'),
(31, 'K03'),
(31, 'K05'),
(31, 'K06'),
(31, 'K07'),
(31, 'K08'),
(31, 'K09'),
(31, 'K10'),
(31, 'K11'),
(31, 'NN'),
(34, 'CNTT'),
(34, 'K01'),
(34, 'K02'),
(34, 'K03'),
(34, 'K05'),
(34, 'K06'),
(34, 'K07'),
(34, 'K08'),
(34, 'K09'),
(34, 'K10'),
(34, 'K11'),
(34, 'NN'),
(35, 'CNTT'),
(35, 'K01'),
(35, 'K02'),
(35, 'K03'),
(35, 'K05'),
(35, 'K06'),
(35, 'K07'),
(35, 'K08'),
(35, 'K09'),
(35, 'K10'),
(35, 'K11'),
(35, 'NN'),
(36, 'CNTT'),
(36, 'K01'),
(36, 'K02'),
(36, 'K03'),
(36, 'K05'),
(36, 'K06'),
(36, 'K07'),
(36, 'K08'),
(36, 'K09'),
(36, 'K10'),
(36, 'K11'),
(36, 'NN');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diemrlsv`
--

CREATE TABLE `diemrlsv` (
  `MSSV` varchar(10) NOT NULL,
  `MaHK` varchar(10) NOT NULL,
  `SoDiem` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dksukien`
--

CREATE TABLE `dksukien` (
  `MaLuotDK` int(11) NOT NULL,
  `MSSV` varchar(10) DEFAULT NULL,
  `MaSK` int(11) DEFAULT NULL,
  `ThoiGianDK` datetime DEFAULT NULL,
  `TrangThai` enum('Đăng ký','Hủy đăng ký') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `dksukien`
--

INSERT INTO `dksukien` (`MaLuotDK`, `MSSV`, `MaSK`, `ThoiGianDK`, `TrangThai`) VALUES
(23, 'sv', 24, '2025-11-25 21:58:15', 'Hủy đăng ký'),
(24, 'sv', 25, '2025-11-27 16:03:09', 'Đăng ký'),
(26, '4651050044', 28, '2025-12-02 14:37:43', 'Đăng ký'),
(27, '4651050034', 28, '2025-12-02 14:44:30', 'Đăng ký'),
(28, '4651050044', 29, '2025-12-09 12:22:00', 'Hủy đăng ký'),
(29, '4651050044', 29, '2025-12-09 12:43:56', 'Hủy đăng ký'),
(30, '4651050044', 29, '2025-12-09 12:44:58', 'Đăng ký'),
(32, '4651050044', 31, '2025-12-13 19:31:17', 'Đăng ký'),
(36, '4651050034', 31, '2025-12-13 19:32:54', 'Đăng ký'),
(40, 'sv', 31, '2025-12-13 19:36:59', 'Đăng ký'),
(42, '4651050189', 31, '2025-12-13 19:51:52', 'Đăng ký'),
(43, '4651050189', 36, '2025-12-14 22:19:12', 'Hủy đăng ký'),
(44, '4651050189', 36, '2025-12-14 22:21:09', 'Hủy đăng ký'),
(45, '4651050189', 36, '2025-12-14 22:25:10', 'Hủy đăng ký'),
(46, 'sv', 34, '2025-12-14 22:39:29', 'Hủy đăng ký'),
(47, 'sv', 34, '2025-12-14 22:39:44', 'Đăng ký'),
(48, 'sv', 35, '2025-12-14 22:39:47', 'Đăng ký'),
(49, 'sv', 36, '2025-12-14 22:39:48', 'Đăng ký');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dotdanhgiarl`
--

CREATE TABLE `dotdanhgiarl` (
  `MaDot` int(11) NOT NULL,
  `MaHK` varchar(10) DEFAULT NULL,
  `ThoiGianMo` datetime DEFAULT NULL,
  `ThoiGianDong` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hocky`
--

CREATE TABLE `hocky` (
  `MaHK` varchar(10) NOT NULL,
  `TenHK` varchar(255) DEFAULT NULL,
  `ThoiGianBatDau` datetime DEFAULT NULL,
  `ThoiGianKetThuc` datetime DEFAULT NULL
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

CREATE TABLE `khoa` (
  `MaKhoa` varchar(10) NOT NULL,
  `TenKhoa` varchar(255) DEFAULT NULL
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

CREATE TABLE `lop` (
  `MaLop` varchar(10) NOT NULL,
  `TenLop` varchar(255) DEFAULT NULL,
  `MaNganh` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `lop`
--

INSERT INTO `lop` (`MaLop`, `TenLop`, `MaNganh`) VALUES
('ATTTK46A', 'An toàn thông tin K46A', 'ATTT'),
('CNTT46E', 'Công nghệ thông tin 46E', 'CNTT'),
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
('KTPMK47A', 'Kỹ thuật phần mềm K47A', 'KTPM'),
('QTKD49B', 'Quản trị kinh doanh K49B', 'QNKD');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `minhchungthamgiask`
--

CREATE TABLE `minhchungthamgiask` (
  `IDMinhChung` int(11) NOT NULL,
  `MSSV` varchar(10) DEFAULT NULL,
  `MaSK` int(11) DEFAULT NULL,
  `ThoiGianNop` datetime DEFAULT NULL,
  `FileMinhChung` varchar(255) DEFAULT NULL,
  `TrangThai` enum('Đã duyệt','Chờ duyệt','Từ chối') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `minhchungthamgiask`
--

INSERT INTO `minhchungthamgiask` (`IDMinhChung`, `MSSV`, `MaSK`, `ThoiGianNop`, `FileMinhChung`, `TrangThai`) VALUES
(3, '4651050044', 28, '2025-12-02 16:34:34', 'userdata/imgMinhChung/1764668090_cherry-flowers-cherry-blossom-spring-pink-flowers-5k-4928x3280-1195.jpg', 'Đã duyệt'),
(4, '4651050044', 29, '2025-12-14 14:41:06', 'userdata/imgMinhChung/1765698064_WIN_20241023_10_19_20_Pro.jpg', 'Đã duyệt'),
(5, '4651050189', 31, '2025-12-14 14:44:55', 'userdata/imgMinhChung/1765698293_581690762_122144415788906680_4795242817525353875_n.jpg', 'Đã duyệt'),
(6, '4651050034', 31, '2025-12-14 14:45:41', 'userdata/imgMinhChung/1765698339_Screenshot 2025-12-11 193640.png', 'Từ chối'),
(7, '4651050044', 31, '2025-12-14 15:17:04', 'userdata/imgMinhChung/1765700222_Screenshot 2025-09-24 214039.png', 'Đã duyệt'),
(8, 'sv', 31, '2025-12-14 22:29:58', 'userdata/imgMinhChung/1765726199_WIN_20241023_10_19_20_Pro.jpg', 'Chờ duyệt'),
(9, '4651050034', 31, '2025-12-14 22:40:56', 'userdata/imgMinhChung/1765726858_WIN_20241023_10_19_20_Pro - Copy.jpg', 'Đã duyệt');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nganh`
--

CREATE TABLE `nganh` (
  `MaNganh` varchar(10) NOT NULL,
  `TenNganh` varchar(255) DEFAULT NULL,
  `MaKhoa` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `nganh`
--

INSERT INTO `nganh` (`MaNganh`, `TenNganh`, `MaKhoa`) VALUES
('ATTT', 'An toàn thông tin', 'CNTT'),
('CNTT', 'Công nghệ thông tin', 'CNTT'),
('HTTT', 'Hệ thống thông tin', 'CNTT'),
('KTPM', 'Kỹ thuật phần mềm', 'CNTT'),
('NNA', 'Ngôn ngữ Anh', 'NN'),
('QNKD', 'Quản trị kinh doanh', 'K11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieudanhgiarl`
--

CREATE TABLE `phieudanhgiarl` (
  `MaDot` int(11) NOT NULL,
  `MSSV` varchar(10) NOT NULL,
  `ThoiGianNop` datetime DEFAULT NULL,
  `JSON_Data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`JSON_Data`)),
  `TrangThai` enum('Đã duyệt','Đã điều chỉnh','Chờ duyệt','Từ chối') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinhvien`
--

CREATE TABLE `sinhvien` (
  `MSSV` varchar(10) NOT NULL,
  `Ho` varchar(255) DEFAULT NULL,
  `Ten` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `MaLop` varchar(10) DEFAULT NULL,
  `isBanCanSu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `sinhvien`
--

INSERT INTO `sinhvien` (`MSSV`, `Ho`, `Ten`, `Email`, `Password`, `MaLop`, `isBanCanSu`) VALUES
('4651050010', 'Nguyễn Gia', 'Bảo', 'bao4651050010@st.qnu.edu.vn', '4651050010', 'CNTTK46D', 0),
('4651050028', 'Phạm Minh', 'Chính', 'chinh4651050028@st.qnu.edu.vn', '4651050028', 'CNTTK46D', 0),
('4651050029', 'Phạm Bình', 'Chương', 'chuong4651050029@st.qnu.edu.vn', '4651050029', 'CNTTK46D', 0),
('4651050030', 'Trần Quang', 'Chức', 'chuc4651050030@st.qnu.edu.vn', '4651050030', 'CNTTK46D', 0),
('4651050031', 'Lê Quốc', 'Cường', 'cuong4651050031@st.qnu.edu.vn', '4651050031', 'CNTTK46D', 0),
('4651050032', 'Long Quốc', 'Cường', 'cuong4651050032@st.qnu.edu.vn', '4651050032', 'CNTTK46D', 0),
('4651050034', 'Trần Thanh', 'Cường', 'cuong4651050034@st.qnu.edu.vn', '4651050034', 'CNTTK46D', 0),
('4651050039', 'Nguyễn Hữu Võ', 'Duy', 'duy4651050039@st.qnu.edu.vn', '4651050039', 'CNTTK46D', 0),
('4651050040', 'Nguyễn Khắc', 'Duy', 'duy4651050040@st.qnu.edu.vn', '4651050040', 'CNTTK46D', 0),
('4651050044', 'Nguyễn Khánh', 'Dương', 'duong4651050044@st.qnu.edu.vn', '123456', 'CNTTK46D', 0),
('4651050053', 'Ngô Bá', 'Đạt', 'dat4651050053@st.qnu.edu.vn', '4651050053', 'CNTTK46D', 0),
('4651050057', 'Phan Nguyễn Hải', 'Đăng', 'dang4651050057@st.qnu.edu.vn', '4651050057', 'CNTTK46D', 0),
('4651050065', 'Lê Ngô Dong', 'Gun', 'gun4651050065@st.qnu.edu.vn', '4651050065', 'CNTTK46D', 0),
('4651050066', 'Đặng Nhật', 'Hào', 'hao4651050066@st.qnu.edu.vn', '4651050066', 'CNTTK46D', 0),
('4651050074', 'Trần Trung', 'Hậu', 'hau4651050074@st.qnu.edu.vn', '4651050074', 'CNTTK46D', 0),
('4651050094', 'Huỳnh Nhật', 'Huy', 'huy4651050094@st.qnu.edu.vn', '4651050094', 'CNTTK46D', 0),
('4651050096', 'Nguyễn Khắc', 'Huy', 'huy4651050096@st.qnu.edu.vn', '4651050096', 'CNTTK46D', 0),
('4651050104', 'Đặng Quốc', 'Hùng', 'hung4651050104@st.qnu.edu.vn', '4651050104', 'CNTTK46D', 0),
('4651050114', 'Phan Thanh', 'Kha', 'kha4651050114@st.qnu.edu.vn', '4651050114', 'CNTTK46D', 0),
('4651050116', 'Huỳnh Ngọc', 'Khang', 'khang4651050116@st.qnu.edu.vn', '4651050116', 'CNTTK46D', 0),
('4651050117', 'Nguyễn Hùng', 'Khánh', 'khanh4651050117@st.qnu.edu.vn', '4651050117', 'CNTTK46D', 0),
('4651050130', 'Đặng Võ Hà Gia', 'Kiệt', 'kiet4651050130@st.qnu.edu.vn', '4651050130', 'CNTTK46D', 0),
('4651050135', 'Nguyễn Tấn', 'Lai', 'lai4651050135@st.qnu.edu.vn', '4651050135', 'CNTTK46D', 0),
('4651050136', 'Nguyễn Thị Thuý', 'Lành', 'lanh4651050136@st.qnu.edu.vn', '4651050136', 'CNTTK46D', 0),
('4651050144', 'Phạm Thị Thuỳ', 'Linh', 'linh4651050144@st.qnu.edu.vn', '4651050144', 'CNTTK46D', 0),
('4651050147', 'Lê Hoàng', 'Lịch', 'lich4651050147@st.qnu.edu.vn', '4651050147', 'CNTTK46D', 0),
('4651050148', 'Phan Hoàng', 'Long', 'long4651050148@st.qnu.edu.vn', '4651050148', 'CNTTK46D', 0),
('4651050177', 'Nguyễn Nhất', 'Nguyên', 'nguyen4651050177@st.qnu.edu.vn', '4651050177', 'CNTTK46D', 0),
('4651050179', 'Võ Đặng Trúc', 'Nguyên', 'nguyen4651050179@st.qnu.edu.vn', '4651050179', 'CNTTK46D', 0),
('4651050189', 'Nguyễn Yến', 'Nhi', NULL, '4651050189', 'CNTTK46B', NULL),
('4651050196', 'Bo Bo Xuân', 'Phàm', 'pham4651050196@st.qnu.edu.vn', '4651050196', 'CNTTK46D', 0),
('4651050197', 'Lê Minh', 'Phát', 'phat4651050197@st.qnu.edu.vn', '4651050197', 'CNTTK46D', 0),
('4651050200', 'Bùi Thanh', 'Phong', 'phong4651050200@st.qnu.edu.vn', '4651050200', 'CNTTK46D', 0),
('4651050201', 'Huỳnh Gia', 'Phong', 'phong4651050201@st.qnu.edu.vn', '4651050201', 'CNTTK46D', 0),
('4651050205', 'Trần', 'Phong', 'phong4651050205@st.qnu.edu.vn', '4651050205', 'CNTTK46D', 0),
('4651050206', 'Đỗ Quang', 'Phú', 'phu4651050206@st.qnu.edu.vn', '4651050206', 'CNTTK46D', 0),
('4651050234', 'Trần Lê Khả', 'Tâm', 'tam4651050234@st.qnu.edu.vn', '4651050234', 'CNTTK46D', 0),
('4651050237', 'Nguyễn Bình Phương', 'Thảo', 'thao4651050237@st.qnu.edu.vn', '4651050237', 'CNTTK46D', 0),
('4651050244', 'Ksor Chăn', 'Thi', 'thi4651050244@st.qnu.edu.vn', '4651050244', 'CNTTK46D', 0),
('4651050245', 'Nguyễn Thị Cẩm', 'Thiên', 'thien4651050245@st.qnu.edu.vn', '4651050245', 'CNTTK46D', 1),
('4651050246', 'Nguyễn Thị Thuận', 'Thiên', 'thien4651050246@st.qnu.edu.vn', '4651050246', 'CNTTK46D', 0),
('4651050252', 'Đinh Công', 'Thịnh', 'thinh4651050252@st.qnu.edu.vn', '4651050252', 'CNTTK46D', 0),
('4651050258', 'Lê Công', 'Thời', 'thoi4651050258@st.qnu.edu.vn', '4651050258', 'CNTTK46D', 0),
('4651050274', 'Võ Nguyễn Thành', 'Tín', 'tin4651050274@st.qnu.edu.vn', '4651050274', 'CNTTK46D', 0),
('4651050276', 'Bùi Ngọc', 'Toàn', 'toan4651050276@st.qnu.edu.vn', '4651050276', 'CNTTK46D', 0),
('4651050287', 'Hà Bảo', 'Trân', 'tran4651050287@st.qnu.edu.vn', '4651050287', 'CNTTK46D', 0),
('4651050301', 'Nay Ka', 'Tu', 'tu4651050301@st.qnu.edu.vn', '4651050301', 'CNTTK46D', 0),
('4651050310', 'Trịnh Dương Anh', 'Tuấn', 'tuan4651050310@st.qnu.edu.vn', '4651050310', 'CNTTK46D', 0),
('4651050319', 'Trương Vang', 'Việt', 'viet4651050319@st.qnu.edu.vn', '4651050319', 'CNTTK46D', 0),
('4651050324', 'Nguyễn Tuấn', 'Vinh', 'vinh4651050324@st.qnu.edu.vn', '4651050324', 'CNTTK46D', 0),
('4651050330', 'Trần Vũ Quốc', 'Vương', 'vuong4651050330@st.qnu.edu.vn', '4651050330', 'CNTTK46D', 0),
('4651050364', 'Phan Thị Mỹ', 'Hội', 'hoi4651050364@st.qnu.edu.vn', '4651050364', 'CNTTK46D', 0),
('4651050365', 'Ksor H\'', 'Tiêk', 'tiek4651050365@st.qnu.edu.vn', '4651050365', 'CNTTK46D', 0),
('4651050368', 'Nguyễn Thanh', 'Huy', 'huy4651050368@st.qnu.edu.vn', '4651050368', 'CNTTK46D', 0),
('bcs', 'Tài khoản bcs', 'test', 'cuonggay@gmail.com', 'bcs', 'CNTTK46D', 1),
('sv', 'Cậu bé', 'tê liệt', 'ccdscd@gmail.com', 'sv', 'CNTTK46A', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sukien`
--

CREATE TABLE `sukien` (
  `MaSK` int(11) NOT NULL,
  `TenSK` varchar(255) DEFAULT NULL,
  `ThoiGianMoDK` datetime DEFAULT NULL,
  `ThoiGianDongDK` datetime DEFAULT NULL,
  `ThoiGianBatDauSK` datetime DEFAULT NULL,
  `ThoiGianKetThucSK` datetime DEFAULT NULL,
  `GioiHanThamGia` int(11) DEFAULT NULL,
  `NoiToChuc` varchar(255) NOT NULL,
  `DiemCong` int(11) NOT NULL,
  `MaKhoa` varchar(10) DEFAULT NULL,
  `GhiChu` text DEFAULT NULL,
  `MaHK` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `sukien`
--

INSERT INTO `sukien` (`MaSK`, `TenSK`, `ThoiGianMoDK`, `ThoiGianDongDK`, `ThoiGianBatDauSK`, `ThoiGianKetThucSK`, `GioiHanThamGia`, `NoiToChuc`, `DiemCong`, `MaKhoa`, `GhiChu`, `MaHK`) VALUES
(24, 'Tham dự trận giao hữu bóng đá nam giữa đội tuyển ITQNU với CLB Manchester United ', '2025-11-20 00:00:00', '2025-11-25 23:59:00', '2025-11-26 08:00:00', '2025-11-26 11:30:00', 1000, 'Sân vận động Quy Nhơn', 5, 'CNTT', '', 'HK1(25-26)'),
(25, 'Hiến máu tình nguyện tháng 11 năm 2025', '2025-11-24 00:00:00', '2025-11-29 23:59:00', '2025-11-30 07:00:00', '2025-11-30 11:30:00', 500, 'Nhà thi đấu đa năng', 5, 'CNTT', 'test', 'HK1(25-26)'),
(26, 'Cường gay', '2025-01-01 00:00:00', '2025-01-01 00:00:00', '2025-01-01 00:00:00', '2025-01-01 00:01:00', 36, 'Quán phở Anh Hai, số 10 Đan Phượng, Hà Nội', 1000000, 'CNTT', '', 'HK1(25-26)'),
(27, 'Cường gay', '2025-01-01 00:00:00', '2025-01-01 00:00:00', '2025-01-01 00:00:00', '2025-01-01 00:01:00', 36, 'Quán phở Anh Hai, số 10 Đan Phượng, Hà Nội', 1000000, 'CNTT', '', 'HK1(25-26)'),
(28, 'Pickleball xã giao giữa khoa Công nghệ thông tin và khoa Toán & Thống Kê', '2025-12-01 00:00:00', '2025-12-02 14:59:00', '2025-12-02 15:00:00', '2025-12-02 15:05:00', 2, 'Quán phở Anh Hai, số 10 Đan Phượng, Hà Nội', 5, 'CNTT', 'Hãy lọ nhiệt huyết nhé mn', 'HK1(25-26)'),
(29, 'Xem phim mưa đỏ (Buổi 1)', '2025-12-08 00:00:00', '2025-12-10 17:00:00', '2025-12-11 18:00:00', '2025-12-11 21:00:00', 400, 'Hội trường B', 2, 'CNTT', '', 'HK1(25-26)'),
(31, 'Tham quan thực tế phố đi bộ Bùi Viện', '2025-12-13 00:00:00', '2025-12-13 21:59:00', '2025-12-13 22:00:00', '2025-12-13 23:59:00', 100, 'Phố đi bộ Bùi Viện', 5, 'K03', '', 'HK1(25-26)'),
(34, 'Giải đua xe bát hương vàng mở rộng 2025-2026', '2025-12-14 00:00:00', '2025-12-14 23:59:00', '2025-12-15 12:00:00', '2025-12-15 17:00:00', 100, 'Bãi tha ma', 5, 'CNTT', '', 'HK1(25-26)'),
(35, 'Workshop GenAI - Cùng bạn tạo nên lợi thế cạnh tranh', '2025-12-14 00:00:00', '2025-12-15 23:59:00', '2025-12-16 15:00:00', '2025-12-16 17:00:00', 500, 'Hội trường B', 1, 'CNTT', '', 'HK1(25-26)'),
(36, 'Chương trình khởi động dự án Statup \"Nuôi tôi\"', '2025-12-10 00:00:00', '2025-12-15 00:00:00', '2025-12-17 15:00:00', '2025-12-17 17:00:00', 500, 'Hội trường B', 5, 'CNTT', '', 'HK1(25-26)');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Chỉ mục cho bảng `bcsquanlylop`
--
ALTER TABLE `bcsquanlylop`
  ADD KEY `MSSV` (`MSSV`),
  ADD KEY `MaLop` (`MaLop`);

--
-- Chỉ mục cho bảng `biendongdrl`
--
ALTER TABLE `biendongdrl`
  ADD PRIMARY KEY (`MaGD`),
  ADD KEY `MSSV` (`MSSV`),
  ADD KEY `fk_biendongdrl_hocky` (`MaHK`);

--
-- Chỉ mục cho bảng `chophepsvkhoathamgia`
--
ALTER TABLE `chophepsvkhoathamgia`
  ADD PRIMARY KEY (`MaSK`,`MaKhoa`),
  ADD KEY `MaKhoa` (`MaKhoa`);

--
-- Chỉ mục cho bảng `diemrlsv`
--
ALTER TABLE `diemrlsv`
  ADD PRIMARY KEY (`MSSV`,`MaHK`),
  ADD KEY `MaHK` (`MaHK`);

--
-- Chỉ mục cho bảng `dksukien`
--
ALTER TABLE `dksukien`
  ADD PRIMARY KEY (`MaLuotDK`),
  ADD KEY `MSSV` (`MSSV`),
  ADD KEY `MaSK` (`MaSK`);

--
-- Chỉ mục cho bảng `dotdanhgiarl`
--
ALTER TABLE `dotdanhgiarl`
  ADD PRIMARY KEY (`MaDot`),
  ADD KEY `MaHK` (`MaHK`);

--
-- Chỉ mục cho bảng `hocky`
--
ALTER TABLE `hocky`
  ADD PRIMARY KEY (`MaHK`);

--
-- Chỉ mục cho bảng `khoa`
--
ALTER TABLE `khoa`
  ADD PRIMARY KEY (`MaKhoa`);

--
-- Chỉ mục cho bảng `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`MaLop`),
  ADD KEY `MaNganh` (`MaNganh`);

--
-- Chỉ mục cho bảng `minhchungthamgiask`
--
ALTER TABLE `minhchungthamgiask`
  ADD PRIMARY KEY (`IDMinhChung`),
  ADD KEY `MSSV` (`MSSV`),
  ADD KEY `MaSK` (`MaSK`);

--
-- Chỉ mục cho bảng `nganh`
--
ALTER TABLE `nganh`
  ADD PRIMARY KEY (`MaNganh`),
  ADD KEY `MaKhoa` (`MaKhoa`);

--
-- Chỉ mục cho bảng `phieudanhgiarl`
--
ALTER TABLE `phieudanhgiarl`
  ADD PRIMARY KEY (`MaDot`,`MSSV`),
  ADD KEY `MSSV` (`MSSV`);

--
-- Chỉ mục cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`MSSV`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `MaLop` (`MaLop`);

--
-- Chỉ mục cho bảng `sukien`
--
ALTER TABLE `sukien`
  ADD PRIMARY KEY (`MaSK`),
  ADD KEY `MaKhoa` (`MaKhoa`),
  ADD KEY `fk_sukien_hocky` (`MaHK`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `biendongdrl`
--
ALTER TABLE `biendongdrl`
  MODIFY `MaGD` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `dksukien`
--
ALTER TABLE `dksukien`
  MODIFY `MaLuotDK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT cho bảng `dotdanhgiarl`
--
ALTER TABLE `dotdanhgiarl`
  MODIFY `MaDot` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `minhchungthamgiask`
--
ALTER TABLE `minhchungthamgiask`
  MODIFY `IDMinhChung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `sukien`
--
ALTER TABLE `sukien`
  MODIFY `MaSK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
