-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2024 at 03:03 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `artwork_display_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `arts`
--

CREATE TABLE `arts` (
  `id` int(30) NOT NULL,
  `artist_id` int(30) NOT NULL,
  `art_title` text NOT NULL,
  `art_description` text NOT NULL,
  `status` tinyint(1) DEFAULT 0 COMMENT '0=unpublished,1=published'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arts`
--

INSERT INTO `arts` (`id`, `artist_id`, `art_title`, `art_description`, `status`) VALUES
(11, 7, 'asd', 'asdasd', 0),
(12, 7, 'tger', 'tger', 1),
(14, 6, 'illustry', 'AXAXAXAXAXAXA', 1),
(15, 6, 'Imagination Clarification', '&lt;p&gt;Is this the real life? Is this just fantasy?&lt;/p&gt;', 1),
(16, 6, 'Scenic', 'views', 1),
(17, 6, 'Absolute Zero', '', 1),
(18, 6, 'Holier than Thou', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `arts_fs`
--

CREATE TABLE `arts_fs` (
  `id` int(30) NOT NULL,
  `art_id` text NOT NULL,
  `price` float NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=onhand,1= sold',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arts_fs`
--

INSERT INTO `arts_fs` (`id`, `art_id`, `price`, `status`, `date_created`) VALUES
(1, '2', 300000, 0, '2020-10-09 13:27:45'),
(2, '4', 250000, 0, '2020-10-09 13:47:04'),
(3, '10', 0.000069, 0, '2023-12-01 20:10:25'),
(4, '11', 0.000069, 0, '2023-12-01 20:11:00'),
(5, '14', 0.000069, 0, '2024-01-11 22:56:17'),
(6, '15', 0.000069, 0, '2024-01-11 23:00:16');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(30) NOT NULL,
  `title` text NOT NULL,
  `artist_id` int(30) NOT NULL,
  `content` text NOT NULL,
  `event_datetime` datetime NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `artist_id`, `content`, `event_datetime`, `date_created`) VALUES
(2, 'Happy New Year!', 1, 'Wishing you joy, success, and endless possibilities in the upcoming year. Happy New Year!', '2024-01-01 00:00:00', '2024-01-11 23:44:54');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `message` varchar(100) NOT NULL,
  `orders_id` int(11) NOT NULL,
  `ratings_comments_id` varchar(100) NOT NULL,
  `seen` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(30) NOT NULL,
  `art_fs_id` int(30) NOT NULL,
  `customer_id` int(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=for verification,1= confirmed,2 = cancel, 3= delivered',
  `deliver_schedule` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratings_comments`
--

CREATE TABLE `ratings_comments` (
  `id` int(11) NOT NULL,
  `art_fs_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `cover_img` text NOT NULL,
  `about_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `cover_img`, `about_content`) VALUES
(1, 'Art Gallery Management System', 'info@sample.comm', '+6948 8542 623', '1700380500_Screenshot (160).png', '&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400; text-align: justify;&quot;&gt;&amp;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&rsquo;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(50) NOT NULL,
  `user_type` tinyint(1) NOT NULL DEFAULT 3 COMMENT '1 = admin, 2= artist,3= customers',
  `username` text NOT NULL,
  `password` text NOT NULL,
  `linkedin` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `address`, `contact`, `user_type`, `username`, `password`, `linkedin`, `facebook`, `twitter`) VALUES
(1, 'Administrator', '', '', 1, 'admin', 'admin123', NULL, NULL, NULL),
(2, 'John Smith', 'Sample', '+18456-5455-55', 2, '', '', NULL, NULL, NULL),
(3, 'George Wilson', 'Sample Address', '+14526-5455-44', 2, '', '', NULL, NULL, NULL),
(6, 'mac', 'asd', '0123456789', 2, 'mac', 'mac123', NULL, NULL, NULL),
(7, 'asd', 'asd', '0123456789', 2, 'asd', 'asd', NULL, NULL, NULL),
(8, 'asd', 'asd', '0123456789', 2, 'asd', 'asd', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arts`
--
ALTER TABLE `arts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arts_fs`
--
ALTER TABLE `arts_fs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings_comments`
--
ALTER TABLE `ratings_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arts`
--
ALTER TABLE `arts`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `arts_fs`
--
ALTER TABLE `arts_fs`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
