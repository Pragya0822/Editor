-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 14, 2020 at 10:35 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `editor`
--

-- --------------------------------------------------------

--
-- Table structure for table `docs`
--

DROP TABLE IF EXISTS `docs`;
CREATE TABLE IF NOT EXISTS `docs` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `userid` varchar(10000) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `docs`
--

INSERT INTO `docs` (`id`, `content`, `userid`, `created`, `updated`) VALUES
(1, '&lt;p&gt;pragyasjdhsjdhs&lt;/p&gt;\r\n', '1', '2020-06-13 13:39:35', '2020-06-13 13:39:35'),
(2, '&lt;p&gt;hello4&lt;/p&gt;\r\n', '8,7,64,4,4,34,35,5,6,56', '2020-06-14 13:14:13', '2020-06-14 13:14:13'),
(4, '&lt;p&gt;sjhjsdhs&lt;/p&gt;\r\n', '6,8,7,64,4,4,34,35,5,6,56', '2020-06-14 13:42:24', '2020-06-14 13:42:24'),
(5, '&lt;p&gt;amit&lt;/p&gt;\r\n', '6', '2020-06-14 13:43:31', '2020-06-14 13:43:31'),
(6, '&lt;p&gt;Prasvhsdhua&lt;/p&gt;\r\n', '6', '2020-06-14 15:33:14', '2020-06-14 15:33:14'),
(7, '&lt;p&gt;hii&amp;nbsp;&lt;/p&gt;\r\n', '10', '2020-06-14 15:33:48', '2020-06-14 15:33:48'),
(8, '&lt;p&gt;njcnsdjkfn&lt;/p&gt;\r\n', '10', '2020-06-14 15:35:39', '2020-06-14 15:35:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Status` int(1) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Name`, `Email`, `Status`, `Password`, `Created`) VALUES
(8, 'Pranav', 'pranav@gmail.com', 1, 'd82d678e9583c1f5f283ec56fbf1abb7', '2020-06-14 14:01:22'),
(7, 'Pragya Yadav', 'pragya@gmail.com', 1, '827ccb0eea8a706c4c34a16891f84e7b', '2020-06-14 14:00:57'),
(6, 'Abc', 'abc@gmail.com', 1, '81dc9bdb52d04dc20036dbd8313ed055', '2020-06-13 17:00:22'),
(9, 'harry', 'harry@gmail.com', 1, '3b87c97d15e8eb11e51aa25e9a5770e9', '2020-06-14 14:01:44'),
(10, 'tom', 'tom@gmail.com', 1, '34b7da764b21d298ef307d04d8152dc5', '2020-06-14 14:02:13'),
(11, 'Dogo', 'dogo@gmail.com', 1, '052fff45106a237c8dea883ac6726bd5', '2020-06-14 14:02:38'),
(12, 'jerry', 'jerry@gmail.com', 1, '30035607ee5bb378c71ab434a6d05410', '2020-06-14 14:03:24'),
(13, 'ram', 'ram@gmail.com', 1, '4641999a7679fcaef2df0e26d11e3c72', '2020-06-14 14:03:46');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
