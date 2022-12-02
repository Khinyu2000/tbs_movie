-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 11, 2020 at 02:29 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tbs_movies`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_account`
--

CREATE TABLE `admin_account` (
  `id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(41) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_account`
--

INSERT INTO `admin_account` (`id`, `username`, `password`) VALUES
(1, 'David', '*8201E0C1BD05201452E12ECFD5B8AFE4AEFBD053');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rate` float NOT NULL,
  `unicode` text COLLATE utf8_unicode_ci NOT NULL,
  `zawgyi` text COLLATE utf8_unicode_ci NOT NULL,
  `full_video` text COLLATE utf8_unicode_ci NOT NULL,
  `trailer` text COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `movie_category_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `name`, `rate`, `unicode`, `zawgyi`, `full_video`, `trailer`, `photo`, `movie_category_id`, `created_date`) VALUES
(5, 'Horror 1', 2, 'Unicode', 'zawgyi', '<iframe width=\"640\" height=\"360\" frameborder=\"0\" src=\"https://mega.nz/embed#!BQxW3ADA!R2x8LblLo7sU7f1yAzu3yQuu8Tj6SrWgDcWUvdmkZkA\" allowfullscreen ></iframe>', '<iframe width=\"640\" height=\"360\" frameborder=\"0\" src=\"https://mega.nz/embed#!BQxW3ADA!R2x8LblLo7sU7f1yAzu3yQuu8Tj6SrWgDcWUvdmkZkA\" allowfullscreen ></iframe>', '937839.jpg', 2, '2020-01-31 14:27:07'),
(6, 'Horror 3', 3, 'Uni', 'zawgyi', '<iframe width=\"640\" height=\"360\" frameborder=\"0\" src=\"https://mega.nz/embed#!BQxW3ADA!R2x8LblLo7sU7f1yAzu3yQuu8Tj6SrWgDcWUvdmkZkA\" allowfullscreen ></iframe>', '<iframe width=\"640\" height=\"360\" frameborder=\"0\" src=\"https://mega.nz/embed#!BQxW3ADA!R2x8LblLo7sU7f1yAzu3yQuu8Tj6SrWgDcWUvdmkZkA\" allowfullscreen ></iframe>', 'Canta_wallpaper_02.jpeg', 2, '2020-02-01 19:11:07'),
(7, 'Horror 2', 4, 'uni', 'zawgyi', '<iframe width=\"640\" height=\"360\" frameborder=\"0\" src=\"https://mega.nz/embed#!BQxW3ADA!R2x8LblLo7sU7f1yAzu3yQuu8Tj6SrWgDcWUvdmkZkA\" allowfullscreen ></iframe>', '<iframe width=\"640\" height=\"360\" frameborder=\"0\" src=\"https://mega.nz/embed#!BQxW3ADA!R2x8LblLo7sU7f1yAzu3yQuu8Tj6SrWgDcWUvdmkZkA\" allowfullscreen ></iframe>', 'canta-wallpaper.png', 2, '2020-02-01 19:11:35'),
(8, 'Action 1', 3.8, 'uni', 'zawgyi', '<iframe width=\"640\" height=\"360\" frameborder=\"0\" src=\"https://mega.nz/embed#!BQxW3ADA!R2x8LblLo7sU7f1yAzu3yQuu8Tj6SrWgDcWUvdmkZkA\" allowfullscreen ></iframe>', '<iframe width=\"640\" height=\"360\" frameborder=\"0\" src=\"https://mega.nz/embed#!BQxW3ADA!R2x8LblLo7sU7f1yAzu3yQuu8Tj6SrWgDcWUvdmkZkA\" allowfullscreen ></iframe>', 'Canta_wallpaper_03.jpeg', 1, '2020-02-02 20:24:41'),
(9, 'Comedies 1', 3, 'Uni', 'zaw', '<iframe width=\"640\" height=\"360\" frameborder=\"0\" src=\"https://mega.nz/embed#!BQxW3ADA!R2x8LblLo7sU7f1yAzu3yQuu8Tj6SrWgDcWUvdmkZkA\" allowfullscreen ></iframe>', '<iframe width=\"640\" height=\"360\" frameborder=\"0\" src=\"https://mega.nz/embed#!BQxW3ADA!R2x8LblLo7sU7f1yAzu3yQuu8Tj6SrWgDcWUvdmkZkA\" allowfullscreen ></iframe>', 'Screenshot from 2019-12-10 18-03-27.png', 7, '2020-02-09 09:00:31');

-- --------------------------------------------------------

--
-- Table structure for table `movie_categories`
--

CREATE TABLE `movie_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `movie_categories`
--

INSERT INTO `movie_categories` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Horror'),
(7, 'Comedies');

-- --------------------------------------------------------

--
-- Table structure for table `movie_viewers`
--

CREATE TABLE `movie_viewers` (
  `movie_id` int(11) NOT NULL,
  `remote_address` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `times` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `movie_viewers`
--

INSERT INTO `movie_viewers` (`movie_id`, `remote_address`, `times`) VALUES
(5, '192.168.1.2', 1),
(5, '192.168.2.9', 1),
(8, '192.168.1.2', 1),
(8, '192.168.2.9', 1),
(9, '::1', 1),
(9, '127.0.0.1', 1),
(8, '127.0.0.1', 1),
(8, '::1', 1),
(7, '127.0.0.1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `rate` float NOT NULL,
  `unicode` text COLLATE utf8_unicode_ci NOT NULL,
  `zawgyi` text COLLATE utf8_unicode_ci NOT NULL,
  `trailer` text COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `series_category_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `series`
--

INSERT INTO `series` (`id`, `name`, `rate`, `unicode`, `zawgyi`, `trailer`, `photo`, `series_category_id`, `created_date`) VALUES
(1, 'U Comedies and Horror 1', 1, 'U Uni', 'U zaw', '<iframe width=\"640\" height=\"360\" frameborder=\"0\" src=\"https://mega.nz/embed#!BQxW3ADA!R2x8LblLo7sU7f1yAzu3yQuu8Tj6SrWgDcWUvdmkZkA\" allowfullscreen ></iframe>', 'Screenshot from 2019-10-28 21-42-42.png', 2, '2020-02-01 21:34:50'),
(3, 'Modified Comedies and Horror 3', 4, 'Modified Uni', 'Modified Zaw', '<iframe width=\"640\" height=\"360\" frameborder=\"0\" src=\"https://mega.nz/embed#!BQxW3ADA!R2x8LblLo7sU7f1yAzu3yQuu8Tj6SrWgDcWUvdmkZkA\" allowfullscreen ></iframe>', 'canta-wallpaper.svg', 2, '2020-02-01 21:35:56');

-- --------------------------------------------------------

--
-- Table structure for table `series_categories`
--

CREATE TABLE `series_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `series_categories`
--

INSERT INTO `series_categories` (`id`, `name`) VALUES
(2, 'Comedies'),
(3, 'Romance');

-- --------------------------------------------------------

--
-- Table structure for table `series_episode_viewers`
--

CREATE TABLE `series_episode_viewers` (
  `series_video_id` int(11) NOT NULL,
  `remote_address` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `times` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `series_episode_viewers`
--

INSERT INTO `series_episode_viewers` (`series_video_id`, `remote_address`, `times`) VALUES
(1, '127.0.0.1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `series_videos`
--

CREATE TABLE `series_videos` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `info` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `full_video` text COLLATE utf8_unicode_ci NOT NULL,
  `series_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `series_videos`
--

INSERT INTO `series_videos` (`id`, `name`, `info`, `full_video`, `series_id`, `created_date`) VALUES
(1, 'Updated Episode 1', '250MB', '<iframe width=\"640\" height=\"360\" frameborder=\"0\" src=\"https://mega.nz/embed#!BQxW3ADA!R2x8LblLo7sU7f1yAzu3yQuu8Tj6SrWgDcWUvdmkZkA\" allowfullscreen ></iframe>', 1, '2020-02-08 19:05:47'),
(2, 'U Episode 2', '555MB', '<iframe width=\"640\" height=\"360\" frameborder=\"0\" src=\"https://mega.nz/embed#!BQxW3ADA!R2x8LblLo7sU7f1yAzu3yQuu8Tj6SrWgDcWUvdmkZkA\" allowfullscreen ></iframe>', 1, '2020-02-08 19:06:25');

-- --------------------------------------------------------

--
-- Table structure for table `short_videos`
--

CREATE TABLE `short_videos` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `full_video` text COLLATE utf8_unicode_ci NOT NULL,
  `unicode` text COLLATE utf8_unicode_ci NOT NULL,
  `zawgyi` text COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_video_category_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `short_videos`
--

INSERT INTO `short_videos` (`id`, `name`, `full_video`, `unicode`, `zawgyi`, `photo`, `short_video_category_id`, `created_date`) VALUES
(2, 'U Short Videos 2', '<iframe width=\"640\" height=\"360\" frameborder=\"0\" src=\"https://mega.nz/embed#!BQxW3ADA!R2x8LblLo7sU7f1yAzu3yQuu8Tj6SrWgDcWUvdmkZkA\" allowfullscreen ></iframe>', 'U Unicode', 'U zawgyi', 'canta-wallpaper.png', 1, '2020-02-01 09:27:21'),
(3, 'Short Videos 3', '<iframe width=\"640\" height=\"360\" frameborder=\"0\" src=\"https://mega.nz/embed#!BQxW3ADA!R2x8LblLo7sU7f1yAzu3yQuu8Tj6SrWgDcWUvdmkZkA\" allowfullscreen ></iframe>', 'Unicode', 'zawgyi', 'Screenshot from 2019-10-28 21-42-42.png', 1, '2020-02-01 09:30:55'),
(4, 'Short Videos 1', '<iframe width=\"640\" height=\"360\" frameborder=\"0\" src=\"https://mega.nz/embed#!BQxW3ADA!R2x8LblLo7sU7f1yAzu3yQuu8Tj6SrWgDcWUvdmkZkA\" allowfullscreen ></iframe>\r\n', 'Unicode', 'Zawgyi', 'Canta_wallpaper_02.jpeg', 1, '2020-02-01 12:43:58'),
(5, 'Motivational video', '<iframe width=\"640\" height=\"360\" frameborder=\"0\" src=\"https://mega.nz/embed#!BQxW3ADA!R2x8LblLo7sU7f1yAzu3yQuu8Tj6SrWgDcWUvdmkZkA\" allowfullscreen ></iframe>', 'Unicode', 'zawgyi', 'Screenshot from 2019-10-28 21-42-42.png', 3, '2020-02-08 20:31:33'),
(6, 'Motivational video3', '<iframe width=\"640\" height=\"360\" frameborder=\"0\" src=\"https://mega.nz/embed#!BQxW3ADA!R2x8LblLo7sU7f1yAzu3yQuu8Tj6SrWgDcWUvdmkZkA\" allowfullscreen ></iframe>', 'uni', 'zaw', '937839.jpg', 3, '2020-02-08 20:34:46');

-- --------------------------------------------------------

--
-- Table structure for table `short_video_categories`
--

CREATE TABLE `short_video_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `short_video_categories`
--

INSERT INTO `short_video_categories` (`id`, `name`) VALUES
(1, 'Comedies'),
(3, 'Motivational 1');

-- --------------------------------------------------------

--
-- Table structure for table `short_video_viewers`
--

CREATE TABLE `short_video_viewers` (
  `short_video_id` int(11) NOT NULL,
  `remote_address` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `times` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `short_video_viewers`
--

INSERT INTO `short_video_viewers` (`short_video_id`, `remote_address`, `times`) VALUES
(2, '192.168.1.2', 1),
(2, '192.168.2.9', 2),
(3, '192.168.1.2', 1),
(3, '192.168.2.9', 2),
(6, '127.0.0.1', 1),
(5, '127.0.0.1', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_account`
--
ALTER TABLE `admin_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie_categories`
--
ALTER TABLE `movie_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie_viewers`
--
ALTER TABLE `movie_viewers`
  ADD KEY `remote_address` (`remote_address`);

--
-- Indexes for table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `series_categories`
--
ALTER TABLE `series_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `series_videos`
--
ALTER TABLE `series_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `short_videos`
--
ALTER TABLE `short_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `short_video_categories`
--
ALTER TABLE `short_video_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_account`
--
ALTER TABLE `admin_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `movie_categories`
--
ALTER TABLE `movie_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `series_categories`
--
ALTER TABLE `series_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `series_videos`
--
ALTER TABLE `series_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `short_videos`
--
ALTER TABLE `short_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `short_video_categories`
--
ALTER TABLE `short_video_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
