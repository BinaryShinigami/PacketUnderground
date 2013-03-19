-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 19, 2013 at 12:37 PM
-- Server version: 5.1.66-0+squeeze1
-- PHP Version: 5.3.3-7+squeeze14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `packetunderground`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE IF NOT EXISTS `blog_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `authorid` int(11) NOT NULL,
  `timestamp` date NOT NULL,
  `content` longtext NOT NULL,
  `slug` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `authorid` (`authorid`,`timestamp`),
  KEY `slug` (`slug`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `authorid`, `timestamp`, `content`, `slug`) VALUES
(1, 'Test Post', 1, '2013-03-14', 'This is a shitty sample test post for my blog system.', 'test-post-jew'),
(5, 'Sample Post', 1, '2013-03-19', 'This is a sample blog entry post for mah blog at <a href=''http://packetunderground.com''>Packet Underground</a><br /><br />\nCheck out mah guns!!!! You know you like em: \n<img src=''http://i.imgur.com/TPqN3oh.jpg?1'' width=''500px'' />', 'sample-post'),
(6, 'Woot This is hot', 1, '2013-03-19', 'That''s right bitches!!!! My blog is the shit!!!<br />You know you want my beautiful code for this awesome blog!! Well check out my github and you can find it !!!!', 'hot-blog');

-- --------------------------------------------------------

--
-- Table structure for table `blog_users`
--

CREATE TABLE IF NOT EXISTS `blog_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(64) NOT NULL,
  `permissions` int(11) NOT NULL,
  `salt` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`,`password`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `blog_users`
--

INSERT INTO `blog_users` (`id`, `username`, `password`, `permissions`, `salt`) VALUES
(1, 'Shane', '647f69a4c5f883f78335494f1b430b8c1281b317b398bb54d1fba61798989c3c', 128, '3910767121');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
