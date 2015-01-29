-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-01-2015 a las 18:11:09
-- Versión del servidor: 5.5.40-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `silav`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Agencias`
--

CREATE TABLE IF NOT EXISTS `Agencias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `direccion` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE latin1_spanish_ci DEFAULT NULL,
  `email` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AsignacionesMovil`
--

CREATE TABLE IF NOT EXISTS `AsignacionesMovil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_chofer` int(11) NOT NULL,
  `id_movil` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Choferes`
--

CREATE TABLE IF NOT EXISTS `Choferes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(12) COLLATE latin1_spanish_ci NOT NULL,
  `apellido` varchar(12) COLLATE latin1_spanish_ci NOT NULL,
  `usuario` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `contrasenia` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `numero_telefono` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `venc_licencia` varchar(12) COLLATE latin1_spanish_ci NOT NULL,
  `habilitado` varchar(2) COLLATE latin1_spanish_ci NOT NULL,
  `sexo` varchar(6) COLLATE latin1_spanish_ci NOT NULL,
  `id_agencia` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ChoferesConectados`
--

CREATE TABLE IF NOT EXISTS `ChoferesConectados` (
  `usuario` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `numero_movil` int(11) NOT NULL,
  `ubicacion_lat` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `ubicacion_lon` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `estado_movil` varchar(20) COLLATE latin1_spanish_ci DEFAULT NULL,
  `sos` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`usuario`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `ChoferesConectados`
--

INSERT INTO `ChoferesConectados` (`usuario`, `numero_movil`, `ubicacion_lat`, `ubicacion_lon`, `estado_movil`, `sos`) VALUES
('juan', 1, '-31.430', '-62.084', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Clientes`
--

CREATE TABLE IF NOT EXISTS `Clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  `apellido` varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,
  `usuario` varchar(20) COLLATE latin1_spanish_ci DEFAULT NULL,
  `contrasenia` varchar(20) COLLATE latin1_spanish_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Moviles`
--

CREATE TABLE IF NOT EXISTS `Moviles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patente` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `numero` int(11) NOT NULL,
  `marca` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `modelo` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `vencseguro` varchar(20) COLLATE latin1_spanish_ci DEFAULT NULL,
  `aa` tinyint(1) NOT NULL,
  `gnc` tinyint(1) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `patente` (`patente`,`numero`),
  UNIQUE KEY `numero` (`numero`),
  UNIQUE KEY `numero_2` (`numero`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `Moviles`
--

INSERT INTO `Moviles` (`id`, `patente`, `numero`, `marca`, `modelo`, `vencseguro`, `aa`, `gnc`, `activo`) VALUES
(1, 'ABC123', 15, 'Ford', 'Focus', '12/11/16', 1, 0, 1),
(4, 'JKL 990', 89, 'Ford', 'Fiesta', '', 1, 1, 1),
(5, 'fff 111', 33, 'Fiat', 'Palio', '2/2/2', 1, 0, 0),
(6, 'TTT 333', 54, 'Chevrolet', 'Astra', '', 1, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pasajes`
--

CREATE TABLE IF NOT EXISTS `Pasajes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ubicacion_lat` double NOT NULL,
  `ubicacion_lon` double NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `numero_movil` int(11) NOT NULL,
  `usuario_chofer` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Permisos`
--

CREATE TABLE IF NOT EXISTS `Permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Usuarios_id` int(11) NOT NULL,
  `Secciones_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`Usuarios_id`,`Secciones_id`),
  KEY `fk_Permisos_Usuarios_idx` (`Usuarios_id`),
  KEY `fk_Permisos_Secciones1_idx` (`Secciones_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=37 ;

--
-- Volcado de datos para la tabla `Permisos`
--

INSERT INTO `Permisos` (`id`, `Usuarios_id`, `Secciones_id`) VALUES
(25, 1, 1),
(26, 1, 2),
(27, 1, 50),
(28, 1, 51),
(29, 1, 52),
(30, 1, 3),
(31, 1, 4),
(32, 1, 56),
(33, 1, 57),
(34, 1, 58),
(35, 1, 5),
(36, 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Secciones`
--

CREATE TABLE IF NOT EXISTS `Secciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `id_seccion_padre` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=62 ;

--
-- Volcado de datos para la tabla `Secciones`
--

INSERT INTO `Secciones` (`id`, `nombre`, `id_seccion_padre`) VALUES
(1, 'Inicio', NULL),
(2, 'Administradores', NULL),
(3, 'Operadores', NULL),
(4, 'Moviles', NULL),
(5, 'Choferes', NULL),
(6, 'Geolocalizacion', NULL),
(50, 'NuevoAdministrador', 2),
(51, 'VerAdministradores', 2),
(52, 'ModificarAdministrador', 2),
(53, 'NuevoOperador', 3),
(54, 'VerOperadores', 3),
(55, 'ModificarOperador', 3),
(56, 'NuevoMovil', 4),
(57, 'VerMoviles', 4),
(58, 'ModificarMovil', 4),
(59, 'NuevoChofer', 5),
(60, 'VerChoferes', 5),
(61, 'ModificarChofer', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE IF NOT EXISTS `Usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contrasenia` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_agencia` int(11) NOT NULL,
  `email` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `tipo` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `direccion` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `mapa_activo` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`id`, `nombre`, `apellido`, `usuario`, `contrasenia`, `telefono`, `id_agencia`, `email`, `tipo`, `activo`, `direccion`, `mapa_activo`) VALUES
(1, 'jere', 'chaparro', 'jere', '845838210a77ea38b9a662d6f28fd7f3', '', 0, '', 'admin', 1, '', 0);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Permisos`
--
ALTER TABLE `Permisos`
  ADD CONSTRAINT `fk_Permisos_Secciones1` FOREIGN KEY (`Secciones_id`) REFERENCES `Secciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Permisos_Usuarios` FOREIGN KEY (`Usuarios_id`) REFERENCES `Usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
