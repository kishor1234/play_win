-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 31, 2018 at 04:14 PM
-- Server version: 5.7.24-0ubuntu0.16.04.1
-- PHP Version: 5.6.37-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lottery`
--

-- --------------------------------------------------------

--
-- Table structure for table `claim`
--

CREATE TABLE `claim` (
  `id` int(11) NOT NULL,
  `enteryid` int(11) NOT NULL,
  `winnumber` text NOT NULL,
  `gametime` varchar(200) NOT NULL,
  `gameetime` varchar(200) DEFAULT NULL,
  `gameid` int(11) NOT NULL,
  `cdate` varchar(200) NOT NULL,
  `claimstatus` int(11) NOT NULL DEFAULT '1',
  `isDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `enduser`
--

CREATE TABLE `enduser` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `password` varchar(200) NOT NULL DEFAULT '123456789',
  `name` varchar(100) NOT NULL,
  `mobileno` varchar(100) NOT NULL,
  `balance` decimal(18,2) NOT NULL DEFAULT '0.00',
  `ip` varchar(100) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '0',
  `create_on` varchar(100) NOT NULL,
  `isdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enduser`
--

INSERT INTO `enduser` (`id`, `userid`, `password`, `name`, `mobileno`, `balance`, `ip`, `is_active`, `create_on`, `isdate`) VALUES
(1, 10001, '123456789', 'kishor shankar shinde', '9890180228', '189784.80', '127.0.0.1', 0, '2018-10-15', '2018-10-31 09:34:33'),
(2, 10002, 'Kishor@123', 'Rupali k Shinde', '7020847416', '2429.00', '127.0.0.1', 0, '2018-10-15', '2018-10-26 08:48:49');

-- --------------------------------------------------------

--
-- Table structure for table `entry`
--

CREATE TABLE `entry` (
  `id` int(11) NOT NULL,
  `game` int(11) NOT NULL DEFAULT '0',
  `own` int(11) DEFAULT '0',
  `point` text NOT NULL,
  `amount` int(11) NOT NULL,
  `enterydate` varchar(100) NOT NULL,
  `totalpoint` int(11) NOT NULL,
  `winstatus` int(11) NOT NULL DEFAULT '0',
  `winamt` decimal(18,2) NOT NULL DEFAULT '0.00',
  `claimstatus` int(11) NOT NULL DEFAULT '0',
  `isDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip` varchar(200) NOT NULL,
  `gametime` varchar(200) NOT NULL,
  `gameendtime` varchar(10) NOT NULL,
  `gametimeid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gametime`
--

CREATE TABLE `gametime` (
  `id` int(11) NOT NULL,
  `stime` varchar(50) NOT NULL,
  `etime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gametime`
--

INSERT INTO `gametime` (`id`, `stime`, `etime`) VALUES
(1, '10:00:00', '10:05:00'),
(2, '10:05:00', '10:10:00'),
(3, '10:10:00', '10:15:00'),
(4, '10:15:00', '10:20:00'),
(5, '10:20:00', '10:25:00'),
(6, '10:25:00', '10:30:00'),
(7, '10:30:00', '10:35:00'),
(8, '10:35:00', '10:40:00'),
(9, '10:40:00', '10:45:00'),
(10, '10:45:00', '10:50:00'),
(11, '10:50:00', '10:55:00'),
(12, '10:55:00', '11:00:00'),
(13, '11:00:00', '11:05:00'),
(14, '11:05:00', '11:10:00'),
(15, '11:10:00', '11:15:00'),
(16, '11:15:00', '11:20:00'),
(17, '11:20:00', '11:25:00'),
(18, '11:25:00', '11:30:00'),
(19, '11:30:00', '11:35:00'),
(20, '11:35:00', '11:40:00'),
(21, '11:40:00', '11:45:00'),
(22, '11:45:00', '11:50:00'),
(23, '11:50:00', '11:55:00'),
(24, '11:55:00', '12:00:00'),
(25, '12:00:00', '12:05:00'),
(26, '12:05:00', '12:10:00'),
(27, '12:10:00', '12:15:00'),
(28, '12:15:00', '12:20:00'),
(29, '12:20:00', '12:25:00'),
(30, '12:25:00', '12:30:00'),
(31, '12:30:00', '12:35:00'),
(32, '12:35:00', '12:40:00'),
(33, '12:40:00', '12:45:00'),
(34, '12:45:00', '12:50:00'),
(35, '12:50:00', '12:55:00'),
(36, '12:55:00', '13:00:00'),
(37, '13:00:00', '13:05:00'),
(38, '13:05:00', '13:10:00'),
(39, '13:10:00', '13:15:00'),
(40, '13:15:00', '13:20:00'),
(41, '13:20:00', '13:25:00'),
(42, '13:25:00', '13:30:00'),
(43, '13:30:00', '13:35:00'),
(44, '13:35:00', '13:40:00'),
(45, '13:40:00', '13:45:00'),
(46, '13:45:00', '13:50:00'),
(47, '13:50:00', '13:55:00'),
(48, '13:55:00', '14:00:00'),
(49, '14:00:00', '14:05:00'),
(50, '14:05:00', '14:10:00'),
(51, '14:10:00', '14:15:00'),
(52, '14:15:00', '14:20:00'),
(53, '14:20:00', '14:25:00'),
(54, '14:25:00', '14:30:00'),
(55, '14:30:00', '14:35:00'),
(56, '14:35:00', '14:40:00'),
(57, '14:40:00', '14:45:00'),
(58, '14:45:00', '14:50:00'),
(59, '14:50:00', '14:55:00'),
(60, '14:55:00', '15:00:00'),
(61, '15:00:00', '15:05:00'),
(62, '15:05:00', '15:10:00'),
(63, '15:10:00', '15:15:00'),
(64, '15:15:00', '15:20:00'),
(65, '15:20:00', '15:25:00'),
(66, '15:25:00', '15:30:00'),
(67, '15:30:00', '15:35:00'),
(68, '15:35:00', '15:40:00'),
(69, '15:40:00', '15:45:00'),
(70, '15:45:00', '15:50:00'),
(71, '15:50:00', '15:55:00'),
(72, '15:55:00', '16:00:00'),
(73, '16:00:00', '16:05:00'),
(74, '16:05:00', '16:10:00'),
(75, '16:10:00', '16:15:00'),
(76, '16:15:00', '16:20:00'),
(77, '16:20:00', '16:25:00'),
(78, '16:25:00', '16:30:00'),
(79, '16:30:00', '16:35:00'),
(80, '16:35:00', '16:40:00'),
(81, '16:40:00', '16:45:00'),
(82, '16:45:00', '16:50:00'),
(83, '16:50:00', '16:55:00'),
(84, '16:55:00', '17:00:00'),
(85, '17:00:00', '17:05:00'),
(86, '17:05:00', '17:10:00'),
(87, '17:10:00', '17:15:00'),
(88, '17:15:00', '17:20:00'),
(89, '17:20:00', '17:25:00'),
(90, '17:25:00', '17:30:00'),
(91, '17:30:00', '17:35:00'),
(92, '17:35:00', '17:40:00'),
(93, '17:40:00', '17:45:00'),
(94, '17:45:00', '17:50:00'),
(95, '17:50:00', '17:55:00'),
(96, '17:55:00', '18:00:00'),
(97, '18:00:00', '18:05:00'),
(98, '18:05:00', '18:10:00'),
(99, '18:10:00', '18:15:00'),
(100, '18:15:00', '18:20:00'),
(101, '18:20:00', '18:25:00'),
(102, '18:25:00', '18:30:00'),
(103, '18:30:00', '18:35:00'),
(104, '18:35:00', '18:40:00'),
(105, '18:40:00', '18:45:00'),
(106, '18:45:00', '18:50:00'),
(107, '18:50:00', '18:55:00'),
(108, '18:55:00', '19:00:00'),
(109, '19:00:00', '19:05:00'),
(110, '19:05:00', '19:10:00'),
(111, '19:10:00', '19:15:00'),
(112, '19:15:00', '19:20:00'),
(113, '19:20:00', '19:25:00'),
(114, '19:25:00', '19:30:00'),
(115, '19:30:00', '19:35:00'),
(116, '19:35:00', '19:40:00'),
(117, '19:40:00', '19:45:00'),
(118, '19:45:00', '19:50:00'),
(119, '19:50:00', '19:55:00'),
(120, '19:55:00', '20:00:00'),
(121, '20:00:00', '20:05:00'),
(122, '20:05:00', '20:10:00'),
(123, '20:10:00', '20:15:00'),
(124, '20:15:00', '20:20:00'),
(125, '20:20:00', '20:25:00'),
(126, '20:25:00', '20:30:00'),
(127, '20:30:00', '20:35:00'),
(128, '20:35:00', '20:40:00'),
(129, '20:40:00', '20:45:00'),
(130, '20:45:00', '20:50:00'),
(131, '20:50:00', '20:55:00'),
(132, '20:55:00', '21:00:00'),
(133, '21:00:00', '21:05:00'),
(134, '21:05:00', '21:10:00'),
(135, '21:10:00', '21:15:00'),
(136, '21:15:00', '21:20:00'),
(137, '21:20:00', '21:25:00'),
(138, '21:25:00', '21:30:00'),
(139, '21:30:00', '21:35:00'),
(140, '21:35:00', '21:40:00'),
(141, '21:40:00', '21:45:00'),
(142, '21:45:00', '21:50:00'),
(143, '21:50:00', '21:55:00'),
(144, '21:55:00', '22:00:00'),
(145, '22:00:00', '22:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `lottoweight`
--

CREATE TABLE `lottoweight` (
  `number` varchar(100) NOT NULL,
  `weight` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lottoweight`
--

INSERT INTO `lottoweight` (`number`, `weight`) VALUES
('00', 0),
('01', 0),
('02', 0),
('03', 0),
('04', 0),
('05', 0),
('06', 0),
('07', 0),
('08', 0),
('09', 0),
('10', 0),
('11', 0),
('12', 0),
('13', 0),
('14', 0),
('15', 0),
('16', 0),
('17', 0),
('18', 0),
('19', 0),
('20', 0),
('21', 0),
('22', 0),
('23', 0),
('24', 0),
('25', 0),
('26', 0),
('27', 0),
('28', 0),
('29', 0),
('30', 0),
('31', 0),
('32', 0),
('33', 0),
('34', 0),
('35', 0),
('36', 0),
('37', 0),
('38', 0),
('39', 0),
('40', 0),
('41', 0),
('42', 0),
('43', 0),
('44', 0),
('45', 0),
('46', 0),
('47', 0),
('48', 0),
('49', 0),
('50', 0),
('51', 0),
('52', 0),
('53', 0),
('54', 0),
('55', 0),
('56', 0),
('57', 0),
('58', 0),
('59', 0),
('60', 0),
('61', 0),
('62', 0),
('63', 0),
('64', 0),
('65', 0),
('66', 0),
('67', 0),
('68', 0),
('69', 0),
('70', 0),
('71', 0),
('72', 0),
('73', 0),
('74', 0),
('75', 0),
('76', 0),
('77', 0),
('78', 0),
('79', 0),
('80', 0),
('81', 0),
('82', 0),
('83', 0),
('84', 0),
('85', 0),
('86', 0),
('87', 0),
('88', 0),
('89', 0),
('90', 0),
('91', 0),
('92', 0),
('93', 0),
('94', 0),
('95', 0),
('96', 0),
('97', 0),
('98', 0),
('99', 0);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `msg` text,
  `on_date` varchar(200) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT '0',
  `is_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `n` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 MAX_ROWS=5;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `debit` decimal(18,2) DEFAULT NULL,
  `credit` decimal(18,2) DEFAULT NULL,
  `remark` text,
  `balance` decimal(18,2) DEFAULT NULL,
  `ip` varchar(100) NOT NULL,
  `create_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `balance` decimal(18,2) NOT NULL DEFAULT '0.00',
  `lsession` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `balance`, `lsession`) VALUES
(1, 'admin', 'admin', '817506.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `usertranscation`
--

CREATE TABLE `usertranscation` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `invoiceno` int(11) NOT NULL,
  `netamt` decimal(18,2) NOT NULL,
  `discount` decimal(18,2) NOT NULL,
  `discountamt` decimal(18,2) NOT NULL,
  `total` decimal(18,2) NOT NULL,
  `ip` varchar(200) NOT NULL,
  `on_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wheelgtime`
--

CREATE TABLE `wheelgtime` (
  `id` int(11) NOT NULL,
  `stime` varchar(200) NOT NULL,
  `etime` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wheelgtime`
--

INSERT INTO `wheelgtime` (`id`, `stime`, `etime`) VALUES
(1, '10:03:00', '10:08:00'),
(2, '10:08:00', '10:13:00'),
(3, '10:13:00', '10:18:00'),
(4, '10:18:00', '10:23:00'),
(5, '10:23:00', '10:28:00'),
(6, '10:28:00', '10:33:00'),
(7, '10:33:00', '10:38:00'),
(8, '10:38:00', '10:43:00'),
(9, '10:43:00', '10:48:00'),
(10, '10:48:00', '10:53:00'),
(11, '10:53:00', '10:58:00'),
(12, '10:58:00', '11:03:00'),
(13, '11:03:00', '11:08:00'),
(14, '11:08:00', '11:13:00'),
(15, '11:13:00', '11:18:00'),
(16, '11:18:00', '11:23:00'),
(17, '11:23:00', '11:28:00'),
(18, '11:28:00', '11:33:00'),
(19, '11:33:00', '11:38:00'),
(20, '11:38:00', '11:43:00'),
(21, '11:43:00', '11:48:00'),
(22, '11:48:00', '11:53:00'),
(23, '11:53:00', '11:58:00'),
(24, '11:58:00', '12:03:00'),
(25, '12:03:00', '12:08:00'),
(26, '12:08:00', '12:13:00'),
(27, '12:13:00', '12:18:00'),
(28, '12:18:00', '12:23:00'),
(29, '12:23:00', '12:28:00'),
(30, '12:28:00', '12:33:00'),
(31, '12:33:00', '12:38:00'),
(32, '12:38:00', '12:43:00'),
(33, '12:43:00', '12:48:00'),
(34, '12:48:00', '12:53:00'),
(35, '12:53:00', '12:58:00'),
(36, '12:58:00', '13:03:00'),
(37, '13:03:00', '13:08:00'),
(38, '13:08:00', '13:13:00'),
(39, '13:13:00', '13:18:00'),
(40, '13:18:00', '13:23:00'),
(41, '13:23:00', '13:28:00'),
(42, '13:28:00', '13:33:00'),
(43, '13:33:00', '13:38:00'),
(44, '13:38:00', '13:43:00'),
(45, '13:43:00', '13:48:00'),
(46, '13:48:00', '13:53:00'),
(47, '13:53:00', '13:58:00'),
(48, '13:58:00', '14:03:00'),
(49, '14:03:00', '14:08:00'),
(50, '14:08:00', '14:13:00'),
(51, '14:13:00', '14:18:00'),
(52, '14:18:00', '14:23:00'),
(53, '14:23:00', '14:28:00'),
(54, '14:28:00', '14:33:00'),
(55, '14:33:00', '14:38:00'),
(56, '14:38:00', '14:43:00'),
(57, '14:43:00', '14:48:00'),
(58, '14:48:00', '14:53:00'),
(59, '14:53:00', '14:58:00'),
(60, '14:58:00', '15:03:00'),
(61, '15:03:00', '15:08:00'),
(62, '15:08:00', '15:13:00'),
(63, '15:13:00', '15:18:00'),
(64, '15:18:00', '15:23:00'),
(65, '15:23:00', '15:28:00'),
(66, '15:28:00', '15:33:00'),
(67, '15:33:00', '15:38:00'),
(68, '15:38:00', '15:43:00'),
(69, '15:43:00', '15:48:00'),
(70, '15:48:00', '15:53:00'),
(71, '15:53:00', '15:58:00'),
(72, '15:58:00', '16:03:00'),
(73, '16:03:00', '16:08:00'),
(74, '16:08:00', '16:13:00'),
(75, '16:13:00', '16:18:00'),
(76, '16:18:00', '16:23:00'),
(77, '16:23:00', '16:28:00'),
(78, '16:28:00', '16:33:00'),
(79, '16:33:00', '16:38:00'),
(80, '16:38:00', '16:43:00'),
(81, '16:43:00', '16:48:00'),
(82, '16:48:00', '16:53:00'),
(83, '16:53:00', '16:58:00'),
(84, '16:58:00', '17:03:00'),
(85, '17:03:00', '17:08:00'),
(86, '17:08:00', '17:13:00'),
(87, '17:13:00', '17:18:00'),
(88, '17:18:00', '17:23:00'),
(89, '17:23:00', '17:28:00'),
(90, '17:28:00', '17:33:00'),
(91, '17:33:00', '17:38:00'),
(92, '17:38:00', '17:43:00'),
(93, '17:43:00', '17:48:00'),
(94, '17:48:00', '17:53:00'),
(95, '17:53:00', '17:58:00'),
(96, '17:58:00', '18:03:00'),
(97, '18:03:00', '18:08:00'),
(98, '18:08:00', '18:13:00'),
(99, '18:13:00', '18:18:00'),
(100, '18:18:00', '18:23:00'),
(101, '18:23:00', '18:28:00'),
(102, '18:28:00', '18:33:00'),
(103, '18:33:00', '18:38:00'),
(104, '18:38:00', '18:43:00'),
(105, '18:43:00', '18:48:00'),
(106, '18:48:00', '18:53:00'),
(107, '18:53:00', '18:58:00'),
(108, '18:58:00', '19:03:00'),
(109, '19:03:00', '19:08:00'),
(110, '19:08:00', '19:13:00'),
(111, '19:13:00', '19:18:00'),
(112, '19:18:00', '19:23:00'),
(113, '19:23:00', '19:28:00'),
(114, '19:28:00', '19:33:00'),
(115, '19:33:00', '19:38:00'),
(116, '19:38:00', '19:43:00'),
(117, '19:43:00', '19:48:00'),
(118, '19:48:00', '19:53:00'),
(119, '19:53:00', '19:58:00'),
(120, '19:58:00', '20:03:00'),
(121, '20:03:00', '20:08:00'),
(122, '20:08:00', '20:13:00'),
(123, '20:13:00', '20:18:00'),
(124, '20:18:00', '20:23:00'),
(125, '20:23:00', '20:28:00'),
(126, '20:28:00', '20:33:00'),
(127, '20:33:00', '20:38:00'),
(128, '20:38:00', '20:43:00'),
(129, '20:43:00', '20:48:00'),
(130, '20:48:00', '20:53:00'),
(131, '20:53:00', '20:58:00'),
(132, '20:58:00', '21:03:00'),
(133, '21:03:00', '21:08:00'),
(134, '21:08:00', '21:13:00'),
(135, '21:13:00', '21:18:00'),
(136, '21:18:00', '21:23:00'),
(137, '21:23:00', '21:28:00'),
(138, '21:28:00', '21:33:00'),
(139, '21:33:00', '21:38:00'),
(140, '21:38:00', '21:43:00'),
(141, '21:43:00', '21:48:00'),
(142, '21:48:00', '21:53:00'),
(143, '21:53:00', '21:58:00'),
(144, '21:58:00', '22:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `wheelw`
--

CREATE TABLE `wheelw` (
  `id` varchar(100) NOT NULL,
  `weight` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wheelw`
--

INSERT INTO `wheelw` (`id`, `weight`) VALUES
('0', 0),
('1', 0),
('2', 0),
('3', 0),
('4', 0),
('5', 0),
('6', 0),
('7', 0),
('8', 0),
('9', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wheelwiner`
--

CREATE TABLE `wheelwiner` (
  `id` int(11) NOT NULL,
  `gameid` varchar(200) NOT NULL,
  `stime` varchar(200) NOT NULL,
  `etime` varchar(200) NOT NULL,
  `cdate` varchar(200) NOT NULL,
  `rotation` varchar(200) NOT NULL DEFAULT '0',
  `oldrotation` varchar(200) NOT NULL DEFAULT '0',
  `picked` varchar(200) NOT NULL,
  `ps` varchar(200) NOT NULL DEFAULT '0',
  `rng` varchar(200) NOT NULL,
  `is_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wheelwiner`
--

INSERT INTO `wheelwiner` (`id`, `gameid`, `stime`, `etime`, `cdate`, `rotation`, `oldrotation`, `picked`, `ps`, `rng`, `is_date`) VALUES
(1, '64', '15:18:00', '15:23:00', '2018-10-31', '972', '972', '6', '36', '1596', '2018-10-31 09:53:01'),
(2, '65', '15:23:00', '15:28:00', '2018-10-31', '468', '468', '8', '36', '1529', '2018-10-31 09:58:01'),
(3, '66', '15:28:00', '15:33:00', '2018-10-31', '1152', '1152', '2', '36', '1744', '2018-10-31 10:03:00'),
(4, '67', '15:33:00', '15:38:00', '2018-10-31', '432', '432', '3', '36', '1695', '2018-10-31 10:08:01'),
(5, '68', '15:38:00', '15:43:00', '2018-10-31', '1404', '1404', '9', '36', '1486', '2018-10-31 10:13:00'),
(6, '71', '15:53:00', '15:58:00', '2018-10-31', '1224', '1224', '7', '36', '1561', '2018-10-31 10:28:00'),
(7, '73', '16:03:00', '16:08:00', '2018-10-31', '972', '972', '8', '36', '1529', '2018-10-31 10:33:00'),
(8, '73', '16:03:00', '16:08:00', '2018-10-31', '1692', '1692', '9', '36', '1486', '2018-10-31 10:38:00');

-- --------------------------------------------------------

--
-- Table structure for table `winnumber`
--

CREATE TABLE `winnumber` (
  `id` int(11) NOT NULL,
  `gameid` int(11) NOT NULL,
  `gamestime` varchar(100) NOT NULL,
  `gameetime` varchar(100) NOT NULL,
  `gdate` varchar(200) NOT NULL,
  `0` int(11) DEFAULT NULL,
  `1` int(11) DEFAULT NULL,
  `2` int(11) DEFAULT NULL,
  `3` int(11) DEFAULT NULL,
  `4` int(11) DEFAULT NULL,
  `5` int(11) DEFAULT NULL,
  `6` int(11) DEFAULT NULL,
  `7` int(11) DEFAULT NULL,
  `8` int(11) DEFAULT NULL,
  `9` int(11) DEFAULT NULL,
  `isDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `winnumber`
--

INSERT INTO `winnumber` (`id`, `gameid`, `gamestime`, `gameetime`, `gdate`, `0`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `isDate`) VALUES
(1, 65, '15:20:00', '15:25:00', '2018-10-31', 21, 36, 96, 85, 89, 73, 12, 20, 43, 87, '2018-10-31 09:55:00'),
(2, 66, '15:25:00', '15:30:00', '2018-10-31', 24, 21, 0, 71, 69, 4, 2, 43, 87, 72, '2018-10-31 10:00:01'),
(3, 67, '15:30:00', '15:35:00', '2018-10-31', 44, 13, 23, 74, 8, 79, 1, 60, 93, 92, '2018-10-31 10:05:00'),
(4, 68, '15:35:00', '15:40:00', '2018-10-31', 8, 26, 46, 16, 9, 88, 22, 91, 41, 14, '2018-10-31 10:10:01'),
(5, 69, '15:40:00', '15:45:00', '2018-10-31', 43, 36, 82, 68, 46, 24, 51, 42, 17, 4, '2018-10-31 10:15:00'),
(6, 72, '15:55:00', '16:00:00', '2018-10-31', 50, 9, 11, 15, 71, 4, 51, 94, 78, 84, '2018-10-31 10:30:00'),
(7, 74, '16:05:00', '16:10:00', '2018-10-31', 22, 54, 35, 77, 59, 70, 34, 47, 5, 41, '2018-10-31 10:40:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `claim`
--
ALTER TABLE `claim`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enduser`
--
ALTER TABLE `enduser`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobileno` (`mobileno`);

--
-- Indexes for table `entry`
--
ALTER TABLE `entry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gametime`
--
ALTER TABLE `gametime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lottoweight`
--
ALTER TABLE `lottoweight`
  ADD PRIMARY KEY (`number`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usertranscation`
--
ALTER TABLE `usertranscation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wheelgtime`
--
ALTER TABLE `wheelgtime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wheelw`
--
ALTER TABLE `wheelw`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wheelwiner`
--
ALTER TABLE `wheelwiner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `winnumber`
--
ALTER TABLE `winnumber`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `claim`
--
ALTER TABLE `claim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `enduser`
--
ALTER TABLE `enduser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `entry`
--
ALTER TABLE `entry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gametime`
--
ALTER TABLE `gametime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `usertranscation`
--
ALTER TABLE `usertranscation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wheelgtime`
--
ALTER TABLE `wheelgtime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;
--
-- AUTO_INCREMENT for table `wheelwiner`
--
ALTER TABLE `wheelwiner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `winnumber`
--
ALTER TABLE `winnumber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
