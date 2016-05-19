-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2016 at 02:49 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hourtracker`
--
CREATE DATABASE IF NOT EXISTS `hourtracker` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hourtracker`;

-- --------------------------------------------------------

--
-- Table structure for table `hours`
--

CREATE TABLE IF NOT EXISTS `hours` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sunday` int(11) DEFAULT NULL,
  `monday` int(11) DEFAULT NULL,
  `tuesday` int(11) DEFAULT NULL,
  `wednesday` int(11) DEFAULT NULL,
  `thursday` int(11) DEFAULT NULL,
  `friday` int(11) DEFAULT NULL,
  `saturday` int(11) DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hours_user_id_foreign` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `hours`
--

INSERT INTO `hours` (`id`, `created_at`, `updated_at`, `sunday`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `user_id`) VALUES
(1, '2016-05-18 11:02:26', '2016-05-19 07:34:52', 10, 10, 1, 3, 0, 10, 0, 2),
(2, '2016-05-18 11:12:20', '2016-05-18 11:12:20', 1, NULL, NULL, NULL, NULL, NULL, NULL, 6),
(3, '2016-05-18 11:13:43', '2016-05-19 07:38:33', 1, 9, 9, 9, 9, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_05_17_011101_create_table_hours', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ashley', 'ashley@reach.com', '$2y$10$vylgO/yxCc9874GzTTF/juBT7dXua4Csh5c0Wjhw5XAudNjn/jKme', 'KqzTOyuEXZDm9nSjbdTFHqxTtdITiI7UXDfW0rbSa997ECyMw2pMOSpkPPmu', '2016-05-18 11:02:10', '2016-05-19 07:38:36'),
(2, 'Dave', 'dave@reach.com', '$2y$10$gTH5WgJdArQkj8WBreXjh.XZrka/pw/ICzeQRLXJwTF2jnX6A5OBy', '6P4DzeSb1d3muwVXpyfyPKuajU0UwcJyb3yLtEsHp60EbJBjaTm2K9nWtidp', '2016-05-18 11:02:10', '2016-05-18 11:34:15'),
(3, 'Jim', 'jim@reach.com', '$2y$10$z5z1OjfZozyzrQ2s56mGj.5ihhaAd1zBhpF/hrIV0YQtLpIpk4RO6', NULL, '2016-05-18 11:02:10', '2016-05-18 11:02:10'),
(4, 'Ralph', 'ralph@reach.com', '$2y$10$pThTYQ6wI/QiGw6/mWqRdOia0lTDlZOMuMBTyH6EWAwCmIJnQW7vi', NULL, '2016-05-18 11:02:10', '2016-05-18 11:02:10'),
(5, 'Jessica', 'jessica@reach.com', '$2y$10$v4rez6nudL/UFAyGRiaeBeu/xkwmT0ltfuf5qzAcNJ8kt6Zxbqp7y', NULL, '2016-05-18 11:02:10', '2016-05-18 11:02:10'),
(6, 'Mary', 'mary@reach.com', '$2y$10$nz9QZ3m4kNFO2PFnFmoJlONfemiJ1UGnUV9favdts7xaWV7h5o99i', 'rsOvnbweoPEGlkEMxaGqjsTvdVfUrmRBkGUW45DCrtqGRdGbRTszydMcqs7j', '2016-05-18 11:02:10', '2016-05-18 11:12:53');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hours`
--
ALTER TABLE `hours`
  ADD CONSTRAINT `hours_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
