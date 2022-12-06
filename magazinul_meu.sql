-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1:3306
-- Timp de generare: dec. 06, 2022 la 06:17 PM
-- Versiune server: 5.7.36
-- Versiune PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `magazinul meu`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Eliminarea datelor din tabel `admin`
--

INSERT INTO `admin` (`id`, `FirstName`, `LastName`, `username`, `password`, `email`) VALUES
(2, 'Cristina', 'Florea', 'admin1', '$2y$10$/s98emdSMM7BbaDQM.jW5ue.ImwdIADLHPGqd7YDVo4mYWgbl2xk6', 'admin1@yahoo.ro'),
(3, 'Catalina', 'Frunza', 'admin2', '$2y$10$dVObDPR7SCSonUzDgIu.B.JTVhUDxShj8XZVht4TD./rpTQNQSo1O', 'admin2@yahoo.com');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `comenzi`
--

DROP TABLE IF EXISTS `comenzi`;
CREATE TABLE IF NOT EXISTS `comenzi` (
  `comenzi_id` int(11) NOT NULL AUTO_INCREMENT,
  `produs_id` int(11) NOT NULL,
  `cantitate` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `data_cumparare` datetime NOT NULL,
  `stare_comanda` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`comenzi_id`),
  KEY `produs_id` (`produs_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `cos`
--

DROP TABLE IF EXISTS `cos`;
CREATE TABLE IF NOT EXISTS `cos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `produs_id` int(11) NOT NULL,
  `cantitate` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `produs_id` (`produs_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Eliminarea datelor din tabel `cos`
--

INSERT INTO `cos` (`id`, `customer_id`, `produs_id`, `cantitate`) VALUES
(22, 5, 7, 2),
(24, 5, 9, 2),
(27, 6, 16, 1),
(28, 5, 16, 1),
(29, 7, 20, 1),
(30, 7, 7, 1);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Eliminarea datelor din tabel `customers`
--

INSERT INTO `customers` (`id`, `FirstName`, `LastName`, `username`, `password`, `email`) VALUES
(1, NULL, NULL, 'ion', '$2y$10$wnANzGTwr4C2ctB7h0ewq.PJT4qpkjGmVqqSx1QgdhsJJI4jcmSxq', 'ion@yahoo.com'),
(5, 'Doriana', 'Iancu', 'user1', '$2y$10$pl8lxTX7VtyvpjMiNvywWO1zIy9pnfgBUAfjtZFYVAKcCwGFjoHcS', 'user1@yahoo.com'),
(6, 'Gabriela', 'Tatar', 'user2', '$2y$10$8VjvNEMYpQ210sBKKoEJQOuLeh7msP/Aon24.yYrU047Nc/SkrFhS', 'user2@yahoo.com'),
(7, 'Andreea', 'Popa', 'user3', '$2y$10$P030MBTbdrX32kGkvcl57uCavX6XOhet0uA/ZzoaxGsN5962PEt/K', 'user3@yahoo.ro'),
(8, 'Tudor', 'Popa', 'user4', '$2y$10$hVO5YE52I8C8Ga7LBIOO4ux/F6NpWrYH47oCnO26a4CFy.33zq9G6', 'user4@yahoo.com'),
(9, 'Andrei', 'Apolzan', 'user5', '$2y$10$nlwwGjgPQkB1j0H6afyqI./Bw58KiQW42rgrlQ2AYnaoeWCgApC9a', 'user5@gmail.com'),
(10, 'Diana', 'Dragut', 'user6', '$2y$10$CqQsAyLDxECI53O0hbxF1.1Z6uZlP1Y1pvqobPQhh4yxrU2d7Y81W', 'user6@yahoo.com'),
(11, 'Andrada', 'Oancea', 'user7', '$2y$10$MZBRfl006c0VApBcX.nt/eA6/oBw22yrHG9L7xOb2B2R.lFimWkTu', 'user7@gmail.com'),
(12, 'Larisa', 'Galdau', 'user8', '$2y$10$QsPa.nQA68MZJa74SwNSpOJuKcxEJRXKmwBlYJNUZtIeAHwAkVXqK', 'user8@yahoo.ro'),
(13, 'Alexandru', 'Florea', 'user9', '$2y$10$4gaEUtvtQFvTo6ro67TkaunH688clYYKYh82aqhvbDvFp/VmFg49W', 'user9@yahoo.com');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `tabelproduse`
--

DROP TABLE IF EXISTS `tabelproduse`;
CREATE TABLE IF NOT EXISTS `tabelproduse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nume` varchar(255) NOT NULL,
  `cod` varchar(255) NOT NULL,
  `img` text NOT NULL,
  `pret` double(10,2) NOT NULL,
  `descriere` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `tabelproduse`
--

INSERT INTO `tabelproduse` (`id`, `nume`, `cod`, `img`, `pret`, `descriere`) VALUES
(7, 'Bag Babolat', '532', 'product-images\\img2.png', 699.00, 'TERMOBAG BABOLAT PURE AERO RAFA YELLOW/PURPLE'),
(8, 'Racheta Head', '433tf5', 'product-images/rachetahead.png', 200.00, 'RACHETA DE TENIS HEAD GEO SPEED'),
(9, 'Racheta Yonex', 'bs976m', 'product-images/rachetayonex.png', 745.00, 'RACHETA DE TENIS YONEX VCORE TOUR F97'),
(10, 'Racheta Wilson', '758nj9', 'product-images/rachetawilson.png', 649.00, 'RACHETA DE TENIS WILSON BURN 100LS'),
(11, 'Bag Wilson', '8263j9', 'product-images/bagwilson1.png', 300.00, 'BAG WILSON SUPER TOUR BACKPACK'),
(12, 'Bag Wilson', '4334k9', 'product-images/bagwilson2.png', 480.00, 'BAG WILSON SUPER TOUR 2 '),
(13, 'Bag Yonex', '8272b1', 'product-images/bagyonex.png', 500.00, 'BAG YONEX PRO GREEN/PURPLE (9 RACKETS)'),
(14, 'Bag Head', '331kb1', 'product-images/baghead.png', 129.00, 'BAG HEAD CORE 6R COMBI'),
(15, 'Bag Babolat', '32k91', 'product-images/bagbabolat1.png', 527.00, 'TERMOBAG BABOLAT PURE DRIVE X 12 2021'),
(16, 'Racheta Babolat', '74h430', 'product-images/img1.png', 800.00, 'RACHETA DE TENIS BABOLAT PURE DRIVE 2018'),
(20, 'Racheta Babolat', '6d8dbh', 'product-images/rachetababolat1.png', 1200.00, 'RACHETA DE TENIS BABOLAT  PURE AERO RAFA'),
(21, 'nhjw', 'nsw3d', 'dd', 2.00, 'dd');

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `comenzi`
--
ALTER TABLE `comenzi`
  ADD CONSTRAINT `comenzi_ibfk_1` FOREIGN KEY (`produs_id`) REFERENCES `tabelproduse` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comenzi_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constrângeri pentru tabele `cos`
--
ALTER TABLE `cos`
  ADD CONSTRAINT `cos_ibfk_1` FOREIGN KEY (`produs_id`) REFERENCES `tabelproduse` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cos_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
