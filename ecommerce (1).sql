-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 04, 2024 alle 20:31
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `aggiunto`
--

CREATE TABLE `aggiunto` (
  `ID` int(11) NOT NULL,
  `idProdotto` int(11) DEFAULT NULL,
  `idCarrello` int(11) DEFAULT NULL,
  `quantita` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `aggiunto`
--

INSERT INTO `aggiunto` (`ID`, `idProdotto`, `idCarrello`, `quantita`) VALUES
(1, 10, 1, 1),
(2, 11, 2, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `appartiene`
--

CREATE TABLE `appartiene` (
  `ID` int(11) NOT NULL,
  `idProdotto` int(11) DEFAULT NULL,
  `idCategoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `appartiene`
--

INSERT INTO `appartiene` (`ID`, `idProdotto`, `idCategoria`) VALUES
(12, 10, 9),
(13, 11, 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

CREATE TABLE `carrello` (
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `carrello`
--

INSERT INTO `carrello` (`ID`) VALUES
(1),
(2);

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--

CREATE TABLE `categoria` (
  `ID` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `descrizione` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `categoria`
--

INSERT INTO `categoria` (`ID`, `nome`, `descrizione`) VALUES
(9, 'categoria1', 'Descrizione categoria1'),
(10, 'categoria2', 'Descrizione categoria2');

-- --------------------------------------------------------

--
-- Struttura della tabella `categorie_preferite`
--

CREATE TABLE `categorie_preferite` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `categorie_preferite`
--

INSERT INTO `categorie_preferite` (`id`, `id_user`, `id_categoria`) VALUES
(17, 2, 9),
(18, 3, 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `feedback`
--

CREATE TABLE `feedback` (
  `ID` int(11) NOT NULL,
  `voto` int(11) DEFAULT NULL,
  `commento` text DEFAULT NULL,
  `data` date DEFAULT NULL,
  `idUtente` int(11) DEFAULT NULL,
  `idProdotto` int(11) DEFAULT NULL,
  `idOrdine` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `feedback`
--

INSERT INTO `feedback` (`ID`, `voto`, `commento`, `data`, `idUtente`, `idProdotto`, `idOrdine`) VALUES
(1, 5, 'Ottimo prodotto', '2024-03-29', 2, 10, 1),
(2, 4, 'Buon prodotto', '2024-03-29', 3, 11, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `foto`
--

CREATE TABLE `foto` (
  `ID` int(11) NOT NULL,
  `descrizione` text DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `idProdotto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `foto`
--

INSERT INTO `foto` (`ID`, `descrizione`, `nome`, `path`, `idProdotto`) VALUES
(1, 'Descrizione Foto1', 'Foto1', '/path/to/foto1.jpg', 10),
(2, 'Descrizione Foto2', 'Foto2', '/path/to/foto2.jpg', 11);

-- --------------------------------------------------------

--
-- Struttura della tabella `metodo_pagamento`
--

CREATE TABLE `metodo_pagamento` (
  `ID` int(11) NOT NULL,
  `n_carta` varchar(16) DEFAULT NULL,
  `cvv` varchar(4) DEFAULT NULL,
  `scadenza` date DEFAULT NULL,
  `idUtente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `metodo_pagamento`
--

INSERT INTO `metodo_pagamento` (`ID`, `n_carta`, `cvv`, `scadenza`, `idUtente`) VALUES
(1, '1234567890123456', '123', '2025-12-31', 2),
(2, '9876543210987654', '456', '2026-12-31', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE `ordine` (
  `ID` int(11) NOT NULL,
  `data_acquisto` date DEFAULT NULL,
  `stato` varchar(50) DEFAULT NULL,
  `indirizzo` varchar(255) DEFAULT NULL,
  `idCarrello` int(11) DEFAULT NULL,
  `idM_pagamento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `ordine`
--

INSERT INTO `ordine` (`ID`, `data_acquisto`, `stato`, `indirizzo`, `idCarrello`, `idM_pagamento`) VALUES
(1, '2024-03-29', 'In attesa', 'Indirizzo1', 1, 1),
(2, '2024-03-29', 'In attesa', 'Indirizzo2', 2, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto`
--

CREATE TABLE `prodotto` (
  `ID` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `data_aggiunta` date DEFAULT NULL,
  `prezzo` decimal(10,2) DEFAULT NULL,
  `quantita` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `prodotto`
--

INSERT INTO `prodotto` (`ID`, `nome`, `descrizione`, `data_aggiunta`, `prezzo`, `quantita`) VALUES
(10, 'Prodotto1', 'Descrizione Prodotto1', '2024-03-29', 19.99, 100),
(11, 'Prodotto2', 'Descrizione Prodotto2', '2024-03-29', 29.99, 150);

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `ID` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`ID`, `username`, `password`, `email`, `telefono`, `isAdmin`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, 1),
(2, 'user1', 'password1', 'user1@example.com', '123456789', 0),
(3, 'Piace', 'prova', 'piacentinialessandro@gmail.com', '3755157237', 0),
(4, 'user2', 'password2', 'user2@example.com', '987654321', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `visite_prodotto`
--

CREATE TABLE `visite_prodotto` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_prodotto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `visite_prodotto`
--

INSERT INTO `visite_prodotto` (`id`, `id_user`, `id_prodotto`) VALUES
(1, 2, 10),
(2, 3, 11);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `aggiunto`
--
ALTER TABLE `aggiunto`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idProdotto` (`idProdotto`),
  ADD KEY `idCarrello` (`idCarrello`);

--
-- Indici per le tabelle `appartiene`
--
ALTER TABLE `appartiene`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idProdotto` (`idProdotto`),
  ADD KEY `idCategoria` (`idCategoria`);

--
-- Indici per le tabelle `carrello`
--
ALTER TABLE `carrello`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `categorie_preferite`
--
ALTER TABLE `categorie_preferite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`,`id_categoria`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indici per le tabelle `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idUtente` (`idUtente`),
  ADD KEY `idProdotto` (`idProdotto`),
  ADD KEY `idOrdine` (`idOrdine`);

--
-- Indici per le tabelle `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idProdotto` (`idProdotto`);

--
-- Indici per le tabelle `metodo_pagamento`
--
ALTER TABLE `metodo_pagamento`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idUtente` (`idUtente`);

--
-- Indici per le tabelle `ordine`
--
ALTER TABLE `ordine`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idCarrello` (`idCarrello`),
  ADD KEY `idM_pagamento` (`idM_pagamento`);

--
-- Indici per le tabelle `prodotto`
--
ALTER TABLE `prodotto`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `visite_prodotto`
--
ALTER TABLE `visite_prodotto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`,`id_prodotto`),
  ADD KEY `id_prodotto` (`id_prodotto`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `aggiunto`
--
ALTER TABLE `aggiunto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `appartiene`
--
ALTER TABLE `appartiene`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la tabella `carrello`
--
ALTER TABLE `carrello`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `categorie_preferite`
--
ALTER TABLE `categorie_preferite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT per la tabella `feedback`
--
ALTER TABLE `feedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `foto`
--
ALTER TABLE `foto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `metodo_pagamento`
--
ALTER TABLE `metodo_pagamento`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `ordine`
--
ALTER TABLE `ordine`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `visite_prodotto`
--
ALTER TABLE `visite_prodotto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=274;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `aggiunto`
--
ALTER TABLE `aggiunto`
  ADD CONSTRAINT `aggiunto_ibfk_1` FOREIGN KEY (`idProdotto`) REFERENCES `prodotto` (`ID`),
  ADD CONSTRAINT `aggiunto_ibfk_2` FOREIGN KEY (`idCarrello`) REFERENCES `carrello` (`ID`);

--
-- Limiti per la tabella `appartiene`
--
ALTER TABLE `appartiene`
  ADD CONSTRAINT `appartiene_ibfk_1` FOREIGN KEY (`idProdotto`) REFERENCES `prodotto` (`ID`),
  ADD CONSTRAINT `appartiene_ibfk_2` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`ID`);

--
-- Limiti per la tabella `categorie_preferite`
--
ALTER TABLE `categorie_preferite`
  ADD CONSTRAINT `categorie_preferite_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `utente` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `categorie_preferite_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`idUtente`) REFERENCES `utente` (`ID`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`idProdotto`) REFERENCES `prodotto` (`ID`),
  ADD CONSTRAINT `feedback_ibfk_3` FOREIGN KEY (`idOrdine`) REFERENCES `ordine` (`ID`);

--
-- Limiti per la tabella `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`idProdotto`) REFERENCES `prodotto` (`ID`);

--
-- Limiti per la tabella `metodo_pagamento`
--
ALTER TABLE `metodo_pagamento`
  ADD CONSTRAINT `metodo_pagamento_ibfk_1` FOREIGN KEY (`idUtente`) REFERENCES `utente` (`ID`);

--
-- Limiti per la tabella `ordine`
--
ALTER TABLE `ordine`
  ADD CONSTRAINT `ordine_ibfk_1` FOREIGN KEY (`idCarrello`) REFERENCES `carrello` (`ID`),
  ADD CONSTRAINT `ordine_ibfk_2` FOREIGN KEY (`idM_pagamento`) REFERENCES `metodo_pagamento` (`ID`);

--
-- Limiti per la tabella `visite_prodotto`
--
ALTER TABLE `visite_prodotto`
  ADD CONSTRAINT `visite_prodotto_ibfk_1` FOREIGN KEY (`id_prodotto`) REFERENCES `prodotto` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `visite_prodotto_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `utente` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
