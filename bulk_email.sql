-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 27, 2024 at 01:59 PM
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
-- Database: `bulk_email`
--

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `campaign_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date_sent` timestamp NOT NULL DEFAULT current_timestamp(),
  `sent_from` varchar(100) DEFAULT NULL,
  `recipients` int(11) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`campaign_id`, `user_id`, `subject`, `message`, `date_sent`, `sent_from`, `recipients`, `token`) VALUES
(1, 3, 'CSV Test', 'Recipients through csv file', '2024-02-22 14:59:05', 'felixprogrammer76@gmail.com', 3, NULL),
(2, 3, 'CSV Test', 'Recipients through csv file', '2024-02-22 14:59:15', 'felixprogrammer76@gmail.com', 3, NULL),
(3, 3, 'CSV Test', 'Recipients through csv file', '2024-02-22 15:01:17', 'felixprogrammer76@gmail.com', 3, NULL),
(4, 3, 'CSV Test', 'Recipients through csv file', '2024-02-22 15:01:34', 'felixprogrammer76@gmail.com', 3, NULL),
(5, 3, 'CSV Test', 'Recipients through csv file', '2024-02-22 15:02:27', 'felixprogrammer76@gmail.com', 3, NULL),
(6, 3, 'CSV Test', 'Recipients through csv file', '2024-02-22 15:03:08', 'felixprogrammer76@gmail.com', 3, NULL),
(7, 3, 'CSV Test', 'Recipients through csv file', '2024-02-22 15:04:59', 'felixprogrammer76@gmail.com', 3, NULL),
(8, 3, 'CSV Test', 'Recipients through csv file', '2024-02-22 15:14:25', 'felixprogrammer76@gmail.com', 3, NULL),
(9, 3, 'Recipients Through file', 'Recipients were added through excel file', '2024-02-24 07:53:48', 'felixprogrammer76@gmail.com', 3, NULL),
(10, 3, 'Counter', 'Yooo', '2024-02-24 11:02:41', 'felixprogrammer76@gmail.com', 3, NULL),
(11, 3, 'Counter', 'Yooo', '2024-02-24 11:07:10', 'felixprogrammer76@gmail.com', 3, NULL),
(12, 3, 'Counter', 'Yooo', '2024-02-24 11:20:19', 'felixprogrammer76@gmail.com', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `subscription_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package` tinyint(1) NOT NULL DEFAULT 0,
  `sub_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `sub_expiry` timestamp NOT NULL DEFAULT current_timestamp(),
  `transaction_ref` varchar(50) NOT NULL,
  `sub_status` tinyint(1) NOT NULL DEFAULT 2,
  `paid_amount` float(10,2) DEFAULT NULL,
  `payment_mode` varchar(20) DEFAULT NULL,
  `currency_code` varchar(10) DEFAULT NULL,
  `payment_status` varchar(25) DEFAULT NULL,
  `payer_email` varchar(100) DEFAULT NULL,
  `payer_country` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profileImage` varchar(255) DEFAULT NULL,
  `registerDate` datetime DEFAULT current_timestamp(),
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL,
  `code` int(11) DEFAULT NULL,
  `code_expiry` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `username`, `password`, `profileImage`, `registerDate`, `verified`, `delete_flag`, `token`, `token_expiry`, `code`, `code_expiry`, `type`) VALUES
(3, 'Felix', 'Muimi', 'heribertfel20@gmail.com', 'Heribs', '$2y$10$asvIZAuHWltzjJIjS3HuEesbA4NZc8J1Py3zFCXHicRUF9ICJ3mhq', NULL, '2024-02-22 17:41:25', 1, 0, NULL, NULL, NULL, NULL, 2),
(4, 'Paul', 'Kavila', 'Paulkavilao1@gmail.com', 'Kavil', '$2y$10$ahRoBomUeHl01YtY2.pO5ueC/xN45QZU.1kfGtr4ul.U/foH.6qoG', NULL, '2024-02-22 18:29:51', 1, 0, NULL, NULL, NULL, NULL, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`campaign_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD KEY `foreign_key_user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `campaign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `foreign_key_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
