-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-12-2023 a las 00:46:51
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
-- Base de datos: `prendapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(11) NOT NULL,
  `id_venta` int(11) DEFAULT NULL,
  `fechaCreacion` date DEFAULT NULL,
  `totalCompra` int(11) DEFAULT NULL,
  `cantidadProductos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id_factura`, `id_venta`, `fechaCreacion`, `totalCompra`, `cantidadProductos`) VALUES
(4, 6, '2023-11-30', 150000, 3),
(7, 16, '2023-12-02', 200000, 1),
(8, 17, '2023-12-02', 200000, 1),
(9, 18, '2023-12-02', 200000, 1),
(10, 19, '2023-12-03', 45000, 1),
(11, 20, '2023-12-03', 45000, 1),
(12, 21, '2023-12-03', 130000, 1),
(13, 22, '2023-12-03', 130000, 1),
(14, 23, '2023-12-03', 130000, 1),
(15, 24, '2023-12-03', 130000, 1),
(16, 25, '2023-12-03', 130000, 1),
(17, 27, '2023-12-03', 54000, 1),
(18, 28, '2023-12-03', 45000, 1),
(19, 29, '2023-12-03', 45000, 1),
(20, 30, '2023-12-04', 130000, 1),
(21, 31, '2023-12-04', 130000, 1),
(22, 32, '2023-12-04', 130000, 1),
(23, 33, '2023-12-04', 400000, 2),
(24, 34, '2023-12-04', 200000, 1),
(25, 35, '2023-12-04', 200000, 1),
(26, 36, '2023-12-04', 200000, 1),
(27, 37, '2023-12-05', 108000, 2),
(28, 38, '2023-12-06', 130000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fechaCreacion` date DEFAULT NULL,
  `fechaActualizacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_inventario`, `id_producto`, `cantidad`, `fechaCreacion`, `fechaActualizacion`) VALUES
(4, 1, 0, '2023-11-30', '2023-12-03'),
(8, 8, 2, '2023-12-01', '2023-12-04'),
(10, 9, 1, '2023-12-01', '2023-12-06'),
(13, 10, 0, '2023-12-01', '2023-12-04'),
(14, 11, 1, '2023-12-01', '2023-12-04'),
(16, 15, 4, '2023-12-02', '2023-12-05'),
(17, 18, 2, '2023-12-04', '2023-12-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `cedula` varchar(12) DEFAULT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `clima` varchar(30) DEFAULT NULL,
  `genero` varchar(30) DEFAULT NULL,
  `talla` varchar(10) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `url_imagen` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `cedula`, `nombre`, `precio`, `clima`, `genero`, `talla`, `color`, `url_imagen`) VALUES
(1, '1234321123', 'chaqueta aqua', 45000, 'Frio', 'Masculino', 'M', 'azul', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR1yWuv9UNqVgCCSK0tXernDtMcRt5OvGERHQ&usqp=CAU'),
(8, '1236548765', 'chaqueta colombiana', 30000, 'Calido', 'Masculino', 'S', 'verde', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRkY5UIiXIBKgpt7dvZT0hSGsem09MJY08NjA&usqp=CAU'),
(9, '1236548765', 'chaqueta aqua 2', 130000, 'Calido', 'Masculino', 'L', 'Amarillo', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT3dVg-Cz3NdvU5sdWV8sPswT9wqJCYBt_KiQGe9DFontOwoEs18R10NpQkrhzMylo3ZvQ&usqp=CAU'),
(10, '1236548765', 'chaqueta escarla', 200000, 'Templado', 'Femenino', 'L', 'rojo', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQuIkW6g7JLLCxBwOu38lXLyXZDpDY48gbPpc9rEXd4BJI4zdLq-w7EJTvGFw-qKLiMNqs&usqp=CAU'),
(11, '1236548765', 'chaqueta bomber', 200000, 'Templado', 'Masculino', 'L', 'negro con rojo', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLuc4QmeST4iLit4epQMVRNEeGovPqYIRe6Q&usqp=CAU'),
(15, '1236548765', 'chaqueta aqua', 54000, 'Calido', 'Masculino', 'XL', 'verde', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDoOT2bUQz16syok2uJAK1T-_vPC49HW2G-g&usqp=CAU'),
(18, '1236548765', 'chaqueta cuero cospi', 200000, 'Templado', 'Masculino', 'XL', 'negro ', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTkT_6yTTNQUyg5e79Q1TMqhdFs6qRpnAXPyg&usqp=CAU');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `cedula` varchar(12) NOT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `fechaCreacion` date DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `correo` varchar(80) DEFAULT NULL,
  `direccion` varchar(60) DEFAULT NULL,
  `ciudad` varchar(20) DEFAULT NULL,
  `username` varchar(70) DEFAULT NULL,
  `password` varchar(70) DEFAULT NULL,
  `rol` varchar(15) DEFAULT 'CLIENTE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`cedula`, `nombre`, `fechaCreacion`, `edad`, `telefono`, `correo`, `direccion`, `ciudad`, `username`, `password`, `rol`) VALUES
('1030542717', 'Juan Pablo ', '2023-11-30', 20, '3125769017', 'bvjuanpablo@gmail.com', 'Cra 87 Bosa ', 'Bogota', 'juanpablo17', '1234567', 'ADMINISTRADOR'),
('1234321123', 'camilo  santiago', '2023-11-29', 23, '3211234512', 'camilo29@gmail.com', 'CRA 99', 'Cartagena', 'camilo22', '123', 'VENDEDOR'),
('1234567890', 'juan buitrago', '2023-12-02', NULL, '7849265423', 'camilo29@gmail.com', 'CRA 99', 'Bogota', 'hola', '12345', 'CLIENTE'),
('1234567891', 'Juan Pablo', '2023-11-29', NULL, '3124157826', 'juan78@gmail.com', 'Cra 87 ·50', 'Bogota', 'juanpablo', '1234567', 'CLIENTE'),
('1234567898', 'juan buitrago', '2023-12-02', NULL, '7831950345', 'jhon@gmail.com', 'Cra 30', 'cartagena', '1030542779', '123456', 'CLIENTE'),
('1236548765', 'david buitrago', '2023-12-01', 63, '3214526789', 'david@gmail.com', 'Cra 90', 'Bogota', 'david17', '12345', 'VENDEDOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `cedula` varchar(12) DEFAULT NULL,
  `id_inventario` int(11) DEFAULT NULL,
  `fechaCreacion` date DEFAULT NULL,
  `cantidadProductos` int(11) DEFAULT NULL,
  `total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `cedula`, `id_inventario`, `fechaCreacion`, `cantidadProductos`, `total`) VALUES
(6, '1234567891', 4, '2023-11-30', 4, 80000),
(8, '1236548765', 10, '2023-12-02', 3, 390000),
(9, '1236548765', 10, '2023-12-02', 2, 260000),
(12, '1236548765', 13, '2023-12-02', 2, 400000),
(13, '1236548765', 8, '2023-12-02', 2, 60000),
(14, '1236548765', 8, '2023-12-02', 2, 60000),
(15, '1236548765', 4, '2023-12-02', 3, 135000),
(16, '1236548765', 14, '2023-12-02', 1, 200000),
(17, '1236548765', 14, '2023-12-02', 1, 200000),
(18, '1236548765', 14, '2023-12-02', 1, 200000),
(19, '1236548765', 4, '2023-12-03', 1, 45000),
(20, '1236548765', 4, '2023-12-03', 1, 45000),
(21, '1236548765', 10, '2023-12-03', 1, 130000),
(22, '1236548765', 10, '2023-12-03', 1, 130000),
(23, '1236548765', 10, '2023-12-03', 1, 130000),
(24, '1236548765', 10, '2023-12-03', 1, 130000),
(25, '1236548765', 10, '2023-12-03', 1, 130000),
(27, '1236548765', 16, '2023-12-03', 1, 54000),
(28, '1236548765', 4, '2023-12-03', 1, 45000),
(29, '1236548765', 4, '2023-12-03', 1, 45000),
(30, '1236548765', 10, '2023-12-04', 1, 130000),
(31, '1236548765', 10, '2023-12-04', 1, 130000),
(32, '1236548765', 10, '2023-12-04', 1, 130000),
(33, '1236548765', 17, '2023-12-04', 2, 400000),
(34, '1236548765', 17, '2023-12-04', 1, 200000),
(35, '1236548765', 13, '2023-12-04', 1, 200000),
(36, '1236548765', 14, '2023-12-04', 1, 200000),
(37, '1236548765', 16, '2023-12-05', 2, 108000),
(38, '1236548765', 10, '2023-12-06', 1, 130000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `id_venta` (`id_venta`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `cedula` (`cedula`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `id_inventario` (`id_inventario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`);

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `id_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `usuario` (`cedula`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `usuario` (`cedula`),
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`id_inventario`) REFERENCES `inventario` (`id_inventario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
