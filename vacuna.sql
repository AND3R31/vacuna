-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-08-2023 a las 00:51:47
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

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
-- Estructura de tabla para la tabla `det_vacuna`
--

CREATE TABLE `det_vacuna` (
  `id` int(11) NOT NULL,
  `id_mascota` int(11) NOT NULL,
  `id_dueño` int(11) NOT NULL,
  `id_enfermero` int(11) NOT NULL,
  `id_vacuna` int(11) NOT NULL,
  `fecha_vac` date NOT NULL,
  `exp_vac` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `det_vacuna`
--

INSERT INTO `det_vacuna` (`id`, `id_mascota`, `id_dueño`, `id_enfermero`, `id_vacuna`, `fecha_vac`, `exp_vac`) VALUES
(1, 4, 0, 11, 1, '2023-08-12', '2023-12-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermeros`
--

CREATE TABLE `enfermeros` (
  `doc_d` int(10) NOT NULL,
  `nombre_d` varchar(30) NOT NULL,
  `edad` int(2) NOT NULL,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `enfermeros`
--

INSERT INTO `enfermeros` (`doc_d`, `nombre_d`, `edad`, `rol`) VALUES
(11, 'anderson', 18, 2),
(12, 'aa', 12, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas`
--

CREATE TABLE `mascotas` (
  `doc` int(11) NOT NULL,
  `dueño` int(11) NOT NULL,
  `nom_mascota` varchar(30) NOT NULL,
  `tipo_masc` varchar(20) NOT NULL,
  `enfermero` int(11) NOT NULL,
  `vacuna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mascotas`
--

INSERT INTO `mascotas` (`doc`, `dueño`, `nom_mascota`, `tipo_masc`, `enfermero`, `vacuna`) VALUES
(4, 12, 'aaa', 'gato', 11, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'dueño'),
(2, 'enfermero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacunas`
--

CREATE TABLE `vacunas` (
  `id` int(11) NOT NULL,
  `nombre_v` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vacunas`
--

INSERT INTO `vacunas` (`id`, `nombre_v`) VALUES
(1, 'Rabia');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `det_vacuna`
--
ALTER TABLE `det_vacuna`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_enfermero` (`id_enfermero`),
  ADD KEY `det_vacuna_ibfk_3` (`id_vacuna`),
  ADD KEY `id_mascota` (`id_mascota`);

--
-- Indices de la tabla `enfermeros`
--
ALTER TABLE `enfermeros`
  ADD PRIMARY KEY (`doc_d`),
  ADD KEY `rol` (`rol`);

--
-- Indices de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD PRIMARY KEY (`doc`),
  ADD KEY `vacuna` (`vacuna`),
  ADD KEY `mascotas_ibfk_3` (`dueño`),
  ADD KEY `enfermero` (`enfermero`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vacunas`
--
ALTER TABLE `vacunas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `det_vacuna`
--
ALTER TABLE `det_vacuna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  MODIFY `doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `vacunas`
--
ALTER TABLE `vacunas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `det_vacuna`
--
ALTER TABLE `det_vacuna`
  ADD CONSTRAINT `det_vacuna_ibfk_2` FOREIGN KEY (`id_enfermero`) REFERENCES `enfermeros` (`doc_d`) ON UPDATE CASCADE,
  ADD CONSTRAINT `det_vacuna_ibfk_3` FOREIGN KEY (`id_vacuna`) REFERENCES `vacunas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `det_vacuna_ibfk_4` FOREIGN KEY (`id_mascota`) REFERENCES `mascotas` (`doc`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `enfermeros`
--
ALTER TABLE `enfermeros`
  ADD CONSTRAINT `enfermeros_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD CONSTRAINT `mascotas_ibfk_2` FOREIGN KEY (`vacuna`) REFERENCES `vacunas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `mascotas_ibfk_3` FOREIGN KEY (`dueño`) REFERENCES `enfermeros` (`doc_d`) ON UPDATE CASCADE,
  ADD CONSTRAINT `mascotas_ibfk_4` FOREIGN KEY (`enfermero`) REFERENCES `enfermeros` (`doc_d`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
