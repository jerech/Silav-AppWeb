-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 17, 2015 at 03:45 PM
-- Server version: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `silav`
--

-- --------------------------------------------------------

--
-- Table structure for table `Agencias`
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
-- Table structure for table `AsignacionesMovil`
--

CREATE TABLE IF NOT EXISTS `AsignacionesMovil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_chofer` int(11) NOT NULL,
  `id_movil` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Choferes`
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
-- Table structure for table `ChoferesConectados`
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

-- --------------------------------------------------------

--
-- Table structure for table `Clientes`
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
-- Table structure for table `Moviles`
--

CREATE TABLE IF NOT EXISTS `Moviles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patente` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `numero` int(11) NOT NULL,
  `marca` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `modelo` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `vencseguro` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `aa` varchar(5) COLLATE latin1_spanish_ci NOT NULL,
  `gnc` varchar(2) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `patente` (`patente`,`numero`),
  UNIQUE KEY `numero` (`numero`),
  UNIQUE KEY `numero_2` (`numero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Pasajes`
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
-- Dumping data for table `Secciones`
--

REPLACE INTO `Secciones` (`id`, `nombre`, `id_seccion_padre`) VALUES
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
-- Table structure for table `Usuarios`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Usuarios`
--

REPLACE INTO `Usuarios` (`id`, `nombre`, `apellido`, `usuario`, `contrasenia`, `telefono`, `id_agencia`, `email`, `tipo`, `activo`, `direccion`, `mapa_activo`) VALUES
(1, 'jere', 'chaparro', 'jere', '845838210a77ea38b9a662d6f28fd7f3', NULL, 0, NULL, 'admin', 1, NULL, 1);

--
-- Constraints for dumped tables
--

--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-


-- --------------------------------------------------------

--
-- Constraints for dumped tables
--
--
-- Dumping data for table `Permisos`
--

--
-- Table structure for table `Permisos`
--

CREATE TABLE IF NOT EXISTS `Permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Usuarios_id` int(11) NOT NULL,
  `Secciones_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`Usuarios_id`,`Secciones_id`),
  KEY `fk_Permisos_Usuarios_idx` (`Usuarios_id`),
  KEY `fk_Permisos_Secciones1_idx` (`Secciones_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `Permisos`
--

REPLACE INTO `Permisos` (`id`, `Usuarios_id`, `Secciones_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 4),
(4, 1, 5),
(5, 1, 6),
(6, 1, 3),
(7, 1, 50);

-- --------------------------------------------------------


--
-- Table structure for table `Secciones`
--
--
-- Constraints for table `Permisos`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
