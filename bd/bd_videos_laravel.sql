-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-06-2020 a las 02:49:56
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_videos_laravel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_comentario`
--

CREATE TABLE `t_comentario` (
  `id` int(255) NOT NULL,
  `fk_id_usu` int(255) NOT NULL,
  `fk_id_vid` int(255) DEFAULT NULL,
  `texto_com` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_video`
--

CREATE TABLE `t_video` (
  `id` int(255) NOT NULL,
  `fk_id_usu` int(255) NOT NULL,
  `titulo_vid` varchar(255) DEFAULT NULL,
  `descripcion_vid` text,
  `estado_vid` varchar(20) DEFAULT NULL,
  `imagen_vid` varchar(255) DEFAULT NULL,
  `video_vid` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `t_video`
--

INSERT INTO `t_video` (`id`, `fk_id_usu`, `titulo_vid`, `descripcion_vid`, `estado_vid`, `imagen_vid`, `video_vid`, `created_at`, `updated_at`) VALUES
(3, 2, 'Video con img', 'descripcion video con imagen', NULL, '1591885429hacker.png', '15920085501. Course Introduction.mp4', '2020-06-11 14:23:49', '2020-06-13 00:35:50'),
(4, 2, 'video con img y video actualizado', 'descripcion actualizada', NULL, '1592008495Alimento-1.jpg', '15918866051. Course Introduction.mp4', '2020-06-11 14:43:25', '2020-06-13 00:34:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `rol_usu` varchar(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `imagen_usu` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `rol_usu`, `name`, `email`, `password`, `imagen_usu`, `created_at`, `updated_at`, `remember_token`) VALUES
(2, NULL, 'cristian', 'cristian@laravel.com', '$2y$10$pACNql8cmVF154sb93KOm.HvwsOkXmsXpTBXiY3pr1acQmM4HDmci', NULL, '2020-06-10 16:29:12', '2020-06-10 16:29:12', NULL),
(3, NULL, 'otro', 'otro@laravel.com', '$2y$10$te3U89DsK71rHM82LyghkuQLk9lgpBhUuCCeAiCo4zGTxDQT8QhQy', NULL, '2020-06-11 21:50:10', '2020-06-11 21:50:10', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `t_comentario`
--
ALTER TABLE `t_comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comentario_usuario` (`fk_id_usu`),
  ADD KEY `fk_comentario_video` (`fk_id_vid`);

--
-- Indices de la tabla `t_video`
--
ALTER TABLE `t_video`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_video_usuario` (`fk_id_usu`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `t_comentario`
--
ALTER TABLE `t_comentario`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `t_video`
--
ALTER TABLE `t_video`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `t_comentario`
--
ALTER TABLE `t_comentario`
  ADD CONSTRAINT `fk_comentario_usuario` FOREIGN KEY (`fk_id_usu`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comentario_video` FOREIGN KEY (`fk_id_vid`) REFERENCES `t_video` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_video`
--
ALTER TABLE `t_video`
  ADD CONSTRAINT `fk_video_usuario` FOREIGN KEY (`fk_id_usu`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
