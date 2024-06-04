-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2024 at 01:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uniclicks`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(3, 'Admin', '$2y$10$GOsWDA4FMBk8kYQNaizLiummvELJ5LVbpEfrgh1jNsNmdcsQnIzxS');

-- --------------------------------------------------------

--
-- Table structure for table `contact_users`
--

CREATE TABLE `contact_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `communication_type` varchar(255) DEFAULT NULL,
  `communication_id` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `counter` int(11) DEFAULT 2,
  `prize_one_won` varchar(255) DEFAULT NULL,
  `prize_two_won` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_users`
--

INSERT INTO `contact_users` (`id`, `name`, `company`, `communication_type`, `communication_id`, `message`, `status`, `counter`, `prize_one_won`, `prize_two_won`) VALUES
(96, 'chebon', 'Berea', 'Email', 'kelvinchebon90@gmail.com', 'Hi, I\'m Chebon and I would like we work together, I have seen your offers and they are really good.', 1, 2, 'King Access', NULL),
(97, 'Railway Gravel Change', 'Berea', 'Skype', 'kelvinchebon90@gmail.com', 'Hi, I\'m Chebon and I would like we work together, I have seen your offers and they are really good.', 0, 2, '40% Work', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `location`, `start_date`, `end_date`, `thumbnail`) VALUES
(6, 'Hackathon', 'Nairobi', '2024-04-25 00:00:00', '2024-04-25 00:00:00', '662cb9f41097e_headway-NWmcp5fE_4M-unsplash.jpg'),
(7, 'Food Conference', 'Qatar', '2024-04-25 00:00:00', '2024-04-25 00:00:00', '662cba2572da6_teemu-paananen-bzdhc5b3Bxs-unsplash.jpg'),
(8, 'SubmitX', 'Dubai', '2024-04-25 00:00:00', '2024-04-25 00:00:00', '662cba4a5b5d4_SIGMA.png'),
(9, 'Training Tech', 'Dubai', '2024-05-01 00:00:00', '2024-05-03 00:00:00', '662cba7a60ec0_the-climate-reality-project-Hb6uWq0i4MI-unsplash.jpg'),
(10, 'NazX', 'New York', '2024-04-30 00:00:00', '2024-05-10 00:00:00', '662cbab28ce0b_andrea-mininni-VLlkOJdzLG0-unsplash.jpg'),
(11, 'Travel', 'Manchester', '2024-05-03 00:00:00', '2024-05-11 00:00:00', '662cbad64fa03_headway-F2KRf_QfCqw-unsplash.jpg'),
(12, 'SIGMA x Affiliate World', 'Dubai', '2024-07-16 00:00:00', '2024-09-18 00:00:00', '6644040f2af71_AFFILIATE-WORLD-DUBAI.png'),
(13, 'TT Meet Up', 'Dubai, UAE', '2024-08-15 00:00:00', '2024-08-15 00:00:00', '6644044355888_TT-MEETUP.png'),
(14, 'Affiliating', 'Dubai', '2024-07-15 00:00:00', '2024-07-15 00:00:00', '66440467e8ce0_SIGMA.png');

-- --------------------------------------------------------

--
-- Table structure for table `non_users`
--

CREATE TABLE `non_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `prize_id` int(11) DEFAULT NULL,
  `counter` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spin_prizes`
--

CREATE TABLE `spin_prizes` (
  `spin_prizesID` int(11) NOT NULL,
  `spin_prizesTitle` varchar(255) NOT NULL,
  `Probability` int(11) NOT NULL,
  `BackgroundColor` varchar(20) NOT NULL,
  `TextColor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spin_prizes`
--

INSERT INTO `spin_prizes` (`spin_prizesID`, `spin_prizesTitle`, `Probability`, `BackgroundColor`, `TextColor`) VALUES
(8, '50% Discount', 10, '#269D70', '#ffffff'),
(9, '0% Discount', 70, '#ffffff', '#269D70'),
(10, '10% Discount', 20, '#269D70', '#ffffff'),
(11, '0% Discount', 70, '#ffffff', '#269D70'),
(20, 'Free talk', 10, '#269D70', '#ffffff'),
(21, '0% Discount', 70, '#ffffff', '#269D70'),
(22, '40% Work', 10, '#269D70', '#ffffff'),
(23, 'King Access', 20, '#ffffff', '#269D70');

-- --------------------------------------------------------

--
-- Table structure for table `top_offers`
--

CREATE TABLE `top_offers` (
  `id` int(11) NOT NULL,
  `offer` varchar(255) DEFAULT NULL,
  `monthly_clicks` int(11) DEFAULT NULL,
  `monthly_payouts` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `top_offers`
--

INSERT INTO `top_offers` (`id`, `offer`, `monthly_clicks`, `monthly_payouts`) VALUES
(1, 'Financial Lead Gen US', 3150, 21440),
(2, 'Casino DACH', 2320, 29400),
(3, 'Casino CA', 380, 19800),
(4, 'Sweepstakes US', 11235, 25750),
(6, 'Nutra US', 3990, 12300),
(27, 'ido', 3990, 12300);

-- --------------------------------------------------------

--
-- Table structure for table `winners`
--

CREATE TABLE `winners` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `prize` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_users`
--
ALTER TABLE `contact_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `non_users`
--
ALTER TABLE `non_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prize_id` (`prize_id`);

--
-- Indexes for table `spin_prizes`
--
ALTER TABLE `spin_prizes`
  ADD PRIMARY KEY (`spin_prizesID`);

--
-- Indexes for table `top_offers`
--
ALTER TABLE `top_offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `winners`
--
ALTER TABLE `winners`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_users`
--
ALTER TABLE `contact_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `non_users`
--
ALTER TABLE `non_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spin_prizes`
--
ALTER TABLE `spin_prizes`
  MODIFY `spin_prizesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `top_offers`
--
ALTER TABLE `top_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `winners`
--
ALTER TABLE `winners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `non_users`
--
ALTER TABLE `non_users`
  ADD CONSTRAINT `non_users_ibfk_1` FOREIGN KEY (`prize_id`) REFERENCES `prizes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
