-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 17, 2015 at 04:11 PM
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

--
-- Dumping data for table `Permisos`
--

INSERT INTO `Permisos` (`id`, `Usuarios_id`, `Secciones_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 4),
(4, 1, 5),
(5, 1, 6),
(6, 1, 3),
(7, 1, 50);

--
-- Dumping data for table `Secciones`
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

--
-- Dumping data for table `Usuarios`
--

INSERT INTO `Usuarios` (`id`, `nombre`, `apellido`, `usuario`, `contrasenia`, `telefono`, `id_agencia`, `email`, `tipo`, `activo`, `direccion`, `mapa_activo`) VALUES
(1, 'jere', 'chaparro', 'jere', '845838210a77ea38b9a662d6f28fd7f3', NULL, 0, NULL, 'admin', 1, NULL, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
