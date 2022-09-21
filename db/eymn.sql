-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-09-2022 a las 20:25:48
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `eymn`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `ID_Cargo` int(11) NOT NULL,
  `Descripción` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`ID_Cargo`, `Descripción`) VALUES
(1, 'Administrador'),
(2, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `ID_Compra` int(11) NOT NULL,
  `ID_Transaccion` varchar(20) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Status` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `ID_Cliente` varchar(20) NOT NULL,
  `Total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`ID_Compra`, `ID_Transaccion`, `Fecha`, `Status`, `Email`, `ID_Cliente`, `Total`) VALUES
(1, '6GS860985P2479603', '2022-09-06 04:35:35', 'COMPLETED', 'sb-j7t9a19990089@personal.example.com', '5RRLNUG938EA2', '129000.00'),
(2, '4DR990180J882535P', '2022-09-06 04:36:19', 'COMPLETED', 'sb-j7t9a19990089@personal.example.com', '5RRLNUG938EA2', '576000.00'),
(3, '5UR92929XA546035T', '2022-09-06 04:51:49', 'COMPLETED', 'sb-j7t9a19990089@personal.example.com', '5RRLNUG938EA2', '576000.00'),
(4, '1B146299PC942661W', '2022-09-06 04:56:05', 'COMPLETED', 'sb-j7t9a19990089@personal.example.com', '5RRLNUG938EA2', '403000.00'),
(5, '41E99877LC6558151', '2022-09-06 04:58:38', 'COMPLETED', 'sb-j7t9a19990089@personal.example.com', '5RRLNUG938EA2', '403000.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `ID_F` int(11) NOT NULL,
  `ID_Venta` varchar(20) NOT NULL,
  `ID_Pr` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `ID_P` int(11) NOT NULL,
  `Nombre_Real` varchar(100) NOT NULL,
  `Edad` date NOT NULL,
  `Correo_electrónico` varchar(50) NOT NULL,
  `Telefono` varchar(50) NOT NULL,
  `Nombre_Usuario` varchar(100) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Clave` varchar(100) NOT NULL,
  `ID_Cargo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`ID_P`, `Nombre_Real`, `Edad`, `Correo_electrónico`, `Telefono`, `Nombre_Usuario`, `Direccion`, `Clave`, `ID_Cargo`) VALUES
(1, 'Administrador EYMN', '2004-01-01', 'admineymn@eymn.com', '300 1234567', 'ADMINEYMN', 'Cra 100 # 76B SUR', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', 1),
(5, 'Luis Miguel Gómez Viloria', '2004-04-21', 'lokus@eymn.com', '301 5088537', 'LokusAdmin', 'Cra 100#50 B 45 SUR', '39a688c46126918b13d9aa3c6d776530', 1),
(6, 'Santiago Castiblanco Gallego', '2004-07-15', 'Fenixvalo@gmail.com', '321 9401931', 'Lord Fenix', 'Cra 100#50 B 45 SUR', 'fabb23a34b6618d823b5bee1dc22a19b', 2),
(7, 'Kevin David Beltran Florez', '2004-07-11', 'KevinBel@gmail.com', '301 6394788', 'KEVIIIN', 'Cra 96 #40B35 Sur', 'ddcc77b15e9ff9a3c2a6f60344df9062', 2),
(8, 'Miguel Angel Rivera Florez', '2004-04-22', 'miguelariveraf@gmail.com', '320 3455399', 'Miguel Rivera', 'Cra 58#36B Sur', '031c9ebada12656c9b36059ab395635a', 2),
(16, 'Heyder Gomez Viloria', '1996-03-23', 'gomezheyder@gmail.com', '310 2638034', 'Xtractor-Souls', 'Cra 100#50B45Sur', '45f25cb0b93a55fc143ec667ef760d45', 2),
(17, 'Daniel Felipe Loaiza', '2000-01-01', 'danielfl@gmail.com', '301 1234567', 'DanielFLoai', 'Cra 95#40B Sur', 'c238542b5811806fc1702fdc9cbf0965', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID_Pr` int(11) NOT NULL,
  `Tipo` varchar(100) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Marca` varchar(100) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Descuento` int(11) NOT NULL,
  `Descripcion` text NOT NULL,
  `Imagen` varchar(100) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID_Pr`, `Tipo`, `Nombre`, `Marca`, `Precio`, `Descuento`, `Descripcion`, `Imagen`, `activo`) VALUES
(1, 'Ropa', 'Camiseta Negra', 'Cotton & ico', '43000.00', 10, 'Camiseta negra. Sin estampado, con un estilo sencillo y comodo', 'Camiseta Negra', 1),
(2, 'Ropa', 'Chaqueta Jean Azul', 'Cotton & ico', '53000.00', 0, 'Chaqueta de Jean azul con un estilo sencillo', 'Chaqueta Jean Azul', 1),
(3, 'Ropa', 'Sueter Negro', 'Cotton & ico', '80000.00', 20, 'Sueter Negro con un estilo sencillo con un gran diseño.', 'Sueter Negro', 1),
(4, 'Ropa', 'Gaban Negro', 'Cotton & ico', '100000.00', 0, 'Gaban negro con un estilo sencillo y con un gran diseño comodo.', 'Gaban Negro', 1),
(5, 'Ropa', 'Enterizo Rojo', 'Cotton & ico', '120000.00', 0, 'Enterizo rojo con un estilo sencillo y con un gran acabado', 'Enterizo Rojo', 1),
(6, 'Ropa', 'Falda Negra', 'Cotton & ico', '90000.00', 50, 'Falda Negra con un estilo sencillo, perfecto para toda chica', 'Falda Negra', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `ID_S` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`ID_S`, `Nombre`, `Tipo`) VALUES
(1, 'Organizador de eventos', 'Logistica'),
(2, 'Programador web', 'Ingenieria de sistemas'),
(3, 'Actor de Doblaje', 'Actuación'),
(4, 'Diseño de publicidad', 'Diseño Grafico'),
(5, 'Servicios contables', 'Contador público');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`ID_Cargo`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`ID_Compra`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`ID_F`),
  ADD KEY `ID_Pr` (`ID_Pr`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`ID_P`),
  ADD KEY `ID_Cargo` (`ID_Cargo`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID_Pr`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`ID_S`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `ID_Cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `ID_Compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `ID_F` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `ID_P` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID_Pr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `ID_S` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`ID_Pr`) REFERENCES `productos` (`ID_Pr`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`ID_Cargo`) REFERENCES `cargo` (`ID_Cargo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
