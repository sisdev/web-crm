-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 18, 2018 at 12:49 PM
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
-- Table structure for table `sales_target`
--

DROP TABLE IF EXISTS `sales_target`;
CREATE TABLE IF NOT EXISTS `sales_target` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(4) DEFAULT NULL,
  `fin_year` varchar(6) DEFAULT NULL,
  `area_product` varchar(64) DEFAULT NULL,
  `area_geoname` varchar(64) DEFAULT NULL,
  `area_geo_unit` varchar(64) DEFAULT NULL,
  `target_amt` varchar(10) DEFAULT NULL,
  `target_new_cust` varchar(28) DEFAULT NULL,
  `target_new_lead` varchar(28) DEFAULT NULL,
  `dtm_created` datetime NOT NULL,
  `created_by` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_target`
--

INSERT INTO `sales_target` (`id`, `user_id`, `fin_year`, `area_product`, `area_geoname`, `area_geo_unit`, `target_amt`, `target_new_cust`, `target_new_lead`, `dtm_created`, `created_by`) VALUES
(3, '2', '2019', 'Food', 'Indirapuram', 'State', '100000', '20', '30', '2018-06-01 18:07:39', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
