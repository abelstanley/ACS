-- phpMyAdmin SQL Dump
-- version 2.11.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 26, 2019 at 02:40 PM
-- Server version: 5.5.18
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `ace`
--
CREATE DATABASE `ace` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ace`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '77');

-- --------------------------------------------------------

--
-- Table structure for table `class_details`
--

CREATE TABLE IF NOT EXISTS `class_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class_name` varchar(45) NOT NULL,
  `date` varchar(45) NOT NULL,
  `venue` varchar(45) NOT NULL,
  `period` varchar(45) NOT NULL,
  `max_num_of_attend` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `class_details`
--

INSERT INTO `class_details` (`id`, `class_name`, `date`, `venue`, `period`, `max_num_of_attend`) VALUES
(5, 'The use of Social Media', '3st july, 2019', '  No. 1 Olowokporoko street, Mafoloku Oshodi ', '7hours ', 156),
(6, 'Confident public Speaking ', 'March 30, 2020', '   Abuja community hall \r\n          \r\n       ', '3hours', 76),
(7, 'Time Management', 'March 30, 2020', '  Alausa ikeja Town Hall\r\n         ', '4hours 20minutes', 765),
(8, 'Steadily Making Money ', 'Monday, The 31st July 2019', ' Ojuri Begger', '3hours', 1);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class_name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class_name`) VALUES
(4, 'The use of Social Media'),
(5, 'Confident public Speaking '),
(7, 'Time Management'),
(8, 'Steadily Making Money ');

-- --------------------------------------------------------

--
-- Table structure for table `registered_staff`
--

CREATE TABLE IF NOT EXISTS `registered_staff` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class_name` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `registered_staff`
--

INSERT INTO `registered_staff` (`id`, `class_name`, `username`) VALUES
(3, 'Time Management', 'abelstanley'),
(4, 'Confident public Speaking ', 'abelstanley'),
(5, 'The use of Social Media', 'abelstanley'),
(6, 'Confident public Speaking ', 'solo'),
(7, 'The use of Social Media', 'solo');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `organization` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `organization`) VALUES
(1, 'abelstanley', '07071977', 'Abel Stanley', 'Republic Media'),
(3, 'solo', '77', 'Solomon Akpa', 'FIRO');
