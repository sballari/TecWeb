-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2018 at 04:52 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sballari`
--

-- --------------------------------------------------------

--
-- Table structure for table `composizione_all_ingrosso`
--

CREATE TABLE `composizione_all_ingrosso` (
  `ordine_all_ingrosso` int(11) NOT NULL,
  `prodotto` varchar(100) NOT NULL,
  `nr_prodotti` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `composizione_all_ingrosso`
--

INSERT INTO `composizione_all_ingrosso` (`ordine_all_ingrosso`, `prodotto`, `nr_prodotti`) VALUES
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
-- Table structure for table `ordine_all_ingrosso`
--

CREATE TABLE `ordine_all_ingrosso` (
  `codice` int(11) NOT NULL,
  `data_effettuazione` datetime NOT NULL,
  `stato_ordine` enum('in_lavorazione','passato','','') NOT NULL,
  `data_ora_consegna` datetime NOT NULL,
  `indirizzo_consegna` varchar(50) NOT NULL,
  `periodicita` enum('settimanale','mensile','','') DEFAULT NULL,
  `utente` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ordine_all_ingrosso`
--

INSERT INTO `ordine_all_ingrosso` (`codice`, `data_effettuazione`, `stato_ordine`, `data_ora_consegna`, `indirizzo_consegna`, `periodicita`, `utente`) VALUES
(1, '2017-11-15 00:00:00', 'passato', '2017-12-29 08:00:00', 'Padova Via Umberto 1 97/A', NULL, 'anna.pietro@gmail.com'),
(2, '2017-12-12 00:00:00', 'in_lavorazione', '2018-08-28 07:30:00', 'Padova, Via Galileo Galileo 5', 'settimanale', 'luca.monti@gmail.com'),
(3, '2017-11-09 00:00:00', 'passato', '2017-12-07 15:00:00', 'Padova, Via del Santo 51', NULL, 'luigi.rossetti@gmail.com'),
(4, '2017-12-12 00:00:00', 'in_lavorazione', '2018-08-23 08:00:00', 'Padova, Via M. Cesarotti', 'mensile', 'mario.gialli@gmail.com'),
(5, '2017-12-11 00:00:00', 'passato', '2018-01-29 15:00:00', 'Padova Via A. Manzoni 59', 'mensile', 'piero.neri@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `prenotazione`
--

CREATE TABLE `prenotazione` (
  `codice` int(11) NOT NULL,
  `data_effettuazione` datetime NOT NULL,
  `stato_ordine` enum('in_lavorazione','passato','','') NOT NULL,
  `data_ora_ritiro` datetime NOT NULL,
  `descrizione_utente` varchar(100) DEFAULT NULL,
  `utente` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prenotazione`
--

INSERT INTO `prenotazione` (`codice`, `data_effettuazione`, `stato_ordine`, `data_ora_ritiro`, `descrizione_utente`, `utente`) VALUES
(1, '2017-11-04 00:00:00', 'passato', '2017-11-06 09:30:00', NULL, 'cristina.polletto@gmail.it'),
(2, '2017-10-13 00:00:00', 'passato', '2017-11-02 11:00:00', 'confezione regalo', 'daniele.perosi@gmail.com'),
(3, '2017-12-12 00:00:00', 'in_lavorazione', '2018-07-15 15:00:00', NULL, 'francesco.bellorini@gmail.com'),
(4, '2017-12-11 00:00:00', 'in_lavorazione', '2018-08-22 13:20:00', 'confezione regalo', 'giorgia.pellegrino@gmail.com'),
(5, '2017-09-14 00:00:00', 'passato', '2017-11-08 10:00:00', NULL, 'lorenzo.maroncelli@gmail.com'),
(6, '2017-10-26 00:00:00', 'passato', '2017-12-06 14:00:00', NULL, 'marco.loredan@gmail.com'),
(7, '2017-12-10 00:00:00', 'in_lavorazione', '2018-09-02 09:00:00', NULL, 'matteo.marzolo@gmail.com'),
(8, '2017-12-12 00:00:00', 'in_lavorazione', '2018-09-26 15:00:00', 'confezione regalo', 'samuele.boccaccio@gmail.com'),
(9, '2017-12-04 00:00:00', 'passato', '2017-12-08 17:00:00', NULL, 'sara.rosso@gmail.com'),
(10, '2017-12-11 00:00:00', 'in_lavorazione', '2018-08-27 09:50:00', 'confezione regalo', 'sebastiano.rovetta@gmail.com'),
(11, '2017-12-02 00:00:00', 'in_lavorazione', '2018-08-29 16:40:00', NULL, 'silvia.rossi@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `prodotto`
--

CREATE TABLE `prodotto` (
  `nome` varchar(100) NOT NULL,
  `ingredienti` varchar(150) NOT NULL,
  `tipoProdotto` enum('Al minuto','All_ingrosso','Servizio') NOT NULL,
  `imagePath` varchar(535) NOT NULL DEFAULT 'img/prodotti/tiramisu.jpeg',
  `descrizione` varchar(535) NOT NULL DEFAULT 'il nostro fantastico tiramiusu'' gioia per gli occhi e indescrivibile piacer. Vieni a provarlo anche tu nei nostri negozi in giro per il mondo !!!'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prodotto`
--

INSERT INTO `prodotto` (`nome`, `ingredienti`, `tipoProdotto`, `imagePath`, `descrizione`) VALUES
('Catering con fornitura', '', 'Servizio', 'img/prodotti/tiramisu.jpeg', 'Hai solo la location? Nessun problema... pensiamo a tutto noi.'),
('cheesecake all arancia', 'biscotti, burro, cannella, mascarpone, formaggio spalmabile, zucchero, colla di pesce, arance, gelatina per torte.', 'Al minuto', 'img/prodotti/tiramisu.jpeg', 'il nostro fantastico tiramiusu\' gioia per gli occhi e indescrivibile piacer. Vieni a provarlo anche tu nei nostri negozi in giro per il mondo !!!'),
('cheesecake alla crema di formaggio e topping ai frutti di bosco', 'biscotti, burro, mascarpone, philadelphia, panna, zucchero, colla di pesce, frutti di bosco.', 'Al minuto', 'img/prodotti/tiramisu.jpeg', 'il nostro fantastico tiramiusu\' gioia per gli occhi e indescrivibile piacer. Vieni a provarlo anche tu nei nostri negozi in giro per il mondo !!!'),
('confezione 2kg crema al cioccolato', 'cioccolato, olio, latte', 'All_ingrosso', 'img/prodotti/tiramisu.jpeg', 'il nostro fantastico tiramiusu\' gioia per gli occhi e indescrivibile piacer. Vieni a provarlo anche tu nei nostri negozi in giro per il mondo !!!'),
('confezione 3kg crema ganache', 'panna, cioccolato, burro.', 'All_ingrosso', 'img/prodotti/tiramisu.jpeg', 'il nostro fantastico tiramiusu\' gioia per gli occhi e indescrivibile piacer. Vieni a provarlo anche tu nei nostri negozi in giro per il mondo !!!'),
('confezione 3kg crema pasticcera', 'tuorlo d\'uovo, zucchero, latte, farina', 'All_ingrosso', 'img/prodotti/tiramisu.jpeg', 'il nostro fantastico tiramiusu\' gioia per gli occhi e indescrivibile piacer. Vieni a provarlo anche tu nei nostri negozi in giro per il mondo !!!'),
('confezione 3kg mousse di cioccolato', 'panna montata, uova, cioccolato', 'All_ingrosso', 'img/prodotti/tiramisu.jpeg', 'il nostro fantastico tiramiusu\' gioia per gli occhi e indescrivibile piacer. Vieni a provarlo anche tu nei nostri negozi in giro per il mondo !!!'),
('confezione 5kg pasta sfoglia', 'farina, acqua, burro', 'All_ingrosso', 'img/prodotti/tiramisu.jpeg', 'il nostro fantastico tiramiusu\' gioia per gli occhi e indescrivibile piacer. Vieni a provarlo anche tu nei nostri negozi in giro per il mondo !!!'),
('crostata di pere e formaggio con cioccolato', 'Farina, zucchero, burro, essenca di vanigla, lievito, formaggio philadelphia light, yogurt, uova, nocciole, pere, cioccolate fondente e con latte.', 'Al minuto', 'img/prodotti/tiramisu.jpeg', 'il nostro fantastico tiramiusu\' gioia per gli occhi e indescrivibile piacer. Vieni a provarlo anche tu nei nostri negozi in giro per il mondo !!!'),
('cuore di formaggio per la mamma', 'Farina, latte, zucchero, uova, biscotti, burro, miele, mascrpone, ricotta, cioccolato fondente.', 'Al minuto', 'img/prodotti/tiramisu.jpeg', 'il nostro fantastico tiramiusu\' gioia per gli occhi e indescrivibile piacer. Vieni a provarlo anche tu nei nostri negozi in giro per il mondo !!!'),
('cupcakes speziati con frosting al formaggio', 'farina, lievito, sale, raso di noce moscata, cannella, olio, zucchero, uova, latte, philadelphia, burro, aroma di vaniglia, ', 'Al minuto', 'img/prodotti/tiramisu.jpeg', 'il nostro fantastico tiramiusu\' gioia per gli occhi e indescrivibile piacer. Vieni a provarlo anche tu nei nostri negozi in giro per il mondo !!!'),
('kasekuchen torta di formaggio quark tedesca', 'Farina, zucchero, uova, vaniglia, latte, burro, quark cheese, biscotti.', 'Al minuto', 'img/prodotti/tiramisu.jpeg', 'il nostro fantastico tiramiusu\' gioia per gli occhi e indescrivibile piacer. Vieni a provarlo anche tu nei nostri negozi in giro per il mondo !!!'),
('muffin formaggio fresco e yogurt greco per una tombola scolastica', 'farina, lievito, uova, zucchero, burro, arance, yogurt, formaggio spalmabile', 'Al minuto', 'img/prodotti/tiramisu.jpeg', 'il nostro fantastico tiramiusu\' gioia per gli occhi e indescrivibile piacer. Vieni a provarlo anche tu nei nostri negozi in giro per il mondo !!!'),
('palline di formaggio ai gusti vari', 'ricotta, pecorino grattugiato, emmenthal, groviera, gorgonzola dolce, erba cipollina, gherigli di noce, paprika dolce, semi di papavero e sesamo.', 'Al minuto', 'img/prodotti/tiramisu.jpeg', 'il nostro fantastico tiramiusu\' gioia per gli occhi e indescrivibile piacer. Vieni a provarlo anche tu nei nostri negozi in giro per il mondo !!!'),
('pancakes my way', 'farina di grano saraceno, uova, zucchero, burro, latte, lievito, sale, miele, crema di cioccolato e nocciole, marmellata.', 'Al minuto', 'img/prodotti/tiramisu.jpeg', 'il nostro fantastico tiramiusu\' gioia per gli occhi e indescrivibile piacer. Vieni a provarlo anche tu nei nostri negozi in giro per il mondo !!!'),
('red velvet cupcakes con copertura al formaggio ', 'farina, sale, cacao, burro, zucchero, uovo, vaniglia, buttermilk, colorante alimentare, aceto bianco, bicarbonato di sodio, philadelphia, panna. ', 'Al minuto', 'img/prodotti/tiramisu.jpeg', 'il nostro fantastico tiramiusu\' gioia per gli occhi e indescrivibile piacer. Vieni a provarlo anche tu nei nostri negozi in giro per il mondo !!!'),
('semifreddo di formaggio e fragole', 'latte, mascarpone, fragole, formaggio spalmabile (philaddelphia), succo di limone, zucchero a velo.', 'Al minuto', 'img/prodotti/tiramisu.jpeg', 'il nostro fantastico tiramiusu\' gioia per gli occhi e indescrivibile piacer. Vieni a provarlo anche tu nei nostri negozi in giro per il mondo !!!'),
('Solo catering', '', 'Servizio', 'img/prodotti/tiramisu.jpeg', 'Il nostro famosissimo servizio di catering, ormai una garanzia. Favolosi camerieri vestiti in giallo Grana Padano, pronti ad allietare ogni tua festa.'),
('Solo fornitura', '', 'Servizio', 'img/prodotti/tiramisu.jpeg', 'Hai gi&agrave; la tua squadra di camerieri? Ti mancano solo dei favolosi dolci al formaggio? Questa &egrave; l\'opzione giusta per te!');

-- --------------------------------------------------------

--
-- Table structure for table `richiesta_servizio`
--

CREATE TABLE `richiesta_servizio` (
  `codice` int(11) NOT NULL,
  `data_effettuazione` datetime NOT NULL,
  `stato_ordine` enum('in_lavorazione','passato','','') NOT NULL,
  `data_ora_evento` datetime NOT NULL,
  `risorse_necessarie` varchar(100) NOT NULL,
  `personale_richiesto` tinyint(3) UNSIGNED NOT NULL,
  `indirizzo_evento` varchar(50) NOT NULL,
  `utente` varchar(30) NOT NULL,
  `Prodotto_servizio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `richiesta_servizio`
--

INSERT INTO `richiesta_servizio` (`codice`, `data_effettuazione`, `stato_ordine`, `data_ora_evento`, `risorse_necessarie`, `personale_richiesto`, `indirizzo_evento`, `utente`, `Prodotto_servizio`) VALUES
(1, '2018-04-05 00:00:00', 'in_lavorazione', '2018-07-03 11:00:00', '', 5, 'Padova, Via Roma 34/B', 'carlo.bianchi@gmail.com', 'Solo catering'),
(2, '2017-12-11 00:00:00', 'in_lavorazione', '2018-08-24 16:00:00', '4 tavole, 16 sedie, decorazione anniversario matrimonio', 2, 'Padova, Via Giacomo Leopardi 67', 'dario.verdi@gmail.com', 'Solo catering'),
(3, '2017-12-04 00:00:00', 'passato', '2017-12-09 10:00:00', '3 tavole, 12 sedie', 2, 'Padova, Via Roma 15', 'fabio.bruni@gmail.com', 'Catering con fornitura'),
(4, '2017-12-11 00:00:00', 'in_lavorazione', '2018-09-27 16:00:00', '15 tavole, 80 sedie, decorazione bianco festivo', 10, 'Padova, Via Altinate 67', 'piero.neri@gmail.com', 'Solo catering');

-- --------------------------------------------------------

--
-- Table structure for table `utente`
--

CREATE TABLE `utente` (
  `email` varchar(30) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `tipo_utente` enum('Al minuto','All_ingrosso','Servizio','Impiegato') NOT NULL,
  `password` varchar(30) NOT NULL DEFAULT 'pass'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utente`
--

INSERT INTO `utente` (`email`, `nome`, `cognome`, `tipo_utente`, `password`) VALUES
('alice.verdi@gmail.com', 'Alice', 'Verdi', 'Impiegato', 'passImp'),
('anna.pietro@gmail.com', 'Anna', 'Pietro', 'All_ingrosso', 'pass'),
('carlo.bianchi@gmail.com', 'Carlo', 'Bianchi', 'Servizio', 'pass'),
('cristina.polletto@gmail.it', 'Cristina', 'Polletto', 'Al minuto', 'pass'),
('daniele.perosi@gmail.com', 'Daniele', 'Perosi', 'Al minuto', 'pass'),
('dario.verdi@gmail.com', 'Dario', 'Verdi', 'Servizio', 'pass'),
('fabio.bruni@gmail.com', 'Fabio', 'Bruni', 'Servizio', 'pass'),
('francesco.bellorini@gmail.com', 'Francesco', 'Bellorini', 'Al minuto', 'pass'),
('giorgia.pellegrino@gmail.com', 'Giorgia', 'Pellegrino', 'Al minuto', 'pass'),
('lorenzo.maroncelli@gmail.com', 'Lorenzo', 'Maroncelli', 'Al minuto', 'pass'),
('luca.monti@gmail.com', 'Luca', 'Monti', 'All_ingrosso', 'pass'),
('luigi.rossetti@gmail.com', 'Luigi', 'Rossetti', 'All_ingrosso', 'pass'),
('marco.loredan@gmail.com', 'Marco', 'Loredan', 'Al minuto', 'pass'),
('mario.gialli@gmail.com', 'Mario', 'Gialli', 'All_ingrosso', 'pass'),
('matteo.marzolo@gmail.com', 'Matteo', 'Marzolo', 'Al minuto', 'pass'),
('piero.neri@gmail.com', 'Piero', 'Neri', 'Servizio', 'pass'),
('samuele.boccaccio@gmail.com', 'Samuele', 'Boccaccio', 'Al minuto', 'pass'),
('sara.rosso@gmail.com', 'Sara', 'Rosso', 'Al minuto', 'pass'),
('sebastiano.rovetta@gmail.com', 'Sebastiano ', 'Rovetta', 'Al minuto', 'pass'),
('silvia.rossi@gmail.com', 'Silvia', 'Rossi', 'Al minuto', 'pass');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `composizione_all_ingrosso`
--
ALTER TABLE `composizione_all_ingrosso`
  ADD PRIMARY KEY (`ordine_all_ingrosso`,`prodotto`),
  ADD KEY `prodotto` (`prodotto`);

--
-- Indexes for table `composizione_al_minuto`
--
ALTER TABLE `composizione_al_minuto`
  ADD PRIMARY KEY (`prenotazione`,`prodotto`),
  ADD KEY `prodotto` (`prodotto`);

--
-- Indexes for table `ordine_all_ingrosso`
--
ALTER TABLE `ordine_all_ingrosso`
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
  ADD KEY `richiesta_servizio_ibfk_1` (`utente`),
  ADD KEY `tipo_servizio` (`Prodotto_servizio`);

--
-- Indexes for table `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `composizione_all_ingrosso`
--
ALTER TABLE `composizione_all_ingrosso`
  MODIFY `ordine_all_ingrosso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `composizione_al_minuto`
--
ALTER TABLE `composizione_al_minuto`
  MODIFY `prenotazione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ordine_all_ingrosso`
--
ALTER TABLE `ordine_all_ingrosso`
  MODIFY `codice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `prenotazione`
--
ALTER TABLE `prenotazione`
  MODIFY `codice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `richiesta_servizio`
--
ALTER TABLE `richiesta_servizio`
  MODIFY `codice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `composizione_all_ingrosso`
--
ALTER TABLE `composizione_all_ingrosso`
  ADD CONSTRAINT `composizione_all_ingrosso_ibfk_1` FOREIGN KEY (`ordine_all_ingrosso`) REFERENCES `ordine_all_ingrosso` (`codice`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `composizione_all_ingrosso_ibfk_2` FOREIGN KEY (`prodotto`) REFERENCES `prodotto` (`nome`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `composizione_al_minuto`
--
ALTER TABLE `composizione_al_minuto`
  ADD CONSTRAINT `composizione_al_minuto_ibfk_2` FOREIGN KEY (`prodotto`) REFERENCES `prodotto` (`nome`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `composizione_al_minuto_ibfk_3` FOREIGN KEY (`prenotazione`) REFERENCES `prenotazione` (`codice`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ordine_all_ingrosso`
--
ALTER TABLE `ordine_all_ingrosso`
  ADD CONSTRAINT `ordine_all_ingrosso_ibfk_1` FOREIGN KEY (`utente`) REFERENCES `utente` (`email`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD CONSTRAINT `prenotazione_ibfk_1` FOREIGN KEY (`utente`) REFERENCES `utente` (`email`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `richiesta_servizio`
--
ALTER TABLE `richiesta_servizio`
  ADD CONSTRAINT `richiesta_servizio_ibfk_1` FOREIGN KEY (`utente`) REFERENCES `utente` (`email`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `richiesta_servizio_ibfk_2` FOREIGN KEY (`Prodotto_servizio`) REFERENCES `prodotto` (`nome`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
