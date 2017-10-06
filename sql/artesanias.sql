-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-10-2017 a las 01:13:59
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `artesanias`
--
CREATE DATABASE IF NOT EXISTS `artesanias` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `artesanias`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arte_catalogo`
--

CREATE TABLE `arte_catalogo` (
  `id_catalogo` int(11) NOT NULL,
  `codigo_arte` varchar(6) NOT NULL,
  `nombre_arte` varchar(60) NOT NULL,
  `descripcion_arte` varchar(100) NOT NULL,
  `precio_arte` double(6,2) NOT NULL,
  `imagen_arte` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arte_clientes`
--

CREATE TABLE `arte_clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(45) NOT NULL,
  `empresa_cliente` varchar(45) NOT NULL DEFAULT 'Default',
  `tel_cliente` varchar(45) NOT NULL,
  `celular_cliente` varchar(45) NOT NULL,
  `correo_cliente` varchar(45) NOT NULL,
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arte_tipos`
--

CREATE TABLE `arte_tipos` (
  `id_tipo` int(11) NOT NULL,
  `nombre_tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `arte_tipos`
--

INSERT INTO `arte_tipos` (`id_tipo`, `nombre_tipo`) VALUES
(1, 'Ceramica'),
(2, 'Madera'),
(3, 'Impresiones'),
(4, 'Serigrafia'),
(5, 'Grabados'),
(6, 'Textiles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arte_usuario`
--

CREATE TABLE `arte_usuario` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `password` varchar(256) NOT NULL,
  `nombre_usuario` varchar(30) NOT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `arte_usuario`
--

INSERT INTO `arte_usuario` (`id_usuario`, `usuario`, `password`, `nombre_usuario`, `fecha_creacion`) VALUES
(7, 'admin', '$2y$10$MqSl37tSxoGXjviGM2IG1u0bJcTQOu6RWXXNt2O7J0htePC/DvC8y', 'Administrador', '2017-10-02');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `arte_catalogo`
--
ALTER TABLE `arte_catalogo`
  ADD PRIMARY KEY (`id_catalogo`);

--
-- Indices de la tabla `arte_clientes`
--
ALTER TABLE `arte_clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `arte_tipos`
--
ALTER TABLE `arte_tipos`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `arte_usuario`
--
ALTER TABLE `arte_usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `arte_catalogo`
--
ALTER TABLE `arte_catalogo`
  MODIFY `id_catalogo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `arte_clientes`
--
ALTER TABLE `arte_clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `arte_tipos`
--
ALTER TABLE `arte_tipos`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `arte_usuario`
--
ALTER TABLE `arte_usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
