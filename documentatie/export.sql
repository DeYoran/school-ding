-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 02 jun 2016 om 09:09
-- Serverversie: 5.6.17
-- PHP-versie: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `game`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelling`
--

DROP TABLE IF EXISTS `bestelling`;
CREATE TABLE `bestelling` (
  `bestelId` int(11) NOT NULL,
  `datum` date NOT NULL,
  `klant` int(11) DEFAULT NULL,
  `betaald` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bestelId`),
  KEY `fk_Bestellingen_Gebruikers1_idx` (`klant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelregel`
--

DROP TABLE IF EXISTS `bestelregel`;
CREATE TABLE `bestelregel` (
  `bestelId` int(11) NOT NULL,
  `platformgameId` int(11) NOT NULL,
  `aantal` int(11) NOT NULL,
  PRIMARY KEY (`platformgameId`,`bestelId`),
  KEY `fk_Bestellingen_has_Games_Bestellingen1_idx` (`bestelId`),
  KEY `fk_bestelregel_platformgame1_idx` (`platformgameId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `fysiekevoorraad`
--

DROP TABLE IF EXISTS `fysiekevoorraad`;
CREATE TABLE `fysiekevoorraad` (
  `locatie` varchar(45) NOT NULL,
  `aantal` int(11) NOT NULL,
  `platformgameId` int(11) NOT NULL,
  PRIMARY KEY (`locatie`),
  KEY `fk_fysiekevoorraad_platformgame1_idx` (`platformgameId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `game`
--

DROP TABLE IF EXISTS `game`;
CREATE TABLE `game` (
  `gameId` int(11) NOT NULL,
  `verkoopprijs` int(11) NOT NULL,
  `inkoopprijs` int(11) NOT NULL,
  `releasedatum` date NOT NULL,
  `omschrijving` text NOT NULL,
  `besturing` varchar(45) NOT NULL,
  `videolink` varchar(45) DEFAULT NULL,
  `Naam` varchar(45) NOT NULL,
  `startverkoop` date DEFAULT NULL,
  PRIMARY KEY (`gameId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `game`
--

INSERT INTO `game` (`gameId`, `verkoopprijs`, `inkoopprijs`, `releasedatum`, `omschrijving`, `besturing`, `videolink`, `Naam`, `startverkoop`) VALUES
(0, 222, 1111, '2015-12-31', 'b hifdsa', 'controller', NULL, 'de blob', '2016-12-31'),
(1, 1999, 1500, '2015-08-03', 'Formula Fusion is an anti-gravity racing game which pits your racing pedigree up against the rest of the world.', 'dsdsds', NULL, 'Formula fusion', '2015-08-03'),
(2, 4500, 1750, '2016-02-23', 'Gran Turismo 7 is an upcoming racing video game developed by Polyphony Digital and published by Sony Computer Entertainment for the PlayStation 4 video game console', 'fdf', NULL, 'Gran Turismo 7', '2015-08-03'),
(3, 4999, 2000, '2015-11-03', 'Need for Speed is an open world racing video game developed by Ghost Games and published by Electronic Arts', 'dsdsd', NULL, 'Need for speed', '2015-08-03'),
(4, 2299, 1500, '2015-05-29', 'BeamNG Drive', '', NULL, 'Beam NG Drive', '2015-08-03'),
(5, 3999, 2999, '2015-09-03', 'racespel', '', NULL, 'Project cars', '2015-08-03'),
(6, 5999, 4200, '2014-04-16', 'mariokart 8', '', NULL, 'Mario kart 8', '2016-08-03'),
(1452788993, 2700, 2400, '2016-01-22', 'fdsahifd', 'controller', NULL, 'Testspel', '2016-01-22'),
(1453302570, 25, 2300, '2016-01-13', 'null', 'controller', NULL, 'need for speed Speciale editie', '2016-01-13'),
(1453302638, 5000, 5000, '2016-01-13', 'null', 'controller', NULL, 'speciale editie', '2016-01-13');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruiker`
--

DROP TABLE IF EXISTS `gebruiker`;
CREATE TABLE `gebruiker` (
  `klantnr` int(11) NOT NULL,
  `emailadres` varchar(45) NOT NULL,
  `wachtwoord` varchar(128) NOT NULL,
  `salt` varchar(104) NOT NULL,
  `naam` varchar(45) DEFAULT NULL,
  `straat` varchar(45) DEFAULT NULL,
  `huisnummer` varchar(11) DEFAULT NULL,
  `postcode` varchar(6) DEFAULT NULL,
  `woonplaats` varchar(45) DEFAULT NULL,
  `telefoonnummer` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`klantnr`),
  UNIQUE KEY `emailadres` (`emailadres`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `gebruiker`
--

INSERT INTO `gebruiker` (`klantnr`, `emailadres`, `wachtwoord`, `salt`, `naam`, `straat`, `huisnummer`, `postcode`, `woonplaats`, `telefoonnummer`) VALUES
(0, 'yoran.engelberst@gmail.cna', '$dm1!m', 'Dolfijntjes', 'Yoran', 'viswater', NULL, NULL, NULL, NULL),
(1, 'yoran.engelberst@gmail.com', '$dm1!m', 'Dolfijntjes', 'Yoran', 'viswater', NULL, NULL, NULL, NULL),
(2, 'yoran.engelberst@gmail.come', 'C14in!', 'Dolfijntjes', 'Yoran', 'viswater', NULL, NULL, NULL, NULL),
(3, 'yoran.engelberst@gmail.cn', '$dm1!m', 'Dolfijntjes', 'Yoran', 'viswater', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikerrol`
--

DROP TABLE IF EXISTS `gebruikerrol`;
CREATE TABLE `gebruikerrol` (
  `gebruiker` int(11) NOT NULL,
  `rol` varchar(45) NOT NULL,
  PRIMARY KEY (`gebruiker`,`rol`),
  KEY `fk_Gebruikers_has_Rollen_Rollen1_idx` (`rol`),
  KEY `fk_Gebruikers_has_Rollen_Gebruikers_idx` (`gebruiker`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `gebruikerrol`
--

INSERT INTO `gebruikerrol` (`gebruiker`, `rol`) VALUES
(1, 'Admin'),
(1, 'verkoper'),
(2, 'Beheerder'),
(2, 'klant');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `platform`
--

DROP TABLE IF EXISTS `platform`;
CREATE TABLE `platform` (
  `naam` varchar(45) NOT NULL,
  `omschrijving` varchar(45) NOT NULL,
  PRIMARY KEY (`naam`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `platform`
--

INSERT INTO `platform` (`naam`, `omschrijving`) VALUES
('PC', 'pc'),
('ps4', 'ps4'),
('wii u', 'wii u'),
('xbox one', 'xbox one');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `platformgame`
--

DROP TABLE IF EXISTS `platformgame`;
CREATE TABLE `platformgame` (
  `platformgameid` int(11) NOT NULL AUTO_INCREMENT,
  `platform` varchar(45) NOT NULL,
  `gameId` int(11) NOT NULL,
  PRIMARY KEY (`platformgameid`),
  KEY `fk_Platform_has_Games_Games1_idx` (`gameId`),
  KEY `fk_Platform_has_Games_Platform1_idx` (`platform`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Gegevens worden geëxporteerd voor tabel `platformgame`
--

INSERT INTO `platformgame` (`platformgameid`, `platform`, `gameId`) VALUES
(0, 'PC', 0),
(1, 'ps4', 5),
(2, 'pc', 5),
(3, 'ps4', 2),
(4, 'pc', 1),
(5, 'ps4', 1),
(6, 'pc', 3),
(7, 'ps4', 3),
(8, 'xbox one', 3),
(9, 'wii u', 3),
(10, 'xbox one', 4),
(11, 'wii u', 6),
(12, 'xbox one', 0),
(18, 'xbox one', 1452788993),
(19, 'PC', 1452788993),
(22, 'xbox one', 1453302570),
(23, 'PC', 1453302570),
(24, 'xbox one', 1453302638);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol` (
  `rol` varchar(45) NOT NULL,
  `omschrijving` varchar(255) NOT NULL,
  PRIMARY KEY (`rol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `rol`
--

INSERT INTO `rol` (`rol`, `omschrijving`) VALUES
('Admin', 'dot admin dingen'),
('Beheerder', 'de beheerder beheert dingen'),
('klant', 'koopt (hopelijk)'),
('verkoper', 'verkoopt');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `verkoopbarevoorraad`
--

DROP TABLE IF EXISTS `verkoopbarevoorraad`;
CREATE TABLE `verkoopbarevoorraad` (
  `platformgame_platformgameid` int(11) NOT NULL,
  `aantal` int(11) NOT NULL,
  PRIMARY KEY (`platformgame_platformgameid`),
  KEY `fk_verkoopbarevoorraad_platformgame1_idx` (`platformgame_platformgameid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `bestelling`
--
ALTER TABLE `bestelling`
  ADD CONSTRAINT `fk_Bestellingen_Gebruikers1` FOREIGN KEY (`klant`) REFERENCES `gebruiker` (`klantnr`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `fysiekevoorraad`
--
ALTER TABLE `fysiekevoorraad`
  ADD CONSTRAINT `fk_fysiekevoorraad_platformgame1` FOREIGN KEY (`platformgameId`) REFERENCES `platformgame` (`platformgameid`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `gebruikerrol`
--
ALTER TABLE `gebruikerrol`
  ADD CONSTRAINT `fk_Gebruikers_has_Rollen_Gebruikers` FOREIGN KEY (`gebruiker`) REFERENCES `gebruiker` (`klantnr`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Gebruikers_has_Rollen_Rollen1` FOREIGN KEY (`rol`) REFERENCES `rol` (`rol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `platformgame`
--
ALTER TABLE `platformgame`
  ADD CONSTRAINT `fk_Platform_has_Games_Games1` FOREIGN KEY (`gameId`) REFERENCES `game` (`gameId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Platform_has_Games_Platform1` FOREIGN KEY (`platform`) REFERENCES `platform` (`naam`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `verkoopbarevoorraad`
--
ALTER TABLE `verkoopbarevoorraad`
  ADD CONSTRAINT `fk_verkoopbarevoorraad_platformgame1` FOREIGN KEY (`platformgame_platformgameid`) REFERENCES `platformgame` (`platformgameid`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
