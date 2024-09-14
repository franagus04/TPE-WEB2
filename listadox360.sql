-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-09-2024 a las 00:46:02
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tpe`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listadox360`
--

CREATE TABLE `listadox360` (
  `ID` mediumint(5) NOT NULL,
  `title_ID` varchar(10) NOT NULL,
  `PEGI_class` tinyint(2) NOT NULL,
  `title` varchar(60) NOT NULL,
  `genre` varchar(45) NOT NULL,
  `VANDAL_rating` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='listado de juegos de Xbox 360';

--
-- Volcado de datos para la tabla `listadox360`
--

INSERT INTO `listadox360` (`ID`, `title_ID`, `PEGI_class`, `title`, `genre`, `VANDAL_rating`) VALUES
(1, '555308c2', 18, 'Assassin\'s Creed IV: Black Flag', 'Accion - Aventura', '9/10'),
(2, '415608a7', 18, 'PROTOTYPE 2', 'Accion - Aventura', '8.4/10');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `listadox360`
--
ALTER TABLE `listadox360`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `listadox360`
--
ALTER TABLE `listadox360`
  MODIFY `ID` mediumint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
