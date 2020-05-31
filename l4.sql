-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2020 at 04:32 PM
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
-- Database: `l3`
--
CREATE DATABASE IF NOT EXISTS `l4` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `l4`;

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
  `Branch_id` int(5) UNSIGNED ZEROFILL DEFAULT NULL CHECK (octet_length(`Branch_id`) = 5),
  `Name` varchar(30) NOT NULL,
  `Mobile_no` int(10) UNSIGNED DEFAULT NULL,
  `Email_id` varchar(64) DEFAULT NULL,
  `DOB` date,
  `AGE` int(11) GENERATED ALWAYS AS (timestampdiff(YEAR,`DOB`,curdate())) VIRTUAL,
  `Designation` varchar(15) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `admin`:
--

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

DROP TABLE IF EXISTS `agent`;
CREATE TABLE `agent` (
  `Agency_code` int(7) UNSIGNED ZEROFILL NOT NULL CHECK (octet_length(`Agency_code`) = 7),
  `Admin_id` int(5) UNSIGNED ZEROFILL DEFAULT NULL CHECK (octet_length(`Admin_id`) = 5),
  `Branch_id` int(5) UNSIGNED ZEROFILL DEFAULT NULL CHECK (octet_length(`Branch_id`) = 5),
  `Name` varchar(30) NOT NULL,
  `Mobile_no` int(10) UNSIGNED DEFAULT NULL,
  `Email_id` varchar(64) DEFAULT NULL,
  `DOB` date,
  `AGE` int(11) GENERATED ALWAYS AS (timestampdiff(YEAR,`DOB`,curdate())) VIRTUAL,
  `Designation` varchar(15) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `agent`:
--   `Admin_id`
--       `admin` -> `Admin_id`
--


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

--
-- RELATIONSHIPS FOR TABLE `payment_record`:
--   `Policy_no`
--       `policy` -> `Policy_no`
--


-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

DROP TABLE IF EXISTS `plan`;
CREATE TABLE `plan` (
  `Plan_no` int(3) UNSIGNED NOT NULL CHECK (octet_length(`Plan_no`) = 3),
  `Name` varchar(15) DEFAULT NULL,
  `MMA` int(3) NOT NULL,
  `min_SA` int(10) UNSIGNED DEFAULT NULL CHECK (`min_SA` > 0),
  `max_SA` int(10) UNSIGNED DEFAULT NULL,
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
-- RELATIONSHIPS FOR TABLE `plan`:
--


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
  `DOC` date,
  `FUP` date,
  `Mode` enum('yearly','halfly','monthly','quartely','single premium') DEFAULT NULL,
  `SA` int(10) UNSIGNED NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 1,
  `Term` int(11) NOT NULL,
  `PPT` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `policy`:
--   `Plan_no`
--       `plan` -> `Plan_no`
--   `Agency_code`
--       `agent` -> `Agency_code`
--


-- --------------------------------------------------------

--
-- Table structure for table `policy_holder`
--

DROP TABLE IF EXISTS `policy_holder`;
CREATE TABLE `policy_holder` (
  `Policy_no` int(9) UNSIGNED DEFAULT NULL CHECK (octet_length(`Policy_no`) = 9),
  `Name` varchar(30) NOT NULL,
  `Mobile_no` int(10) NOT NULL,
  `Email_id` varchar(64) DEFAULT NULL,
  `City` varchar(15) DEFAULT NULL,
  `Colony` varchar(15) DEFAULT NULL,
  `House_no` varchar(10) DEFAULT NULL,
  `Pincode` int(6) DEFAULT NULL,
  `Nominee_name` varchar(30) NOT NULL,
  `Nominee_relation` enum('Parent','Child','Spouse','Grand child','Relative','Friend') DEFAULT NULL,
  `Gender` enum('MALE','FEMALE','OTHER') DEFAULT NULL,
  `Occupation` varchar(15) DEFAULT NULL,
  `DOB` date,
  `Edu_ql` varchar(20) DEFAULT NULL,
  `AGE` int(11) GENERATED ALWAYS AS (timestampdiff(YEAR,`DOB`,curdate())) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `policy_holder`:
--   `Policy_no`
--       `policy` -> `Policy_no`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_id`),
  ADD UNIQUE KEY `Mobile_no` (`Mobile_no`),
  ADD UNIQUE KEY `Email_id` (`Email_id`);

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`Agency_code`),
  ADD UNIQUE KEY `Mobile_no` (`Mobile_no`),
  ADD UNIQUE KEY `Email_id` (`Email_id`),
  ADD KEY `Admin_id` (`Admin_id`) USING BTREE;

--
-- Indexes for table `payment_record`
--
ALTER TABLE `payment_record`
  ADD PRIMARY KEY (`Policy_no`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`Plan_no`);

--
-- Indexes for table `policy`
--
ALTER TABLE `policy`
  ADD PRIMARY KEY (`Policy_no`),
  ADD KEY `Plan_no` (`Plan_no`) USING BTREE,
  ADD KEY `Agency_code` (`Agency_code`) USING BTREE;

--
-- Indexes for table `policy_holder`
--
ALTER TABLE `policy_holder`
  ADD UNIQUE KEY `Policy_no` (`Policy_no`),
  ADD UNIQUE KEY `Email_id` (`Email_id`);

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
  ADD CONSTRAINT `policy_ibfk_1` FOREIGN KEY (`Plan_no`) REFERENCES `plan` (`Plan_no`),
  ADD CONSTRAINT `policy_ibfk_2` FOREIGN KEY (`Agency_code`) REFERENCES `agent` (`Agency_code`);

--
-- Constraints for table `policy_holder`
--
ALTER TABLE `policy_holder`
  ADD CONSTRAINT `policy_holder_ibfk_1` FOREIGN KEY (`Policy_no`) REFERENCES `policy` (`Policy_no`);


--
-- Metadata
--
USE `phpmyadmin`;

--
-- Metadata for table admin
--

--
-- Metadata for table agent
--

--
-- Metadata for table payment_record
--

--
-- Metadata for table plan
--

--
-- Metadata for table policy
--

--
-- Metadata for table policy_holder
--

--
-- Metadata for database l3
--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
