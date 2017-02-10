-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2015 at 04:35 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bus_ticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE IF NOT EXISTS `bus` (
  `bus_id` int(11) NOT NULL AUTO_INCREMENT,
  `bus_no` varchar(10) NOT NULL,
  `source` varchar(15) NOT NULL,
  `destination` varchar(15) NOT NULL,
  `total_seat` int(11) NOT NULL,
  `type` varchar(8) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `time` varchar(5) NOT NULL,
  PRIMARY KEY (`bus_id`,`bus_no`),
  UNIQUE KEY `bus_id_UNIQUE` (`bus_id`),
  UNIQUE KEY `bus_no_UNIQUE` (`bus_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`bus_id`, `bus_no`, `source`, `destination`, `total_seat`, `type`, `price`, `time`) VALUES
(1, 'b0001', 'dhaka', 'gaibandha', 52, 'ac', 520.00, '10am');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `description` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dashboard`
--

CREATE TABLE IF NOT EXISTS `dashboard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `bus_no` varchar(10) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `source` varchar(15) NOT NULL,
  `destination` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `pdate` date NOT NULL,
  `seat_name` varchar(10) NOT NULL,
  `taka` decimal(10,2) NOT NULL,
  `num` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`,`user_id`,`bus_no`,`bus_id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_dashboard_registration1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `dashboard`
--

INSERT INTO `dashboard` (`id`, `user_id`, `bus_no`, `bus_id`, `source`, `destination`, `date`, `pdate`, `seat_name`, `taka`, `num`, `status`) VALUES
(5, 1, 'b0001', 1, 'dhaka', 'gaibandha', '2015-06-26', '2015-06-20', 'a1,a2', 1040.00, 2, 'Invalid');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `bphn` varchar(45) NOT NULL,
  `t_no` varchar(45) NOT NULL,
  `taka` int(11) NOT NULL,
  `method` varchar(15) NOT NULL,
  PRIMARY KEY (`pay_id`),
  UNIQUE KEY `id_UNIQUE` (`pay_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`pay_id`, `bphn`, `t_no`, `taka`, `method`) VALUES
(1, '01723506770', '23', 1040, 'bcash');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE IF NOT EXISTS `registration` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `mail` varchar(35) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(45) NOT NULL,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`,`mail`),
  UNIQUE KEY `mail_UNIQUE` (`mail`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`user_id`, `name`, `mail`, `pass`, `phone`, `gender`, `address`, `type`) VALUES
(1, 'shafiur', 's', '03c7c0ace395d80182db07ae2c30f034', 's', 'Male', 's', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `user_id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `pay_id` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL,
  `pdate` date NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`user_id`,`bus_id`,`pay_id`,`seat_id`),
  KEY `fk_reservation_registration_idx` (`user_id`),
  KEY `fk_reservation_bus1_idx` (`bus_id`),
  KEY `fk_reservation_seat1_idx` (`seat_id`),
  KEY `fk_reservation_payment1_idx` (`pay_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE IF NOT EXISTS `seat` (
  `seat_id` int(11) NOT NULL AUTO_INCREMENT,
  `bus_id` int(11) NOT NULL,
  `seat_name` varchar(10) NOT NULL,
  PRIMARY KEY (`seat_id`,`bus_id`),
  UNIQUE KEY `seat_id_UNIQUE` (`seat_id`),
  KEY `fk_seat_bus1_idx` (`bus_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`seat_id`, `bus_id`, `seat_name`) VALUES
(1, 1, 'a1'),
(2, 1, 'b1'),
(3, 1, 'c1'),
(4, 1, 'd1'),
(5, 1, 'a2'),
(6, 1, 'b2'),
(7, 1, 'c2'),
(8, 1, 'd2'),
(9, 1, 'a3'),
(10, 1, 'b3'),
(11, 1, 'c3'),
(12, 1, 'd3'),
(13, 1, 'a4'),
(14, 1, 'b4'),
(15, 1, 'c4'),
(16, 1, 'd4'),
(17, 1, 'a5'),
(18, 1, 'b5'),
(19, 1, 'c5'),
(20, 1, 'd5'),
(21, 1, 'a6'),
(22, 1, 'b6'),
(23, 1, 'c6'),
(24, 1, 'd6');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dashboard`
--
ALTER TABLE `dashboard`
  ADD CONSTRAINT `fk_dashboard_registration1` FOREIGN KEY (`user_id`) REFERENCES `registration` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_reservation_bus1` FOREIGN KEY (`bus_id`) REFERENCES `bus` (`bus_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservation_payment1` FOREIGN KEY (`pay_id`) REFERENCES `payment` (`pay_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservation_registration` FOREIGN KEY (`user_id`) REFERENCES `registration` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservation_seat1` FOREIGN KEY (`seat_id`) REFERENCES `seat` (`seat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `seat`
--
ALTER TABLE `seat`
  ADD CONSTRAINT `fk_seat_bus1` FOREIGN KEY (`bus_id`) REFERENCES `bus` (`bus_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
