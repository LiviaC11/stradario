-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 12, 2026 alle 08:48
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
-- Database: `comune_test`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `stradario`
--

CREATE TABLE `stradario` (
  `id` int(11) NOT NULL,
  `dug` varchar(50) DEFAULT NULL,
  `vecchia_denominazione` varchar(255) NOT NULL,
  `nuova_denominazione` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `stradario`
--

INSERT INTO `stradario` (`id`, `dug`, `vecchia_denominazione`, `nuova_denominazione`) VALUES
(1, 'PIAZZA', 'Minardi F.lli Walter e Nullo', 'PIAZZA FRATELLI WALTER E NULLO MINARDI'),
(2, 'PISTA CICLABILE', 'Miserocchi-Pasi', 'PISTA CICLABILE GUGLIELMO MISEROCCHI E IVANO PASI'),
(3, 'ROTONDA', 'XI Settembre 2001', 'ROTONDA 11 SETTEMBRE 2001'),
(4, 'VIA', 'Rossi Mario', 'VIA MARIO ROSSI'),
(5, 'VIALE', 'Carducci Giosuè', 'VIALE GIOSUÈ CARDUCCI'),
(6, 'VIA', 'Minardi F.lli Walter e Nullo', 'VIA FRATELLI WALTER E NULLO MINARDI'),
(7, 'CORSO', 'Rossi Mario', 'CORSO MARIO ROSSI');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `stradario`
--
ALTER TABLE `stradario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `stradario`
--
ALTER TABLE `stradario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
