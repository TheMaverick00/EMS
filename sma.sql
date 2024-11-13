-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 02, 2023 at 03:24 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sma`
--

-- --------------------------------------------------------

--
-- Table structure for table `allawance`
--

CREATE TABLE `allawance` (
  `id` int(6) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `approval_list`
--

CREATE TABLE `approval_list` (
  `id` int(255) NOT NULL,
  `emp_id` int(255) NOT NULL,
  `responsibility` varchar(1000) NOT NULL,
  `level` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `approval_list`
--

INSERT INTO `approval_list` (`id`, `emp_id`, `responsibility`, `level`) VALUES
(2, 6, 'Balance account', 10),
(3, 8, 'Checking invalid cards', 13);

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int(6) NOT NULL,
  `name` varchar(255) NOT NULL,
  `assetID` varchar(255) NOT NULL,
  `purchase_date` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `condition` varchar(255) NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `sn` varchar(11) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(6) NOT NULL,
  `emp_id` varchar(20) NOT NULL,
  `time_in` varchar(255) NOT NULL,
  `time_out` varchar(255) NOT NULL,
  `time_spend` varchar(255) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `month` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `emp_id`, `time_in`, `time_out`, `time_spend`, `date`, `month`) VALUES
(1, '6', '05:01:54', 'NULL', '0', '2023-01-02 04:01:54', 1),
(2, '1', '05:02:16', 'NULL', '0', '2023-01-02 04:02:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `id` int(5) NOT NULL,
  `emp_id` varchar(255) NOT NULL,
  `deduction_id` int(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `month` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deduction_list`
--

CREATE TABLE `deduction_list` (
  `id` int(255) NOT NULL,
  `deduction_name` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `amount` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(6) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
(1, 'Human Resource');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `id` int(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `emp_id` varchar(255) NOT NULL,
  `level` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(6) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `empID` varchar(255) NOT NULL,
  `joiningDate` varchar(255) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `department` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `Gender` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `isAdmin` int(6) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `account` int(15) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `email`, `empID`, `joiningDate`, `phone`, `department`, `address`, `Gender`, `dob`, `isAdmin`, `password`, `account`, `bank`, `picture`) VALUES
(1, 'Joshua Josh', 'Joshua@gmail.com', 'SMA3821', '2-1-2023', '+2349101013370', 'Hr Department', '', '', '', 1, 'e10adc3949ba59abbe56e057f20f883e', 0, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(6) NOT NULL,
  `emp_id` varchar(255) NOT NULL,
  `no_of_days` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT '0',
  `reason` varchar(255) NOT NULL,
  `leave_type` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `sn` int(255) NOT NULL,
  `level` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`sn`, `level`) VALUES
(1, 7),
(2, 8),
(3, 9),
(4, 10),
(5, 11),
(6, 12),
(7, 13),
(8, 14),
(9, 15),
(10, 16);

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `sn` int(255) NOT NULL,
  `level` int(255) NOT NULL,
  `salary` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`sn`, `level`, `salary`) VALUES
(1, 7, 2000),
(2, 8, 3000),
(3, 9, 4000),
(4, 10, 5000),
(5, 11, 6000),
(6, 12, 7000),
(7, 13, 8000),
(8, 14, 9000),
(9, 15, 10000),
(10, 16, 11000);

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `id` int(6) NOT NULL,
  `empID` varchar(255) NOT NULL,
  `level` int(6) NOT NULL,
  `basic` int(255) NOT NULL,
  `hra` int(255) NOT NULL,
  `loan` int(255) NOT NULL,
  `salary` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`id`, `empID`, `level`, `basic`, `hra`, `loan`, `salary`) VALUES
(1, 'SMA3821', 9, 2400, 1600, 0, 4000);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(255) NOT NULL,
  `assigned_by` varchar(255) NOT NULL,
  `assigned_to` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `task_title` varchar(255) NOT NULL,
  `complete_status` tinyint(1) NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allawance`
--
ALTER TABLE `allawance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `approval_list`
--
ALTER TABLE `approval_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deduction_list`
--
ALTER TABLE `deduction_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allawance`
--
ALTER TABLE `allawance`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `approval_list`
--
ALTER TABLE `approval_list`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deduction_list`
--
ALTER TABLE `deduction_list`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `sn` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `sn` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
