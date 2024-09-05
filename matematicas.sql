-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-11-2023 a las 04:19:34
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `matematicas`
--
CREATE DATABASE IF NOT EXISTS `matematicas` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE `matematicas`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

DROP TABLE IF EXISTS `alumno`;
CREATE TABLE `alumno` (
  `id_alumno` int(11) NOT NULL,
  `nombre_alumno` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `primer_apellido_alumno` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `segundo_apellido_alumno` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- RELACIONES PARA LA TABLA `alumno`:
--

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id_alumno`, `nombre_alumno`, `primer_apellido_alumno`, `segundo_apellido_alumno`) VALUES
(1, 'Lara', 'Martínez', 'Martínez'),
(2, 'Jesús', 'Lozano', 'García'),
(3, 'Lara', 'Solar', NULL),
(4, 'Pepe', 'Calleja', 'Andrés'),
(5, 'María', 'García', 'Soriano');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intentos`
--

DROP TABLE IF EXISTS `intentos`;
CREATE TABLE `intentos` (
  `id_intentos` int(11) NOT NULL,
  `resultado` tinyint(1) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_operacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- RELACIONES PARA LA TABLA `intentos`:
--   `id_alumno`
--       `alumno` -> `id_alumno`
--   `id_operacion`
--       `operaciones` -> `id_operacion`
--

--
-- Volcado de datos para la tabla `intentos`
--

INSERT INTO `intentos` (`id_intentos`, `resultado`, `id_alumno`, `id_operacion`) VALUES
(1, 1, 1, 1),
(2, 0, 1, 1),
(3, 0, 1, 1),
(4, 1, 1, 1),
(5, 0, 1, 1),
(6, 1, 1, 1),
(7, 0, 1, 1),
(8, 0, 1, 1),
(9, 1, 1, 2),
(10, 0, 5, 2),
(11, 0, 1, 3),
(12, 1, 1, 3),
(13, 0, 1, 4),
(14, 0, 1, 4),
(15, 1, 1, 4),
(16, 1, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel`
--

DROP TABLE IF EXISTS `nivel`;
CREATE TABLE `nivel` (
  `id_nivel` int(11) NOT NULL,
  `numero_fallos` int(11) NOT NULL DEFAULT 0,
  `numero_aciertos` int(11) NOT NULL DEFAULT 0,
  `id_alumno` int(11) NOT NULL,
  `id_operacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- RELACIONES PARA LA TABLA `nivel`:
--   `id_alumno`
--       `alumno` -> `id_alumno`
--   `id_operacion`
--       `operaciones` -> `id_operacion`
--

--
-- Volcado de datos para la tabla `nivel`
--

INSERT INTO `nivel` (`id_nivel`, `numero_fallos`, `numero_aciertos`, `id_alumno`, `id_operacion`) VALUES
(1, 6, 3, 1, 1),
(2, 0, 1, 1, 2),
(3, 0, 0, 2, 3),
(4, 0, 0, 2, 4),
(5, 1, 1, 1, 3),
(6, 2, 2, 1, 4),
(7, 0, 0, 2, 1),
(8, 0, 0, 2, 2),
(9, 2, 1, 5, 1),
(10, 1, 0, 5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operaciones`
--

DROP TABLE IF EXISTS `operaciones`;
CREATE TABLE `operaciones` (
  `id_operacion` int(11) NOT NULL,
  `nombre_operacion` varchar(255) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- RELACIONES PARA LA TABLA `operaciones`:
--

--
-- Volcado de datos para la tabla `operaciones`
--

INSERT INTO `operaciones` (`id_operacion`, `nombre_operacion`) VALUES
(4, 'Dividir'),
(3, 'Multiplicar'),
(2, 'Restar'),
(1, 'Sumar');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id_alumno`);

--
-- Indices de la tabla `intentos`
--
ALTER TABLE `intentos`
  ADD PRIMARY KEY (`id_intentos`),
  ADD KEY `intentos_alumno__fk` (`id_alumno`),
  ADD KEY `intentos_operaciones_fk` (`id_operacion`);

--
-- Indices de la tabla `nivel`
--
ALTER TABLE `nivel`
  ADD PRIMARY KEY (`id_nivel`) USING BTREE,
  ADD KEY `nivel_alumno_id_alumno_fk` (`id_alumno`),
  ADD KEY `nivel_operaciones_fk` (`id_operacion`);

--
-- Indices de la tabla `operaciones`
--
ALTER TABLE `operaciones`
  ADD PRIMARY KEY (`id_operacion`),
  ADD UNIQUE KEY `operaciones_pk2` (`nombre_operacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `intentos`
--
ALTER TABLE `intentos`
  MODIFY `id_intentos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `nivel`
--
ALTER TABLE `nivel`
  MODIFY `id_nivel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `operaciones`
--
ALTER TABLE `operaciones`
  MODIFY `id_operacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `intentos`
--
ALTER TABLE `intentos`
  ADD CONSTRAINT `intentos_alumno__fk` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`),
  ADD CONSTRAINT `intentos_operaciones_fk` FOREIGN KEY (`id_operacion`) REFERENCES `operaciones` (`id_operacion`);

--
-- Filtros para la tabla `nivel`
--
ALTER TABLE `nivel`
  ADD CONSTRAINT `nivel_alumno_id_alumno_fk` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`),
  ADD CONSTRAINT `nivel_operaciones_fk` FOREIGN KEY (`id_operacion`) REFERENCES `operaciones` (`id_operacion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
