-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 14, 2017 at 12:55 AM
-- Server version: 5.6.35-log
-- PHP Version: 7.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csekua5_agent_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `client_payments`
--

CREATE TABLE `client_payments` (
  `id` int(11) NOT NULL,
  `contract_id` int(11) NOT NULL,
  `payment_serial` int(11) DEFAULT NULL,
  `amount_paid` int(11) NOT NULL,
  `date` date NOT NULL,
  `approved_by_manager` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_payments`
--

INSERT INTO `client_payments` (`id`, `contract_id`, `payment_serial`, `amount_paid`, `date`, `approved_by_manager`) VALUES
(1, 7, 777333, 1000, '2017-08-30', 1),
(2, 7, 54654, 4000, '2017-09-12', 0),
(3, 1, 54654, 4000, '2017-09-11', 1),
(4, 1, 66788, 1000, '2017-09-12', 1),
(11, 1, 1444, 1000, '2017-09-15', 0),
(13, 1, 1929, 100, '2017-09-18', 1),
(14, 2, 777333, 1000, '2017-08-30', 0),
(15, 2, 777333, 1000, '2017-08-30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contract_details`
--

CREATE TABLE `contract_details` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `contrac_titile` varchar(50) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `working_time` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `monthly_workingday` int(11) NOT NULL,
  `payment_from_client_monthly` double NOT NULL,
  `payment_for_staff_monthly` double DEFAULT NULL,
  `month_limit` int(11) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contract_details`
--

INSERT INTO `contract_details` (`id`, `client_id`, `staff_id`, `contrac_titile`, `latitude`, `longitude`, `working_time`, `start_date`, `monthly_workingday`, `payment_from_client_monthly`, `payment_for_staff_monthly`, `month_limit`, `active`) VALUES
(1, 15, 24, 'Physics', 22.808862, 89.456289, 5, '2017-08-01', 7, 7000, 8000, 5, 1),
(2, 16, 21, 'Chemistry', 22.808862, 89.456289, 5, '2017-08-02', 9, 9000, 8000, 2, 1),
(3, 16, 21, 'Chemistry', 22.808862, 89.456289, 5, '2017-08-29', 4, 4000, 4000, 4, 1),
(5, 15, 21, 'Math', 22.808862, 89.456289, 5, '2017-08-31', 5, 5000, 4000, 5, 0),
(6, 15, NULL, 'Math', 22.808862, 89.456289, 5, '2017-08-30', 7, 7000, NULL, 4, 0),
(7, 20, 23, 'Math', 22.808862, 89.456289, 5, '2017-08-30', 7, 5000, 4000, 5, 1),
(9, 20, 34, 'Bio-logy', 22.808862, 89.456289, 5, '2017-08-31', 9, 1000, 800, 7, 0),
(10, 16, 21, 'Math', 22.808862, 89.456289, 5, '2017-09-14', 7, 7000, 4000, 2, 0),
(11, 15, NULL, 'Math', 22.808862, 89.456289, 5, '2017-09-15', 6, 7000, NULL, 3, 0),
(12, 16, NULL, 'Bio-logy', 22.808862, 89.456289, 5, '2017-10-14', 5, 5000, NULL, 5, 0),
(13, 42, 43, 'Math', 22.808862, 89.456289, 5, '2017-11-01', 4, 4500, 4000, 4, 1),
(14, 42, 44, 'Math', 22.808862, 89.456289, 5, '2017-11-01', 4, 4500, 4200, 4, 1),
(15, 42, 45, 'Math', 22.808862, 89.456289, 5, '2017-12-15', 2, 1000, 850, 1, 1),
(16, 15, NULL, 'Chemisty', 22.808862, 89.546189, 60, '2017-10-14', 7, 7000, NULL, 2, 0),
(18, 15, NULL, 'Physics', 22.808862, 89.546189, 120, '2017-10-15', 5, 7000, NULL, 5, 0),
(19, 15, NULL, 'Chemistry', 22.808862, 89.546189, 60, '2017-10-21', 7, 7000, NULL, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff_duty`
--

CREATE TABLE `staff_duty` (
  `id` int(11) NOT NULL,
  `contract_id` int(11) NOT NULL,
  `duty_date` date DEFAULT NULL,
  `next_date` date DEFAULT NULL,
  `approved_by_client` int(1) NOT NULL DEFAULT '0',
  `paid` int(1) NOT NULL DEFAULT '0',
  `payment_appove_by_staff` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_duty`
--

INSERT INTO `staff_duty` (`id`, `contract_id`, `duty_date`, `next_date`, `approved_by_client`, `paid`, `payment_appove_by_staff`) VALUES
(1, 1, '2017-09-01', '2017-09-02', 1, 1, 1),
(2, 1, '2017-09-02', '2017-09-07', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `rolename` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `approve` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `contact_no`, `rolename`, `address`, `password`, `approve`) VALUES
(1, 'Ryhan Ahmed Tamim', 'kucse160230', 'ryhanahmedtamim@gmail.com', '01778506265', 'admin', 'Kashiani, Gopalganj', 'e10adc3949ba59abbe56e057f20f883e', 1),
(15, 'Samanta', 'kucse1602301', 'tcse007@gmail.com', '01614160230', 'client', 'Gopalganj', 'e10adc3949ba59abbe56e057f20f883e', 1),
(16, 'Ryhan', 'kucse1602302', 'tcse007@gmail.com', '01614160230', 'client', 'Gopalganj', 'e10adc3949ba59abbe56e057f20f883e', 1),
(20, 'Elsa1', 'kucse16023011', 'tcse007@gmail.com', '01778506265', 'client', 'Kashiani, Gopalganj', 'e10adc3949ba59abbe56e057f20f883e', 1),
(21, 'Ryata', 'kucse1602308', 'ryata@gmail.com', '01778588999', 'staff', 'Gopalganj', 'e10adc3949ba59abbe56e057f20f883e', 1),
(22, 'Ayat Shaikh', 'ayashaikh', 'ayat@gmail.com', '017700000000', 'staff', 'Khulna', 'e10adc3949ba59abbe56e057f20f883e', 1),
(23, 'Jasu Khan', 'jasukhan', 'jasukhan@gmail.com', '98357833', 'staff', 'Khulna', 'e10adc3949ba59abbe56e057f20f883e', 1),
(24, 'Elsa', 'elsa001', 'elsa@gmail.com', '+18983983', 'staff', 'Khulna', 'e10adc3949ba59abbe56e057f20f883e', 1),
(33, 'Alen Shuvo', 'alen001', 'alen001@gmail.com', '018737837887', 'staff', 'Khulna', 'e10adc3949ba59abbe56e057f20f883e', 1),
(34, 'Linat', 'linat001', 'lanatrusdhi@gmail.com', '01877777777', 'staff', 'Gopalgang', 'e10adc3949ba59abbe56e057f20f883e', 1),
(36, 'Ryhan Ahmed Tamim', 'kucse16023033', 'tcse007@gmail.com', '01778506265', 'client', 'Gopalganj', 'e10adc3949ba59abbe56e057f20f883e', 1),
(38, 'Ayat Shaikh1', 'kucse160230444', 'ayat008@gmail.com', '017700000000', 'staff', 'Khulna', 'e10adc3949ba59abbe56e057f20f883e', 1),
(39, 'Ryhan Ahmed Tamim', '1kucse160230', 'tcse007@gmail.com', '01778506265', 'client', 'Khulna', 'e10adc3949ba59abbe56e057f20f883e', 0),
(41, 'Ayat Shaikh', 'kucse160230999', 'ayat@gmail.com', '017700000000', 'staff', 'Khulna', 'e10adc3949ba59abbe56e057f20f883e', 0),
(42, 'Fahim Rahman', 'mefahimrahman', 'mefahimrahman@gmail.com', '01534368535', 'client', 'Gollamari, Khulna', '25f9e794323b453885f5181f1b624d0b', 1),
(43, 'Israt Jahan', 'Joya', 'purplebird@gmail.com', '01726243448', 'staff', 'Khulna University, Khulna', '25f9e794323b453885f5181f1b624d0b', 1),
(44, 'Abdul Lotif', 'Limon', 'cseku160212@gmail.com', '01521313633', 'staff', 'Gollamari, Khulna', '25f9e794323b453885f5181f1b624d0b', 1),
(45, 'Manna Emam', 'Manna', 'manna@gmail.com', '01682715574', 'staff', 'Gollamari, Khulna', '25f9e794323b453885f5181f1b624d0b', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_payments`
--
ALTER TABLE `client_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contract_id` (`contract_id`);

--
-- Indexes for table `contract_details`
--
ALTER TABLE `contract_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `staff_duty`
--
ALTER TABLE `staff_duty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contract_id` (`contract_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_payments`
--
ALTER TABLE `client_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `contract_details`
--
ALTER TABLE `contract_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `staff_duty`
--
ALTER TABLE `staff_duty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client_payments`
--
ALTER TABLE `client_payments`
  ADD CONSTRAINT `client_payments_ibfk_1` FOREIGN KEY (`contract_id`) REFERENCES `contract_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contract_details`
--
ALTER TABLE `contract_details`
  ADD CONSTRAINT `contract_details_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contract_details_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff_duty`
--
ALTER TABLE `staff_duty`
  ADD CONSTRAINT `staff_duty_ibfk_1` FOREIGN KEY (`contract_id`) REFERENCES `contract_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
