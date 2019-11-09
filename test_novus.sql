-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 09-11-2019 a las 03:09:16
-- Versión del servidor: 5.6.45-86.1
-- Versión de PHP: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `test_novus`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigos`
--

CREATE TABLE `amigos` (
  `id` int(11) NOT NULL,
  `persona1` int(11) NOT NULL,
  `persona2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `amigos`
--

INSERT INTO `amigos` (`id`, `persona1`, `persona2`) VALUES
(11, 1, 7),
(4, 1, 9),
(16, 2, 7),
(19, 2, 8),
(3, 2, 9),
(13, 3, 7),
(9, 3, 10),
(12, 4, 7),
(7, 5, 7),
(5, 5, 8),
(6, 5, 11),
(17, 6, 7),
(20, 7, 8),
(18, 7, 9),
(10, 7, 10),
(15, 7, 11),
(8, 10, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `tipo_documento` varchar(2) NOT NULL,
  `numero_documento` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombre`, `tipo_documento`, `numero_documento`) VALUES
(1, 'Christian Caballero', 'CC', '80038263'),
(2, 'Andrés López', 'TI', '12345678'),
(3, 'María Carreño', 'CC', '98765432'),
(4, 'Amanda López', 'RC', '65654654'),
(5, 'Carlos Camacho', 'CC', '41526352'),
(6, 'Raúl Ponce', 'RC', '12345789'),
(7, 'Carlos Vives', 'CE', '656544545'),
(8, 'Marco Antonio Solis', 'CE', '987989887'),
(9, 'Rafael Orozco', 'CE', '12345632'),
(10, 'Miguel Bosé', 'RC', '15975386'),
(11, 'Marc Anthony', 'RC', '45612345');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `amigos`
--
ALTER TABLE `amigos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `amistad` (`persona1`,`persona2`) USING BTREE;

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `amigos`
--
ALTER TABLE `amigos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
