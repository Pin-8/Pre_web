-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-05-2022 a las 23:56:06
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `id_padre` int(11) NOT NULL,
  `orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `id_padre`, `orden`) VALUES
(1, 'Categoría de Prueba', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `id` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_actualizacion` datetime NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `path` varchar(255) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacion_web`
--

CREATE TABLE `informacion_web` (
  `id` int(11) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `latitud` decimal(10,2) NOT NULL,
  `longitud` decimal(10,2) NOT NULL,
  `texto_footer` text NOT NULL,
  `direccion_uno` varchar(255) NOT NULL,
  `direccion_dos` varchar(255) NOT NULL,
  `telefono_uno` varchar(255) NOT NULL,
  `telefono_dos` varchar(255) NOT NULL,
  `horario_uno` varchar(255) NOT NULL,
  `horario_dos` varchar(255) NOT NULL,
  `imagen_qr` varchar(255) NOT NULL,
  `imagen_data_fiscal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `informacion_web`
--

INSERT INTO `informacion_web` (`id`, `facebook`, `instagram`, `linkedin`, `twitter`, `youtube`, `latitud`, `longitud`, `texto_footer`, `direccion_uno`, `direccion_dos`, `telefono_uno`, `telefono_dos`, `horario_uno`, `horario_dos`, `imagen_qr`, `imagen_data_fiscal`) VALUES
(1, 'facebook.com', 'instagram.com', 'linkedin.coom', 'twitter.com', 'youtube.com', '0.00', '0.00', '7', '1', '2', '3', '4', '5', '6', '', ''),
(3, '', '', '', '', '', '0.00', '0.00', '', '', '', '', '', '', '', '', ''),
(4, '', '', '', '', '', '0.00', '0.00', '', '', '', '', '', '', '', '', ''),
(5, '', '', '', '', '', '0.00', '0.00', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_panel`
--

CREATE TABLE `usuarios_panel` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `icono` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios_panel`
--

INSERT INTO `usuarios_panel` (`id`, `nombre_usuario`, `email`, `password`, `id_perfil`, `icono`) VALUES
(1, 'matias_schettino', 'matuschettino@gmail.com', '202cb962ac59075b964b07152d234b70', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_web`
--

CREATE TABLE `usuarios_web` (
  `id` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `nombre_usuario` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `localidad` varchar(255) NOT NULL,
  `fecha_nac` date NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `fecha_ultima_act` datetime NOT NULL,
  `idiomas` varchar(255) NOT NULL,
  `foto_perfil` varchar(255) NOT NULL,
  `foto_portada` varchar(255) NOT NULL,
  `dni` varchar(255) NOT NULL,
  `cuit` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `descripcion_dos` text NOT NULL,
  `interprete` tinyint(1) NOT NULL,
  `curriculum` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios_web`
--

INSERT INTO `usuarios_web` (`id`, `estado`, `nombre_usuario`, `email`, `password`, `nombre`, `apellido`, `telefono`, `direccion`, `localidad`, `fecha_nac`, `fecha_registro`, `fecha_ultima_act`, `idiomas`, `foto_perfil`, `foto_portada`, `dni`, `cuit`, `descripcion`, `descripcion_dos`, `interprete`, `curriculum`) VALUES
(1, 2, 'Matias_Schettino_123', 'matuschettino@gmail.com2', 'c4ca4238a0b923820dcc509a6f75849b', 'Matias22', 'Schettinooooss2', '2352 555792', 'Carlos pellegrini 200', 'Chacabuco2', '2022-05-26', '2022-05-08 00:00:00', '2022-05-13 04:12:37', 'Alemán, Italiano, Portugués, ', 'uploads/usuarios_web/A.png', 'uploads/usuarios_web/jaden3.gif', '42490287', '', '123 123123', '1231123', 1, 'uploads/usuarios_web/pasajes.pdf'),
(2, 1, 'Eli_centurion_11', 'elicenturion@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'Elias', 'Centurion', '', '', '', '0000-00-00', '2022-05-13 01:26:37', '2022-05-13 01:26:37', '', '', '', '', '', '', '', 0, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `informacion_web`
--
ALTER TABLE `informacion_web`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_panel`
--
ALTER TABLE `usuarios_panel`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_web`
--
ALTER TABLE `usuarios_web`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `informacion_web`
--
ALTER TABLE `informacion_web`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios_panel`
--
ALTER TABLE `usuarios_panel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios_web`
--
ALTER TABLE `usuarios_web`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
