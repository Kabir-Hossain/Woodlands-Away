-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2017 at 05:23 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dw_00159125`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_Id` int(5) NOT NULL,
  `Cabin Type` varchar(100) NOT NULL,
  `start_date` varchar(20) NOT NULL,
  `end_date` varchar(20) NOT NULL,
  `adult` int(8) NOT NULL,
  `children` int(8) NOT NULL,
  `price` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(14) NOT NULL,
  `date` varchar(12) NOT NULL,
  `gender` text NOT NULL,
  `address` varchar(300) NOT NULL,
  `postcode` varchar(5) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `Role` int(5) NOT NULL DEFAULT '1' COMMENT '0-Admin, 1-User'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `date`, `gender`, `address`, `postcode`, `pass`, `Role`) VALUES
(1, 'Kabir', 'kabbirs96@gmail.com', '01747060854', '12-16-1996', 'Male', '47/A Panthapath, Dhaka', '7900', '202cb962ac59075b964b07152d234b70', 0),
(2, 'Konok', 'konok@gmail.com', '01747060854', '12/03/2017', 'Male', '47/A Panthapath, Dhaka', '1200', '202cb962ac59075b964b07152d234b70', 1),
(3, 'Mosharof', 'mosharof@gmail.com', '01971992800', '9/10/1997', 'Male', 'Panthapath', '1150', '202cb962ac59075b964b07152d234b70', 1),
(4, 'Arif', 'arif@gmail.com', '01971992800', '17/17/1996', 'Male', 'Square', '1200', '202cb962ac59075b964b07152d234b70', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_Id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
