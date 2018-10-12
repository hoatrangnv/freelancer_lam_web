-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 12, 2018 lúc 09:02 AM
-- Phiên bản máy phục vụ: 10.1.33-MariaDB
-- Phiên bản PHP: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `lamnghean`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banks`
--

CREATE TABLE `banks` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(18) NOT NULL,
  `bank_code` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `banks`
--

INSERT INTO `banks` (`id`, `bank_name`, `bank_code`) VALUES
(1, 'Tài khoản MoMo', 'momo'),
(5, 'Maritime', 'Maritime'),
(6, 'SacomBank', 'SacomBank'),
(7, 'DongABank', 'DongABank'),
(8, 'EximBank', 'EximBank'),
(9, 'NamABank', 'NamABank'),
(10, 'ACB', 'ACB'),
(11, 'SaiGonBank', 'SaiGonBank'),
(12, 'VPBank', 'VPBank'),
(13, 'Techcombank', 'Techcombank'),
(14, 'MB', 'MB'),
(15, 'BacA Bank', 'BacA Bank'),
(16, 'VIB', 'VIB'),
(17, 'SeaBank', 'SeaBank'),
(18, 'HDBank', 'HDBank'),
(20, 'Viet Capital Bank', 'Viet Capital Bank'),
(21, 'OCB', 'OCB'),
(22, 'SCB', 'SCB'),
(23, 'VietABank', 'VietABank'),
(24, 'SHB', 'SHB'),
(25, 'GP.Bank', 'GP.Bank'),
(26, 'ABBank', 'ABBank'),
(27, 'NCB', 'NCB'),
(28, 'KienLong Bank', 'KienLong Bank'),
(29, 'VietBank', 'VietBank'),
(30, 'OceanBank', 'OceanBank'),
(31, 'PG Bank', 'PG Bank'),
(33, 'CBbank', 'CBbank'),
(34, 'DaiAbank', 'DaiAbank'),
(35, 'LienVietPost Bank', 'LienVietPost Bank'),
(36, 'TPBank', 'TPBank'),
(38, 'BaoVietBank', 'BaoVietBank'),
(39, 'Vietcombank', 'Vietcombank'),
(40, 'VietinBank', 'VietinBank'),
(41, 'BIDV', 'BIDV'),
(42, 'Agribank', 'Agribank'),
(47, 'Indovina bank', 'Indovina bank'),
(49, 'VRB', 'VRB'),
(50, 'HSBC', 'HSBC'),
(51, 'Standard Chartered', 'Standard Chartered'),
(52, 'Shinhan', 'Shinhan'),
(55, 'Citibank', 'Citibank'),
(56, 'PVcomBank', 'PVcomBank'),
(57, 'Ngân lượng', 'Nganluong'),
(58, 'TCSR', 'Thecaosieure');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bank_account`
--

CREATE TABLE `bank_account` (
  `id` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  `bank_id` int(100) NOT NULL,
  `province_id` int(100) NOT NULL,
  `bank_branch` varchar(255) DEFAULT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1: Active, 0: Disabled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `bank_account`
--

INSERT INTO `bank_account` (`id`, `user_id`, `bank_id`, `province_id`, `bank_branch`, `account_name`, `account_number`, `status`, `created_at`, `updated_at`) VALUES
(3, 2, 10, 10, 'ha noi', 'PHAM VAN KHANH', '0116464644', 0, '2018-10-09 00:43:04', '2018-10-09 00:43:04'),
(4, 2, 6, 10, 'ha noi', 'le van b', '4564444', 0, '2018-10-09 00:54:20', '2018-10-09 00:54:20'),
(5, 2, 8, 10, 'HA NOI', 'LE VAN C', '001113155', 0, '2018-10-09 02:18:07', '2018-10-09 02:18:07'),
(6, 2, 1, 10, 'Tran duy Hung', 'PHAM VAN KHANH', '016849457115', 0, '2018-10-09 14:59:25', '2018-10-09 14:59:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cards`
--

CREATE TABLE `cards` (
  `card_id` int(100) NOT NULL,
  `order_id` int(10) NOT NULL,
  `card_pin` varchar(255) DEFAULT NULL,
  `card_serial` varchar(255) DEFAULT NULL,
  `card_notes` text,
  `card_provider` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `card_delivered` int(1) DEFAULT '0',
  `card_price` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cat_cards`
--

CREATE TABLE `cat_cards` (
  `cat_id` int(11) NOT NULL,
  `card_name` varchar(255) NOT NULL,
  `card_discount` float NOT NULL COMMENT 'Tỷ giá khi bán cho web',
  `card_discount_buy` float DEFAULT NULL COMMENT 'Tỷ giá khi mua từ web',
  `card_code` varchar(255) NOT NULL,
  `card_logo` varchar(255) NOT NULL,
  `card_type` int(1) NOT NULL,
  `card_status` int(1) NOT NULL DEFAULT '1' COMMENT '0: Inactive, 1: Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `cat_cards`
--

INSERT INTO `cat_cards` (`cat_id`, `card_name`, `card_discount`, `card_discount_buy`, `card_code`, `card_logo`, `card_type`, `card_status`) VALUES
(1, 'Viettel', 36, 1, 'vtt', 'viettel.png', 1, 1),
(2, 'Vinaphone', 39, 1, 'vnp', 'vinaphone.png', 1, 1),
(3, 'Vietnamobile', 14, 1, 'vnm', 'vietnamobile.png', 0, 0),
(4, 'Gate', 13, 1, 'gate', 'gate.png', 0, 0),
(5, 'Zing', 14, 0, 'zing', 'Zing.png', 0, 0),
(6, 'Mobifone', 45, 1, 'vms', 'mobifone.png', 1, 1),
(7, 'Garena', 39, 1, 'garena', 'Garena.png', 1, 1),
(8, 'Vcoin', 14, 1, 'vcoin', 'Vcoin.png', 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `deposits`
--

CREATE TABLE `deposits` (
  `id` int(100) NOT NULL,
  `user_id` int(10) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `deposit_amount` float NOT NULL,
  `deposit_memo` varchar(50) DEFAULT NULL,
  `deposit_notes` text,
  `user_last_confirm` int(30) DEFAULT NULL,
  `deposit_status` int(11) NOT NULL COMMENT '0: Cancelled, 1: Approved, 2: Processing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `deposits`
--

INSERT INTO `deposits` (`id`, `user_id`, `user_name`, `deposit_amount`, `deposit_memo`, `deposit_notes`, `user_last_confirm`, `deposit_status`, `created_at`, `updated_at`) VALUES
(197, 2, 'khanhpv', 1000000, NULL, NULL, 1, 1, '2018-10-12 03:33:23', '2018-10-12 04:05:37'),
(198, 2, 'khanhpv', 2000, NULL, NULL, 1, 1, '2018-10-12 03:40:55', '2018-10-12 04:06:31'),
(199, 2, 'khanhpv', 300000, NULL, NULL, 1, 0, '2018-10-12 03:55:37', '2018-10-12 03:55:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `logs`
--

CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL,
  `log_user_id` int(255) NOT NULL,
  `log_receiver` varchar(100) DEFAULT NULL,
  `log_content` text NOT NULL,
  `log_amount` float DEFAULT NULL,
  `log_time` int(255) NOT NULL,
  `log_type` varchar(255) NOT NULL COMMENT 'WITHDRAW, TRANSFER, DEPOSIT, RECEIVE',
  `log_read` int(1) NOT NULL DEFAULT '0' COMMENT '0: Ủnead, 1: Read',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `logs`
--

INSERT INTO `logs` (`log_id`, `log_user_id`, `log_receiver`, `log_content`, `log_amount`, `log_time`, `log_type`, `log_read`, `created_at`, `updated_at`) VALUES
(7686, 2, NULL, 'Trừ tiền tài khoản.khanhpv. tạm giữ: .200000.', 100000, 0, 'RUT-TIEN', 1, '2018-10-10 03:45:33', '2018-10-10 03:45:33'),
(7687, 2, NULL, 'Trừ tiền tạm giữ, rút tiền thành công', 0, 0, 'RUT-TIEN', 1, '2018-10-10 03:48:51', '2018-10-10 03:48:51'),
(7688, 2, NULL, 'Tài khoản.khanhpv.rút tiền.190000.', 190000, 0, 'RUT-TIEN', 1, '2018-10-10 03:48:51', '2018-10-10 03:48:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `card_type_id` int(10) NOT NULL,
  `pin` varchar(255) NOT NULL,
  `serial` varchar(255) NOT NULL,
  `provider` varchar(10) DEFAULT NULL,
  `user_id` int(255) NOT NULL,
  `link_id` int(255) DEFAULT NULL,
  `ip_request` varchar(255) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `amount` float DEFAULT '0',
  `rate` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `balance` float DEFAULT '0',
  `requestId` varchar(255) DEFAULT NULL,
  `topup_type` int(11) NOT NULL COMMENT '0: Link, 1: User topup',
  `is_image` int(1) DEFAULT '0',
  `image_url` varchar(255) DEFAULT NULL,
  `notes` text,
  `payment_status` int(5) NOT NULL COMMENT ' 0: Waiting, 1: Completed, 2: Rejected',
  `is_deleted` int(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `payments`
--

INSERT INTO `payments` (`payment_id`, `phone`, `card_type_id`, `pin`, `serial`, `provider`, `user_id`, `link_id`, `ip_request`, `price`, `amount`, `rate`, `transaction_id`, `balance`, `requestId`, `topup_type`, `is_image`, `image_url`, `notes`, `payment_status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(2646, '096868668454', 10000, '11231534646', '11231534646', 'vnp', 2, NULL, NULL, 10000, 6100, '39', 'xOr3R3dRdU', 0, NULL, 0, 1, NULL, NULL, 2, 0, '2018-10-07 14:52:00', '2018-10-07 14:52:00'),
(2647, '096868668454', 30000, '11231534646', '11231534646', 'vms', 2, NULL, NULL, 30000, 16500, '45', 's4rEal7EvL', 0, NULL, 0, 1, NULL, NULL, 2, 6, '2018-10-07 14:52:29', '2018-10-07 14:52:29'),
(2648, '01999999', 10000, '1111111111111111111', '1111111111111111111', 'vms', 1, NULL, NULL, 10000, 5500, '45', 'FBh8jq1zyz', 0, NULL, 0, 1, NULL, NULL, 2, 0, '2018-10-07 15:39:43', '2018-10-07 15:39:43'),
(2649, '096868668454', 10000, '1111111111111111111', '1111111111111111111', 'vtt', 2, NULL, NULL, 10000, 6400, '36', 'ezEX5P35Hr', 0, NULL, 0, 1, NULL, NULL, 2, 0, '2018-10-07 15:42:14', '2018-10-07 15:42:14'),
(2650, '01999999', 10000, '1111111111111111111', '1111111111111111111', 'vtt', 1, NULL, NULL, 10000, 6400, '36', 'oC4gwei1pG', 0, NULL, 0, 1, NULL, NULL, 1, 0, '2018-10-07 15:42:39', '2018-10-07 15:42:39'),
(2652, '096868668454', 10000, '11231534646', '11231534646', 'vtt', 2, NULL, NULL, 10000, 0, '36', '7ne3PFajj7', 0, NULL, 0, 1, NULL, NULL, 0, 0, '2018-10-08 07:40:06', '2018-10-08 07:40:06'),
(2653, '096868668454', 10000, '11231534646', '11231534646', 'vtt', 2, NULL, NULL, 10000, 0, '36', '8r3gcnHLJ5', 0, NULL, 0, 1, NULL, NULL, 0, 0, '2018-10-08 07:40:09', '2018-10-08 07:40:09'),
(2654, '096868668454', 10000, '11231534646', '11231534646', 'vtt', 2, NULL, NULL, 10000, 0, '36', 'eeDGKBGIqb', 0, NULL, 0, 1, NULL, NULL, 0, 0, '2018-10-08 07:40:13', '2018-10-08 07:40:13'),
(2655, '096868668454', 10000, '11231534646', '11231534646', 'vtt', 2, NULL, NULL, 10000, 0, '36', 'rnXPObgydf', 0, NULL, 0, 1, NULL, NULL, 0, 0, '2018-10-08 07:40:16', '2018-10-08 07:40:16'),
(2660, '0846445333', 100000, '0', '0', 'vms', 4, NULL, NULL, 100000, 55000, '45', '4KGIDDIFXP', 0, NULL, 0, 0, 'uploads\\40012746_2074046382608538_8700502718239735808_n.jpg', NULL, 2, 0, '2018-10-09 14:23:43', '2018-10-09 14:23:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tinh`
--

CREATE TABLE `tinh` (
  `matp` varchar(5) CHARACTER SET utf8 NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `type` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Đang đổ dữ liệu cho bảng `tinh`
--

INSERT INTO `tinh` (`matp`, `name`, `type`) VALUES
('01', 'Thành phố Hà Nội', 'Thành phố Trung ương'),
('02', 'Tỉnh Hà Giang', 'Tỉnh'),
('04', 'Tỉnh Cao Bằng', 'Tỉnh'),
('06', 'Tỉnh Bắc Kạn', 'Tỉnh'),
('08', 'Tỉnh Tuyên Quang', 'Tỉnh'),
('10', 'Tỉnh Lào Cai', 'Tỉnh'),
('11', 'Tỉnh Điện Biên', 'Tỉnh'),
('12', 'Tỉnh Lai Châu', 'Tỉnh'),
('14', 'Tỉnh Sơn La', 'Tỉnh'),
('15', 'Tỉnh Yên Bái', 'Tỉnh'),
('17', 'Tỉnh Hoà Bình', 'Tỉnh'),
('19', 'Tỉnh Thái Nguyên', 'Tỉnh'),
('20', 'Tỉnh Lạng Sơn', 'Tỉnh'),
('22', 'Tỉnh Quảng Ninh', 'Tỉnh'),
('24', 'Tỉnh Bắc Giang', 'Tỉnh'),
('25', 'Tỉnh Phú Thọ', 'Tỉnh'),
('26', 'Tỉnh Vĩnh Phúc', 'Tỉnh'),
('27', 'Tỉnh Bắc Ninh', 'Tỉnh'),
('30', 'Tỉnh Hải Dương', 'Tỉnh'),
('31', 'Thành phố Hải Phòng', 'Thành phố Trung ương'),
('33', 'Tỉnh Hưng Yên', 'Tỉnh'),
('34', 'Tỉnh Thái Bình', 'Tỉnh'),
('35', 'Tỉnh Hà Nam', 'Tỉnh'),
('36', 'Tỉnh Nam Định', 'Tỉnh'),
('37', 'Tỉnh Ninh Bình', 'Tỉnh'),
('38', 'Tỉnh Thanh Hóa', 'Tỉnh'),
('40', 'Tỉnh Nghệ An', 'Tỉnh'),
('42', 'Tỉnh Hà Tĩnh', 'Tỉnh'),
('44', 'Tỉnh Quảng Bình', 'Tỉnh'),
('45', 'Tỉnh Quảng Trị', 'Tỉnh'),
('46', 'Tỉnh Thừa Thiên Huế', 'Tỉnh'),
('48', 'Thành phố Đà Nẵng', 'Thành phố Trung ương'),
('49', 'Tỉnh Quảng Nam', 'Tỉnh'),
('51', 'Tỉnh Quảng Ngãi', 'Tỉnh'),
('52', 'Tỉnh Bình Định', 'Tỉnh'),
('54', 'Tỉnh Phú Yên', 'Tỉnh'),
('56', 'Tỉnh Khánh Hòa', 'Tỉnh'),
('58', 'Tỉnh Ninh Thuận', 'Tỉnh'),
('60', 'Tỉnh Bình Thuận', 'Tỉnh'),
('62', 'Tỉnh Kon Tum', 'Tỉnh'),
('64', 'Tỉnh Gia Lai', 'Tỉnh'),
('66', 'Tỉnh Đắk Lắk', 'Tỉnh'),
('67', 'Tỉnh Đắk Nông', 'Tỉnh'),
('68', 'Tỉnh Lâm Đồng', 'Tỉnh'),
('70', 'Tỉnh Bình Phước', 'Tỉnh'),
('72', 'Tỉnh Tây Ninh', 'Tỉnh'),
('74', 'Tỉnh Bình Dương', 'Tỉnh'),
('75', 'Tỉnh Đồng Nai', 'Tỉnh'),
('77', 'Tỉnh Bà Rịa - Vũng Tàu', 'Tỉnh'),
('79', 'Thành phố Hồ Chí Minh', 'Thành phố Trung ương'),
('80', 'Tỉnh Long An', 'Tỉnh'),
('82', 'Tỉnh Tiền Giang', 'Tỉnh'),
('83', 'Tỉnh Bến Tre', 'Tỉnh'),
('84', 'Tỉnh Trà Vinh', 'Tỉnh'),
('86', 'Tỉnh Vĩnh Long', 'Tỉnh'),
('87', 'Tỉnh Đồng Tháp', 'Tỉnh'),
('89', 'Tỉnh An Giang', 'Tỉnh'),
('91', 'Tỉnh Kiên Giang', 'Tỉnh'),
('92', 'Thành phố Cần Thơ', 'Thành phố Trung ương'),
('93', 'Tỉnh Hậu Giang', 'Tỉnh'),
('94', 'Tỉnh Sóc Trăng', 'Tỉnh'),
('95', 'Tỉnh Bạc Liêu', 'Tỉnh'),
('96', 'Tỉnh Cà Mau', 'Tỉnh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `money_1` int(8) DEFAULT '0',
  `money_2` int(8) DEFAULT '0',
  `level` int(11) DEFAULT '3',
  `status` int(11) DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `password2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `member` int(1) DEFAULT '0',
  `tam_giu` int(11) DEFAULT NULL,
  `tinh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_Admin` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone_number`, `ref`, `money_1`, `money_2`, `level`, `status`, `remember_token`, `created_at`, `updated_at`, `password2`, `member`, `tam_giu`, `tinh`, `is_Admin`) VALUES
(1, 'Phạm Văn Khánh', 'khanhpoly@gmail.com', '$2y$10$3WzbEx5FcSPdn.OoqcXgGeXUSmWaeTGSZRt1lx/.DlncnRxN4Hr.W', '01999999', NULL, 12000, 0, 0, 1, 'dciEkzY3AMm9XJxuN7cOPde57A19oFu4YFPrz4rFuoCYkXRjfBpIkf1JgxN3', '2018-10-01 22:52:40', '2018-10-08 07:28:19', NULL, 0, NULL, '10', NULL),
(2, 'khanhpv', 'khanhdaik@gmail.com', '$2y$10$7oX3vjxcfh1BIDrGgd7PW.yngdCst3/CARdLDdgwkqD.AuWnPnTJe', '096868668454', NULL, 100000, NULL, 0, 1, '5gvvQcA5NMS1UWTxh8cWjuUsVhqtSGm3YcHuLvDN9bDL88uKIPbzXMuFgNWv', '2018-10-02 02:22:25', '2018-10-10 03:48:51', '123456', 0, 0, '10', 1),
(3, 'hello', 'hello@gmail.com', '$2y$10$k0qNi9cNNtJeI/X5xxcXaeCBvfhfnrTjAcZQDtLhD3CVFVMT6TBLm', '01657141874', NULL, 0, 0, 3, 1, 'xWvdwvNAYViycfGZNNxH7P523RQzZ9KBHSMd6ogjfucO2aY6fl5X6U7eeK3i', '2018-10-08 01:20:46', '2018-10-08 01:20:46', '123456', 0, NULL, '10', NULL),
(4, 'Lam Nguyen', 'lamnguyen@gmail.com', '$2y$10$5dqlSdSF/GmV3srBXfVQwOsRvqG7EH80p3K7yKKtdCEEpL4cvxYA.', '0846445333', NULL, 55000, 0, 3, 1, NULL, '2018-10-09 14:21:59', '2018-10-09 14:21:59', '123456', 0, NULL, '67', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `withdraws`
--

CREATE TABLE `withdraws` (
  `widthraw_id` int(255) NOT NULL,
  `user_id` int(100) NOT NULL,
  `bank_id` int(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_branch` varchar(255) NOT NULL,
  `bank_account_id` int(100) NOT NULL,
  `bank_account_name` varchar(255) DEFAULT NULL,
  `bank_account_number` varchar(255) DEFAULT NULL,
  `amount` float NOT NULL,
  `amount_before` float DEFAULT NULL,
  `amount_after` float DEFAULT NULL,
  `fees` float DEFAULT NULL,
  `withdraw_status` int(10) NOT NULL COMMENT '2: Processing, 1: Completed, 0: Rejected',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `withdraws`
--

INSERT INTO `withdraws` (`widthraw_id`, `user_id`, `bank_id`, `bank_name`, `bank_branch`, `bank_account_id`, `bank_account_name`, `bank_account_number`, `amount`, `amount_before`, `amount_after`, `fees`, `withdraw_status`, `created_at`, `updated_at`) VALUES
(14, 2, 8, 'EximBank', 'HA NOI', 5, 'LE VAN C', '001113155', 190000, NULL, NULL, NULL, 2, '2018-10-10 03:45:33', '2018-10-10 03:45:33');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bank_account`
--
ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`card_id`);

--
-- Chỉ mục cho bảng `cat_cards`
--
ALTER TABLE `cat_cards`
  ADD PRIMARY KEY (`cat_id`);

--
-- Chỉ mục cho bảng `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Chỉ mục cho bảng `tinh`
--
ALTER TABLE `tinh`
  ADD PRIMARY KEY (`matp`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `withdraws`
--
ALTER TABLE `withdraws`
  ADD PRIMARY KEY (`widthraw_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bank_account`
--
ALTER TABLE `bank_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `cards`
--
ALTER TABLE `cards`
  MODIFY `card_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `cat_cards`
--
ALTER TABLE `cat_cards`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT cho bảng `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7689;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2661;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `withdraws`
--
ALTER TABLE `withdraws`
  MODIFY `widthraw_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
