-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-11-2019 a las 08:57:39
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--
CREATE DATABASE IF NOT EXISTS `proyecto` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `proyecto`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boletos`
--

CREATE TABLE `boletos` (
  `idBoletos` int(11) NOT NULL,
  `costoB` float NOT NULL,
  `restantes` int(11) NOT NULL,
  `idSeccion` int(11) NOT NULL,
  `idEv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `boletos`
--

INSERT INTO `boletos` (`idBoletos`, `costoB`, `restantes`, `idSeccion`, `idEv`) VALUES
(1, 500, 92, 1, 1),
(2, 1200, 92, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boletoscomp`
--

CREATE TABLE `boletoscomp` (
  `idBC` int(11) NOT NULL,
  `idUsu` int(11) NOT NULL,
  `idBoletos` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fechaCompra` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `boletoscomp`
--

INSERT INTO `boletoscomp` (`idBC`, `idUsu`, `idBoletos`, `cantidad`, `fechaCompra`) VALUES
(2, 2, 1, 5, '2019-08-04'),
(3, 5, 1, 3, '2019-08-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idCat` int(11) NOT NULL,
  `descripcion` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCat`, `descripcion`) VALUES
(1, 'Conciertos'),
(2, 'Deportes'),
(3, 'Teatro y Culturales'),
(4, 'Familiares');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventosaceptados`
--

CREATE TABLE `eventosaceptados` (
  `idEv` int(11) NOT NULL,
  `nombreEv` varchar(100) NOT NULL,
  `taquilla` int(11) NOT NULL,
  `fechaVenta` date NOT NULL,
  `idVendedor` int(11) NOT NULL,
  `idForo` int(11) NOT NULL,
  `idCati` int(11) NOT NULL,
  `idSubCati` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `eventosaceptados`
--

INSERT INTO `eventosaceptados` (`idEv`, `nombreEv`, `taquilla`, `fechaVenta`, `idVendedor`, `idForo`, `idCati`, `idSubCati`) VALUES
(1, 'eventoP', 0, '2019-09-19', 2, 1, 2, 7);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `eventosindex`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `eventosindex` (
`idEv` int(11)
,`nombreEv` varchar(100)
,`fechaVenta` date
,`idF` int(11)
,`nombreF` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventospendientes`
--

CREATE TABLE `eventospendientes` (
  `idEvPentientes` int(11) NOT NULL,
  `nombreEvento` varchar(100) NOT NULL,
  `fechaVenta` date NOT NULL,
  `nombreForo` varchar(200) NOT NULL,
  `capacidadForo` int(11) NOT NULL,
  `boletosVender` int(11) NOT NULL,
  `costoBoleto` float NOT NULL,
  `taquilla` int(11) NOT NULL COMMENT '0 No 1 Si',
  `admisionGeneral` int(11) NOT NULL COMMENT '0 No 1 Si',
  `lugarEspecifico` int(11) NOT NULL COMMENT '0 No 1 Si',
  `nombreCompleto` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `estado` int(11) NOT NULL,
  `cp` int(11) NOT NULL,
  `telCasa` varchar(15) NOT NULL,
  `telSecundario` varchar(15) NOT NULL,
  `comentarios` text NOT NULL,
  `estadoReg` int(11) NOT NULL COMMENT '0-inactivo 1-Activo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `eventospendientes`
--

INSERT INTO `eventospendientes` (`idEvPentientes`, `nombreEvento`, `fechaVenta`, `nombreForo`, `capacidadForo`, `boletosVender`, `costoBoleto`, `taquilla`, `admisionGeneral`, `lugarEspecifico`, `nombreCompleto`, `email`, `direccion`, `estado`, `cp`, `telCasa`, `telSecundario`, `comentarios`, `estadoReg`) VALUES
(1, 'eventoP', '2019-09-19', '', 200, 10, 0, 0, 0, 1, 'Pepe el pruebas', 'pruebas@gmail.com', 'direccion1', 1, 55748, '', '', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forosaceptados`
--

CREATE TABLE `forosaceptados` (
  `idF` int(11) NOT NULL,
  `nombreF` varchar(100) NOT NULL,
  `direccionF` varchar(200) NOT NULL,
  `ciudadF` varchar(100) NOT NULL,
  `estadoF` int(11) NOT NULL,
  `capacidadF` int(11) NOT NULL,
  `adminGen` int(11) NOT NULL,
  `lugarEs` int(11) NOT NULL,
  `rutaImg` varchar(200) NOT NULL,
  `idVendedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `forosaceptados`
--

INSERT INTO `forosaceptados` (`idF`, `nombreF`, `direccionF`, `ciudadF`, `estadoF`, `capacidadF`, `adminGen`, `lugarEs`, `rutaImg`, `idVendedor`) VALUES
(1, 'Forito', 'Calle pepe', 'Mexico', 15, 0, 0, 0, '/Imagenes/Foros/1264762s.gif', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forospendientes`
--

CREATE TABLE `forospendientes` (
  `idInmP` int(11) NOT NULL,
  `nombreForo` varchar(50) NOT NULL,
  `direccionForo` varchar(100) NOT NULL,
  `ciudadForo` varchar(100) NOT NULL,
  `estadoForo` int(11) NOT NULL,
  `capacidadForo` int(11) NOT NULL,
  `eventosForo` int(11) NOT NULL,
  `boletosForo` int(11) NOT NULL,
  `adminGeneral` int(11) NOT NULL COMMENT '0 No 1 Si',
  `lugarE` int(11) NOT NULL COMMENT '0 No 1 Si',
  `nombreCompleto` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `direccionVend` varchar(100) NOT NULL,
  `estadoVend` int(11) NOT NULL,
  `cp` int(11) NOT NULL,
  `telefonoOf` varchar(20) NOT NULL,
  `telefonoSec` varchar(20) NOT NULL,
  `comentarios` text NOT NULL,
  `estado` int(11) NOT NULL COMMENT '0 inactivo 1 activo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `forospendientes`
--

INSERT INTO `forospendientes` (`idInmP`, `nombreForo`, `direccionForo`, `ciudadForo`, `estadoForo`, `capacidadForo`, `eventosForo`, `boletosForo`, `adminGeneral`, `lugarE`, `nombreCompleto`, `email`, `direccionVend`, `estadoVend`, `cp`, `telefonoOf`, `telefonoSec`, `comentarios`, `estado`) VALUES
(1, 'Forito', 'Calle pepe', 'Mexico', 15, 0, 0, 0, 0, 0, 'Obed Martinez', 'obednoe22yt@gmail.com', 'Calle pepe', 5, 0, '', '', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE `secciones` (
  `idSeccion` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `idForo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `secciones`
--

INSERT INTO `secciones` (`idSeccion`, `nombre`, `capacidad`, `idForo`) VALUES
(1, 'Seccion1', 200, 1),
(2, 'Seccion2', 600, 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `seccionesforos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `seccionesforos` (
`nombre` varchar(60)
,`capacidad` int(11)
,`idF` int(11)
,`nombreF` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcat`
--

CREATE TABLE `subcat` (
  `idSubCat` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `idCati` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `subcat`
--

INSERT INTO `subcat` (`idSubCat`, `descripcion`, `idCati`) VALUES
(1, 'Comedia', 1),
(2, 'Jazz/Instrumental', 1),
(3, 'Mas conciertos', 1),
(4, 'Pop/Romantica', 1),
(5, 'Rock/Metal', 1),
(6, 'Automovilismo', 2),
(7, 'Box/Lucha libre', 2),
(8, 'Mas deportes', 2),
(9, 'Equestre', 2),
(10, 'Tenis', 2),
(11, 'Ballet/Danza', 3),
(12, 'Comedia', 3),
(13, 'Musicales', 3),
(14, 'Mas teatro y culturales', 3),
(15, 'Obras de teatro', 3),
(16, 'Acuarios/Parques acuaticos', 4),
(17, 'Circos/Espectaculo infantil', 4),
(18, 'Mas familiares', 4),
(19, 'OnIce', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjetas`
--

CREATE TABLE `tarjetas` (
  `id_Tarj` int(11) NOT NULL,
  `numeroT` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fechaEx` date NOT NULL,
  `codigo` int(11) NOT NULL,
  `idUs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tarjetas`
--

INSERT INTO `tarjetas` (`id_Tarj`, `numeroT`, `nombre`, `fechaEx`, `codigo`, `idUs`) VALUES
(1, 56561262, 'Obed Mart', '2019-08-22', 456, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apPaterno` varchar(50) DEFAULT NULL,
  `apMaterno` varchar(50) DEFAULT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` int(11) NOT NULL COMMENT '0-Admin/1-Usuario/2-Vendedor'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apPaterno`, `apMaterno`, `correo`, `password`, `rol`) VALUES
(1, 'Obed Martinez', NULL, NULL, 'obednoe22@gmail.com', '$2y$10$N0PrkFuwVx3Wk8OQaLyTP.RdIAfZixj2nNGi.iAISDBUpd0fJKhWO', 2),
(2, 'Obed', 'Martin', '', 'pruebas@gmail.com', '$2y$10$AkKgKfyZ7frqcdnGlCl.LeSjL8r4RpG7Qah4y3os0jjdo.aTH5oyy', 2),
(3, 'Obed', 'Martinez', 'Martinez', 'obednoe22yt@gmail.com', '$2y$10$U2WGM4czBRtHjcdj2TTa8uAUqeYUjgOck2yLDhXUWng40j6ld2a0G', 0),
(5, 'Obed', 'Martinez', 'Martinez', 'pruebas33@gmail.com', '$2y$10$yESD9uLun7bw5GIdJ1LDsuQ1fCHgi0wvkrSzsV3pZw3SFsVcW4SJC', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedores`
--

CREATE TABLE `vendedores` (
  `idVendedor` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `estado` int(11) NOT NULL,
  `cp` int(11) NOT NULL,
  `telOf` varchar(15) NOT NULL,
  `telSec` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vendedores`
--

INSERT INTO `vendedores` (`idVendedor`, `idUsuario`, `direccion`, `estado`, `cp`, `telOf`, `telSec`) VALUES
(1, 1, 'Calle pepe', 5, 0, '', ''),
(2, 2, 'direccion1', 1, 55748, '', '');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `verforosaceptado`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `verforosaceptado` (
`idF` int(11)
,`nombreF` varchar(100)
,`direccionF` varchar(200)
,`ciudadF` varchar(100)
,`estadoF` int(11)
,`capacidadF` int(11)
,`adminGen` int(11)
,`lugarEs` int(11)
,`rutaImg` varchar(200)
,`idVendedor` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `verforospendiente`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `verforospendiente` (
`idInmP` int(11)
,`nombreForo` varchar(50)
,`direccionForo` varchar(100)
,`ciudadForo` varchar(100)
,`estadoForo` int(11)
,`capacidadForo` int(11)
,`eventosForo` int(11)
,`boletosForo` int(11)
,`adminGeneral` int(11)
,`lugarE` int(11)
,`nombreCompleto` varchar(50)
,`email` varchar(50)
,`direccionVend` varchar(100)
,`estadoVend` int(11)
,`cp` int(11)
,`telefonoOf` varchar(20)
,`telefonoSec` varchar(20)
,`comentarios` text
,`estado` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `verusuarios`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `verusuarios` (
`id` int(11)
,`nombre` varchar(50)
,`apPaterno` varchar(50)
,`apMaterno` varchar(50)
,`correo` varchar(100)
,`password` varchar(255)
,`rol` int(11)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `eventosindex`
--
DROP TABLE IF EXISTS `eventosindex`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eventosindex`  AS  select `eventosaceptados`.`idEv` AS `idEv`,`eventosaceptados`.`nombreEv` AS `nombreEv`,`eventosaceptados`.`fechaVenta` AS `fechaVenta`,`forosaceptados`.`idF` AS `idF`,`forosaceptados`.`nombreF` AS `nombreF` from (`eventosaceptados` join `forosaceptados` on(`eventosaceptados`.`idForo` = `forosaceptados`.`idF`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `seccionesforos`
--
DROP TABLE IF EXISTS `seccionesforos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `seccionesforos`  AS  select `secciones`.`nombre` AS `nombre`,`secciones`.`capacidad` AS `capacidad`,`forosaceptados`.`idF` AS `idF`,`forosaceptados`.`nombreF` AS `nombreF` from (`secciones` join `forosaceptados` on(`secciones`.`idForo` = `forosaceptados`.`idF`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `verforosaceptado`
--
DROP TABLE IF EXISTS `verforosaceptado`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `verforosaceptado`  AS  select `forosaceptados`.`idF` AS `idF`,`forosaceptados`.`nombreF` AS `nombreF`,`forosaceptados`.`direccionF` AS `direccionF`,`forosaceptados`.`ciudadF` AS `ciudadF`,`forosaceptados`.`estadoF` AS `estadoF`,`forosaceptados`.`capacidadF` AS `capacidadF`,`forosaceptados`.`adminGen` AS `adminGen`,`forosaceptados`.`lugarEs` AS `lugarEs`,`forosaceptados`.`rutaImg` AS `rutaImg`,`forosaceptados`.`idVendedor` AS `idVendedor` from `forosaceptados` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `verforospendiente`
--
DROP TABLE IF EXISTS `verforospendiente`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `verforospendiente`  AS  select `forospendientes`.`idInmP` AS `idInmP`,`forospendientes`.`nombreForo` AS `nombreForo`,`forospendientes`.`direccionForo` AS `direccionForo`,`forospendientes`.`ciudadForo` AS `ciudadForo`,`forospendientes`.`estadoForo` AS `estadoForo`,`forospendientes`.`capacidadForo` AS `capacidadForo`,`forospendientes`.`eventosForo` AS `eventosForo`,`forospendientes`.`boletosForo` AS `boletosForo`,`forospendientes`.`adminGeneral` AS `adminGeneral`,`forospendientes`.`lugarE` AS `lugarE`,`forospendientes`.`nombreCompleto` AS `nombreCompleto`,`forospendientes`.`email` AS `email`,`forospendientes`.`direccionVend` AS `direccionVend`,`forospendientes`.`estadoVend` AS `estadoVend`,`forospendientes`.`cp` AS `cp`,`forospendientes`.`telefonoOf` AS `telefonoOf`,`forospendientes`.`telefonoSec` AS `telefonoSec`,`forospendientes`.`comentarios` AS `comentarios`,`forospendientes`.`estado` AS `estado` from `forospendientes` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `verusuarios`
--
DROP TABLE IF EXISTS `verusuarios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `verusuarios`  AS  select `usuarios`.`id` AS `id`,`usuarios`.`nombre` AS `nombre`,`usuarios`.`apPaterno` AS `apPaterno`,`usuarios`.`apMaterno` AS `apMaterno`,`usuarios`.`correo` AS `correo`,`usuarios`.`password` AS `password`,`usuarios`.`rol` AS `rol` from `usuarios` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `boletos`
--
ALTER TABLE `boletos`
  ADD PRIMARY KEY (`idBoletos`),
  ADD KEY `idSeccion` (`idSeccion`),
  ADD KEY `idEv` (`idEv`);

--
-- Indices de la tabla `boletoscomp`
--
ALTER TABLE `boletoscomp`
  ADD PRIMARY KEY (`idBC`),
  ADD KEY `idUsu` (`idUsu`),
  ADD KEY `idBoletos` (`idBoletos`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCat`);

--
-- Indices de la tabla `eventosaceptados`
--
ALTER TABLE `eventosaceptados`
  ADD PRIMARY KEY (`idEv`),
  ADD KEY `idForo` (`idForo`),
  ADD KEY `idVendedor` (`idVendedor`),
  ADD KEY `idCati` (`idCati`),
  ADD KEY `idSubCati` (`idSubCati`);

--
-- Indices de la tabla `eventospendientes`
--
ALTER TABLE `eventospendientes`
  ADD PRIMARY KEY (`idEvPentientes`);

--
-- Indices de la tabla `forosaceptados`
--
ALTER TABLE `forosaceptados`
  ADD PRIMARY KEY (`idF`),
  ADD KEY `idVendedor` (`idVendedor`);

--
-- Indices de la tabla `forospendientes`
--
ALTER TABLE `forospendientes`
  ADD PRIMARY KEY (`idInmP`);

--
-- Indices de la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD PRIMARY KEY (`idSeccion`),
  ADD KEY `idForo` (`idForo`);

--
-- Indices de la tabla `subcat`
--
ALTER TABLE `subcat`
  ADD PRIMARY KEY (`idSubCat`),
  ADD KEY `idCati` (`idCati`);

--
-- Indices de la tabla `tarjetas`
--
ALTER TABLE `tarjetas`
  ADD PRIMARY KEY (`id_Tarj`),
  ADD KEY `idUs` (`idUs`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  ADD PRIMARY KEY (`idVendedor`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `boletos`
--
ALTER TABLE `boletos`
  MODIFY `idBoletos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `boletoscomp`
--
ALTER TABLE `boletoscomp`
  MODIFY `idBC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `eventosaceptados`
--
ALTER TABLE `eventosaceptados`
  MODIFY `idEv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `eventospendientes`
--
ALTER TABLE `eventospendientes`
  MODIFY `idEvPentientes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `forosaceptados`
--
ALTER TABLE `forosaceptados`
  MODIFY `idF` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `forospendientes`
--
ALTER TABLE `forospendientes`
  MODIFY `idInmP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `idSeccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `subcat`
--
ALTER TABLE `subcat`
  MODIFY `idSubCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `tarjetas`
--
ALTER TABLE `tarjetas`
  MODIFY `id_Tarj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  MODIFY `idVendedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `boletos`
--
ALTER TABLE `boletos`
  ADD CONSTRAINT `boletos_ibfk_1` FOREIGN KEY (`idSeccion`) REFERENCES `secciones` (`idSeccion`),
  ADD CONSTRAINT `boletos_ibfk_2` FOREIGN KEY (`idEv`) REFERENCES `eventosaceptados` (`idEv`);

--
-- Filtros para la tabla `boletoscomp`
--
ALTER TABLE `boletoscomp`
  ADD CONSTRAINT `boletoscomp_ibfk_1` FOREIGN KEY (`idUsu`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `boletoscomp_ibfk_2` FOREIGN KEY (`idBoletos`) REFERENCES `boletos` (`idBoletos`);

--
-- Filtros para la tabla `eventosaceptados`
--
ALTER TABLE `eventosaceptados`
  ADD CONSTRAINT `eventosaceptados_ibfk_1` FOREIGN KEY (`idForo`) REFERENCES `forosaceptados` (`idF`),
  ADD CONSTRAINT `eventosaceptados_ibfk_2` FOREIGN KEY (`idVendedor`) REFERENCES `vendedores` (`idVendedor`),
  ADD CONSTRAINT `eventosaceptados_ibfk_3` FOREIGN KEY (`idCati`) REFERENCES `categorias` (`idCat`),
  ADD CONSTRAINT `eventosaceptados_ibfk_4` FOREIGN KEY (`idSubCati`) REFERENCES `subcat` (`idSubCat`);

--
-- Filtros para la tabla `forosaceptados`
--
ALTER TABLE `forosaceptados`
  ADD CONSTRAINT `forosaceptados_ibfk_1` FOREIGN KEY (`idVendedor`) REFERENCES `vendedores` (`idVendedor`);

--
-- Filtros para la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD CONSTRAINT `secciones_ibfk_1` FOREIGN KEY (`idForo`) REFERENCES `forosaceptados` (`idF`);

--
-- Filtros para la tabla `subcat`
--
ALTER TABLE `subcat`
  ADD CONSTRAINT `subcat_ibfk_1` FOREIGN KEY (`idCati`) REFERENCES `categorias` (`idCat`);

--
-- Filtros para la tabla `tarjetas`
--
ALTER TABLE `tarjetas`
  ADD CONSTRAINT `tarjetas_ibfk_1` FOREIGN KEY (`idUs`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `vendedores`
--
ALTER TABLE `vendedores`
  ADD CONSTRAINT `vendedores_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
