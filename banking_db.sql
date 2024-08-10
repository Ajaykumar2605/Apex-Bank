-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2023 at 07:24 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banking_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `accno` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `mail` text NOT NULL,
  `amt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`accno`, `name`, `mail`, `amt`) VALUES
(9843, ' Arjun', ' arjun1978@gmail.com', 3000),
(4815, ' Balan', ' balan2005@gmail.cm', 2800),
(7094, ' Cheran', ' cheran6789@gmail.com', 2400),
(8246, ' Durga', ' durga3467@gmail.com', 2600),
(9443, ' Indra', ' indra8906@gmail.com', 2000),
(7832, ' Logesh', ' logesh3457@gmail.com', 8000),
(9098, ' Ravi', ' ravi3478@gmail.com', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `sno` int(3) NOT NULL,
  `sender` text NOT NULL,
  `receiver` text NOT NULL,
  `balance` int(8) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`sno`, `sender`, `receiver`, `balance`, `datetime`) VALUES
(1, ' Balan', ' Arjun', 200, '2023-09-09 19:55:51'),
(2, ' Cheran', ' Indra', 500, '2023-09-09 19:57:33'),
(3, ' Durga', ' Indra', 1000, '2023-09-09 20:02:30'),
(4, ' Logesh', ' Cheran', 200, '2023-09-09 20:05:35'),
(5, ' Logesh', ' Cheran', 200, '2023-09-09 20:07:33'),
(6, ' Logesh', ' Durga', 600, '2023-09-09 20:58:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `sno` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
