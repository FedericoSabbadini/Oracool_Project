-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Creato il: Mar 27, 2025 alle 18:51
-- Versione del server: 5.7.39
-- Versione PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MyLibraryDB`
--
CREATE DATABASE IF NOT EXISTS `MyLibraryDB` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `MyLibraryDB`;

-- --------------------------------------------------------

--
-- Struttura della tabella `author`
--

CREATE TABLE `author` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `author`
--

INSERT INTO `author` (`id`, `firstname`, `lastname`) VALUES
(1, 'J.R.R.', 'Tolkien'),
(2, 'J.K.', 'Rowling'),
(3, 'C.S.', 'Lewis'),
(4, 'George', 'Orwell'),
(5, 'Antoine', 'de Saint-Exupéry'),
(6, 'Dan', 'Brown'),
(7, 'Jane', 'Austen'),
(8, 'Emily', 'Brontë'),
(9, 'Michael', 'Ende'),
(10, 'Lev', 'Tolstoj'),
(11, 'Umberto', 'Eco'),
(12, 'William', 'Golding'),
(13, 'Louisa May', 'Alcott'),
(14, 'Herman', 'Melville'),
(15, 'Arthur Conan', 'Doyle'),
(16, 'Alexandre', 'Dumas'),
(17, 'George R.R.', 'Martin'),
(18, 'Miguel de', 'Cervantes'),
(20, 'Robert Louis', 'Stevenson'),
(21, 'Fëdor', 'Dostoevskij'),
(22, 'F. Scott', 'Fitzgerald'),
(23, 'Dolores', 'Redondo'),
(24, 'John', 'Grisham'),
(25, 'Markus', 'Zusak'),
(26, 'Stendhal', ''),
(27, 'Charles', 'Darwin'),
(28, 'Rhonda', 'Byrne'),
(29, 'Kahlil', 'Gibran'),
(30, '', 'Dio'),
(31, 'Albert', 'Camus'),
(32, 'Harper', 'Lee'),
(33, 'Philip K.', 'Dick'),
(34, 'Virginia', 'Woolf'),
(35, 'John', 'Milton'),
(36, 'Jonathan', 'Swift'),
(37, 'Giovanni', 'Verga'),
(38, 'Aldous', 'Huxley'),
(39, 'Rudyard', 'Kipling'),
(40, 'Jules', 'Verne'),
(41, 'W. Somerset', 'Maugham'),
(42, 'Carlo', 'Collodi'),
(43, 'J.M.', 'Barrie'),
(44, 'Lewis', 'Carroll'),
(45, 'Jeanne-Marie Leprince', 'de Beaumont'),
(46, 'Victor', 'Hugo'),
(47, 'L. Frank', 'Baum'),
(48, 'Agatha', 'Christie'),
(49, 'Ernest', 'Hemingway'),
(50, 'Oscar', 'Wilde'),
(51, 'Franz', 'Kafka'),
(52, 'J.D.', 'Salinger'),
(54, 'Friedrich', 'Nietzsche'),
(56, 'H.P.', 'Lovecraft'),
(57, 'Stephen', 'King'),
(58, 'Charlotte', 'Brontë'),
(59, 'Edgar Allan', 'Poe'),
(60, 'Hermann', 'Hesse'),
(61, 'Gabriel', 'García Márquez'),
(62, 'Tennessee', 'Williams'),
(64, 'Charles', 'Dickens'),
(65, 'Mark', 'Twain'),
(67, 'Arthur', 'Conan Doyle');

-- --------------------------------------------------------

--
-- Struttura della tabella `book`
--

CREATE TABLE `book` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `author_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `book`
--

INSERT INTO `book` (`id`, `title`, `author_id`) VALUES
(1, 'Il Signore degli Anelli', 1),
(2, 'Harry Potter e la Pietra Filosofale', 2),
(3, 'Cronache di Narnia', 3),
(4, '1984', 4),
(5, 'Il Piccolo Principe', 5),
(6, 'Il Codice Da Vinci', 6),
(7, 'Orgoglio e Pregiudizio', 7),
(8, 'Cime Tempestose', 8),
(9, 'La storia infinita', 9),
(10, 'Anna Karenina', 10),
(11, 'Il Nome della Rosa', 11),
(12, 'Il signore delle mosche', 12),
(13, 'Piccole Donne', 13),
(14, 'Moby Dick', 14),
(15, 'Le avventure di Sherlock Holmes', 15),
(16, 'Il conte di Montecristo', 16),
(17, 'Cronache del ghiaccio e del fuoco', 17),
(18, 'Don Chisciotte', 18),
(20, 'La fattoria degli animali', 4),
(21, 'Lo strano caso del dottor Jekyll e del signor Hyde', 20),
(22, 'Guerra e pace', 10),
(23, 'Il vecchio e il mare', 21),
(24, 'Il ritratto di Dorian Gray', 22),
(25, 'La metamorfosi', 23),
(26, 'Il processo', 23),
(27, 'Il giovane Holden', 24),
(28, 'Cent\'anni di solitudine', 25),
(29, 'Delitto e castigo', 26),
(30, 'Il mastino dei Baskerville', 15),
(31, 'Il grande Gatsby', 27),
(32, 'Il guardiano invisibile', 28),
(33, 'Il guardiano degli innocenti', 29),
(35, 'Il rosso e il nero', 31),
(36, 'Il trono di spade', 17),
(37, 'L\'origine delle specie', 32),
(38, 'Il segreto', 33),
(39, 'Le cronache del ghiaccio e del fuoco', 17),
(40, 'I pilastri della terra', 34),
(41, 'Il profeta', 35),
(42, 'La Bibbia', 30),
(43, 'Lo straniero', 37),
(44, 'Il buio oltre la siepe', 38),
(45, 'La svastica sul sole', 39),
(46, 'Le onde', 40),
(47, 'Il paradiso perduto', 41),
(48, 'I viaggi di Gulliver', 42),
(49, 'Il libro della giungla', 43),
(50, 'L\'isola del tesoro', 44),
(51, 'Venti mila leghe sotto i mari', 45),
(52, 'Oliver Twist', 46),
(53, 'La luna e sei soldi', 47),
(54, 'Le cronache di Narnia', 3),
(55, 'Lo Hobbit', 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_author_foreign` (`author_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `author`
--
ALTER TABLE `author`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT per la tabella `book`
--
ALTER TABLE `book`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_author_foreign` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
