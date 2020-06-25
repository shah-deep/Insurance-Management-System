-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2020 at 04:28 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `l5`
--
CREATE DATABASE IF NOT EXISTS `l5` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `l5`;

DELIMITER $$
--
-- Functions
--
DROP FUNCTION IF EXISTS `COM`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `COM` (`pre` INT, `t` INT) RETURNS INT(11) BEGIN
			IF t = 1 THEN
				RETURN pre*2/100;
			ELSE
				RETURN (pre*25 + pre*(t-1)*5)/100;
			END IF;
	END$$

DROP FUNCTION IF EXISTS `SEL`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `SEL` (`pno` INT) RETURNS DATE BEGIN

		DECLARE N INT;
        DECLARE FUPD DATE;
		SELECT MODE+0,FUP FROM Policy WHERE Policy_no = pno INTO N,FUPD;
        IF N = 1 THEN
			RETURN DATE_ADD(FUPD,INTERVAL 1 YEAR);
		ELSEIF N = 2 THEN
			RETURN DATE_ADD(FUPD,INTERVAL 6 MONTH);
		ELSEIF N = 3 THEN
			RETURN DATE_ADD(FUPD,INTERVAL 1 QUARTER);
		ELSEIF N = 4 THEN
			RETURN DATE_ADD(FUPD,INTERVAL 1 MONTH);
		ELSEIF N = 5 THEN
			RETURN NULL;
		END IF;
	END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `Admin_id` int(5) UNSIGNED ZEROFILL NOT NULL CHECK (octet_length(`Admin_id`) = 5),
  `Branch_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Mobile_no` bigint(10) UNSIGNED NOT NULL,
  `Email_id` varchar(64) DEFAULT NULL,
  `DOB` date NOT NULL,
  `AGE` int(11) GENERATED ALWAYS AS (timestampdiff(YEAR,`DOB`,curdate())) VIRTUAL,
  `Designation` varchar(15) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_id`, `Branch_id`, `Name`, `Mobile_no`, `Email_id`, `DOB`, `Designation`, `City`, `Password`) VALUES
(10100, 41725, 'b', 9428363267, 'abc@ac.x', '0000-00-00', 'abc', 'zyx', '$2y$10$MqdJAcKBvX8uRBDIEM8k7O7mAAhgCyDNMm63rEDo8jXCoQl2VZvku'),
(10101, 41725, 'a', 9909564613, 'abc@ac.x', '2020-06-25', 'abc', 'zyx', '$2y$10$Nz5RuVAtjatrsivgllFTa.tqQvg/p6yygQgGkU93yHADH49Pj1w2G'),
(12345, 41725, 'Admin', 0, NULL, '0000-00-00', NULL, NULL, '$2y$10$8ZZ9sM/2pxfFurpQmE4Zzur0FrXguiU/jYAiDX6rKP1ZaUv.3MN0u');

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

DROP TABLE IF EXISTS `agent`;
CREATE TABLE `agent` (
  `Agency_code` int(7) UNSIGNED ZEROFILL NOT NULL CHECK (octet_length(`Agency_code`) = 7),
  `Admin_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `Branch_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Mobile_no` bigint(10) UNSIGNED NOT NULL,
  `Email_id` varchar(64) DEFAULT NULL,
  `DOB` date NOT NULL,
  `AGE` int(11) GENERATED ALWAYS AS (timestampdiff(YEAR,`DOB`,curdate())) VIRTUAL,
  `Designation` varchar(15) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`Agency_code`, `Admin_id`, `Branch_id`, `Name`, `Mobile_no`, `Email_id`, `DOB`, `Designation`, `City`, `Password`) VALUES
(1111111, 12345, 41725, 'a', 9909564738, 'abc@ac.x', '2001-02-10', 'abc', 'zyx', '$2y$10$FicQQ20HObsHEZtjqrYOsOCMLDul9Zu7RGUldjpW/UcxfMqoVPngK'),
(1234321, 12345, 41725, 'x', 9898767600, 'abc@ac.x', '2020-06-04', 'abc', 'zyx', '$2y$10$RSS7McEPdiFy339lA6sQrenk1KbRMOtdK/QUfgQ1VZ2cJMlty31Ua'),
(1234567, 12345, 41725, 'x', 9909564613, 'abc@ac.x', '2020-06-23', 'abc', 'zyx', '$2y$10$a9lBa1Qm48gWhGhPcnrZpudTrg/PFa1cAMA9HIIRL5h0/KiJk2gTm');

-- --------------------------------------------------------

--
-- Table structure for table `payment_record`
--

DROP TABLE IF EXISTS `payment_record`;
CREATE TABLE `payment_record` (
  `Policy_no` int(9) UNSIGNED NOT NULL CHECK (octet_length(`Policy_no`) = 9),
  `Mode` enum('Cash','Other') NOT NULL,
  `Date_Time` timestamp NOT NULL DEFAULT current_timestamp(),
  `Amount` int(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

DROP TABLE IF EXISTS `plan`;
CREATE TABLE `plan` (
  `Plan_no` int(3) UNSIGNED NOT NULL CHECK (octet_length(`Plan_no`) = 3),
  `Name` varchar(15) DEFAULT NULL,
  `MMA` int(3) NOT NULL,
  `min_SA` bigint(10) UNSIGNED NOT NULL,
  `max_SA` bigint(10) UNSIGNED DEFAULT NULL,
  `min_age` int(10) UNSIGNED NOT NULL,
  `max_age` int(10) UNSIGNED NOT NULL,
  `MODE_YEARLY` tinyint(1) DEFAULT 1,
  `MODE_HALFLY` tinyint(1) DEFAULT 1,
  `MODE_QUARTELY` tinyint(1) DEFAULT 1,
  `MODE_MONTHLY` tinyint(1) DEFAULT 1,
  `MODE_SINGLE` tinyint(1) DEFAULT 0,
  `Type_term` tinyint(1) DEFAULT NULL,
  `T1` int(11) DEFAULT NULL,
  `T2` int(11) DEFAULT NULL,
  `T3` int(11) DEFAULT NULL,
  `T4` int(11) DEFAULT NULL,
  `P1` int(11) DEFAULT NULL,
  `P2` int(11) DEFAULT NULL,
  `P3` int(11) DEFAULT NULL,
  `P4` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`Plan_no`, `Name`, `MMA`, `min_SA`, `max_SA`, `min_age`, `max_age`, `MODE_YEARLY`, `MODE_HALFLY`, `MODE_QUARTELY`, `MODE_MONTHLY`, `MODE_SINGLE`, `Type_term`, `T1`, `T2`, `T3`, `T4`, `P1`, `P2`, `P3`, `P4`) VALUES
(914, 'New Endowment', 75, 100000, NULL, 8, 55, 1, 1, 1, 1, 0, 0, 12, 35, NULL, NULL, NULL, NULL, NULL, NULL),
(915, 'JeevanAnand', 75, 0, 0, 18, 50, 1, 1, 1, 1, NULL, 0, 15, 35, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `policy`
--

DROP TABLE IF EXISTS `policy`;
CREATE TABLE `policy` (
  `Policy_no` int(9) UNSIGNED NOT NULL CHECK (octet_length(`Policy_no`) = 9),
  `Plan_no` int(3) UNSIGNED NOT NULL,
  `Agency_code` int(7) UNSIGNED ZEROFILL NOT NULL,
  `Premium` int(10) UNSIGNED NOT NULL,
  `DOC` date DEFAULT NULL,
  `FUP` date DEFAULT NULL,
  `Mode` enum('yearly','halfly','monthly','quartely','single premium') DEFAULT NULL,
  `SA` bigint(10) UNSIGNED NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 1,
  `Term` int(11) NOT NULL,
  `PPT` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `policy`
--

INSERT INTO `policy` (`Policy_no`, `Plan_no`, `Agency_code`, `Premium`, `DOC`, `FUP`, `Mode`, `SA`, `Status`, `Term`, `PPT`) VALUES
(111111111, 914, 1234567, 2256, '2020-06-25', '2022-06-25', 'yearly', 100000, 1, 13, 13),
(121111111, 914, 1234567, 1345, '2020-05-21', '2021-05-21', 'yearly', 200000, 1, 19, 19);

-- --------------------------------------------------------

--
-- Table structure for table `policy_holder`
--

DROP TABLE IF EXISTS `policy_holder`;
CREATE TABLE `policy_holder` (
  `Policy_no` int(9) UNSIGNED NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Mobile_no` bigint(10) NOT NULL,
  `Email_id` varchar(64) DEFAULT NULL,
  `City` varchar(15) DEFAULT NULL,
  `Colony` varchar(15) DEFAULT NULL,
  `House_no` varchar(10) DEFAULT NULL,
  `Pincode` int(6) DEFAULT NULL,
  `Nominee_name` varchar(30) NOT NULL,
  `Nominee_relation` enum('Parent','Child','Spouse','Grand child','Relative','Friend') NOT NULL,
  `Gender` enum('MALE','FEMALE','OTHER') DEFAULT NULL,
  `Occupation` varchar(15) DEFAULT NULL,
  `DOB` date NOT NULL,
  `Edu_ql` varchar(20) DEFAULT NULL,
  `AGE` int(11) GENERATED ALWAYS AS (timestampdiff(YEAR,`DOB`,curdate())) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `policy_holder`
--

INSERT INTO `policy_holder` (`Policy_no`, `Name`, `Mobile_no`, `Email_id`, `City`, `Colony`, `House_no`, `Pincode`, `Nominee_name`, `Nominee_relation`, `Gender`, `Occupation`, `DOB`, `Edu_ql`) VALUES
(111111111, 'x', 9687586989, 'abc@ac.x', 'a', 'a', '1', 123456, 'a', 'Parent', 'MALE', 'a', '1996-01-02', 'a'),
(121111111, 'x', 9909564632, 'abc@ac.x', 'a', 'a', '1', 123456, 'a', 'Parent', 'MALE', 'a', '2020-01-03', 'a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_id`);

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`Agency_code`),
  ADD KEY `Admin_id` (`Admin_id`) USING BTREE;

--
-- Indexes for table `payment_record`
--
ALTER TABLE `payment_record`
  ADD PRIMARY KEY (`Policy_no`,`Date_Time`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`Plan_no`);

--
-- Indexes for table `policy`
--
ALTER TABLE `policy`
  ADD PRIMARY KEY (`Policy_no`);

--
-- Indexes for table `policy_holder`
--
ALTER TABLE `policy_holder`
  ADD UNIQUE KEY `Policy_no` (`Policy_no`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agent`
--
ALTER TABLE `agent`
  ADD CONSTRAINT `agent_ibfk_1` FOREIGN KEY (`Admin_id`) REFERENCES `admin` (`Admin_id`);

--
-- Constraints for table `payment_record`
--
ALTER TABLE `payment_record`
  ADD CONSTRAINT `payment_record_ibfk_1` FOREIGN KEY (`Policy_no`) REFERENCES `policy` (`Policy_no`);

--
-- Constraints for table `policy`
--
ALTER TABLE `policy`
  ADD CONSTRAINT `policy_ibfk_2` FOREIGN KEY (`Agency_code`) REFERENCES `agent` (`Agency_code`);

--
-- Constraints for table `policy_holder`
--
ALTER TABLE `policy_holder`
  ADD CONSTRAINT `policy_holder_ibfk_1` FOREIGN KEY (`Policy_no`) REFERENCES `policy` (`Policy_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
