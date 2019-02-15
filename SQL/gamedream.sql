-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2018 at 12:02 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamedream`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`) VALUES
(4, 0),
(1, 1),
(2, 2),
(3, 4),
(5, 5),
(7, 7),
(9, 9),
(10, 10),
(12, 12),
(13, 13);

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `flag_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `game_id`, `cart_id`, `flag_id`) VALUES
(27, 10, 2, 2),
(45, 1, 2, 2),
(46, 2, 2, 2),
(53, 3, 2, 1),
(55, 5, 2, 1),
(56, 15, 2, 3),
(57, 1, 5, 2),
(58, 4, 5, 3),
(59, 7, 5, 3),
(60, 1, 10, 2),
(65, 4, 12, 2),
(66, 9, 12, 3),
(67, 9, 13, 3);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`) VALUES
(1, 'CD Projekt Red'),
(2, 'Bethesda Game Studios'),
(3, 'Ubisoft'),
(4, 'Electronic Arts'),
(5, 'Activision'),
(6, 'Blizard'),
(7, 'Valve'),
(8, 'Capcom'),
(9, 'Blizzard Entertainment'),
(10, 'Nintendo'),
(11, 'Rockstar North'),
(12, 'Konami'),
(13, 'BioWare'),
(14, 'LucasArts'),
(15, 'Naughty Dog'),
(16, 'New World Computing, Inc.'),
(17, 'Telltale Games'),
(18, 'Nival Interactive'),
(19, 'Shining Rock Software'),
(20, 'id Software'),
(21, 'DynamicPixels');

-- --------------------------------------------------------

--
-- Table structure for table `flag`
--

CREATE TABLE `flag` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `flag`
--

INSERT INTO `flag` (`id`, `name`) VALUES
(1, 'cart'),
(2, 'owned'),
(3, 'wishlist');

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `votes` varchar(30) DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `version` varchar(30) DEFAULT NULL,
  `rating` varchar(30) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `size` varchar(30) DEFAULT NULL,
  `price` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`id`, `name`, `description`, `votes`, `cover`, `version`, `rating`, `release_date`, `size`, `price`) VALUES
(1, 'The Witcher 3: Wild Hunt - Game of the Year Edition', 'Become a professional monster slayer and embark on an adventure of epic proportions! Upon its release, The Witcher 3: Wild Hunt ', '3175', 'https://images-3.gog.com/e34b4189894110990510f1334151555bd1c0ed45926c5c8cbc7e9b80aa6744d1_product_quartet_250.jpg', '3.3', '5.0', '2017-08-30', '40.0 GB', 44),
(2, 'The Elder Scrolls V: Skyrim Special Edition', 'Winner of more than 200 Game of the Year Awards, Skyrim Special Edition brings the epic fantasy to life in stunning detail. The ', '3081', 'http://cdn.akamai.steamstatic.com/steam/apps/489830/header.jpg?t=1481040018', '1.6.1.0', '5.0', '2016-10-28', '12.0 GB', 27),
(3, 'Heroes of Might and Magic®', 'The realms of Might and Magic are expanding. New lands have been discovered and you must rise to the challenge of conquering the', '1134', 'https://images-4.gog.com/d97605f23832afa87c2f6dffaa91e135ab7124ef6f115dfe17a2179db3cbc54f_196.jpg', '1.0.1', '4.5', '1996-05-06', '353.6 MB', 4),
(4, 'Heroes of Might and Magic® 2: Gold', 'Lord Ironfist is dead and the Kingdom is plunged into a vicious civil war by his feuding sons. At stake is the ultimate prize: control of the land and succession of the royal throne.', '2609', 'https://images-4.gog.com/80940c3b71947fd3d83e7e53faf3c232089986188947b3f116f1f3069a534056_196.jpg', '3.2', '4.5', '1996-10-01', '356 MB', 4),
(5, 'Heroes of Might and Magic® 3: Complete', 'Murder, treachery, resurrection, savage battles and ultimately-freedom!\r\nWhen Erathia''s King Gryphonheart is murdered by traitors he is resurrected as an undead warlord who leads a ruthless invasion of his former Kingdom.', '8039', 'https://images-4.gog.com/a18a7017bdca7bdd14fb003a46522e320051d3e9c1fb939559a4517d90f86170_196.jpg', '1.1.3', '5.0', '1999-06-01', '0.9 GB', 6),
(6, 'Heroes of Might and Magic® 4: Complete', 'Some prophecies of doom do come true. Escape the flames licking at your back and jump quickly through a portal into another world, for only the bold will be allowed to live. Embrace a wondrous new land and uncover its ancient mysteries. ', '1283', 'https://images-1.gog.com/3549b565446a62a7aa085620de0de02d2d587df6bf9a0f3fe6b8445a4f63c525_196.jpg', '4.1.9.1', '4.0', '2004-09-09', '0.9 GB', 5),
(7, 'Heroes of Might and Magic® 5: Bundle', 'Heroes of Might and Magic® 5 is a turn-based strategy game in which you can build cities and besiege them, train troops and slaughter them, and explore new lands – and crush them under your iron heel.', '793', 'https://images-4.gog.com/463a31a169013ea4177dffdcc99e5c6374a0b7c3b9c55dbe754321b0a8624e6c_196.jpg', '1.12.13', '4.0', '2006-05-19', '4.2 GB', 10),
(8, 'The Walking Dead: Season 1', 'The Walking Dead is a five-part game series set in the same universe as Robert Kirkman’s award-winning comic book series. Play as Lee Everett, a convicted criminal, who has been given a second chance at life in a world devastated by the undead.', '261', 'https://images-1.gog.com/b0db92340570056f1c811992cb38c56ee32d61976a7eeb0a4d2287d15d0a2b0a_196.jpg', '0.5.1', '4.5', '2012-04-24', '3.4 GB', 22),
(9, 'Banished', 'Banished is a city building game where you control a group of exiled people who are restarting their lives in the wilderness. They have only the clothes on their backs and a cart filled with supplies from their homeland. The townspeople work, build, get o', '952', 'https://images-2.gog.com/8e305b37ccbec02dd0301e89c6ff63fd8e0e16d634ac38d2c08a695952675bf4_196.jpg', '2.3.1', '4.5', '2014-02-18', '173.5 MB', 18),
(10, 'Ultimate DOOM', 'In the future, humans have left Earth and settled throughout the galaxy. On Mars, the Union Aerospace Corporation has established a radioactive waste facility and allowed the military to conduct teleportation experiments on the nearby moons of Deimos and ', '457', 'https://images-2.gog.com/1900826642405a8b74e6329d87d168ec7441c7b07f431333520bcfdd2509a1f6_196.jpg', '1.92.1', '5.0', '1995-04-30', '50MB', 5),
(11, 'Anno 1602 A.D.', 'It is the year 1602 and you find yourself in command of a sailing vessel, navigating the waters of the uncharted island world of Anker. You have aboard your ship no more than an handful of trusty followers and a limited supply of food and building materia', '227', 'https://images-2.gog.com/1db8a603abf8305f210da1f9b9d2ecd3132354642a5baab1ac5feb773204262e_196.jpg', '1.0.0', '5.0', '1998-09-24', '575 MB', 9),
(12, 'Rocket League®', 'Soccer meets driving once again in the long-awaited, physics-based multiplayer-focused sequel to Supersonic Acrobatic Rocket-Powered Battle-Cars! Choose a variety of high-flying vehicles equipped with huge rocket boosters to score amazing aerial goals and', '2978', 'http://cdn.akamai.steamstatic.com/steam/apps/252950/header.jpg?t=1496340038', '1.4', '4.0', '2015-07-07', '5 GB', 20),
(13, 'Witcher 2: Assassins Of Kings, The - Enhanced Edition', 'The second installment in the RPG saga about the Witcher, Geralt of Rivia. A new, modern game engine, responsible both for beautiful visuals and sophisticated game mechanics puts players in the most lively and believable world ever created in an RPG game.', '11391', 'https://images-4.gog.com/8355e657a19311b158a3553a154e109199d6991c7791a20c3305af1f84d15ed7_196.jpg', '1.1.3', '5.0', '2012-04-17', '15.2 GB', 18),
(14, 'The Witcher: Enhanced Edition', 'Your name is Geralt of Rivia and you are a witcher, that means you kill monsters for a living. You were given special training to be the best at what you do and your body has been enhanced with potent elixirs to help you do it.', '10104 ', 'https://images-1.gog.com/37d4a208d1f5bb0e163da540ac894ba46a7d566ede31aaaefc74bbcd46ebd190_196.jpg', '1.5.1', '4.5', '2007-10-26', '8.5 GB', 8),
(15, 'GWENT: The Witcher Card Game', 'Join in The Witcher universe’s favorite card game! In GWENT, you clash with your friends in fast-paced duels that combine bluffing, on-the-fly decision making and careful deck construction.', '0', 'https://images-2.gog.com/e8e4fa69db4d06ff58b7ef8bda2ea72e966f419baf2e248807520cda6244b7d8_196.jpg', 'null', 'null', '0000-00-00', '4.5', 0),
(33, 'asdasd', 'sadsa', '123', 'https://angular.io/assets/images/logos/angular/logo-nav@2x.png', '33', '3', '2017-08-02', '12', 123),
(36, 'test', 'test', 'test', 'test', 'test', 'test', '2018-01-06', 'test', 15),
(37, 'test1', 'test1', 'test1', 'test1', 'test1', 'test1', '2018-01-16', '25', 25),
(38, 'test123', 'test123', 'test123', 'test123', 'test123', 'test123', '2018-01-20', '25', 15),
(39, 'test123', 'test123', 'test123', 'test123', 'test123', 'test123', '0000-00-00', '25', 15);

-- --------------------------------------------------------

--
-- Table structure for table `game_company`
--

CREATE TABLE `game_company` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game_company`
--

INSERT INTO `game_company` (`id`, `game_id`, `company_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(16, 3, 3),
(17, 3, 16),
(24, 4, 16),
(25, 4, 3),
(28, 5, 16),
(32, 6, 16),
(33, 6, 3),
(35, 7, 18),
(36, 7, 3),
(38, 8, 17),
(41, 9, 19),
(44, 10, 20),
(45, 10, 2),
(47, 11, 3),
(50, 12, 4),
(51, 13, 1),
(54, 14, 1),
(57, 15, 1),
(58, 33, 5),
(59, 33, 1),
(61, 36, 2),
(62, 37, 20),
(63, 38, 3),
(64, 38, 3);

-- --------------------------------------------------------

--
-- Table structure for table `game_genre`
--

CREATE TABLE `game_genre` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game_genre`
--

INSERT INTO `game_genre` (`id`, `game_id`, `genre_id`) VALUES
(1, 1, 4),
(2, 2, 4),
(3, 1, 1),
(4, 2, 2),
(16, 3, 9),
(17, 3, 11),
(18, 3, 10),
(23, 1, 10),
(24, 4, 10),
(25, 4, 11),
(27, 4, 9),
(28, 5, 11),
(30, 5, 9),
(31, 5, 10),
(32, 6, 12),
(33, 6, 9),
(34, 6, 11),
(35, 7, 11),
(36, 7, 9),
(37, 7, 10),
(38, 8, 2),
(39, 8, 12),
(40, 8, 13),
(41, 9, 9),
(43, 9, 15),
(44, 10, 13),
(45, 10, 5),
(46, 10, 16),
(47, 11, 6),
(48, 11, 15),
(49, 11, 10),
(50, 12, 7),
(51, 13, 4),
(52, 13, 1),
(53, 13, 10),
(54, 14, 4),
(55, 14, 1),
(56, 14, 10),
(57, 15, 9),
(58, 33, 10),
(59, 33, 1),
(61, 36, 1),
(62, 37, 9),
(63, 38, 2),
(64, 38, 2);

-- --------------------------------------------------------

--
-- Table structure for table `game_language`
--

CREATE TABLE `game_language` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game_language`
--

INSERT INTO `game_language` (`id`, `game_id`, `language_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(5, 1, 2),
(9, 1, 4),
(11, 1, 5),
(14, 3, 1),
(15, 3, 9),
(17, 3, 1),
(18, 3, 3),
(19, 1, 8),
(20, 4, 1),
(21, 4, 9),
(24, 5, 1),
(26, 5, 9),
(28, 6, 1),
(29, 6, 3),
(31, 7, 1),
(32, 7, 9),
(34, 8, 1),
(37, 9, 1),
(38, 9, 3),
(39, 9, 9),
(40, 10, 1),
(43, 11, 1),
(44, 11, 4),
(45, 11, 9),
(46, 12, 1),
(47, 13, 1),
(48, 13, 2),
(49, 13, 10),
(50, 14, 1),
(51, 14, 4),
(52, 14, 10),
(53, 15, 1),
(54, 33, 7),
(55, 33, 2),
(56, 1, 9),
(57, 36, 2),
(58, 37, 1),
(59, 38, 2),
(60, 38, 2);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Adventure'),
(3, 'Indie'),
(4, 'RPG'),
(5, 'Shooters'),
(6, 'Simulation'),
(7, 'Sports'),
(8, 'Racing'),
(9, 'Strategy'),
(10, 'Fantasy'),
(11, 'Turn-based'),
(12, 'Point-and-click'),
(13, 'Horror'),
(14, 'Historical'),
(15, 'Real-Time'),
(16, 'Sci-fi');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `name`) VALUES
(1, 'English'),
(2, 'German'),
(3, 'Spanish'),
(4, 'Italian'),
(5, 'Bulgarian'),
(6, 'Turkish'),
(7, 'Chinese'),
(8, 'Japanese'),
(9, 'Deutsch'),
(10, 'French');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'user'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `type_id` int(11) NOT NULL,
  `token` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `name`, `surname`, `avatar`, `birth_date`, `country`, `type_id`, `token`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'secretmate@gamersdream.com', 'Mighty', 'Unknown', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxMTEhUTExMWFhUXGBgWGBgYGRgXGBoXGBgXHhofGhgYHSggGhslHRgXITEhJSkrLi4vFx8zODMtNygtLisBCgoKDg0OGhAQGy0lHSUtLS0tNS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLf/AABEIAKgBKwMBIgACEQEDEQH/', '2020-01-01', 'Neverland', 2, '494472bd44dbe7e1ea2e16335a33152772ffe11e'),
(2, 'Torrun', 'cbc9d3fded67257efa1a9b71f3500c02', 'jack96@gmail.com', 'Sava', 'Jeremic', 'https://images.gog.com/8df35c523e147971850832ebdc4d52a5c6c687115210e298e280411391401757_avm.jpg', '2017-06-05', 'Serbia', 1, '61ec21815c913f56a503245ce676ed29c2a32979'),
(5, 'Sava96', '3f00dd76109d42c5fd031dd435d36371', 'sava96@gmail.com', NULL, NULL, 'aaa', '2018-01-18', 'aaa', 1, '540ac58349d43974b7f1a743f0d9ff488cd1c32c'),
(10, 'test123', 'cc03e747a6afbbcbf8be7668acfebee5', 'test123@gmail.com', 'Test', 'Testerari', 'https://i.vimeocdn.com/portrait/58832_300x300', '1996-10-05', 'Serbia', 1, '74da563d9b50c702045ef545a6cbcdc878c7f77f'),
(11, 'test12', '60474c9c10d7142b7508ce7a50acf414', 'test12@gmail.com', NULL, NULL, NULL, NULL, NULL, 1, '80470459cb834d2caecdc12dccb9b196f675e69d'),
(12, 'test12', '60474c9c10d7142b7508ce7a50acf414', 'test12@gmail.com', 'test12', 'test12', 'test12', '2018-01-20', 'test12', 1, '80470459cb834d2caecdc12dccb9b196f675e69d'),
(13, 'test122', '60474c9c10d7142b7508ce7a50acf414', 'test12@gmail.com', 'test12', 'test12', 'test12', '0000-00-00', 'test12', 1, 'c4c057dec7a979f0cc950e2bdb25e0390b8248c3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cart_id` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`,`cart_id`),
  ADD KEY `flag_id` (`flag_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flag`
--
ALTER TABLE `flag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game_company`
--
ALTER TABLE `game_company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_4` (`game_id`),
  ADD KEY `FK_5` (`company_id`);

--
-- Indexes for table `game_genre`
--
ALTER TABLE `game_genre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_6` (`game_id`),
  ADD KEY `FK_7` (`genre_id`);

--
-- Indexes for table `game_language`
--
ALTER TABLE `game_language`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_8` (`game_id`),
  ADD KEY `FK_9` (`language_id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `game_company`
--
ALTER TABLE `game_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `game_genre`
--
ALTER TABLE `game_genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `game_language`
--
ALTER TABLE `game_language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `game_company`
--
ALTER TABLE `game_company`
  ADD CONSTRAINT `FK_4` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`),
  ADD CONSTRAINT `FK_5` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Constraints for table `game_genre`
--
ALTER TABLE `game_genre`
  ADD CONSTRAINT `FK_6` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`),
  ADD CONSTRAINT `FK_7` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`);

--
-- Constraints for table `game_language`
--
ALTER TABLE `game_language`
  ADD CONSTRAINT `FK_8` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`),
  ADD CONSTRAINT `FK_9` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
