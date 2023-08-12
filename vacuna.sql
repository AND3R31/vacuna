-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-08-2023 a las 18:37:59
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vacuna`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermeros`
--

CREATE TABLE `enfermeros` (
  `doc` int(10) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `edad` int(2) NOT NULL,
  `vacuna` varchar(30) NOT NULL,
  `tip_mascota` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `enfermeros`
--

INSERT INTO `enfermeros` (`doc`, `nombre`, `edad`, `vacuna`, `tip_mascota`) VALUES
(1, 'aa', 12, 'rabia', 'gato'),
(2, 'laura', 18, 'Pentavalente', 'perro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas`
--

CREATE TABLE `mascotas` (
  `doc` int(10) NOT NULL,
  `dueño` varchar(30) NOT NULL,
  `edad` int(2) NOT NULL,
  `nom_mascota` varchar(30) NOT NULL,
  `tipo_masc` varchar(20) NOT NULL,
  `enfermero` varchar(30) NOT NULL,
  `vacuna` varchar(30) NOT NULL,
  `fecha_vac` date NOT NULL,
  `exp_vac` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mascotas`
--

INSERT INTO `mascotas` (`doc`, `dueño`, `edad`, `nom_mascota`, `tipo_masc`, `enfermero`, `vacuna`, `fecha_vac`, `exp_vac`) VALUES
(1, 'aa', 12, 'tigre', 'gato', 'laura', 'rabia', '2023-08-12', '2023-12-11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `enfermeros`
--
ALTER TABLE `enfermeros`
  ADD PRIMARY KEY (`doc`);

--
-- Indices de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD PRIMARY KEY (`doc`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
