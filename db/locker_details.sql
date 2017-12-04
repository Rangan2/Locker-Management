-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2017 at 07:13 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `locker_details`
--

-- --------------------------------------------------------

--
-- Table structure for table `company_admin_master`
--

CREATE TABLE `company_admin_master` (
  `admin_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_admin_master`
--

INSERT INTO `company_admin_master` (`admin_id`, `company_id`, `admin_name`, `email_id`, `password`, `status`) VALUES
(1, 1, 'Rangan Roy', 'rroy3235@altimetrik.com', 'f9d210790cad717a50a60f9da2c1066b', 1),
(2, 3, 'Ishant Sharma', 'isharma@zycus.com', 'eee1e5c419a1ed183933d00ea34e8d9b', 0),
(3, 4, '', '', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(4, 5, '', '', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(5, 6, '', '', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(6, 7, '', '', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(7, 8, '', '', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(8, 9, '', '', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(9, 10, '', '', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(10, 11, '', '', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(11, 12, '', '', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(12, 13, '', '', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(13, 14, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(14, 15, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(15, 16, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(16, 17, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(17, 18, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(18, 19, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(19, 20, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(20, 21, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(21, 22, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(22, 23, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(23, 24, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(24, 25, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(25, 26, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(26, 27, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(27, 28, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(28, 29, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(29, 30, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(30, 31, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(31, 32, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(32, 33, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(33, 34, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(34, 35, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(35, 36, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(36, 37, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(37, 38, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(38, 39, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(39, 40, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(40, 41, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(41, 42, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(42, 43, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(43, 44, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(44, 45, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(45, 46, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(46, 47, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(47, 48, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(48, 49, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(49, 50, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(50, 51, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(51, 52, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(52, 53, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(53, 54, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(54, 55, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(55, 56, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(56, 57, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(57, 58, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(58, 59, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(59, 60, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(60, 61, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(61, 62, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(62, 63, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(63, 64, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(64, 65, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(65, 66, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(66, 67, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(67, 68, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(68, 69, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(69, 70, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(70, 71, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(71, 72, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(72, 73, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(73, 74, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(74, 75, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(75, 76, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(76, 77, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(77, 78, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(78, 79, 'Rangan Roy', 'rroy3235@altimetrik.com', 'd41d8cd98f00b204e9800998ecf8427e', 0);

-- --------------------------------------------------------

--
-- Table structure for table `company_master`
--

CREATE TABLE `company_master` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_field` varchar(255) NOT NULL,
  `company_location` varchar(255) NOT NULL,
  `company_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_master`
--

INSERT INTO `company_master` (`company_id`, `company_name`, `company_field`, `company_location`, `company_status`) VALUES
(1, 'Altimetrik India Private Limited', 'IT', 'Chennai', 0),
(3, 'Zycus', 'IT', 'Mumbai', 0),
(4, '', '', '', 0),
(5, '', '', '', 0),
(6, '', '', '', 0),
(7, '', '', '', 0),
(8, '', '', '', 0),
(9, '', '', '', 0),
(10, '', '', '', 0),
(11, '', '', '', 0),
(12, '', '', '', 0),
(13, '', '', '', 0),
(14, 'sds', '', '', 0),
(15, 'sds', '', '', 0),
(16, 'sds', '', '', 0),
(17, 'sds', '', '', 0),
(18, 'sds', '', '', 0),
(19, 'sds', '', '', 0),
(20, 'sds', '', '', 0),
(21, 'sds', '', '', 0),
(22, 'sds', '', '', 0),
(23, 'sds', '', '', 0),
(24, 'sds', '', '', 0),
(25, 'sds', '', '', 0),
(26, 'sds', '', '', 0),
(27, 'sds', '', '', 0),
(28, 'sds', '', '', 0),
(29, 'sds', '', '', 0),
(30, 'sds', '', '', 0),
(31, 'sds', '', '', 0),
(32, 'sds', '', '', 0),
(33, 'sds', '', '', 0),
(34, 'sds', '', '', 0),
(35, 'sds', '', '', 0),
(36, 'sds', '', '', 0),
(37, 'sds', '', '', 0),
(38, 'sds', '', '', 0),
(39, 'sds', '', '', 0),
(40, 'sds', '', '', 0),
(41, 'sds', '', '', 0),
(42, 'sds', '', '', 0),
(43, 'sds', '', '', 0),
(44, 'sds', '', '', 0),
(45, 'sds', '', '', 0),
(46, 'sds', '', '', 0),
(47, 'sds', '', '', 0),
(48, 'sds', '', '', 0),
(49, 'sds', '', '', 0),
(50, 'sds', '', '', 0),
(51, 'sds', '', '', 0),
(52, 'sds', '', '', 0),
(53, 'sds', '', '', 0),
(54, 'sds', '', '', 0),
(55, 'sds', '', '', 0),
(56, 'sds', '', '', 0),
(57, 'sds', '', '', 0),
(58, 'sds', '', '', 0),
(59, 'sds', '', '', 0),
(60, 'sds', '', '', 0),
(61, 'sds', '', '', 0),
(62, 'sds', '', '', 0),
(63, 'sds', '', '', 0),
(64, 'sds', '', '', 0),
(65, 'sds', '', '', 0),
(66, 'sds', '', '', 0),
(67, 'sds', '', '', 0),
(68, 'sds', '', '', 0),
(69, 'sds', '', '', 0),
(70, 'sds', '', '', 0),
(71, 'sds', '', '', 0),
(72, 'sds', '', '', 0),
(73, 'sds', '', '', 0),
(74, 'sds', '', '', 0),
(75, 'sds', '', '', 0),
(76, 'sds', '', '', 0),
(77, 'sds', '', '', 0),
(78, 'sds', '', '', 0),
(79, 'sds', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `floor_master`
--

CREATE TABLE `floor_master` (
  `floor_id` int(11) NOT NULL,
  `office_id` int(11) NOT NULL,
  `floor_number` int(11) NOT NULL,
  `floor_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `floor_master`
--

INSERT INTO `floor_master` (`floor_id`, `office_id`, `floor_number`, `floor_status`) VALUES
(1, 2, 4, 1),
(7, 3, 13, 1),
(8, 4, 4, 1),
(9, 2, 5, 1),
(10, 5, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `locker_assign`
--

CREATE TABLE `locker_assign` (
  `assign_id` int(11) NOT NULL,
  `office_id` int(11) NOT NULL,
  `floor_id` int(11) NOT NULL,
  `locker_id` int(11) NOT NULL,
  `emp_name` varchar(255) NOT NULL,
  `emp_id` bigint(20) NOT NULL,
  `assignment_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locker_assign`
--

INSERT INTO `locker_assign` (`assign_id`, `office_id`, `floor_id`, `locker_id`, `emp_name`, `emp_id`, `assignment_status`) VALUES
(8, 2, 1, 1, 'Rangan Roy', 3235, 1);

-- --------------------------------------------------------

--
-- Table structure for table `locker_master`
--

CREATE TABLE `locker_master` (
  `locker_id` int(11) NOT NULL,
  `office_id` int(11) NOT NULL,
  `floor_id` int(11) NOT NULL,
  `locker_number` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `locker_status` int(11) NOT NULL DEFAULT '1',
  `locker_active_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locker_master`
--

INSERT INTO `locker_master` (`locker_id`, `office_id`, `floor_id`, `locker_number`, `added_by`, `locker_status`, `locker_active_status`) VALUES
(1, 2, 1, 1, 1, 0, 1),
(2, 2, 1, 2, 1, 1, 1),
(3, 2, 1, 3, 1, 1, 1),
(4, 2, 1, 4, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_master`
--

CREATE TABLE `menu_master` (
  `menu_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `menu_link` varchar(255) NOT NULL,
  `menu_parent` int(11) NOT NULL,
  `menu_icon` varchar(255) NOT NULL,
  `menu_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_master`
--

INSERT INTO `menu_master` (`menu_id`, `company_id`, `menu_name`, `menu_link`, `menu_parent`, `menu_icon`, `menu_status`) VALUES
(1, 1, 'Add Office', 'add_office.php', 0, '', 1),
(2, 1, 'Office Admin', 'office_admin.php', 0, '', 1),
(3, 1, 'Company Details', 'company_details.php', 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `office_admin_assigned_floor_number`
--

CREATE TABLE `office_admin_assigned_floor_number` (
  `assign_floor_id` int(11) NOT NULL,
  `credential_id` int(11) NOT NULL,
  `floor_id` int(11) NOT NULL,
  `assign_floor_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `office_admin_assigned_floor_number`
--

INSERT INTO `office_admin_assigned_floor_number` (`assign_floor_id`, `credential_id`, `floor_id`, `assign_floor_status`) VALUES
(1, 1, 1, 1),
(3, 1, 9, 0),
(4, 2, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `office_admin_credentials_master`
--

CREATE TABLE `office_admin_credentials_master` (
  `credential_id` int(11) NOT NULL,
  `office_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `office_admin_credentials_master`
--

INSERT INTO `office_admin_credentials_master` (`credential_id`, `office_id`, `added_by`, `admin_name`, `email_id`, `password`, `admin_status`) VALUES
(1, 2, 1, 'Rangan Roy', 'rroy3235@altimetrik.com', 'eee1e5c419a1ed183933d00ea34e8d9b', 1),
(2, 0, 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', 1);

-- --------------------------------------------------------

--
-- Table structure for table `office_master`
--

CREATE TABLE `office_master` (
  `office_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `office_location` varchar(255) NOT NULL,
  `office_name` varchar(255) NOT NULL,
  `office_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `office_master`
--

INSERT INTO `office_master` (`office_id`, `admin_id`, `company_id`, `office_location`, `office_name`, `office_status`) VALUES
(2, 1, 1, 'Ascendas Phase 2 - Crest, CSIR Road, Taramani, Chennai, Tamil Nadu, India', 'Altimetrik', 1),
(3, 1, 1, 'Ascendas Phase 3 - Zenith, CSIR Road, Taramani, Chennai, Tamil Nadu, India', 'Altimetrik', 0),
(4, 1, 1, 'Embassy Tech Square Main Road, Kaverappa Layout, Bangalore, Karnataka, India', 'Altimetrik', 1),
(5, 1, 1, 'Ascendas Phase 1 - Pinnacle, CSIR Road, Taramani, Chennai, Tamil Nadu, India', 'Altimetrik', 1);

-- --------------------------------------------------------

--
-- Table structure for table `office_menu_master`
--

CREATE TABLE `office_menu_master` (
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `menu_link` varchar(255) NOT NULL,
  `menu_parent` int(11) NOT NULL,
  `menu_icon` varchar(255) NOT NULL,
  `menu_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `office_menu_master`
--

INSERT INTO `office_menu_master` (`menu_id`, `menu_name`, `menu_link`, `menu_parent`, `menu_icon`, `menu_status`) VALUES
(1, 'Add Locker', 'add_locker.php', 0, '', 1),
(2, 'Search Locker', 'search_locker.php?', 0, '', 1),
(3, 'Assign Locker', 'assign_locker.php?', 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `site_admin_login_master`
--

CREATE TABLE `site_admin_login_master` (
  `login_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_admin_login_master`
--

INSERT INTO `site_admin_login_master` (`login_id`, `full_name`, `user_name`, `password`) VALUES
(1, 'Rangan Roy', 'rangan', 'eee1e5c419a1ed183933d00ea34e8d9b');

-- --------------------------------------------------------

--
-- Table structure for table `site_admin_menu_master`
--

CREATE TABLE `site_admin_menu_master` (
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `menu_link` varchar(255) NOT NULL,
  `menu_parent` int(11) NOT NULL,
  `menu_icon` varchar(255) NOT NULL,
  `menu_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_admin_menu_master`
--

INSERT INTO `site_admin_menu_master` (`menu_id`, `menu_name`, `menu_link`, `menu_parent`, `menu_icon`, `menu_status`) VALUES
(1, 'Add Menu', 'add_menu.php', 0, '', 1),
(2, 'Company Menu', 'company_menu.php', 0, '', 1),
(4, 'Registered Company', 'registered_company.php', 0, '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company_admin_master`
--
ALTER TABLE `company_admin_master`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `company_master`
--
ALTER TABLE `company_master`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `floor_master`
--
ALTER TABLE `floor_master`
  ADD PRIMARY KEY (`floor_id`);

--
-- Indexes for table `locker_assign`
--
ALTER TABLE `locker_assign`
  ADD PRIMARY KEY (`assign_id`);

--
-- Indexes for table `locker_master`
--
ALTER TABLE `locker_master`
  ADD PRIMARY KEY (`locker_id`);

--
-- Indexes for table `menu_master`
--
ALTER TABLE `menu_master`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `office_admin_assigned_floor_number`
--
ALTER TABLE `office_admin_assigned_floor_number`
  ADD PRIMARY KEY (`assign_floor_id`);

--
-- Indexes for table `office_admin_credentials_master`
--
ALTER TABLE `office_admin_credentials_master`
  ADD PRIMARY KEY (`credential_id`);

--
-- Indexes for table `office_master`
--
ALTER TABLE `office_master`
  ADD PRIMARY KEY (`office_id`);

--
-- Indexes for table `office_menu_master`
--
ALTER TABLE `office_menu_master`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `site_admin_login_master`
--
ALTER TABLE `site_admin_login_master`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `site_admin_menu_master`
--
ALTER TABLE `site_admin_menu_master`
  ADD PRIMARY KEY (`menu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company_admin_master`
--
ALTER TABLE `company_admin_master`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `company_master`
--
ALTER TABLE `company_master`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT for table `floor_master`
--
ALTER TABLE `floor_master`
  MODIFY `floor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `locker_assign`
--
ALTER TABLE `locker_assign`
  MODIFY `assign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `locker_master`
--
ALTER TABLE `locker_master`
  MODIFY `locker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `menu_master`
--
ALTER TABLE `menu_master`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `office_admin_assigned_floor_number`
--
ALTER TABLE `office_admin_assigned_floor_number`
  MODIFY `assign_floor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `office_admin_credentials_master`
--
ALTER TABLE `office_admin_credentials_master`
  MODIFY `credential_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `office_master`
--
ALTER TABLE `office_master`
  MODIFY `office_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `office_menu_master`
--
ALTER TABLE `office_menu_master`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `site_admin_login_master`
--
ALTER TABLE `site_admin_login_master`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `site_admin_menu_master`
--
ALTER TABLE `site_admin_menu_master`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
