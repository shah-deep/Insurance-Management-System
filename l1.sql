-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2020 at 07:39 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `l1`
--
CREATE DATABASE IF NOT EXISTS `l1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `l1`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_id` int(10) DEFAULT NULL,
  `Branch_id` int(5) DEFAULT NULL,
  `Name` varchar(30) DEFAULT NULL,
  `Mobile_no` int(10) DEFAULT NULL,
  `Email_id` varchar(15) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Designation` varchar(15) DEFAULT NULL,
  `Address` varchar(30) DEFAULT NULL,
  `Password` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `adm_agent`
--

CREATE TABLE `adm_agent` (
  `Admin_id` int(10) DEFAULT NULL,
  `Agency_code` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `Agency_code` int(10) DEFAULT NULL,
  `Branch_id` int(5) DEFAULT NULL,
  `Name` varchar(30) DEFAULT NULL,
  `Mobile_no` int(10) DEFAULT NULL,
  `Email_id` varchar(15) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Designation` varchar(15) DEFAULT NULL,
  `Address` varchar(30) DEFAULT NULL,
  `Password` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`Agency_code`, `Branch_id`, `Name`, `Mobile_no`, `Email_id`, `DOB`, `Designation`, `Address`, `Password`) VALUES
(123, 431, 'Raju', 2147483647, 'inka@gmail.com', '0000-00-00', 'Client', 'Rkstreet', '$2y$10$z793YENIZ0ysidiLjmaAPuYFLyMvJ.dtFkkRqg8Huo5syLijSMeyC');

-- --------------------------------------------------------

--
-- Table structure for table `payment_record`
--

CREATE TABLE `payment_record` (
  `Policy_no` int(10) DEFAULT NULL,
  `Mode` varchar(15) DEFAULT NULL,
  `Time` time DEFAULT NULL,
  `Amount` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `Plan_no` int(7) DEFAULT NULL,
  `Name` varchar(15) DEFAULT NULL,
  `MMA` int(3) DEFAULT NULL,
  `min_SA` int(11) DEFAULT NULL,
  `max_SA` int(11) DEFAULT NULL,
  `Term` int(11) DEFAULT NULL,
  `PPT` int(11) DEFAULT NULL,
  `min_age` int(11) DEFAULT NULL,
  `max_age` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `policy`
--

CREATE TABLE `policy` (
  `Policy_no` int(10) DEFAULT NULL,
  `Plan_no` int(7) DEFAULT NULL,
  `Agency_code` int(10) DEFAULT NULL,
  `Premium` int(11) DEFAULT NULL,
  `DOC` date DEFAULT NULL,
  `Commission` int(11) DEFAULT NULL,
  `Mode` varchar(10) DEFAULT NULL,
  `SA` int(11) DEFAULT NULL,
  `FUP` date DEFAULT NULL,
  `Term` int(11) DEFAULT NULL,
  `PPT` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `policy_holder`
--

CREATE TABLE `policy_holder` (
  `Policy_no` int(10) DEFAULT NULL,
  `Name` varchar(30) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Email_id` varchar(20) DEFAULT NULL,
  `City` varchar(15) DEFAULT NULL,
  `Colony` varchar(15) DEFAULT NULL,
  `House_no` varchar(10) DEFAULT NULL,
  `Pincode` int(6) DEFAULT NULL,
  `Address` varchar(50) GENERATED ALWAYS AS (`House_no` + `Colony` + `City` + `Pincode`) VIRTUAL,
  `Nominee_name` varchar(30) DEFAULT NULL,
  `Nominee_relation` varchar(15) DEFAULT NULL,
  `Nominee` varchar(45) GENERATED ALWAYS AS (`Nominee_name` + `Nominee_relation`) VIRTUAL,
  `Height` int(11) DEFAULT NULL,
  `Weight` int(11) DEFAULT NULL,
  `Gender` char(1) DEFAULT NULL,
  `Occupation` varchar(15) DEFAULT NULL,
  `Edu_ql` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
