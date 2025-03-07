-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-03-2025 a las 15:41:51
-- Versión del servidor: 11.5.2-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lobofood`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cafeteria`
--

CREATE TABLE `cafeteria` (
  `ID` int(100) NOT NULL,
  `Cafeteria` varchar(150) NOT NULL,
  `Dueño` varchar(150) NOT NULL,
  `Contraseña` varchar(150) NOT NULL,
  `Telefono` varchar(150) NOT NULL,
  `Ubicacion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `cafeteria`
--

INSERT INTO `cafeteria` (`ID`, `Cafeteria`, `Dueño`, `Contraseña`, `Telefono`, `Ubicacion`) VALUES
(1, 'ChoriQueso', 'juan perez', '$2y$10$R8j/fkEPrLoBkg/bieiKZeh9kf2eRQ7U66xHbJp8/37uD0sbZbn6W', '2223916423', 'Computacion'),
(2, 'Dos', 'Tres', '$2y$10$OdgWl5.pQO.w6PpyMegZ0uSSHJ0DVvVx.zsURxuLw5azmgxO8O6Du', '2221645861', 'Quimica'),
(3, 'BigFood', 'BigMom', '$2y$10$eoZ5RvNJLzzWyMmxmvbVWu.yYmJpjAoUHKQbR/XwOTh/jwSPbctsK', '2221805811', 'Avenida San Claudio FCC-Buap'),
(4, 'Palmas', 'Rocks', '$2y$10$azqSHFG2ci3Fgeigs8qCPe3gCuGKUZ6R5ELEX.JHAEzCpnH4iMs1W', '2211929363', 'FCC'),
(5, 'Palmeras', 'Rocks', '$2y$10$gCj4ioMm1v8ZTrZvsJH3ZenEpDybqdv/jllmBH/fCW2U.BBCg7Edu', '2211929363', 'FCC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden`
--

CREATE TABLE `orden` (
  `numorden` int(11) NOT NULL,
  `matricula` varchar(150) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `estado` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `orden`
--

INSERT INTO `orden` (`numorden`, `matricula`, `fecha`, `hora`, `estado`) VALUES
(48, '250220234', '2023-05-16', '19:47:04', 0),
(49, '250220234', '2023-05-16', '19:51:51', 1),
(50, '202035891', '2023-05-16', '20:00:17', 0),
(51, '202067259', '2025-02-23', '15:00:32', NULL),
(52, '202067259', '2025-02-23', '15:01:59', NULL),
(53, '202067259', '2025-02-23', '15:46:14', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` int(11) NOT NULL,
  `foto` longblob NOT NULL,
  `nombrep` varchar(150) NOT NULL,
  `categoria` varchar(150) NOT NULL,
  `precio` double NOT NULL,
  `stock` int(11) NOT NULL,
  `ID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `foto`, `nombrep`, `categoria`, `precio`, `stock`, `ID`) VALUES
(2, 0x6672617070652e6a706567, 'Frape', 'Bebida', 30, 0, 1),
(3, 0x5441726162652e6a706567, 'Taco Arabe', 'Alimento', 14, 0, 1),
(4, 0x6368696c617175696c2e6a7067, 'Chilaquiles', 'Alimento', 35, 0, 1),
(5, 0x67616c6c657461732e6a7067, 'Galletas', 'Snack', 14, 6, 1),
(6, 0x74652e6a7067, 'Te', 'Bebida', 12, 5, 1),
(8, 0x73616e64776963682e6a706567, 'Sandwich', 'Alimento', 21, 4, 1),
(9, 0x4c696d6f6e6164652e6a706567, 'Limonada', 'Bebida', 13, 3, 1),
(10, 0x546f727461206d696c616e6573612e6a7067, 'Torta de Enchilada', 'Alimento', 35, 7, 1),
(11, 0x7461636f20706173746f722e6a7067, 'Tacos al Pastor', 'Alimento', 23, 12, 1),
(12, 0x54446f7261646f2e6a7067, 'Tacos Dorados', 'Alimento', 12, 10, 1),
(13, 0x63686f636f6c6174652e6a7067, 'Chocolate ', 'Bebida', 15, 4, 1),
(14, 0x526566726573636f2e6a7067, 'Refrescos', 'Bebida', 17, 16, 1),
(15, 0x4177612e6a7067, 'Aguas Horchata o Jamaica', 'Bebida', 15, 5, 1),
(16, 0x746f7469732d626f74616e61732e6a7067, 'Papas Fritas', 'Snack', 16, 12, 1),
(17, 0x656e73616c6164612e6a7067, 'Ensalada de Frutas', 'Snack', 23, 3, 1),
(18, 0x666c616e2e6a7067, 'Flan Napolitano', 'Snack', 13, 11, 1),
(19, 0x67656c6174696e612e6a7067, 'Gelatina ', 'Snack', 9, 12, 1),
(20, 0x676f6d697461732e6a7067, 'Gomitas con Chile', 'Snack', 5, 14, 1),
(21, 0x43687572726f732e6a7067, 'Churros', 'Snack', 12, 9, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productoaorden`
--

CREATE TABLE `productoaorden` (
  `idproductoaorden` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `numorden` int(11) NOT NULL,
  `cantidad` int(250) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `productoaorden`
--

INSERT INTO `productoaorden` (`idproductoaorden`, `idproducto`, `numorden`, `cantidad`, `total`) VALUES
(64, 11, 48, 4, 92),
(65, 14, 48, 1, 17),
(66, 20, 49, 2, 10),
(67, 16, 49, 1, 16),
(68, 11, 50, 1, 23),
(69, 12, 50, 1, 12),
(70, 3, 51, 1, 14),
(71, 16, 51, 1, 16),
(72, 8, 51, 2, 42),
(73, 11, 51, 3, 69),
(74, 9, 52, 2, 26),
(75, 6, 52, 1, 12),
(76, 21, 53, 1, 12),
(77, 15, 53, 1, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `matricula` varchar(150) NOT NULL,
  `contraseña` varchar(150) DEFAULT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `paterno` varchar(150) DEFAULT NULL,
  `materno` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`matricula`, `contraseña`, `nombre`, `paterno`, `materno`) VALUES
('111111111', '$2y$10$cwWd29VODD2uX2s/J1/ZzeFPTtZRxQ3l1uyg.q6vRt2yhqNOFORP.', 'Lulu', 'Flores', 'Jimenez'),
('123456789', '$2y$10$OzpUJ5tWbjUJbn5nw05Cfub29MlHC9hUi6vDqrKzKFsSNl9rqNX3i', 'Fernando', 'Perez', 'Rios'),
('123456798', '$2y$10$Wmch5TPCvtpVBV57aC6hoehiyw6vT08EdVbIUmiSiPlTN0DOQz0Tm', 'Luci', 'Martinez', 'Loera'),
('171104189', '$2y$10$4.81nc.3xwlFOEQa/MO7rOalBWENWQ/O.k8gjqMYx3MBb3ssK3z7y', 'Odette', 'Flores', 'Lechuga'),
('201651640', '$2y$10$picdG.K8J2RfCvu4nFkereeCLig9EASa6nN1JG1CU/tkM987YZzUe', 'Hola', 'A', 'Todos'),
('201906578', '$2y$10$9luqE0sSWOBHsAp7r8UeW.KrYz5QTpQ3rEMN2Rcc86Qh9shD19KgO', 'Jose', 'Vidal', 'Calixto'),
('202020202', '$2y$10$ZOyezlH5I8MmV6t9IFyU8OIYys4q/aktyNQ/miUnvlyOoNg5Ja5QO', 'Rosa', 'Mendez', 'Garcia'),
('202035891', '$2y$10$71ace49pUHj.SqieoTLeMehaIP6nTsMEWzf/.2ntWgo4.x76v0WEe', 'Evelyn', 'flores', 'lechuga'),
('202035901', '$2y$10$3MPnLQJ99IPcRkaCHXrpW.iiPs2CLALYQF7bG1VazdylOmg8PHq/a', 'camila', 'flores', 'perez'),
('202054321', '$2y$10$hBmDa79lv0lzIRzzKe/aR.ZntPuxTNySHcVFhhLXPpi9IeFYb/Wxq', 'Crixus', 'Yotunaim', 'Galo'),
('202067259', '$2y$10$CejlZrXqXXVR.j7/.qfrq.I2TxPKrEaFo4xnqS8o8BRrBeYI/duTK', 'Crixus', 'Galo', 'G'),
('222222222', '$2y$10$62NEj6d6pZttpxZ4m7UBGexgih1iZ4EYW.l37bFjT0xo03C/1XpAO', 'Angel', 'Dominguez', 'Carmen'),
('250220234', '$2y$10$R2I1jls0fuwXv2.KqStMVuqlksx29g92PXqdLTUhjZLyRVqVxaTpC', 'Jaqueline', 'Cabrera', 'Perez'),
('333333333', '$2y$10$2itfOsjZYAxLxSSySl0iMeJFJ3s/DQzB95lB6gmCw3zSEI6OOTLkS', 'Josue', 'Encarnacion', 'Hernandez'),
('555555555', '$2y$10$vY8jRrp5EFkVR.Omyl4gYOMG2vrxJyMYaqcB.h2NF3VmmLBoh2nUK', 'Raul', 'Romero', 'Roma');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cafeteria`
--
ALTER TABLE `cafeteria`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`numorden`),
  ADD KEY `fk_orden_usuarios1_idx` (`matricula`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `fk_producto_cafeteria1_idx` (`ID`);

--
-- Indices de la tabla `productoaorden`
--
ALTER TABLE `productoaorden`
  ADD PRIMARY KEY (`idproductoaorden`),
  ADD KEY `fk_producto_has_orden_orden1_idx` (`numorden`),
  ADD KEY `fk_producto_has_orden_producto1_idx` (`idproducto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`matricula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cafeteria`
--
ALTER TABLE `cafeteria`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `orden`
--
ALTER TABLE `orden`
  MODIFY `numorden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `productoaorden`
--
ALTER TABLE `productoaorden`
  MODIFY `idproductoaorden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `orden`
--
ALTER TABLE `orden`
  ADD CONSTRAINT `fk_orden_usuarios1` FOREIGN KEY (`matricula`) REFERENCES `usuarios` (`matricula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_cafeteria1` FOREIGN KEY (`ID`) REFERENCES `cafeteria` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productoaorden`
--
ALTER TABLE `productoaorden`
  ADD CONSTRAINT `fk_producto_has_orden_orden1` FOREIGN KEY (`numorden`) REFERENCES `orden` (`numorden`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_producto_has_orden_producto1` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
