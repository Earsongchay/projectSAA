-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 05, 2023 at 03:41 PM
-- Server version: 5.7.36
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_movies`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookingdetails`
--

DROP TABLE IF EXISTS `bookingdetails`;
CREATE TABLE IF NOT EXISTS `bookingdetails` (
  `bookingDetail_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `amount` double DEFAULT NULL,
  `issueDate` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `seats_booked` varchar(100) NOT NULL,
  `scheduleDetail_id` int(11) NOT NULL,
  PRIMARY KEY (`bookingDetail_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bookingdetails`
--

INSERT INTO `bookingdetails` (`bookingDetail_id`, `amount`, `issueDate`, `status`, `seats_booked`, `scheduleDetail_id`) VALUES
(1, 21, '2023-03-05 11:56:19', 'Reserved', 'A1,A2,A3', 18),
(2, 14, '2023-03-07 09:00:00', 'Paid', 'B2,B3', 18),
(3, 7, '2023-03-05 05:14:38', 'Paid', 'B1', 18),
(4, 21, '2023-03-05 10:10:10', 'Paid', 'B1,B2,B3', 19),
(5, 14, '2023-03-05 03:15:23', 'Paid', 'A2,A3', 19),
(15, 21, '2023-03-05 03:35:38', 'Paid', 'A1,A2,A3', 253),
(16, 21, '2023-03-05 03:36:35', 'Paid', 'A10,A8,A9', 385);

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
CREATE TABLE IF NOT EXISTS `branches` (
  `branch_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(191) NOT NULL,
  `address` varchar(191) NOT NULL,
  PRIMARY KEY (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branch_id`, `branch_name`, `address`) VALUES
(1, 'AEON MALL', 'PHNOM PENH'),
(2, 'AEON2', 'SEN SOK'),
(3, 'AEON3', 'MEAN CHEY'),
(4, 'SORYA', 'PHNOM PENH');

-- --------------------------------------------------------

--
-- Table structure for table `branches_halls`
--

DROP TABLE IF EXISTS `branches_halls`;
CREATE TABLE IF NOT EXISTS `branches_halls` (
  `hall_branch_id` int(11) NOT NULL AUTO_INCREMENT,
  `hall_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`hall_branch_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `branches_halls`
--

INSERT INTO `branches_halls` (`hall_branch_id`, `hall_id`, `branch_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 1, 2),
(6, 2, 2),
(7, 3, 2),
(8, 4, 2),
(9, 3, 3),
(10, 4, 3),
(11, 2, 3),
(12, 1, 3),
(13, 3, 4),
(14, 4, 4),
(15, 2, 4),
(16, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `categorie_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `categorie_name` varchar(191) NOT NULL,
  PRIMARY KEY (`categorie_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categorie_id`, `categorie_name`) VALUES
(1, 'action'),
(2, 'adventure'),
(3, 'comedy'),
(4, 'drama'),
(5, 'fantasy'),
(6, 'horror'),
(7, 'musicals'),
(8, 'mystery'),
(9, 'romance'),
(10, 'science fiction'),
(11, 'sports'),
(12, 'thriller');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(191) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(191) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `halls`
--

DROP TABLE IF EXISTS `halls`;
CREATE TABLE IF NOT EXISTS `halls` (
  `hall_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `hall_name` varchar(191) NOT NULL,
  `hall_type` varchar(20) NOT NULL,
  `seat_id` int(11) NOT NULL,
  PRIMARY KEY (`hall_id`),
  KEY `branch_id` (`hall_type`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `halls`
--

INSERT INTO `halls` (`hall_id`, `hall_name`, `hall_type`, `seat_id`) VALUES
(1, 'THEATRE A ( 2D )', '2D', 1),
(2, 'THEATRE B ( 3D )', '3D', 2),
(3, 'THEATRE C ( 4DX )', '4DX', 3),
(4, 'THEATRE D ( IMAX )', 'IMAX', 4);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `movie_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `movie_title` varchar(191) NOT NULL,
  `durations` varchar(50) NOT NULL,
  `movie_image` varchar(254) NOT NULL,
  `categorie_id` int(10) UNSIGNED NOT NULL,
  `rating` text,
  `description` varchar(500) NOT NULL,
  `movie_status` varchar(20) NOT NULL,
  `release_date` varchar(50) DEFAULT NULL,
  `url_trailer` varchar(500) NOT NULL,
  `url_poster` varchar(255) NOT NULL,
  PRIMARY KEY (`movie_id`),
  KEY `category_id` (`categorie_id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `movie_title`, `durations`, `movie_image`, `categorie_id`, `rating`, `description`, `movie_status`, `release_date`, `url_trailer`, `url_poster`) VALUES
(1, 'Doctor Strange in the Multiverse of Madness', '2h 54 Minutes', 'Doctor Strange.jpg', 1, '9.2', 'Doctor Strange teams up with a mysterious teenage girl from his dreams who can travel across multiverses, to battle multiple threats, including other-universe versions of himself, which threaten to wipe out millions across the multiverse.', 'now showing', '12-12-2020', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/aWzlQ2N6qqg\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSJ5IuxfEt-WmUIrpJldszdRJFfTubSEeQVMVNuv63Z0PNfvbWV'),
(10, 'Jumanji: Welcome to the Jungle', '1h 35 minutes', 'jumanji_v8_aa.jpg', 1, '', 'When four students play with a magical video game, they are drawn to the jungle world of Jumanji, where they are trapped as their avatars. To return to the real world, they must finish the game.', 'Up Coming', '12-24-2020', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/2QKg5SZ_35I\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 'https://contentserver.com.au/assets/637737_jumanji_v8_aa.jpg'),
(14, 'Black Panther: Wakanda Forever', '2h 39 minutes', 'BlackPanther.jpg', 2, '7.8', 'Queen Ramonda, Shuri, M\'Baku, Okoye and the Dora Milaje fight to protect their nation from intervening world powers in the wake of King T\'Challa\'s death. As the Wakandans strive to embrace their next chapter, the heroes must band together with Nakia and Everett Ross to forge a new path for their beloved kingdom.', 'Up Coming', '02-14-2024', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RlOB3UALvrQ\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcSzNzI5w3iKM-KdasCDvlOEUgD2ojlf7IW5b-e3tqFmhW2JRSCz'),
(15, 'Free Guy', '', 'freeguy.jpg', 1, '7.1', 'When Guy, a bank teller, learns that he is a non-player character in a bloodthirsty, open-world video game, he goes on to become the hero of the story and takes the responsibility of saving the world.', 'now showing', '02-18-2023', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/X2m-08cOAbc\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcQEUMqXik1Ntuc2NTpCgbX2JENwlZD3kwDZa4nDm6TCkXVX9FvU'),
(16, 'Extraction', '1h 56 minutes', 'Extraction.jpg', 3, '6.1', 'A black-market mercenary who has nothing to lose is hired to rescue the kidnapped son of an imprisoned international crime lord. But in the murky underworld of weapons dealers and drug traffickers, an already deadly mission approaches the impossible.', 'now showing', '02-28-2023', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/L6P3nI6VnlY\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcRELEr5bWH1Z9ZlYjofDbRoW0ToFJop6YlcJuVU8lAYt2peph_n'),
(17, 'Puss in Boots: The Last Wish', '1h 40 minutes', 'puss-in-boots.jpg', 2, '7.9', 'Puss in Boots discovers that his passion for adventure has taken its toll when he learns that he has burnt through eight of his nine lives. Puss sets out on an epic journey to find the mythical Last Wish and restore his nine lives.', 'now showing', '12-22-2022', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RqrXhwS33yc\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 'https://www.dreamworks.com/storage/cms-uploads/puss-in-boots-the-last-wish-poster-thumbnail2.jpg'),
(18, 'Dune', '2h 35 minutes', 'dune.jpg', 3, '8', 'Paul Atreides arrives on Arrakis after his father accepts the stewardship of the dangerous planet. However, chaos ensues after a betrayal as forces clash to control melange, a precious resource.', 'Up Coming', '12-22-2024', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/n9xhJrPXop4\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSvJznVehDbSUPihJbSTNwH8Tgnvh4ZDxs0J4hV06wOvHHidHul'),
(19, 'Black Adam', '2h 40 minutes', 'Black_Adam.jpg', 1, '6.4', 'After being bestowed with godly powers and imprisoned for it, Black Adam is liberated from his earthly binds to unleash his fury on the modern world.', 'Up Coming', '12-22-2024', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/mkomfZHG5q4\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTNSOjcSmrXYIZ517jTKmCDxBwIJU4_ojFweUDLI1Dssn2UfTsx'),
(22, 'Spider-Man: No Way Home', '2h 28 minutes', 'nwhspider.jpg', 3, '9.5', 'Spider-Man seeks the help of Doctor Strange to forget his exposed secret identity as Peter Parker. However, Stranges spell goes horribly wrong, leading to unwanted guests entering their universe.', 'now showing', '02-22-2023', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/JfVOs4VSpmA\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQtU4DiRFRr0155DjcHlSsgJy9opzt_MPMJmHfG4MEa31-A82Xb'),
(24, 'Ant-Man and the Wasp: Quantumania', ' 2h 5 minutes', 'antman.jpg', 1, '9', 'Ant-Man and the Wasp find themselves exploring the Quantum Realm, interacting with strange new creatures and embarking on an adventure that pushes them beyond the limits of what they thought was possible.', 'now showing', '2023', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/ZlNFpri-Y40\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTYyaCMGIDqOrnfFiXD5Wj3--gOX6aYjvtE-DKc3ym6Wyr_UQqH'),
(25, 'Shazam! Fury of the Gods', ' 2h 10 minutes', 'shazam-fury-of-the-gods-final-button-1674672663658.jpg', 2, '7', 'Bestowed with the powers of the gods, Billy Batson and his fellow foster kids are still learning how to juggle teenage life with their adult superhero alter egos. When a vengeful trio of ancient gods arrive on Earth in search of the magic stolen from them long ago, Shazam and his allies get thrust into a battle for their superpowers, their lives, and the fate of the world.', 'up coming', 'March 17, 2023 ', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/AIc671o9yCI\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcQkt0sbPyrPtNbq10WtcGNEaiumgCpY-niW9AuxIcADocZzoGzj'),
(26, 'John Wick: Chapter 4', ' 2h 49 minutes', 'johnwick.jpg', 1, '8', 'With the price on his head ever increasing, legendary hit man John Wick takes his fight against the High Table global as he seeks out the most powerful players in the underworld, from New York to Paris to Japan to Berlin.', 'up coming', '2023', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/yjRHZEUamCc\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTGpBp6P5LIfO7IiA_RBY9IZiCxgyJRkEDr-KwvwPOmoyQx8TnM'),
(27, 'Guardians of the Galaxy Vol. 3', ' 2h 35 minutes', 'guardians_3.jpg', 1, '8', 'The Guardians of the Galaxy are adjusting to life on Knowhere, but when parts of Rocket\'s past resurface, Peter Quill must lead the Guardians on a dangerous mission to protect him that could lead to the team dissolving.', 'up coming', '2023', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/JqcncLPi9zw\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQ11X-P72Q-chS3EQwfY9cPO6dciecM5tX-xH3x2gLKJ1ZQYMx7'),
(29, 'The Flash', ' 2h 49 minutes', 'TheFlash.png', 2, '9', ' travel back in time to change the events of the past. However, when his attempt to save his family inadvertently alters the future, he becomes trapped in a reality in which General Zod has returned, threatening annihilation. With no other superheroes to turn to, the Flash looks to coax a very different Batman out of retirement and rescue an imprisoned Kryptonian -- albeit not the one he\'s looking for.', 'now showing', 'June 16, 2023', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/hebWYacbdvc\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcSk9Avvld19ygwPbQBPFeTXvhKi44oq8SEtb5semfoHApQxrlSW'),
(30, 'The Marvels', ' 2h 10 minutes', 'TheMarvels.jpg', 1, '8', 'The Marvels is an upcoming American superhero film based on Marvel Comics featuring the characters Carol Danvers / Captain Marvel, Kamala Khan / Ms. Marvel, and Monica Rambeau.', 'up coming', '2023', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/Wh1h73V8Pc4\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 'https://tvline.com/wp-content/uploads/2023/02/the-marvels-poster.png'),
(31, 'Aquaman and the Lost Kingdom', ' 2h 15 minutes', 'aquaman-2-scaled.jpg', 1, '8', 'Aquaman forges an uneasy alliance with an unlikely ally in a bid to save Atlantis and the rest of the planet.', 'now showing', '2023 ', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/zL2BtTdIuLI\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRIonZj4Gw1S4lBY8qoeZFx8hE4ppspNhQLIn7XiWKuVgopfFsI');

-- --------------------------------------------------------

--
-- Table structure for table `scheduledetails`
--

DROP TABLE IF EXISTS `scheduledetails`;
CREATE TABLE IF NOT EXISTS `scheduledetails` (
  `scheduleDetail_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `schedule_id` int(10) UNSIGNED DEFAULT NULL,
  `movie_id` int(10) UNSIGNED NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `ticket_price` int(11) NOT NULL,
  `hall_branch_id` int(11) NOT NULL,
  PRIMARY KEY (`scheduleDetail_id`),
  KEY `movie_id` (`movie_id`),
  KEY `schedule_id` (`schedule_id`)
) ENGINE=MyISAM AUTO_INCREMENT=683 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scheduledetails`
--

INSERT INTO `scheduledetails` (`scheduleDetail_id`, `schedule_id`, `movie_id`, `start_time`, `end_time`, `ticket_price`, `hall_branch_id`) VALUES
(1, 1, 1, '2023-02-14 11:45:00', '2023-02-14 01:45:00', 7, 1),
(2, 2, 1, '2023-02-14 01:50:00', '2023-02-14 02:50:00', 7, 1),
(3, 3, 1, '2023-02-14 03:00:00', '2023-02-14 04:00:00', 7, 1),
(4, 4, 1, '2023-02-14 04:15:00', '2023-02-14 05:15:00', 7, 1),
(11, NULL, 1, '2023-02-14 08:30:00', '2023-02-14 11:30:00', 7, 1),
(12, NULL, 10, '2023-02-14 20:10:00', '2023-02-14 23:15:00', 7, 1),
(13, NULL, 10, '2023-02-14 23:45:00', '2023-02-15 02:15:00', 7, 1),
(17, NULL, 10, '2023-02-15 12:30:00', '2023-02-15 14:30:00', 7, 1),
(18, NULL, 1, '2023-03-08 11:30:00', '2023-02-21 02:00:00', 7, 1),
(19, NULL, 1, '2023-03-08 09:00:00', '2023-03-08 00:30:00', 7, 1),
(20, NULL, 1, '2023-03-08 09:00:00', '2023-03-08 12:30:00', 7, 2),
(21, NULL, 1, '2023-08-03 09:00:00', '2023-08-03 12:30:00', 7, 5),
(22, NULL, 1, '2023-02-24 15:00:00', '2023-02-24 17:30:00', 7, 4),
(23, NULL, 24, '2023-02-24 12:40:00', '2023-02-24 14:50:00', 7, 1),
(24, NULL, 24, '2023-02-25 09:00:00', '2023-02-25 11:10:00', 7, 1),
(25, NULL, 24, '2023-02-25 11:40:00', '2023-02-25 01:50:00', 7, 1),
(26, NULL, 24, '2023-02-25 01:10:00', '2023-02-25 04:30:00', 7, 1),
(27, NULL, 24, '2023-02-25 14:30:00', '2023-02-25 16:40:00', 7, 1),
(28, NULL, 24, '2023-02-25 08:30:00', '2023-02-25 02:30:00', 7, 1),
(29, NULL, 24, '2023-02-26 14:00:00', '2023-02-26 16:20:00', 7, 1),
(30, NULL, 1, '2023-02-26 17:00:00', '2023-02-26 19:00:00', 7, 1),
(31, NULL, 24, '2023-02-26 20:30:00', '2023-02-26 22:50:00', 7, 1),
(32, NULL, 24, '2023-02-27 08:20:00', '2023-02-26 10:30:00', 7, 1),
(33, NULL, 24, '2023-02-27 11:00:00', '2023-02-27 13:10:00', 7, 1),
(34, NULL, 24, '2023-02-27 13:40:00', '2023-02-26 15:50:00', 7, 1),
(35, NULL, 24, '2023-02-27 18:00:00', '2023-02-27 20:10:00', 7, 1),
(36, NULL, 24, '2023-02-27 20:40:00', '2023-02-27 22:50:00', 7, 1),
(37, NULL, 24, '2023-02-28 07:10:00', '2023-02-28 09:20:00', 7, 1),
(38, NULL, 24, '2023-02-28 10:00:00', '2023-02-28 12:20:00', 7, 1),
(39, NULL, 24, '2023-02-28 13:00:00', '2023-02-28 15:20:00', 7, 1),
(40, NULL, 24, '2023-02-28 15:50:00', '2023-02-28 18:30:00', 7, 1),
(41, NULL, 24, '2023-02-28 19:00:00', '2023-02-28 21:10:00', 7, 1),
(42, NULL, 24, '2023-02-28 21:40:00', '2023-02-28 23:50:00', 7, 1),
(43, NULL, 24, '2023-03-01 10:00:00', '2023-03-01 00:10:00', 7, 1),
(44, NULL, 24, '2023-03-01 13:30:00', '2023-03-01 15:45:00', 7, 1),
(45, NULL, 24, '2023-03-01 16:20:00', '2023-03-01 18:30:00', 7, 1),
(46, NULL, 24, '2023-03-01 19:00:00', '2023-03-01 21:10:00', 7, 1),
(47, NULL, 1, '2023-03-01 21:40:00', '2023-03-01 23:50:00', 7, 1),
(48, NULL, 24, '2023-03-02 11:00:00', '2023-03-02 13:30:00', 7, 2),
(49, NULL, 24, '2023-03-02 14:00:00', '2023-03-02 16:10:00', 7, 2),
(50, NULL, 24, '2023-03-02 19:00:00', '2023-03-02 21:30:00', 7, 2),
(51, NULL, 24, '2023-03-03 07:30:00', '2023-03-03 09:10:00', 7, 2),
(52, NULL, 1, '2023-03-03 10:30:00', '2023-03-03 12:10:00', 7, 2),
(53, NULL, 24, '2023-03-03 13:30:00', '2023-03-03 15:10:00', 7, 6),
(54, NULL, 24, '2023-03-03 15:40:00', '2023-03-03 17:50:00', 7, 6),
(55, NULL, 24, '2023-03-03 18:30:00', '2023-03-03 20:40:00', 7, 2),
(56, NULL, 24, '2023-03-03 21:20:00', '2023-03-03 23:30:00', 7, 6),
(57, NULL, 1, '2023-03-04 08:00:00', '2023-03-04 10:10:00', 7, 5),
(58, NULL, 24, '2023-03-04 10:40:00', '2023-03-04 12:50:00', 7, 5),
(59, NULL, 24, '2023-03-04 13:30:00', '2023-03-04 15:40:00', 7, 5),
(60, NULL, 24, '2023-03-04 16:20:00', '2023-03-04 18:30:00', 7, 5),
(61, NULL, 24, '2023-03-04 19:00:00', '2023-03-04 21:10:00', 7, 5),
(62, NULL, 24, '2023-03-05 15:00:00', '2023-03-05 19:10:00', 7, 5),
(63, NULL, 24, '2023-03-05 17:40:00', '2023-03-05 19:50:00', 7, 5),
(64, NULL, 24, '2023-03-05 20:30:00', '2023-03-05 22:40:00', 7, 5),
(65, NULL, 24, '2023-03-06 09:10:00', '2023-03-06 11:20:00', 7, 5),
(66, NULL, 24, '2023-03-06 12:30:00', '2023-03-06 14:40:00', 7, 5),
(67, NULL, 24, '2023-03-06 16:00:00', '2023-03-06 18:10:00', 7, 5),
(68, NULL, 24, '2023-03-06 19:00:00', '2023-03-06 21:10:00', 7, 5),
(69, NULL, 24, '2023-03-06 21:40:00', '2023-03-06 23:50:00', 7, 5),
(70, NULL, 24, '2023-03-07 10:30:00', '2023-03-07 12:40:00', 7, 5),
(71, NULL, 24, '2023-03-07 13:30:00', '2023-03-07 15:40:00', 7, 5),
(72, NULL, 24, '2023-03-07 16:20:00', '2023-03-07 18:30:00', 7, 5),
(73, NULL, 24, '2023-03-07 19:40:00', '2023-03-07 22:00:00', 7, 5),
(74, NULL, 24, '2023-03-08 08:40:00', '2023-03-08 10:50:00', 7, 5),
(75, NULL, 24, '2023-03-08 13:00:00', '2023-03-08 15:10:00', 7, 5),
(76, NULL, 24, '2023-03-08 15:40:00', '2023-03-08 17:50:00', 7, 5),
(77, NULL, 24, '2023-03-08 18:30:00', '2023-03-08 20:40:00', 7, 5),
(78, NULL, 24, '2023-03-08 21:30:00', '2023-03-08 23:40:00', 7, 5),
(79, NULL, 24, '2023-03-09 08:10:00', '2023-03-09 10:20:00', 7, 11),
(80, NULL, 24, '2023-03-09 11:30:00', '2023-03-09 13:50:00', 7, 11),
(81, NULL, 24, '2023-03-09 14:00:00', '2023-03-09 16:10:00', 7, 11),
(82, NULL, 24, '2023-03-09 16:30:00', '2023-03-09 18:40:00', 7, 11),
(83, NULL, 24, '2023-03-09 19:00:00', '2023-03-09 21:20:00', 7, 11),
(84, NULL, 24, '2023-03-10 12:30:00', '2023-03-10 15:00:00', 7, 11),
(85, NULL, 24, '2023-03-10 15:30:00', '2023-03-10 20:40:00', 7, 11),
(86, NULL, 24, '2023-03-10 21:00:00', '2023-03-10 23:10:00', 7, 11),
(87, NULL, 1, '2023-03-11 23:00:00', '2023-03-11 13:30:00', 7, 11),
(88, NULL, 24, '2023-03-11 16:00:00', '2023-03-11 18:10:00', 7, 11),
(89, NULL, 24, '2023-03-11 21:00:00', '2023-03-11 13:30:00', 7, 11),
(90, NULL, 24, '2023-03-12 10:30:00', '2023-03-12 12:40:00', 7, 11),
(91, NULL, 24, '2023-03-12 13:00:00', '2023-03-12 15:10:00', 7, 11),
(92, NULL, 24, '2023-03-12 15:30:00', '2023-03-12 17:40:00', 7, 11),
(93, NULL, 24, '2023-03-12 18:00:00', '2023-03-12 20:10:00', 7, 11),
(94, NULL, 24, '2023-03-12 20:30:00', '2023-03-12 22:50:00', 7, 11),
(95, NULL, 24, '2023-03-13 22:00:00', '2023-03-13 12:10:00', 7, 11),
(96, NULL, 24, '2023-03-13 13:30:00', '2023-03-13 15:45:00', 7, 11),
(97, NULL, 25, '2023-03-03 08:10:00', '2023-03-03 10:20:00', 7, 1),
(98, NULL, 25, '2023-03-03 11:30:00', '2023-03-03 01:50:00', 7, 1),
(99, NULL, 25, '2023-03-03 02:00:00', '2023-03-03 16:10:00', 7, 1),
(100, NULL, 25, '2023-03-03 04:30:00', '2023-03-03 18:40:00', 7, 1),
(101, NULL, 25, '2023-03-03 07:00:00', '2023-03-03 21:20:00', 7, 1),
(102, NULL, 25, '2023-03-03 09:40:00', '2023-03-03 23:50:00', 7, 1),
(103, NULL, 25, '2023-03-04 12:30:00', '2023-03-04 15:00:00', 7, 6),
(104, NULL, 25, '2023-03-04 06:20:00', '2023-03-04 20:30:00', 7, 6),
(105, NULL, 25, '2023-03-04 09:00:00', '2023-03-04 23:10:00', 7, 6),
(106, NULL, 25, '2023-03-05 11:00:00', '2023-03-05 13:30:00', 7, 6),
(107, NULL, 25, '2023-03-05 04:00:00', '2023-03-05 18:10:00', 7, 6),
(108, NULL, 25, '2023-03-05 09:00:00', '2023-03-05 23:30:00', 7, 6),
(109, NULL, 25, '2023-03-06 10:30:00', '2023-03-06 12:40:00', 7, 1),
(110, NULL, 25, '2023-03-06 01:00:00', '2023-03-06 15:10:00', 7, 1),
(111, NULL, 25, '2023-03-06 06:00:00', '2023-03-06 20:10:00', 7, 1),
(112, NULL, 25, '2023-03-06 08:30:00', '2023-03-06 22:50:00', 7, 1),
(113, NULL, 25, '2023-03-07 08:40:00', '2023-03-07 10:50:00', 7, 1),
(114, NULL, 25, '2023-03-07 01:00:00', '2023-03-07 15:10:00', 7, 1),
(115, NULL, 25, '2023-03-07 06:30:00', '2023-03-07 20:40:00', 7, 1),
(116, NULL, 25, '2023-03-07 09:30:00', '2023-03-07 23:40:00', 7, 1),
(117, NULL, 25, '2023-03-08 10:30:00', '2023-03-08 12:40:00', 7, 1),
(118, NULL, 25, '2023-03-08 01:30:00', '2023-03-08 15:40:00', 7, 1),
(119, NULL, 25, '2023-03-08 04:20:00', '2023-03-08 18:30:00', 7, 1),
(120, NULL, 25, '2023-03-08 07:40:00', '2023-03-08 22:00:00', 7, 1),
(121, NULL, 25, '2023-03-09 11:00:00', '2023-03-09 13:30:00', 7, 1),
(122, NULL, 25, '2023-03-09 04:00:00', '2023-03-09 18:10:00', 7, 1),
(123, NULL, 25, '2023-03-09 09:00:00', '2023-03-09 23:30:00', 7, 1),
(124, NULL, 25, '2023-03-10 10:00:00', '2023-03-10 12:10:00', 7, 6),
(125, NULL, 25, '2023-03-10 12:40:00', '2023-03-10 14:50:00', 7, 6),
(126, NULL, 25, '2023-03-10 03:30:00', '2023-03-10 17:40:00', 7, 6),
(127, NULL, 25, '2023-03-10 06:00:00', '2023-03-10 20:10:00', 7, 6),
(128, NULL, 25, '2023-03-11 09:30:00', '2023-03-11 12:50:00', 7, 6),
(129, NULL, 25, '2023-03-11 01:30:00', '2023-03-11 16:00:00', 7, 6),
(130, NULL, 25, '2023-03-11 05:00:00', '2023-03-11 19:00:00', 7, 6),
(131, NULL, 25, '2023-03-12 07:30:00', '2023-03-12 09:40:00', 7, 6),
(132, NULL, 25, '2023-03-12 10:30:00', '2023-03-12 12:40:00', 7, 5),
(133, NULL, 25, '2023-03-12 01:40:00', '2023-03-12 15:50:00', 7, 6),
(134, NULL, 25, '2023-03-12 04:30:00', '2023-03-12 18:40:00', 7, 6),
(135, NULL, 25, '2023-03-13 08:00:00', '2023-03-13 10:10:00', 7, 6),
(136, NULL, 25, '2023-03-13 08:00:00', '2023-03-13 10:10:00', 7, 6),
(137, NULL, 25, '2023-03-13 10:40:00', '2023-03-13 12:50:00', 7, 5),
(138, NULL, 25, '2023-03-13 01:30:00', '2023-03-13 15:30:00', 7, 6),
(139, NULL, 1, '2023-03-13 04:00:00', '2023-03-13 18:20:00', 7, 6),
(140, NULL, 25, '2023-03-14 07:30:00', '2023-03-14 09:40:00', 7, 6),
(141, NULL, 25, '2023-03-14 10:00:00', '2023-03-14 12:10:00', 7, 6),
(142, NULL, 25, '2023-03-14 06:00:00', '2023-03-14 20:10:00', 7, 6),
(143, NULL, 25, '2023-03-14 08:40:00', '2023-03-14 22:50:00', 7, 6),
(144, NULL, 25, '2023-03-15 09:00:00', '2023-03-15 11:10:00', 7, 5),
(145, NULL, 25, '2023-03-15 02:30:00', '2023-03-15 16:40:00', 7, 6),
(146, NULL, 25, '2023-03-15 05:20:00', '2023-03-15 19:30:00', 7, 6),
(147, NULL, 25, '2023-03-15 08:30:00', '2023-03-15 23:40:00', 7, 5),
(148, NULL, 25, '2023-03-16 11:30:00', '2023-03-16 13:40:00', 7, 9),
(149, NULL, 25, '2023-03-16 02:00:00', '2023-03-16 16:20:00', 7, 11),
(150, NULL, 25, '2023-03-16 05:00:00', '2023-03-16 19:00:00', 7, 11),
(151, NULL, 25, '2023-03-16 08:30:00', '2023-03-16 22:50:00', 7, 11),
(152, NULL, 25, '2023-03-17 11:30:00', '2023-03-17 13:40:00', 7, 11),
(153, NULL, 25, '2023-03-17 02:00:00', '2023-03-17 16:20:00', 7, 11),
(154, NULL, 25, '2023-03-17 05:10:00', '2023-03-17 19:00:00', 7, 11),
(155, NULL, 25, '2023-03-17 08:30:00', '2023-03-17 22:50:00', 7, 11),
(156, NULL, 25, '2023-03-18 08:20:00', '2023-03-18 10:30:00', 7, 11),
(157, NULL, 25, '2023-03-18 11:10:00', '2023-03-18 13:10:00', 7, 11),
(158, NULL, 25, '2023-03-18 01:40:00', '2023-03-18 15:50:00', 7, 11),
(159, NULL, 25, '2023-03-18 02:30:00', '2023-03-18 16:40:00', 7, 11),
(160, NULL, 25, '2023-03-18 06:00:00', '2023-03-18 20:10:00', 7, 11),
(161, NULL, 25, '2023-03-18 08:40:00', '2023-03-18 22:50:00', 7, 11),
(162, NULL, 25, '2023-03-19 07:10:00', '2023-03-19 09:20:00', 7, 9),
(163, NULL, 25, '2023-03-19 10:00:00', '2023-03-19 12:20:00', 7, 9),
(164, NULL, 25, '2023-03-19 01:00:00', '2023-03-19 15:20:00', 7, 9),
(165, NULL, 25, '2023-03-19 03:50:00', '2023-03-19 18:30:00', 7, 3),
(166, NULL, 25, '2023-03-19 09:40:00', '2023-03-19 23:50:00', 7, 9),
(167, NULL, 25, '2023-03-20 10:00:00', '2023-03-20 12:10:00', 7, 9),
(168, NULL, 25, '2023-03-20 01:30:00', '2023-03-20 15:45:00', 7, 9),
(169, NULL, 25, '2023-03-20 04:20:00', '2023-03-20 18:30:00', 7, 9),
(170, NULL, 25, '2023-03-20 07:00:00', '2023-03-20 21:10:00', 7, 9),
(171, NULL, 31, '2023-03-13 04:20:00', '2023-03-13 18:30:00', 7, 9),
(172, NULL, 24, '2023-03-13 04:20:00', '2023-03-13 18:30:00', 7, 9),
(173, NULL, 24, '2023-03-13 07:00:00', '2023-03-13 21:10:00', 7, 9),
(174, NULL, 24, '2023-03-13 09:40:00', '2023-03-13 23:50:00', 7, 9),
(175, NULL, 24, '2023-03-14 07:10:00', '2023-03-14 09:20:00', 7, 9),
(176, NULL, 24, '2023-03-14 10:00:00', '2023-03-14 12:20:00', 7, 9),
(177, NULL, 24, '2023-03-14 01:00:00', '2023-03-14 15:20:00', 7, 9),
(178, NULL, 24, '2023-03-14 03:50:00', '2023-03-14 18:30:00', 7, 9),
(179, NULL, 24, '2023-03-14 07:00:00', '2023-03-14 21:10:00', 7, 9),
(180, NULL, 24, '2023-03-15 08:20:00', '2023-03-15 10:30:00', 7, 9),
(181, NULL, 24, '2023-03-15 11:00:00', '2023-03-15 13:10:00', 7, 9),
(182, NULL, 24, '2023-03-15 01:40:00', '2023-03-15 15:50:00', 7, 9),
(183, NULL, 24, '2023-03-15 02:30:00', '2023-03-15 16:40:00', 7, 9),
(184, NULL, 24, '2023-03-15 06:00:00', '2023-03-15 20:10:00', 7, 9),
(185, NULL, 24, '2023-03-15 08:40:00', '2023-03-15 22:50:00', 7, 9),
(186, NULL, 24, '2023-03-16 11:30:00', '2023-03-16 13:40:00', 7, 10),
(187, NULL, 24, '2023-03-16 02:00:00', '2023-03-16 16:20:00', 7, 14),
(188, NULL, 24, '2023-03-16 05:00:00', '2023-03-16 19:10:00', 7, 14),
(189, NULL, 24, '2023-03-16 08:30:00', '2023-03-16 22:50:00', 7, 14),
(190, NULL, 24, '2023-03-17 09:00:00', '2023-03-17 11:10:00', 7, 14),
(191, NULL, 24, '2023-03-17 11:40:00', '2023-03-17 13:50:00', 7, 14),
(192, NULL, 24, '2023-03-17 02:30:00', '2023-03-17 16:40:00', 7, 14),
(193, NULL, 24, '2023-03-17 05:20:00', '2023-03-17 19:30:00', 7, 14),
(194, NULL, 24, '2023-03-17 08:30:00', '2023-03-17 22:40:00', 7, 14),
(195, NULL, 24, '2023-03-18 07:30:00', '2023-03-18 21:40:00', 7, 14),
(196, NULL, 24, '2023-03-18 10:00:00', '2023-03-18 12:50:00', 7, 14),
(197, NULL, 24, '2023-03-18 03:20:00', '2023-03-18 17:30:00', 7, 14),
(198, NULL, 24, '2023-03-18 06:00:00', '2023-03-18 20:10:00', 7, 14),
(199, NULL, 24, '2023-03-18 08:40:00', '2023-03-18 22:50:00', 7, 14),
(200, NULL, 24, '2023-03-19 08:00:00', '2023-03-19 10:10:00', 7, 14),
(201, NULL, 24, '2023-03-19 10:40:00', '2023-03-19 12:50:00', 7, 14),
(202, NULL, 24, '2023-03-19 01:30:00', '2023-03-19 15:40:00', 7, 14),
(203, NULL, 24, '2023-03-19 07:00:00', '2023-03-19 21:15:00', 7, 14),
(204, NULL, 24, '2023-03-19 04:00:00', '2023-03-19 18:20:00', 7, 14),
(205, NULL, 24, '2023-03-19 07:00:00', '2023-03-19 21:15:00', 7, 14),
(206, NULL, 24, '2023-03-19 09:40:00', '2023-03-19 23:50:00', 7, 14),
(207, NULL, 24, '2023-03-20 07:30:00', '2023-03-20 09:40:00', 7, 14),
(208, NULL, 24, '2023-03-20 10:30:00', '2023-03-20 12:40:00', 7, 14),
(209, NULL, 24, '2023-03-20 01:40:00', '2023-03-20 15:35:00', 7, 4),
(210, NULL, 24, '2023-03-20 04:30:00', '2023-03-20 18:45:00', 7, 14),
(211, NULL, 24, '2023-03-21 09:30:00', '2023-03-21 12:50:00', 7, 14),
(212, NULL, 24, '2023-03-21 01:30:00', '2023-03-21 16:00:00', 7, 14),
(213, NULL, 24, '2023-03-21 05:30:00', '2023-03-21 20:45:00', 7, 14),
(214, NULL, 24, '2023-03-23 10:00:00', '2023-03-23 12:10:00', 7, 14),
(215, NULL, 24, '2023-03-23 12:40:00', '2023-03-23 14:50:00', 7, 14),
(216, NULL, 24, '2023-03-22 03:30:00', '2023-03-22 17:40:00', 7, 14),
(217, NULL, 24, '2023-03-22 06:00:00', '2023-03-22 20:10:00', 7, 14),
(218, NULL, 25, '2023-03-21 10:40:00', '2023-03-21 12:50:00', 7, 9),
(219, NULL, 25, '2023-03-21 01:30:00', '2023-03-21 15:40:00', 7, 9),
(220, NULL, 25, '2023-03-21 07:00:00', '2023-03-21 21:15:00', 7, 9),
(221, NULL, 25, '2023-03-22 08:40:00', '2023-03-22 22:50:00', 7, 14),
(222, NULL, 25, '2023-03-22 01:00:00', '2023-03-22 15:10:00', 7, 14),
(223, NULL, 25, '2023-03-22 03:40:00', '2023-03-22 17:50:00', 7, 14),
(224, NULL, 25, '2023-03-22 06:30:00', '2023-03-22 20:40:00', 7, 14),
(225, NULL, 25, '2023-03-23 10:30:00', '2023-03-23 12:40:00', 7, 14),
(226, NULL, 25, '2023-03-23 01:30:00', '2023-03-23 15:40:00', 7, 14),
(227, NULL, 25, '2023-03-23 04:20:00', '2023-03-23 18:30:00', 7, 14),
(228, NULL, 25, '2023-03-23 07:40:00', '2023-03-23 22:00:00', 7, 14),
(229, NULL, 25, '2023-03-24 11:00:00', '2023-03-24 13:30:00', 7, 14),
(230, NULL, 25, '2023-03-24 02:00:00', '2023-03-24 16:10:00', 7, 14),
(231, NULL, 25, '2023-03-24 07:00:00', '2023-03-24 21:30:00', 7, 14),
(232, NULL, 25, '2023-03-25 07:30:00', '2023-03-25 09:40:00', 7, 14),
(233, NULL, 25, '2023-03-25 10:00:00', '2023-03-25 12:10:00', 7, 14),
(234, NULL, 25, '2023-03-25 01:00:00', '2023-03-25 15:10:00', 7, 14),
(235, NULL, 25, '2023-03-25 03:40:00', '2023-03-25 17:50:00', 7, 14),
(236, NULL, 25, '2023-03-25 06:30:00', '2023-03-25 20:40:00', 7, 14),
(237, NULL, 25, '2023-03-26 08:00:00', '2023-03-26 10:10:00', 7, 14),
(238, NULL, 25, '2023-03-26 10:40:00', '2023-03-26 12:50:00', 7, 14),
(239, NULL, 25, '2023-03-26 01:30:00', '2023-03-26 15:40:00', 7, 14),
(240, NULL, 25, '2023-03-26 04:20:00', '2023-03-26 18:20:00', 7, 14),
(241, NULL, 25, '2023-03-26 07:00:00', '2023-03-26 21:10:00', 7, 14),
(242, NULL, 25, '2023-03-27 11:30:00', '2023-03-27 13:40:00', 7, 14),
(243, NULL, 25, '2023-03-27 02:00:00', '2023-03-27 16:20:00', 7, 16),
(244, NULL, 25, '2023-03-27 05:00:00', '2023-03-27 19:15:00', 7, 14),
(245, NULL, 25, '2023-03-27 08:30:00', '2023-03-27 22:50:00', 7, 14),
(246, NULL, 25, '2023-03-28 11:30:00', '2023-03-28 13:40:00', 7, 14),
(247, NULL, 25, '2023-03-28 02:00:00', '2023-03-28 16:20:00', 7, 14),
(248, NULL, 25, '2023-03-28 05:00:00', '2023-03-28 19:15:00', 7, 14),
(249, NULL, 25, '2023-03-28 08:30:00', '2023-03-28 22:50:00', 7, 14),
(250, NULL, 26, '2023-03-05 09:30:00', '2023-03-05 12:50:00', 7, 1),
(251, NULL, 26, '2023-03-05 01:30:00', '2023-03-05 15:30:00', 7, 1),
(252, NULL, 26, '2023-03-05 06:00:00', '2023-03-05 21:40:00', 7, 1),
(253, NULL, 26, '2023-03-06 10:20:00', '2023-03-06 14:10:00', 7, 1),
(254, NULL, 26, '2023-03-06 03:00:00', '2023-03-05 18:10:00', 7, 1),
(255, NULL, 26, '2023-03-06 07:40:00', '2023-03-06 22:00:00', 7, 1),
(256, NULL, 26, '2023-03-06 07:30:00', '2023-03-06 23:10:00', 7, 1),
(257, NULL, 26, '2023-03-07 02:50:00', '2023-03-07 18:30:00', 7, 1),
(258, NULL, 26, '2023-03-07 03:00:00', '2023-03-07 22:30:00', 7, 1),
(259, NULL, 26, '2023-03-08 08:20:00', '2023-03-08 11:00:00', 7, 1),
(260, NULL, 26, '2023-03-08 01:40:00', '2023-03-08 16:20:00', 7, 1),
(261, NULL, 26, '2023-03-08 06:00:00', '2023-03-08 20:40:00', 7, 1),
(262, NULL, 26, '2023-03-09 11:30:00', '2023-03-09 14:20:00', 7, 1),
(263, NULL, 26, '2023-03-09 04:30:00', '2023-03-09 19:10:00', 7, 1),
(264, NULL, 26, '2023-03-09 08:40:00', '2023-03-09 23:45:00', 7, 1),
(265, NULL, 26, '2023-03-10 07:10:00', '2023-03-10 09:20:00', 7, 1),
(266, NULL, 26, '2023-03-10 10:00:00', '2023-03-10 12:20:00', 7, 1),
(267, NULL, 26, '2023-03-10 03:50:00', '2023-03-02 16:30:00', 7, 1),
(268, NULL, 26, '2023-03-11 11:00:00', '2023-03-11 14:00:00', 7, 1),
(269, NULL, 26, '2023-03-11 02:00:00', '2023-03-11 16:40:00', 7, 1),
(270, NULL, 26, '2023-03-11 07:00:00', '2023-03-11 21:30:00', 7, 1),
(271, NULL, 26, '2023-03-12 08:00:00', '2023-03-12 11:30:00', 7, 1),
(272, NULL, 26, '2023-03-12 12:30:00', '2023-03-12 16:00:00', 7, 6),
(273, NULL, 26, '2023-03-12 08:40:00', '2023-03-12 23:50:00', 7, 6),
(274, NULL, 26, '2023-03-13 10:30:00', '2023-03-13 14:10:00', 7, 6),
(275, NULL, 26, '2023-03-13 02:30:00', '2023-03-13 18:00:00', 7, 6),
(276, NULL, 26, '2023-03-13 07:00:00', '2023-03-13 22:30:00', 7, 6),
(277, NULL, 26, '2023-03-14 09:00:00', '2023-03-14 12:00:00', 7, 6),
(278, NULL, 26, '2023-03-14 01:00:00', '2023-03-14 16:00:00', 7, 6),
(279, NULL, 26, '2023-03-14 06:00:00', '2023-03-14 21:00:00', 7, 6),
(280, NULL, 26, '2023-03-15 07:30:00', '2023-03-15 11:00:00', 7, 6),
(281, NULL, 26, '2023-03-15 11:30:00', '2023-03-15 15:00:00', 7, 6),
(282, NULL, 26, '2023-03-15 07:30:00', '2023-03-15 23:00:00', 7, 6),
(283, NULL, 26, '2023-03-16 11:00:00', '2023-03-16 14:40:00', 7, 6),
(284, NULL, 26, '2023-03-16 03:30:00', '2023-03-16 19:00:00', 7, 6),
(285, NULL, 26, '2023-03-16 08:00:00', '2023-03-16 23:30:00', 7, 6),
(286, NULL, 26, '2023-03-17 08:00:00', '2023-03-17 11:30:00', 7, 6),
(287, NULL, 26, '2023-03-17 11:30:00', '2023-03-17 15:00:00', 7, 6),
(288, NULL, 26, '2023-03-17 07:00:00', '2023-03-17 22:30:00', 7, 6),
(289, NULL, 26, '2023-03-18 02:00:00', '2023-03-18 17:15:00', 7, 6),
(290, NULL, 26, '2023-03-18 06:30:00', '2023-03-18 22:10:00', 7, 6),
(291, NULL, 26, '2023-03-19 07:10:00', '2023-03-19 09:50:00', 7, 9),
(292, NULL, 26, '2023-03-19 10:00:00', '2023-03-19 13:00:00', 7, 9),
(293, NULL, 26, '2023-03-19 02:00:00', '2023-03-19 17:10:00', 7, 9),
(294, NULL, 26, '2023-03-19 07:30:00', '2023-03-19 22:30:00', 7, 9),
(295, NULL, 26, '2023-03-20 11:00:00', '2023-03-20 14:40:00', 7, 9),
(296, NULL, 26, '2023-03-20 03:30:00', '2023-03-20 19:00:00', 7, 9),
(297, NULL, 26, '2023-03-20 08:00:00', '2023-03-20 23:30:00', 7, 9),
(298, NULL, 26, '2023-03-21 10:20:00', '2023-03-21 14:10:00', 7, 9),
(299, NULL, 26, '2023-03-21 02:10:00', '2023-03-21 17:50:00', 7, 9),
(300, NULL, 26, '2023-03-21 07:40:00', '2023-03-21 23:10:00', 7, 9),
(301, NULL, 26, '2023-03-22 10:30:00', '2023-03-22 14:15:00', 7, 9),
(302, NULL, 26, '2023-03-22 08:00:00', '2023-03-22 23:50:00', 7, 9),
(303, NULL, 26, '2023-03-23 07:30:00', '2023-03-23 11:10:00', 7, 9),
(304, NULL, 26, '2023-03-23 02:50:00', '2023-03-23 18:30:00', 7, 9),
(305, NULL, 26, '2023-03-23 07:00:00', '2023-03-23 22:30:00', 7, 9),
(306, NULL, 26, '2023-03-24 08:20:00', '2023-03-24 11:30:00', 7, 9),
(307, NULL, 26, '2023-03-24 01:40:00', '2023-03-24 16:20:00', 7, 9),
(308, NULL, 26, '2023-03-24 06:00:00', '2023-03-24 20:40:00', 7, 9),
(309, NULL, 26, '2023-03-25 09:00:00', '2023-03-25 12:40:00', 7, 9),
(310, NULL, 26, '2023-03-25 01:00:00', '2023-03-25 16:30:00', 7, 9),
(311, NULL, 26, '2023-03-25 06:00:00', '2023-03-25 21:30:00', 7, 9),
(312, NULL, 26, '2023-03-26 07:30:00', '2023-03-26 11:10:00', 7, 14),
(313, NULL, 26, '2023-03-26 02:50:00', '2023-03-26 18:30:00', 7, 14),
(314, NULL, 26, '2023-03-26 07:00:00', '2023-03-26 22:30:00', 7, 14),
(315, NULL, 26, '2023-03-27 10:20:00', '2023-03-27 14:00:00', 7, 14),
(316, NULL, 26, '2023-03-27 03:00:00', '2023-03-27 18:40:00', 7, 14),
(317, NULL, 26, '2023-03-27 07:30:00', '2023-03-27 22:30:00', 7, 14),
(318, NULL, 26, '2023-03-28 10:00:00', '2023-03-28 12:51:00', 7, 14),
(319, NULL, 26, '2023-03-28 03:50:00', '2023-03-28 19:00:00', 7, 14),
(320, NULL, 26, '2023-03-28 07:30:00', '2023-03-28 23:00:00', 7, 14),
(321, NULL, 26, '2023-03-29 08:20:00', '2023-03-29 11:00:00', 7, 14),
(322, NULL, 26, '2023-03-29 01:40:00', '2023-03-29 16:20:00', 7, 14),
(323, NULL, 26, '2023-03-29 02:30:00', '2023-03-29 16:40:00', 7, 14),
(324, NULL, 26, '2023-03-29 06:00:00', '2023-03-29 20:40:00', 7, 14),
(325, NULL, 26, '2023-03-30 09:00:00', '2023-03-30 12:30:00', 7, 14),
(326, NULL, 26, '2023-03-30 01:00:00', '2023-03-30 16:30:00', 7, 14),
(327, NULL, 26, '2023-03-30 06:00:00', '2023-03-30 21:30:00', 7, 14),
(328, NULL, 26, '2023-03-31 11:00:00', '2023-03-31 14:00:00', 7, 14),
(329, NULL, 26, '2023-03-31 03:00:00', '2023-03-31 17:40:00', 7, 14),
(330, NULL, 26, '2023-03-31 07:00:00', '2023-03-31 22:00:00', 7, 14),
(331, NULL, 26, '2023-04-01 10:30:00', '2023-04-01 14:10:00', 7, 14),
(332, NULL, 26, '2023-04-01 04:30:00', '2023-04-01 20:00:00', 7, 14),
(333, NULL, 26, '2023-04-01 08:40:00', '2023-04-01 23:50:00', 7, 14),
(334, NULL, 27, '2023-03-06 11:30:00', '2023-03-06 13:40:00', 7, 1),
(335, NULL, 27, '2023-03-06 02:00:00', '2023-03-06 16:20:00', 7, 1),
(336, NULL, 27, '2023-03-06 05:00:00', '2023-03-06 19:00:00', 7, 1),
(337, NULL, 27, '2023-03-06 08:30:00', '2023-03-06 22:50:00', 7, 1),
(338, NULL, 27, '2023-03-07 09:00:00', '2023-03-07 11:10:00', 7, 1),
(339, NULL, 27, '2023-03-07 11:40:00', '2023-03-07 13:50:00', 7, 1),
(340, NULL, 27, '2023-03-07 02:20:00', '2023-03-07 16:40:00', 7, 1),
(341, NULL, 27, '2023-03-07 05:20:00', '2023-03-07 19:30:00', 7, 1),
(342, NULL, 1, '2023-03-07 08:30:00', '2023-03-07 22:40:00', 7, 1),
(343, NULL, 27, '2023-03-08 07:30:00', '2023-03-08 21:40:00', 7, 1),
(344, NULL, 27, '2023-03-08 10:00:00', '2023-03-08 12:10:00', 7, 1),
(345, NULL, 1, '2023-03-08 12:40:00', '2023-03-08 14:50:00', 7, 1),
(346, NULL, 27, '2023-03-08 08:40:00', '2023-03-08 22:50:00', 7, 1),
(347, NULL, 27, '2023-03-09 08:00:00', '2023-03-09 22:10:00', 7, 1),
(348, NULL, 1, '2023-03-09 10:40:00', '2023-03-09 12:50:00', 7, 1),
(349, NULL, 27, '2023-03-09 01:30:00', '2023-03-09 15:40:00', 7, 1),
(350, NULL, 1, '2023-03-09 04:00:00', '2023-03-09 18:20:00', 7, 1),
(351, NULL, 1, '2023-03-09 09:40:00', '2023-03-09 23:50:00', 7, 1),
(352, NULL, 27, '2023-03-10 07:30:00', '2023-03-10 09:40:00', 7, 6),
(353, NULL, 27, '2023-03-10 10:30:00', '2023-03-10 12:40:00', 7, 6),
(354, NULL, 27, '2023-03-10 01:40:00', '2023-03-10 15:50:00', 7, 6),
(355, NULL, 27, '2023-03-10 04:30:00', '2023-03-10 18:40:00', 7, 6),
(356, NULL, 27, '2023-03-11 09:30:00', '2023-03-11 12:50:00', 7, 6),
(357, NULL, 27, '2023-03-11 01:30:00', '2023-03-11 16:00:00', 7, 6),
(358, NULL, 27, '2023-03-12 10:00:00', '2023-03-12 12:57:00', 7, 6),
(359, NULL, 27, '2023-03-12 12:40:00', '2023-03-12 14:50:00', 7, 6),
(360, NULL, 27, '2023-03-12 03:30:00', '2023-03-12 17:40:00', 7, 6),
(361, NULL, 27, '2023-03-12 06:00:00', '2023-03-12 20:10:00', 7, 6),
(362, NULL, 27, '2023-03-13 09:00:00', '2023-03-13 23:10:00', 7, 9),
(363, NULL, 27, '2023-03-13 09:00:00', '2023-03-13 23:10:00', 7, 9),
(364, NULL, 27, '2023-03-14 11:00:00', '2023-03-14 13:30:00', 7, 9),
(365, NULL, 27, '2023-03-14 04:00:00', '2023-03-14 18:10:00', 7, 3),
(366, NULL, 27, '2023-03-14 09:00:00', '2023-03-14 23:30:00', 7, 3),
(367, NULL, 27, '2023-03-15 10:30:00', '2023-03-15 12:40:00', 7, 9),
(368, NULL, 27, '2023-03-15 01:00:00', '2023-03-15 15:10:00', 7, 9),
(369, NULL, 27, '2023-03-15 08:30:00', '2023-03-15 22:50:00', 7, 14),
(370, NULL, 27, '2023-03-16 08:40:00', '2023-03-16 10:50:00', 7, 14),
(371, NULL, 27, '2023-03-16 01:00:00', '2023-03-16 15:10:00', 7, 14),
(372, NULL, 27, '2023-03-16 09:30:00', '2023-03-16 23:40:00', 7, 14),
(373, NULL, 27, '2023-03-17 10:30:00', '2023-03-17 12:40:00', 7, 14),
(374, NULL, 27, '2023-03-17 01:30:00', '2023-03-17 15:40:00', 7, 14),
(375, NULL, 27, '2023-03-17 04:20:00', '2023-03-17 18:30:00', 7, 14),
(376, NULL, 27, '2023-03-17 07:40:00', '2023-03-17 22:00:00', 7, 14),
(377, NULL, 27, '2023-03-18 11:00:00', '2023-03-18 13:30:00', 7, 16),
(378, NULL, 27, '2023-03-18 04:00:00', '2023-03-18 18:10:00', 7, 14),
(379, NULL, 27, '2023-03-18 09:00:00', '2023-03-18 23:30:00', 7, 14),
(380, NULL, 22, '2023-03-09 11:30:00', '2023-03-09 13:40:00', 7, 1),
(381, NULL, 22, '2023-03-09 02:00:00', '2023-03-09 16:20:00', 7, 1),
(382, NULL, 27, '2023-03-09 08:30:00', '2023-03-09 23:50:00', 7, 1),
(383, NULL, 22, '2023-03-10 09:30:00', '2023-03-10 23:40:00', 7, 1),
(384, NULL, 22, '2023-03-10 02:00:00', '2023-03-10 16:20:00', 7, 1),
(385, NULL, 22, '2023-03-10 08:30:00', '2023-03-10 22:50:00', 7, 1),
(386, NULL, 22, '2023-03-11 08:20:00', '2023-03-11 10:30:00', 7, 1),
(387, NULL, 22, '2023-03-11 01:40:00', '2023-03-11 15:50:00', 7, 1),
(388, NULL, 22, '2023-03-11 08:40:00', '2023-03-11 22:50:00', 7, 6),
(389, NULL, 22, '2023-03-12 07:10:00', '2023-03-12 09:20:00', 7, 6),
(390, NULL, 22, '2023-03-12 10:00:00', '2023-03-12 12:20:00', 7, 6),
(391, NULL, 22, '2023-03-12 09:40:00', '2023-03-12 23:50:00', 7, 6),
(392, NULL, 22, '2023-03-13 01:30:00', '2023-03-13 15:45:00', 7, 6),
(393, NULL, 22, '2023-03-13 07:00:00', '2023-03-13 21:10:00', 7, 6),
(394, NULL, 22, '2023-03-14 08:00:00', '2023-03-14 10:10:00', 7, 6),
(395, NULL, 22, '2023-03-14 10:40:00', '2023-03-14 12:50:00', 7, 6),
(396, NULL, 22, '2023-03-14 01:30:00', '2023-03-14 15:40:00', 7, 6),
(397, NULL, 22, '2023-03-14 07:00:00', '2023-03-14 21:15:00', 7, 6),
(398, NULL, 22, '2023-03-15 08:40:00', '2023-03-15 22:50:00', 7, 9),
(399, NULL, 22, '2023-03-15 01:00:00', '2023-03-15 15:10:00', 7, 9),
(400, NULL, 22, '2023-03-15 06:30:00', '2023-03-15 20:40:00', 7, 9),
(401, NULL, 22, '2023-03-16 10:30:00', '2023-03-16 12:40:00', 7, 3),
(402, NULL, 22, '2023-03-16 01:30:00', '2023-03-16 15:40:00', 7, 9),
(403, NULL, 22, '2023-03-16 04:20:00', '2023-03-16 18:30:00', 7, 9),
(404, NULL, 22, '2023-03-17 11:00:00', '2023-03-17 13:30:00', 7, 9),
(405, NULL, 22, '2023-03-17 02:00:00', '2023-03-17 16:10:00', 7, 9),
(406, NULL, 1, '2023-03-17 07:00:00', '2023-03-17 21:30:00', 7, 9),
(407, NULL, 22, '2023-03-18 07:30:00', '2023-03-18 09:40:00', 7, 9),
(408, NULL, 22, '2023-03-18 10:00:00', '2023-03-18 12:10:00', 7, 9),
(409, NULL, 22, '2023-03-18 01:00:00', '2023-03-18 15:10:00', 7, 9),
(410, NULL, 22, '2023-03-18 03:40:00', '2023-03-18 17:50:00', 7, 14),
(411, NULL, 22, '2023-03-19 08:00:00', '2023-03-19 10:10:00', 7, 14),
(412, NULL, 22, '2023-03-19 10:40:00', '2023-03-19 12:50:00', 7, 14),
(413, NULL, 22, '2023-03-19 01:30:00', '2023-03-19 15:40:00', 7, 14),
(414, NULL, 22, '2023-03-19 08:30:00', '2023-03-19 22:50:00', 7, 14),
(415, NULL, 22, '2023-03-20 11:30:00', '2023-03-20 13:40:00', 7, 14),
(416, NULL, 22, '2023-03-20 02:00:00', '2023-03-20 21:20:00', 7, 14),
(417, NULL, 22, '2023-03-20 05:00:00', '2023-03-20 19:00:00', 7, 14),
(418, NULL, 22, '2023-03-21 11:30:00', '2023-03-21 13:40:00', 7, 14),
(419, NULL, 22, '2023-03-21 02:00:00', '2023-03-21 16:20:00', 7, 14),
(420, NULL, 22, '2023-03-21 08:30:00', '2023-03-21 22:50:00', 7, 14),
(421, NULL, 30, '2023-03-07 10:00:00', '2023-03-07 12:10:00', 7, 1),
(422, NULL, 30, '2023-03-07 12:40:00', '2023-03-07 14:50:00', 7, 1),
(423, NULL, 30, '2023-03-07 06:00:00', '2023-03-07 20:10:00', 7, 1),
(424, NULL, 30, '2023-03-08 09:30:00', '2023-03-08 12:50:00', 7, 1),
(425, NULL, 30, '2023-03-08 01:30:00', '2023-03-08 16:00:00', 7, 6),
(426, NULL, 30, '2023-03-08 05:00:00', '2023-03-08 20:00:00', 7, 6),
(427, NULL, 30, '2023-03-09 07:30:00', '2023-03-09 21:40:00', 7, 6),
(428, NULL, 30, '2023-03-09 10:30:00', '2023-03-09 12:40:00', 7, 9),
(429, NULL, 30, '2023-03-09 04:30:00', '2023-03-09 18:40:00', 7, 9),
(430, NULL, 30, '2023-03-10 08:00:00', '2023-03-10 10:10:00', 7, 9),
(431, NULL, 30, '2023-03-10 10:40:00', '2023-03-10 12:50:00', 7, 9),
(432, NULL, 30, '2023-03-10 07:00:00', '2023-03-10 21:15:00', 7, 9),
(433, NULL, 30, '2023-03-11 07:30:00', '2023-03-11 09:40:00', 7, 14),
(434, NULL, 30, '2023-03-11 10:00:00', '2023-03-11 12:10:00', 7, 14),
(435, NULL, 30, '2023-03-11 08:40:00', '2023-03-11 22:50:00', 7, 14),
(436, NULL, 30, '2023-03-12 09:00:00', '2023-03-12 11:10:00', 7, 14),
(437, NULL, 30, '2023-03-12 02:30:00', '2023-03-12 16:40:00', 7, 14),
(438, NULL, 30, '2023-03-12 05:20:00', '2023-03-12 19:30:00', 7, 14),
(439, NULL, 30, '2023-03-12 08:30:00', '2023-03-12 22:45:00', 7, 14),
(440, NULL, 29, '2023-03-08 09:30:00', '2023-03-08 12:50:00', 7, 1),
(441, NULL, 29, '2023-03-08 01:30:00', '2023-03-08 16:00:00', 7, 1),
(442, NULL, 29, '2023-03-08 05:00:00', '2023-03-08 20:00:00', 7, 1),
(443, NULL, 29, '2023-03-09 10:20:00', '2023-03-09 13:30:00', 7, 1),
(444, NULL, 29, '2023-03-09 02:00:00', '2023-03-09 17:10:00', 7, 6),
(445, NULL, 29, '2023-03-09 05:40:00', '2023-03-09 20:50:00', 7, 6),
(446, NULL, 29, '2023-03-10 07:30:00', '2023-03-10 22:40:00', 7, 6),
(447, NULL, 29, '2023-03-10 02:50:00', '2023-03-10 18:00:00', 7, 6),
(448, NULL, 29, '2023-03-10 07:00:00', '2023-03-10 22:00:00', 7, 6),
(449, NULL, 29, '2023-03-11 08:20:00', '2023-03-11 10:30:00', 7, 6),
(450, NULL, 29, '2023-03-11 01:40:00', '2023-03-11 15:50:00', 7, 9),
(451, NULL, 29, '2023-03-12 11:30:00', '2023-03-12 13:40:00', 7, 9),
(452, NULL, 29, '2023-03-12 02:00:00', '2023-03-12 16:20:00', 7, 9),
(453, NULL, 29, '2023-03-12 05:00:00', '2023-03-12 19:15:00', 7, 9),
(454, NULL, 29, '2023-03-13 11:30:00', '2023-03-13 10:30:00', 7, 9),
(455, NULL, 29, '2023-03-13 02:00:00', '2023-03-13 16:20:00', 7, 9),
(456, NULL, 29, '2023-03-14 08:20:00', '2023-03-14 10:30:00', 7, 14),
(457, NULL, 29, '2023-03-14 01:40:00', '2023-03-14 15:50:00', 7, 14),
(458, NULL, 29, '2023-03-14 06:00:00', '2023-03-14 20:10:00', 7, 14),
(459, NULL, 10, '2023-03-06 11:30:00', '2023-03-06 13:50:00', 7, 1),
(460, NULL, 10, '2023-03-06 04:30:00', '2023-03-06 18:40:00', 7, 1),
(461, NULL, 10, '2023-03-06 07:00:00', '2023-03-02 21:20:00', 7, 1),
(462, NULL, 10, '2023-03-07 12:30:00', '2023-03-07 15:00:00', 7, 1),
(463, NULL, 10, '2023-03-07 06:20:00', '2023-03-07 09:00:00', 7, 1),
(464, NULL, 10, '2023-03-07 09:00:00', '2023-03-07 23:10:00', 7, 1),
(465, NULL, 10, '2023-03-08 11:00:00', '2023-03-08 13:30:00', 7, 6),
(466, NULL, 10, '2023-03-08 04:00:00', '2023-03-08 18:10:00', 7, 11),
(467, NULL, 10, '2023-03-08 09:00:00', '2023-03-08 23:30:00', 7, 6),
(468, NULL, 10, '2023-03-08 10:30:00', '2023-03-08 12:40:00', 7, 9),
(469, NULL, 10, '2023-03-09 03:30:00', '2023-03-09 17:40:00', 7, 9),
(470, NULL, 10, '2023-03-09 08:30:00', '2023-03-09 22:50:00', 7, 9),
(471, NULL, 10, '2023-03-10 10:00:00', '2023-03-10 12:10:00', 7, 9),
(472, NULL, 10, '2023-03-10 04:20:00', '2023-03-10 18:45:00', 7, 9),
(473, NULL, 10, '2023-03-11 07:10:00', '2023-03-10 21:20:00', 7, 14),
(474, NULL, 10, '2023-03-11 10:00:00', '2023-03-11 12:20:00', 7, 14),
(475, NULL, 10, '2023-03-11 01:00:00', '2023-03-11 15:20:00', 7, 14),
(476, NULL, 10, '2023-03-11 09:40:00', '2023-03-11 23:50:00', 7, 14),
(477, NULL, 10, '2023-03-12 08:20:00', '2023-03-12 10:30:00', 7, 14),
(478, NULL, 10, '2023-03-12 11:00:00', '2023-03-12 13:10:00', 7, 14),
(479, NULL, 10, '2023-03-12 02:30:00', '2023-03-12 16:40:00', 7, 14),
(480, NULL, 10, '2023-03-12 08:40:00', '2023-03-12 22:50:00', 7, 14),
(481, NULL, 14, '2023-03-07 10:00:00', '2023-03-07 00:10:00', 7, 1),
(482, NULL, 14, '2023-03-07 12:40:00', '2023-03-07 14:50:00', 7, 1),
(483, NULL, 14, '2023-03-07 06:00:00', '2023-03-07 20:10:00', 7, 1),
(484, NULL, 10, '2023-03-08 09:30:00', '2023-03-08 12:50:00', 7, 1),
(485, NULL, 10, '2023-03-08 01:30:00', '2023-03-08 16:00:00', 7, 1),
(486, NULL, 10, '2023-03-08 05:00:00', '2023-03-08 20:00:00', 7, 1),
(487, NULL, 14, '2023-03-09 07:30:00', '2023-03-09 09:40:00', 7, 11),
(488, NULL, 14, '2023-03-09 10:30:00', '2023-03-09 12:40:00', 7, 6),
(489, NULL, 10, '2023-03-09 04:30:00', '2023-03-09 18:40:00', 7, 6),
(490, NULL, 14, '2023-03-10 08:00:00', '2023-03-10 10:10:00', 7, 6),
(491, NULL, 10, '2023-03-10 10:40:00', '2023-03-10 12:50:00', 7, 6),
(492, NULL, 10, '2023-03-10 04:00:00', '2023-03-10 18:20:00', 7, 9),
(493, NULL, 14, '2023-03-11 07:30:00', '2023-03-11 09:40:00', 7, 9),
(494, NULL, 14, '2023-03-11 10:00:00', '2023-03-11 12:10:00', 7, 9),
(495, NULL, 14, '2023-03-11 06:00:00', '2023-03-11 20:10:00', 7, 9),
(496, NULL, 14, '2023-03-11 08:40:00', '2023-03-11 22:50:00', 7, 9),
(497, NULL, 14, '2023-03-12 11:40:00', '2023-03-12 13:50:00', 7, 14),
(498, NULL, 14, '2023-03-12 02:30:00', '2023-03-12 16:40:00', 7, 14),
(499, NULL, 14, '2023-03-12 05:20:00', '2023-03-12 19:30:00', 7, 14),
(500, NULL, 14, '2023-03-12 08:30:00', '2023-03-12 22:40:00', 7, 14),
(501, NULL, 31, '2023-03-06 08:40:00', '2023-03-06 10:50:00', 7, 1),
(502, NULL, 31, '2023-03-06 01:00:00', '2023-03-06 15:10:00', 7, 1),
(503, NULL, 31, '2023-03-06 03:40:00', '2023-03-06 17:50:00', 7, 1),
(504, NULL, 31, '2023-03-06 06:30:00', '2023-03-06 20:40:00', 7, 1),
(505, NULL, 31, '2023-03-07 10:30:00', '2023-03-07 12:40:00', 7, 1),
(506, NULL, 31, '2023-03-07 01:30:00', '2023-03-07 15:40:00', 7, 6),
(507, NULL, 31, '2023-03-07 04:20:00', '2023-03-07 18:30:00', 7, 6),
(508, NULL, 31, '2023-03-07 07:40:00', '2023-03-07 22:00:00', 7, 6),
(509, NULL, 31, '2023-03-08 11:00:00', '2023-03-08 13:30:00', 7, 6),
(510, NULL, 31, '2023-03-08 02:00:00', '2023-03-08 16:10:00', 7, 6),
(511, NULL, 31, '2023-03-08 07:00:00', '2023-03-08 21:30:00', 7, 6),
(512, NULL, 31, '2023-03-09 07:30:00', '2023-03-09 09:40:00', 7, 6),
(513, NULL, 31, '2023-03-09 10:00:00', '2023-03-09 12:10:00', 7, 6),
(514, NULL, 31, '2023-03-09 01:00:00', '2023-03-09 15:10:00', 7, 2),
(515, NULL, 31, '2023-03-09 06:30:00', '2023-03-09 20:40:00', 7, 9),
(516, NULL, 31, '2023-03-10 08:00:00', '2023-03-10 10:10:00', 7, 9),
(517, NULL, 31, '2023-03-10 10:40:00', '2023-03-10 12:50:00', 7, 9),
(518, NULL, 31, '2023-03-10 01:30:00', '2023-03-10 15:40:00', 7, 9),
(519, NULL, 31, '2023-03-10 04:20:00', '2023-03-10 18:30:00', 7, 9),
(520, NULL, 31, '2023-03-10 07:00:00', '2023-03-10 21:10:00', 7, 9),
(521, NULL, 31, '2023-03-11 02:00:00', '2023-03-11 16:20:00', 7, 9),
(522, NULL, 31, '2023-03-11 11:30:00', '2023-03-11 13:40:00', 7, 9),
(523, NULL, 31, '2023-03-12 11:30:00', '2023-03-12 13:40:00', 7, 14),
(524, NULL, 31, '2023-03-12 02:00:00', '2023-03-12 16:20:00', 7, 14),
(525, NULL, 31, '2023-03-12 05:00:00', '2023-03-12 19:00:00', 7, 14),
(526, NULL, 31, '2023-03-12 08:30:00', '2023-03-12 22:50:00', 7, 14),
(527, NULL, 18, '2023-03-06 08:40:00', '2023-03-06 10:50:00', 7, 1),
(528, NULL, 18, '2023-03-06 01:00:00', '2023-03-06 15:10:00', 7, 1),
(529, NULL, 18, '2023-03-06 06:30:00', '2023-03-06 20:40:00', 7, 1),
(530, NULL, 18, '2023-03-07 10:30:00', '2023-03-07 00:40:00', 7, 1),
(531, NULL, 18, '2023-03-07 01:30:00', '2023-03-07 15:40:00', 7, 1),
(532, NULL, 18, '2023-03-07 04:20:00', '2023-03-07 18:30:00', 7, 6),
(533, NULL, 18, '2023-03-08 11:00:00', '2023-03-08 13:30:00', 7, 6),
(534, NULL, 18, '2023-03-09 02:00:00', '2023-03-08 16:10:00', 7, 6),
(535, NULL, 18, '2023-03-08 07:00:00', '2023-03-08 21:30:00', 7, 6),
(536, NULL, 18, '2023-03-07 07:30:00', '2023-03-07 09:40:00', 7, 6),
(537, NULL, 18, '2023-03-09 10:00:00', '2023-03-09 12:10:00', 7, 2),
(538, NULL, 18, '2023-03-09 01:00:00', '2023-03-09 15:10:00', 7, 9),
(539, NULL, 18, '2023-03-09 03:40:00', '2023-03-09 17:50:00', 7, 9),
(540, NULL, 18, '2023-03-10 08:00:00', '2023-03-10 10:10:00', 7, 12),
(541, NULL, 18, '2023-03-10 10:40:00', '2023-03-10 12:50:00', 7, 9),
(542, NULL, 18, '2023-03-10 01:30:00', '2023-03-10 15:40:00', 7, 9),
(543, NULL, 18, '2023-03-10 08:30:00', '2023-03-10 22:50:00', 7, 9),
(544, NULL, 18, '2023-03-11 11:30:00', '2023-03-11 13:40:00', 7, 9),
(545, NULL, 18, '2023-03-11 02:00:00', '2023-03-11 16:20:00', 7, 14),
(546, NULL, 18, '2023-03-11 05:00:00', '2023-03-11 19:00:00', 7, 14),
(547, NULL, 18, '2023-03-12 11:30:00', '2023-03-12 13:40:00', 7, 14),
(548, NULL, 18, '2023-03-12 02:30:00', '2023-03-03 16:50:00', 7, 14),
(549, NULL, 18, '2023-03-12 02:30:00', '2023-03-12 16:50:00', 7, 14),
(550, NULL, 18, '2023-03-12 08:30:00', '2023-03-12 22:50:00', 7, 14),
(551, NULL, 19, '2023-03-06 07:30:00', '2023-03-06 13:30:00', 7, 1),
(552, NULL, 19, '2023-03-06 02:00:00', '2023-03-06 16:10:00', 7, 1),
(553, NULL, 19, '2023-03-06 07:00:00', '2023-03-06 21:30:00', 7, 1),
(554, NULL, 19, '2023-03-07 08:00:00', '2023-03-07 22:10:00', 7, 1),
(555, NULL, 19, '2023-03-07 10:40:00', '2023-03-07 12:50:00', 7, 6),
(556, NULL, 19, '2023-03-07 01:30:00', '2023-03-07 15:40:00', 7, 6),
(557, NULL, 19, '2023-03-07 04:20:00', '2023-03-07 18:30:00', 7, 6),
(558, NULL, 19, '2023-03-07 07:00:00', '2023-03-07 21:10:00', 7, 6),
(559, NULL, 19, '2023-03-08 03:00:00', '2023-03-08 17:10:00', 7, 6),
(560, NULL, 19, '2023-03-08 05:40:00', '2023-03-08 19:50:00', 7, 6),
(561, NULL, 19, '2023-03-08 08:30:00', '2023-03-08 22:40:00', 7, 9),
(562, NULL, 19, '2023-03-09 09:10:00', '2023-03-09 11:20:00', 7, 9),
(563, NULL, 19, '2023-03-09 12:30:00', '2023-03-09 14:40:00', 7, 9),
(564, NULL, 19, '2023-03-09 04:00:00', '2023-03-09 18:10:00', 7, 9),
(565, NULL, 19, '2023-03-09 07:00:00', '2023-03-09 21:10:00', 7, 9),
(566, NULL, 19, '2023-03-09 09:40:00', '2023-03-09 23:50:00', 7, 9),
(567, NULL, 19, '2023-03-10 10:30:00', '2023-03-10 12:40:00', 7, 12),
(568, NULL, 19, '2023-03-10 01:30:00', '2023-03-10 15:40:00', 7, 9),
(569, NULL, 19, '2023-03-10 04:20:00', '2023-03-10 18:30:00', 7, 9),
(570, NULL, 19, '2023-03-10 07:40:00', '2023-03-10 22:00:00', 7, 9),
(571, NULL, 19, '2023-03-11 07:30:00', '2023-03-11 10:50:00', 7, 9),
(572, NULL, 19, '2023-03-11 01:00:00', '2023-03-11 15:10:00', 7, 9),
(573, NULL, 19, '2023-03-11 03:40:00', '2023-03-11 17:50:00', 7, 9),
(574, NULL, 19, '2023-03-11 06:30:00', '2023-03-11 20:40:00', 7, 14),
(575, NULL, 19, '2023-03-11 09:30:00', '2023-03-11 23:40:00', 7, 14),
(576, NULL, 19, '2023-03-12 07:30:00', '2023-03-12 09:40:00', 7, 14),
(577, NULL, 19, '2023-03-12 01:00:00', '2023-03-12 15:10:00', 7, 14),
(578, NULL, 19, '2023-03-12 10:00:00', '2023-03-12 12:10:00', 7, 14),
(579, NULL, 19, '2023-03-12 03:40:00', '2023-03-12 17:50:00', 7, 14),
(580, NULL, 19, '2023-03-12 06:30:00', '2023-03-12 20:40:00', 7, 14),
(581, NULL, 19, '2023-03-12 09:20:00', '2023-03-12 23:30:00', 7, 14),
(582, NULL, 15, '2023-03-06 08:10:00', '2023-03-06 10:20:00', 7, 1),
(583, NULL, 15, '2023-03-06 11:30:00', '2023-03-06 01:50:00', 7, 1),
(584, NULL, 15, '2023-03-06 02:00:00', '2023-03-06 16:10:00', 7, 1),
(585, NULL, 15, '2023-03-06 04:30:00', '2023-03-06 18:40:00', 7, 1),
(586, NULL, 15, '2023-03-07 12:30:00', '2023-03-07 15:00:00', 7, 1),
(587, NULL, 15, '2023-03-07 03:30:00', '2023-03-07 20:40:00', 7, 1),
(588, NULL, 1, '2023-03-07 06:20:00', '2023-03-07 20:30:00', 7, 1),
(589, NULL, 15, '2023-03-07 09:00:00', '2023-03-07 23:10:00', 7, 1),
(590, NULL, 15, '2023-03-08 11:00:00', '2023-03-08 13:30:00', 7, 6),
(591, NULL, 15, '2023-03-04 04:00:00', '2023-03-08 18:10:00', 7, 6),
(592, NULL, 15, '2023-03-08 09:21:00', '2023-03-08 23:30:00', 7, 6),
(593, NULL, 15, '2023-03-09 10:30:00', '2023-03-09 12:40:00', 7, 5),
(594, NULL, 15, '2023-03-09 01:00:00', '2023-03-09 15:10:00', 7, 2),
(595, NULL, 15, '2023-03-09 03:30:00', '2023-03-09 17:40:00', 7, 6),
(596, NULL, 15, '2023-03-09 06:00:00', '2023-03-09 08:10:00', 7, 6),
(597, NULL, 15, '2023-03-09 08:30:00', '2023-03-09 22:50:00', 7, 1),
(598, NULL, 15, '2023-03-09 08:30:00', '2023-03-09 23:00:00', 7, 6),
(599, NULL, 15, '2023-03-10 10:00:00', '2023-03-10 12:10:00', 7, 6),
(600, NULL, 15, '2023-03-10 01:30:00', '2023-03-10 15:45:00', 7, 9),
(601, NULL, 15, '2023-03-10 04:20:00', '2023-03-10 18:30:00', 7, 9),
(602, NULL, 15, '2023-03-10 07:00:00', '2023-03-10 21:40:00', 7, 9),
(603, NULL, 15, '2023-03-10 09:40:00', '2023-03-10 23:50:00', 7, 9),
(604, NULL, 15, '2023-03-11 07:10:00', '2023-03-11 09:40:00', 7, 9),
(605, NULL, 15, '2023-03-11 10:00:00', '2023-03-11 12:20:00', 7, 9),
(606, NULL, 15, '2023-03-11 01:00:00', '2023-03-11 15:20:00', 7, 14),
(607, NULL, 15, '2023-03-11 03:50:00', '2023-03-11 18:30:00', 7, 14),
(608, NULL, 15, '2023-03-11 07:00:00', '2023-03-11 12:10:00', 7, 14),
(609, NULL, 15, '2023-03-12 08:20:00', '2023-03-12 10:30:00', 7, 14),
(610, NULL, 15, '2023-03-12 11:00:00', '2023-03-12 13:10:00', 7, 14),
(611, NULL, 15, '2023-03-12 01:40:00', '2023-03-12 16:40:00', 7, 14),
(612, NULL, 15, '2023-03-12 06:00:00', '2023-03-12 20:10:00', 7, 14),
(613, NULL, 15, '2023-03-12 06:00:00', '2023-03-12 20:10:00', 7, 14),
(614, NULL, 15, '2023-03-12 08:40:00', '2023-03-12 22:50:00', 7, 14),
(615, NULL, 16, '2023-03-06 11:30:00', '2023-03-06 13:40:00', 7, 1),
(616, NULL, 16, '2023-03-06 02:00:00', '2023-03-06 16:20:00', 7, 1),
(617, NULL, 15, '2023-03-06 05:00:00', '2023-03-06 19:00:00', 7, 1),
(618, NULL, 16, '2023-03-06 08:30:00', '2023-03-06 22:50:00', 7, 1),
(619, NULL, 16, '2023-03-07 09:00:00', '2023-03-07 11:10:00', 7, 1),
(620, NULL, 16, '2023-03-07 11:40:00', '2023-03-07 01:50:00', 7, 1),
(621, NULL, 16, '2023-03-07 02:30:00', '2023-03-07 16:40:00', 7, 1),
(622, NULL, 16, '2023-03-07 05:20:00', '2023-03-07 19:30:00', 7, 6),
(623, NULL, 16, '2023-03-07 08:30:00', '2023-03-07 22:40:00', 7, 6),
(624, NULL, 16, '2023-03-08 07:30:00', '2023-03-08 09:40:00', 7, 6),
(625, NULL, 16, '2023-03-08 10:00:00', '2023-03-08 12:10:00', 7, 6),
(626, NULL, 16, '2023-03-08 12:40:00', '2023-03-08 14:50:00', 7, 6),
(627, NULL, 16, '2023-03-08 03:20:00', '2023-03-08 17:30:00', 7, 6),
(628, NULL, 16, '2023-03-08 06:00:00', '2023-03-08 20:10:00', 7, 6),
(629, NULL, 16, '2023-03-09 08:00:00', '2023-03-09 10:10:00', 7, 6),
(630, NULL, 16, '2023-03-09 10:40:00', '2023-03-09 12:50:00', 7, 6),
(631, NULL, 16, '2023-03-09 01:30:00', '2023-03-09 15:40:00', 7, 6),
(632, NULL, 16, '2023-03-09 07:00:00', '2023-03-09 21:15:00', 7, 12),
(633, NULL, 16, '2023-03-09 09:40:00', '2023-03-09 23:50:00', 7, 9),
(634, NULL, 16, '2023-03-10 07:30:00', '2023-03-10 09:40:00', 7, 9),
(635, NULL, 16, '2023-03-10 10:30:00', '2023-03-10 12:30:00', 7, 9),
(636, NULL, 16, '2023-03-10 01:40:00', '2023-03-10 15:50:00', 7, 9),
(637, NULL, 16, '2023-03-10 04:30:00', '2023-03-10 18:40:00', 7, 9),
(638, NULL, 16, '2023-03-11 09:30:00', '2023-03-11 12:50:00', 7, 9),
(639, NULL, 16, '2023-03-11 01:30:00', '2023-03-11 16:00:00', 7, 9),
(640, NULL, 16, '2023-03-11 05:00:00', '2023-03-11 20:20:00', 7, 16),
(641, NULL, 16, '2023-03-11 09:00:00', '2023-03-11 23:10:00', 7, 14),
(642, NULL, 16, '2023-03-12 10:00:00', '2023-03-12 12:10:00', 7, 14),
(643, NULL, 16, '2023-03-12 12:40:00', '2023-03-12 14:50:00', 7, 14),
(644, NULL, 16, '2023-03-12 03:30:00', '2023-03-12 17:40:00', 7, 14),
(645, NULL, 16, '2023-03-12 06:00:00', '2023-03-12 20:10:00', 7, 14),
(646, NULL, 17, '2023-03-06 08:00:00', '2023-03-06 10:10:00', 7, 1),
(647, NULL, 17, '2023-03-06 10:40:00', '2023-03-06 12:50:00', 7, 1),
(648, NULL, 17, '2023-03-06 01:30:00', '2023-03-06 15:40:00', 7, 1),
(649, NULL, 17, '2023-03-06 07:00:00', '2023-03-06 21:15:00', 7, 1),
(650, NULL, 17, '2023-03-06 09:40:00', '2023-03-06 23:50:00', 7, 1),
(651, NULL, 17, '2023-03-07 07:30:00', '2023-03-07 09:40:00', 7, 1),
(652, NULL, 17, '2023-03-07 10:00:00', '2023-03-07 12:10:00', 7, 1),
(653, NULL, 16, '2023-03-07 12:40:00', '2023-03-07 14:50:00', 7, 1),
(654, NULL, 17, '2023-03-07 03:20:00', '2023-03-07 17:30:00', 7, 1),
(655, NULL, 17, '2023-03-07 06:00:00', '2023-03-07 20:10:00', 7, 6),
(656, NULL, 17, '2023-03-07 08:40:00', '2023-03-07 23:50:00', 7, 6),
(657, NULL, 17, '2023-03-08 09:00:00', '2023-03-08 11:10:00', 7, 6),
(658, NULL, 17, '2023-03-08 11:40:00', '2023-03-08 13:50:00', 7, 6),
(659, NULL, 17, '2023-03-08 02:30:00', '2023-03-08 16:40:00', 7, 6),
(660, NULL, 17, '2023-03-08 05:20:00', '2023-03-08 19:30:00', 7, 6),
(661, NULL, 17, '2023-03-08 08:30:00', '2023-03-08 23:40:00', 7, 6),
(662, NULL, 17, '2023-03-09 11:30:00', '2023-03-09 13:40:00', 7, 6),
(663, NULL, 17, '2023-03-09 02:00:00', '2023-03-09 16:20:00', 7, 6),
(664, NULL, 17, '2023-03-09 05:00:00', '2023-03-09 19:00:00', 7, 9),
(665, NULL, 17, '2023-03-09 08:20:00', '2023-03-09 22:50:00', 7, 11),
(666, NULL, 17, '2023-03-10 08:20:00', '2023-03-10 10:30:00', 7, 6),
(667, NULL, 17, '2023-03-10 11:00:00', '2023-03-10 13:10:00', 7, 6),
(668, NULL, 17, '2023-03-10 01:40:00', '2023-03-10 15:50:00', 7, 9),
(669, NULL, 17, '2023-03-10 02:30:00', '2023-03-10 16:40:00', 7, 9),
(670, NULL, 17, '2023-03-10 06:00:00', '2023-03-10 20:10:00', 7, 9),
(671, NULL, 17, '2023-03-10 08:40:00', '2023-03-10 22:50:00', 7, 9),
(672, NULL, 17, '2023-03-11 07:10:00', '2023-03-11 09:20:00', 7, 9),
(673, NULL, 17, '2023-03-11 10:00:00', '2023-03-11 12:20:00', 7, 9),
(674, NULL, 17, '2023-03-11 01:00:00', '2023-03-11 15:20:00', 7, 9),
(675, NULL, 17, '2023-03-11 03:50:00', '2023-03-11 18:30:00', 7, 14),
(676, NULL, 17, '2023-03-11 07:00:00', '2023-03-11 21:10:00', 7, 14),
(677, NULL, 17, '2023-03-11 09:40:00', '2023-03-11 23:50:00', 7, 14),
(678, NULL, 17, '2023-03-12 10:00:00', '2023-03-12 12:10:00', 7, 14),
(679, NULL, 17, '2023-03-12 01:30:00', '2023-03-12 15:45:00', 7, 14),
(680, NULL, 17, '2023-03-12 04:20:00', '2023-03-12 18:30:00', 7, 14),
(681, NULL, 17, '2023-03-12 07:00:00', '2023-03-12 21:10:00', 7, 14),
(682, NULL, 17, '2023-03-12 09:40:00', '2023-03-12 23:50:00', 7, 14);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
CREATE TABLE IF NOT EXISTS `schedules` (
  `schedule_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`schedule_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`schedule_id`, `start_date`, `end_date`) VALUES
(1, '2023-02-14', '2023-02-28'),
(2, '2023-02-15', '2023-02-28'),
(3, '2023-02-16', '2023-02-28');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

DROP TABLE IF EXISTS `seats`;
CREATE TABLE IF NOT EXISTS `seats` (
  `seat_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_seat` varchar(6) NOT NULL,
  `seat_number` int(11) NOT NULL,
  `rows_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`seat_id`),
  KEY `gf` (`seat_number`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`seat_id`, `type_seat`, `seat_number`, `rows_number`) VALUES
(1, '', 10, 5),
(2, '', 15, 5),
(3, '', 12, 7),
(4, '', 12, 9);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
