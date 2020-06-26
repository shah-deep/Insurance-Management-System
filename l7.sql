-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2020 at 05:24 PM
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
-- Database: `l7`
--
CREATE DATABASE IF NOT EXISTS `l7` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `l7`;

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
        DECLARE DOCD DATE;
        DECLARE T INT;
		SELECT MODE+0,FUP,DOC,PPT FROM Policy WHERE Policy_no = pno INTO N,FUPD,DOCD,T;
        IF N = 1 AND (YEAR(FUPD)-YEAR(DOCD))< T THEN
			RETURN DATE_ADD(FUPD,INTERVAL 1 YEAR);
		ELSEIF N = 2 AND (YEAR(FUPD)-YEAR(DOCD))< T THEN
			RETURN DATE_ADD(FUPD,INTERVAL 6 MONTH);
		ELSEIF N = 4 AND (YEAR(FUPD)-YEAR(DOCD))< T THEN
			RETURN DATE_ADD(FUPD,INTERVAL 1 QUARTER);
		ELSEIF N = 3 AND (YEAR(FUPD)-YEAR(DOCD))< T THEN
			RETURN DATE_ADD(FUPD,INTERVAL 1 MONTH);
		ELSE
			RETURN NULL;
		END IF;
	END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--
-- Creation: Jun 26, 2020 at 02:05 PM
-- Last update: Jun 26, 2020 at 03:04 PM
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
(11548, 83038, 'Juned S. Chintaman', 8077641662, 'JunedC11@gmail.com', '1970-03-15', 'Admin', 'Ahmedabad', '$2y$10$ElaW.T.clyLQw0KqumR.T.YWJFXxU522lxDPXOpJh.pW2F.pVx37G'),
(11838, 83031, 'Ashish Kusvaha ', 6357092231, 'Kusvashish3@gmail.com', '1988-10-14', 'Admin', 'Vadodara', '$2y$10$hRRUZgQpZyPLN7ItMptvVODRn/xEnpqygNmRrRl7BAZQNEdcRgpNq'),
(15280, 83038, 'N D Upadhyay', 7668033040, 'ndupadhyay0@gmail.com', '1970-04-04', 'Admin', 'Ahmedabad', '$2y$10$b7KlN7yuqABTKFxvmwnJ7eTCcUibglMz.f6Cf1LLBm8LCIDJVT46.'),
(29658, 83038, 'P D Vasava', 7568027099, 'pdvasava26@gmail.com', '1974-11-15', 'Admin', 'Ahmedabad', '$2y$10$vdlJCTsBUBPt42YJov//B.XFWhfHxrsMYWWrlP6wHmS/B.uvADA/S');

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--
-- Creation: Jun 26, 2020 at 02:05 PM
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
(1090083, 15280, 83038, 'Kshma Mehta', 9757346280, 'kshma172@gmail.com', '1978-09-12', 'Agent', 'Ahmedabad', '$2y$10$n08KD3Ie1hV0ZYqcaahjvetMWsQGdKE/wKQ7goV5fG6QNWbbHB5li'),
(1191830, 11548, 83038, 'Amit Patel', 9825081438, 'pamit21@gmail.com', '1992-05-05', 'Agent', 'Ahmedabad', '$2y$10$deO5uEqXtqsvrKLdTI/JZe0gZTnjyTdoq5ICTjBd8podgAWkGrXMC'),
(1335830, 11548, 83038, 'Bariya Sumitra B.', 9352906561, 'sbariya@gmail.com', '1988-07-13', 'Teacher', 'Ahmedabad', '$2y$10$S.I8PKczpG27I03VmOsTxex7NzvNRUN8o3K8QuFYgsspNOiUhmR7i'),
(1768220, 15280, 83038, 'Bhanuprasad R.', 9987224005, 'rbhanu89@gmail.com', '1982-04-02', 'Teacher', 'Ahmedabad', '$2y$10$tztg4oDb8710a68t73JOS.vjDkwA8JWNnt9W5NWAEtkmgcNBNzN7W'),
(2818003, 15280, 83038, 'Harshkumar Vankar', 9780453644, 'vharsh78@gmail.com', '1996-09-10', 'Agent', 'Ahmedabad', '$2y$10$t6CW0TM5kxXiW5bnmiFGbuRiXx7B5ovEnBTuetTGWZ6O6v032Q3Di'),
(5608733, 11838, 83031, 'Lata B. Gandhi', 9689336002, 'Glata800@gmail.com', '1983-08-13', 'Agent', 'Vadodara', '$2y$10$6JFqepIx1s2dn3hsixfH6u4QqWX9mXoc9vmii.P9faTjE0WH4tzb6'),
(6528003, 15280, 83038, 'Sevak Mohitkumar', 9678342210, 'sevakmohit6@gmail.com', '1987-06-09', 'Agent', 'Ahmedabad', '$2y$10$Bc8wVOfYTTusi3k7cCSTy.QWbtdMsJThEEHj2iLpjatYQtx4/9xL6');

-- --------------------------------------------------------

--
-- Table structure for table `payment_record`
--
-- Creation: Jun 26, 2020 at 02:05 PM
-- Last update: Jun 26, 2020 at 03:21 PM
--

DROP TABLE IF EXISTS `payment_record`;
CREATE TABLE `payment_record` (
  `Policy_no` int(9) UNSIGNED NOT NULL CHECK (octet_length(`Policy_no`) = 9),
  `Mode` enum('Cash','Other') NOT NULL,
  `Date_Time` timestamp NOT NULL DEFAULT current_timestamp(),
  `Amount` int(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_record`
--

INSERT INTO `payment_record` (`Policy_no`, `Mode`, `Date_Time`, `Amount`) VALUES
(119100231, 'Other', '2020-01-26 13:00:38', 45290),
(119120032, 'Other', '2018-03-01 13:10:19', 1790),
(119120032, 'Other', '2018-03-26 13:23:55', 1784),
(119120032, 'Cash', '2018-04-03 13:36:47', 1784),
(133500210, 'Other', '2020-04-26 13:38:15', 15802),
(133500210, 'Other', '2020-10-26 13:22:32', 15802),
(133500210, 'Other', '2021-04-26 13:36:06', 15802),
(133567022, 'Cash', '2018-06-26 13:38:52', 1345),
(133567022, 'Other', '2018-08-26 13:24:40', 1345),
(133567022, 'Cash', '2018-09-26 13:26:36', 1345),
(133599011, 'Cash', '2020-01-26 13:34:53', 801),
(133599011, 'Cash', '2020-02-26 13:40:32', 801),
(133599011, 'Cash', '2020-03-26 13:27:29', 801),
(133599011, 'Other', '2020-04-26 13:25:17', 801),
(133800023, 'Cash', '2018-08-26 13:30:43', 11740),
(133800023, 'Other', '2018-12-26 13:20:36', 11740),
(879240233, 'Cash', '2013-09-09 08:02:27', 49392),
(879248582, 'Cash', '2009-06-26 09:32:40', 26615),
(879248582, 'Cash', '2010-06-26 09:32:50', 26615),
(879248582, 'Cash', '2011-06-26 09:33:01', 26615),
(879248582, 'Other', '2012-06-26 09:33:18', 26620),
(879248582, 'Cash', '2013-06-26 09:33:27', 26615),
(879248582, 'Cash', '2014-06-26 09:33:37', 26615),
(879248582, 'Cash', '2015-06-26 09:33:51', 26615),
(879248582, 'Cash', '2016-06-26 09:34:10', 26615),
(879248582, 'Other', '2017-06-26 09:34:27', 26620),
(879248582, 'Cash', '2018-06-13 09:30:00', 26615),
(879248582, 'Other', '2019-06-26 09:41:38', 26615),
(879253288, 'Cash', '2015-06-26 07:49:05', 13450),
(879253288, 'Cash', '2016-06-10 07:51:27', 13450),
(879253288, 'Other', '2017-06-20 07:52:21', 13450),
(879261413, 'Cash', '2014-10-22 08:42:32', 195650),
(897600128, 'Other', '2010-06-26 13:31:48', 9442),
(897600128, 'Other', '2010-10-26 13:14:24', 9442),
(897600128, 'Cash', '2010-12-26 13:21:32', 9442);

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--
-- Creation: Jun 26, 2020 at 02:05 PM
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
(914, 'NewEndowment', 75, 100000, 0, 8, 55, 1, 1, 1, 1, NULL, 0, 12, 35, 0, 0, 0, 0, 0, 0),
(915, 'JeevanAnand', 75, 100000, 0, 8, 55, 1, 1, 1, 1, NULL, 0, 15, 35, 0, 0, 0, 0, 0, 0),
(916, 'BimaBachat', 62, 50000, 0, 15, 50, NULL, NULL, NULL, NULL, 1, 1, 9, 12, 15, 0, 0, 0, 0, 0),
(917, 'SinglePremiumEn', 75, 50000, 0, 0, 65, NULL, NULL, NULL, NULL, 1, 0, 10, 25, 0, 0, 0, 0, 0, 0),
(936, 'JeevanLabh', 75, 200000, 0, 8, 59, 1, 1, 1, 1, NULL, 1, 16, 21, 25, 0, 10, 15, 16, 0),
(944, 'AdharShila', 70, 75000, 500000, 8, 55, 1, 1, NULL, NULL, NULL, 0, 10, 20, 0, 0, 0, 0, 0, 0),
(961, 'MicroBachat', 70, 50000, 200000, 18, 55, 1, 1, 1, 1, NULL, 0, 10, 15, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `policy`
--
-- Creation: Jun 26, 2020 at 02:05 PM
-- Last update: Jun 26, 2020 at 02:38 PM
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
(119100231, 917, 1191830, 45290, '2020-01-08', NULL, 'single premium', 100000, 0, 25, 25),
(119102168, 917, 1191830, 74055, '2020-01-17', '2020-01-17', 'single premium', 100000, 1, 10, 10),
(119120032, 915, 1191830, 1784, '2018-02-07', '2018-05-07', 'monthly', 250000, 1, 17, 17),
(133500210, 944, 1335830, 15802, '2020-04-12', '2021-10-12', 'halfly', 450000, 1, 15, 15),
(133567022, 961, 1335830, 1345, '2018-06-06', '2019-03-06', 'quartely', 75000, 1, 12, 12),
(133567220, 916, 1335830, 52418, '2020-02-10', '2020-02-10', 'single premium', 65000, 1, 12, 12),
(133567890, 916, 1335830, 58073, '2020-02-12', '2020-02-12', 'single premium', 75000, 1, 9, 9),
(133590001, 944, 1335830, 21389, '2019-12-14', '2019-12-14', 'yearly', 300000, 1, 12, 12),
(133599011, 961, 1335830, 801, '2019-12-21', '2020-12-21', 'quartely', 50000, 1, 13, 13),
(133800023, 915, 1768220, 11740, '2018-07-13', '2019-07-13', 'halfly', 500000, 1, 24, 24),
(136845670, 917, 1768220, 205222, '2018-11-15', '2018-11-15', 'single premium', 350000, 1, 18, 18),
(176800123, 917, 1768220, 79880, '2015-06-10', '2015-06-10', 'single premium', 150000, 1, 22, 22),
(176890023, 917, 1768220, 89833, '2015-10-14', '2015-10-26', 'single premium', 150000, 1, 18, 18),
(281800123, 936, 2818003, 2947, '2020-01-29', '2020-01-29', 'quartely', 200000, 1, 21, 15),
(281801452, 944, 2818003, 4728, '2020-06-14', '2020-06-14', 'yearly', 100000, 1, 18, 18),
(560810101, 961, 5608733, 1946, '2020-04-04', '2020-04-04', 'quartely', 90000, 1, 10, 10),
(560813344, 914, 5608733, 10049, '2019-12-21', '2019-12-21', 'yearly', 200000, 1, 20, 20),
(652800103, 914, 6528003, 597, '2018-10-24', '2018-10-24', 'monthly', 200000, 1, 30, 30),
(871004430, 916, 1090083, 112428, '2009-10-21', '2009-10-21', 'single premium', 150000, 1, 15, 15),
(879240233, 917, 1090083, 49392, '2013-09-09', NULL, 'single premium', 100000, 0, 24, 24),
(879248582, 936, 1090083, 26615, '2009-06-13', NULL, 'yearly', 300000, 0, 16, 10),
(879253288, 914, 1090083, 13449, '2015-06-08', '2018-06-08', 'yearly', 250000, 1, 20, 20),
(879261413, 916, 1090083, 195647, '2014-10-22', NULL, 'single premium', 250000, 0, 15, 15),
(890012654, 916, 1090083, 54019, '2015-02-27', '2015-02-27', 'single premium', 70000, 1, 9, 9),
(897600128, 936, 1090083, 9442, '2010-07-09', '2012-01-09', 'halfly', 350000, 1, 21, 15);

-- --------------------------------------------------------

--
-- Table structure for table `policy_holder`
--
-- Creation: Jun 26, 2020 at 02:05 PM
-- Last update: Jun 26, 2020 at 03:13 PM
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
(119100231, 'Bhavesh Anand', 6832038237, 'anandb10@gmail.com', 'Ahmedabad', 'Radhey Society', 'D/10', 38002, 'Shilpa', 'Spouse', 'MALE', 'Teacher', '1989-12-23', 'BE in CIVIL'),
(119102168, 'Mishthi Patel', 7896335324, 'mpatel20@gmail.com', 'Ahmedabad', 'Vraj-vihar so.', '203', 38002, 'Anuj Patel', 'Spouse', 'FEMALE', 'House wife', '1985-10-16', '12 pass'),
(119120032, 'VijayAhuja', 7613827823, 'ahujavijay78@gmail.com', 'Ahmedabad', 'Radhey Society', 'G/23', 380002, 'Meera ', 'Grand child', 'MALE', '', '1967-02-21', 'BSc'),
(133500210, 'Parin Reddy', 8326376428, 'reddypravin2@gmail.com', 'Gandhinagar', '', '', 382421, 'Rakhi Reddy', 'Child', 'MALE', 'Developement Of', '1984-12-14', 'Diploma in CS'),
(133567022, 'Anant Bakshi', 8968664565, 'bakshianant1@gmail.com', 'Gandhinagar', '', '', 382421, 'Aanshi Bakshi', 'Spouse', 'MALE', 'Developement Of', '1973-02-07', 'BSc'),
(133567220, 'Laksh Basu ', 7294472938, 'basulax23@gmail.com', 'Ahmedabad', 'Jeevan Society', 'E103', 380002, 'Amisha', 'Spouse', 'MALE', 'Teacher', '1985-07-18', 'MSc'),
(133567890, 'Manan Desai', 9737253276, 'manandesai9@gmail.com', 'Ahmedabad', '', '', 38002, 'Mansi Desai', 'Spouse', 'MALE', 'Doctor', '1972-10-10', 'MBBS'),
(133590001, 'Joseph Amin', 7688567678, 'aminjoseph8@gmail.com', 'Gandhinagar', 'Ratnaraj Reside', 'A103', 382421, 'Mayank Amin', 'Spouse', 'MALE', 'Developement Of', '1990-12-27', 'MSc'),
(133599011, 'Heem Banerjee', 7654656570, 'heem18@gmail.com', 'Ahmedabad', '', '', 380002, 'Shrutva Shukla', 'Friend', 'MALE', 'Teacher', '1980-11-14', 'MBBS'),
(133800023, 'Taara Chowdhury', 8362347683, 'ctara23@gmail.com', 'Ahmedabad', 'Jeevan Society', 'G11', 380002, 'Pragya ', 'Child', 'FEMALE', 'Teacher', '1978-02-26', 'BSc'),
(136845670, 'Sneha Bedi', 8032793237, 'snehavijay34@gmail.com', 'Gandhinagar', 'Jeevan Society', 'W304', 382421, 'Swasti Bedi', 'Child', 'FEMALE', 'House wife', '1978-12-24', '12 pass'),
(176800123, 'Ronak Mahajan', 9714910763, 'mahajanr23@gmail.com', 'Ahmedabad', 'Vraj-vihar so.', '', 380002, 'Rani Sharma', 'Friend', 'MALE', 'Teacher', '1975-04-12', 'MSc'),
(176890023, 'Parthav Verma', 7806546785, 'vermaparthavd34@gmail.com', 'Gandhinagar', 'Ratnaraj Reside', 'E105', 382421, 'Ekansh', 'Relative', 'MALE', 'Professor', '1975-04-17', 'PhD in Biology'),
(281800123, 'Nirav Datta', 9576477865, 'niravd456@gmail.com', 'Gandhinagar', 'Ratnaraj Reside', 'C302', 382421, 'Nisha', 'Child', 'MALE', 'Doctor', '1997-12-20', 'MBBS'),
(281801452, 'Akhil Verma', 6870743678, 'akhilani2@gmail.com', 'Ahmedabad', 'Vraj-vihar so.', 'D102', 380002, 'Priya Verma', 'Child', 'MALE', 'Businessman', '1976-05-07', 'MBA'),
(560810101, 'Bhuvnesh Dewan', 9754675577, 'bhuvdewan10@gmail.com', 'Vadodara', 'Ratnaraj Reside', 'G302', 390000, 'Shivakshi Dewan', 'Relative', 'MALE', 'Student', '2000-02-10', '12 pass'),
(560813344, 'Rishit Patel', 7532736723, 'ptelrishik4@gmail.com', 'Vadodara', 'Vraj-vihar so.', '37', 390000, 'Poonam', 'Parent', 'MALE', 'Student', '2003-07-17', '10 pass'),
(652800103, 'Shreya Shukla', 8922097842, 'srshukla95@gmail.com', 'Gandhinagar', 'ZOLD', 'F402', 382421, 'Rudra', 'Child', 'FEMALE', 'House wife', '1984-06-21', '12 pass'),
(871004430, 'Pranay Acharya', 9714913200, 'apranay2@gmail.com', 'Ahmedabad', 'Vraj-vihar so.', 'G302', 380002, 'Parthiv Acharya', 'Relative', 'MALE', 'Teacher', '1984-06-13', 'MSc'),
(879240233, 'Shikha Shah', 9809876443, 'sshikha00@gmail.com', 'Ahmedabad', 'ZOLD', 'G3', 320008, 'Deepak Shah', 'Spouse', 'FEMALE', 'House wife', '1978-03-07', '12 pass'),
(879248582, 'Saumya Pathak', 9687483983, 'psaumya56@gmail.com', 'Gandhinagar', 'Ratnaraj Reside', 'W504', 382421, 'Shilin Pathak', 'Parent', 'MALE', 'Student', '1990-01-10', '12 pass'),
(879253288, 'ShuklaHemangini', 9408433543, 'hsshukla94@gmail.com', 'Gandhinagar', 'Ratnaraj Reside', 'E103', 382421, 'Shrutva Shukla', 'Child', 'FEMALE', 'Teacher', '1975-02-06', 'PhD in Maths'),
(879261413, 'Rut Khurana', 9532400089, 'rut1703@gmail.com', 'Ahmedabad', 'Vraj-vihar so.', '1', 380002, 'Navya Khurana', 'Relative', 'MALE', 'Student', '1994-03-17', '12 pass'),
(890012654, 'Anurag Agarwal', 8562176231, 'aagarwal00@gmail.com', 'Gandhinagar', 'Ratnaraj Reside', 'C103', 382421, 'Mansi', 'Child', 'MALE', 'Doctor', '1979-11-22', 'MBBS'),
(897600128, 'Surbhahi Khatri', 8363286832, 'khatri.subhahi2@gmail.com', 'Gandhinagar', 'ZOLD', 'E103', 382421, 'Sakshi Khatri', 'Parent', 'FEMALE', 'Student', '1990-06-06', '12 pass');

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
  ADD KEY `agent_ibfk_1` (`Admin_id`);

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
  ADD PRIMARY KEY (`Policy_no`),
  ADD KEY `policy_ibfk_2` (`Agency_code`);

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
