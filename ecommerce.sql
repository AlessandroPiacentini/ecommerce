-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 13, 2024 alle 10:22
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
-- Struttura della tabella `aggiunta_carrello`
--

CREATE TABLE `aggiunta_carrello` (
  `ID` int(11) NOT NULL,
  `idProdotto` int(11) DEFAULT NULL,
  `idCarrello` int(11) DEFAULT NULL,
  `quantita_carrello` int(11) DEFAULT NULL,
  `temporaneo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `aggiunta_carrello`
--

INSERT INTO `aggiunta_carrello` (`ID`, `idProdotto`, `idCarrello`, `quantita_carrello`, `temporaneo`) VALUES
(80, 2, 10, 1, 0),
(81, 2, 11, 1, 0),
(82, 6, 12, 1, 1),
(83, 2, 8, 1, 0);

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
(1, 1, 3),
(2, 2, 1),
(3, 3, 5),
(4, 4, 2),
(5, 5, 4),
(6, 6, 1),
(7, 7, 6),
(8, 8, 3),
(9, 9, 2),
(10, 10, 5),
(11, 11, 4),
(12, 12, 1),
(13, 13, 6),
(14, 14, 3),
(15, 15, 2),
(16, 16, 5),
(17, 17, 4),
(18, 18, 1),
(19, 19, 6),
(20, 20, 3),
(21, 21, 2),
(22, 22, 5),
(23, 23, 4),
(24, 24, 1),
(25, 25, 6),
(26, 26, 3),
(27, 27, 2),
(28, 28, 5),
(29, 29, 4),
(30, 30, 1),
(31, 31, 6),
(32, 32, 3),
(33, 33, 2),
(34, 34, 5),
(35, 35, 4),
(36, 36, 1),
(37, 37, 6),
(38, 38, 3),
(39, 39, 2),
(40, 40, 5),
(41, 41, 4),
(42, 42, 1),
(43, 43, 6),
(44, 44, 3),
(45, 45, 2),
(46, 46, 5),
(47, 47, 4),
(48, 48, 1),
(49, 49, 6),
(50, 50, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

CREATE TABLE `carrello` (
  `ID` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `attivo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `carrello`
--

INSERT INTO `carrello` (`ID`, `id_utente`, `attivo`) VALUES
(6, 3, 0),
(7, 7, 1),
(8, 8, 0),
(9, 9, 1),
(10, 3, 0),
(11, 3, 0),
(12, 3, 0),
(13, 8, 1),
(14, 3, 1);

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
(1, 'Elettronica', 'Prodotti elettronici di vario genere'),
(2, 'Abbigliamento', 'Abbigliamento per uomo, donna e bambino'),
(3, 'Casa e Giardino', 'Prodotti per la casa e il giardino'),
(4, 'Sport e Tempo libero', 'Attrezzature sportive e prodotti per il tempo libero'),
(5, 'Salute e Bellezza', 'Prodotti per la salute e la bellezza'),
(6, 'Alimentari', 'Prodotti alimentari di vario genere'),
(7, 'Libri e Film', 'Libri, film e media correlati'),
(8, 'Giochi e Giocattoli', 'Giochi e giocattoli per tutte le età'),
(9, 'Auto e Moto', 'Accessori per auto e moto'),
(10, 'Arredamento', 'Arredamento per la casa e l ufficio'),
(11, 'Elettroutensili', 'Strumenti elettrici e attrezzature'),
(12, 'Fai da te', 'Prodotti per il fai da te e il bricolage'),
(13, 'Animali', 'Prodotti per animali domestici'),
(14, 'Musica', 'Strumenti musicali e accessori'),
(15, 'Articoli per ufficio', 'Forniture per ufficio e accessori'),
(16, 'Tecnologia', 'Prodotti tecnologici e accessori'),
(17, 'Articoli per bambini', 'Prodotti per neonati e bambini'),
(18, 'Cura della casa', 'Prodotti per la pulizia e la cura della casa'),
(19, 'Artigianato', 'Materiali per l artigianato e le belle arti'),
(20, 'Viaggi', 'Accessori e prodotti per viaggi e vacanze');

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
(138, 1, 1),
(139, 1, 1),
(36, 3, 1),
(38, 3, 1),
(39, 3, 1),
(41, 3, 1),
(42, 3, 1),
(43, 3, 1),
(44, 3, 1),
(45, 3, 1),
(46, 3, 1),
(47, 3, 1),
(48, 3, 1),
(49, 3, 1),
(50, 3, 1),
(51, 3, 1),
(53, 3, 1),
(55, 3, 1),
(56, 3, 1),
(57, 3, 1),
(58, 3, 1),
(59, 3, 1),
(60, 3, 1),
(61, 3, 1),
(62, 3, 1),
(63, 3, 1),
(64, 3, 1),
(65, 3, 1),
(66, 3, 1),
(67, 3, 1),
(68, 3, 1),
(69, 3, 1),
(70, 3, 1),
(71, 3, 1),
(72, 3, 1),
(74, 3, 1),
(75, 3, 1),
(76, 3, 1),
(77, 3, 1),
(78, 3, 1),
(79, 3, 1),
(80, 3, 1),
(81, 3, 1),
(83, 3, 1),
(84, 3, 1),
(85, 3, 1),
(86, 3, 1),
(87, 3, 1),
(88, 3, 1),
(89, 3, 1),
(91, 3, 1),
(92, 3, 1),
(93, 3, 1),
(94, 3, 1),
(95, 3, 1),
(96, 3, 1),
(98, 3, 1),
(99, 3, 1),
(100, 3, 1),
(101, 3, 1),
(102, 3, 1),
(103, 3, 1),
(104, 3, 1),
(105, 3, 1),
(106, 3, 1),
(107, 3, 1),
(108, 3, 1),
(109, 3, 1),
(110, 3, 1),
(111, 3, 1),
(112, 3, 1),
(113, 3, 1),
(114, 3, 1),
(115, 3, 1),
(116, 3, 1),
(117, 3, 1),
(118, 3, 1),
(119, 3, 1),
(120, 3, 1),
(121, 3, 1),
(122, 3, 1),
(123, 3, 1),
(124, 3, 1),
(125, 3, 1),
(126, 3, 1),
(127, 3, 1),
(128, 3, 1),
(129, 3, 1),
(130, 3, 1),
(131, 3, 1),
(132, 3, 1),
(133, 3, 1),
(134, 3, 1),
(135, 3, 1),
(136, 3, 1),
(137, 3, 1),
(140, 3, 1),
(141, 3, 1),
(142, 3, 1),
(22, 3, 2),
(34, 3, 2),
(52, 3, 2),
(54, 3, 2),
(143, 3, 2),
(23, 3, 3),
(21, 3, 5),
(40, 3, 5),
(73, 3, 5),
(90, 3, 5),
(97, 3, 5),
(18, 3, 6),
(37, 3, 6),
(16, 3, 8),
(35, 3, 8),
(82, 3, 8),
(17, 3, 9),
(33, 3, 9),
(19, 3, 15),
(20, 3, 18),
(28, 4, 1),
(32, 4, 4),
(25, 4, 5),
(29, 4, 5),
(30, 4, 6),
(31, 4, 7),
(26, 4, 8),
(27, 4, 9),
(24, 4, 17);

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

-- --------------------------------------------------------

--
-- Struttura della tabella `metodo_pagamento`
--

CREATE TABLE `metodo_pagamento` (
  `ID` int(11) NOT NULL,
  `n_carta` varchar(16) DEFAULT NULL,
  `cvv` varchar(4) DEFAULT NULL,
  `mese_scadenza` varchar(255) DEFAULT NULL,
  `idUtente` int(11) DEFAULT NULL,
  `anno_scadenza` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `metodo_pagamento`
--

INSERT INTO `metodo_pagamento` (`ID`, `n_carta`, `cvv`, `mese_scadenza`, `idUtente`, `anno_scadenza`) VALUES
(1, '4587 1963 4173 1', '321', '03', 3, '2026'),
(2, '4779 7862 8520 0', '321', '03', 3, '2026'),
(7, '5588767777888580', '965', '05', 3, '2030'),
(8, '5168883035720982', '852', '07', 3, '2036'),
(9, '424242424242', '625', '06', 8, '2025');

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE `ordine` (
  `ID` int(11) NOT NULL,
  `data_acquisto` date DEFAULT NULL,
  `stato` varchar(50) DEFAULT 'preparazione',
  `indirizzo` varchar(255) DEFAULT NULL,
  `idCarrello` int(11) DEFAULT NULL,
  `idM_pagamento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `ordine`
--

INSERT INTO `ordine` (`ID`, `data_acquisto`, `stato`, `indirizzo`, `idCarrello`, `idM_pagamento`) VALUES
(1, '2024-05-06', 'preparazione', 'Via Icmesa, 3', 10, 1),
(2, '2024-05-07', 'preparazione', 'Via Icmesa, 3', 11, 1),
(3, '2024-05-07', 'preparazione', 'via alessandro volta, 116', 12, 2),
(4, '2024-05-13', 'preparazione', 'via alessandro volta, 116', 8, 9);

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto`
--

CREATE TABLE `prodotto` (
  `ID` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `prezzo` decimal(10,2) DEFAULT NULL,
  `quantita` int(11) DEFAULT NULL,
  `img_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `prodotto`
--

INSERT INTO `prodotto` (`ID`, `nome`, `descrizione`, `prezzo`, `quantita`, `img_path`) VALUES
(1, 'Prodotto 1', 'Descrizione del prodotto 1', 10.99, 1, '0'),
(2, 'Prodotto 2', 'Descrizione del prodotto 2', 19.99, 200, '0'),
(3, 'Prodotto 3', 'Descrizione del prodotto 3', 5.49, 1, '0'),
(4, 'Prodotto 4', 'Descrizione del prodotto 4', 7.99, 1, '0'),
(5, 'Prodotto 5', 'Descrizione del prodotto 5', 12.79, 1, '0'),
(6, 'Prodotto 6', 'Descrizione del prodotto 6', 8.99, 1, '0'),
(7, 'Prodotto 7', 'Descrizione del prodotto 7', 14.49, 1, '0'),
(8, 'Prodotto 8', 'Descrizione del prodotto 8', 6.99, 1, '0'),
(9, 'Prodotto 9', 'Descrizione del prodotto 9', 11.29, 1, '0'),
(10, 'Prodotto 10', 'Descrizione del prodotto 10', 9.99, 1, '0'),
(11, 'Prodotto 11', 'Descrizione del prodotto 11', 15.99, 1, '0'),
(12, 'Prodotto 12', 'Descrizione del prodotto 12', 18.49, 1, '0'),
(13, 'Prodotto 13', 'Descrizione del prodotto 13', 4.99, 1, '0'),
(14, 'Prodotto 14', 'Descrizione del prodotto 14', 13.49, 1, '0'),
(15, 'Prodotto 15', 'Descrizione del prodotto 15', 10.49, 1, '0'),
(16, 'Prodotto 16', 'Descrizione del prodotto 16', 7.99, 1, '0'),
(17, 'Prodotto 17', 'Descrizione del prodotto 17', 22.99, 1, '0'),
(18, 'Prodotto 18', 'Descrizione del prodotto 18', 16.49, 1, '0'),
(19, 'Prodotto 19', 'Descrizione del prodotto 19', 9.99, 1, '0'),
(20, 'Prodotto 20', 'Descrizione del prodotto 20', 11.99, 1, '0'),
(21, 'Prodotto 21', 'Descrizione del prodotto 21', 14.99, 1, '0'),
(22, 'Prodotto 22', 'Descrizione del prodotto 22', 19.49, 1, '0'),
(23, 'Prodotto 23', 'Descrizione del prodotto 23', 8.49, 1, '0'),
(24, 'Prodotto 24', 'Descrizione del prodotto 24', 12.99, 1, '0'),
(25, 'Prodotto 25', 'Descrizione del prodotto 25', 6.79, 1, '0'),
(26, 'Prodotto 26', 'Descrizione del prodotto 26', 17.99, 1, '0'),
(27, 'Prodotto 27', 'Descrizione del prodotto 27', 10.99, 1, '0'),
(28, 'Prodotto 28', 'Descrizione del prodotto 28', 13.49, 1, '0'),
(29, 'Prodotto 29', 'Descrizione del prodotto 29', 9.49, 1, '0'),
(30, 'Prodotto 30', 'Descrizione del prodotto 30', 21.99, 1, '0'),
(31, 'Prodotto 31', 'Descrizione del prodotto 31', 5.99, 1, '0'),
(32, 'Prodotto 32', 'Descrizione del prodotto 32', 8.49, 1, '0'),
(33, 'Prodotto 33', 'Descrizione del prodotto 33', 11.99, 1, '0'),
(34, 'Prodotto 34', 'Descrizione del prodotto 34', 7.49, 1, '0'),
(35, 'Prodotto 35', 'Descrizione del prodotto 35', 14.99, 1, '0'),
(36, 'Prodotto 36', 'Descrizione del prodotto 36', 16.49, 1, '0'),
(37, 'Prodotto 37', 'Descrizione del prodotto 37', 9.99, 1, '0'),
(38, 'Prodotto 38', 'Descrizione del prodotto 38', 11.99, 1, '0'),
(39, 'Prodotto 39', 'Descrizione del prodotto 39', 5.79, 1, '0'),
(40, 'Prodotto 40', 'Descrizione del prodotto 40', 18.99, 1, '0'),
(41, 'Prodotto 41', 'Descrizione del prodotto 41', 12.49, 1, '0'),
(42, 'Prodotto 42', 'Descrizione del prodotto 42', 7.99, 1, '0'),
(43, 'Prodotto 43', 'Descrizione del prodotto 43', 14.99, 1, '0'),
(44, 'Prodotto 44', 'Descrizione del prodotto 44', 9.49, 1, '0'),
(45, 'Prodotto 45', 'Descrizione del prodotto 45', 10.99, 1, '0'),
(46, 'Prodotto 46', 'Descrizione del prodotto 46', 19.49, 1, '0'),
(47, 'Prodotto 47', 'Descrizione del prodotto 47', 8.49, 1, '0'),
(48, 'Prodotto 48', 'Descrizione del prodotto 48', 13.99, 1, '0'),
(49, 'Prodotto 49', 'Descrizione del prodotto 49', 6.79, 1, '0'),
(50, 'Prodotto 50', 'Descrizione del prodotto 50', 11.99, 1, '0'),
(51, 'Prodotto Aggiunto prova', 'prodotto di prova aggiunto con form', 10.50, 100, '../img/sfondo nero.png');

-- --------------------------------------------------------

--
-- Struttura della tabella `timer`
--

CREATE TABLE `timer` (
  `id` int(11) NOT NULL,
  `time` int(11) NOT NULL DEFAULT -1,
  `idUtente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `timer`
--

INSERT INTO `timer` (`id`, `time`, `idUtente`) VALUES
(0, -1, 3);

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
(3, 'Piace', '189bbbb00c5f1fb7fba9ad9285f193d1', 'piacentinialessandro@gmail.com', '3755157237', 0),
(4, 'Pippo', 'pippo', 'pippo@mail.it', '0987654321', 0),
(7, NULL, NULL, NULL, NULL, 0),
(8, NULL, NULL, NULL, NULL, 0),
(9, 'a', 'a', 'a@a.it', '1', 0);

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
(437, 1, 2),
(439, 1, 2),
(440, 1, 2),
(441, 1, 2),
(442, 1, 2),
(443, 1, 2),
(444, 1, 2),
(445, 1, 2),
(446, 1, 2),
(447, 1, 2),
(448, 1, 2),
(449, 1, 2),
(450, 1, 2),
(462, 1, 6),
(463, 1, 6),
(438, 1, 51),
(274, 3, 1),
(290, 3, 2),
(291, 3, 2),
(292, 3, 2),
(294, 3, 2),
(296, 3, 2),
(298, 3, 2),
(299, 3, 2),
(300, 3, 2),
(301, 3, 2),
(302, 3, 2),
(303, 3, 2),
(304, 3, 2),
(305, 3, 2),
(306, 3, 2),
(307, 3, 2),
(308, 3, 2),
(309, 3, 2),
(310, 3, 2),
(311, 3, 2),
(313, 3, 2),
(321, 3, 2),
(322, 3, 2),
(323, 3, 2),
(324, 3, 2),
(325, 3, 2),
(326, 3, 2),
(327, 3, 2),
(328, 3, 2),
(329, 3, 2),
(330, 3, 2),
(331, 3, 2),
(334, 3, 2),
(336, 3, 2),
(337, 3, 2),
(338, 3, 2),
(339, 3, 2),
(340, 3, 2),
(341, 3, 2),
(342, 3, 2),
(343, 3, 2),
(344, 3, 2),
(345, 3, 2),
(346, 3, 2),
(347, 3, 2),
(348, 3, 2),
(349, 3, 2),
(350, 3, 2),
(351, 3, 2),
(352, 3, 2),
(353, 3, 2),
(354, 3, 2),
(355, 3, 2),
(356, 3, 2),
(357, 3, 2),
(358, 3, 2),
(359, 3, 2),
(361, 3, 2),
(362, 3, 2),
(363, 3, 2),
(364, 3, 2),
(365, 3, 2),
(366, 3, 2),
(367, 3, 2),
(368, 3, 2),
(369, 3, 2),
(370, 3, 2),
(371, 3, 2),
(372, 3, 2),
(373, 3, 2),
(374, 3, 2),
(375, 3, 2),
(376, 3, 2),
(377, 3, 2),
(378, 3, 2),
(379, 3, 2),
(380, 3, 2),
(381, 3, 2),
(382, 3, 2),
(383, 3, 2),
(384, 3, 2),
(385, 3, 2),
(386, 3, 2),
(387, 3, 2),
(388, 3, 2),
(389, 3, 2),
(390, 3, 2),
(391, 3, 2),
(392, 3, 2),
(393, 3, 2),
(394, 3, 2),
(395, 3, 2),
(396, 3, 2),
(397, 3, 2),
(398, 3, 2),
(399, 3, 2),
(400, 3, 2),
(401, 3, 2),
(402, 3, 2),
(403, 3, 2),
(404, 3, 2),
(405, 3, 2),
(407, 3, 2),
(408, 3, 2),
(409, 3, 2),
(410, 3, 2),
(411, 3, 2),
(412, 3, 2),
(413, 3, 2),
(414, 3, 2),
(415, 3, 2),
(416, 3, 2),
(417, 3, 2),
(418, 3, 2),
(419, 3, 2),
(420, 3, 2),
(421, 3, 2),
(422, 3, 2),
(423, 3, 2),
(424, 3, 2),
(429, 3, 2),
(430, 3, 2),
(431, 3, 2),
(432, 3, 2),
(451, 3, 2),
(452, 3, 2),
(455, 3, 2),
(457, 3, 2),
(275, 3, 3),
(278, 3, 3),
(286, 3, 3),
(287, 3, 3),
(295, 3, 3),
(297, 3, 3),
(312, 3, 3),
(320, 3, 3),
(454, 3, 3),
(456, 3, 3),
(461, 3, 3),
(314, 3, 4),
(315, 3, 4),
(318, 3, 4),
(459, 3, 4),
(460, 3, 4),
(316, 3, 6),
(317, 3, 6),
(319, 3, 6),
(332, 3, 6),
(333, 3, 6),
(335, 3, 6),
(425, 3, 6),
(426, 3, 6),
(433, 3, 6),
(434, 3, 6),
(435, 3, 6),
(436, 3, 6),
(453, 3, 6),
(458, 3, 6),
(280, 3, 8),
(279, 3, 9),
(288, 3, 9),
(289, 3, 9),
(276, 3, 13),
(277, 3, 13),
(293, 3, 13),
(360, 3, 24),
(406, 3, 32),
(282, 4, 2),
(283, 4, 3),
(281, 4, 10),
(284, 4, 13),
(285, 4, 47),
(427, 9, 3),
(428, 9, 6);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `aggiunta_carrello`
--
ALTER TABLE `aggiunta_carrello`
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
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idUtente` (`id_utente`);

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
-- Indici per le tabelle `timer`
--
ALTER TABLE `timer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUtente` (`idUtente`);

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
-- AUTO_INCREMENT per la tabella `aggiunta_carrello`
--
ALTER TABLE `aggiunta_carrello`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT per la tabella `appartiene`
--
ALTER TABLE `appartiene`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT per la tabella `carrello`
--
ALTER TABLE `carrello`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT per la tabella `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT per la tabella `categorie_preferite`
--
ALTER TABLE `categorie_preferite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT per la tabella `feedback`
--
ALTER TABLE `feedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `foto`
--
ALTER TABLE `foto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `metodo_pagamento`
--
ALTER TABLE `metodo_pagamento`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `ordine`
--
ALTER TABLE `ordine`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `visite_prodotto`
--
ALTER TABLE `visite_prodotto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=464;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `aggiunta_carrello`
--
ALTER TABLE `aggiunta_carrello`
  ADD CONSTRAINT `aggiunta_carrello_ibfk_1` FOREIGN KEY (`idProdotto`) REFERENCES `prodotto` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aggiunta_carrello_ibfk_2` FOREIGN KEY (`idCarrello`) REFERENCES `carrello` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `appartiene`
--
ALTER TABLE `appartiene`
  ADD CONSTRAINT `appartiene_ibfk_1` FOREIGN KEY (`idProdotto`) REFERENCES `prodotto` (`ID`),
  ADD CONSTRAINT `appartiene_ibfk_2` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`ID`);

--
-- Limiti per la tabella `carrello`
--
ALTER TABLE `carrello`
  ADD CONSTRAINT `vincolo 1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`ID`);

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
-- Limiti per la tabella `timer`
--
ALTER TABLE `timer`
  ADD CONSTRAINT `vinc_id_utente` FOREIGN KEY (`idUtente`) REFERENCES `utente` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
