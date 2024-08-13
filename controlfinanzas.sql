-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-08-2024 a las 09:26:11
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
-- Base de datos: `controlfinanzas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `all_logs`
--

CREATE TABLE `all_logs` (
  `id_log` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `modulo` varchar(50) NOT NULL,
  `sub_modulo` varchar(50) NOT NULL,
  `accion` varchar(50) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `fecha_log` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bank`
--

CREATE TABLE `bank` (
  `id_bank` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `tipo_cuenta` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL,
  `fecha_set` varchar(30) NOT NULL,
  `fecha_upd` varchar(30) NOT NULL,
  `fecha_dlt` varchar(30) NOT NULL,
  `data_active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `income`
--

CREATE TABLE `income` (
  `id_income` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `monto` int(11) NOT NULL,
  `id_bank` int(11) NOT NULL,
  `fecha_ing` varchar(20) NOT NULL,
  `type_trans` varchar(30) NOT NULL,
  `id_user` int(11) NOT NULL,
  `fecha_set` varchar(30) NOT NULL,
  `fecha_upd` varchar(30) NOT NULL,
  `fecha_dlt` varchar(30) NOT NULL,
  `data_active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `user_create` int(11) NOT NULL,
  `fecha_set` varchar(30) NOT NULL,
  `fecha_upd` varchar(30) NOT NULL,
  `fecha_dlt` varchar(30) NOT NULL,
  `data_active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `usuario`, `nombre`, `apellido`, `pass`, `correo`, `user_create`, `fecha_set`, `fecha_upd`, `fecha_dlt`, `data_active`) VALUES
(1, 'jojeda', 'José', 'Ojeda', '5948caa5399ab1af9e9b4994caa46182', 'alexi.ahumada93@gmail.com', 1, '09-08-2024 09:00:04', '0', '0', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `all_logs`
--
ALTER TABLE `all_logs`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id_bank`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id_income`),
  ADD KEY `id_bank` (`id_bank`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `all_logs`
--
ALTER TABLE `all_logs`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bank`
--
ALTER TABLE `bank`
  MODIFY `id_bank` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `income`
--
ALTER TABLE `income`
  MODIFY `id_income` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `all_logs`
--
ALTER TABLE `all_logs`
  ADD CONSTRAINT `all_logs_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Filtros para la tabla `bank`
--
ALTER TABLE `bank`
  ADD CONSTRAINT `bank_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Filtros para la tabla `income`
--
ALTER TABLE `income`
  ADD CONSTRAINT `income_ibfk_1` FOREIGN KEY (`id_bank`) REFERENCES `bank` (`id_bank`),
  ADD CONSTRAINT `income_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
