-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 21 jan 2022 om 09:28
-- Serverversie: 10.4.6-MariaDB
-- PHP-versie: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bowlingbaan`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `baan`
--

CREATE TABLE `baan` (
  `id` int(11) NOT NULL,
  `max_personen` int(11) NOT NULL,
  `prijs` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelling`
--

CREATE TABLE `bestelling` (
  `boeking_id` int(11) NOT NULL,
  `schoenpaar_id` int(11) NOT NULL,
  `aantal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `boeker`
--

CREATE TABLE `boeker` (
  `id` int(11) NOT NULL,
  `naam` varchar(25) NOT NULL,
  `adres` varchar(25) NOT NULL,
  `telefoonnummer` varchar(10) NOT NULL,
  `email` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `boeking`
--

CREATE TABLE `boeking` (
  `id` int(11) NOT NULL,
  `boeker_id` int(11) NOT NULL,
  `baan_id` int(11) NOT NULL,
  `aantal_personen` int(11) NOT NULL,
  `tijdstip` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `schoenpaar`
--

CREATE TABLE `schoenpaar` (
  `id` int(11) NOT NULL,
  `maat` int(11) NOT NULL,
  `prijs` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `baan`
--
ALTER TABLE `baan`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `bestelling`
--
ALTER TABLE `bestelling`
  ADD PRIMARY KEY (`boeking_id`,`schoenpaar_id`),
  ADD KEY `schoenpaar_id` (`schoenpaar_id`);

--
-- Indexen voor tabel `boeker`
--
ALTER TABLE `boeker`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `boeking`
--
ALTER TABLE `boeking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `boeker_id` (`boeker_id`),
  ADD KEY `baan_id` (`baan_id`);

--
-- Indexen voor tabel `schoenpaar`
--
ALTER TABLE `schoenpaar`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `baan`
--
ALTER TABLE `baan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `boeker`
--
ALTER TABLE `boeker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `boeking`
--
ALTER TABLE `boeking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `schoenpaar`
--
ALTER TABLE `schoenpaar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `bestelling`
--
ALTER TABLE `bestelling`
  ADD CONSTRAINT `bestelling_ibfk_1` FOREIGN KEY (`boeking_id`) REFERENCES `boeking` (`id`),
  ADD CONSTRAINT `bestelling_ibfk_2` FOREIGN KEY (`schoenpaar_id`) REFERENCES `schoenpaar` (`id`);

--
-- Beperkingen voor tabel `boeking`
--
ALTER TABLE `boeking`
  ADD CONSTRAINT `boeking_ibfk_1` FOREIGN KEY (`boeker_id`) REFERENCES `boeker` (`id`),
  ADD CONSTRAINT `boeking_ibfk_2` FOREIGN KEY (`baan_id`) REFERENCES `baan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
