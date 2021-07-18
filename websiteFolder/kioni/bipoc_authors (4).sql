-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 18, 2021 at 09:10 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bipoc_authors`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`username`, `password`, `email`) VALUES
('blobFish', '*DABCF719388B72AD432DE5E88423B56D652DD8B0', 'blahblah@gmail.com'),
('booksAreFun', '*AEA95368E4FA683969A8CBFF8350F7BB21F2DF79', 'anotherEmail@gmail.com'),
('caliPalms', '*DBA0BA04339FF495FA1D4896AFAE763CF3E0B160', 'sunnyBeaches@gmail.com'),
('fffff', '*CC67043C7BCFF5EEA5566BD9B1F3C74FD9A5CF5D', 'frr'),
('ggfgfgg', '*CC67043C7BCFF5EEA5566BD9B1F3C74FD9A5CF5D', 'gf'),
('kicks37', '*2DB10E7AF321F18C2984FF8E1B4FF05BF9F3927D', 'someone@plu.edu'),
('kioni14', '*CC67043C7BCFF5EEA5566BD9B1F3C74FD9A5CF5D', 'hhhh'),
('peaceMaker2000', '*88F1533AF33E25120C7FB57FCEE7E7C4B1C0F986', 'peaceTea123@plu.edu'),
('pizza', '*33844D7F2FCD6B3FBE9D8693D41F061D55A1E1D2', 'fff'),
('studentweb', '*966722CC7AF763396E0AB286EE6B44158589851A', 'y'),
('vickaykikay', '*CC67043C7BCFF5EEA5566BD9B1F3C74FD9A5CF5D', 'vickay@plu.edu');

-- --------------------------------------------------------

--
-- Table structure for table `books_authors`
--

CREATE TABLE `books_authors` (
  `AuthLast` varchar(30) NOT NULL,
  `AuthFirst` varchar(30) NOT NULL,
  `BookTitle` varchar(40) NOT NULL,
  `Year` int(4) NOT NULL,
  `Genre` varchar(20) NOT NULL,
  `Theme` varchar(20) NOT NULL,
  `AuthIdent` varchar(15) NOT NULL,
  `Length` varchar(15) NOT NULL,
  `ISBN` double NOT NULL,
  `Approval` decimal(6,0) DEFAULT NULL,
  `bookcover` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books_authors`
--

INSERT INTO `books_authors` (`AuthLast`, `AuthFirst`, `BookTitle`, `Year`, `Genre`, `Theme`, `AuthIdent`, `Length`, `ISBN`, `Approval`, `bookcover`, `description`) VALUES
('Halpert', 'Jim', 'The Office Two', 2006, 'Thriller', 'Women', 'LGBTQ+', 'Poem', 1234567891011, '0', 'the-office.png', 'The first season is a mid-season replacement and did not include a full set of episodes. The season had six episodes that began airing from March 24, 2005 to April 26, 2005. The premiere episode was written near word for word from the first episode of the British series, though names and cultural references were changed and some small extra scenes were added.'),
('Beez', 'Pam', 'The Office', 2005, 'Romance', 'BIPOC', 'Woman', 'Novel', 1234567954432, '100', 'TheOffice2.jpg', 'The second season of the American situation comedy television series, The Office, premiered in the United States on NBC on September 20, 2005, and ended on May 11, 2006. The season had 22 episodes, including its first 40-minute \"super-sized\" episode');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `user2` varchar(20) NOT NULL,
  `isbn2` double NOT NULL,
  `rating` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`user2`, `isbn2`, `rating`) VALUES
('kioni14', 1234567891011, 'dislike'),
('kioni14', 1234567954432, 'like'),
('studentweb', 1234567954432, 'like'),
('studentweb', 1234567891011, 'dislike');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `books_authors`
--
ALTER TABLE `books_authors`
  ADD PRIMARY KEY (`ISBN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
