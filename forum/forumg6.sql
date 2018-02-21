-- --------------------------------------------------------
-- Hostitel:                     127.0.0.1
-- Verze serveru:                10.1.30-MariaDB - mariadb.org binary distribution
-- OS serveru:                   Win32
-- HeidiSQL Verze:               9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Exportování struktury pro tabulka forumg6.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext COLLATE utf8_czech_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- Exportování dat pro tabulku forumg6.categories: ~4 rows (přibližně)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`) VALUES
	(1, 'Test'),
	(2, 'Test2'),
	(3, 'ATest'),
	(4, 'ZTest'),
	(5, 'Vytvořená kategorie');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Exportování struktury pro tabulka forumg6.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` tinytext COLLATE utf8_czech_ci,
  `author_id` int(11) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8_czech_ci,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- Exportování dat pro tabulku forumg6.comments: ~8 rows (přibližně)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `author`, `author_id`, `article_id`, `content`, `created`, `updated`) VALUES
	(2, 'admin', 1, 5, 'adminuv test', '2018-02-10 13:41:52', '2018-02-10 13:41:52'),
	(3, 'member', 2, 5, 'komentar membera', '2018-02-10 13:44:00', '2018-02-10 13:44:00'),
	(4, 'admin', 1, 8, 'ahoj', '2018-02-10 16:57:43', '2018-02-10 16:57:43'),
	(5, 'member', 2, 10, 'jsdfvdfh', '2018-02-10 17:26:45', '2018-02-10 17:26:45'),
	(6, 'member', 2, 11, 'komentář', '2018-02-10 19:20:36', '2018-02-10 19:20:36'),
	(7, 'admin', 1, 11, 'ahoj', '2018-02-18 22:31:30', '2018-02-18 22:31:30'),
	(8, 'admin', 1, 23, 'ahoj', '2018-02-19 17:56:13', '2018-02-19 18:08:01'),
	(9, 'admin', 1, 23, 'čau', '2018-02-19 19:47:06', '2018-02-19 19:47:06');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Exportování struktury pro tabulka forumg6.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `author` tinytext COLLATE utf8_czech_ci,
  `title` tinytext COLLATE utf8_czech_ci,
  `content` longtext COLLATE utf8_czech_ci,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- Exportování dat pro tabulku forumg6.posts: ~18 rows (přibližně)
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `category_id`, `author_id`, `author`, `title`, `content`, `created`, `updated`) VALUES
	(1, 1, 1, 'admin', 'Test', 'testtest', '2018-01-29 18:30:04', '2018-01-29 18:30:10'),
	(2, 1, 2, 'member', 'Test2', 'blablabla', '2018-01-29 18:30:07', '2018-01-29 18:30:11'),
	(3, 2, 1, 'admin', 'Test', 'blablabla', '2018-01-29 18:30:08', '2018-01-29 18:30:12'),
	(5, 1, 1, 'admin', 'bla', 'blabnlajd', '2018-02-07 12:15:08', '2018-02-07 12:15:08'),
	(6, 1, 2, 'member', 'Nový příspěvek', 'srhfsbluigf euigruheydfushbgrtrj', '2018-02-10 13:52:23', '2018-02-10 13:52:23'),
	(7, 1, 1, 'admin', 'drjkgkb', 'rsthtsrjtzkm', '2018-02-10 14:30:53', '2018-02-10 14:30:53'),
	(8, 1, 1, 'admin', 'gtdnxfgnmcfhz', 'zhm,cg,hj,vhj,', '2018-02-10 14:31:19', '2018-02-10 14:31:19'),
	(9, 1, 1, 'admin', 'titulek', 'obsah', '2018-02-10 16:58:16', '2018-02-10 16:58:16'),
	(10, 1, 1, 'admin', 'další titulek', 'fdjkbgfhndhk', '2018-02-10 16:59:50', '2018-02-10 16:59:50'),
	(11, 1, 2, 'member', 'nazev', 'text', '2018-02-10 17:13:00', '2018-02-10 17:13:00'),
	(12, 3, 1, 'admin', 'titulek v atestu', 'obsah', '2018-02-17 17:38:52', '2018-02-17 17:38:52'),
	(13, 4, 1, 'admin', 'Titulek v ZTestu', 'fhfjzulhk.l-j', '2018-02-17 17:39:40', '2018-02-17 17:39:40'),
	(14, 1, 1, 'admin', 'j.hnhjgnjh,hj', 'jh,hj,.k.,huk.j.', '2018-02-17 17:40:27', '2018-02-17 17:40:27'),
	(15, 2, 1, 'admin', 'gjjhkjftzkzuj', 'tzjkjkgulzig', '2018-02-17 17:53:46', '2018-02-17 17:53:46'),
	(21, 4, 1, 'admin', 'gfhjhgkhjk', 'hujkzukliulkoůj', '2018-02-17 19:55:05', '2018-02-17 19:55:05'),
	(22, 5, 1, 'admin', 'gfjhjh', 'ghjghjkgjkjk', '2018-02-17 19:56:19', '2018-02-17 19:56:19'),
	(23, 3, 1, 'admin', 'fhjgfukghjkl', 'hujkljlůjk§klůjůl', '2018-02-17 19:58:45', '2018-02-17 19:58:45');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- Exportování struktury pro tabulka forumg6.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` tinytext COLLATE utf8_czech_ci,
  `forename` tinytext COLLATE utf8_czech_ci,
  `surname` tinytext COLLATE utf8_czech_ci,
  `password` tinytext COLLATE utf8_czech_ci,
  `email` tinytext COLLATE utf8_czech_ci,
  `picture` tinytext COLLATE utf8_czech_ci,
  `role` tinytext COLLATE utf8_czech_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- Exportování dat pro tabulku forumg6.users: ~2 rows (přibližně)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `forename`, `surname`, `password`, `email`, `picture`, `role`) VALUES
	(1, 'admin', 'Jiří', 'Pochop', '$2y$10$8KzRgfcfxQ5573uaWZfqs.nrfHasgQWXbPtUZ2/mpSSqJZAm2TFxK', 'jiri.pochop01@gmail.com', 'pictures/default.jpg', 'admin'),
	(2, 'member', 'Jiří', 'Pochop', '$2y$10$2Bs2iKOQuWyhUB0WDWAen.hBkNRGsIEbzwyVHgNM6JzmNssCoWfs2', 'jiri.pochop01@gmail.com', 'pictures/member.png', 'member'),
	(4, 'pochop', 'Jiří', 'Pochop', '$2y$10$M.9byFQ6nnxBneIIgx1DrOG1Bo7p6VQ/3nJtT1uM9zVZEnRHMp/Ni', 'jiri.pochop01@gmail.com', 'pictures/default.jpg', 'member');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
