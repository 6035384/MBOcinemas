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
  `id` INT(10) AUTO_INCREMENT PRIMARY KEY,
  `gebruikersnaam` VARCHAR(255) NOT NULL,
  `wachtwoord` VARCHAR(255) NOT NULL
);


INSERT INTO `gebruikers` (`gebruikersnaam`, `wachtwoord`) VALUES ('admin', PASSWORD('admin123'));

--
-- Dumping data for table `gebruikers`
--

INSERT INTO `gebruikers` (`id`, `gebruikersnaam`, `wachtwoord`) VALUES
(1, 'admin', 'admin');


/* table voor beheerder films */

CREATE TABLE `films` (
  `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `genre` VARCHAR(100) NOT NULL,
  `location` VARCHAR(100) NOT NULL,
  `date` DATE NOT NULL,
  `image` VARCHAR(255) NOT NULL
);