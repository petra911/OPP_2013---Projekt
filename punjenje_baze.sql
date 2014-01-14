-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 13, 2014 at 11:38 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `opp`
--
CREATE DATABASE IF NOT EXISTS `opp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `opp`;

-- --------------------------------------------------------

--
-- Table structure for table `akcijasustava`
--

--
-- Dumping data for table `akcijasustava`
--

INSERT INTO `akcijasustava` (`idAkcije`, `idKorisnika`, `vrijeme`, `opisAkcije`) VALUES
(1, 7, '2014-01-13 22:33:46', 'Registriran 7'),
(2, 8, '2014-01-13 22:36:36', 'Registriran 8'),
(3, 7, '2014-01-13 22:43:33', 'Validira korisnika 8'),
(4, 8, '2014-01-13 22:56:30', 'Šalje prijedlog za promjenom modela plaćanja 3'),
(5, 8, '2014-01-13 22:57:53', 'Šalje prijedlog za promjenom modela plaćanja 4'),
(6, 7, '2014-01-13 23:27:02', 'Mijenja/ dodaje konfiguraciju!'),
(7, 7, '2014-01-13 23:27:14', 'Mijenja/ dodaje konfiguraciju!'),
(8, 7, '2014-01-13 23:28:37', 'Mijenja/ dodaje konfiguraciju!'),
(9, 7, '2014-01-13 23:29:43', 'Mijenja/ dodaje konfiguraciju!'),
(10, 7, '2014-01-13 23:30:19', 'Mijenja/ dodaje konfiguraciju!'),
(11, 7, '2014-01-13 23:31:40', 'Mijenja/ dodaje konfiguraciju!');

-- --------------------------------------------------------

--
-- Table structure for table `alat`
-
--
-- Dumping data for table `alat`
--

INSERT INTO `alat` (`idAlata`, `naziv`, `skraceniNaziv`, `inacica`, `cijena`, `vidljivost`, `link`) VALUES
(1, 'Ele-simulator', 'el343', '3.4', '5667.99', 'javni', 'www.esimulator.com'),
(2, 'Kem-simulator', 'ch16', '1.6', '349.99', 'javni', 'www.chemsimulator.com'),
(3, 'Fiz-simulator', 'Fiz25', '2.5', '123.55', 'privatni', 'www.physics.org'),
(4, 'Wireshark', 'ws1', '1.1', '459.99', 'javni', 'www.wireshark.com');

-- --------------------------------------------------------

--
-- Table structure for table `autor`
--
-- Dumping data for table `autor`
--

INSERT INTO `autor` (`idAutora`, `ime`, `prezime`) VALUES
(1, 'Ivo', 'Ivić'),
(2, 'Pero', 'Perić'),
(3, 'Slavko', 'Ivić'),
(4, 'Nikolina', 'Tesla'),
(5, 'Andrea', 'Mohorovičić'),
(6, 'Luka', 'Novak');

-- --------------------------------------------------------

--
-- Table structure for table `autoreksperimenta`
--
-- Dumping data for table `autoreksperimenta`
--

INSERT INTO `autoreksperimenta` (`id`, `idAutora`, `idEksperimenta`) VALUES
(1, 1, 1),
(2, 3, 2),
(3, 3, 6),
(4, 4, 5),
(5, 5, 5),
(6, 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `ide`
--
--
-- Dumping data for table `ide`
--

INSERT INTO `ide` (`idIDE`, `naziv`, `skraceniNaziv`, `inacica`, `cijena`, `vidljivost`) VALUES
(1, 'Volt simulator', 'vol3454', '2.1', '4789.99', NULL),
(2, 'ChemSimulator', 'Chem123', '3.1', '399.99', NULL),
(3, 'Fizika Simulator', 'Fiz43', '4.3', '478.90', NULL),
(4, 'Simulator mreža', 'net1', '5.9', '445.50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jeautor`
--
-- Dumping data for table `jeautor`
--

INSERT INTO `jeautor` (`id`, `idRada`, `idAutora`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 3),
(5, 5, 2),
(6, 4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `kljucnerijeci`

-- Dumping data for table `kljucnerijeci`
--

INSERT INTO `kljucnerijeci` (`idTaga`, `tag`) VALUES
(1, 'Kemija'),
(2, 'Energetika'),
(3, 'Otopine'),
(4, 'Medicina'),
(5, 'Napon'),
(6, 'Mreže'),
(7, 'Fizika'),
(8, 'Magnetska');

-- --------------------------------------------------------

--
-- Table structure for table `konfiguracija`
--
--
-- Dumping data for table `konfiguracija`
--

INSERT INTO `konfiguracija` (`id`, `iznos`, `dan`, `datum`) VALUES
(1, '20.00', NULL, 13);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--
--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`idKorisnika`, `ime`, `prezime`, `mail`, `datumRod`, `username`, `password`, `vrsta`, `validnost`, `uplata`, `rokUplate`) VALUES
(2, 'Marko', 'Marković', 'mm@nesto.hr', '2001-01-01', 'mm1', '1795f86a49ac810cf73714c4d1bec7c7e6586ee1', 'K', 0, '20.00', NULL),
(3, 'Ana', 'Anić', 'ananic@net.hr', '1993-03-03', 'ana1', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 'O', 1, '20.00', NULL),
(4, 'Petra', 'Perić', 'petrap@net.hr', '1992-02-02', 'petra123', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 'K', 0, '20.00', NULL),
(5, 'Petra', 'Genc', 'petragenc@mail.hr', '1991-04-10', 'petragenc', '1795f86a49ac810cf73714c4d1bec7c7e6586ee1', 'E', 1, '20.00', NULL),
(6, 'Ivan', 'Ivić', 'ivanivic@mail.hr', '1990-10-30', 'ivan1', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 'O', 1, '20.00', NULL),
(7, 'Luka', 'Cindric', 'luka.cindric@fer.hr', '1992-10-21', 'luka', '752b27f205f23c37442f8ef98ccad21fc5cc0de8', 'O', 1, '20.00', NULL),
(8, 'Stjepan', 'Stipić', 'jnaksdn@mail.com', '1992-12-12', 'stjepan', 'b13c5c663b4d1b7678d7a29dbf725aa2a2011d01', 'K', 1, '20.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `koristi`
--
--
-- Dumping data for table `koristi`
--

INSERT INTO `koristi` (`id`, `idPlatforme`, `idEksperimenta`) VALUES
(1, 1, 3),
(2, 2, 6),
(3, 1, 3),
(5, 1, 4),
(6, 1, 5),
(7, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `obiljezen`
--
--
-- Dumping data for table `obiljezen`
--

INSERT INTO `obiljezen` (`id`, `idTaga`, `idRada`) VALUES
(1, 1, 2),
(2, 4, 1),
(3, 3, 2),
(5, 5, 3),
(6, 2, 4),
(7, 5, 4),
(8, 4, 5),
(9, 7, 1),
(10, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ocjena`
--

-- Dumping data for table `ocjena`
--

INSERT INTO `ocjena` (`idOcjene`, `oznaka`, `ocjena`) VALUES
(1, 'srednje', '5.5'),
(2, 'prihvatljivo', '4.0'),
(3, 'vrlo dobro', '7.0'),
(4, 'nerazumljivo', '1.5'),
(5, 'katastrofa', '0.0'),
(6, 'odlično', '9.0'),
(7, 'ok', '6.0');

-- --------------------------------------------------------

--
-- Table structure for table `ocjenjuje`
--
--
-- Dumping data for table `ocjenjuje`
--

INSERT INTO `ocjenjuje` (`id`, `idKorisnika`, `idOcjene`, `idEksperimenta`) VALUES
(0, 2, 7, 7),
(1, 4, 1, 2),
(2, 3, 5, 3),
(3, 2, 2, 2),
(4, 6, 4, 6),
(5, 4, 6, 7),
(6, 4, 2, 4),
(7, 4, 1, 1),
(8, 6, 6, 4),
(9, 5, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ostvaren`
--

--
-- Dumping data for table `ostvaren`
--

INSERT INTO `ostvaren` (`id`, `idAlata`, `idEksperimenta`) VALUES
(1, 1, 2),
(2, 2, 5),
(3, 2, 1),
(4, 3, 3),
(5, 1, 6),
(6, 1, 4),
(7, 4, 7);

-- --------------------------------------------------------

--
-- Table structure for table `ostvario`
--
-- Dumping data for table `ostvario`
--

INSERT INTO `ostvario` (`id`, `idEksperimenta`, `idRezultata`) VALUES
(1, 2, 1),
(2, 3, 3),
(3, 5, 2),
(4, 6, 4),
(5, 6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `parametar`
--
-- Dumping data for table `parametar`
--

INSERT INTO `parametar` (`idParametra`, `naziv`, `ispitniPrimjer`, `iznos`) VALUES
(1, 'par1', 'primjer1', '1.10'),
(2, 'par2', 'primjer2', '6.70'),
(3, 'par3', 'primjer3', '5.80'),
(4, 'par4', 'primjer4', '1.50'),
(5, 'par5', 'primjer5', '0.50'),
(6, 'par6', 'primjer6', '4.55');

-- --------------------------------------------------------

--
-- Table structure for table `platforma`
--
--
-- Dumping data for table `platforma`
--

INSERT INTO `platforma` (`idPlatforme`, `tip`, `naziv`, `skraceniNaziv`, `inacica`, `link`, `datasheet`, `cijena`) VALUES
(1, 'Računalo', 'MojeRačunalo', 'mc1981', '2b', 'www.racunalo.hr', 'Documents napon', '464.99'),
(2, 'Razvojna ploča', 'Xillinx ML506', 'ML506', '2.2', 'www.xillinx.com', 'Documents ploca', '5000.00'),
(3, 'Poslužitelj', 'Moj poslužitelj', 'Server1', '5.5', 'www.servers.com', 'Documents server', '5499.99');

-- --------------------------------------------------------

--
-- Table structure for table `portfelj`
-
-- Dumping data for table `portfelj`
--

INSERT INTO `portfelj` (`idZapisa`, `idKorisnika`, `idEksperimenta`, `idRada`) VALUES
(3, 4, NULL, 4),
(4, 4, 2, NULL),
(5, 4, 7, NULL),
(6, 2, 7, NULL),
(7, 2, 2, NULL),
(8, 2, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `poruke`

-- Dumping data for table `poruke`
--

INSERT INTO `poruke` (`id`, `idPrimatelja`, `idPosiljatelja`, `tekst`) VALUES
(1, 4, 3, 'odobreno plaćanje'),
(2, 2, 6, 'nije odobrena odgoda'),
(3, -1, 8, 'ksdjfsdjf'),
(4, -1, 8, 'Molim Vas...');

-- --------------------------------------------------------

--
-- Table structure for table `prijedlozi`

-- Dumping data for table `prijedlozi`
--

INSERT INTO `prijedlozi` (`id`, `idKorisnika`, `idEksperimenta`, `idRada`, `tekst`, `naslov`, `sazetak`, `lokacija`, `autori`, `kljucneRijeci`, `idSkupa`, `idCasopisa`) VALUES
(1, 4, 7, 3, 'dodan novi eksperiment o TCP', 'Protokol TCP', '...', 'http://hr.wikipedia.org/wiki/TCP', 'Ivo Ivić', 'Mreže', 1, 3),
(2, 4, NULL, 2, 'Smatram da rad nije posve razumljiv te bi trebalo ponoviti eksperiment vezan uz njega...', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 4, NULL, NULL, NULL, 'Munje i gromovi', 'Još od pamtivijeka grom, munja i grmljavina bili su prirodni fenomeni koji su fascinirali, ali i pla', 'http://hr.wikipedia.org/wiki/Munja', 'Nikolina Tesla', 'Napon;Munje;Gromovi', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pripada`

-- Dumping data for table `pripada`
--

INSERT INTO `pripada` (`idRada`, `idEksperimenta`) VALUES
(2, 1),
(3, 2),
(3, 4),
(2, 5),
(4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `pripadaju`
--

-- Dumping data for table `pripadaju`
--

INSERT INTO `pripadaju` (`id`, `idEksperimenta`, `idParametra`) VALUES
(1, 1, 1),
(2, 2, 2),
(5, 1, 5),
(6, 1, 4),
(7, 2, 3),
(8, 6, 1),
(9, 6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `rezultat`
--
-- Dumping data for table `rezultat`
--

INSERT INTO `rezultat` (`idRezultata`, `naziv`, `iznos`, `mjernaJedinica`) VALUES
(1, 'rez', '4.56', 'Volt'),
(2, 'rez2', '5.45', 'miliLitar'),
(3, 'rez3', '6.80', 'metar/sekunda'),
(4, 'rez4', '25.00', 'mikroFarad'),
(5, 'rez5', '2.00', 'Joul'),
(6, 'rez6', '0.50', 'Tesla'),
(7, 'rez7', '1.50', 'Tesla'),
(8, 'rez8', '1.50', 'miliLitar');

-- --------------------------------------------------------

--
-- Table structure for table `sadrzi_plat_sklop`
--
-- Dumping data for table `sadrzi_plat_sklop`
--

INSERT INTO `sadrzi_plat_sklop` (`idSklopovlja`, `idPlatforme`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sastojiseod`
-- Dumping data for table `sastojiseod`
--

INSERT INTO `sastojiseod` (`idSklopovlja`, `idUredaja`) VALUES
(1, 1),
(3, 1),
(1, 2),
(2, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `sklopovlje`
--

-- Dumping data for table `sklopovlje`
--

INSERT INTO `sklopovlje` (`idSklopovlja`, `karakteristika`, `skraceniNaziv`) VALUES
(1, 'Simulink', 'sim234'),
(2, 'Chemlink', 'chl2'),
(3, 'sklopovljeFizika1', 'fiz1'),
(4, 'sklopovljeMreže1', 'mr1');

-- --------------------------------------------------------

--
-- Table structure for table `uraden`
--

-- Dumping data for table `uraden`
--

INSERT INTO `uraden` (`id`, `idIDE`, `idEksperimenta`) VALUES
(1, 1, 2),
(2, 2, 6),
(3, 1, 4),
(4, 4, 7);

-- --------------------------------------------------------

--
-- Table structure for table `uredaj`
--

-- Dumping data for table `uredaj`
--

INSERT INTO `uredaj` (`idUredaja`, `karakteristika`, `skraceniNaziv`, `link`, `datasheet`, `vrsta`) VALUES
(1, 'Voltmetar', 'vm1', 'http://hr.wikipedia.org/wiki/Voltmetar', NULL, NULL),
(2, 'Multimetar', 'mm2', 'http://hr.wikipedia.org/wiki/Multimetar', NULL, NULL),
(3, 'Digitalna vaga', 'dv1', NULL, NULL, NULL),
(4, 'Bandwidth metar', 'bwm', NULL, NULL, NULL),
(5, 'Digitalni mjerač brzine', 'brz1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `znanstvenicasopis`
--
-- Dumping data for table `znanstvenicasopis`
--

INSERT INTO `znanstvenicasopis` (`idCasopisa`, `naziv`, `godiste`, `redniBroj`, `adresa`) VALUES
(1, 'Liječničke novine', 2013, 1, 'www.lijecnickenovine.hr'),
(2, 'Energetika danas', 2013, 1, 'www.energetika.hr'),
(3, 'Znanost', 2012, 4, 'www.znanostcasopis.hr'),
(4, 'Enter', 2010, 24, 'www.enter.hr');

-- --------------------------------------------------------

--
-- Table structure for table `znanstvenieksperiment`
-- Dumping data for table `znanstvenieksperiment`
--

INSERT INTO `znanstvenieksperiment` (`idEksperimenta`, `naziv`, `vrijemePocetka`, `vrijemeZavrsetka`, `vidljivost`) VALUES
(1, 'Kiseline i otopine', '2013-12-09 00:00:00', '2014-01-01 00:00:00', 'j'),
(2, 'Napon u mreži', '2014-01-08 00:00:00', '2014-01-09 00:00:00', 'j'),
(3, 'Brzina sudara', '2013-11-12 00:00:00', '2013-12-18 00:00:00', 'i'),
(4, 'Kućni napon', '2014-01-13 00:00:00', '2014-01-14 00:00:00', 'j'),
(5, 'Otapanje reaktanata', '2014-01-05 00:00:00', '2014-01-06 00:00:00', 'i'),
(6, 'Energija kondenzatora', '2013-10-25 00:00:00', '2014-01-30 00:00:00', 'j'),
(7, 'Mrežni protokoli', '2013-11-28 00:00:00', '2014-01-29 00:00:00', 'j');

-- --------------------------------------------------------

--
-- Table structure for table `znanstvenirad`
--
-- Dumping data for table `znanstvenirad`
--

INSERT INTO `znanstvenirad` (`idRada`, `naslov`, `sazetak`, `lokacija`, `idCasopisa`, `idSkupa`) VALUES
(1, 'Istraživanje svojstva MRI', 'Metoda nuklearne magnetske rezonancije  je bazirana na kvantnomehaničkim magnetskim svojstvima atoms', 'Zagreb', 1, 1),
(2, 'Kemijska analiza', ' Kemijska promjena rastavljanja tvari na jednostavnije tvari zove se kemijska analiza.', 'Split', 1, 2),
(3, 'Napon u mrežama', NULL, NULL, 3, 2),
(4, 'Značajke energije kondenzatora', 'U elektrotehnici i elektronici je kondenzator pasivni elektronički element...', 'Varaždin', 2, 3),
(5, 'Primjena MRI pri dijagnostici', 'Magnetska ili magnetna rezonancija (MR) je naziv uređaja (u medicini)...', 'Zagreb', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `znanstveniskup`
--

-- Dumping data for table `znanstveniskup`
--

INSERT INTO `znanstveniskup` (`idSkupa`, `naziv`, `mjesto`, `drzava`, `danPocetka`, `danZavrsetka`, `adresa`) VALUES
(1, 'Prvi znanstveni skup', 'Zagreb', 'Hrvatska', '2014-01-02', '2014-01-03', 'www.znanstveniskupovi.hr'),
(2, 'Drugi znanstveni skup', 'Split', 'Hrvatska', '2013-12-10', '2013-12-12', 'www.znanstveniskupovi.hr'),
(3, 'Skup hrvatskih energetičara', 'Varaždin', 'Hrvatska', NULL, NULL, 'www.skupenergeticara.hr');

--
-- Constraints for dumped tables
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
