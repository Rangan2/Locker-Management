-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2017 at 08:40 PM
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
(1, 1, 'Rangan Roy', 'rroy3235@altimetrik.com', '2f8ec54e6605d819aaf704a993c76960', 1);

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
(1, 'Altimetrik India Private Limited', 'Information Technology', 'Chennai', 0);

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
(5, 2, 4, 1),
(7, 2, 13, 0),
(9, 4, 8, 1);

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
  `add_id` varchar(255) NOT NULL,
  `menu_parent` int(11) NOT NULL,
  `add_option` int(11) NOT NULL,
  `view_option` int(11) NOT NULL,
  `menu_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_master`
--

INSERT INTO `menu_master` (`menu_id`, `company_id`, `menu_name`, `menu_link`, `add_id`, `menu_parent`, `add_option`, `view_option`, `menu_status`) VALUES
(1, 1, 'Add Office', 'view_office.php', 'office', 0, 1, 1, 1),
(2, 1, 'Assign Admin', '#', '', 0, 0, 0, 1),
(3, 1, 'Company Details', 'company_details.php', '', 0, 0, 1, 1),
(7, 1, 'Add Admin', 'view_office_admin.php', 'admin', 2, 1, 1, 1),
(8, 1, 'Remove Admin', 'remove_admin.php', '', 2, 0, 1, 1);

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
(13, 7, 9, 1),
(14, 8, 5, 1);

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
(7, 4, 1, 'Saikat Sarkar', 'saikat@altimetrik.com', '8f60c8102d29fcd525162d02eed4566b', 1),
(8, 2, 1, 'Rangan Roy', 'rroy3235@altimetrik.com', 'eee1e5c419a1ed183933d00ea34e8d9b', 1);

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
(2, 1, 1, 'Ascendas', 'Altimetrik', 1),
(4, 1, 1, 'Ascendas IT Park', 'Altimetrik India Private Limited', 1);

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `company_master`
--
ALTER TABLE `company_master`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `floor_master`
--
ALTER TABLE `floor_master`
  MODIFY `floor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
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
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `office_admin_assigned_floor_number`
--
ALTER TABLE `office_admin_assigned_floor_number`
  MODIFY `assign_floor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `office_admin_credentials_master`
--
ALTER TABLE `office_admin_credentials_master`
  MODIFY `credential_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `office_master`
--
ALTER TABLE `office_master`
  MODIFY `office_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
