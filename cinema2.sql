-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1:3307
-- Létrehozás ideje: 2021. Dec 07. 21:02
-- Kiszolgáló verziója: 10.4.10-MariaDB
-- PHP verzió: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `cinema2`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `timeslot` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `total_price` int(255) NOT NULL,
  `seats` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `bookings`
--

INSERT INTO `bookings` (`id`, `date`, `timeslot`, `customer_id`, `movie_id`, `total_price`, `seats`) VALUES
(69, '2021-12-05', '09:00AM-11:03AM', 4, 26, 150, '[19,20,21]'),
(70, '2021-12-05', '09:00AM-11:03AM', 4, 26, 150, '[19,20,21]'),
(71, '2021-12-05', '12:04PM-14:38PM', 4, 27, 150, '[18,19,27]'),
(77, '2021-12-05', '11:50AM-14:10PM', 4, 28, 150, '[16,17,25]');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `profileImage` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `registerDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `password`, `profileImage`, `registerDate`) VALUES
(1, 'Admin', 'lomutpali@gmail.com', '', '', '2021-11-01 21:36:28'),
(2, 'robin', 'test@test.hu', '$2y$10$YQCq4mN6Jo5CokV8J0e2XuMSMLChOJeldv.au8oUogYSeq7qWetDS', './assets/profile/icons8-login-as-user-48.png', '2021-11-01 21:39:21'),
(3, 'testUser', 'test@user.com', '$2y$10$72h3Aqb/BAiR5e/rSxl7Ee4oiezXyxz1a6VWOXqFzMzV.QEm8j7dC', './assets/profile/icons8-login-as-user-48.png', '2021-12-02 20:12:11'),
(4, 'testUser2', 'test@user2.com', '$2y$10$CIy9dY5tejLBJuEVbXjnaOwPLpurnIRZx61X6tm6K744yPAA2mCH6', './assets/profile/b_robin.jpg', '2021-12-05 17:54:45');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `release_date` date NOT NULL,
  `language` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `running_time` int(10) NOT NULL,
  `genre` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `poster` varchar(255) COLLATE utf8mb4_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `movies`
--

INSERT INTO `movies` (`id`, `title`, `description`, `release_date`, `language`, `running_time`, `genre`, `poster`) VALUES
(26, 'NewMovie', 'Kivételes filmremek, ajánlott a megtekintése', '2021-12-02', 'norvég', 123, 'krimi', 'thumbnail_hb_42.167.jpg'),
(27, 'Ponyvaregény', 'The lives of two mob hitmen, a boxer, a gangster and his wife, and a pair of diner bandits intertwine in four tales of violence and redemption.', '1994-01-01', 'english', 154, 'crime', 'pulp-fiction_d178_720x1280.jpg'),
(28, 'The King', 'Hal, wayward prince and heir to the English throne, is crowned King Henry V after his tyrannical father dies. Now the young king must navigate palace politics, the war his father left behind, and the emotional strings of his past life.', '2019-11-25', 'latin', 140, 'history', 'the-king_4a58_720x1280.jpg');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- A tábla indexei `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT a táblához `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
