-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 24 aug 2012 kl 08:37
-- Serverversion: 5.1.36
-- PHP-version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `arbetsprov`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `programs`
--

CREATE TABLE IF NOT EXISTS `programs` (
  `pkey` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `start_time` time NOT NULL,
  `leadtext` text NOT NULL,
  `name` varchar(100) NOT NULL,
  `b-line` varchar(100) NOT NULL,
  `synopsis` text NOT NULL,
  `url` varchar(150) NOT NULL,
  PRIMARY KEY (`pkey`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumpning av Data i tabell `programs`
--

INSERT INTO `programs` (`pkey`, `date`, `start_time`, `leadtext`, `name`, `b-line`, `synopsis`, `url`) VALUES
(1, '2009-04-16 21:30:00', '17:00:00', 'Franz är en något udda barnflicka. Hon kommer från den tuffa New York-stadsdelen Queens och är en kvinna med starka åsikter, ett ansikte som skulle platsa på Vogues omslag, samt en röst som kan spräcka glas!', 'Program 1', 'Tysk thrillerserie', 'Maxwell ringer Frank och säger att han gjorde ett stort misstag för några månader sen. Fran blir alldeles till sig och hoppas att han ska förklara sin kärlek till henne. Istället handlar det bara om en skattedetalj. Fran flyttar ut och Sylvia tar över jobbet. Del 16:25', 'http://www.domain.tld/programname'),
(2, '2007-08-13 12:16:00', '21:00:00', 'Om familjerna Persson,Horton, Brady, Black, Kiriakis och deras vänner, grannar och rivaler i Salem, USA. Familjen Horton består bl a av Alice, sonen Mickey och barnbarnen Jennifer och Mike. Familjen Brady består bl a av Shawn och Caroline, som är familjens överhuvuden, samt Bo, Carrie, Samantha Sami, Marlena, Roamn och John. Intriger, romanser och spänning präglar denna serier som startade i USA 1965 och har därmed varit under inspelning i 40 år.', 'Program 2', 'Drama från 2003', 'Bröderna Persson berättar historier om hur de träffade varandra och reaktionen från Teds nya flickvän får nio av tio på knäpphetsskalan. Del 5:24', 'http://www.domain.tld/programname');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
