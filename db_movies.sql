-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 21, 2023 at 05:41 AM
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
  `booking_id` int(10) UNSIGNED DEFAULT NULL,
  `price` double DEFAULT NULL,
  `seats_booked` varchar(100) NOT NULL,
  `scheduleDetail_id` int(11) NOT NULL,
  PRIMARY KEY (`bookingDetail_id`),
  KEY `booking_id` (`booking_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bookingdetails`
--

INSERT INTO `bookingdetails` (`bookingDetail_id`, `booking_id`, `price`, `seats_booked`, `scheduleDetail_id`) VALUES
(1, NULL, NULL, 'A 1,A 2,A 3', 18);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `booking_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `issue_date` date NOT NULL,
  `amount` double NOT NULL,
  `discount` double NOT NULL,
  `vat` double NOT NULL,
  `grand_total` double NOT NULL,
  PRIMARY KEY (`booking_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
(1, 'THEATRE A ( 2D )', '2D', 0),
(2, 'THEATRE B ( 3D )', '3D', 0),
(3, 'THEATRE C ( 4DX )', '4DX', 0),
(4, 'THEATRE D ( IMAX )', 'IMAX', 0);

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
  PRIMARY KEY (`movie_id`),
  KEY `category_id` (`categorie_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `movie_title`, `durations`, `movie_image`, `categorie_id`, `rating`, `description`, `movie_status`, `release_date`, `url_trailer`) VALUES
(1, 'Doctor Strange in the Multiverse of Madness', '2h 54 Minutes', 'Doctor Strange.jpg', 1, '9.2', 'Doctor Strange teams up with a mysterious teenage girl from his dreams who can travel across multiverses, to battle multiple threats, including other-universe versions of himself, which threaten to wipe out millions across the multiverse.', 'now showing', '12-12-2020', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/aWzlQ2N6qqg\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>'),
(10, 'Jumanji: Welcome to the Jungle', '1h 35 minutes', 'jumanji_v8_aa.jpg', 1, '', 'When four students play with a magical video game, they are drawn to the jungle world of Jumanji, where they are trapped as their avatars. To return to the real world, they must finish the game.', 'Up Coming', '12-24-2020', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/2QKg5SZ_35I\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>'),
(14, 'Black Panther: Wakanda Forever', '2h 39 minutes', 'BlackPanther.jpg', 2, '7.8', 'Queen Ramonda, Shuri, M\'Baku, Okoye and the Dora Milaje fight to protect their nation from intervening world powers in the wake of King T\'Challa\'s death. As the Wakandans strive to embrace their next chapter, the heroes must band together with Nakia and Everett Ross to forge a new path for their beloved kingdom.', 'Up Coming', '02-14-2024', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RlOB3UALvrQ\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>'),
(15, 'Free Guy', '', 'freeguy.jpg', 1, '7.1', 'When Guy, a bank teller, learns that he is a non-player character in a bloodthirsty, open-world video game, he goes on to become the hero of the story and takes the responsibility of saving the world.', 'now showing', '02-18-2023', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/X2m-08cOAbc\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>'),
(16, 'Extraction', '1h 56 minutes', 'Extraction.jpg', 3, '6.1', 'A black-market mercenary who has nothing to lose is hired to rescue the kidnapped son of an imprisoned international crime lord. But in the murky underworld of weapons dealers and drug traffickers, an already deadly mission approaches the impossible.', 'now showing', '02-28-2023', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/L6P3nI6VnlY\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>'),
(17, 'Puss in Boots: The Last Wish', '1h 40 minutes', 'puss-in-boots.jpg', 2, '7.9', 'Puss in Boots discovers that his passion for adventure has taken its toll when he learns that he has burnt through eight of his nine lives. Puss sets out on an epic journey to find the mythical Last Wish and restore his nine lives.', 'now showing', '12-22-2022', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RqrXhwS33yc\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>'),
(18, 'Dune', '2h 35 minutes', 'dune.jpg', 3, '8', 'Paul Atreides arrives on Arrakis after his father accepts the stewardship of the dangerous planet. However, chaos ensues after a betrayal as forces clash to control melange, a precious resource.', 'Up Coming', '12-22-2024', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/n9xhJrPXop4\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>'),
(19, 'Black Adam', '2h 40 minutes', 'Black_Adam.jpg', 1, '6.4', 'After being bestowed with godly powers and imprisoned for it, Black Adam is liberated from his earthly binds to unleash his fury on the modern world.', 'Up Coming', '12-22-2024', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/mkomfZHG5q4\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>'),
(22, 'Spider-Man: No Way Home', '2h 28 minutes', 'nwhspider.jpg', 3, '9.5', 'Spider-Man seeks the help of Doctor Strange to forget his exposed secret identity as Peter Parker. However, Stranges spell goes horribly wrong, leading to unwanted guests entering their universe.', 'now showing', '02-22-2023', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/JfVOs4VSpmA\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>');

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
  `hall_branch_id` int(11) NOT NULL,
  PRIMARY KEY (`scheduleDetail_id`),
  KEY `movie_id` (`movie_id`),
  KEY `schedule_id` (`schedule_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scheduledetails`
--

INSERT INTO `scheduledetails` (`scheduleDetail_id`, `schedule_id`, `movie_id`, `start_time`, `end_time`, `hall_branch_id`) VALUES
(1, 1, 1, '2023-02-14 11:45:00', '2023-02-14 01:45:00', 1),
(2, 2, 1, '2023-02-14 01:50:00', '2023-02-14 02:50:00', 1),
(3, 3, 1, '2023-02-14 03:00:00', '2023-02-14 04:00:00', 1),
(4, 4, 1, '2023-02-14 04:15:00', '2023-02-14 05:15:00', 1),
(11, NULL, 1, '2023-02-14 08:30:00', '2023-02-14 11:30:00', 1),
(12, NULL, 10, '2023-02-14 20:10:00', '2023-02-14 23:15:00', 1),
(13, NULL, 10, '2023-02-14 23:45:00', '2023-02-15 02:15:00', 1),
(17, NULL, 10, '2023-02-15 12:30:00', '2023-02-15 14:30:00', 1),
(18, NULL, 1, '2023-02-20 11:30:00', '2023-02-21 02:00:00', 1),
(19, NULL, 1, '2023-03-08 09:00:00', '2023-03-08 00:30:00', 1),
(20, NULL, 1, '2023-03-08 09:00:00', '2023-03-08 12:30:00', 2),
(21, NULL, 1, '2023-08-03 09:00:00', '2023-08-03 12:30:00', 5),
(22, NULL, 1, '2023-02-24 15:00:00', '2023-02-24 17:30:00', 4);

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
