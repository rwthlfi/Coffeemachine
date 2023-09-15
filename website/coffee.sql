-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 11. Aug 2023 um 13:12
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `coffee`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product`
--

CREATE TABLE `product` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Price` float NOT NULL,
  `isAvailable` tinyint(1) NOT NULL,
  PRIMARY KEY ('ID')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `product`
--

INSERT INTO `product` (`ID`, `Name`, `Price`, `isAvailable`) VALUES
(1, 'Coffee', 0.5, 1),
(2, 'Double Coffee', 0.8, 1);
(3, 'Espresso', 0.5, 1);
(4, 'Double Espresso', 1, 1);
(5, 'Wasser', 0.9, 1);
(6, 'Cola', 0.9, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `Name` tinytext NOT NULL,
  `Permission` tinyint(1) NOT NULL,
  `Institute` tinytext NOT NULL,
  `Email` tinytext NOT NULL,
  `Password` int(11) NOT NULL,
  `Balance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`ID`, `Name`, `Permission`, `Institute`, `Email`, `Password`, `Balance`) VALUES
(1, 'Hussein Idris',	1,	'LFI',	'idris@lfi.rwth-aachen.de',		1234,	10),
(2, 'Patrick Querl',	0,	'LFI',	'querl@lfi.rwth-aachen.de',		2468,	9);
(3, 'Christian Thelen', 0,	'LFI',	'thelen@lfi.rwth-aachen.de',	5561,	15);
(4, 'Leon Filser',		1,	'LFI',	'filser@lfi.rwth-aachen.de',	5165,	5);
(5, 'Philip Decker',	0,	'LFI',	'decker@lfi.rwth-aachen.de',	2115,	20);
(6, 'Fabio Catania',	1,	'LFI',	'catania@lfi.rwth-aachen.de',	8963,	10);

--
-- Indizes der exportierten Tabellen
--

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
