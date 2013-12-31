-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Računalo: 127.0.0.1
-- Vrijeme generiranja: Pro 31, 2013 u 12:35 
-- Verzija poslužitelja: 5.6.11
-- PHP verzija: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza podataka: `opp`
--
CREATE DATABASE IF NOT EXISTS `opp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `opp`;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `akcijasustava`
--

CREATE TABLE IF NOT EXISTS `akcijasustava` (
  `idAkcije` int(11) NOT NULL AUTO_INCREMENT,
  `idKorisnika` int(11) NOT NULL,
  `vrijeme` date DEFAULT NULL,
  `opisAkcije` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  PRIMARY KEY (`idAkcije`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `alat`
--

CREATE TABLE IF NOT EXISTS `alat` (
  `idAlata` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `skraceniNaziv` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `inacica` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `cijena` decimal(9,2) DEFAULT NULL,
  `vidljivost` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `link` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  PRIMARY KEY (`idAlata`),
  UNIQUE KEY `skraceniNaziv` (`skraceniNaziv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `autor`
--

CREATE TABLE IF NOT EXISTS `autor` (
  `idAutora` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `prezime` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  PRIMARY KEY (`idAutora`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `ide`
--

CREATE TABLE IF NOT EXISTS `ide` (
  `idIDE` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `skraceniNaziv` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `inacica` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `cijena` decimal(9,2) DEFAULT NULL,
  `vidljivost` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  PRIMARY KEY (`idIDE`),
  UNIQUE KEY `skraceniNaziv` (`skraceniNaziv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `ima`
--

CREATE TABLE IF NOT EXISTS `ima` (
  `idZapisa` int(11) NOT NULL,
  `idEksperimenta` int(11) NOT NULL,
  PRIMARY KEY (`idZapisa`,`idEksperimenta`),
  KEY `idEksperimenta` (`idEksperimenta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `jeautor`
--

CREATE TABLE IF NOT EXISTS `jeautor` (
  `idRada` int(11) NOT NULL,
  `idAutora` int(11) NOT NULL,
  PRIMARY KEY (`idRada`,`idAutora`),
  KEY `idAutora` (`idAutora`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `kljucnerijeci`
--

CREATE TABLE IF NOT EXISTS `kljucnerijeci` (
  `idTaga` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  PRIMARY KEY (`idTaga`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `korisnik`
--

CREATE TABLE IF NOT EXISTS `korisnik` (
  `idKorisnika` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `prezime` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `mail` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `datumRod` date DEFAULT NULL,
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `vrsta` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `validnost` tinyint(1) DEFAULT NULL,
  `uplata` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`idKorisnika`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `koristi`
--

CREATE TABLE IF NOT EXISTS `koristi` (
  `idPlatforme` int(11) NOT NULL,
  `idEksperimenta` int(11) NOT NULL,
  PRIMARY KEY (`idPlatforme`,`idEksperimenta`),
  KEY `idEksperimenta` (`idEksperimenta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `obiljezen`
--

CREATE TABLE IF NOT EXISTS `obiljezen` (
  `idTaga` int(11) NOT NULL,
  `idRada` int(11) NOT NULL,
  PRIMARY KEY (`idTaga`,`idRada`),
  KEY `idRada` (`idRada`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `ocjena`
--

CREATE TABLE IF NOT EXISTS `ocjena` (
  `idOcjene` int(11) NOT NULL AUTO_INCREMENT,
  `oznaka` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `ocjena` decimal(2,1) DEFAULT NULL,
  PRIMARY KEY (`idOcjene`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `ocjenjuje`
--

CREATE TABLE IF NOT EXISTS `ocjenjuje` (
  `idKorisnika` int(11) NOT NULL,
  `idOcjene` int(11) NOT NULL,
  `idEksperimenta` int(11) NOT NULL,
  PRIMARY KEY (`idKorisnika`,`idEksperimenta`),
  KEY `idOcjene` (`idOcjene`),
  KEY `idEksperimenta` (`idEksperimenta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `ostvaren`
--

CREATE TABLE IF NOT EXISTS `ostvaren` (
  `idAlata` int(11) NOT NULL,
  `idEksperimenta` int(11) NOT NULL,
  PRIMARY KEY (`idAlata`,`idEksperimenta`),
  KEY `idEksperimenta` (`idEksperimenta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `ostvario`
--

CREATE TABLE IF NOT EXISTS `ostvario` (
  `idEksperimenta` int(11) NOT NULL,
  `idRezultata` int(11) NOT NULL,
  PRIMARY KEY (`idEksperimenta`,`idRezultata`),
  KEY `idRezultata` (`idRezultata`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `parametar`
--

CREATE TABLE IF NOT EXISTS `parametar` (
  `idParametra` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `ispitniPrimjer` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `iznos` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`idParametra`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `platforma`
--

CREATE TABLE IF NOT EXISTS `platforma` (
  `idPlatforme` int(11) NOT NULL AUTO_INCREMENT,
  `tip` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `naziv` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `skraceniNaziv` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `inacica` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `link` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `datasheet` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `cijena` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`idPlatforme`),
  UNIQUE KEY `skraceniNaziv` (`skraceniNaziv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `portfelj`
--

CREATE TABLE IF NOT EXISTS `portfelj` (
  `idZapisa` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idZapisa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `posjeduje`
--

CREATE TABLE IF NOT EXISTS `posjeduje` (
  `idKorisnika` int(11) NOT NULL,
  `idZapisa` int(11) NOT NULL,
  PRIMARY KEY (`idKorisnika`,`idZapisa`),
  KEY `idZapisa` (`idZapisa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `pripada`
--

CREATE TABLE IF NOT EXISTS `pripada` (
  `idRada` int(11) NOT NULL,
  `idEksperimenta` int(11) NOT NULL,
  PRIMARY KEY (`idRada`,`idEksperimenta`),
  KEY `idEksperimenta` (`idEksperimenta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `pripadaju`
--

CREATE TABLE IF NOT EXISTS `pripadaju` (
  `idEksperimenta` int(11) NOT NULL,
  `idParametra` int(11) NOT NULL,
  PRIMARY KEY (`idEksperimenta`,`idParametra`),
  KEY `idParametra` (`idParametra`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `rezultat`
--

CREATE TABLE IF NOT EXISTS `rezultat` (
  `idRezultata` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `iznos` decimal(9,2) DEFAULT NULL,
  `mjernaJedinica` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  PRIMARY KEY (`idRezultata`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `sadrzi`
--

CREATE TABLE IF NOT EXISTS `sadrzi` (
  `idRada` int(11) NOT NULL,
  `idZapisa` int(11) NOT NULL,
  PRIMARY KEY (`idRada`,`idZapisa`),
  KEY `idZapisa` (`idZapisa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `sadrzi_plat_sklop`
--

CREATE TABLE IF NOT EXISTS `sadrzi_plat_sklop` (
  `idSklopovlja` int(11) NOT NULL,
  `idPlatforme` int(11) NOT NULL,
  PRIMARY KEY (`idSklopovlja`,`idPlatforme`),
  KEY `idPlatforme` (`idPlatforme`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `sastojiseod`
--

CREATE TABLE IF NOT EXISTS `sastojiseod` (
  `idSklopovlja` int(11) NOT NULL,
  `idUredaja` int(11) NOT NULL,
  PRIMARY KEY (`idSklopovlja`,`idUredaja`),
  KEY `idUredaja` (`idUredaja`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `sklopovlje`
--

CREATE TABLE IF NOT EXISTS `sklopovlje` (
  `idSklopovlja` int(11) NOT NULL AUTO_INCREMENT,
  `karakteristika` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `skraceniNaziv` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  PRIMARY KEY (`idSklopovlja`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `uraden`
--

CREATE TABLE IF NOT EXISTS `uraden` (
  `idIDE` int(11) NOT NULL,
  `idEksperimenta` int(11) NOT NULL,
  PRIMARY KEY (`idIDE`,`idEksperimenta`),
  KEY `idEksperimenta` (`idEksperimenta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `uredaj`
--

CREATE TABLE IF NOT EXISTS `uredaj` (
  `idUredaja` int(11) NOT NULL AUTO_INCREMENT,
  `karakteristika` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `skraceniNaziv` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `link` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `datasheet` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `vrsta` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  PRIMARY KEY (`idUredaja`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `znanstvenicasopis`
--

CREATE TABLE IF NOT EXISTS `znanstvenicasopis` (
  `idCasopisa` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `godiste` int(11) DEFAULT NULL,
  `redniBroj` int(11) DEFAULT NULL,
  `adresa` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  PRIMARY KEY (`idCasopisa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `znanstvenieksperiment`
--

CREATE TABLE IF NOT EXISTS `znanstvenieksperiment` (
  `idEksperimenta` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `vrijemePocetka` date DEFAULT NULL,
  `vrijemeZavrsetka` date DEFAULT NULL,
  `vidljivost` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  PRIMARY KEY (`idEksperimenta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `znanstvenirad`
--

CREATE TABLE IF NOT EXISTS `znanstvenirad` (
  `idRada` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `sazetak` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `lokacija` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `idCasopisa` int(11) NOT NULL,
  `idSkupa` int(11) NOT NULL,
  PRIMARY KEY (`idRada`),
  KEY `idCasopisa` (`idCasopisa`),
  KEY `idSkupa` (`idSkupa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `znanstveniskup`
--

CREATE TABLE IF NOT EXISTS `znanstveniskup` (
  `idSkupa` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `mjesto` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `drzava` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `danPocetka` date DEFAULT NULL,
  `danZavrsetka` date DEFAULT NULL,
  `adresa` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  PRIMARY KEY (`idSkupa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Ograničenja za izbačene tablice
--

--
-- Ograničenja za tablicu `ima`
--
ALTER TABLE `ima`
  ADD CONSTRAINT `ima_ibfk_1` FOREIGN KEY (`idZapisa`) REFERENCES `portfelj` (`idZapisa`),
  ADD CONSTRAINT `ima_ibfk_2` FOREIGN KEY (`idEksperimenta`) REFERENCES `znanstvenieksperiment` (`idEksperimenta`);

--
-- Ograničenja za tablicu `jeautor`
--
ALTER TABLE `jeautor`
  ADD CONSTRAINT `jeautor_ibfk_1` FOREIGN KEY (`idRada`) REFERENCES `znanstvenirad` (`idRada`),
  ADD CONSTRAINT `jeautor_ibfk_2` FOREIGN KEY (`idAutora`) REFERENCES `autor` (`idAutora`);

--
-- Ograničenja za tablicu `koristi`
--
ALTER TABLE `koristi`
  ADD CONSTRAINT `koristi_ibfk_1` FOREIGN KEY (`idPlatforme`) REFERENCES `platforma` (`idPlatforme`),
  ADD CONSTRAINT `koristi_ibfk_2` FOREIGN KEY (`idEksperimenta`) REFERENCES `znanstvenieksperiment` (`idEksperimenta`);

--
-- Ograničenja za tablicu `obiljezen`
--
ALTER TABLE `obiljezen`
  ADD CONSTRAINT `obiljezen_ibfk_1` FOREIGN KEY (`idTaga`) REFERENCES `kljucnerijeci` (`idTaga`),
  ADD CONSTRAINT `obiljezen_ibfk_2` FOREIGN KEY (`idRada`) REFERENCES `znanstvenirad` (`idRada`);

--
-- Ograničenja za tablicu `ocjenjuje`
--
ALTER TABLE `ocjenjuje`
  ADD CONSTRAINT `ocjenjuje_ibfk_1` FOREIGN KEY (`idKorisnika`) REFERENCES `korisnik` (`idKorisnika`),
  ADD CONSTRAINT `ocjenjuje_ibfk_2` FOREIGN KEY (`idOcjene`) REFERENCES `ocjena` (`idOcjene`),
  ADD CONSTRAINT `ocjenjuje_ibfk_3` FOREIGN KEY (`idEksperimenta`) REFERENCES `znanstvenieksperiment` (`idEksperimenta`);

--
-- Ograničenja za tablicu `ostvaren`
--
ALTER TABLE `ostvaren`
  ADD CONSTRAINT `ostvaren_ibfk_1` FOREIGN KEY (`idAlata`) REFERENCES `alat` (`idAlata`),
  ADD CONSTRAINT `ostvaren_ibfk_2` FOREIGN KEY (`idEksperimenta`) REFERENCES `znanstvenieksperiment` (`idEksperimenta`);

--
-- Ograničenja za tablicu `ostvario`
--
ALTER TABLE `ostvario`
  ADD CONSTRAINT `ostvario_ibfk_1` FOREIGN KEY (`idEksperimenta`) REFERENCES `znanstvenieksperiment` (`idEksperimenta`),
  ADD CONSTRAINT `ostvario_ibfk_2` FOREIGN KEY (`idRezultata`) REFERENCES `rezultat` (`idRezultata`);

--
-- Ograničenja za tablicu `posjeduje`
--
ALTER TABLE `posjeduje`
  ADD CONSTRAINT `posjeduje_ibfk_1` FOREIGN KEY (`idKorisnika`) REFERENCES `korisnik` (`idKorisnika`),
  ADD CONSTRAINT `posjeduje_ibfk_2` FOREIGN KEY (`idZapisa`) REFERENCES `portfelj` (`idZapisa`);

--
-- Ograničenja za tablicu `pripada`
--
ALTER TABLE `pripada`
  ADD CONSTRAINT `pripada_ibfk_1` FOREIGN KEY (`idRada`) REFERENCES `znanstvenirad` (`idRada`),
  ADD CONSTRAINT `pripada_ibfk_2` FOREIGN KEY (`idEksperimenta`) REFERENCES `znanstvenieksperiment` (`idEksperimenta`);

--
-- Ograničenja za tablicu `pripadaju`
--
ALTER TABLE `pripadaju`
  ADD CONSTRAINT `pripadaju_ibfk_1` FOREIGN KEY (`idEksperimenta`) REFERENCES `znanstvenieksperiment` (`idEksperimenta`),
  ADD CONSTRAINT `pripadaju_ibfk_2` FOREIGN KEY (`idParametra`) REFERENCES `parametar` (`idParametra`);

--
-- Ograničenja za tablicu `sadrzi`
--
ALTER TABLE `sadrzi`
  ADD CONSTRAINT `sadrzi_ibfk_1` FOREIGN KEY (`idRada`) REFERENCES `znanstvenirad` (`idRada`),
  ADD CONSTRAINT `sadrzi_ibfk_2` FOREIGN KEY (`idZapisa`) REFERENCES `portfelj` (`idZapisa`);

--
-- Ograničenja za tablicu `sadrzi_plat_sklop`
--
ALTER TABLE `sadrzi_plat_sklop`
  ADD CONSTRAINT `sadrzi_plat_sklop_ibfk_1` FOREIGN KEY (`idSklopovlja`) REFERENCES `sklopovlje` (`idSklopovlja`),
  ADD CONSTRAINT `sadrzi_plat_sklop_ibfk_2` FOREIGN KEY (`idPlatforme`) REFERENCES `platforma` (`idPlatforme`);

--
-- Ograničenja za tablicu `sastojiseod`
--
ALTER TABLE `sastojiseod`
  ADD CONSTRAINT `sastojiseod_ibfk_1` FOREIGN KEY (`idSklopovlja`) REFERENCES `sklopovlje` (`idSklopovlja`),
  ADD CONSTRAINT `sastojiseod_ibfk_2` FOREIGN KEY (`idUredaja`) REFERENCES `uredaj` (`idUredaja`);

--
-- Ograničenja za tablicu `uraden`
--
ALTER TABLE `uraden`
  ADD CONSTRAINT `uraden_ibfk_1` FOREIGN KEY (`idIDE`) REFERENCES `ide` (`idIDE`),
  ADD CONSTRAINT `uraden_ibfk_2` FOREIGN KEY (`idEksperimenta`) REFERENCES `znanstvenieksperiment` (`idEksperimenta`);

--
-- Ograničenja za tablicu `znanstvenirad`
--
ALTER TABLE `znanstvenirad`
  ADD CONSTRAINT `znanstvenirad_ibfk_1` FOREIGN KEY (`idCasopisa`) REFERENCES `znanstvenicasopis` (`idCasopisa`),
  ADD CONSTRAINT `znanstvenirad_ibfk_2` FOREIGN KEY (`idSkupa`) REFERENCES `znanstveniskup` (`idSkupa`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
