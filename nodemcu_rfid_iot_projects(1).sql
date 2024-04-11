-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2023 at 05:52 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nodemcu_rfid_iot_projects`
--

-- --------------------------------------------------------

--
-- Table structure for table `balance_amount`
--

CREATE TABLE `balance_amount` (
  `name` varchar(100) NOT NULL,
  `id` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `balance` int(11) DEFAULT NULL,
  `roll` varchar(100) DEFAULT NULL,
  `new_balance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `balance_amount`
--

INSERT INTO `balance_amount` (`name`, `id`, `gender`, `email`, `mobile`, `balance`, `roll`, `new_balance`) VALUES
('l', 'l', 'k', 'k', 'k', 0, NULL, NULL),
('essaki', 'h', 'Male', 'm', 's,faflafhal', 1, 'n', NULL),
('essaki', '1', 'Male', 'essakiraja246810@gmail.com', 'asc', 538, '', NULL),
('essaki', '1', 'Male', 'essakiraja246810@gmail.com', 'asc', 538, '', NULL),
('essaki', '1', 'Male', 'essakiraja246810@gmail.com', 'asc', 538, '', NULL),
('essaki', '1', 'Male', 'essakiraja246810@gmail.com', 'asc', 538, '', NULL),
('essaki', '1', 'Male', 'essakiraja246810@gmail.com', 'asc', 538, '', NULL),
('essaki', 'h', 'Male', 'm', 's,faflafhal', 1, 'n', NULL),
('essaki', 'h', 'Male', 'm', 's,faflafhal', 1, 'n', NULL),
('essakirajas', '123', 'Male', 'essakiraja246810@gmail.com', '9345731638', 700, '21ITR012', NULL),
('Mukdhesh', '12345', 'Male', 'mukhdheshkannapiran@gmail.com', '8489776686', 0, '21ITR037', NULL),
('raja', '34', 'Male', 'essakiraja246810@gmail.com', '94653', 0, '21ITR001', NULL),
('essakirajas', '123', 'Male', 'essakiraja246810@gmail.com', '9345731638', 700, '21ITR012', NULL),
('essakirajas', '123', 'Male', 'essakiraja246810@gmail.com', '9345731638', 700, '21ITR012', NULL),
('essakirajas', '123', 'Male', 'essakiraja246810@gmail.com', '9345731638', 700, '21ITR012', NULL),
('essakirajas', '123', 'Male', 'essakiraja246810@gmail.com', '9345731638', 700, '21ITR012', NULL),
('praveen', '24', 'Male', 'hqdkjf', 'aflkjw', 100, '23ITR068', NULL),
('essakirajas', '123', 'Male', 'essakiraja246810@gmail.com', '9345731638', 700, '21ITR012', NULL),
('joel', '54', 'Male', 'bmj', 'mjh', 500, '21CBR025', NULL),
('essakirajas', '123', 'Male', 'essakiraja246810@gmail.com', '9345731638', 700, '21ITR012', NULL),
('essaki', '1', 'Male', 'essakiraja246810@gmail.com', 'asc', 538, '', NULL),
('essaki', '1', 'Male', 'essakiraja246810@gmail.com', 'asc', 538, '', NULL),
('essaki', '1', 'Male', 'essakiraja246810@gmail.com', 'asc', 538, '', NULL),
('essaki', '1', 'Male', 'essakiraja246810@gmail.com', 'asc', 538, '', NULL),
('essaki', '1', 'Male', 'essakiraja246810@gmail.com', 'asc', 538, '', NULL),
('essakirajas', '123', 'Male', 'essakiraja246810@gmail.com', '9345731638', 700, '21ITR012', NULL),
('essakirajas', '123', 'Male', 'essakiraja246810@gmail.com', '9345731638', 700, '21ITR012', NULL),
('essakirajas', '123', 'Male', 'essakiraja246810@gmail.com', '9345731638', 700, '21ITR012', NULL),
('essakirajas', '123', 'Male', 'essakiraja246810@gmail.com', '9345731638', 700, '21ITR012', NULL),
('Caroline', '554CA52A', 'Female', 'caroline@gmail.com', '7675777676', 100, '21CSR021', NULL),
('b', '554<:52:', 'Male', 'sf', 's', 100, 'sf', NULL),
('b', '554<:52:', 'Male', 'sf', 's', 100, 'sf', NULL),
('sdf', '55420520', 'Male', 'as', 'aegsr', 100, 'sadsad', NULL),
('sdf', '55420520', 'Male', 'as', 'aegsr', 100, 'sadsad', NULL),
('essakirajas', '123', 'Male', 'essakiraja246810@gmail.com', '9345731638', 700, '21ITR012', NULL),
('essakirajas', '123', 'Male', 'essakiraja246810@gmail.com', '9345731638', 700, '21ITR012', NULL),
('essakirajas', '123', 'Male', 'essakiraja246810@gmail.com', '9345731638', 700, '21ITR012', NULL),
('essakirajas', '123', 'Male', 'essakiraja246810@gmail.com', '9345731638', 700, '21ITR012', NULL),
('essakirajas', '123', 'Male', 'essakiraja246810@gmail.com', '9345731638', 700, '21ITR012', NULL),
('essakirajas', '123', 'Male', 'essakiraja246810@gmail.com', '9345731638', 700, '21ITR012', NULL),
('essakirajas', '123', 'Male', 'essakiraja246810@gmail.com', '9345731638', 700, '21ITR012', NULL),
('essakirajas', '123', 'Male', 'essakiraja246810@gmail.com', '9345731638', 700, '21ITR012', NULL),
('essakirajas', '123', 'Male', 'essakiraja246810@gmail.com', '9345731638', 700, '21ITR012', NULL),
('essakirajas', '123', 'Male', 'essakiraja246810@gmail.com', '9345731638', 700, '21ITR012', NULL),
('essakirajas', '123', 'Male', 'essakiraja246810@gmail.com', '9345731638', 700, '21ITR012', NULL),
('essakirajas', '123', 'Male', 'essakiraja246810@gmail.com', '9345731638', 700, '21ITR012', NULL),
('sdf', '55420520', 'Male', 'as', 'aegsr', 100, 'sadsad', NULL),
('sdf', '55420520', 'Male', 'as', 'aegsr', 100, 'sadsad', NULL),
('sdf', '55420520', 'Male', 'as', 'aegsr', 100, 'sadsad', NULL),
('sdf', '55420520', 'Male', 'as', 'aegsr', 100, 'sadsad', NULL),
('sdf', '55420520', 'Male', 'as', 'aegsr', 100, 'sadsad', NULL),
('sdf', '55420520', 'Male', 'as', 'aegsr', 100, 'sadsad', NULL),
('sdf', '55420520', 'Male', 'as', 'aegsr', 100, 'sadsad', NULL),
('sdf', '55420520', 'Male', 'as', 'aegsr', 100, 'sadsad', NULL),
('sdf', '55420520', 'Male', 'as', 'aegsr', 100, 'sadsad', NULL),
('sdf', '55420520', 'Male', 'as', 'aegsr', 100, 'sadsad', NULL),
('sdf', '55420520', 'Male', 'as', 'aegsr', 100, 'sadsad', NULL),
('sdf', '55420520', 'Male', 'as', 'aegsr', 100, 'sadsad', NULL),
('sdf', '55420520', 'Male', 'as', 'aegsr', 100, 'sadsad', NULL),
('sdf', '55420520', 'Male', 'as', 'aegsr', 100, 'sadsad', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `roll_number` varchar(255) NOT NULL,
  `order_items` text NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `order_time` int(11) NOT NULL DEFAULT current_timestamp(),
  `deliverd` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `user_id`, `roll_number`, `order_items`, `total_amount`, `order_time`, `deliverd`) VALUES
(1, 123, '21ITR012', '[{\"item\":\"Denomination (Rs)\",\"price\":5},{\"item\":\"Denomination (Rs)\",\"price\":10},{\"item\":\"Denomination (Rs)\",\"price\":null}]', '15.00', 2023, 1),
(2, 123, '21ITR012', '[{\"item\":\"Denomination (Rs)\",\"price\":100},{\"item\":\"Denomination (Rs)\",\"price\":100},{\"item\":\"Denomination (Rs)\",\"price\":null}]', '200.00', 2023, 1),
(3, 123, '21ITR012', '[{\"item\":\"Denomination (Rs)\",\"price\":200},{\"item\":\"Denomination (Rs)\",\"price\":200},{\"item\":\"Denomination (Rs)\",\"price\":200},{\"item\":\"Denomination (Rs)\",\"price\":200},{\"item\":\"Denomination (Rs)\",\"price\":200},{\"item\":\"Denomination (Rs)\",\"price\":null}]', '1000.00', 2023, 1),
(4, 123, '21ITR012', '[{\"item\":\"Denomination (Rs)\",\"price\":5},{\"item\":\"Denomination (Rs)\",\"price\":5},{\"item\":\"Denomination (Rs)\",\"price\":null}]', '10.00', 2023, 1),
(5, 123, '21ITR012', '[{\"item\":\"Denomination (Rs)\",\"price\":5},{\"item\":\"Denomination (Rs)\",\"price\":5},{\"item\":\"Denomination (Rs)\",\"price\":5},{\"item\":\"Denomination (Rs)\",\"price\":5},{\"item\":\"Denomination (Rs)\",\"price\":null}]', '20.00', 2023, 1),
(6, 123, '21ITR012', '[{\"item\":\"Denomination (Rs)\",\"price\":200},{\"item\":\"Denomination (Rs)\",\"price\":200},{\"item\":\"Denomination (Rs)\",\"price\":null}]', '400.00', 2023, 1),
(7, 123, '21ITR012', '[{\"item\":\"Denomination (Rs)\",\"price\":200},{\"item\":\"Denomination (Rs)\",\"price\":null}]', '200.00', 2023, 1),
(8, 123, '21ITR012', '[{\"item\":\"Denomination (Rs)\",\"price\":5},{\"item\":\"Denomination (Rs)\",\"price\":null}]', '5.00', 2023, 1),
(9, 123, '21ITR012', '[{\"item\":\"Denomination (Rs)\",\"price\":5},{\"item\":\"Denomination (Rs)\",\"price\":null}]', '5.00', 2023, 1),
(10, 123, '21ITR012', '[{\"item\":\"Denomination (Rs)\",\"price\":10},{\"item\":\"Denomination (Rs)\",\"price\":10},{\"item\":\"Denomination (Rs)\",\"price\":null}]', '20.00', 2023, 1),
(11, 24, '23ITR068', '[{\"item\":\"Denomination (Rs)\",\"price\":50},{\"item\":\"Denomination (Rs)\",\"price\":50},{\"item\":\"Denomination (Rs)\",\"price\":null}]', '100.00', 2023, 1),
(12, 54, '21CBR025', '[{\"item\":\"Denomination (Rs)\",\"price\":200},{\"item\":\"Denomination (Rs)\",\"price\":200},{\"item\":\"Denomination (Rs)\",\"price\":null}]', '400.00', 2023, 1),
(13, 123, '21ITR012', '[{\"item\":\"Denomination (Rs)\",\"price\":5},{\"item\":\"Denomination (Rs)\",\"price\":5},{\"item\":\"Denomination (Rs)\",\"price\":null}]', '10.00', 2023, 1),
(14, 123, '21ITR012', '[{\"item\":\"Denomination (Rs)\",\"price\":10},{\"item\":\"Denomination (Rs)\",\"price\":10},{\"item\":\"Denomination (Rs)\",\"price\":10},{\"item\":\"Denomination (Rs)\",\"price\":10},{\"item\":\"Denomination (Rs)\",\"price\":null}]', '40.00', 2023, 1),
(15, 123, '21ITR012', '[{\"item\":\"Denomination (Rs)\",\"price\":5},{\"item\":\"Denomination (Rs)\",\"price\":5},{\"item\":\"Denomination (Rs)\",\"price\":null}]', '10.00', 2023, 0),
(16, 55420520, 'sadsad', '[{\"item\":\"Denomination (Rs)\",\"price\":10},{\"item\":\"Denomination (Rs)\",\"price\":10},{\"item\":\"Denomination (Rs)\",\"price\":null}]', '20.00', 2023, 0),
(17, 55420520, 'sadsad', '[{\"item\":\"Denomination (Rs)\",\"price\":10},{\"item\":\"Denomination (Rs)\",\"price\":10},{\"item\":\"Denomination (Rs)\",\"price\":null}]', '20.00', 2023, 0),
(18, 123, '21ITR012', '[{\"item\":\"Denomination (Rs)\",\"price\":10},{\"item\":\"Denomination (Rs)\",\"price\":null}]', '10.00', 2023, 0),
(19, 55420520, '', '[{\"item\":\"Denomination (Rs)\",\"price\":5},{\"item\":\"Denomination (Rs)\",\"price\":5},{\"item\":\"Denomination (Rs)\",\"price\":null}]', '10.00', 2023, 0),
(20, 55420520, '', '[{\"item\":\"Denomination (Rs)\",\"price\":5},{\"item\":\"Denomination (Rs)\",\"price\":5},{\"item\":\"Denomination (Rs)\",\"price\":null}]', '10.00', 2023, 0),
(21, 55420520, '', '[{\"item\":\"Denomination (Rs)\",\"price\":5},{\"item\":\"Denomination (Rs)\",\"price\":5},{\"item\":\"Denomination (Rs)\",\"price\":null}]', '10.00', 2023, 0),
(22, 55420520, '', '[{\"item\":\"Denomination (Rs)\",\"price\":200},{\"item\":\"Denomination (Rs)\",\"price\":100},{\"item\":\"Denomination (Rs)\",\"price\":null}]', '300.00', 2023, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_marks`
--

CREATE TABLE `student_marks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_the_iot_projects`
--

CREATE TABLE `table_the_iot_projects` (
  `name` varchar(100) NOT NULL,
  `id` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `roll` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `table_the_iot_projects`
--

INSERT INTO `table_the_iot_projects` (`name`, `id`, `gender`, `email`, `mobile`, `roll`) VALUES
('essaki', '-', 'Male', 'essakiraja.com', 'asc', ''),
('essaki', '1', 'Male', 'essakiraja.com', 'asc', ''),
('essakirajas', '123', 'Male', 'essakiraja.com', '9345738', '21I012'),
('Mukdhesh', '12345', 'Male', 'mukhdheshn@gmail.com', '8476686', '21IT37'),
('praveen', '24', 'Male', 'hqdkjf', 'aflkjw', '23R068'),
('raja', '34', 'Male', 'essakiraja246810@gmail.com', '94653', '2R001'),
('Alsan', '39EAB06D', 'Male', 'mydigit@gmail.com', '9898787', ''),
('joel', '54', 'Male', 'bmj', 'mjh', '21CBR025'),
('sdf', '55420520', 'Male', 'as', 'aegsr', 'sadsad'),
('b', '554<:52:', 'Male', 'sf', 's', 'sf'),
('Caroline', '554CA52A', 'Female', 'caroline@gmail.com', '76757', '21021'),
('John', '769174F8', 'Male', 'john@email.com', '23456789', ''),
('Thvhm,b', '81A3DC79', 'Female', 'jgkhkkmanjil@gmail.com', '45768767564', ''),
('The IoT Projects', '866080F8', 'Male', 'ask.theiotprojects@gmail.com', '9800988978', ''),
('essaki', 'h', 'Male', 'm', 'm', 'n'),
('essaki', 'w', 'Male', 'essakiraj@gmail.com', 'asc', ''),
('essaki', 'z', 'Male', 'essakiraj@gmail.com', 'asc', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `student_marks`
--
ALTER TABLE `student_marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_the_iot_projects`
--
ALTER TABLE `table_the_iot_projects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `student_marks`
--
ALTER TABLE `student_marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
