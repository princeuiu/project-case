-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 05, 2015 at 11:31 AM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_lawfirm`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_type` enum('lawsuit','task','user','history','client','invoice','taskcomment') NOT NULL,
  `event` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `viewed` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `item_type`, `event`, `item_id`, `user_id`, `reference_id`, `description`, `viewed`, `created`) VALUES
(1, 'task', 'new', 3, 5, 2, '', 0, '2015-07-12 12:16:33'),
(2, 'task', 'new', 4, 5, 4, '', 0, '2015-07-12 12:17:25'),
(3, 'task', 'new', 5, 5, 4, '', 0, '2015-07-12 12:20:29'),
(4, 'task', 'new', 6, 1, 4, '', 0, '2015-08-08 12:35:40'),
(5, 'task', 'update', 2, 1, 4, '', 0, '2015-08-08 13:36:59'),
(6, 'taskcomment', 'new', 12, 1, 2, '', 0, '2015-08-08 15:13:27'),
(7, 'taskcomment', 'new', 13, 1, 1, '', 0, '2015-08-08 15:17:51'),
(11, 'history', 'new', 2, 4, 3, '', 0, '2015-08-08 16:23:44'),
(12, 'history', 'update', 1, 4, 3, '', 0, '2015-08-08 16:30:26'),
(13, 'history', 'update', 2, 4, 3, '', 0, '2015-08-08 16:31:11'),
(14, 'lawsuit', 'update', 3, 4, 0, '', 0, '2015-08-08 16:41:07'),
(15, 'lawsuit', 'update', 3, 4, 0, '', 0, '2015-08-08 16:41:36'),
(16, 'lawsuit', 'new', 4, 1, 0, '', 0, '2015-08-08 16:43:11'),
(17, 'history', 'update', 1, 4, 3, '', 0, '2015-08-08 18:19:52'),
(18, 'lawsuit', 'new', 5, 1, 0, '', 0, '2015-08-19 17:17:29'),
(19, 'lawsuit', 'new', 6, 1, 0, '', 0, '2015-09-08 17:59:57'),
(20, 'history', 'update', 1, 1, 3, '', 0, '2015-09-16 16:31:33'),
(21, 'task', 'new', 7, 1, 2, '', 0, '2015-10-07 13:40:44'),
(22, 'taskcomment', 'new', 14, 4, 4, '', 0, '2015-10-08 13:25:48'),
(23, 'taskcomment', 'new', 15, 4, 1, '', 0, '2015-10-08 15:32:24'),
(24, 'lawsuit', 'new', 7, 1, 0, '', 0, '2015-10-16 03:13:24'),
(25, 'lawsuit', 'new', 8, 1, 0, '', 0, '2015-10-16 05:48:39'),
(26, 'lawsuit', 'new', 9, 1, 0, '', 0, '2015-10-16 05:49:23'),
(27, 'lawsuit', 'new', 10, 1, 0, '', 0, '2015-10-16 05:50:09'),
(28, 'lawsuit', 'new', 11, 1, 0, '', 0, '2015-10-16 05:50:52'),
(29, 'lawsuit', 'update', 2, 1, 0, '', 0, '2015-10-19 04:19:55'),
(30, 'lawsuit', 'update', 6, 1, 0, '', 0, '2015-10-19 04:24:39'),
(31, 'lawsuit', 'new', 12, 1, 0, '', 0, '2015-10-19 19:41:33'),
(32, 'task', 'new', 8, 1, 4, '', 0, '2015-10-19 19:59:42'),
(33, 'taskcomment', 'new', 16, 4, 8, '', 0, '2015-10-19 20:04:33'),
(34, 'taskcomment', 'new', 17, 4, 8, '', 0, '2015-10-19 20:09:22'),
(35, 'task', 'new', 9, 1, 4, '', 0, '2015-10-19 20:13:52'),
(36, 'taskcomment', 'new', 18, 4, 9, '', 0, '2015-10-19 20:15:41'),
(37, 'lawsuit', 'update', 12, 1, 0, '', 0, '2015-10-19 20:38:47');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `inv_addressing` text NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `person_designation` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `slug`, `branch`, `address`, `inv_addressing`, `contact_person`, `person_designation`, `phone`, `status`, `created`, `modified`) VALUES
(1, 'Brac Bank Limited', 'brac-bank-limited', 'Motizil branch', 'Brac bank address, any where, Dhaka, Bangladesh', '', 'Brac Employee', '', '+8801914475313', 'active', '2015-05-30 17:02:22', '2015-10-26 16:02:59'),
(2, 'City Bank Limited', 'city-bank-limited', '', 'City bank address, any where, Dhaka, Bangladesh.', '', 'City Bank Employee', 'Employee Designation', '+8801914475313', 'active', '2015-05-30 17:17:13', '2015-08-02 14:18:22'),
(4, 'Quddus', 'quddus', '', '', '', '', '', '0171502587', 'active', '2015-10-19 19:26:18', '2015-10-19 19:26:18'),
(5, 'dfsdf', 'dfsdf', '', '', '', 'sdfds', '', 'fsd', 'active', '2015-10-26 12:11:49', '2015-10-26 12:11:49');

-- --------------------------------------------------------

--
-- Table structure for table `costs`
--

CREATE TABLE IF NOT EXISTS `costs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `costs`
--

INSERT INTO `costs` (`id`, `name`, `slug`, `price`, `status`, `created`, `modified`) VALUES
(1, '100 tk stamp paper', '100-tk-stamp-paper', 110, 'active', '2015-10-14 02:09:47', '2015-10-14 02:09:47'),
(2, '50 tk stamp paper', '50-tk-stamp-paper', 60, 'active', '2015-10-14 02:35:08', '2015-10-14 02:35:08'),
(3, '20 tk stamp paper', '20-tk-stamp-paper', 30, 'active', '2015-10-14 02:35:31', '2015-10-14 02:35:31'),
(4, 'Cartridge', 'cartridge', 20, 'active', '2015-10-14 02:36:08', '2015-10-14 02:36:08');

-- --------------------------------------------------------

--
-- Table structure for table `courts`
--

CREATE TABLE IF NOT EXISTS `courts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rght` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `courts`
--

INSERT INTO `courts` (`id`, `parent_id`, `lft`, `rght`, `name`, `slug`, `status`, `created`, `modified`) VALUES
(1, 0, 1, 58, 'Court', 'court', 'active', '2015-10-16 00:47:20', '2015-10-16 00:47:20'),
(2, 1, 2, 15, 'Appellate Division', 'appellate-division', 'active', '2015-10-16 01:15:12', '2015-10-16 01:15:12'),
(3, 1, 16, 21, 'High Court Division', 'high-court-division', 'active', '2015-10-16 01:23:25', '2015-10-16 01:23:25'),
(4, 2, 3, 12, 'Civil Cases', 'civil-cases', 'active', '2015-10-16 01:24:15', '2015-10-16 01:24:15'),
(5, 4, 4, 5, 'Civil Appeal', 'civil-appeal', 'active', '2015-10-16 01:25:35', '2015-10-16 01:25:35'),
(6, 3, 17, 18, 'Writ Petition', 'writ-petition', 'active', '2015-10-19 19:12:22', '2015-10-19 19:12:22'),
(7, 3, 19, 20, 'First Appeal', 'first-appeal', 'active', '2015-10-19 19:13:55', '2015-10-19 19:13:55'),
(8, 4, 6, 7, 'Civil Petition', 'civil-petition', 'active', '2015-10-20 10:23:48', '2015-10-20 10:23:48'),
(9, 4, 8, 9, 'Civil Miscellaneous Petition', 'civil-miscellaneous-petition', 'active', '2015-10-20 10:25:03', '2015-10-20 10:25:03'),
(10, 4, 10, 11, 'Civil Review Petition', 'civil-review-petition', 'active', '2015-10-20 10:25:38', '2015-10-20 10:25:38'),
(11, 2, 13, 14, 'Contempt Petition', 'contempt-petition', 'active', '2015-10-20 10:27:20', '2015-10-20 10:27:20'),
(12, 1, 22, 51, 'District Court', 'district-court', 'active', '2015-10-20 10:28:18', '2015-10-20 10:28:18'),
(13, 1, 52, 55, 'Sessions and Magistrates Court', 'sessions-and-magistrates-court', 'active', '2015-10-20 10:28:57', '2015-10-20 10:28:57'),
(14, 1, 56, 57, 'Tribunals', 'tribunals', 'active', '2015-10-20 10:29:23', '2015-10-20 10:29:23'),
(15, 12, 23, 24, 'Artha Rin Suit', 'artha-rin-suit', 'active', '2015-10-20 10:31:19', '2015-10-20 10:31:19'),
(16, 12, 25, 26, 'Money Suit', 'money-suit', 'active', '2015-10-20 10:31:41', '2015-10-20 10:31:41'),
(17, 12, 27, 28, 'Title Suit', 'title-suit', 'active', '2015-10-20 10:32:45', '2015-10-20 10:32:45'),
(18, 12, 29, 30, 'Miscellaneous Case', 'miscellaneous-case', 'active', '2015-10-20 10:34:47', '2015-10-20 10:34:47'),
(19, 12, 31, 32, 'House Rent Case', 'house-rent-case', 'active', '2015-10-20 10:35:35', '2015-10-20 10:35:35'),
(20, 12, 33, 34, 'Family Suit', 'family-suit', 'active', '2015-10-20 10:36:36', '2015-10-20 10:36:36'),
(21, 12, 35, 36, 'Artha Execution Case', 'artha-execution-case', 'active', '2015-10-20 10:37:00', '2015-10-20 10:37:00'),
(22, 12, 37, 38, 'Money Execution Case', 'money-execution-case', 'active', '2015-10-20 10:37:14', '2015-10-20 10:37:14'),
(23, 12, 39, 40, 'Title Execution Case', 'title-execution-case', 'active', '2015-10-20 10:37:24', '2015-10-20 10:37:24'),
(24, 12, 41, 42, 'Succession Case', 'succession-case', 'active', '2015-10-20 11:23:50', '2015-10-20 11:23:50'),
(25, 12, 43, 44, 'Arbitration Miscellaneous Case', 'arbitration-miscellaneous-case', 'active', '2015-10-20 11:28:32', '2015-10-20 11:28:32'),
(26, 12, 45, 46, 'Permission Case', 'permission-case', 'active', '2015-10-20 21:17:25', '2015-10-20 21:17:25'),
(27, 12, 47, 48, 'Session Case', 'session-case', 'active', '2015-10-20 21:17:55', '2015-10-20 21:17:55'),
(28, 12, 49, 50, 'Bankruptcy Case', 'bankruptcy-case', 'active', '2015-10-20 21:18:33', '2015-10-20 21:18:33'),
(29, 13, 53, 54, 'Complaint Case', 'complaint-case', 'active', '2015-10-20 21:19:07', '2015-10-20 21:19:07');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `done` tinyint(1) NOT NULL DEFAULT '0',
  `office_copy` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `task_id`, `comment_id`, `name`, `path`, `done`, `office_copy`, `created`, `modified`) VALUES
(1, 4, 9, 't4c936th-bcs-circular.pdf', '/home/shovan/PhpstormProjects/project-case/app/webroot/uploads/doc/', 0, 0, '2015-08-05 12:27:19', '2015-08-05 12:27:19'),
(2, 4, 9, 't4c9CV-shovan.pdf', '/home/shovan/PhpstormProjects/project-case/app/webroot/uploads/doc/', 0, 0, '2015-08-05 12:27:19', '2015-08-05 12:27:19'),
(3, 4, 9, 't4c9serverguide.pdf', '/home/shovan/PhpstormProjects/project-case/app/webroot/uploads/doc/', 0, 0, '2015-08-05 12:27:19', '2015-08-05 12:27:19'),
(4, 4, 9, 't4c9Shovan_Sarker_CV.pdf', '/home/shovan/PhpstormProjects/project-case/app/webroot/uploads/doc/', 0, 0, '2015-08-05 12:27:19', '2015-08-05 12:27:19'),
(5, 4, 10, 't4c1036th-bcs-circular.pdf', '/home/shovan/PhpstormProjects/project-case/app/webroot/uploads/doc/', 0, 0, '2015-08-05 12:30:38', '2015-08-05 12:30:38'),
(6, 4, 10, 't4c10CV-shovan.pdf', '/home/shovan/PhpstormProjects/project-case/app/webroot/uploads/doc/', 0, 0, '2015-08-05 12:30:39', '2015-08-05 12:30:39'),
(7, 4, 10, 't4c10Shovan_Sarker_CV.pdf', '/home/shovan/PhpstormProjects/project-case/app/webroot/uploads/doc/', 0, 0, '2015-08-05 12:30:39', '2015-08-05 12:30:39'),
(8, 4, 10, 't4c10Teletalk Bangladesh Ltd.pdf', '/home/shovan/PhpstormProjects/project-case/app/webroot/uploads/doc/', 0, 0, '2015-08-05 12:30:39', '2015-08-05 12:30:39'),
(9, 4, 11, 't4c111.pdf', '/home/shovan/PhpstormProjects/project-case/app/webroot/uploads/doc/', 0, 0, '2015-08-06 13:19:03', '2015-08-06 13:19:03'),
(10, 4, 14, 't4c14Screenshot from 2015-10-06 17:19:46.png', '/home/shovan/PhpstormProjects/project-case/app/webroot/uploads/doc/', 1, 0, '2015-10-08 13:25:48', '2015-10-08 13:25:48'),
(11, 1, 15, 't1c15live.jpg', '/home/shovan/PhpstormProjects/project-case/app/webroot/uploads/doc/', 1, 0, '2015-10-08 15:32:24', '2015-10-08 15:32:24'),
(12, 8, 16, 't8c16Extra Certificate Information.xlsx', '/home/lawfirm/www/public_html/project-case/app/webroot/uploads/doc/', 0, 0, '2015-10-19 20:04:37', '2015-10-19 20:04:37'),
(13, 8, 17, 't8c17print.pdf', '/home/lawfirm/www/public_html/project-case/app/webroot/uploads/doc/', 1, 0, '2015-10-19 20:09:22', '2015-10-19 20:09:22'),
(14, 9, 18, 't9c18print.pdf', '/home/lawfirm/www/public_html/project-case/app/webroot/uploads/doc/', 1, 0, '2015-10-19 20:15:41', '2015-10-19 20:15:41'),
(15, 1, 0, 't1c0fares.jpg', '/home/lawfirm/www/public_html/project-case/app/webroot/uploads/doc/', 0, 0, '2015-10-26 15:58:25', '2015-10-26 15:58:25'),
(16, 1, 0, 't1c0pro-img.jpg', '/home/lawfirm/www/public_html/project-case/app/webroot/uploads/doc/', 0, 1, '2015-10-26 16:02:09', '2015-10-26 16:02:09');

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE IF NOT EXISTS `followers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `user_id`, `task_id`) VALUES
(16, 2, 1),
(17, 3, 1),
(20, 4, 3),
(21, 3, 5),
(22, 2, 6),
(23, 3, 6),
(24, 2, 2),
(25, 3, 2),
(26, 3, 7),
(27, 4, 7);

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
  `court_name` varchar(255) NOT NULL,
  `reporting_date` date NOT NULL,
  `till_next_hearing` tinyint(1) NOT NULL,
  `remark` text NOT NULL,
  `status` enum('pending','complete') NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `histories`
--

INSERT INTO `histories` (`id`, `lawsuit_id`, `title`, `slug`, `description`, `court_name`, `reporting_date`, `till_next_hearing`, `remark`, `status`, `created`, `modified`) VALUES
(1, 3, 'This is a new histroy', 'this-is-a-new-histroy', 'This is a description update 1', 'Court name goes here', '2015-08-09', 0, 'wzxecrvtbynumi', 'pending', '2015-08-08 16:14:49', '2015-08-08 16:22:18'),
(2, 3, 'This is another histroy', 'this-is-another-histroy', 'This is another description', 'Court name goes here', '2015-08-29', 0, '', 'pending', '2015-08-08 16:23:44', '2015-08-08 16:23:44');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `lawsuit_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `subject` text NOT NULL,
  `f_cost` text NOT NULL,
  `f_amount` float NOT NULL,
  `v_cost` text NOT NULL,
  `v_amount` float NOT NULL,
  `description` text NOT NULL,
  `amount` float NOT NULL,
  `total_amount` float NOT NULL,
  `final_amount` float NOT NULL,
  `vat` int(11) NOT NULL,
  `vat_amount` float NOT NULL,
  `tax` int(11) NOT NULL,
  `tax_amount` float NOT NULL,
  `total_deduction` float NOT NULL,
  `note` text NOT NULL,
  `status` enum('unpaid','paid') NOT NULL DEFAULT 'unpaid',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `name`, `slug`, `lawsuit_id`, `client_id`, `subject`, `f_cost`, `f_amount`, `v_cost`, `v_amount`, `description`, `amount`, `total_amount`, `final_amount`, `vat`, `vat_amount`, `tax`, `tax_amount`, `total_deduction`, `note`, `status`, `created`, `modified`) VALUES
(1, '1-01-31-10-15', '1-01-31-10-15', 12, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s,', 'a:0:{}', 0, 'a:0:{}', 0, 'a:2:{i:0;a:2:{s:4:"desc";s:27:"Lorem Ipsum is simply dummy";s:6:"amount";s:4:"3000";}i:1;a:2:{s:4:"desc";s:27:"Contrary to popular belief,";s:6:"amount";s:4:"2000";}}', 5000, 5000, 5000, 0, 0, 0, 0, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s,', 'unpaid', '2015-10-31 16:26:52', '2015-10-31 16:26:52'),
(3, '1-02-31-10-15', '1-02-31-10-15', 12, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s,', 'a:4:{i:0;a:3:{s:4:"name";s:18:"100 tk stamp paper";s:5:"price";s:3:"110";s:3:"qty";s:1:"2";}i:1;a:3:{s:4:"name";s:17:"50 tk stamp paper";s:5:"price";s:2:"60";s:3:"qty";s:1:"5";}i:2;a:3:{s:4:"name";s:17:"20 tk stamp paper";s:5:"price";s:2:"30";s:3:"qty";s:1:"3";}i:3;a:3:{s:4:"name";s:9:"Cartridge";s:5:"price";s:2:"20";s:3:"qty";s:1:"5";}}', 710, 'a:2:{i:0;a:2:{s:5:"vCost";s:24:"It is a long established";s:6:"amount";s:3:"150";}i:1;a:2:{s:5:"vCost";s:28:"There are many variations of";s:6:"amount";s:3:"500";}}', 650, 'a:2:{i:0;a:2:{s:4:"desc";s:27:"Contrary to popular belief,";s:6:"amount";s:4:"2000";}i:1;a:2:{s:4:"desc";s:25:"There are many variations";s:6:"amount";s:4:"4500";}}', 7475, 8835, 7112.5, 15, 975, 10, 747.5, 1722.5, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s,', 'unpaid', '2015-10-31 16:35:30', '2015-10-31 16:35:30');

-- --------------------------------------------------------

--
-- Table structure for table `invoices_costs`
--

CREATE TABLE IF NOT EXISTS `invoices_costs` (
  `invoice_id` int(11) NOT NULL,
  `cost_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lawsuits`
--

CREATE TABLE IF NOT EXISTS `lawsuits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `court_id` int(11) NOT NULL,
  `court_name` varchar(255) NOT NULL,
  `client_info` text NOT NULL,
  `not_corp` tinyint(1) NOT NULL,
  `year` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `type` enum('landvetting','litigation') NOT NULL,
  `invoice_period` enum('1','2','3','no') NOT NULL DEFAULT '1',
  `break_point` enum('0','1','2','no') NOT NULL,
  `party_01` varchar(255) NOT NULL,
  `party_02` varchar(255) NOT NULL,
  `appearing_for` enum('party_01','party_02') NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `status` enum('inactive','active','closed') NOT NULL DEFAULT 'active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `lawsuits`
--

INSERT INTO `lawsuits` (`id`, `number`, `slug`, `client_id`, `court_id`, `court_name`, `client_info`, `not_corp`, `year`, `note`, `type`, `invoice_period`, `break_point`, `party_01`, `party_02`, `appearing_for`, `created_by`, `status`, `created`, `modified`) VALUES
(1, 'Lorem Ipsum 01-07-2015', 'lorem-ipsum-01-07-2015', 1, 0, '', '', 0, '', '<strong style="font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">Lorem Ipsum</strong><span style="font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</span>', 'landvetting', '2', '0', '', '', 'party_01', '', 'active', '2015-06-29 12:13:48', '2015-08-06 12:49:57'),
(2, 'Lorem Ipsum 09-07-2015', 'lorem-ipsum-09-07-2015', 2, 5, '', '', 0, '2012', 'some desc', 'litigation', '1', '0', 'omuk', 'tomuk', 'party_02', '', 'active', '2015-07-09 01:45:21', '2015-10-19 04:19:55'),
(3, 'Contrary to popular belief', 'contrary-to-popular-belief', 2, 0, '', '', 0, '', '<strong style="font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">Lorem Ipsum</strong><span style="font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially</span>', 'landvetting', '3', '0', '', '', 'party_01', '', 'active', '2015-07-28 15:54:53', '2015-09-16 15:35:36'),
(4, 'There are many variations of passages', 'there-are-many-variations-of-passages', 1, 0, '', '', 0, '', '<span style="font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.3</span>', 'landvetting', '1', '0', '', '', 'party_01', '', 'active', '2015-08-08 16:43:11', '2015-08-08 16:43:11'),
(5, '', NULL, 1, 0, '', '', 0, '', '<strong style="font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">Lorem Ipsum</strong><span style="font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</span>', 'landvetting', '1', '0', '', '', 'party_01', '', 'active', '2015-08-19 17:17:29', '2015-08-19 17:17:29'),
(6, 'asdfasdf', 'asdfasdf', 2, 5, '', '', 0, '2013', 'asfasdfasdfasf', 'litigation', '1', '', 'omuk', 'tomuk', 'party_01', '', 'active', '2015-08-02 00:00:00', '2015-10-19 04:24:38'),
(7, 'habi jabi', 'habi-jabi', 1, 5, '', '', 0, '2008', 'habi jabi habi jabi', 'litigation', '1', '0', 'omuk', 'tomuk', 'party_01', '', 'active', '2015-10-16 03:13:24', '2015-10-16 03:13:24'),
(8, 'habi jabi 1', 'habi-jabi-1', 1, 5, '', '', 0, '2008', '', 'litigation', '1', '0', 'omuk', 'tomuk', 'party_01', '', 'active', '2015-10-16 00:00:00', '2015-10-16 05:48:39'),
(9, 'habi jabi 2', 'habi-jabi-2', 1, 5, '', '', 0, '2008', '', 'litigation', '1', '1', 'omuk', 'tomuk', 'party_01', '', 'active', '2015-10-04 00:00:00', '2015-10-16 05:49:23'),
(10, 'habi jabi 3', 'habi-jabi-3', 1, 5, '', '', 0, '2010', '', 'litigation', '1', '0', 'omuk', 'tomuk', 'party_01', '', 'active', '2015-10-04 00:00:00', '2015-10-16 05:50:09'),
(11, 'habi jabi 4', 'habi-jabi-4', 1, 5, '', '', 0, '2012', '', 'litigation', '1', '0', 'omuk', 'tomuk', 'party_01', '', 'active', '2015-10-01 00:00:00', '2015-10-16 05:50:52'),
(12, '1', '1', 1, 5, '', '', 0, '2015', '', 'litigation', '3', '', 'Helal Uddin', 'Govt', 'party_02', 'admin', 'active', '2015-10-19 00:00:00', '2015-10-31 16:35:30');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

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
(13, 3, '670d782181bf06704bb7640d3cdfba35', '2 weeks', 0, '2015-06-09 13:41:30', '2015-06-23 13:41:30'),
(14, 1, '5e9e0f551fb15361e097316e164d8c66', '2 weeks', 1, '2015-06-28 15:25:20', '2015-07-12 15:25:20'),
(15, 1, '0f91f3f04394c0efc7365ab394e6ed24', '2 weeks', 1, '2015-06-28 17:21:41', '2015-07-12 17:21:41'),
(16, 1, '4bdc49ca6eb3aedad6306629da23778b', '2 weeks', 1, '2015-06-29 11:39:38', '2015-07-13 11:39:38'),
(17, 1, '31ec5da71bfea149561f16d8e4c5cd48', '2 weeks', 0, '2015-06-29 14:18:19', '2015-07-13 14:18:19'),
(18, 1, '8f7305ecf26bb1628fe6215fcf62b813', '2 weeks', 1, '2015-06-29 15:45:23', '2015-07-13 15:45:23'),
(19, 1, 'e9121504630220a688dfb3da82f73497', '2 weeks', 1, '2015-07-01 12:39:01', '2015-07-15 12:39:01'),
(20, 1, '3ac46246aef7212a1ae02b075db0119c', '2 weeks', 1, '2015-07-02 11:00:13', '2015-07-16 11:00:13'),
(21, 1, '6815539ddba0c74b5b74c11ab0483780', '2 weeks', 0, '2015-07-02 15:22:42', '2015-07-16 15:22:42'),
(22, 1, '2e17f5e336777aa4cfa0b3736f351ac2', '2 weeks', 0, '2015-07-06 11:51:14', '2015-07-20 11:51:14'),
(23, 4, 'fa47b39e43ea0a2e3bd01a931c464402', '2 weeks', 0, '2015-07-06 11:57:42', '2015-07-20 11:57:42'),
(24, 4, 'a48eba56331dd4adf42cadbaf8837b3a', '2 weeks', 0, '2015-07-06 12:29:34', '2015-07-20 12:29:34'),
(25, 4, '278fb17121066477a15ad2ffb4343240', '2 weeks', 0, '2015-07-06 12:54:02', '2015-07-20 12:54:02'),
(26, 1, 'ee89d36e51decf186ba7a139e7c5a746', '2 weeks', 0, '2015-07-06 12:57:39', '2015-07-20 12:57:39'),
(27, 1, 'f5f782b50a7f7a908fecf94cfe7e03d3', '2 weeks', 0, '2015-07-06 12:57:51', '2015-07-20 12:57:51'),
(28, 1, '8c4d0e5a2bbf8ba1feaad141ce303e62', '2 weeks', 0, '2015-07-06 12:58:05', '2015-07-20 12:58:05'),
(29, 1, '396f2b70403a0eff369e56f9760ca501', '2 weeks', 0, '2015-07-06 13:00:20', '2015-07-20 13:00:20'),
(30, 4, 'a17fe5e6da53df0a5db973bdbd9050fa', '2 weeks', 0, '2015-07-06 13:02:41', '2015-07-20 13:02:41'),
(31, 1, 'd031ab1759684aabe22a5c8cf255caa2', '2 weeks', 0, '2015-07-06 13:08:19', '2015-07-20 13:08:19'),
(32, 1, '282431f1e065c5281dd016f3bef58234', '2 weeks', 0, '2015-07-06 13:15:27', '2015-07-20 13:15:27'),
(33, 1, 'b7ee5fb661ee2167178a8c667ad9a965', '2 weeks', 0, '2015-07-06 13:36:01', '2015-07-20 13:36:01'),
(34, 1, 'c73056067d8cb78e8bed27bf8072dea9', '2 weeks', 0, '2015-07-06 13:44:27', '2015-07-20 13:44:27'),
(35, 1, '8a28f108a01755f8cc4582ab19879d57', '2 weeks', 0, '2015-07-06 13:48:48', '2015-07-20 13:48:48'),
(36, 1, 'cc647576ce98ac3584caa362e668b32c', '2 weeks', 0, '2015-07-06 14:07:44', '2015-07-20 14:07:44'),
(37, 1, '24ffaf691ef30666c37a58f7e469fda5', '2 weeks', 0, '2015-07-07 11:04:06', '2015-07-21 11:04:06'),
(38, 4, 'bc7b50fe8624a19aa57bb67188357fe7', '2 weeks', 1, '2015-07-07 11:41:45', '2015-07-21 11:41:45'),
(39, 4, 'ce575c26d9dcf2d7fee51fe169bb4cb5', '2 weeks', 1, '2015-07-07 13:13:19', '2015-07-21 13:13:19'),
(40, 4, '2874acd60d0553dc4eb01a4f806b6231', '2 weeks', 1, '2015-07-07 16:33:28', '2015-07-21 16:33:28'),
(41, 4, '0f317db42a1db5f602cfa254d706e3ee', '2 weeks', 1, '2015-07-09 00:30:54', '2015-07-23 00:30:54'),
(42, 4, '5422d065b4ecde0f206eb3d346c9ab27', '2 weeks', 0, '2015-07-09 02:24:56', '2015-07-23 02:24:56'),
(43, 5, 'ab2515dffb5381a7888d0dd3e2a2d275', '2 weeks', 0, '2015-07-09 03:06:01', '2015-07-23 03:06:01'),
(44, 4, '35611e2914826908c197ac631baf5219', '2 weeks', 1, '2015-07-09 03:08:49', '2015-07-23 03:08:49'),
(45, 4, 'b2b36d631d0668e4f1a66e3b5d15da9d', '2 weeks', 0, '2015-07-09 05:25:44', '2015-07-23 05:25:44'),
(46, 5, '6c614dbdf873b0d3c8852d04c7141af6', '2 weeks', 0, '2015-07-09 05:25:50', '2015-07-23 05:25:50'),
(47, 4, '38524549e70e99872476b28546307989', '2 weeks', 1, '2015-07-09 05:29:09', '2015-07-23 05:29:09'),
(48, 4, '8cbabec11b526ed56351b9e19b77b743', '2 weeks', 0, '2015-07-09 08:40:26', '2015-07-23 08:40:26'),
(49, 4, 'f17ab016ea4aa1532bd98d86b11e2524', '2 weeks', 1, '2015-07-09 08:41:06', '2015-07-23 08:41:06'),
(50, 4, 'e963d626422436f24fa7048a159d106d', '2 weeks', 1, '2015-07-09 10:58:17', '2015-07-23 10:58:17'),
(51, 4, 'a76b5ce4293122da52b62ffb61995a32', '2 weeks', 0, '2015-07-11 12:56:55', '2015-07-25 12:56:55'),
(52, 1, 'd92fdb29f97e500c6d41bc5336bdfe02', '2 weeks', 1, '2015-08-07 02:22:50', '2015-08-21 02:22:50'),
(53, 1, '3f71f473de13204da4ed7dc6ce921191', '2 weeks', 0, '2015-08-07 02:23:57', '2015-08-21 02:23:57');

-- --------------------------------------------------------

--
-- Table structure for table `tasklists`
--

CREATE TABLE IF NOT EXISTS `tasklists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `type` enum('landvetting','litigation') NOT NULL,
  `status` enum('inactive','active') NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tasklists`
--

INSERT INTO `tasklists` (`id`, `name`, `slug`, `type`, `status`, `created`, `modified`) VALUES
(1, 'Task name 01 for landvatting', 'task-name-01-for-landvatting', 'landvetting', 'active', '2015-10-05 12:58:35', '2015-10-07 13:31:06'),
(2, 'Task name 02 for landvatting', 'task-name-02-for-landvatting', 'landvetting', 'active', '2015-10-07 13:30:56', '2015-10-07 13:30:56'),
(3, 'Task name 03 for landvatting', 'task-name-03-for-landvatting', 'landvetting', 'active', '2015-10-07 13:31:17', '2015-10-07 13:31:17'),
(4, 'Task name 01 for litigation', 'task-name-01-for-litigation', 'litigation', 'active', '2015-10-07 13:33:32', '2015-10-20 11:30:33'),
(5, 'Task name 02 for litigation', 'task-name-02-for-litigation', 'litigation', 'active', '2015-10-07 13:33:54', '2015-10-07 13:33:54'),
(6, 'Task name 03 for litigation', 'task-name-03-for-litigation', 'litigation', 'active', '2015-10-07 13:34:15', '2015-10-07 13:34:15'),
(7, 'Affidavit-in-Compliance', 'affidavit-in-compliance', 'litigation', 'active', '2015-10-19 19:53:04', '2015-10-19 19:53:04'),
(8, 'Affidavit-in-Opposition', 'affidavit-in-opposition', 'litigation', 'active', '2015-10-19 19:53:42', '2015-10-19 19:53:42'),
(9, 'Modification Application', 'modification-application', 'litigation', 'active', '2015-10-19 19:57:46', '2015-10-19 19:57:46'),
(10, 'Opinion - Land Vetting', 'opinion-land-vetting', 'landvetting', 'active', '2015-10-20 21:08:15', '2015-10-20 21:08:15'),
(11, 'Opinion - Search Report (Land)', 'opinion-search-report-land', 'landvetting', 'active', '2015-10-20 21:08:54', '2015-10-20 21:08:54'),
(12, 'Opinion - Search Report (RJSC)', 'opinion-search-report-rjsc', 'landvetting', 'active', '2015-10-20 21:09:39', '2015-10-20 21:09:39'),
(13, 'Legal Notice', 'legal-notice', 'landvetting', 'active', '2015-10-20 21:10:11', '2015-10-20 21:10:11'),
(14, 'Correspondence', 'correspondence', 'landvetting', 'active', '2015-10-20 21:11:54', '2015-10-20 21:11:54'),
(15, 'Documentation', 'documentation', 'landvetting', 'active', '2015-10-20 21:12:21', '2015-10-20 21:12:21'),
(16, 'Opinion', 'opinion-1', 'landvetting', 'active', '2015-10-25 12:50:13', '2015-10-25 12:50:13');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lawsuit_id` int(11) NOT NULL,
  `tasklist_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `owner` int(11) NOT NULL,
  `assigned_to` int(11) NOT NULL,
  `wanting_doc` tinyint(1) NOT NULL,
  `dead_line` date NOT NULL,
  `status` enum('pending','done') NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `lawsuit_id`, `tasklist_id`, `description`, `owner`, `assigned_to`, `wanting_doc`, `dead_line`, `status`, `created`, `modified`) VALUES
(1, 1, 1, '<font face="Arial, Verdana"><span style="font-size: 13.3333330154419px;">VALUES</span></font>', 1, 4, 0, '2015-07-23', 'done', '2015-07-04 13:29:59', '2015-10-08 15:32:25'),
(2, 1, 2, 'ar moto faltu kaaj r nai... korle kor, na korle mor....', 1, 4, 0, '2015-08-29', 'pending', '2015-07-05 11:47:36', '2015-08-08 13:36:59'),
(3, 2, 6, 'QWERTYUIOPXCVBNM,./ZXCVBNM,.', 5, 2, 0, '0000-00-00', 'pending', '2015-07-12 12:16:33', '2015-07-12 12:16:33'),
(4, 1, 3, 'CVTRVT6F6TG6TFRFRFRFR', 5, 4, 0, '0000-00-00', 'done', '2015-07-12 12:17:25', '2015-10-08 13:25:48'),
(5, 1, 3, 'TF55F5', 5, 4, 0, '2015-07-24', 'pending', '2015-07-12 12:20:29', '2015-07-12 12:20:29'),
(6, 3, 2, '<span style="font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readab</span>', 1, 4, 0, '2015-08-19', 'pending', '2015-08-08 12:35:40', '2015-08-08 12:35:40'),
(7, 6, 5, '<strong style="font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">Lorem Ipsum</strong><span style="font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset</span>', 1, 2, 0, '2015-10-21', 'pending', '2015-10-07 13:40:44', '2015-10-07 13:40:44'),
(8, 12, 9, '', 1, 4, 0, '2015-10-22', 'done', '2015-10-19 19:59:42', '2015-10-19 20:09:22'),
(9, 12, 7, '<br>', 1, 4, 0, '2015-10-19', 'done', '2015-10-19 20:13:52', '2015-10-19 20:15:41');

-- --------------------------------------------------------

--
-- Table structure for table `task_comments`
--

CREATE TABLE IF NOT EXISTS `task_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `task_comments`
--

INSERT INTO `task_comments` (`id`, `task_id`, `user_id`, `body`, `created`) VALUES
(1, 1, 4, 'hi all.........', '2015-07-09 05:36:03'),
(2, 1, 4, 'valo hoise', '2015-07-09 05:46:01'),
(3, 1, 4, 'dekhi thik ase naki !', '2015-07-09 05:58:15'),
(4, 1, 4, 'cool hoise na ???', '2015-07-09 06:10:44'),
(5, 2, 4, 'comment 1', '2015-07-09 07:11:33'),
(6, 2, 4, 'comment 2', '2015-07-09 07:11:41'),
(7, 2, 4, 'parmu na\r\n', '2015-07-09 07:11:47'),
(8, 4, 5, 'AWSEDRFGTYHUJIK', '2015-07-12 12:19:47'),
(9, 4, 4, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the', '2015-08-05 12:27:19'),
(10, 4, 4, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the', '2015-08-05 12:30:38'),
(11, 4, 4, 'asfasdfasfasdf wwsdfasdff', '2015-08-06 13:19:03'),
(12, 2, 1, 'This is  a comment', '2015-08-08 15:13:27'),
(13, 1, 1, 'this is another comment', '2015-08-08 15:17:51'),
(14, 4, 4, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has.', '2015-10-08 13:25:48'),
(15, 1, 4, 'This task is done.', '2015-10-08 15:32:24'),
(16, 8, 4, 'Dear Sir, This task is done, Thanks.', '2015-10-19 20:04:28'),
(17, 8, 4, 'Done', '2015-10-19 20:09:22'),
(18, 9, 4, 'Done', '2015-10-19 20:15:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('manager','admin','viewer','employee') NOT NULL DEFAULT 'employee',
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `status`, `created`, `modified`) VALUES
(1, 'admin', 'admin@inflack.net', '650d6ace27f334c4b1295dacc7e7f791588e134d', 'admin', 'active', '2015-06-28 13:38:41', '2015-06-28 13:38:41'),
(2, 'Shovan Sharkar', 'shovan@inflack.com', '2a7bc4bfa5efa3255c5325ff54253258beaf0299', 'employee', 'active', '2015-07-01 12:59:24', '2015-07-01 12:59:24'),
(3, 'Md. Wahidul Hawue', 'wahid.figo@gmail.com', '70257d432bc522b2e726722519525d19675d208e', 'employee', 'active', '2015-07-01 13:40:10', '2015-07-01 13:40:10'),
(4, 'employee01', 'employee01@inflack.net', '650d6ace27f334c4b1295dacc7e7f791588e134d', 'employee', 'active', '2015-07-06 11:54:09', '2015-07-06 11:54:09'),
(5, 'Shovan', 'exorcist.shovan@gmail.com', '55c3287860209a88196b742acaee2d2db5b6d90c', 'employee', 'active', '2015-07-09 03:05:29', '2015-07-09 03:05:29'),
(9, 'Shovan Sarker', 'exorcist.shovan@gmail.com', 'dafd4df466ab6d18f0f21d1827a31e76e95162e3', 'employee', 'active', '2015-08-08 19:06:59', '2015-08-08 19:06:59');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
