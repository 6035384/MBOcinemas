-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 26, 2024 at 10:33 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `gebruikers`
--

CREATE TABLE `gebruikers` (
  `id` int(10) NOT NULL,
  `gebruikersnaam` varchar(255) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gebruikers`
--

INSERT INTO `gebruikers` (`id`, `gebruikersnaam`, `wachtwoord`) VALUES
(1, 'admin', 'admin');


--
-- Table structure for table `gebruikers`
--

CREATE TABLE `movies` (
  `id` int(10) NOT NULL,
  `gebruikersnaam` varchar(255) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL
) EN

INSERT INTO `movies` (`id`, `movie_name`) VALUES
(1, 'Deadpool vs Wolverine');
(2, 'The fall guy');
(3, 'Despicable Me 4');
(4, 'The Green Knight');
(5, 'Fight Club');
(6, 'Se7en');
(7, 'Marie Antoinette');
(8, 'Spirited Away');
(9, 'Howls Moving Castle');
(10, 'My Neighbor Totoro');
(11, 'Nausicaa of the Valley of the Wind');
(12, 'the batman');