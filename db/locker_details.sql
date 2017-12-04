-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2017 at 08:02 AM
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
(1, 1, 'Rangan Roy', 'rroy3235@altimetrik.com', 'f9d210790cad717a50a60f9da2c1066b', 1);

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
(7, 2, 13, 1),
(9, 4, 8, 1),
(10, 5, 4, 1),
(11, 6, 4, 0),
(12, 2, 4, 1),
(13, 7, 4, 1),
(14, 8, 5, 1);

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
  `assign_date` datetime NOT NULL,
  `assignment_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(12, 4, 9, 7, 8, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `locker_receive_master`
--

CREATE TABLE `locker_receive_master` (
  `receive_id` int(11) NOT NULL,
  `assign_id` int(11) NOT NULL,
  `receive_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locker_receive_master`
--

INSERT INTO `locker_receive_master` (`receive_id`, `assign_id`, `receive_date`) VALUES
(1, 1, '2017-07-29 00:00:00'),
(2, 1, '2017-07-29 00:00:00'),
(3, 1, '2017-07-29 18:44:08'),
(4, 1, '2017-07-29 18:44:49'),
(5, 2, '2017-07-29 18:45:55'),
(6, 3, '2017-07-29 18:47:49'),
(7, 4, '2017-07-29 18:54:21');

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
(1, 1, 'Office', 'view_office.php', 'office', 0, 1, 1, 1),
(2, 1, 'Admin', '#', '', 0, 0, 0, 1),
(3, 1, 'Remove Office', 'company_details.php', '', 0, 0, 1, 1),
(7, 1, 'Add Admin', 'view_office_admin.php', 'admin', 2, 1, 1, 1),
(8, 1, 'Remove Admin', 'remove_admin.php', '', 2, 0, 1, 0);

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
(2, 2, 9, 1);

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
(2, 4, 1, 'Rangan Roy', 'rroy3235@altimetrik.com', 'eee1e5c419a1ed183933d00ea34e8d9b', 1);

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
(4, 1, 1, 'Ascendas IT Park', 'Altimetrik India Private Limited', 1),
(5, 1, 1, 'Bangalore', 'Altimetrik', 1),
(6, 1, 1, 'Uruguay', 'Altimetrik', 0),
(7, 1, 1, 'New Jersey, United States', 'Altimetrik', 1),
(8, 1, 1, 'Ascendas Phase 1 - Pinnacle, CSIR Road, Taramani, Chennai, Tamil Nadu, India', 'Altimetrik', 1);

-- --------------------------------------------------------

--
-- Table structure for table `office_menu_master`
--

CREATE TABLE `office_menu_master` (
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `menu_link` varchar(255) NOT NULL,
  `menu_parent` int(11) NOT NULL,
  `add_option` int(11) NOT NULL,
  `add_id` varchar(255) NOT NULL,
  `view_option` int(11) NOT NULL,
  `menu_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `office_menu_master`
--

INSERT INTO `office_menu_master` (`menu_id`, `menu_name`, `menu_link`, `menu_parent`, `add_option`, `add_id`, `view_option`, `menu_status`) VALUES
(1, 'Add Locker', 'view_locker.php', 0, 1, 'aLocker', 1, 1),
(2, 'Search Locker', 'search_locker.php?', 0, 0, '', 1, 1),
(3, 'Assign Locker', 'view_assign_locker.php?', 0, 1, 'asLocker', 1, 1);

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
(1, 'Rangan Roy', 'rangan', 'f9d210790cad717a50a60f9da2c1066b');

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
  `add_option` int(11) NOT NULL,
  `add_id` varchar(100) NOT NULL,
  `view_option` int(11) NOT NULL,
  `menu_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_admin_menu_master`
--

INSERT INTO `site_admin_menu_master` (`menu_id`, `menu_name`, `menu_link`, `menu_parent`, `menu_icon`, `add_option`, `add_id`, `view_option`, `menu_status`) VALUES
(5, 'Registerer Company', 'register_company.php', 1, '', 0, '', 0, 1);

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
-- Indexes for table `locker_receive_master`
--
ALTER TABLE `locker_receive_master`
  ADD PRIMARY KEY (`receive_id`);

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
  MODIFY `floor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `locker_assign`
--
ALTER TABLE `locker_assign`
  MODIFY `assign_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `locker_master`
--
ALTER TABLE `locker_master`
  MODIFY `locker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `locker_receive_master`
--
ALTER TABLE `locker_receive_master`
  MODIFY `receive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `menu_master`
--
ALTER TABLE `menu_master`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `office_admin_assigned_floor_number`
--
ALTER TABLE `office_admin_assigned_floor_number`
  MODIFY `assign_floor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `office_admin_credentials_master`
--
ALTER TABLE `office_admin_credentials_master`
  MODIFY `credential_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `office_master`
--
ALTER TABLE `office_master`
  MODIFY `office_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
