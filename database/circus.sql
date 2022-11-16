-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2022 a las 20:28:59
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `circus`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artist`
--

CREATE TABLE `artist` (
  `id_artist` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `artist`
--

INSERT INTO `artist` (`id_artist`, `name`, `type`, `description`) VALUES
(76, 'Glenda Goyette', 'Equilibrist', 'She is the best in town'),
(77, 'krusty', 'the clown', 'the best jokes'),
(78, 'Jack', 'The mad hatter', 'He is a wonderful  magic artist');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `show`
--

CREATE TABLE `show` (
  `id_show` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_artist` int(11) NOT NULL,
  `date` date NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `show`
--

INSERT INTO `show` (`id_show`, `name`, `id_artist`, `date`, `price`) VALUES
(105, 'The magic World', 76, '2022-10-15', 2020),
(106, 'Laugh and love', 77, '2022-10-21', 3000),
(107, 'The mysterious trip', 78, '2022-10-13', 3450),
(108, 'Magic and more magic', 77, '2022-10-13', 1550),
(109, 'Dance and enjoy', 76, '2022-09-09', 5000),
(111, 'Crazy', 78, '2022-10-28', 2350);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`) VALUES
(3, 'martuudiaz28@gmail.com', '$2a$12$h46xHO2iJmGStayW1o8lO.9mR4SHZw.pkI3YdoCZ/phyzXaBru/Y2');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`id_artist`);

--
-- Indices de la tabla `show`
--
ALTER TABLE `show`
  ADD PRIMARY KEY (`id_show`),
  ADD KEY `id_artist` (`id_artist`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `artist`
--
ALTER TABLE `artist`
  MODIFY `id_artist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de la tabla `show`
--
ALTER TABLE `show`
  MODIFY `id_show` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `show`
--
ALTER TABLE `show`
  ADD CONSTRAINT `show_ibfk_1` FOREIGN KEY (`id_artist`) REFERENCES `artist` (`id_artist`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
