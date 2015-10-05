-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 05, 2015 at 12:04 PM
-- Server version: 5.6.25-0ubuntu0.15.04.1
-- PHP Version: 5.6.4-4ubuntu6.3

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
`id` int(11) NOT NULL,
  `item_type` enum('lawsuit','task','user','history','client','invoice','taskcomment') NOT NULL,
  `event` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `viewed` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

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
(20, 'history', 'update', 1, 1, 3, '', 0, '2015-09-16 16:31:33');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `person_designation` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `slug`, `address`, `contact_person`, `person_designation`, `phone`, `status`, `created`, `modified`) VALUES
(1, 'Brac Bank Limited', 'brac-bank-limited', 'Brac bank address, any where, Dhaka, Bangladesh', 'Brac Employee', '', '+8801914475313', 'active', '2015-05-30 17:02:22', '2015-06-28 16:07:47'),
(2, 'City Bank Limited', 'city-bank-limited', 'City bank address, any where, Dhaka, Bangladesh.', 'City Bank Employee', 'Employee Designation', '+8801914475313', 'active', '2015-05-30 17:17:13', '2015-08-02 14:18:22');

-- --------------------------------------------------------

--
-- Table structure for table `courts`
--

CREATE TABLE IF NOT EXISTS `courts` (
`id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rght` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courts`
--

INSERT INTO `courts` (`id`, `parent_id`, `lft`, `rght`, `name`, `slug`, `status`, `created`, `modified`) VALUES
(1, 0, 1, 6, 'Appellate Division', 'appellate-division', 'active', '2015-10-01 15:13:36', '2015-10-01 15:13:36'),
(2, 0, 7, 8, 'High Court Division', 'high-court-division', 'active', '2015-10-01 15:13:47', '2015-10-01 15:13:47'),
(3, 0, 9, 10, 'District Court', 'district-court', 'active', '2015-10-01 15:13:57', '2015-10-01 15:13:57'),
(4, 1, 2, 5, 'Civil Cases', 'civil-cases', 'active', '2015-10-01 15:14:49', '2015-10-01 15:14:49'),
(5, 4, 3, 4, 'Civil Appeal', 'civil-appeal', 'active', '2015-10-01 15:15:55', '2015-10-01 15:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
`id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `task_id`, `comment_id`, `name`, `path`, `created`, `modified`) VALUES
(1, 4, 9, 't4c936th-bcs-circular.pdf', '/home/shovan/PhpstormProjects/project-case/app/webroot/uploads/doc/', '2015-08-05 12:27:19', '2015-08-05 12:27:19'),
(2, 4, 9, 't4c9CV-shovan.pdf', '/home/shovan/PhpstormProjects/project-case/app/webroot/uploads/doc/', '2015-08-05 12:27:19', '2015-08-05 12:27:19'),
(3, 4, 9, 't4c9serverguide.pdf', '/home/shovan/PhpstormProjects/project-case/app/webroot/uploads/doc/', '2015-08-05 12:27:19', '2015-08-05 12:27:19'),
(4, 4, 9, 't4c9Shovan_Sarker_CV.pdf', '/home/shovan/PhpstormProjects/project-case/app/webroot/uploads/doc/', '2015-08-05 12:27:19', '2015-08-05 12:27:19'),
(5, 4, 10, 't4c1036th-bcs-circular.pdf', '/home/shovan/PhpstormProjects/project-case/app/webroot/uploads/doc/', '2015-08-05 12:30:38', '2015-08-05 12:30:38'),
(6, 4, 10, 't4c10CV-shovan.pdf', '/home/shovan/PhpstormProjects/project-case/app/webroot/uploads/doc/', '2015-08-05 12:30:39', '2015-08-05 12:30:39'),
(7, 4, 10, 't4c10Shovan_Sarker_CV.pdf', '/home/shovan/PhpstormProjects/project-case/app/webroot/uploads/doc/', '2015-08-05 12:30:39', '2015-08-05 12:30:39'),
(8, 4, 10, 't4c10Teletalk Bangladesh Ltd.pdf', '/home/shovan/PhpstormProjects/project-case/app/webroot/uploads/doc/', '2015-08-05 12:30:39', '2015-08-05 12:30:39'),
(9, 4, 11, 't4c111.pdf', '/home/shovan/PhpstormProjects/project-case/app/webroot/uploads/doc/', '2015-08-06 13:19:03', '2015-08-06 13:19:03');

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE IF NOT EXISTS `followers` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

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
(25, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `histories`
--

CREATE TABLE IF NOT EXISTS `histories` (
`id` int(11) NOT NULL,
  `lawsuit_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `court_name` varchar(255) NOT NULL,
  `reporting_date` date NOT NULL,
  `remark` text NOT NULL,
  `status` enum('pending','complete') NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `histories`
--

INSERT INTO `histories` (`id`, `lawsuit_id`, `title`, `slug`, `description`, `court_name`, `reporting_date`, `remark`, `status`, `created`, `modified`) VALUES
(1, 3, 'This is a new histroy', 'this-is-a-new-histroy', 'This is a description update 1', 'Court name goes here', '2015-08-09', 'wzxecrvtbynumi', 'pending', '2015-08-08 16:14:49', '2015-08-08 16:22:18'),
(2, 3, 'This is another histroy', 'this-is-another-histroy', 'This is another description', 'Court name goes here', '2015-08-29', '', 'pending', '2015-08-08 16:23:44', '2015-08-08 16:23:44');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `lawsuit_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `subject` text NOT NULL,
  `description` text NOT NULL,
  `amount` float NOT NULL,
  `deduction` text NOT NULL,
  `less_amount` float NOT NULL,
  `final_amount` float NOT NULL,
  `vat` float NOT NULL,
  `note` text NOT NULL,
  `status` enum('unpaid','paid') NOT NULL DEFAULT 'unpaid',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `name`, `slug`, `lawsuit_id`, `client_id`, `subject`, `description`, `amount`, `deduction`, `less_amount`, `final_amount`, `vat`, `note`, `status`, `created`, `modified`) VALUES
(1, 'Contrary to popular belief-01-05-08-15', 'contrary-to-popular-belief-01-05-08-15', 3, 2, 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.', 'a:5:{i:0;a:2:{s:4:"desc";s:24:"Opinion for Land vetting";s:6:"amount";s:4:"2850";}i:1;a:2:{s:4:"desc";s:25:"Drafting Deed of Mortgage";s:6:"amount";s:4:"2850";}i:2;a:2:{s:4:"desc";s:39:"Drafting IGPA to sell mortgage property";s:6:"amount";s:4:"2000";}i:3;a:2:{s:4:"desc";s:32:"Drafting Letter of Hypothecation";s:6:"amount";s:4:"2850";}i:4;a:2:{s:4:"desc";s:41:"Drafting IGPA te sell Hypothecated assets";s:6:"amount";s:4:"1750";}}', 12300, 'a:2:{i:0;a:2:{s:9:"deduction";s:45:"Advanced Income TAX @10% on professional fees";s:6:"amount";s:4:"1000";}i:1;a:2:{s:9:"deduction";s:30:"VAT @ 15% on professional fees";s:6:"amount";s:4:"1500";}}', 2500, 9800, 0, 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden', 'paid', '2015-08-05 18:28:18', '2015-09-16 13:23:53'),
(2, 'Lorem Ipsum 01-07-2015-01-06-08-15', 'lorem-ipsum-01-07-2015-01-06-08-15', 1, 1, 'There are many variations of passages of Lorem Ipsum available, but the majority', 'a:3:{i:0;a:2:{s:4:"desc";s:79:"Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots";s:6:"amount";s:4:"3250";}i:1;a:2:{s:4:"desc";s:43:"It is a long established fact that a reader";s:6:"amount";s:4:"2100";}i:2;a:2:{s:4:"desc";s:38:"The standard chunk of Lorem Ipsum used";s:6:"amount";s:3:"100";}}', 5450, 'a:1:{i:0;a:2:{s:9:"deduction";s:0:"";s:6:"amount";s:0:"";}}', 0, 5450, 0, 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'unpaid', '2015-08-06 12:49:57', '2015-08-06 12:49:57'),
(3, 'Contrary to popular belief-02-05-09-15', 'contrary-to-popular-belief-02-05-09-15', 3, 2, 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.', 'a:2:{i:0;a:2:{s:4:"desc";s:24:"Opinion for Land vetting";s:6:"amount";s:4:"2850";}i:1;a:2:{s:4:"desc";s:28:"2 Drafting Deed of Mortgage ";s:6:"amount";s:4:"2850";}}', 5700, 'a:2:{i:0;a:2:{s:9:"deduction";s:46:"Advanced Income TAX @10% on professional fees ";s:6:"amount";s:4:"1000";}i:1;a:2:{s:9:"deduction";s:0:"";s:6:"amount";s:0:"";}}', 1000, 4700, 0, 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden', 'paid', '2015-09-05 04:12:33', '2015-09-16 15:35:26');

-- --------------------------------------------------------

--
-- Table structure for table `lawsuits`
--

CREATE TABLE IF NOT EXISTS `lawsuits` (
`id` int(11) NOT NULL,
  `number` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `court_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `type` enum('landvetting','litigation') NOT NULL,
  `invoice_period` enum('1','2','3') NOT NULL DEFAULT '1',
  `break_point` enum('0','1','2') NOT NULL,
  `litigation_type` enum('criminal') NOT NULL,
  `party_01` varchar(255) NOT NULL,
  `party_02` varchar(255) NOT NULL,
  `status` enum('inactive','active','closed') NOT NULL DEFAULT 'active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lawsuits`
--

INSERT INTO `lawsuits` (`id`, `number`, `slug`, `client_id`, `court_id`, `note`, `type`, `invoice_period`, `break_point`, `litigation_type`, `party_01`, `party_02`, `status`, `created`, `modified`) VALUES
(1, 'Lorem Ipsum 01-07-2015', 'lorem-ipsum-01-07-2015', 1, 0, '<strong style="font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">Lorem Ipsum</strong><span style="font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</span>', 'landvetting', '2', '0', 'criminal', '', '', 'active', '2015-06-29 12:13:48', '2015-08-06 12:49:57'),
(2, 'Lorem Ipsum 09-07-2015', 'lorem-ipsum-09-07-2015', 2, 0, 'some desc', 'litigation', '1', '0', 'criminal', '', '', 'active', '2015-07-09 01:45:21', '2015-07-09 01:45:21'),
(3, 'Contrary to popular belief', 'contrary-to-popular-belief', 2, 0, '<strong style="font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">Lorem Ipsum</strong><span style="font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially</span>', 'landvetting', '3', '0', 'criminal', '', '', 'active', '2015-07-28 15:54:53', '2015-09-16 15:35:36'),
(4, 'There are many variations of passages', 'there-are-many-variations-of-passages', 1, 0, '<span style="font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.3</span>', 'landvetting', '1', '0', 'criminal', '', '', 'active', '2015-08-08 16:43:11', '2015-08-08 16:43:11'),
(5, '', NULL, 1, 0, '<strong style="font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">Lorem Ipsum</strong><span style="font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</span>', 'landvetting', '1', '0', 'criminal', '', '', 'active', '2015-08-19 17:17:29', '2015-08-19 17:17:29'),
(6, 'asdfasdf', 'asdfasdf', 2, 0, 'asfasdfasdfasf', 'litigation', '1', '', 'criminal', '', '', 'active', '2015-08-02 00:00:00', '2015-09-08 17:59:57');

-- --------------------------------------------------------

--
-- Table structure for table `login_tokens`
--

CREATE TABLE IF NOT EXISTS `login_tokens` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` char(32) NOT NULL,
  `duration` varchar(32) NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

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
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `type` enum('landvetting','litigation') NOT NULL,
  `status` enum('inactive','active') NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
`id` int(11) NOT NULL,
  `lawsuit_id` int(11) NOT NULL,
  `tasklist_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `owner` int(11) NOT NULL,
  `assigned_to` int(11) NOT NULL,
  `wanting_doc` tinyint(1) NOT NULL,
  `dead_line` date NOT NULL,
  `status` enum('pending','done') NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `lawsuit_id`, `tasklist_id`, `description`, `owner`, `assigned_to`, `wanting_doc`, `dead_line`, `status`, `created`, `modified`) VALUES
(1, 1, 0, '<font face="Arial, Verdana"><span style="font-size: 13.3333330154419px;">VALUES</span></font>', 1, 4, 0, '2015-07-23', 'pending', '2015-07-04 13:29:59', '2015-07-06 11:56:35'),
(2, 1, 0, 'ar moto faltu kaaj r nai... korle kor, na korle mor....', 1, 4, 0, '2015-08-29', 'pending', '2015-07-05 11:47:36', '2015-08-08 13:36:59'),
(3, 2, 0, 'QWERTYUIOPXCVBNM,./ZXCVBNM,.', 5, 2, 0, '0000-00-00', 'pending', '2015-07-12 12:16:33', '2015-07-12 12:16:33'),
(4, 1, 0, 'CVTRVT6F6TG6TFRFRFRFR', 5, 4, 0, '0000-00-00', 'pending', '2015-07-12 12:17:25', '2015-07-12 12:17:25'),
(5, 1, 0, 'TF55F5', 5, 4, 0, '2015-07-24', 'pending', '2015-07-12 12:20:29', '2015-07-12 12:20:29'),
(6, 3, 0, '<span style="font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readab</span>', 1, 4, 0, '2015-08-19', 'pending', '2015-08-08 12:35:40', '2015-08-08 12:35:40');

-- --------------------------------------------------------

--
-- Table structure for table `task_comments`
--

CREATE TABLE IF NOT EXISTS `task_comments` (
`id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

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
(13, 1, 1, 'this is another comment', '2015-08-08 15:17:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('manager','admin','viewer','employee') NOT NULL DEFAULT 'employee',
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `status`, `created`, `modified`) VALUES
(1, 'Saiful Islam', 'musicalsaif@gmail.com', '650d6ace27f334c4b1295dacc7e7f791588e134d', 'admin', 'active', '2015-06-28 13:38:41', '2015-06-28 13:38:41'),
(2, 'Shovan Sharkar', 'shovan@inflack.com', '2a7bc4bfa5efa3255c5325ff54253258beaf0299', 'employee', 'active', '2015-07-01 12:59:24', '2015-07-01 12:59:24'),
(3, 'Md. Wahidul Hawue', 'wahid.figo@gmail.com', '70257d432bc522b2e726722519525d19675d208e', 'employee', 'active', '2015-07-01 13:40:10', '2015-07-01 13:40:10'),
(4, 'Saiful Islam', 'saif@inflack.com', '650d6ace27f334c4b1295dacc7e7f791588e134d', 'employee', 'active', '2015-07-06 11:54:09', '2015-07-06 11:54:09'),
(5, 'Shovan', 'exorcist.shovan@gmail.com', '55c3287860209a88196b742acaee2d2db5b6d90c', 'employee', 'active', '2015-07-09 03:05:29', '2015-07-09 03:05:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courts`
--
ALTER TABLE `courts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `histories`
--
ALTER TABLE `histories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lawsuits`
--
ALTER TABLE `lawsuits`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_tokens`
--
ALTER TABLE `login_tokens`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasklists`
--
ALTER TABLE `tasklists`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_comments`
--
ALTER TABLE `task_comments`
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
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `courts`
--
ALTER TABLE `courts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `histories`
--
ALTER TABLE `histories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lawsuits`
--
ALTER TABLE `lawsuits`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `login_tokens`
--
ALTER TABLE `login_tokens`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `tasklists`
--
ALTER TABLE `tasklists`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `task_comments`
--
ALTER TABLE `task_comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
