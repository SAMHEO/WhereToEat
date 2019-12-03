-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2019 at 07:35 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wheretoeat`
--

-- --------------------------------------------------------

--
-- Table structure for table `dining`
--

CREATE TABLE `dining` (
  `id` int(11) NOT NULL,
  `dining_name` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `hours` varchar(200) NOT NULL,
  `rating` int(11) NOT NULL,
  `img_url` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dining`
--

INSERT INTO `dining` (`id`, `dining_name`, `location`, `category`, `hours`, `rating`, `img_url`) VALUES
(1, 'Qdoba', 'Turner Place', 'Mexican Restaurant', '07:30 AM - 10:00PM', 1, 'http://localhost/WhereToEat/public/images/Qdoba_Logo.svg'),
(2, 'Origami', 'Turner Place', 'Japanese steak house', '11:00AM - 08:00PM', 2, 'http://localhost/WhereToEat/public/images/Turner_place.png'),
(3, 'Burger37', 'Squires', 'In-house branded contemporary burger joint', '11:00AM - 09:00PM', 3, 'http://localhost/WhereToEat/public/images/Burger37.jpg'),
(34, 'D2', 'Dietrick Hall', 'All-You-Can-Eat', '07:00AM - 07:30PM', 0, 'http://localhost/WhereToEat/public/images/D2.png'),
(36, 'DXpress', 'Dietrick Hall', 'Grab-n-go', '07:00AM - 02:00AM', 0, 'http://localhost/WhereToEat/public/images/DXpress.png');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `event_type` int(11) NOT NULL,
  `user_1_id` int(11) NOT NULL,
  `user_2_id` int(11) DEFAULT NULL,
  `review_id` int(11) DEFAULT NULL,
  `data` text DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `event_type`, `user_1_id`, `user_2_id`, `review_id`, `data`, `date_created`) VALUES
(3, 210, 4, NULL, 59, NULL, '2019-11-12 04:24:51'),
(4, 210, 4, NULL, 60, NULL, '2019-11-12 04:38:50'),
(5, 210, 4, NULL, 61, NULL, '2019-11-12 04:38:59'),
(14, 220, 3, NULL, NULL, NULL, '2019-11-12 06:05:30'),
(15, 220, 3, NULL, NULL, NULL, '2019-11-12 06:05:42'),
(16, 220, 3, NULL, NULL, NULL, '2019-11-12 06:05:51'),
(21, 230, 3, NULL, 50, NULL, '2019-11-12 06:10:56'),
(22, 230, 3, NULL, 50, NULL, '2019-11-12 06:11:08'),
(23, 230, 3, NULL, 50, NULL, '2019-11-12 06:11:20'),
(26, 110, 3, NULL, NULL, NULL, '2019-11-12 06:14:14'),
(27, 110, 3, NULL, NULL, NULL, '2019-11-12 06:14:56'),
(28, 110, 3, NULL, NULL, NULL, '2019-11-12 06:14:58'),
(29, 110, 4, NULL, NULL, NULL, '2019-11-12 06:15:17'),
(35, 120, 4, NULL, NULL, NULL, '2019-11-12 06:16:19'),
(37, 220, 3, NULL, NULL, NULL, '2019-11-12 22:26:10'),
(38, 220, 3, NULL, NULL, NULL, '2019-11-12 22:26:19'),
(48, 210, 3, NULL, 69, NULL, '2019-11-13 02:34:27'),
(50, 110, 3, NULL, NULL, NULL, '2019-11-13 02:35:11'),
(51, 120, 3, NULL, NULL, NULL, '2019-11-13 02:45:22'),
(52, 110, 3, NULL, NULL, NULL, '2019-11-13 02:45:31'),
(53, 110, 3, NULL, NULL, NULL, '2019-11-13 03:12:31'),
(54, 120, 3, NULL, NULL, NULL, '2019-11-13 03:15:08'),
(55, 110, 4, NULL, NULL, NULL, '2019-11-13 03:15:15'),
(56, 120, 4, NULL, NULL, NULL, '2019-11-13 03:16:03'),
(57, 110, 3, NULL, NULL, NULL, '2019-11-13 03:17:32'),
(58, 120, 3, NULL, NULL, NULL, '2019-11-13 03:17:36'),
(59, 110, 3, NULL, NULL, NULL, '2019-11-13 03:23:36'),
(60, 120, 3, NULL, NULL, NULL, '2019-11-13 03:34:42'),
(63, 210, 23, NULL, 70, NULL, '2019-11-13 03:38:07'),
(64, 120, 23, NULL, NULL, NULL, '2019-11-13 03:42:48'),
(65, 110, 3, NULL, NULL, NULL, '2019-11-13 03:42:50'),
(66, 120, 3, NULL, NULL, NULL, '2019-11-13 20:02:43'),
(67, 110, 3, NULL, NULL, NULL, '2019-11-15 05:25:15');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `gender` varchar(11) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `date_registered` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `password`, `email`, `gender`, `role`, `date_registered`) VALUES
(3, 'admin', 'admin', 'foo', 'bar', 'admin@admin.com', 'Male', 1, '2019-11-12 03:11:25'),
(4, 'Sam', 'Heo', 'hsn1017', 'zxcv', 'hsn1017@vt.edu', 'Male', 0, '2019-11-12 05:19:09'),
(23, 'John', 'Smith', 'jsmith', 'password', 'jsmith@gmail.com', 'Male', 0, '2019-11-13 03:37:50');

-- --------------------------------------------------------

--
-- Table structure for table `user_review`
--

CREATE TABLE `user_review` (
  `id` int(11) NOT NULL,
  `diningName` varchar(200) NOT NULL,
  `creator` varchar(200) NOT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `rating` int(11) NOT NULL DEFAULT 0,
  `comment` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `img_url` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_review`
--

INSERT INTO `user_review` (`id`, `diningName`, `creator`, `creator_id`, `rating`, `comment`, `date_created`, `img_url`) VALUES
(39, 'Origami', 'foo', 3, 4, 'Best Origami Place', '2019-10-31 06:16:47', NULL),
(50, 'Burger37', 'foo', 3, 4, 'Great Place', '2019-10-31 08:48:40', NULL),
(53, 'Burger37', 'foo', 3, 4, 'Recommend!', '2019-10-31 08:51:09', NULL),
(55, 'D2', 'foo', 3, 4, 'I LOVE this place', '2019-10-31 19:41:28', NULL),
(59, 'D2', '', 4, 4, 'Best Place', '2019-11-12 04:24:51', NULL),
(60, 'DXpress', '', 4, 5, 'TESTED', '2019-11-12 04:38:50', NULL),
(61, 'Qdoba', '', 4, 5, 'Testing', '2019-11-12 04:38:59', NULL),
(69, 'Burger37', '', 3, 5, 'BEST', '2019-11-13 02:34:27', NULL),
(70, 'Burger37', '', 23, 3, 'BEST PLACE', '2019-11-13 03:38:07', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dining`
--
ALTER TABLE `dining`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dining_name` (`dining_name`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_1_id` (`user_1_id`),
  ADD KEY `user_2_id` (`user_2_id`),
  ADD KEY `review_id` (`review_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_review`
--
ALTER TABLE `user_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dining`
--
ALTER TABLE `dining`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_review`
--
ALTER TABLE `user_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`user_1_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `event_ibfk_2` FOREIGN KEY (`user_2_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `event_ibfk_3` FOREIGN KEY (`review_id`) REFERENCES `user_review` (`id`);

--
-- Constraints for table `user_review`
--
ALTER TABLE `user_review`
  ADD CONSTRAINT `user_review_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
