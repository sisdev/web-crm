-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 01, 2018 at 11:39 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crmadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_receipt`
--

DROP TABLE IF EXISTS `tbl_receipt`;
CREATE TABLE IF NOT EXISTS `tbl_receipt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rct_date` date NOT NULL,
  `rct_no` int(6) NOT NULL,
  `reg_no` varchar(10) NOT NULL,
  `amt_receipt` decimal(9,0) NOT NULL,
  `rct_mode` varchar(6) NOT NULL,
  `inst_bank_name` varchar(32) NOT NULL,
  `inst_num` varchar(16) NOT NULL,
  `inst_date` date NOT NULL,
  `narr_txt` varchar(128) NOT NULL,
  `crtd_by` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_receipt`
--

INSERT INTO `tbl_receipt` (`id`, `rct_date`, `rct_no`, `reg_no`, `amt_receipt`, `rct_mode`, `inst_bank_name`, `inst_num`, `inst_date`, `narr_txt`, `crtd_by`) VALUES
(2, '2018-03-30', 20, '1', '2000', 'DD', 'PNB', '11111', '2018-03-30', 'Check1', 'admin'),
(5, '2018-04-01', 23, '2017-04', '3000', 'Cheque', 'PSB', '3333333', '2018-04-01', 'check445435435', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
