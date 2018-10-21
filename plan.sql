-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2018-10-19 13:55:16
-- 伺服器版本: 10.1.34-MariaDB
-- PHP 版本： 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `plan`
--

-- --------------------------------------------------------

--
-- 資料表結構 `activity`
--

CREATE TABLE `activity` (
  `ac_id` int(6) UNSIGNED NOT NULL,
  `ac_type` int(30) NOT NULL,
  `ac_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `ac_weather` varchar(30) CHARACTER SET utf8 NOT NULL,
  `ac_drive` int(30) NOT NULL,
  `ac_carry` varchar(30) CHARACTER SET utf8 NOT NULL,
  `ac_spend` int(30) NOT NULL,
  `ac_hours` int(30) NOT NULL,
  `ac_timetype` varchar(30) CHARACTER SET utf8 NOT NULL,
  `ac_updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `activity`
--

INSERT INTO `activity` (`ac_id`, `ac_type`, `ac_name`, `ac_weather`, `ac_drive`, `ac_carry`, `ac_spend`, `ac_hours`, `ac_timetype`, `ac_updatedate`) VALUES
(1, 1, '籃球', '1', 1, '籃球、毛巾、水瓶', 0, 2, '1,2,3', '2018-09-29 19:10:11'),
(2, 1, '保齡球', '1,2,3', 2, '錢包、雨傘、毛巾、水瓶', 300, 3, '1,2', '2018-09-29 19:10:09'),
(3, 1, '騎腳踏車', '1,2', 1, '錢包、雨傘', 200, 2, '1,2', '2018-09-29 19:10:02'),
(4, 2, '逛夜市', '1,2,3', 1, '錢包、雨傘', 500, 2, '3', '2018-09-29 19:09:58'),
(5, 2, '吃飯', '1,2,3', 0, '錢包、雨傘', 500, 1, '1,2,3', '2018-09-29 19:09:52'),
(6, 2, '看電影', '1,2,3', 1, '錢包、雨傘', 270, 3, '1,2,3', '2018-09-29 19:09:49'),
(7, 3, '戶外走走', '1,2', 1, '毛巾、水瓶', 0, 1, '1,2', '2018-09-29 19:09:44'),
(8, 3, '動物園', '1,2', 2, '毛巾、水瓶', 60, 2, '1,2', '2018-09-29 19:09:41'),
(9, 3, '故宮博物院', '1,2', 2, '毛巾、水瓶', 350, 2, '1,2', '2018-09-29 19:09:36'),
(10, 3, '兒童樂園', '1,2', 2, '毛巾、水瓶', 200, 2, '1,2', '2018-09-29 19:09:33'),
(11, 3, '貓空纜車', '1,2', 2, '毛巾、水瓶', 380, 3, '1,2', '2018-09-29 19:09:29'),
(12, 2, '上課', '1,2,3', 2, '錢包、筆記型電腦', 1000, 2, '1,2,3', '2018-10-01 17:28:17'),
(13, 1, '羽毛球', '1', 1, '羽毛球拍、羽毛球、毛巾、水瓶', 0, 1, '1,2,3', '2018-09-29 19:09:23'),
(15, 2, '烤肉', '1,2', 1, '烤肉用具、食物蔬菜、飲料、水瓶', 300, 3, '1,2,3', '2018-09-29 19:09:07');

-- --------------------------------------------------------

--
-- 資料表結構 `activity_types`
--

CREATE TABLE `activity_types` (
  `id` int(6) UNSIGNED NOT NULL,
  `type_id` int(11) NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `activity_types`
--

INSERT INTO `activity_types` (`id`, `type_id`, `name`) VALUES
(1, 1, '運動'),
(2, 2, '輕鬆'),
(3, 3, '景點');

-- --------------------------------------------------------

--
-- 資料表結構 `activity_weather`
--

CREATE TABLE `activity_weather` (
  `aw_id` int(6) UNSIGNED NOT NULL,
  `aw_type` int(6) NOT NULL,
  `aw_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `aw_updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `activity_weather`
--

INSERT INTO `activity_weather` (`aw_id`, `aw_type`, `aw_name`, `aw_updatedate`) VALUES
(1, 1, '晴天', '2018-09-09 14:38:22'),
(2, 2, '陰天', '2018-09-09 14:38:22'),
(3, 3, '雨天', '2018-09-09 14:38:22');

-- --------------------------------------------------------

--
-- 資料表結構 `plan_acname`
--

CREATE TABLE `plan_acname` (
  `pn_id` int(6) UNSIGNED NOT NULL,
  `pn_ptid` int(6) NOT NULL,
  `pn_acid` int(6) NOT NULL,
  `pn_acname` varchar(30) CHARACTER SET utf8 NOT NULL,
  `pn_achours` int(30) NOT NULL,
  `pn_orderby` int(30) NOT NULL,
  `pn_updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `plan_acname`
--

INSERT INTO `plan_acname` (`pn_id`, `pn_ptid`, `pn_acid`, `pn_acname`, `pn_achours`, `pn_orderby`, `pn_updatedate`) VALUES
(1, 25, 12, '上課', 2, 1, '2018-09-14 14:33:14'),
(2, 25, 5, '吃飯', 1, 1, '2018-09-14 14:33:17'),
(3, 29, 2, '保齡球', 3, 1, '2018-09-14 14:33:19'),
(4, 29, 10, '兒童樂園', 2, 1, '2018-09-14 14:33:21'),
(5, 40, 2, '保齡球', 3, 1, '2018-09-14 14:33:23'),
(6, 43, 10, '兒童樂園', 2, 1, '2018-09-14 14:33:24'),
(7, 43, 1, '籃球', 2, 1, '2018-09-14 14:33:26'),
(11, 54, 2, '保齡球', 3, 1, '2018-09-14 14:33:29'),
(12, 57, 15, '烤肉', 3, 1, '2018-09-14 14:33:30'),
(26, 62, 1, '籃球', 2, 1, '2018-09-14 14:33:31'),
(29, 63, 9, '故宮博物院', 2, 1, '2018-09-14 14:33:36'),
(30, 63, 5, '吃飯', 1, 1, '2018-09-14 14:33:38'),
(31, 63, 6, '看電影', 3, 1, '2018-09-14 14:33:40'),
(32, 64, 8, '動物園', 2, 1, '2018-09-14 14:33:42'),
(33, 64, 5, '吃飯', 1, 1, '2018-09-14 14:33:44'),
(35, 65, 14, '測試活動項目', 3, 1, '2018-09-14 14:33:48'),
(36, 65, 15, '烤肉', 3, 1, '2018-09-14 14:33:49'),
(39, 67, 2, '保齡球', 3, 0, '2018-09-15 19:55:38'),
(40, 67, 10, '兒童樂園', 2, 0, '2018-09-15 19:55:38'),
(41, 68, 6, '看電影', 3, 0, '2018-09-15 20:01:39'),
(45, 70, 1, '籃球', 2, 0, '2018-09-15 20:34:33'),
(46, 71, 215, '吃飯', 1, 0, '2018-09-16 15:53:11'),
(47, 77, 5, '吃飯', 1, 0, '2018-09-16 16:25:35'),
(49, 77, 15, '烤肉', 3, 0, '2018-09-16 16:25:35'),
(50, 77, 6, '看電影', 3, 0, '2018-09-16 16:25:35'),
(54, 78, 6, '看電影', 3, 1, '2018-09-17 17:39:55'),
(58, 78, 12, '上課', 2, 1, '2018-09-17 17:44:03'),
(63, 80, 15, '烤肉', 3, 1, '2018-09-17 17:52:32'),
(66, 69, 5, '吃飯', 1, 1, '2018-09-17 18:09:05'),
(68, 69, 12, '上課', 2, 1, '2018-09-17 18:14:59'),
(70, 81, 15, '烤肉', 3, 1, '2018-09-17 18:20:14'),
(71, 81, 6, '看電影', 3, 1, '2018-09-17 18:20:33'),
(73, 83, 8, '動物園', 2, 1, '2018-09-18 13:42:00'),
(78, 89, 13, '羽毛球', 1, 1, '2018-09-18 17:09:02'),
(79, 89, 1, '籃球', 2, 2, '2018-09-18 17:09:02'),
(81, 89, 9, '故宮博物院', 2, 1, '2018-09-18 17:09:30'),
(82, 90, 13, '羽毛球', 1, 1, '2018-09-19 15:47:34'),
(83, 90, 1, '籃球', 2, 1, '2018-09-19 15:47:34'),
(84, 90, 4, '逛夜市', 2, 1, '2018-09-19 15:47:34'),
(85, 90, 3, '騎腳踏車', 2, 1, '2018-09-19 15:47:34'),
(86, 90, 13, '羽毛球', 1, 2, '2018-09-19 15:47:34'),
(87, 90, 6, '看電影', 3, 2, '2018-09-19 15:47:34'),
(88, 90, 15, '烤肉', 3, 2, '2018-09-19 15:47:34'),
(89, 91, 5, '吃飯', 1, 1, '2018-09-20 14:13:19'),
(90, 91, 3, '騎腳踏車', 2, 1, '2018-09-20 14:13:19'),
(91, 91, 13, '羽毛球', 1, 1, '2018-09-20 14:13:19'),
(92, 91, 2, '保齡球', 3, 2, '2018-09-20 14:13:19'),
(93, 91, 3, '騎腳踏車', 2, 2, '2018-09-20 14:13:19'),
(94, 92, 10, '兒童樂園', 2, 1, '2018-10-01 17:35:38'),
(95, 92, 8, '動物園', 2, 1, '2018-10-01 17:35:38'),
(97, 92, 6, '看電影', 3, 1, '2018-10-01 17:37:22'),
(98, 93, 12, '上課', 2, 1, '2018-10-11 16:15:23'),
(99, 93, 2, '保齡球', 3, 1, '2018-10-11 16:15:23'),
(100, 93, 10, '兒童樂園', 2, 1, '2018-10-11 16:15:23');

-- --------------------------------------------------------

--
-- 資料表結構 `plan_trip`
--

CREATE TABLE `plan_trip` (
  `pt_id` int(6) UNSIGNED NOT NULL,
  `pt_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `pt_hours` int(6) NOT NULL,
  `pt_spend` int(30) NOT NULL,
  `pt_date` date NOT NULL,
  `pt_usid` int(6) NOT NULL,
  `pt_usname` varchar(30) CHARACTER SET utf8 NOT NULL,
  `pt_status` int(11) NOT NULL,
  `pt_updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `plan_trip`
--

INSERT INTO `plan_trip` (`pt_id`, `pt_name`, `pt_hours`, `pt_spend`, `pt_date`, `pt_usid`, `pt_usname`, `pt_status`, `pt_updatedate`) VALUES
(25, '指導課程', 3, 1500, '2018-08-20', 8, '使用者', 2, '2018-09-10 17:45:33'),
(29, '測試新增行程', 5, 500, '2018-09-02', 8, '使用者', 2, '0000-00-00 00:00:00'),
(40, '測試員第二個行程', 3, 300, '2018-09-08', 16, '測試員', 2, '2018-09-05 15:12:38'),
(43, '小明行程', 4, 300, '2018-09-06', 6, '王小明', 2, '2018-09-10 16:51:48'),
(54, '456456', 2, 1000, '2018-09-03', 2, 'test1234', 2, '0000-00-00 00:00:00'),
(57, '中秋烤肉11', 3, 300, '2018-09-22', 8, '使用者', 2, '2018-09-25 15:46:28'),
(62, '我的行程', 8, 200, '2018-09-13', 8, '使用者', 2, '2018-09-13 16:00:00'),
(63, '0912', 6, 1120, '2018-09-13', 8, '使用者', 2, '2018-09-13 16:00:00'),
(64, '新增0913142', 5, 910, '2018-09-15', 16, '測試員', 2, '2018-09-19 16:42:22'),
(65, '0913', 6, 500, '2018-09-21', 8, '使用者', 2, '2018-09-25 15:46:28'),
(67, '玩一天', 5, 500, '2018-09-23', 2, 'test1234', 2, '2018-09-25 15:46:28'),
(68, '測試新增隨機', 4, 270, '2018-09-23', 8, '使用者', 2, '2018-09-25 15:46:28'),
(69, '45244545', 3, 1500, '2018-09-30', 6, '王小明', 2, '2018-09-30 16:34:17'),
(77, '測試新增隨機0917', 8, 770, '2018-09-24', 8, '使用者', 2, '2018-09-25 15:46:28'),
(78, '測試新增879789', 8, 1540, '2018-09-25', 8, '使用者', 2, '2018-09-19 16:42:34'),
(80, 'test123526', 6, 570, '2018-09-25', 18, 'test123', 2, '2018-09-19 16:42:39'),
(81, '測試新增02165', 6, 570, '2018-09-26', 16, '測試員', 2, '2018-09-26 16:39:56'),
(83, '測試新增09/18', 3, 560, '2018-09-20', 6, '王小明', 2, '2018-09-25 15:46:28'),
(89, '123456測試1', 5, 1120, '2018-09-25', 6, '王小明', 2, '2018-09-25 16:01:23'),
(90, '新增132', 14, 1270, '2018-09-23', 10, '測試人員11', 2, '2018-09-25 15:46:28'),
(91, '測試新增0920', 9, 1200, '2018-09-30', 2, 'test1234', 2, '2018-09-30 16:34:17'),
(92, '測試新增123', 7, 530, '2018-10-07', 8, '使用者', 2, '2018-10-07 17:50:54'),
(93, '測試新增1012', 7, 1500, '2018-11-30', 2, 'test1234', 1, '2018-10-11 16:15:23');

-- --------------------------------------------------------

--
-- 資料表結構 `question`
--

CREATE TABLE `question` (
  `qu_id` int(6) UNSIGNED NOT NULL,
  `qu_question` varchar(30) CHARACTER SET utf8 NOT NULL,
  `qu_answer` varchar(30) CHARACTER SET utf8 NOT NULL,
  `qu_updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `question_order`
--

CREATE TABLE `question_order` (
  `qo_id` int(6) UNSIGNED NOT NULL,
  `qo_type` int(6) NOT NULL,
  `qo_updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `time_types`
--

CREATE TABLE `time_types` (
  `ty_id` int(6) UNSIGNED NOT NULL,
  `ty_type` int(6) NOT NULL,
  `ty_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `ty_updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `time_types`
--

INSERT INTO `time_types` (`ty_id`, `ty_type`, `ty_name`, `ty_updatedate`) VALUES
(1, 1, '早', '2018-09-05 14:49:17'),
(2, 2, '午', '2018-09-05 14:49:17'),
(3, 3, '晚', '2018-09-05 14:49:17');

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `us_id` int(6) UNSIGNED NOT NULL,
  `us_account` varchar(30) NOT NULL,
  `us_password` varchar(60) NOT NULL,
  `us_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `us_gender` varchar(11) NOT NULL,
  `us_admin` varchar(11) NOT NULL,
  `us_status` int(11) NOT NULL,
  `us_email` varchar(30) CHARACTER SET utf8 NOT NULL,
  `us_last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `us_updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `user`
--

INSERT INTO `user` (`us_id`, `us_account`, `us_password`, `us_name`, `us_gender`, `us_admin`, `us_status`, `us_email`, `us_last_login`, `us_updatedate`) VALUES
(1, 'admin0000', '$2y$10$L7eoYt3kc0IEJ1OnCojiuOliijTd2JnI07IOr9lg7OXlUGa2J6rSm', '系統管理員', '', 'Y', 1, '', '2018-10-18 19:08:33', '2018-10-18 19:08:33'),
(2, 'tset1234', '$2y$10$61w3T1WGXb5XuBZ6qsF8Te9Wy1b/Ea/3a/tjZbtIBRvdkKcve/PfK', 'test1234', '', 'N', 1, '', '0000-00-00 00:00:00', '2018-08-29 15:05:50'),
(4, 'asd123', '$2y$10$p5FduvHXiZUWFcu9Bd0.seaMEhHCFI0lR3e29719Jf.Ty0K3U25uK', 'asd123', '', 'N', 1, '', '2018-08-21 16:45:49', '2018-08-29 15:06:18'),
(5, 'testas123', '$2y$10$/i8wtXjE.gFU7R/sddVOleWyefQpAx/r03I9Ey9dC0EcMb9f1VSWW', 'testas123', 'R', 'N', 1, '', '2018-08-22 15:48:38', '2018-10-16 16:54:35'),
(6, 'test0823', '$2y$10$ebQu3oY6QDpCSaoXJwqsGu0aSmLJBCIsxuryIRrGoLuuMSFV7mhmS', '王小明', 'R', 'N', 1, 'ming@yahoo.com.tw', '2018-08-23 15:39:51', '2018-10-12 18:17:09'),
(7, 'test0000', '$2y$10$ZdSm7YNZn9XeyJ2ecC2cZOaduSUdcV/JPWRmGDEBa78hLIsEr6uwe', '測試人員', 'S', 'N', 1, 'test0110@yahoo.com.tw', '2018-10-16 15:05:38', '2018-10-16 15:05:38'),
(8, 'user0000', '$2y$10$HHm/U3zjZQHjvtQayOaXrObmJagGNhAACZO/3eaPrx1SFupPNOWW6', '使用者', 'R', 'N', 1, 'abc23411324@gmail.com', '2018-10-18 18:45:15', '2018-10-18 18:45:15'),
(9, 'test0831', '$2y$10$MjhumnQuKvXZFq1aQAknteJ6fNdpt/fnKasw3HC5Cd2u5nIxF4HPa', 'test0831', '', 'N', 1, '', '2018-08-31 13:17:12', '2018-08-31 13:17:13'),
(10, 'user111222', '$2y$10$nX9S2I6cBcL5Xc7ttuRkf.Q7rlkDvM.T4kV7fzsgAaS4pngkXtQLe', '測試人員11', 'R', 'N', 1, 'work12@yahoo.com.tw', '2018-08-31 14:07:01', '2018-08-31 16:26:09'),
(12, 'peter', '$2y$10$nThXAOkA.wkk8Ak/343u5.jiVm6XWwPsEr7lxMi8FFf9gdvO7sXS2', 'fuck', 'S', 'N', 1, 'peter@yahoo.com.ee', '2018-08-31 14:35:26', '2018-08-31 14:40:43'),
(13, 'test123456', '$2y$10$koV6c1.un2vO9J.MdxIBVOkSiwGBnMsQT5azFfvPr/ik4Qd0z8bLq', 'test123456', 'R', 'N', 2, 'tset123456@yahoo.com.tw', '2018-08-31 16:16:21', '2018-09-06 17:52:47'),
(16, 'eric123456', '$2y$10$pedpPLPdJCFLqPGNW3wpg.7BsJx6sjabvyP6YHCTtjtUi8bw7wJOC', '測試員', 'R', 'N', 1, 'eric123456@gmail.com', '2018-10-16 18:23:32', '2018-10-16 18:23:32'),
(17, 'test0904', '$2y$10$IYpV.q0siF77IxpM4bSRgO16Yv9ALK8ZwashRHkt6Q185bnCPWi72', 'test0904', '', 'N', 1, '', '2018-09-03 16:37:50', '2018-09-03 16:37:51'),
(18, 'test123', '$2y$10$IS7pnlvg1XpL03qZSCwXKORpKbgHv.25cTBVT9ziWFXO.qtJLyRrm', 'test123', '', 'N', 1, '', '2018-09-03 16:43:40', '2018-09-03 16:43:40'),
(19, 'testadd123', '$2y$10$uKiAGzv6tLkF.d0/OKZf8OgUOuL7RjIQG2A7vgf18BzLKSbOjA5IC', '測試新增停用', 'S', 'N', 2, 'testadd123@yahoo.com.tw', '2018-09-04 13:50:44', '2018-09-04 13:50:44'),
(20, 'teststop12', '$2y$10$zzazbzxzbsuPc0PIx1ikQeI853oWLSW6S7sha4NPkZHyEU8h1WVJS', '測試停用', 'R', 'N', 2, 'teststop12@yahoo.com.tw', '2018-09-04 13:52:03', '2018-09-04 13:52:03'),
(21, 'qwer123', '$2y$10$ry0hweUeYlkXiKOXPmccfO.z4Si2KuTLrbSr/W.KNtcLN0QpRvJqy', '今天', 'R', 'N', 1, 'qwer123@gmail.com', '2018-09-06 14:00:23', '2018-09-06 14:02:09'),
(25, 'test789456', '$2y$10$BKJma9LII3wq5CFEa9PR6e2CSH13nYUnSmDueg.4wGq4C7hyeEL0O', 'test789456', '', 'N', 1, '', '2018-10-17 18:11:05', '2018-10-17 18:11:05'),
(26, 'dfrgdfg123', '$2y$10$liX0Hs7eotVrp7SDge.qgO6YyRiDGRa1Ivd.FiZNQyfZ9xY/T.2mm', 'dfrgdfg123', '', 'N', 1, '', '2018-10-17 18:17:11', '2018-10-17 18:17:11'),
(27, 'rtert145263', '$2y$10$Uo9NsCK4X76.bJ.YYjFj1O2rrsO8YMKJn/57pmidKPO7dqDNDoLxu', 'rtert145263', '', 'N', 1, '', '2018-10-17 18:28:02', '2018-10-17 18:28:02'),
(28, 'wer13156', '$2y$10$fKxGFp.ldYleMZ79g/DToOh92gW48EF2aFDRC3MOdyfV0rA2mZXU2', 'wer13156', '', 'N', 1, '', '2018-10-17 18:32:11', '2018-10-17 18:32:11');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`ac_id`);

--
-- 資料表索引 `activity_types`
--
ALTER TABLE `activity_types`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `activity_weather`
--
ALTER TABLE `activity_weather`
  ADD PRIMARY KEY (`aw_id`);

--
-- 資料表索引 `plan_acname`
--
ALTER TABLE `plan_acname`
  ADD PRIMARY KEY (`pn_id`);

--
-- 資料表索引 `plan_trip`
--
ALTER TABLE `plan_trip`
  ADD PRIMARY KEY (`pt_id`);

--
-- 資料表索引 `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`qu_id`);

--
-- 資料表索引 `question_order`
--
ALTER TABLE `question_order`
  ADD PRIMARY KEY (`qo_id`);

--
-- 資料表索引 `time_types`
--
ALTER TABLE `time_types`
  ADD PRIMARY KEY (`ty_id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`us_id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `activity`
--
ALTER TABLE `activity`
  MODIFY `ac_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 使用資料表 AUTO_INCREMENT `activity_types`
--
ALTER TABLE `activity_types`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表 AUTO_INCREMENT `activity_weather`
--
ALTER TABLE `activity_weather`
  MODIFY `aw_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表 AUTO_INCREMENT `plan_acname`
--
ALTER TABLE `plan_acname`
  MODIFY `pn_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- 使用資料表 AUTO_INCREMENT `plan_trip`
--
ALTER TABLE `plan_trip`
  MODIFY `pt_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- 使用資料表 AUTO_INCREMENT `question`
--
ALTER TABLE `question`
  MODIFY `qu_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `question_order`
--
ALTER TABLE `question_order`
  MODIFY `qo_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `time_types`
--
ALTER TABLE `time_types`
  MODIFY `ty_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `us_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
