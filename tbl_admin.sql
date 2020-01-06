-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 27, 2018 at 01:17 PM
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
-- Database: `sistrng`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `name` varchar(20) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `email` varchar(20) NOT NULL,
  `dtm_created` datetime NOT NULL,
  `role` varchar(16) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_by` varchar(16) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `name`, `phone_no`, `email`, `dtm_created`, `role`, `status`, `created_by`) VALUES
(1, 'admin', 'adm321', 'admin', '0', 'admin@sisoft.in', '0000-00-00 00:00:00', 'admin', 'active', ''),
(2, 'rajnagar', 'raj222', '', '0', '', '0000-00-00 00:00:00', '', '', ''),
(3, 'westdelhi', 'west111', '', '0', '', '0000-00-00 00:00:00', '', '', ''),
(4, 'test', 'test123', 'Test', '9111111111', 'test123@gmail.com', '2018-05-26 14:12:32', 'executive', '', 'admin'),
(5, 'test2', 'test234', 'Test12', '9222222222', 'test1@gmail.com', '2018-05-27 14:22:42', 'manager', 'active', 'admin'),
(6, 'check', 'check1', 'Check', '9333333333', 'check@sisoft.in', '2018-05-27 18:30:32', 'admin', 'active', 'admin'),
(7, 'check1', 'checkq', 'Check2', '9444444444', 'check2@gmail.com', '2018-05-27 18:32:23', 'admin', 'active', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
