-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 21 aug 2019 kl 22:41
-- Serverversion: 10.1.35-MariaDB
-- PHP-version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `lab3`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `author`
--

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL,
  `first_name` varchar(40) COLLATE utf8_swedish_ci NOT NULL,
  `last_name` varchar(40) COLLATE utf8_swedish_ci NOT NULL,
  `social_secno` varchar(20) COLLATE utf8_swedish_ci DEFAULT NULL,
  `year_of_birth` int(11) DEFAULT NULL,
  `info_url` varchar(200) COLLATE utf8_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `author`
--

INSERT INTO `author` (`author_id`, `first_name`, `last_name`, `social_secno`, `year_of_birth`, `info_url`) VALUES
(1, 'JK', 'Rowling', '650731', 1965, 'https://www.jkrowling.com/'),
(2, 'Jens', 'Lapidus', '740524', 1974, NULL),
(3, 'Lars', 'Kepler', NULL, NULL, NULL),
(4, 'Dan', 'Brown', NULL, NULL, NULL),
(5, 'Jojo', 'Moyes', NULL, NULL, NULL),
(6, 'Jan', 'Gillou', NULL, NULL, NULL),
(7, 'Ulf', 'Lundell', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur `book`
--

CREATE TABLE `book` (
  `book_id` int(11) NOT NULL,
  `isbn` varchar(13) COLLATE utf8_swedish_ci NOT NULL,
  `title` varchar(200) COLLATE utf8_swedish_ci NOT NULL,
  `pages` int(11) NOT NULL,
  `edition` int(11) NOT NULL,
  `published` int(11) NOT NULL,
  `publisher` varchar(80) COLLATE utf8_swedish_ci NOT NULL,
  `library_shelf` varchar(8) COLLATE utf8_swedish_ci DEFAULT NULL,
  `added_year` int(4) DEFAULT NULL,
  `barcode` int(15) DEFAULT NULL,
  `reserved` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `book`
--

INSERT INTO `book` (`book_id`, `isbn`, `title`, `pages`, `edition`, `published`, `publisher`, `library_shelf`, `added_year`, `barcode`, `reserved`) VALUES
(1, ' 978910014269', 'Lazarus', 544, 7, 2018, 'Albert Bonniers förlag', NULL, NULL, NULL, 0),
(2, '9789175034539', 'Stalker', 615, 5, 2015, 'Månpocket', NULL, NULL, NULL, 0),
(3, '9789170016400', 'Snabba Cash', 474, 1, 2008, 'Månpocket', NULL, NULL, NULL, 0),
(4, '978912967535', 'Harry Potter and the Philosopher´s stone', 390, 6, 2010, 'Rabén och Sjögren', NULL, NULL, NULL, 0),
(5, '9789129677342', 'Ondskan', 255, 2, 2004, 'Månpocket', NULL, NULL, NULL, 0),
(6, '9789129678437', 'Vardagar', 286, 1, 2014, 'Månpocket', NULL, NULL, NULL, 0),
(7, '9789100144572', 'Begynnelse', 532, 1, 2010, 'Månpocket', NULL, NULL, NULL, 0),
(8, '9789129678756', 'En andra chans', 324, 1, 2015, 'Rabén och Sjögren', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `book_author`
--

CREATE TABLE `book_author` (
  `book_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `book_author`
--

INSERT INTO `book_author` (`book_id`, `author_id`) VALUES
(1, 3),
(2, 3),
(3, 2),
(4, 1),
(5, 6),
(6, 7),
(7, 4),
(8, 5);

-- --------------------------------------------------------

--
-- Tabellstruktur `user`
--

CREATE TABLE `user` (
  `user_id` varchar(80) COLLATE utf8_swedish_ci NOT NULL,
  `password` varchar(80) COLLATE utf8_swedish_ci NOT NULL,
  `user_role` varchar(3) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `user`
--

INSERT INTO `user` (`user_id`, `password`, `user_role`) VALUES
('admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '111'),
('Browser', '54a2cf5e634dbba0be2bf8a55f79252f5c790bdb', '001'),
('Hejhej', 'ce44fc6169244afa51ae03756206436f4058888c', '001'),
('Linnekroth', 'e9e08727cde7f65098ed8413cd91b28e95f18e98', '011');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Index för tabell `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`);

--
-- Index för tabell `book_author`
--
ALTER TABLE `book_author`
  ADD PRIMARY KEY (`book_id`,`author_id`),
  ADD KEY `fk2_book_author` (`author_id`);

--
-- Index för tabell `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT för tabell `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `book_author`
--
ALTER TABLE `book_author`
  ADD CONSTRAINT `fk1_book_author` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`),
  ADD CONSTRAINT `fk2_book_author` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
