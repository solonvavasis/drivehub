-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: db21.papaki.gr:3306
-- Generation Time: Feb 28, 2017 at 12:16 AM
-- Server version: 10.1.18-MariaDB
-- PHP Version: 5.6.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `solonvav_drivehub`
--
CREATE DATABASE IF NOT EXISTS `solonvav_drivehub` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `solonvav_drivehub`;

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `ID` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `car_cc` varchar(255) NOT NULL,
  `car_brand` varchar(255) NOT NULL,
  `car_price` varchar(255) NOT NULL,
  `car_description` varchar(255) NOT NULL,
  `car_town` varchar(255) NOT NULL,
  `car_address` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `booking_count` int(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`ID`, `car_id`, `car_cc`, `car_brand`, `car_price`, `car_description`, `car_town`, `car_address`, `image`, `booking_count`) VALUES
(27, 35, '1600', 'seat', '25', 'awesome car', 'Athens', 'Glifada', 'Seat_Altea_front_20090919.jpg', 1),
(28, 36, '1400', 'opel', '25', 'awesome car\r\n', 'Athens', 'Sintagma', 'opel-06.jpg', 2),
(29, 37, '1200', 'Seat', '30', 'This is a seat', 'Athens', 'Glifada', 'seat_ibiza_1_6_tdi_cr_105_hp_dpf_style_large_30008.jpg', 8),
(30, 38, '1400', 'mercedes', '30', 'awesome car', 'Athens', 'Peristeri', 'mercedes.jpg', 13),
(31, 39, '1800', 'BMW', '40', 'awesome car', 'Athens', 'Koropi', '2015bmwm235i-012.jpg', 0),
(32, 40, '1800', 'BMW', '45', 'awesome car', 'Athens', 'Xalandri', 'bmw.JPG', 1),
(33, 41, '1800', 'bmw', '45', 'awesome car', 'Athens', 'Marousi', 'bmw_awesome.JPG', 0),
(34, 42, '1600', 'fiat', '50', 'not an awesome car', 'Athens', 'Piraias', 'Fiat_Idea_front_20071102.jpg', 0),
(35, 44, '1600', 'mercendes', '80', 'Toumpano autokinito', 'Athens', 'Xalandri', '00-Mercedes-Benz-Vehicles-C-Class-C-63-Coupe-AMG-1180x559.jpg', 1),
(36, 45, '1600', 'Opel', '40', 'Awesome car', 'Athens', 'Kifisia', 'Seat_Altea_front_20090919.jpg', 0),
(37, 47, '2000', 'VOLVO', '90', 'This is a Volvo', 'Xania', 'Xania', '2015-volvo-s60-polestar-fd.jpg', 0),
(38, 48, '1600', 'Audi', '65', 'This is an Audi', 'Xania', 'Xania', 'Audi-RS7-Sportback_2758091b.jpg', 0),
(39, 50, '1400`', 'unknown', '30', 'awesome car\r\n', 'Athens', 'Agios Stefanos', 'Fiat_Seicento_front_20080127.jpg', 2),
(40, 55, '1234', 'Toyota', '12', 'This is a toyota', 'Athens', 'Agios Stefanos', '2015_toyota_camry_sedan_xle_fq_oem_3_717.jpg', 0),
(41, 56, '1234', 'Awesome', '23', 'Awesome', 'Lamia', 'Lamia', '8224973Lancia_Delta_III_20090620_front.JPG', 0),
(42, 58, '1400', 'Awesome', '23', 'Awesome car', 'Korinthos', 'Korinthos', 'fiat500.jpg', 0),
(43, 59, '1444', 'awesome', '23', 'awesome', 'Korinthos', 'Korinthos', 'Lancia_Hyena_CENTENARY.jpg', 0),
(44, 60, '1500', 'Audi', '35', 'Audi 80 turbo', 'Volos', 'Volos', 'audi.png', 0),
(45, 31, '999', 'Toyoda', '99', 'The best car that uses the force to increase horsepower from 50 to 100', 'Sparti', 'Sparti', '81Z4x5+Ay7L._SL1500_.jpg', 0),
(46, 65, '1200', 'Audi', '50', 'Great car', 'Korinthos', 'Korinthos', 'buyers_guide_-_audi_a5_cabrio_2014_-_front_quarter.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `location_town` varchar(255) NOT NULL,
  `location_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `location_town`, `location_address`) VALUES
(1, 'Athens', 'Glifada'),
(2, 'Athens', 'Sintagma'),
(3, 'Athens', 'Peristeri'),
(4, 'Athens', 'Koropi'),
(5, 'Athens', 'Xalandri'),
(6, 'Athens', 'Marousi'),
(7, 'Athens', 'Piraias'),
(8, 'Athens', 'Kifisia'),
(9, 'Athens', 'Agios Stefanos'),
(10, 'Lamia', 'Lamia'),
(11, 'Korinthos', 'Korinthos'),
(12, 'Thiva', 'Thiva'),
(13, 'Volos', 'Volos'),
(14, 'Karditsa', 'Karditsa'),
(15, 'Trikala', 'Trikala'),
(16, 'Larisa', 'Larisa'),
(17, 'Ioannina', 'Ioannina'),
(18, 'Arta', 'Arta'),
(19, 'Kastoria', 'Kastoria'),
(20, 'Thessaloniki', 'Leukos Pyrgos'),
(21, 'Thessaloniki', 'Toumpa'),
(22, 'Thessaloniki', 'Valaori'),
(23, 'Kavala', 'Kavala'),
(24, 'Alexandroupoli', 'Alexandroupoli'),
(25, 'Agrinio', 'Agrinio'),
(26, 'Tripoli', 'Tripoli'),
(27, 'Kalamata', 'Kalamata'),
(28, 'Pirgos', 'Pirgos'),
(29, 'Sparti', 'Sparti'),
(30, 'Xania', 'Xania'),
(31, 'Rethimno', 'test address 31'),
(32, 'Hrakleio', 'test address 32');

-- --------------------------------------------------------

--
-- Table structure for table `testdate`
--

CREATE TABLE `testdate` (
  `ID` int(11) NOT NULL,
  `date_id` int(11) NOT NULL,
  `blocked_dates` date NOT NULL,
  `is_owner` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `testdate`
--

INSERT INTO `testdate` (`ID`, `date_id`, `blocked_dates`, `is_owner`) VALUES
(178, 36, '2016-03-15', 0),
(179, 36, '2016-03-16', 0),
(180, 36, '2016-03-17', 0),
(181, 36, '2016-03-18', 0),
(182, 36, '2016-03-19', 0),
(183, 44, '2016-03-18', 1),
(184, 44, '2016-03-19', 1),
(185, 37, '2016-03-16', 1),
(186, 37, '2016-03-17', 1),
(187, 44, '2016-03-21', 0),
(188, 44, '2016-03-22', 0),
(189, 40, '2016-03-17', 0),
(190, 40, '2016-03-18', 0),
(191, 40, '2016-03-19', 0),
(192, 40, '2016-03-20', 0),
(193, 40, '2016-03-21', 0),
(194, 40, '2016-03-22', 0),
(195, 40, '2016-03-23', 0),
(196, 40, '2016-03-24', 0),
(197, 38, '2016-03-17', 0),
(198, 38, '2016-03-18', 0),
(199, 38, '2016-03-19', 0),
(200, 38, '2016-03-20', 0),
(201, 38, '2016-03-21', 0),
(202, 38, '2016-03-22', 0),
(203, 38, '2016-03-23', 0),
(204, 38, '2016-03-24', 0),
(205, 38, '2016-03-25', 0),
(206, 38, '2016-03-26', 0),
(207, 38, '2016-03-27', 0),
(208, 38, '2016-03-28', 0),
(209, 38, '2016-03-29', 0),
(210, 38, '2016-03-30', 0),
(211, 38, '2016-03-31', 0),
(212, 50, '2016-03-22', 0),
(213, 50, '2016-03-23', 0),
(214, 38, '2016-04-06', 0),
(215, 38, '2016-04-07', 0),
(216, 38, '1970-01-01', 0),
(217, 38, '2016-04-13', 0),
(218, 38, '2016-04-14', 0),
(219, 38, '2016-04-15', 0),
(220, 38, '2016-04-16', 0),
(221, 38, '2016-04-17', 0),
(222, 38, '2016-04-18', 0),
(223, 38, '2016-04-19', 0),
(224, 38, '2016-04-20', 0),
(225, 38, '2016-04-21', 0),
(226, 38, '2016-04-22', 0),
(227, 59, '2016-04-01', 1),
(228, 59, '2016-04-02', 1),
(229, 38, '2016-04-29', 0),
(230, 38, '2016-04-30', 0),
(240, 37, '2016-04-06', 0),
(241, 37, '2016-04-07', 0),
(242, 37, '2016-04-08', 0),
(243, 37, '2016-04-09', 0),
(260, 31, '2016-04-07', 1),
(261, 31, '2016-04-08', 1),
(262, 31, '2016-04-09', 1),
(263, 31, '2016-04-10', 1),
(264, 31, '2016-04-11', 1),
(265, 31, '2016-04-12', 1),
(266, 31, '2016-04-13', 1),
(267, 31, '2016-04-14', 1),
(268, 31, '2016-04-15', 1),
(269, 31, '2016-04-16', 1),
(270, 37, '2016-04-19', 0),
(271, 37, '2016-04-20', 0),
(272, 37, '2016-04-21', 0),
(273, 37, '2016-04-22', 0),
(274, 37, '2016-04-25', 0),
(275, 37, '2016-04-26', 0),
(276, 37, '2016-04-27', 0),
(277, 37, '2016-05-10', 0),
(278, 37, '2016-05-11', 0),
(279, 37, '2016-05-12', 0),
(280, 37, '2016-05-18', 0),
(281, 37, '2016-05-19', 0),
(282, 37, '2016-05-20', 0),
(283, 37, '2016-05-21', 0),
(284, 37, '2016-06-01', 0),
(285, 37, '2016-06-02', 0),
(286, 37, '2016-06-03', 0),
(287, 37, '2016-06-04', 0),
(288, 38, '2016-04-24', 0),
(289, 38, '2016-04-25', 0),
(290, 38, '2016-04-26', 0),
(291, 38, '2016-04-27', 0),
(292, 38, '2016-04-28', 0),
(293, 35, '2016-04-26', 0),
(294, 35, '2016-04-27', 0),
(295, 35, '2016-04-28', 0),
(296, 35, '2016-04-29', 0),
(297, 37, '2016-09-28', 0),
(298, 37, '2016-09-29', 0),
(299, 37, '2016-09-30', 0),
(300, 37, '2016-12-14', 1),
(301, 37, '2016-12-15', 1),
(302, 37, '2016-12-16', 1),
(303, 37, '2016-12-17', 1),
(304, 37, '2016-12-18', 0),
(305, 37, '2016-12-19', 0),
(306, 37, '2016-12-20', 0),
(307, 38, '2017-02-07', 0),
(308, 38, '2017-02-08', 0),
(309, 38, '2017-02-09', 0),
(310, 38, '2017-02-10', 0),
(311, 38, '2017-02-11', 0),
(312, 38, '2017-02-12', 0),
(313, 38, '2017-02-13', 0),
(314, 65, '2017-02-27', 0),
(315, 65, '2017-02-28', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `user_lvl` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `password`, `email`, `phone`, `address`, `status`, `user_lvl`, `image`) VALUES
(31, 'aioannidis', 'Apostolos', 'Ioannidis', '$2y$10$lKs/DpV.b6B2yxBjBh/CP.mqfpAWsQhm/KX1A8iK1uJrk1uQ7suHa', 'a.ioannidis@sae.edu', 2103217661, 'Korai 2 Moschato', 1460017820, 'full', '81Z4x5+Ay7L._SL1500_.jpg'),
(35, 'john', 'john', 'john', '$2y$10$p81h.CRqI.HGgkUE8e7Wgea3oM6XT0APAoyW0vK2KlccJnjvi.Q1q', 'john@gmail.com', 2147483647, 'john 32', 1457808704, 'full', 'Seat_Altea_front_20090919.jpg'),
(36, 'johnny', 'johnny', 'johnny', '$2y$10$Ayqj8TJoXn.g3fVJVb.t1uf500t5v.t1dYTTqAx0tMpEAt6Uxh.yq', 'johnny@gmail.com', 473259823, 'johnny 23', 1457810734, 'full', 'mercedes.jpg'),
(37, 'solon', 'solon', 'vavasis', '$2y$10$1fIhkW7wm1bn.cA9JYA.CO4XfyGq45BapyN8MinhXcU6CSBBhMpWy', 'vavasol1987@gmail.com', 123456, 'Agias Triados 9', 1481595893, 'full', 'seat_ibiza_1_6_tdi_cr_105_hp_dpf_style_large_30008.jpg'),
(38, 'kostas', 'kostas', 'kostas', '$2y$10$/FvfrNg/lLyEIebgraXN0.sQImVepeYzQc.JHrpxO5OuWKp1VxR1i', 'kostas@gmail.com', 2147483647, 'kostas 35', 1457810247, 'full', 'mercedes.jpg'),
(39, 'lakis', 'lakis', 'lakis', '$2y$10$fKt2WLe2dNhaLprlf37ExeOQa0SQelkds2GQ9Aiv6co3ITi.8IVBG', 'lakis@gmail.com', 2147483647, 'lakis 67', 1457810864, 'full', '2015bmwm235i-012.jpg'),
(40, 'loulis', 'loulis', 'loulis', '$2y$10$ko1QzwaqsxEs.M.vrr2TS.vEIT8qio7VJ2UM/F18bwTTLGPA3mt5q', 'loulis@gmail.com', 23525245, 'loulis 23', 1457810970, 'full', 'bmw.JPG'),
(41, 'kosths', 'kosths', 'kosths', '$2y$10$IjJVaeh3UmlYccOAvbRnZeGjur5jM1S.QaJFIl8.a533QGcdVN9Qm', 'kosths@gmail.com', 234324324, 'kosths 34', 1457811240, 'full', 'bmw_awesome.JPG'),
(42, 'solonas', 'solonas', 'solonas', '$2y$10$HSlt8cG0eFwocmloZP1uSeXMLg0.0gAknFbdTqNUlQCW7OS2.4jtO', 'solonas@gmail.com', 2147483647, 'solonas 69', 1458059287, 'full', 'Fiat_Idea_front_20071102.jpg'),
(43, 'akis', 'akis', 'akis', '$2y$10$ah4XMSyXZPSjRRkMs/C2o.AXSoItlQ1LJNtQ95.gr8bJjicG0TPYO', 'akis@gmail.com', 343423432, 'akis 29', 1457812195, 'simple', 'opel_astra.JPG'),
(44, 'xakaitetoia', 'anastasios', 'dados', '$2y$10$aULpg1yKzZSPhilbs0Mbu.gMmuRRiogQ296JnZL.rc6yiyVU3LqFi', 'tdados@hotmail.com', 2101234092, 'attikhs 1', 1457882601, 'full', '00-Mercedes-Benz-Vehicles-C-Class-C-63-Coupe-AMG-1180x559.jpg'),
(45, 'teo', 'teo', 'teo', '$2y$10$j2qjKrEZOHYGSf.ah/7JnurcIE0xtWT5.RfHadQZP6fU.b2jdKxC6', 'teo@gmail.com', 2147483647, 'teo 34', 1458059314, 'full', 'Seat_Altea_front_20090919.jpg'),
(46, 'mastro', 'mastro', 'mastro', '$2y$10$3K/B5rjNZzBH3cotdlTd4ufZWrerZvVm7kQZJTnUQVFAa7xjvL1n2', 'mastro@gmail.com', 45098458, 'mastro 54', 1458060312, 'simple', ''),
(47, 'testuser1', 'Giwrgos', 'Georgiou', '$2y$10$wH1hd7//NxX3Z0t2lkSssuPPVl.gQkauggB3g/P43ffV07Psx1pN.', 'testuser1@mail.com', 2147483647, 'Random Address 1', 1458169825, 'full', '2015-volvo-s60-polestar-fd.jpg'),
(48, 'testuser2', 'Panos', 'Panopoulos', '$2y$10$Pe4YmCWke9wGIVw6SzNaPeXxkDRU2uFfYJ67Mf7S2N6iyfQjHr4fG', 'testuser2@mail.com', 2147483647, 'Random Address 2', 1458170340, 'full', 'Audi-RS7-Sportback_2758091b.jpg'),
(49, 'maestros', 'maestros', 'maestros', '$2y$10$Z/.Xyou954ciRKfu1fcDF.pMI4fVZEM2hCBE2IeQp1.uX6U3aSnJe', 'maestros@gmail.com', 3423423, 'maestros 43', 1458243538, 'simple', ''),
(50, 'makis', 'makis', 'makis', '$2y$10$B/3XHXnFzODifqglUH436.mo1hHC5IPWbVLQPmdAiRriz/nXAFntG', 'makis@gmail.com', 2147483647, 'makis 43', 1458240944, 'full', 'Fiat_Seicento_front_20080127.jpg'),
(51, 'nikos', 'nikos', 'nikos', '$2y$10$e3orICm2/hiZ982m8BkfAelseJKg7rS1B0HCtMHnukWAm5CX8pMLS', 'nikos.kal@outlook.com', 2147483647, 'filadelfeias 9', 1458242231, 'simple', ''),
(52, 'ÎžÎ‘ÎÎ˜ÎŸÎ¥Î›Î‘', 'ÎžÎ‘ÎÎ˜ÎŸÎ¥Î›Î‘', 'ÎœÎ‘ÎÎ”Î‘Î›Î™Î‘', '$2y$10$8nUUcqGVIBXwg8WvstBO0OfU9eL.fw1nB2Man8DskRL2wYKmtUnRK', 'xanth_mand@hotmail.com', 2147483647, 'ATHENS', 1458243790, 'simple', ''),
(53, 'Adamantia', 'Adamantia', 'Petropoulou', '$2y$10$t9ZRHFDcUgfuOLsQnpfDDOcCva91xzL7kegb6ySgHbb7fmT.yX8Xm', 'adamadia77@outlook.com', 2147483647, 'Kudwniwn 24', 1458245479, 'simple', ''),
(54, 'testioannidis', 'Test', 'Testidis', '$2y$10$hFyOWU1LrCQi3CHCFaHQeuo/4zuFD7J6iIxM59NMUXfiX8/hDFsoW', 'apo@web4u.gr', 2147483647, 'Korai 2 Moschato', 1458575322, 'simple', ''),
(55, 'newtestuser34', 'newtestuser34', 'newtestuser34', '$2y$10$L8PHe1Wmvgd5I7rLIr.IuuWCYgXh7IsP6ZkIqBwXXesB4G9OFG7t.', 'newtestuser34@mail.com', 2147483647, 'newtestuser34 123', 1458757317, 'full', '2015_toyota_camry_sedan_xle_fq_oem_3_717.jpg'),
(56, 'Nick', 'Nick', 'Nick', '$2y$10$k.KwEUHUlPNt4lf/c2DdWedQ1Yvrdv78PCHYXZ871dInKZKgUtHEu', 'Nick@gmail.com', 32434324, 'Nick 43', 1459035647, 'full', '8224973Lancia_Delta_III_20090620_front.JPG'),
(57, 'JJ', 'JJ', 'JJ', '$2y$10$qD2G28ViESb/5pWsngp5sen2D/bsADoQqtc6hVmba9ID5ExC1DfKe', 'JJ@gmail.com', 23423423, 'JJ 43', 1459039623, 'simple', ''),
(58, 'lou', 'lou', 'lou', '$2y$10$icM3jHqkO2PDCWTbqCqI4.A1zogSYTNIhkxqHpvn/3NubUOMwmy/m', 'lou@gmail.com', 34343432, 'lou 43', 1459100843, 'full', 'fiat500.jpg'),
(59, 'zizou', 'zizou', 'zizou', '$2y$10$t0loW4kdxwAKunRFeJjZlu7IQumThbXugN2ijM7ml0rBBA5D3/4XK', 'zizou@gmail.com', 2147483647, 'zizou 43', 1459103196, 'full', 'Lancia_Hyena_CENTENARY.jpg'),
(60, 'Stava', 'Stavros', 'Vavasis', '$2y$10$lrvrrWm001FD6wQ.kLgpu.ULmuSvBC4CIv9S1RGnrIOrLB5PdpSU2', 'stavros.vavasis@gmail.com', 2147483647, '52 witham house', 1459369589, 'full', 'audi.png'),
(61, 'solon2', 'solon2', 'solon2', '$2y$10$cUKtjIW4MY.JXo8zOz3BUeAUPjbBoDm7lkv04xgdsdQttR0da5H0y', 'vavasol1987@gmail.com', 2147483647, 'otinanai', 1460132991, 'simple', ''),
(62, 'mc', 'mc', 'mc', '$2y$10$ADmV/6OhAQFl7DPXb/VggeyB4NHDtADTVPAQSCpo0eKMHJM.7veDu', 'mc@gmail.com', 2147483647, 'mc 33', 1460136758, 'simple', ''),
(63, 'pac', 'pac', 'pac', '$2y$10$pshdiAofbiNuA.AzQo68eeBqKyduGQWUlpELXD9iENe9k/Lnw0h7K', 'pac@gmail.com', 2147483647, 'pac 33', 1460137081, 'simple', ''),
(64, 'stavacore', 'stava', 'core', '$2y$10$6eHNJtu774wHAjqcRmLcVetMK/UPpqgofJQC196I.ykZmLULtuSJy', 'stavros.vavasis@axsmarine.com', 2147483647, 'Kapou sthn Agglia', 1475089019, 'simple', ''),
(65, 'solonnew', 'solonnew', 'vavasisnew', '$2y$10$Q1m/fI7/Fd3KnHm5QaIPTOk0SASfvDLOQfufc6QTEWl7H32ZwoMDK', 'solon.vavasis@gmail.com', 2109875467, 'Somewhere', 1480355223, 'full', 'buyers_guide_-_audi_a5_cabrio_2014_-_front_quarter.jpg'),
(66, '11test', 'testman', 'testmanâ‚23', '$2y$10$2k75b60yuJ0YyK1QNrdayevX9iizdlmfzoj0prHELXaMQ3fKz1NDG', 'info@firmavabaks.ee', 2147483647, 'asfasf', 1486385530, 'simple', ''),
(67, 'martentesting', 'marten', 'testing', '$2y$10$JUOH39g95heEqrLKry7aS.lX9.fpCw8KpaavmZB00GQDgZvjnNZ0C', 'marten@closet.ee', 123456789, 'testing', 1488208853, 'simple', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `drops`
--
ALTER TABLE `drops`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `testdate`
--
ALTER TABLE `testdate`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `drops`
--
ALTER TABLE `drops`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `testdate`
--
ALTER TABLE `testdate`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=316;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
