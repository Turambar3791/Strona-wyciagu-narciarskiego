-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 22 Kwi 2023, 12:46
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `wyciag`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `karnety`
--

CREATE TABLE `karnety` (
  `id` int(11) NOT NULL,
  `cena` float DEFAULT NULL,
  `opis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `karnety`
--

INSERT INTO `karnety` (`id`, `cena`, `opis`) VALUES
(1, 70, 'Karnet 4 godzinny'),
(3, 125, 'Karnet 12 godzinny'),
(4, 200, 'Karnet 2-dniowy (weekendowy)');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `paragon`
--

CREATE TABLE `paragon` (
  `id` int(11) NOT NULL,
  `klient` int(11) DEFAULT NULL,
  `karnet` int(11) DEFAULT NULL,
  `data` date NOT NULL DEFAULT current_timestamp(),
  `kod` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `paragon`
--

INSERT INTO `paragon` (`id`, `klient`, `karnet`, `data`, `kod`) VALUES
(171, 1, 1, '2023-03-31', 104402),
(179, 8, 4, '2023-04-16', 642967),
(181, 8, 4, '2023-04-18', 811255);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `user` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `admin` int(11) DEFAULT 0,
  `portfel` float NOT NULL DEFAULT 0,
  `ban` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `user`, `password`, `email`, `admin`, `portfel`, `ban`) VALUES
(1, 'Adam', '$2y$10$ErPqhJSAsjP/1qfFTjyvVOGj9e1Dw8pz4EBGZfkYpiV/EVgmCfXNS', 'adam@gmail.com', 0, 45, 0),
(8, 'Andrzej', '$2y$10$0xCqGnezqy/Ay1KM0b/81.gOqVZamh8j7/Rc2in8ySXvyHw1Ct5Uy', 'andrzej@gmail.com', 1, 4414, 0),
(11, 'Michal', '$2y$10$9bynWuGwfTnXygGPkLvvnuN6ZmnEsrCgYx/r7DIrelawy1x6NgBzi', 'michal@gmail.com', 0, 0, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `karnety`
--
ALTER TABLE `karnety`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `paragon`
--
ALTER TABLE `paragon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_paragon_karnety` (`karnet`),
  ADD KEY `fk_paragon_uzytkownicy` (`klient`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `karnety`
--
ALTER TABLE `karnety`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT dla tabeli `paragon`
--
ALTER TABLE `paragon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `paragon`
--
ALTER TABLE `paragon`
  ADD CONSTRAINT `fk_paragon_karnety` FOREIGN KEY (`karnet`) REFERENCES `karnety` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_paragon_uzytkownicy` FOREIGN KEY (`klient`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
