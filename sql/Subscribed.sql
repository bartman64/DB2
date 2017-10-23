-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 23. Okt 2017 um 15:29
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
-- Tabellenstruktur für Tabelle `Subscribed`
--

CREATE TABLE `Subscribed` (
  `Email` varchar(100) COLLATE utf8_bin NOT NULL,
  `Newsletter` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `Subscribed`
--

INSERT INTO `Subscribed` (`Email`, `Newsletter`) VALUES
('test2@gmail.com', '1. Liga'),
('muster@email.com', '1. Liga'),
('ste@mail.com', '1. Liga'),
('se.bi1994@hotmail.de', '1. Liga');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `Subscribed`
--
ALTER TABLE `Subscribed`
  ADD KEY `Email` (`Email`),
  ADD KEY `Newsletter` (`Newsletter`);

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `Subscribed`
--
ALTER TABLE `Subscribed`
  ADD CONSTRAINT `Subscribed_ibfk_1` FOREIGN KEY (`Email`) REFERENCES `User` (`Email`),
  ADD CONSTRAINT `Subscribed_ibfk_2` FOREIGN KEY (`Newsletter`) REFERENCES `Newsletter` (`Name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
