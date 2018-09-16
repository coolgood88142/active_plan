-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2018-09-16 06:03:38
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
  `ac_timetype` int(30) NOT NULL,
  `ac_updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `activity`
--

INSERT INTO `activity` (`ac_id`, `ac_type`, `ac_name`, `ac_weather`, `ac_drive`, `ac_carry`, `ac_spend`, `ac_hours`, `ac_timetype`, `ac_updatedate`) VALUES
(1, 1, '籃球', '晴天', 1, '籃球、毛巾、水瓶', 0, 2, 4, '2018-09-05 14:51:40'),
(2, 1, '保齡球', '不拘', 2, '錢包、雨傘、毛巾、水瓶', 300, 3, 5, '2018-09-05 14:53:47'),
(3, 1, '騎腳踏車', '晴天、陰天', 1, '錢包、雨傘', 200, 2, 5, '2018-09-05 14:53:43'),
(4, 2, '逛夜市', '不拘', 1, '錢包、雨傘', 500, 2, 3, '2018-09-05 14:51:54'),
(5, 2, '吃飯', '不拘', 0, '錢包、雨傘', 500, 1, 4, '2018-09-05 14:51:57'),
(6, 2, '看電影', '不拘', 1, '錢包、雨傘', 270, 3, 4, '2018-09-05 14:52:00'),
(7, 3, '戶外走走', '晴天、陰天', 1, '毛巾、水瓶', 0, 1, 5, '2018-09-11 16:15:08'),
(8, 3, '動物園', '晴天、陰天', 2, '毛巾、水瓶', 60, 2, 5, '2018-09-05 14:53:22'),
(9, 3, '故宮博物院', '晴天、陰天', 2, '毛巾、水瓶', 350, 2, 5, '2018-09-05 14:53:24'),
(10, 3, '兒童樂園', '晴天、陰天', 2, '毛巾、水瓶', 200, 2, 5, '2018-09-05 14:53:26'),
(11, 3, '貓空纜車', '晴天、陰天', 2, '毛巾、水瓶', 380, 3, 5, '2018-09-05 14:53:28'),
(12, 3, '上課', '不拘', 2, '錢包、筆記型電腦', 1000, 2, 2, '2018-09-05 14:53:31'),
(13, 1, '羽毛球', '晴天', 1, '羽毛球拍、羽毛球、毛巾、水瓶', 0, 1, 4, '2018-09-05 14:53:35'),
(14, 2, '測試活動項目', '晴天', 2, '測試....', 200, 3, 0, '2018-09-06 13:47:59'),
(15, 2, '烤肉', '晴天、陰天', 1, '烤肉用具、食物蔬菜、飲料、水瓶', 300, 3, 4, '2018-09-11 18:06:01');

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
(3, 3, '雨天', '2018-09-09 14:38:22'),
(4, 4, '不拘', '2018-09-09 14:38:22'),
(5, 5, '晴天、陰天', '2018-09-09 14:38:22');

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
(27, 62, 14, '測試活動項目', 3, 1, '2018-09-14 14:33:33'),
(29, 63, 9, '故宮博物院', 2, 1, '2018-09-14 14:33:36'),
(30, 63, 5, '吃飯', 1, 1, '2018-09-14 14:33:38'),
(31, 63, 6, '看電影', 3, 1, '2018-09-14 14:33:40'),
(32, 64, 8, '動物園', 2, 1, '2018-09-14 14:33:42'),
(33, 64, 5, '吃飯', 1, 1, '2018-09-14 14:33:44'),
(34, 64, 9, '故宮博物院', 2, 1, '2018-09-14 14:33:46'),
(35, 65, 14, '測試活動項目', 3, 1, '2018-09-14 14:33:48'),
(36, 65, 15, '烤肉', 3, 1, '2018-09-14 14:33:49'),
(39, 67, 2, '保齡球', 3, 0, '2018-09-15 19:55:38'),
(40, 67, 10, '兒童樂園', 2, 0, '2018-09-15 19:55:38'),
(41, 68, 6, '看電影', 3, 0, '2018-09-15 20:01:39'),
(42, 68, 15, '羽毛球', 1, 0, '2018-09-15 20:01:39'),
(43, 69, 12, '上課', 2, 0, '2018-09-15 20:02:31'),
(44, 69, 2, '保齡球', 3, 0, '2018-09-15 20:02:31'),
(45, 70, 1, '籃球', 2, 0, '2018-09-15 20:34:33');

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
(57, '中秋烤肉11', 3, 300, '2018-09-22', 8, '使用者', 1, '2018-09-12 13:10:25'),
(62, '我的行程', 8, 200, '2018-09-13', 8, '使用者', 2, '2018-09-13 16:00:00'),
(63, '0912', 6, 1120, '2018-09-13', 8, '使用者', 2, '2018-09-13 16:00:00'),
(64, '新增0913', 5, 910, '2018-09-22', 16, '測試員', 1, '2018-09-12 13:13:47'),
(65, '0913', 6, 500, '2018-09-21', 8, '使用者', 1, '2018-09-13 15:40:06'),
(67, '4536456', 5, 500, '2018-09-23', 2, 'test1234', 1, '2018-09-15 19:55:38'),
(68, '測試新增隨機', 4, 270, '2018-09-23', 8, '使用者', 1, '2018-09-15 20:01:39'),
(69, '4524111111', 5, 1300, '2018-09-26', 6, '王小明', 1, '2018-09-15 20:02:31'),
(70, '裡拜六打籃球', 2, 0, '2018-09-22', 8, '使用者', 1, '2018-09-15 20:34:33');

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
(3, 3, '晚', '2018-09-05 14:49:17'),
(4, 4, '全部', '2018-09-05 14:49:35'),
(5, 5, '早午', '2018-09-05 14:53:03');

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
(1, 'admin0000', '$2y$10$L7eoYt3kc0IEJ1OnCojiuOliijTd2JnI07IOr9lg7OXlUGa2J6rSm', '系統管理員', '', 'Y', 1, '', '2018-09-16 03:25:36', '2018-09-16 03:25:36'),
(2, 'tset1234', '$2y$10$61w3T1WGXb5XuBZ6qsF8Te9Wy1b/Ea/3a/tjZbtIBRvdkKcve/PfK', 'test1234', '', 'N', 1, '', '0000-00-00 00:00:00', '2018-08-29 15:05:50'),
(4, 'asd123', '$2y$10$p5FduvHXiZUWFcu9Bd0.seaMEhHCFI0lR3e29719Jf.Ty0K3U25uK', 'asd123', '', 'N', 1, '', '2018-08-21 16:45:49', '2018-08-29 15:06:18'),
(5, 'testas123', '$2y$10$oPK8JgYjRO/36UcARq5RwOk/pjvGsbqNoCAaJudoXaf6O8y7N.wYq', 'testas123', '', 'N', 1, '', '2018-08-22 15:48:38', '2018-08-29 15:06:15'),
(6, 'test0823', '$2y$10$I5b1bGQqQsPqwsY45UZH/e2fPE/9zwwlUTM7O.OZWotO/DGjeRNqS', '王小明', 'R', 'N', 1, 'ming@yahoo.com.tw', '2018-08-23 15:39:51', '2018-08-30 13:44:18'),
(7, 'test0000', '$2y$10$ZdSm7YNZn9XeyJ2ecC2cZOaduSUdcV/JPWRmGDEBa78hLIsEr6uwe', '測試人員', 'S', 'N', 1, 'test0110@yahoo.com.tw', '2018-08-23 16:09:57', '2018-08-30 13:42:22'),
(8, 'user0000', '$2y$10$HHm/U3zjZQHjvtQayOaXrObmJagGNhAACZO/3eaPrx1SFupPNOWW6', '使用者', 'R', 'N', 1, 'abc23411324@gmail.com', '2018-09-15 20:11:06', '2018-09-15 20:11:06'),
(9, 'test0831', '$2y$10$MjhumnQuKvXZFq1aQAknteJ6fNdpt/fnKasw3HC5Cd2u5nIxF4HPa', 'test0831', '', 'N', 1, '', '2018-08-31 13:17:12', '2018-08-31 13:17:13'),
(10, 'user111222', '$2y$10$nX9S2I6cBcL5Xc7ttuRkf.Q7rlkDvM.T4kV7fzsgAaS4pngkXtQLe', '測試人員11', 'R', 'N', 1, 'work12@yahoo.com.tw', '2018-08-31 14:07:01', '2018-08-31 16:26:09'),
(12, 'peter', '$2y$10$nThXAOkA.wkk8Ak/343u5.jiVm6XWwPsEr7lxMi8FFf9gdvO7sXS2', 'fuck', 'S', 'N', 1, 'peter@yahoo.com.ee', '2018-08-31 14:35:26', '2018-08-31 14:40:43'),
(13, 'test123456', '$2y$10$koV6c1.un2vO9J.MdxIBVOkSiwGBnMsQT5azFfvPr/ik4Qd0z8bLq', 'test123456', 'R', 'N', 2, 'tset123456@yahoo.com.tw', '2018-08-31 16:16:21', '2018-09-06 17:52:47'),
(16, 'eric123456', '$2y$10$pedpPLPdJCFLqPGNW3wpg.7BsJx6sjabvyP6YHCTtjtUi8bw7wJOC', '測試員', 'R', 'N', 1, 'eric123456@gmail.com', '2018-09-15 12:40:34', '2018-09-15 12:40:34'),
(17, 'test0904', '$2y$10$IYpV.q0siF77IxpM4bSRgO16Yv9ALK8ZwashRHkt6Q185bnCPWi72', 'test0904', '', 'N', 1, '', '2018-09-03 16:37:50', '2018-09-03 16:37:51'),
(18, 'test123', '$2y$10$IS7pnlvg1XpL03qZSCwXKORpKbgHv.25cTBVT9ziWFXO.qtJLyRrm', 'test123', '', 'N', 1, '', '2018-09-03 16:43:40', '2018-09-03 16:43:40'),
(19, 'testadd123', '$2y$10$uKiAGzv6tLkF.d0/OKZf8OgUOuL7RjIQG2A7vgf18BzLKSbOjA5IC', '測試新增停用', 'S', 'N', 2, 'testadd123@yahoo.com.tw', '2018-09-04 13:50:44', '2018-09-04 13:50:44'),
(20, 'teststop12', '$2y$10$zzazbzxzbsuPc0PIx1ikQeI853oWLSW6S7sha4NPkZHyEU8h1WVJS', '測試停用', 'R', 'N', 2, 'teststop12@yahoo.com.tw', '2018-09-04 13:52:03', '2018-09-04 13:52:03'),
(21, 'qwer123', '$2y$10$ry0hweUeYlkXiKOXPmccfO.z4Si2KuTLrbSr/W.KNtcLN0QpRvJqy', '今天', 'R', 'N', 1, 'qwer123@gmail.com', '2018-09-06 14:00:23', '2018-09-06 14:02:09');

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
  MODIFY `aw_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表 AUTO_INCREMENT `plan_acname`
--
ALTER TABLE `plan_acname`
  MODIFY `pn_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- 使用資料表 AUTO_INCREMENT `plan_trip`
--
ALTER TABLE `plan_trip`
  MODIFY `pt_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- 使用資料表 AUTO_INCREMENT `time_types`
--
ALTER TABLE `time_types`
  MODIFY `ty_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `us_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
