-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 23. Okt 2017 um 13:42
-- Server-Version: 10.1.26-MariaDB
-- PHP-Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `uebung1`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `MailingList`
--

CREATE TABLE `MailingList` (
  `Email` varchar(200) COLLATE utf8_bin NOT NULL,
  `Name` varchar(200) COLLATE utf8_bin NOT NULL,
  `VereinMitglied` tinyint(1) NOT NULL,
  `1Liga` tinyint(1) DEFAULT NULL,
  `2Liga` tinyint(1) DEFAULT NULL,
  `3Liga` tinyint(1) DEFAULT NULL,
  `RegionalligaBayern` tinyint(1) DEFAULT NULL,
  `WM2018` tinyint(1) DEFAULT NULL,
  `Nationalmannschaft` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `MailingList`
--

INSERT INTO `MailingList` (`Email`, `Name`, `VereinMitglied`, `1Liga`, `2Liga`, `3Liga`, `RegionalligaBayern`, `WM2018`, `Nationalmannschaft`) VALUES
('deniz@hm.edu', 'Deniz', 0, 1, 1, 0, 0, 0, 1),
('muster@email.com', 'Max', 1, 0, 0, 0, 0, 0, 1),
('se.bi1994@hotmail.de', 'Sebastian', 0, 0, 0, 0, 0, 0, 1),
('test@gmail.com', 'Max', 1, 1, 0, 0, 0, 0, 0);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `MailingList`
--
ALTER TABLE `MailingList`
  ADD PRIMARY KEY (`Email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
