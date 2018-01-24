-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 23, 2018 alle 16:54
-- Versione del server: 10.1.29-MariaDB
-- Versione PHP: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `i_tesori_di_squitty_mod`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `email` varchar(30) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `tipo_utente` enum('Al minuto','All_ingrosso','Servizio') NOT NULL,
  `password` varchar(30) NOT NULL DEFAULT 'pass'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`email`, `nome`, `cognome`, `tipo_utente`, `password`) VALUES
('abc@gmail.com', 'simone', 'ballarin', '', 'pass'),
('anna.pietro@gmail.com', 'Anna', 'Pietro', '', '\"pass\"'),
('carlo.bianchi@gmail.com', 'Carlo', 'Bianchi', '', '\"pass\"'),
('cristina.polletto@gmail.com', 'Cristina', 'Polletto', 'Al minuto', '\"pass\"'),
('dario.verdi@gmail.com', 'Dario', 'Verdi', '', '\"pass\"'),
('fabio.bruni@gmail.com', 'Fabio', 'Bruni', '', '\"pass\"'),
('francesco.bellorini@gmail.com', 'Francesco', 'Bellorini', 'Al minuto', '\"pass\"'),
('giorgia.pellegrino@gmail.com', 'Giorgia', 'Pellegrino', 'Al minuto', '\"pass\"'),
('lorenzo.maroncelli@gmail.com', 'Lorenzo', 'Maroncelli', 'Al minuto', '\"pass\"'),
('luca.monti@gmail.com', 'Luca', 'Monti', '', '\"pass\"'),
('luigi.rossetti@gmail.com', 'Luigi', 'Rossetti', '', '\"pass\"'),
('marco.loredan@gmail.com', 'Marco', 'Loredan', 'Al minuto', '\"pass\"'),
('mario.gialli@gmail.com', 'Mario', 'Gialli', '', '\"pass\"'),
('matteo.marzolo@gmail.com', 'Matteo', 'Marzolo', 'Al minuto', '\"pass\"'),
('piero.neri@gmail.com', 'Piero', 'Neri', '', '\"pass\"'),
('samuele.boccaccio@gmail.com', 'Samuele', 'Boccaccio', 'Al minuto', '\"pass\"'),
('sara.rosso@gmail.com', 'Sara', 'Rosso', 'Al minuto', '\"pass\"'),
('sebastiano.rovetta@gmail.com', 'Sebastiano ', 'Rovetta', 'Al minuto', '\"pass\"'),
('silvia.rossi@gmail.com', 'Silvia', 'Rossi', 'Al minuto', '\"pass\"'),
('tullio.vardanega@gmail.com', 'tullio', 'Al minuto', 'Al minuto', 'orcaloca'),
('tullio2@gmail.com', 'b', 'b', 'All_ingrosso', 'b'),
('tullio@gmail.com', 'b', 'b', 'All_ingrosso', 'b');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`email`) USING BTREE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
