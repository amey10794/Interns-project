-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2017 at 10:19 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `interndb`
--

-- --------------------------------------------------------

--
-- Table structure for table `internshipstable`
--

CREATE TABLE `internshipstable` (
  `inid` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `college_company` varchar(50) NOT NULL,
  `starton` varchar(50) NOT NULL,
  `applyby` varchar(50) NOT NULL,
  `dur` varchar(50) NOT NULL,
  `stipend` varchar(50) NOT NULL,
  `details` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `internshipstable`
--

INSERT INTO `internshipstable` (`inid`, `title`, `college_company`, `starton`, `applyby`, `dur`, `stipend`, `details`) VALUES
(1, 'Web Developer Intern', 'ub', '2017-07-05', '2017-06-05', '5', '5000', 'Hello we r proud to announce this internship for you people and please apply for this internship and increase the value of you resume.'),
(2, 'Mobile Developer Intern', 'ub', '2016-09-06', '2016-08-06', '6', '10000', 'Hello apply to our internship and we will give u a good pay'),
(3, 'Business Analyst', 'capgemini', '2017-08-03', '2017-07-05', '10', '20000', 'apply for this internship and gain valuable experience'),
(4, 'Web Developer Intern', 'capgemini', '2018-04-01', '0001-03-01', '1', '1000', 'apply and help yourself'),
(5, 'Detective', '221 Baker Street', '2017-05-17', '2017-04-12', '3', '10000', 'Looking for a new John Watson.Intrested applicants please apply!'),
(6, 'Designer', 'capgemini', '2018-08-02', '2018-06-03', '5', '6000', 'join our company');

-- --------------------------------------------------------

--
-- Table structure for table `memberstable`
--

CREATE TABLE `memberstable` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `internship_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `memberstable`
--

INSERT INTO `memberstable` (`id`, `user_id`, `internship_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 2, 4),
(5, 3, 1),
(6, 3, 2),
(7, 3, 4),
(8, 4, 3),
(9, 4, 2),
(10, 3, 3),
(11, 5, 1),
(12, 5, 4),
(13, 6, 5),
(14, 5, 5),
(15, 2, 6),
(16, 2, 1),
(17, 3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `memtable`
--

CREATE TABLE `memtable` (
  `id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `memtable`
--

INSERT INTO `memtable` (`id`, `type`) VALUES
(1, 'Student'),
(2, 'Employer');

-- --------------------------------------------------------

--
-- Table structure for table `userstable`
--

CREATE TABLE `userstable` (
  `uid` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `college_company` varchar(50) DEFAULT NULL,
  `membership_id` int(11) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userstable`
--

INSERT INTO `userstable` (`uid`, `firstname`, `lastname`, `password`, `email`, `college_company`, `membership_id`, `reg_date`) VALUES
(1, 'Amey', 'Mhaskar', 'mhaskaramey', 'mhaskaramey@gmail.com', 'ub', 2, '2017-05-01 03:00:40'),
(2, 'Mitali', 'Sable', 'misable', 'misable@gmail.com', 'capgemini', 2, '2017-05-01 03:05:44'),
(3, 'Vikas', 'Mishra', 'vk', 'vk@gmail.com', 'sfit', 1, '2017-05-01 03:07:38'),
(4, 'Smit', 'Lo', 'smit', 'smit@gmail.com', 'thadomal', 1, '2017-05-01 03:10:40'),
(5, 'Mitali ', 'S', 'Mits', 'mitali.p.sable@gmail.com', 'SFIT', 1, '2017-05-01 05:48:41'),
(6, 'Sherlock ', 'Holmes', 'SHERLOCKED', 'sherlock@gmail.com', '221 Baker Street', 2, '2017-05-01 06:11:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `internshipstable`
--
ALTER TABLE `internshipstable`
  ADD PRIMARY KEY (`inid`);

--
-- Indexes for table `memberstable`
--
ALTER TABLE `memberstable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `memtable`
--
ALTER TABLE `memtable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userstable`
--
ALTER TABLE `userstable`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `membership_id` (`membership_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `internshipstable`
--
ALTER TABLE `internshipstable`
  MODIFY `inid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `memberstable`
--
ALTER TABLE `memberstable`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `userstable`
--
ALTER TABLE `userstable`
  MODIFY `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `userstable`
--
ALTER TABLE `userstable`
  ADD CONSTRAINT `userstable_ibfk_1` FOREIGN KEY (`membership_id`) REFERENCES `memtable` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
