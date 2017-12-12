-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2017 at 09:05 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `i_tesori_di_squitty`
--

-- --------------------------------------------------------

--
-- Table structure for table `composizione_all'ingrosso`
--

CREATE TABLE `composizione_all'ingrosso` (
  `ordine_all'ingrosso` int(11) NOT NULL,
  `prodotto` varchar(100) NOT NULL,
  `nr_prodotti` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `composizione_all'ingrosso`
--

INSERT INTO `composizione_all'ingrosso` (`ordine_all'ingrosso`, `prodotto`, `nr_prodotti`) VALUES
(1, 'confezione 2kg crema al cioccolato', 3),
(1, 'confezione 3kg crema pasticcera', 4),
(2, 'confezione 3kg crema ganache', 2),
(3, 'confezione 3kg crema pasticcera', 2),
(4, 'confezione 3kg mousse di cioccolato', 3),
(5, 'confezione 5kg pasta sfoglia', 2);

-- --------------------------------------------------------

--
-- Table structure for table `composizione_al_minuto`
--

CREATE TABLE `composizione_al_minuto` (
  `prenotazione` int(11) NOT NULL,
  `prodotto` varchar(100) NOT NULL,
  `nr_prodotti` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `composizione_al_minuto`
--

INSERT INTO `composizione_al_minuto` (`prenotazione`, `prodotto`, `nr_prodotti`) VALUES
(1, 'cheesecake all arancia', 1),
(1, 'cheesecake alla crema di formaggio e topping ai frutti di bosco', 2),
(2, 'cheesecake all arancia', 1),
(3, 'cuore di formaggio per la mamma', 1),
(4, 'crostata di pere e formaggio con cioccolato', 3),
(5, 'cupcakes speziati con frosting al formaggio', 10),
(6, 'kasekuchen torta di formaggio quark tedesca', 2),
(7, 'muffin formaggio fresco e yogurt greco per una tombola scolastica', 12),
(8, 'palline di formaggio ai gusti vari', 4),
(9, 'pancakes my way', 5),
(10, 'red velvet cupcakes con copertura al formaggio ', 8),
(11, 'semifreddo di formaggio e fragole', 1);

-- --------------------------------------------------------

--
-- Table structure for table `composizione_servizi`
--

CREATE TABLE `composizione_servizi` (
  `richiesta_servizio` int(11) NOT NULL,
  `prodotto` varchar(100) NOT NULL,
  `nr_prodotti` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `composizione_servizi`
--

INSERT INTO `composizione_servizi` (`richiesta_servizio`, `prodotto`, `nr_prodotti`) VALUES
(1, 'cheesecake all arancia', 1),
(1, 'cupcakes speziati con frosting al formaggio', 30),
(1, 'palline di formaggio ai gusti vari', 30),
(1, 'red velvet cupcakes con copertura al formaggio ', 30),
(2, 'cuore di formaggio per la mamma', 1),
(2, 'kasekuchen torta di formaggio quark tedesca', 4),
(2, 'red velvet cupcakes con copertura al formaggio ', 16),
(3, 'cheesecake alla crema di formaggio e topping ai frutti di bosco', 3),
(3, 'crostata di pere e formaggio con cioccolato', 12),
(4, 'cupcakes speziati con frosting al formaggio', 80),
(4, 'kasekuchen torta di formaggio quark tedesca', 15);

-- --------------------------------------------------------

--
-- Table structure for table `ordine_all'ingrosso`
--

CREATE TABLE `ordine_all'ingrosso` (
  `codice` int(11) NOT NULL,
  `data_effetuazione` date NOT NULL,
  `stato_ordine` enum('in_lavorazione','passato','','') NOT NULL,
  `data_ora_consegna` datetime NOT NULL,
  `indirizzo_consegna` varchar(50) NOT NULL,
  `periodicita` enum('settimanale','mensile','','') DEFAULT NULL,
  `utente` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ordine_all'ingrosso`
--

INSERT INTO `ordine_all'ingrosso` (`codice`, `data_effetuazione`, `stato_ordine`, `data_ora_consegna`, `indirizzo_consegna`, `periodicita`, `utente`) VALUES
(1, '2017-11-15', 'in_lavorazione', '2017-12-29 08:00:00', 'Padova, Via Umberto 1 97/A', NULL, 'anna.pietro@gmail.com'),
(2, '2017-12-12', 'in_lavorazione', '2018-02-28 07:30:00', 'Padova, Via Galileo Galileo 5', 'settimanale', 'luca.monti@gmail.com'),
(3, '2017-11-09', 'passato', '2017-12-07 15:00:00', 'Padova, Via del Santo 51', NULL, 'luigi.rossetti@gmail.com'),
(4, '2017-12-12', 'in_lavorazione', '2018-02-23 08:00:00', 'Padova, Via M. Cesarotti', 'mensile', 'mario.gialli@gmail.com'),
(5, '2017-12-11', 'in_lavorazione', '2018-01-29 15:00:00', 'Padova, Via A. Manzoni 59', 'mensile', 'piero.neri@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `prenotazione`
--

CREATE TABLE `prenotazione` (
  `codice` int(11) NOT NULL,
  `data_effetuazione` date NOT NULL,
  `stato_ordine` enum('in_lavorazione','passato','','') NOT NULL,
  `data_ora_ritiro` datetime NOT NULL,
  `descrizione_utente` varchar(100) DEFAULT NULL,
  `utente` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prenotazione`
--

INSERT INTO `prenotazione` (`codice`, `data_effetuazione`, `stato_ordine`, `data_ora_ritiro`, `descrizione_utente`, `utente`) VALUES
(1, '2017-11-04', 'passato', '2017-11-06 09:30:00', NULL, 'cristina.polletto@gmail.com'),
(2, '2017-10-13', 'passato', '2017-11-02 11:00:00', 'confezione regalo', 'daniele.perosi@gmail.com'),
(3, '2017-12-12', 'in_lavorazione', '2018-02-15 15:00:00', NULL, 'francesco.bellorini@gmail.com'),
(4, '2017-12-11', 'in_lavorazione', '2018-02-22 13:20:00', 'confezione regalo', 'giorgia.pellegrino@gmail.com'),
(5, '2017-09-14', 'passato', '2017-11-08 10:00:00', NULL, 'lorenzo.maroncelli@gmail.com'),
(6, '2017-10-26', 'passato', '2017-12-06 14:00:00', NULL, 'marco.loredan@gmail.com'),
(7, '2017-12-10', 'in_lavorazione', '2018-03-02 09:00:00', NULL, 'matteo.marzolo@gmail.com'),
(8, '2017-12-12', 'in_lavorazione', '2018-01-26 15:00:00', 'confezione regalo', 'samuele.boccaccio@gmail.com'),
(9, '2017-12-04', 'passato', '2017-12-08 17:00:00', NULL, 'sara.rosso@gmail.com'),
(10, '2017-12-11', 'in_lavorazione', '2018-01-27 09:50:00', 'confezione regalo', 'sebastiano.rovetta@gmail.com'),
(11, '2017-12-02', 'in_lavorazione', '2018-01-29 16:40:00', NULL, 'silvia.rossi@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `prodotto`
--

CREATE TABLE `prodotto` (
  `nome` varchar(100) NOT NULL,
  `ingredienti` varchar(150) NOT NULL,
  `tipoProdotto` enum('Al minuto','All''ingrosso','Servizio','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prodotto`
--

INSERT INTO `prodotto` (`nome`, `ingredienti`, `tipoProdotto`) VALUES
('cheesecake all arancia', 'biscotti, burro, cannella, mascarpone, formaggio spalmabile, zucchero, colla di pesce, arance, gelatina per torte.', 'Al minuto'),
('cheesecake alla crema di formaggio e topping ai frutti di bosco', 'biscotti, burro, mascarpone, philadelphia, panna, zucchero, colla di pesce, frutti di bosco.', 'Al minuto'),
('confezione 2kg crema al cioccolato', 'cioccolato, olio, latte', 'All\'ingrosso'),
('confezione 3kg crema ganache', 'panna, cioccolato, burro.', 'All\'ingrosso'),
('confezione 3kg crema pasticcera', 'tuorlo d\'uovo, zucchero, latte, farina', 'All\'ingrosso'),
('confezione 3kg mousse di cioccolato', 'panna montata, uova, cioccolato', 'All\'ingrosso'),
('confezione 5kg pasta sfoglia', 'farina, acqua, burro', 'All\'ingrosso'),
('crostata di pere e formaggio con cioccolato', 'Farina, zucchero, burro, essenca di vanigla, lievito, formaggio philadelphia light, yogurt, uova, nocciole, pere, cioccolate fondente e con latte.', 'Al minuto'),
('cuore di formaggio per la mamma', 'Farina, latte, zucchero, uova, biscotti, burro, miele, mascrpone, ricotta, cioccolato fondente.', 'Al minuto'),
('cupcakes speziati con frosting al formaggio', 'farina, lievito, sale, raso di noce moscata, cannella, olio, zucchero, uova, latte, philadelphia, burro, aroma di vaniglia, ', 'Al minuto'),
('kasekuchen torta di formaggio quark tedesca', 'Farina, zucchero, uova, vaniglia, latte, burro, quark cheese, biscotti.', 'Al minuto'),
('muffin formaggio fresco e yogurt greco per una tombola scolastica', 'farina, lievito, uova, zucchero, burro, arance, yogurt, formaggio spalmabile', 'Al minuto'),
('palline di formaggio ai gusti vari', 'ricotta, pecorino grattugiato, emmenthal, groviera, gorgonzola dolce, erba cipollina, gherigli di noce, paprika dolce, semi di papavero e sesamo.', 'Al minuto'),
('pancakes my way', 'farina di grano saraceno, uova, zucchero, burro, latte, lievito, sale, miele, crema di cioccolato e nocciole, marmellata.', 'Al minuto'),
('red velvet cupcakes con copertura al formaggio ', 'farina, sale, cacao, burro, zucchero, uovo, vaniglia, buttermilk, colorante alimentare, aceto bianco, bicarbonato di sodio, philadelphia, panna. ', 'Al minuto'),
('semifreddo di formaggio e fragole', 'latte, mascarpone, fragole, formaggio spalmabile (philaddelphia), succo di limone, zucchero a velo.', 'Al minuto');

-- --------------------------------------------------------

--
-- Table structure for table `richiesta_servizio`
--

CREATE TABLE `richiesta_servizio` (
  `codice` int(11) NOT NULL,
  `data_effetuazione` date NOT NULL,
  `stato_ordine` enum('in_lavorazione','passato','','') NOT NULL,
  `data_ora_evento` datetime NOT NULL,
  `risorse_necessarie` varchar(100) NOT NULL,
  `personale_richiesto` tinyint(3) UNSIGNED NOT NULL,
  `indirizzo_evento` varchar(50) NOT NULL,
  `utente` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `richiesta_servizio`
--

INSERT INTO `richiesta_servizio` (`codice`, `data_effetuazione`, `stato_ordine`, `data_ora_evento`, `risorse_necessarie`, `personale_richiesto`, `indirizzo_evento`, `utente`) VALUES
(1, '2017-12-05', 'in_lavorazione', '2018-03-03 11:00:00', '5 tavole, 30 sedie, decorazione per festa di compleanno', 5, 'Padova, Via Roma 34/B', 'carlo.bianchi@gmail.com'),
(2, '2017-12-11', 'in_lavorazione', '2018-02-24 16:00:00', '4 tavole, 16 sedie, decorazione anniversario di matrimonio.', 2, 'Padova, Via Giacomo Leopardi 67', 'dario.verdi@gmail.com'),
(3, '2017-12-04', 'passato', '2017-12-09 10:00:00', '3 tavole, 12 sedie', 2, 'Padova, Via Roma 15', 'fabio.bruni@gmail.com'),
(4, '2017-12-11', 'in_lavorazione', '2018-02-27 16:00:00', '15 tavole, 80 sedie, decorazione bianco festivo ', 10, 'Padova, Via Altinate 67', 'piero.neri@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `utente`
--

CREATE TABLE `utente` (
  `email` varchar(30) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `tipo_utente` enum('Al minuto','All''ingrosso','Servizi','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utente`
--

INSERT INTO `utente` (`email`, `nome`, `cognome`, `tipo_utente`) VALUES
('anna.pietro@gmail.com', 'Anna', 'Pietro', 'All\'ingrosso'),
('carlo.bianchi@gmail.com', 'Carlo', 'Bianchi', 'Servizi'),
('cristina.polletto@gmail.com', 'Cristina', 'Polletto', 'Al minuto'),
('daniele.perosi@gmail.com', 'Daniele', 'Perosi', 'Al minuto'),
('dario.verdi@gmail.com', 'Dario', 'Verdi', 'Servizi'),
('fabio.bruni@gmail.com', 'Fabio', 'Bruni', 'Servizi'),
('francesco.bellorini@gmail.com', 'Francesco', 'Bellorini', 'Al minuto'),
('giorgia.pellegrino@gmail.com', 'Giorgia', 'Pellegrino', 'Al minuto'),
('lorenzo.maroncelli@gmail.com', 'Lorenzo', 'Maroncelli', 'Al minuto'),
('luca.monti@gmail.com', 'Luca', 'Monti', 'All\'ingrosso'),
('luigi.rossetti@gmail.com', 'Luigi', 'Rossetti', 'All\'ingrosso'),
('marco.loredan@gmail.com', 'Marco', 'Loredan', 'Al minuto'),
('mario.gialli@gmail.com', 'Mario', 'Gialli', 'All\'ingrosso'),
('matteo.marzolo@gmail.com', 'Matteo', 'Marzolo', 'Al minuto'),
('piero.neri@gmail.com', 'Piero', 'Neri', 'All\'ingrosso'),
('samuele.boccaccio@gmail.com', 'Samuele', 'Boccaccio', 'Al minuto'),
('sara.rosso@gmail.com', 'Sara', 'Rosso', 'Al minuto'),
('sebastiano.rovetta@gmail.com', 'Sebastiano ', 'Rovetta', 'Al minuto'),
('silvia.rossi@gmail.com', 'Silvia', 'Rossi', 'Al minuto');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `composizione_all'ingrosso`
--
ALTER TABLE `composizione_all'ingrosso`
  ADD PRIMARY KEY (`ordine_all'ingrosso`,`prodotto`),
  ADD KEY `prodotto` (`prodotto`);

--
-- Indexes for table `composizione_al_minuto`
--
ALTER TABLE `composizione_al_minuto`
  ADD PRIMARY KEY (`prenotazione`,`prodotto`),
  ADD KEY `prodotto` (`prodotto`);

--
-- Indexes for table `composizione_servizi`
--
ALTER TABLE `composizione_servizi`
  ADD PRIMARY KEY (`richiesta_servizio`,`prodotto`),
  ADD KEY `prodotto` (`prodotto`);

--
-- Indexes for table `ordine_all'ingrosso`
--
ALTER TABLE `ordine_all'ingrosso`
  ADD PRIMARY KEY (`codice`),
  ADD KEY `ordine_all'ingrosso_ibfk_1` (`utente`);

--
-- Indexes for table `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD PRIMARY KEY (`codice`),
  ADD KEY `utente` (`utente`);

--
-- Indexes for table `prodotto`
--
ALTER TABLE `prodotto`
  ADD PRIMARY KEY (`nome`);

--
-- Indexes for table `richiesta_servizio`
--
ALTER TABLE `richiesta_servizio`
  ADD PRIMARY KEY (`codice`),
  ADD KEY `richiesta_servizio_ibfk_1` (`utente`);

--
-- Indexes for table `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `composizione_all'ingrosso`
--
ALTER TABLE `composizione_all'ingrosso`
  MODIFY `ordine_all'ingrosso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `composizione_al_minuto`
--
ALTER TABLE `composizione_al_minuto`
  MODIFY `prenotazione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `composizione_servizi`
--
ALTER TABLE `composizione_servizi`
  MODIFY `richiesta_servizio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ordine_all'ingrosso`
--
ALTER TABLE `ordine_all'ingrosso`
  MODIFY `codice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `prenotazione`
--
ALTER TABLE `prenotazione`
  MODIFY `codice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `richiesta_servizio`
--
ALTER TABLE `richiesta_servizio`
  MODIFY `codice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `composizione_all'ingrosso`
--
ALTER TABLE `composizione_all'ingrosso`
  ADD CONSTRAINT `composizione_all'ingrosso_ibfk_1` FOREIGN KEY (`ordine_all'ingrosso`) REFERENCES `ordine_all'ingrosso` (`codice`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `composizione_all'ingrosso_ibfk_2` FOREIGN KEY (`prodotto`) REFERENCES `prodotto` (`nome`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `composizione_al_minuto`
--
ALTER TABLE `composizione_al_minuto`
  ADD CONSTRAINT `composizione_al_minuto_ibfk_2` FOREIGN KEY (`prodotto`) REFERENCES `prodotto` (`nome`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `composizione_al_minuto_ibfk_3` FOREIGN KEY (`prenotazione`) REFERENCES `prenotazione` (`codice`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `composizione_servizi`
--
ALTER TABLE `composizione_servizi`
  ADD CONSTRAINT `composizione_servizi_ibfk_1` FOREIGN KEY (`richiesta_servizio`) REFERENCES `richiesta_servizio` (`codice`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `composizione_servizi_ibfk_2` FOREIGN KEY (`prodotto`) REFERENCES `prodotto` (`nome`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ordine_all'ingrosso`
--
ALTER TABLE `ordine_all'ingrosso`
  ADD CONSTRAINT `ordine_all'ingrosso_ibfk_1` FOREIGN KEY (`utente`) REFERENCES `utente` (`email`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD CONSTRAINT `prenotazione_ibfk_1` FOREIGN KEY (`utente`) REFERENCES `utente` (`email`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `richiesta_servizio`
--
ALTER TABLE `richiesta_servizio`
  ADD CONSTRAINT `richiesta_servizio_ibfk_1` FOREIGN KEY (`utente`) REFERENCES `utente` (`email`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
