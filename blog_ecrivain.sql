-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 17, 2021 at 02:04 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_oc`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_post` int(11) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `comment` text,
  `comment_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Commentaires des billets du blog';

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `id_post`, `author`, `comment`, `comment_date`) VALUES
(1, 1, 'Albert', 'Super !', '2020-10-08 10:56:55'),
(2, 2, 'Sandra', 'Une expérience inoubliable !', '2020-10-08 10:57:20'),
(3, 1, 'Paul', 'Je confirme, ce voyage est un \"must do\".', '2020-10-08 10:57:50'),
(4, 2, 'Alice Lala...', 'Une expérience froide mais que je voudrais absolument refaire aussi. :-D', '2020-10-08 10:59:04'),
(8, 2, 'Michel', 'Super', '2020-11-03 12:07:28'),
(9, 2, 'test', 'Un superbe voyage', '2021-04-14 11:28:24'),
(10, 2, 'test', 'Vous y êtes déjà allés ?', '2021-04-14 11:29:20'),
(11, 2, 'test', 'Vous y êtes déjà allés ?', '2021-04-14 11:32:13'),
(12, 2, 'test', 'Oui !', '2021-04-14 11:32:20'),
(13, 2, 'test', 'Oui !', '2021-04-14 11:34:58'),
(19, 2, 'test', 'Hello World !', '2021-04-20 09:10:23'),
(20, 2, 'test', 'Hello World !', '2021-04-20 09:10:47'),
(21, 3, 'Sara', 'Nouveau commentaire', '2021-05-12 12:28:16');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_name`) VALUES
(1, 'administrateur'),
(2, 'membre');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subscription_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `isAdmin`, `pseudo`, `pass`, `email`, `subscription_date`) VALUES
(6, 0, 'Marie', '$2y$10$Al2avDM14olh1r8FEFnKpee5VDUBTypitcXPNXDf/XpJtNGRw5xXq', 'slbjorck@gmail.com', '2020-11-17 15:52:24'),
(13, 0, 'admin', '$2y$10$ApUkgpcZo3cgOsueOGMiFOIUl3IrkOez.TBCKT.JY3RULBr7uRcMi', 'admin@admin.com', '2021-03-31 00:00:00'),
(17, 0, 'Sara', '$2y$10$jcTjLcT7XgvDXBxxY2k3vuOtowsfAnKt/18/zs4fEtRLzEByW34QC', 'sara@gmail.com', '2021-04-06 00:00:00'),
(20, 0, 'test', '$2y$10$x3MG5rQfNooCPsNc99cb.u9UptWJva.KHJZaLWFtbQWJnacNI3N5O', 'test@test.fr', '2021-04-07 00:00:00'),
(21, 0, 'Ana', '$2y$10$cuyZw9xsBCBwfbyBivuiLOk3IhredYeByZWI0pffc7mZj/cytLHjK', 'slbjorck@icloud.com', '2021-04-20 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date_creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Liste des billets du blog';

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `member_id`, `title`, `content`, `date_creation`) VALUES
(1, 0, 'Voyage au Portugal ', '<p>Un lieu ou la nature et la culture se rencontrent harmonieusement pour cr&eacute;er une exp&eacute;rience inoubliable. Ne tardez plus &agrave; visiter le Portugal. C\'est super !</p>', '2020-10-08 10:51:43'),
(2, 0, 'Visitez l\'Alaska', 'Si l\'expérience de l\'Alaska est différente de celle du Portugal, elle ne l\'est pas moins intéressante et impressionnante. Des payasages à couper le souffle, une culture unique ayant échappé à ce processus de mondialisation. Un voyage pour les aventuriers !	\r\n						', '2020-10-08 10:55:34'),
(3, 20, 'Test', 'jhkfhkfjhgfhgkj', '2021-04-20 13:34:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_post` (`id_post`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment_post` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
