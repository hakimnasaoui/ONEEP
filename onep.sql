-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2017 at 05:42 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onep`
--

-- --------------------------------------------------------

--
-- Table structure for table `centres`
--

CREATE TABLE `centres` (
  `N` varchar(255) NOT NULL,
  `CENTRE` varchar(255) NOT NULL,
  `DATE_INSERT` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `centres`
--

INSERT INTO `centres` (`N`, `CENTRE`, `DATE_INSERT`) VALUES
('8S1A79', 'Akhfennir', '2017-06-14 00:17:25'),
('836019', 'Laayoune', '2017-06-14 00:09:23'),
('836029', 'Tarfaya', '2017-06-14 00:09:38'),
('836039', 'Daoura', '2017-06-14 00:09:51'),
('836139', 'Marsa', '2017-06-14 00:10:02'),
('836169', 'TAH', '2017-06-14 00:12:27'),
('8S1A89', 'Tarouma', '2017-06-14 00:47:51'),
('836149', 'Foum el oued', '2017-06-14 00:53:46');

-- --------------------------------------------------------

--
-- Table structure for table `eg`
--

CREATE TABLE `eg` (
  `ID` int(11) NOT NULL,
  `N` int(11) NOT NULL,
  `PRODUITE_HT` decimal(20,6) DEFAULT NULL,
  `FIONEP` decimal(20,0) DEFAULT NULL,
  `VOLUME` bigint(20) DEFAULT NULL,
  `VENTE` decimal(20,6) DEFAULT NULL,
  `SURTAXE` decimal(20,6) DEFAULT NULL,
  `TIMBRE` decimal(20,6) DEFAULT NULL,
  `NET_EG` decimal(20,6) DEFAULT NULL,
  `NET_C_C` decimal(20,6) DEFAULT NULL,
  `NET_GLOBAL` decimal(20,6) DEFAULT NULL,
  `NBR` int(11) DEFAULT NULL,
  `CENTRE` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `MOIS` int(11) NOT NULL,
  `ANNEE` int(11) NOT NULL,
  `EG_TYPE` varchar(255) NOT NULL,
  `DATE_INSERT` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `immeuble`
--

CREATE TABLE `immeuble` (
  `ID` int(11) NOT NULL,
  `N` int(11) NOT NULL,
  `F_BRANCH` decimal(20,6) DEFAULT NULL,
  `FIONEP` decimal(20,6) DEFAULT NULL,
  `F_BRANCHEMENT_TTC` decimal(20,6) DEFAULT NULL,
  `FI_TTC` decimal(20,6) DEFAULT NULL,
  `NET_TTC` decimal(20,6) DEFAULT NULL,
  `NBR` int(11) DEFAULT NULL,
  `MOIS` int(11) NOT NULL,
  `ANNEE` int(11) NOT NULL,
  `CENTRE` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `IMMEUBLE_TYPE` varchar(255) NOT NULL,
  `DATE_INSERT` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `immeuble`
--

INSERT INTO `immeuble` (`ID`, `N`, `F_BRANCH`, `FIONEP`, `F_BRANCHEMENT_TTC`, `FI_TTC`, `NET_TTC`, `NBR`, `MOIS`, `ANNEE`, `CENTRE`, `IMMEUBLE_TYPE`, `DATE_INSERT`) VALUES
(1, 500, NULL, '999.990000', '5000.000000', '5000.500000', '800.500000', 900, 1, 2017, '836139', 'etat', '2017-06-14 16:53:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `DATE_INSERT` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `USERNAME`, `PASSWORD`, `EMAIL`, `DATE_INSERT`) VALUES
(3, 'nmo', '$2y$10$aj7SMEGijw7jL7mu5QSjsO5Jlnz3j1p7tfjG8LUopyFtF/WqpKkGG', 'hakimnasaoui@gmail.com', '2017-06-14 20:12:30'),
(2, 'hakim', '$2y$10$UTC3KgJUb3FyjdX0ONl8WOewD3Te.rS9wNf599L0SBNrOpDbs4W/O', 'hakim@gmail.com', '2017-06-14 19:36:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `centres`
--
ALTER TABLE `centres`
  ADD PRIMARY KEY (`N`);

--
-- Indexes for table `eg`
--
ALTER TABLE `eg`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `immeuble`
--
ALTER TABLE `immeuble`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eg`
--
ALTER TABLE `eg`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `immeuble`
--
ALTER TABLE `immeuble`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
