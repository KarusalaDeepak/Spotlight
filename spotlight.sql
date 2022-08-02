-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2022 at 12:58 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spotlight`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `cover` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`, `cover`) VALUES
(1, '83', 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/83/83AlbumCover.jpg'),
(2, 'Aashiqui 2', 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/Aashiqui+2/Aashiqui2AlbumCover.jpg'),
(3, 'Beast', 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/Beast/BeastAlbumCover.jpg'),
(4, 'Geeta Govindam', 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/Geeta+Govindam/GeetaGovindamAlbumCover.jpg'),
(5, 'Mimi', 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/Mimi/MimiAlbumCover.jpg'),
(6, 'MS Dhoni - an untold story', 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/MS+Dhoni+-+an+untold+story/MSDhoniAlbumCover.jpg'),
(7, 'Pushpa', 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/Pushpa/PushpaAlbumCover.jpg'),
(8, 'Radhe Shyam', 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/Radhe+Shyam/RadheShyamAlbumCover.jpg'),
(9, 'Saina', 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/Saina/SainaAlbumCover.jpg'),
(10, 'Sanam Re', 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/Sanam+Re/SanamReAlbumCover.jpg'),
(11, 'KGF: Chapter 2', 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/KGF+Chapter+2/KGFChapter2AlbumCover.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE `music` (
  `id` int(11) NOT NULL,
  `album` int(11) NOT NULL,
  `musicURL` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `composer` varchar(256) NOT NULL,
  `duration` time NOT NULL,
  `playtime` int(11) NOT NULL DEFAULT 0,
  `trendingScore` double NOT NULL DEFAULT 0,
  `lastPlayed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `music`
--

INSERT INTO `music` (`id`, `album`, `musicURL`, `name`, `composer`, `duration`, `playtime`, `trendingScore`, `lastPlayed`) VALUES
(1, 1, 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/83/Lehra+Do.mp3', 'Lehra Do', 'Pritam Chakraborty', '00:02:36', 10, 0, '2022-05-06 17:16:38'),
(2, 2, 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/Aashiqui+2/Chahun+Main+Ya+Naa.mp3', 'Chahun Main Ya Naa', 'Jeet Gangulli', '00:02:38', 3, 0, '2022-05-06 17:16:38'),
(3, 2, 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/Aashiqui+2/Sunn+Raha+Hai+Na+Tu.mp3', 'Sunn Raha Hai Na Tu', 'Ankit Tiwari', '00:02:17', 0, 0, '2022-05-06 17:16:38'),
(4, 2, 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/Aashiqui+2/Tum+Hi+Ho.mp3', 'Tum Hi Ho', 'Mithoon', '00:04:23', 10, 0, '2022-05-06 17:16:38'),
(5, 3, 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/Beast/Arabic+Kuthu.mp3', 'Arabic Kuthu', 'Anirudh Ravichander', '00:03:16', 0, 0, '2022-05-06 17:16:38'),
(6, 3, 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/Beast/Jolly+O+Gymkhana.mp3', 'Jolly O Gymkhana', 'Anirudh Ravichander', '00:03:36', 0, 0, '2022-05-06 17:16:38'),
(7, 4, 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/Geeta+Govindam/Inkem+Inkem+Inkem+Kaavaale.mp3', 'Inkem Inkem Inkem Kaavaale', 'Gopi Sundar', '00:03:09', 0, 0, '2022-05-06 17:16:38'),
(8, 5, 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/Mimi/Param+Sundari.mp3', 'Param Sundari', 'A. R. Rahman', '00:02:17', 0, 0, '2022-05-06 17:16:38'),
(9, 6, 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/MS+Dhoni+-+an+untold+story/Kaun+Tujhe.mp3', 'Kaun Tujhe', 'Amaal Mallik', '00:03:25', 27, 0.6331552229999999, '2022-05-06 18:34:33'),
(10, 7, 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/Pushpa/Srivalli.mp3', 'Srivalli', 'Devi Sri Prasad', '00:02:03', 0, 0, '2022-05-06 17:16:38'),
(11, 8, 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/Radhe+Shyam/Ee+Raathale.mp3', 'Ee Raathale', 'Justin Prabhakaran', '00:02:16', 105, 0, '2022-05-06 18:18:08'),
(12, 8, 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/Radhe+Shyam/Jaan+Hai+Meri.mp3', 'Jaan Hai Meri', 'Amaal Malik', '00:02:38', 15, 0, '2022-05-06 18:18:10'),
(13, 8, 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/Radhe+Shyam/Main+Ishq+Mein+Hoon.mp3', 'Main Ishq Mein Hoon', 'Manan Bharadwaj', '00:03:01', 38, 0, '2022-05-06 17:16:38'),
(14, 8, 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/Radhe+Shyam/Soch+Liya.mp3', 'Soch Liya', 'Mithoon', '00:04:42', 7, 0, '2022-05-06 17:16:38'),
(15, 8, 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/Radhe+Shyam/Udd+Jaa+Parindey.mp3', 'Udd Jaa Parindey', 'Mithoon', '00:02:39', 5, 0, '2022-05-06 17:16:38'),
(16, 8, 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/Radhe+Shyam/Aashiqui+Aa+Gayi.mp3', 'Aashiqui Aa Gayi', 'Mithoon', '00:04:26', 7, 0, '2022-05-06 17:16:38'),
(17, 9, 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/Saina/Chal+Wahin+Chalein.mp3', 'Chal Wahin Chalein', 'Amaal Malik', '00:04:04', 0, 0, '2022-05-06 17:16:38'),
(18, 10, 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/Sanam+Re/Sanam+Re.mp3', 'Sanam Re', 'Mithoon', '00:02:44', 2, 0, '2022-05-06 17:16:38'),
(19, 11, 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/KGF+Chapter+2/Gagana+Nee.mp3', 'Gagana Nee', 'Ravi Basrur', '00:02:58', 5, 0, '2022-05-06 17:16:38'),
(20, 11, 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/KGF+Chapter+2/Mehabooba.mp3', 'Mehabooba', 'Ravi Basrur', '00:03:33', 6, 0, '2022-05-06 17:16:38'),
(21, 11, 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/KGF+Chapter+2/Sulthana.mp3', 'Sulthana', 'Ravi Basrur', '00:03:48', 1, 0.000000853, '2022-05-20 07:00:39'),
(22, 11, 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/KGF+Chapter+2/Toofan.mp3', 'Toofan', 'Ravi Basrur', '00:03:33', 1, 0, '2022-05-06 17:16:38');

-- --------------------------------------------------------

--
-- Table structure for table `trendingplays`
--

CREATE TABLE `trendingplays` (
  `id` int(11) NOT NULL,
  `musicURL` varchar(256) NOT NULL,
  `userMail` varchar(256) NOT NULL,
  `trendingPlays` int(11) NOT NULL DEFAULT 1,
  `lastDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trendingplays`
--

INSERT INTO `trendingplays` (`id`, `musicURL`, `userMail`, `trendingPlays`, `lastDate`) VALUES
(5, 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/MS+Dhoni+-+an+untold+story/Kaun+Tujhe.mp3', 'krishnapaanchajanya1966@gmail.com', 1, '2022-05-07'),
(6, 'https://spotlight-album-covers.s3.ap-south-1.amazonaws.com/KGF+Chapter+2/Sulthana.mp3', 'krishnapaanchajanya1966@gmail.com', 1, '2022-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `mail` varchar(256) NOT NULL,
  `pwd` varchar(256) NOT NULL,
  `recent1` int(11) NOT NULL DEFAULT 0,
  `recent2` int(11) NOT NULL DEFAULT 0,
  `recent3` int(11) NOT NULL DEFAULT 0,
  `recent4` int(11) NOT NULL DEFAULT 0,
  `recent5` int(11) NOT NULL DEFAULT 0,
  `recent6` int(11) NOT NULL DEFAULT 0,
  `recent7` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `mail`, `pwd`, `recent1`, `recent2`, `recent3`, `recent4`, `recent5`, `recent6`, `recent7`) VALUES
(1, 'krishnapaanchajanya1966@gmail.com', 'Veerarjun786', 6, 6, 6, 6, 6, 6, 11),
(3, '19bcs063@iiitdwd.ac.in', '123456', 5, 6, 7, 2, 2, 8, 2),
(5, 'karthiksajjan1@gmail.com', 'karthik', 8, 8, 8, 8, 8, 8, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trendingplays`
--
ALTER TABLE `trendingplays`
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
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `music`
--
ALTER TABLE `music`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `trendingplays`
--
ALTER TABLE `trendingplays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
