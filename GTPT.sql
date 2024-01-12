-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th1 12, 2024 lúc 02:39 PM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `GTPT`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `DISTRICTS`
--

CREATE TABLE `DISTRICTS` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Motel`
--

CREATE TABLE `Motel` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `area` int(11) DEFAULT NULL,
  `count_view` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `latlng` varchar(255) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `category_id` int(10) DEFAULT NULL,
  `district_id` int(10) DEFAULT NULL,
  `utilities` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `phone` varchar(255) DEFAULT NULL,
  `approve` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `Motel`
--

INSERT INTO `Motel` (`ID`, `title`, `description`, `price`, `area`, `count_view`, `address`, `latlng`, `images`, `user_id`, `category_id`, `district_id`, `utilities`, `created_at`, `phone`, `approve`) VALUES
(1, 'nhà trò #1', 'không', 10000, -1, 0, 'vinh', '', '/www/tro/uploads/Screenshot_20230307_164334.png', NULL, NULL, NULL, '', '2023-12-08 00:44:24', '', 0),
(2, 'nhà trọ 2', '', 20000, -1, 0, '', '', '/www/tro/uploads/', NULL, NULL, NULL, '', '2023-12-27 11:15:59', '', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Post`
--

CREATE TABLE `Post` (
  `ID` int(11) NOT NULL,
  `Title` longtext NOT NULL,
  `Content` longtext NOT NULL,
  `MotelID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `USER`
--

CREATE TABLE `USER` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Role` int(11) DEFAULT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `Avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `USER`
--

INSERT INTO `USER` (`ID`, `Name`, `Username`, `Email`, `Password`, `Role`, `Phone`, `Avatar`) VALUES
(1, 'nam', 'nam3', '1', '$2y$10$.SOBYjFZDE4Pwk2CMvaZw.h8.6D0lZmRAM0QZLK.NQbMjiX4ZfnDy', 0, '', '/www/tro/uploads/c444ea8fc2ec6ab233fd.jpg'),
(2, 'nam', 'nam3', '1', '$2y$10$gQybomd7VhjWxNB.qToo1u1ObNvX47R4lSTQL1idVgDbt8utsQ1NG', 0, '', ''),
(3, 'nam', 'nam3', '1', '$2y$10$pgQ7CIi7VBIzqTn2EitdXO/3XyTKGnLUm9T7/aSXaGQ00BqZGgmX6', 0, '', ''),
(4, '1', 'nam', '1', '$2y$10$NN0SpKYxMCFYPbbXtNBU2OA1ELXROjEvBQHK7QBGqQkBXgLpbymVa', 0, '', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `DISTRICTS`
--
ALTER TABLE `DISTRICTS`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `Motel`
--
ALTER TABLE `Motel`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `motel_user` (`user_id`),
  ADD KEY `motel_districts` (`district_id`);

--
-- Chỉ mục cho bảng `Post`
--
ALTER TABLE `Post`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fsdfsfsdfs` (`MotelID`);

--
-- Chỉ mục cho bảng `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `DISTRICTS`
--
ALTER TABLE `DISTRICTS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `Motel`
--
ALTER TABLE `Motel`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `Post`
--
ALTER TABLE `Post`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `USER`
--
ALTER TABLE `USER`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `Motel`
--
ALTER TABLE `Motel`
  ADD CONSTRAINT `motel_districts` FOREIGN KEY (`district_id`) REFERENCES `DISTRICTS` (`ID`),
  ADD CONSTRAINT `motel_user` FOREIGN KEY (`user_id`) REFERENCES `USER` (`ID`);

--
-- Các ràng buộc cho bảng `Post`
--
ALTER TABLE `Post`
  ADD CONSTRAINT `fsdfsfsdfs` FOREIGN KEY (`MotelID`) REFERENCES `Motel` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
