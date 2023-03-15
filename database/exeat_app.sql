-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 15, 2023 at 07:59 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exeat_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'principal', '12345'),
(2, 'classteacher', '12345'),
(3, 'housemanager', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regnumber` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `request` text NOT NULL,
  `exeatDate` date NOT NULL,
  `returnDate` date NOT NULL,
  `classTeacher` varchar(50) NOT NULL,
  `houseManager` varchar(50) NOT NULL,
  `principal` varchar(50) NOT NULL,
  `requestStatus` varchar(50) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `regnumber`, `firstname`, `surname`, `request`, `exeatDate`, `returnDate`, `classTeacher`, `houseManager`, `principal`, `requestStatus`, `created`) VALUES
(1, 'DLHS0001', 'John', 'Doe', 'I want to go home for treatment', '2023-03-08', '2023-03-16', 'PENDING', 'PENDING', 'DISAPPROVED', 'DISAPPROVED', '2023-03-07 15:42:46'),
(2, 'DLHS0001', 'John', 'Doe', 'I need to go and buy some things', '2023-03-16', '2023-03-30', 'DISAPPROVED', 'PENDING', 'DISAPPROVED', 'DISAPPROVED', '2023-03-07 16:01:48'),
(3, 'DLHS0001', 'John', 'Doe', 'I need to meet with the Doctor', '2023-03-08', '2023-03-11', 'PENDING', 'PENDING', 'APPROVED', 'APPROVED', '2023-03-07 16:02:43'),
(4, 'DLHS0001', 'John', 'Doe', 'My parents need my attention at home', '2023-03-13', '2023-03-17', 'PENDING', 'PENDING', 'APPROVED', 'APPROVED', '2023-03-07 16:03:25'),
(5, 'DLHS0001', 'John', 'Doe', 'Medical attention', '2023-03-13', '2023-03-16', 'APPROVED', 'APPROVED', 'APPROVED', 'APPROVED', '2023-03-08 21:21:50');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regnumber` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `regnumber`, `firstname`, `surname`, `password`) VALUES
(1, 'DLHS0001', 'John', 'Doe', '12345'),
(2, 'DLHS0002', 'Jane', 'David', '11111');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
