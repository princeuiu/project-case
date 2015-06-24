-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 25, 2015 at 02:37 AM
-- Server version: 5.5.43-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_lawfrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `slug`, `address`, `phone`, `status`, `created`, `modified`) VALUES
(1, 'Demo Supplier', 'demo-supplier', '43/B Azimpur colony, Lalbag, Newmarket, Dhaka-1205', '+8801914475313', 'active', '2015-05-30 17:02:22', '2015-05-30 17:02:22'),
(2, 'Demo Supplier 2', 'demo-supplier-2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', '+8801914475313', 'active', '2015-05-30 17:17:13', '2015-05-30 17:17:13');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `histories`
--

CREATE TABLE IF NOT EXISTS `histories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lawsuit_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `reporting_date` date NOT NULL,
  `remark` text NOT NULL,
  `status` enum('pending','complete') NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lawsuits`
--

CREATE TABLE IF NOT EXISTS `lawsuits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `client_id` int(11) NOT NULL,
  `type` enum('landvetting','litigation') NOT NULL,
  `status` enum('inactive','active','closed') NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `login_tokens`
--

CREATE TABLE IF NOT EXISTS `login_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` char(32) NOT NULL,
  `duration` varchar(32) NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `login_tokens`
--

INSERT INTO `login_tokens` (`id`, `user_id`, `token`, `duration`, `used`, `created`, `expires`) VALUES
(1, 3, '236c22d8f00f6f454afbc1a99d54746a', '2 weeks', 0, '2015-05-30 16:49:56', '2015-06-13 16:49:56'),
(2, 3, '7767126aaf3f9bfc0d06282041436b98', '2 weeks', 1, '2015-05-30 16:51:26', '2015-06-13 16:51:26'),
(3, 3, '96dfe680aa08cf28c72371318f8df64e', '2 weeks', 0, '2015-05-30 17:43:33', '2015-06-13 17:43:33'),
(4, 3, '080d83fda7dcbf02b8b7845eddde981f', '2 weeks', 1, '2015-05-31 13:29:01', '2015-06-14 13:29:01'),
(5, 3, '09e9f18f972a9d5053fdbbe3fbb9efb9', '2 weeks', 1, '2015-05-31 14:46:00', '2015-06-14 14:46:00'),
(6, 3, '2875245c33cb64ec3417438c080e0f59', '2 weeks', 1, '2015-05-31 15:44:34', '2015-06-14 15:44:34'),
(7, 3, '0f358b007ce53afa4aab83f0bab235a8', '2 weeks', 0, '2015-05-31 19:10:45', '2015-06-14 19:10:45'),
(8, 3, '6ecc6b4e36e40ab168a561539dee1e2f', '2 weeks', 1, '2015-06-01 12:04:48', '2015-06-15 12:04:48'),
(9, 3, '1e434204f62151e9419eb82fc4c87aa7', '2 weeks', 0, '2015-06-01 15:46:07', '2015-06-15 15:46:07'),
(10, 3, '1bfddd19af1df25dfd31a19eb12040b9', '2 weeks', 1, '2015-06-02 12:29:26', '2015-06-16 12:29:26'),
(11, 3, 'ddf8fa3d235ea7c15497df37858776c8', '2 weeks', 0, '2015-06-02 14:52:30', '2015-06-16 14:52:30'),
(12, 3, '9cec280717baa4c27d706a0db0c14039', '2 weeks', 1, '2015-06-02 16:43:39', '2015-06-16 16:43:39'),
(13, 3, '670d782181bf06704bb7640d3cdfba35', '2 weeks', 0, '2015-06-09 13:41:30', '2015-06-23 13:41:30');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `lawsuit_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `owner` int(11) NOT NULL,
  `assigned_to` int(11) NOT NULL,
  `follower` varchar(255) NOT NULL,
  `wanting_doc` tinyint(1) NOT NULL,
  `dead_line` datetime NOT NULL,
  `status` enum('pending','done') NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `group` enum('manager','admin','viewer') NOT NULL DEFAULT 'viewer',
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `group`, `status`, `created`, `modified`) VALUES
(1, 'Saiful Islam', 'saif@localhost.com', 'dee6bf91428937ea330e9cd746c0d580b0776115', 'admin', 'active', '2014-08-13 00:13:27', '2014-08-13 00:13:27'),
(3, 'Saiful Islam', 'musicalsaif@gmail.com', '5a48b793df2c33d6853ece230dbe66b8f4e6ccab', 'admin', 'active', '2015-03-07 07:06:34', '2015-03-07 07:06:34');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
