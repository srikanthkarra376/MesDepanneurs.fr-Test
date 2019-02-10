-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2019 at 02:37 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mesdepanneurs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(255) NOT NULL,
  `name` varchar(60) NOT NULL,
  `zip` int(5) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `zip`, `lat`, `lng`) VALUES
(1, 'Lille', 59000, 50.629250, 3.057256),
(2, 'Lyon', 69001, 45.764042, 4.835659),
(3, 'Toulouse', 31000, 43.604652, 1.444209),
(4, 'Strasbourg', 67000, 48.573406, 7.752111),
(5, 'Rouen', 27000, 49.443233, 1.099971),
(6, 'Evreux', 31000, 49.024540, 1.150940),
(7, 'Rennes', 35000, 48.117268, -1.677793),
(8, 'Nantes', 44000, 47.218372, -1.553621),
(9, 'Bordeaux', 33063, 44.837788, -0.579180),
(10, 'Montpellier', 34000, 43.610767, 3.876716),
(11, 'Toulon', 83000, 43.124229, 5.928000),
(12, 'Le Havre', 76600, 49.492592, 0.106500),
(13, 'Marseille', 13001, 43.296482, 5.369780),
(14, 'Reims', 51100, 49.256599, 4.033090),
(15, 'Grenoble', 38000, 45.188530, 5.724524);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
