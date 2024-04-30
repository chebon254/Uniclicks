-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 05:08 AM
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
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `communication_type` enum('skype','telegram','email') NOT NULL,
  `communication_id` varchar(255) NOT NULL,
  `prize_id` int(11) DEFAULT NULL,
  `prize` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_users`
--

INSERT INTO `contact_users` (`id`, `name`, `email`, `company`, `communication_type`, `communication_id`, `prize_id`, `prize`, `message`) VALUES
(1, '', 'kelvinchebon90@gmail.com', '+254715925156', '', '', NULL, '50% Discount', NULL),
(2, '', 'kelvinchebon90@gmail.com', '+254715925156', '', '', NULL, '50% Discount', NULL),
(4, '', 'kelvinchebon90@gmail.com', '+254715925156', '', '', NULL, '50% Discount', NULL),
(5, '', 'kelvinchebon90@gmail.com', '+254715925156', '', '', NULL, '50% Discount', NULL),
(6, '', 'kelvinchebon90@gmail.com', '+254715925156', '', '', NULL, '50% Discount', NULL),
(7, '', 'kelvinchebon90@gmail.com', '+254715925156', '', '', NULL, '50% Discount', NULL),
(8, '', 'kelvinchebon90@gmail.com', '+254715925156', '', '', NULL, '50% Discount', NULL),
(9, '', 'kelvinchebon90@gmail.com', '+254715925156', '', '', NULL, '50% Discount', NULL),
(10, '', 'admin@gmail.com', '+254715925156', '', '', NULL, NULL, NULL),
(11, '', 'admin@gmail.com', '+254715925156', '', '', NULL, NULL, NULL),
(12, '', 'bereacod@gmail.com', '+2547159256', '', '', NULL, NULL, NULL),
(13, '', 'harry@den.com', '777777777', '', '', NULL, NULL, NULL),
(14, 'Chebon', 'kelvinchebon90@gmail.com', '+254715925156', 'skype', '234532', NULL, '50% Discount', NULL),
(15, 'Chebon', 'kelvinchebon90@gmail.com', '+254715925156', 'skype', '234532', NULL, '50% Discount', NULL),
(16, '', 'bereacode@gmail.com', '+254715925156', '', '', NULL, NULL, ''),
(17, '', 'bereacode@gmail.com', '+254715925156', '', '', NULL, NULL, ''),
(18, '', 'bereacode@gmail.com', '+254715925156', '', '', NULL, NULL, ''),
(19, '', 'bereacode@gmail.com', '+254715925156', '', '', NULL, NULL, '');

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
(11, 'Travel', 'Manchester', '2024-05-03 00:00:00', '2024-05-11 00:00:00', '662cbad64fa03_headway-F2KRf_QfCqw-unsplash.jpg');

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
-- Table structure for table `prizes`
--

CREATE TABLE `prizes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `probability` enum('easy','medium','hard') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `signup_users`
--

CREATE TABLE `signup_users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `prize_id` int(11) DEFAULT NULL,
  `prize` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup_users`
--

INSERT INTO `signup_users` (`id`, `full_name`, `email`, `phone`, `prize_id`, `prize`) VALUES
(1, 'kelvin chebon', 'kelvinchebon90@gmail.com', '+254715925156', NULL, '50% Discount'),
(2, 'kelvin chebon', 'kelvinchebon90@gmail.com', '+254715925156', NULL, '50% Discount'),
(3, 'kelvin chebon', 'kelvinchebon90@gmail.com', '+254715925156', NULL, '50% Discount'),
(4, 'kelvin chebon', 'kelvinchebon90@gmail.com', '+254715925156', NULL, '50% Discount'),
(10, 'kelvin chebon', 'admin@gmail.com', '+254715925156', NULL, NULL),
(11, 'kelvin chebon', 'admin@gmail.com', '+254715925156', NULL, NULL),
(12, 'Kibet Kibe', 'bereacod@gmail.com', '+2547159256', NULL, NULL),
(13, 'chesaro', 'harry@den.com', '777777777', NULL, NULL),
(16, 'kelvin chebon', 'bereacode@gmail.com', '+254715925156', NULL, NULL),
(17, 'kelvin chebon', 'bereacode@gmail.com', '+254715925156', NULL, NULL),
(18, 'kelvin chebon', 'bereacode@gmail.com', '+254715925156', NULL, NULL),
(19, 'kelvin chebon', 'bereacode@gmail.com', '+254715925156', NULL, NULL);

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
(6, 'Nutra US', 3990, 12300);

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
-- Dumping data for table `winners`
--

INSERT INTO `winners` (`id`, `name`, `email`, `prize`) VALUES
(1, 'John Doe', 'john.doe@example.com', '20% discount'),
(2, 'Alice Smith', 'alice.smith@example.com', '30% discount'),
(3, 'Bob Johnson', 'bob.johnson@example.com', '50% discount'),
(4, 'Emily Brown', 'emily.brown@example.com', 'Free shipping'),
(5, 'Michael Davis', 'michael.davis@example.com', '10% off next purchase'),
(6, 'Jessica Wilson', 'jessica.wilson@example.com', 'Special prize'),
(7, 'David Miller', 'david.miller@example.com', 'Gift voucher'),
(8, 'Sarah Taylor', 'sarah.taylor@example.com', '20% cashback'),
(9, 'John Doe', 'kelvinchebon90@gmail.com', 'Gift Card'),
(10, 'Alice Smith', 'kelvinchebon90@gmail.com', 'Free Trip'),
(11, 'Bob Johnson', 'kelvinchebon90@gmail.com', 'Cash Prize'),
(12, 'Chebon', 'kelvinchebon90@gmail.com', '50% Discount'),
(13, 'Chebon', 'kelvinchebon90@gmail.com', '50% Discount'),
(14, 'Chebon', 'kelvinchebon90@gmail.com', '50% Discount'),
(15, 'Chebon', 'kelvinchebon90@gmail.com', '50% Discount'),
(16, 'Chebon', 'kelvinchebon90@gmail.com', '50% Discount'),
(17, 'Chebon', 'kelvinchebon90@gmail.com', '50% Discount'),
(18, 'Chebon', 'kelvinchebon90@gmail.com', '50% Discount');

--
-- Triggers `winners`
--
DELIMITER $$
CREATE TRIGGER `update_contact_users_prize` AFTER INSERT ON `winners` FOR EACH ROW BEGIN
    UPDATE contact_users
    SET prize = NEW.prize
    WHERE email = NEW.email;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_signup_users_prize` AFTER INSERT ON `winners` FOR EACH ROW BEGIN
    UPDATE signup_users
    SET prize = NEW.prize
    WHERE email = NEW.email;
END
$$
DELIMITER ;

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `prize_id` (`prize_id`);

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
-- Indexes for table `prizes`
--
ALTER TABLE `prizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signup_users`
--
ALTER TABLE `signup_users`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `non_users`
--
ALTER TABLE `non_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prizes`
--
ALTER TABLE `prizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `signup_users`
--
ALTER TABLE `signup_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `spin_prizes`
--
ALTER TABLE `spin_prizes`
  MODIFY `spin_prizesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `top_offers`
--
ALTER TABLE `top_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `winners`
--
ALTER TABLE `winners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact_users`
--
ALTER TABLE `contact_users`
  ADD CONSTRAINT `contact_users_ibfk_1` FOREIGN KEY (`prize_id`) REFERENCES `prizes` (`id`);

--
-- Constraints for table `non_users`
--
ALTER TABLE `non_users`
  ADD CONSTRAINT `non_users_ibfk_1` FOREIGN KEY (`prize_id`) REFERENCES `prizes` (`id`);

--
-- Constraints for table `signup_users`
--
ALTER TABLE `signup_users`
  ADD CONSTRAINT `signup_users_ibfk_1` FOREIGN KEY (`prize_id`) REFERENCES `prizes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
