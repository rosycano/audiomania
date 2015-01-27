-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-01-2015 a las 06:40:39
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `audiomania`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracteres`
--

CREATE TABLE IF NOT EXISTS `caracteres` (
`id` int(11) NOT NULL,
  `codigo` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `caracter` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Volcado de datos para la tabla `caracteres`
--

INSERT INTO `caracteres` (`id`, `codigo`, `caracter`) VALUES
(1, 'NAT', 'Natural'),
(2, 'FAR', 'Fársico'),
(3, 'AMA', 'Comercial Fresco'),
(4, 'INS', 'Institucional'),
(5, 'DOC', 'Documental'),
(6, 'DOB', 'de Doblaje'),
(7, 'HSE', 'Hard Sell'),
(8, 'HTE', 'Hold Telefónico'),
(9, 'NOR', 'Norteño'),
(10, 'PER', 'de Personaje');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `demos`
--

CREATE TABLE IF NOT EXISTS `demos` (
`id` int(11) NOT NULL,
  `id_locutor` int(11) NOT NULL,
  `codigo` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `ubicacion_archivo` varchar(130) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Volcado de datos para la tabla `demos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locutores`
--

CREATE TABLE IF NOT EXISTS `locutores` (
`id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `genero` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `bio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Volcado de datos para la tabla `locutores`
--

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caracteres`
--
ALTER TABLE `caracteres`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `demos`
--
ALTER TABLE `demos`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `locutores`
--
ALTER TABLE `locutores`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caracteres`
--
ALTER TABLE `caracteres`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT de la tabla `demos`
--
ALTER TABLE `demos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT de la tabla `locutores`
--
ALTER TABLE `locutores`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
