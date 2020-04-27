-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-04-2020 a las 17:04:09
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sis_ventas_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(155) NOT NULL,
  `ci` varchar(155) NOT NULL,
  `ci_exp` varchar(155) NOT NULL,
  `cel` varchar(155) NOT NULL,
  `estado` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `ci`, `ci_exp`, `cel`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'JUAN ALVARES', '48965126', 'LP', '68412345', 1, '2020-04-14 04:00:00', '2020-04-15 04:28:15'),
(2, 'JORGE FLORES', '65432178', 'LP', '78945612', 1, '2020-04-15 03:24:00', '2020-04-15 04:27:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuentos`
--

CREATE TABLE `descuentos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descuento` double(8,2) NOT NULL,
  `descripcion` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `descuentos`
--

INSERT INTO `descuentos` (`id`, `nom`, `descuento`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'SIN DESCUENTO', 0.00, 'NO SE REALIZA NINGÚN DESCUENTO SOBRE EL PRODUCTO', '2020-04-03 17:35:28', '2020-04-03 17:35:28'),
(2, 'DESCUENTO MENOR', 5.00, 'DESCUENTO DEL 5% TOTAL DEL TOTAL DE PRODUCTOS ADQUIRIDOS', '2020-04-03 17:35:35', '2020-04-03 17:35:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `venta_id` bigint(20) UNSIGNED NOT NULL,
  `producto_id` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `costo` decimal(24,2) NOT NULL,
  `descuento_id` bigint(20) UNSIGNED NOT NULL,
  `total` decimal(24,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id`, `venta_id`, `producto_id`, `cantidad`, `costo`, `descuento_id`, `total`, `created_at`, `updated_at`) VALUES
(3, 3, 1, 1, '12.50', 1, '12.50', '2020-04-03 17:56:21', '2020-04-03 17:56:21'),
(6, 6, 1, 5, '12.50', 2, '59.38', '2020-04-06 19:24:08', '2020-04-06 19:24:08'),
(12, 12, 2, 10, '20.00', 1, '200.00', '2020-04-06 20:39:11', '2020-04-06 20:39:11'),
(13, 13, 2, 1, '20.00', 1, '20.00', '2020-04-15 04:24:51', '2020-04-15 04:24:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paterno` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `materno` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci_exp` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cel` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fono` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `paterno`, `materno`, `ci`, `ci_exp`, `dir`, `cel`, `fono`, `foto`, `correo`, `rol`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'JORGE', 'ALCANTARA', '', '12345678', 'LP', 'DIRECCIÓN', '78945612', '', 'user_default.png', 'jorge@gmail.com', 'ROL', 2, '2020-04-03 17:34:24', '2020-04-03 17:34:24'),
(2, 'JAIME', 'CASTRO', '', '87654321', 'LP', 'DIRECCIÓN', '68412345', '', 'user_default.png', 'jaime@hotmail.com', 'ROL', 3, '2020-04-03 17:35:02', '2020-04-03 17:35:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cod` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nit` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nro_aut` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nro_emp` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pais` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dpto` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ciudad` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zona` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calle` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nro` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fono` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cel` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `casilla` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actividad_eco` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `cod`, `nit`, `nro_aut`, `nro_emp`, `name`, `alias`, `pais`, `dpto`, `ciudad`, `zona`, `calle`, `nro`, `email`, `fono`, `cel`, `fax`, `casilla`, `web`, `logo`, `actividad_eco`, `created_at`, `updated_at`) VALUES
(1, 'EMP01', '1231564564', '2315674898', '6666544555', 'SAN MIGUEL', 'E.P.', 'BOLIVIA', 'LA PAZ', 'LA PAZ', 'LOS OLIVOS', 'LOS HEROES', '233', 'correosyseventos@gmail.com', '2316489', '68465315', '', '', '', 'Logo.jpg', 'CON FINES DE LUCRO', '2020-04-03 17:34:20', '2020-04-03 17:34:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_04_08_150906_create_empresas_table', 1),
(4, '2020_03_31_100532_create_empleados_table', 1),
(5, '2020_03_31_100608_create_ventas_table', 1),
(6, '2020_03_31_100619_create_productos_table', 1),
(7, '2020_03_31_100631_create_descuentos_table', 1),
(8, '2020_03_31_100646_create_promocions_table', 1),
(9, '2020_03_31_101301_create_detalle_ventas_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `costo` decimal(24,2) NOT NULL,
  `disponible` int(11) NOT NULL,
  `ingresos` int(11) NOT NULL,
  `salidas` int(11) NOT NULL,
  `descripcion` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nom`, `costo`, `disponible`, `ingresos`, `salidas`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'PRODUCTO 1', '12.50', 4, 10, 6, '', '2020-04-03 17:35:12', '2020-04-06 19:24:08'),
(2, 'PRODUCTO 2', '20.00', 9, 20, 11, '', '2020-04-03 17:35:21', '2020-04-15 04:24:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `producto_id` bigint(20) UNSIGNED NOT NULL,
  `descuento_id` bigint(20) UNSIGNED NOT NULL,
  `inicio` int(11) NOT NULL,
  `fin` int(11) DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`id`, `nom`, `producto_id`, `descuento_id`, `inicio`, `fin`, `fecha_inicio`, `fecha_fin`, `created_at`, `updated_at`) VALUES
(6, 'PROMOCION 1', 1, 2, 4, NULL, '2020-04-06', '2020-04-30', '2020-04-06 18:58:14', '2020-04-06 19:14:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `motivo` varchar(155) NOT NULL,
  `estado` varchar(155) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`id`, `user_id`, `motivo`, `estado`, `created_at`, `updated_at`) VALUES
(3, 2, 'RAZON MOTIVO', 'ENVIADO', '2020-04-15 14:12:31', '2020-04-15 15:02:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` enum('ADMINISTRADOR','EMPLEADO') COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `tipo`, `foto`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$Fqakg8C1asGMOhh65S1BouI1HO14S5zgRdwVEv2Bax.i3Hhcw.CCW', 'ADMINISTRADOR', 'user_default.png\r\n', 1, '2020-04-03 17:34:20', '2020-04-15 03:59:30'),
(2, 'JALCANTARA', '$2y$10$5tX7XgcVf8n.K2D792aUrOVw8F69QOa2Af/XVHJpoXqhDNwfXmj4e', 'ADMINISTRADOR', 'user_default.png', 1, '2020-04-03 17:34:24', '2020-04-15 15:02:23'),
(3, 'JCASTRO', '$2y$10$uNlNF5w9/Y8tn2d0jGYC3.bOJ6GuFfJXsIx2fXrfQFZ320L0kHOp6', 'EMPLEADO', 'user_default.png', 1, '2020-04-03 17:35:02', '2020-04-03 17:35:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `cliente_id` bigint(20) UNSIGNED NOT NULL,
  `nit` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_venta` date NOT NULL,
  `nro_factura` bigint(20) NOT NULL,
  `total` decimal(24,2) NOT NULL,
  `total_final` decimal(24,2) NOT NULL,
  `qr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo_control` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `user_id`, `cliente_id`, `nit`, `fecha_venta`, `nro_factura`, `total`, `total_final`, `qr`, `codigo_control`, `created_at`, `updated_at`) VALUES
(3, 1, 1, '45612345', '2020-04-03', 10001, '12.50', '12.50', 'QR_456123451585936581.png', 'B6-A2-A2-AC-A9', '2020-04-03 17:56:21', '2020-04-03 17:56:21'),
(6, 1, 1, '55555', '2020-04-06', 10002, '59.38', '59.38', 'QR_555551586201048.png', 'DE-9E-75-73-76', '2020-04-06 19:24:08', '2020-04-06 19:24:08'),
(12, 1, 1, '66666', '2020-04-06', 10003, '200.00', '200.00', 'QR_666661586205551.png', '42-FD-54-FC-CB', '2020-04-06 20:39:11', '2020-04-06 20:39:11'),
(13, 1, 1, '48965126', '2020-04-15', 10004, '20.00', '20.00', 'QR_489651261586924691.png', '1C-39-FB-9F-D8', '2020-04-15 04:24:51', '2020-04-15 04:24:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_promociones`
--

CREATE TABLE `venta_promociones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `venta_id` bigint(20) UNSIGNED NOT NULL,
  `promocion_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `venta_promociones`
--

INSERT INTO `venta_promociones` (`id`, `venta_id`, `promocion_id`, `created_at`, `updated_at`) VALUES
(1, 6, 6, '2020-04-06 19:24:08', '2020-04-06 19:24:08');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_ventas_venta_id_foreign` (`venta_id`),
  ADD KEY `detalle_ventas_producto_id_foreign` (`producto_id`),
  ADD KEY `detalle_ventas_descuento_id_foreign` (`descuento_id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empleados_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `descuento_id` (`descuento_id`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ventas_user_id_foreign` (`user_id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indices de la tabla `venta_promociones`
--
ALTER TABLE `venta_promociones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venta_id` (`venta_id`),
  ADD KEY `promocion_id` (`promocion_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `venta_promociones`
--
ALTER TABLE `venta_promociones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD CONSTRAINT `detalle_ventas_descuento_id_foreign` FOREIGN KEY (`descuento_id`) REFERENCES `descuentos` (`id`),
  ADD CONSTRAINT `detalle_ventas_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `detalle_ventas_venta_id_foreign` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD CONSTRAINT `promociones_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `promociones_ibfk_2` FOREIGN KEY (`descuento_id`) REFERENCES `descuentos` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitudes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `ventas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `venta_promociones`
--
ALTER TABLE `venta_promociones`
  ADD CONSTRAINT `venta_promociones_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_promociones_ibfk_2` FOREIGN KEY (`promocion_id`) REFERENCES `promociones` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
