-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-02-2024 a las 12:08:11
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
-- Base de datos: `shield_web`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agentes`
--

CREATE TABLE `agentes` (
  `ID` varchar(20) NOT NULL,
  `mayorista` varchar(20) DEFAULT NULL,
  `zona` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `agentes`
--

INSERT INTO `agentes` (`ID`, `mayorista`, `zona`) VALUES
('Agente', 'Pedrito', 'Bajío'),
('Pablito', 'Pedrito', 'Bajío');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carritos_dists`
--

CREATE TABLE `carritos_dists` (
  `ID` int(11) NOT NULL,
  `ID_user` varchar(20) NOT NULL,
  `ID_product` varchar(20) NOT NULL,
  `categoria` varchar(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precioxcantidad` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carritos_dists`
--

INSERT INTO `carritos_dists` (`ID`, `ID_user`, `ID_product`, `categoria`, `cantidad`, `precioxcantidad`) VALUES
(0, 'Distribuidor', '6', 'Nanoshield', 1, 200),
(1, 'Distribuidor', '2', 'Nanoshield', 4, 800),
(2, 'Distribuidor', '5', 'Nanoshield', 3, 600),
(3, 'BordadosNorte', '5', 'NanoShield', 12, 2400);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carritos_mayoristas`
--

CREATE TABLE `carritos_mayoristas` (
  `ID` int(11) NOT NULL,
  `ID_user` varchar(20) NOT NULL,
  `ID_product` varchar(20) NOT NULL,
  `categoria` varchar(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precioxcantidad` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `ID` varchar(20) NOT NULL,
  `imagen` varchar(500) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`ID`, `imagen`, `descripcion`) VALUES
('NanoKids', 'vistas/img/clasificaciones/categorias/NanoKids/Nanokids-Mascarillas.jpg', ''),
('NanoMask', 'vistas/img/clasificaciones/categorias/NanoMask/Screenshot_20200507_092913.jpg', ''),
('NanoShield', 'vistas/img/clasificaciones/categorias/NanoShield/joe-neric-Zsqbptb_j-Y-unsplash.jpg', ''),
('NanoShield LS', 'vistas/img/clasificaciones/categorias/NanoShield LS/foto.jpg', ''),
('NanoShield Sport', 'vistas/img/clasificaciones/categorias/NanoShield Sport/fotoss.jpg', ''),
('Shield', 'vistas/img/clasificaciones/categorias/Shield/SHIELDlogo.jpg', 'SHIELD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colecciones`
--

CREATE TABLE `colecciones` (
  `ID` varchar(30) NOT NULL,
  `imagen` varchar(500) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `colecciones`
--

INSERT INTO `colecciones` (`ID`, `imagen`, `descripcion`) VALUES
('Básica', 'vistas/img/clasificaciones/colecciones/Básica/fotso.jpg', 'Básica'),
('Guelaguetza', 'vistas/img/clasificaciones/colecciones/Guelaguetza/guelaguetza-2018-oaxaca.jpg', ''),
('Mar de Cortés', 'vistas/img/clasificaciones/colecciones/Mar de Cortés/BANNER-MAR-D-CORTÉS.jpg', 'La colección del Mar de Cortés'),
('Rarámuri', 'vistas/img/clasificaciones/colecciones/Rarámuri/Oaxaca_Mexico_17.jpg', ''),
('Touareg', '', ''),
('Urban', 'vistas/img/clasificaciones/colecciones/Urban/fots.jpg', 'Urbana');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comisiones`
--

CREATE TABLE `comisiones` (
  `ID` int(11) NOT NULL,
  `agente` varchar(20) NOT NULL,
  `ID_pedido` int(11) NOT NULL,
  `comision` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comisiones`
--

INSERT INTO `comisiones` (`ID`, `agente`, `ID_pedido`, `comision`) VALUES
(1, 'Pablito', 1, 100),
(2, 'Pablito', 2, 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credito`
--

CREATE TABLE `credito` (
  `ID` int(11) NOT NULL,
  `dist` int(11) NOT NULL,
  `total` float NOT NULL,
  `usado` float NOT NULL,
  `diferencia` float NOT NULL,
  `fecha_solicitud` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `interes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_deps`
--

CREATE TABLE `cuentas_deps` (
  `ID` int(11) NOT NULL,
  `propietario` varchar(100) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `valor` varchar(100) DEFAULT NULL,
  `beneficiario` varchar(100) DEFAULT NULL,
  `cuenta` varchar(10) DEFAULT NULL,
  `clabe` varchar(16) DEFAULT NULL,
  `tarjeta` varchar(19) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cuentas_deps`
--

INSERT INTO `cuentas_deps` (`ID`, `propietario`, `tipo`, `valor`, `beneficiario`, `cuenta`, `clabe`, `tarjeta`, `fecha`) VALUES
(1, 'FLEXOLAN S.A de C.V', 'Cuenta Bancaria', NULL, 'Miguel', '0000000000', '', '', '2023-03-23 23:46:26'),
(2, 'Pedrito', 'Cuenta Bancaria', NULL, 'Pedrito', '1111111111', '', '', '2023-08-09 14:49:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dists`
--

CREATE TABLE `dists` (
  `ID` varchar(20) NOT NULL,
  `tipo_persona` int(11) NOT NULL,
  `cp` varchar(7) NOT NULL,
  `dir_fiscal` varchar(200) NOT NULL,
  `domicilios` text NOT NULL,
  `mayorista` varchar(20) NOT NULL,
  `zona` varchar(20) NOT NULL,
  `agente` varchar(20) DEFAULT NULL,
  `historia` text DEFAULT NULL,
  `propuesta` int(11) DEFAULT NULL,
  `sit_fiscal` varchar(500) DEFAULT NULL,
  `acta_const` varchar(100) DEFAULT NULL,
  `comp_dom` varchar(100) DEFAULT NULL,
  `identificacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dists`
--

INSERT INTO `dists` (`ID`, `tipo_persona`, `cp`, `dir_fiscal`, `domicilios`, `mayorista`, `zona`, `agente`, `historia`, `propuesta`, `sit_fiscal`, `acta_const`, `comp_dom`, `identificacion`) VALUES
('BordadosNorte', 1, '11111', 'AVENIDA ORION 219-A COLONIA CONTRY 64850 MONTERREY, NUEVO LEÓN, MÉXICO', '', 'Pedrito', 'Bajío', 'Pablito', 'Contamos con el mejor equipo de diseñadores, estampadores, maquileros y repartidores para hacer que tu inversión tenga grandes rendimientos, estamos para ayudarte a hacer que tu inversión sea segura y con los diseños más novedos y actuales en el mercado.', 11, '', '', '', ''),
('Distribuidor', 1, '11111', 'Calle Oswaldo Martinolli 111A', '', 'Pedrito', 'Bajío', 'Agente', 'hi', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mayoristas`
--

CREATE TABLE `mayoristas` (
  `ID` varchar(20) NOT NULL,
  `tipo_persona` int(11) NOT NULL,
  `cp` varchar(7) NOT NULL,
  `dir_fiscal` varchar(200) NOT NULL,
  `domicilios` text DEFAULT NULL,
  `sit_fiscal` varchar(500) DEFAULT NULL,
  `acta_const` varchar(500) DEFAULT NULL,
  `identificacion` varchar(500) DEFAULT NULL,
  `comp_dom` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mayoristas`
--

INSERT INTO `mayoristas` (`ID`, `tipo_persona`, `cp`, `dir_fiscal`, `domicilios`, `sit_fiscal`, `acta_const`, `identificacion`, `comp_dom`) VALUES
('Pedrito', 0, '37295', 'prim calle', 'seg calle<br>terc calle<br>calle', 'vistas/docs/mayoristas/Pedrito/examenu4oliverABDD.pdf', '', 'vistas/docs/mayoristas/Pedrito/Reticula Ingenieria en Tecnologias de la Informacion y Comunicaciones.pdf', 'vistas/docs/mayoristas/Pedrito/ConvocatoriaMaestria_Septiembre2022vF.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_dists`
--

CREATE TABLE `pedidos_dists` (
  `ID` int(11) NOT NULL,
  `dist` varchar(20) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `productos` text NOT NULL,
  `domicilio` text NOT NULL,
  `precio` float NOT NULL,
  `envio` float NOT NULL,
  `total` float NOT NULL,
  `fecha_solicitud` date DEFAULT current_timestamp(),
  `motivo_pago` text NOT NULL,
  `comp_pago` varchar(500) DEFAULT NULL,
  `fecha_pago` date NOT NULL,
  `fecha_llegada` date NOT NULL,
  `seguimiento` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos_dists`
--

INSERT INTO `pedidos_dists` (`ID`, `dist`, `tipo`, `productos`, `domicilio`, `precio`, `envio`, `total`, `fecha_solicitud`, `motivo_pago`, `comp_pago`, `fecha_pago`, `fecha_llegada`, `seguimiento`) VALUES
(2, 'BordadosNorte', 'En espera de pago', 'T09 Shield x1 200<br>G02 Shield x3 600<br>G03 Nanoshield x2 400', 'AVENIDA ORION 219-A COLONIA CONTRY 64850 MONTERREY, NUEVO LEÓN, MÉXICO', 1200, 0, 0, '2023-08-25', 'Pedido 2 BordadosNorte', NULL, '0000-00-00', '0000-00-00', ''),
(3, 'BordadosNorte', 'En espera de pago', 'G03 Nanoshield x3 600<br>M01 Shield x2 400<br>R08-LATERAL Shield x1 200<br>G02 Shield x1 200', 'AVENIDA ORION 219-A COLONIA CONTRY 64850 MONTERREY, NUEVO LEÓN, MÉXICO', 1400, 0, 0, '2023-08-18', 'Pedido 3 BordadosNorte', NULL, '0000-00-00', '0000-00-00', ''),
(5, 'BordadosNorte', 'En espera de pago', 'G02  x \r\n                        1800                      <b', 'AVENIDA ORION 219-A COLONIA CONTRY 64850 MONTERREY, NUEVO LEÓN, MÉXICO', 1800, 0, 1800, '2024-01-19', 'Pedido 4 BordadosNorte', NULL, '0000-00-00', '0000-00-00', ''),
(6, 'BordadosNorte', 'En espera de pago', 'R08  x \r\n                        2400                      <b', 'AVENIDA ORION 219-A COLONIA CONTRY 64850 MONTERREY, NUEVO LEÓN, MÉXICO', 2400, 0, 2400, '2024-01-19', 'Pedido 5 BordadosNorte', NULL, '0000-00-00', '0000-00-00', ''),
(7, 'BordadosNorte', 'En espera de pago', 'M04 NanoShield x12 2400', 'AVENIDA ORION 219-A COLONIA CONTRY 64850 MONTERREY, NUEVO LEÓN, MÉXICO', 2400, 0, 2400, '2024-01-19', 'Pedido 6 BordadosNorte', NULL, '0000-00-00', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_mayoristas`
--

CREATE TABLE `pedidos_mayoristas` (
  `ID` int(11) NOT NULL,
  `mayorista` varchar(20) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `productos` text NOT NULL,
  `domicilio` text NOT NULL,
  `precio` float NOT NULL,
  `envio` float NOT NULL,
  `total` float NOT NULL,
  `fecha_solicitud` date NOT NULL DEFAULT current_timestamp(),
  `motivo_pago` text NOT NULL,
  `comp_pago` varchar(500) DEFAULT NULL,
  `fecha_pago` date NOT NULL,
  `fecha_llegada` date NOT NULL,
  `seguimiento` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos_mayoristas`
--

INSERT INTO `pedidos_mayoristas` (`ID`, `mayorista`, `tipo`, `productos`, `domicilio`, `precio`, `envio`, `total`, `fecha_solicitud`, `motivo_pago`, `comp_pago`, `fecha_pago`, `fecha_llegada`, `seguimiento`) VALUES
(1, 'Pedrito', 'Entregado', 'K02 Shield x1 150', 'Oswaldo Martinoli 109, Villas de San Juan, 37295 León, Gto.', 150, 50, 200, '2022-11-07', 'Pedido 3', NULL, '2022-11-07', '2022-11-07', ''),
(2, 'Pedrito', 'En espera de pago', 'G02 NanoShield x12 1800<br>T11 NanoShield x12 1800<b', 'seg calle', 3600, 0, 3600, '2024-01-15', 'Pedido 2 Pedrito', NULL, '0000-00-00', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_fab`
--

CREATE TABLE `productos_fab` (
  `ID` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `imagenes` text NOT NULL,
  `categorias` varchar(20) NOT NULL,
  `coleccion` varchar(20) NOT NULL,
  `descripcion` text NOT NULL,
  `caracteristicas` text NOT NULL,
  `detalles_tecnicos` text DEFAULT NULL,
  `precio_mayorista` int(11) NOT NULL,
  `envio` float NOT NULL,
  `cantidad_min` int(11) NOT NULL,
  `fecha_alta` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_modif` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos_fab`
--

INSERT INTO `productos_fab` (`ID`, `nombre`, `imagenes`, `categorias`, `coleccion`, `descripcion`, `caracteristicas`, `detalles_tecnicos`, `precio_mayorista`, `envio`, `cantidad_min`, `fecha_alta`, `fecha_modif`) VALUES
('1', 'G02', 'vistas/img/productos/Fabricante/1/400.png<br>vistas/img/productos/Fabricante/1/G02 FRENTE.png<br>vistas/img/productos/Fabricante/1/G02-(-reverso).jpg<br>vistas/img/productos/Fabricante/1/G02-(-frente).jpg', 'NanoShield<br>Shield', 'Guelaguetza', 'Te presentamos nuestras Nanoshields ideales para utilizar en transporte público, aviones, lugares concurridos o cualquier lugar contaminado.Cada banda tubular ha sido diseñada para brindar la mayor comodidad  y la más alta calidad.', '-Utiliza una membrana de nanofibras RESPILON que captura el 99% de todas las partículas y microorganismos.<br>- Protección contra los rayos UV ( UPF 50 ).<br>- BI-STRETCH.<br>- Clip Nasal ajustable- Transpirable.<br>- Suave y acogedor.<br>- Lavable y reutilizable.<br>- Hasta 50 ciclos de lavado.<br>- Comodidad para uso diario por más de 12 horas', NULL, 150, 0, 12, '2023-10-15 19:19:52', '2023-10-15 19:19:52'),
('10', 'U08', 'vistas/img/productos/Fabricante/10/U08 LATERAL.png<br>vistas/img/productos/Fabricante/10/U08 FRENTE.png<br>vistas/img/productos/Fabricante/10/U08 (reverso).jpg<br>vistas/img/productos/Fabricante/10/U08 (frente).jpg', 'NanoShield<br>Shield', 'Urban', 'Te presentamos nuestras Nanoshields ideales para utilizar en transporte público, aviones, lugares concurridos o cualquier lugar contaminado.Cada banda tubular ha sido diseñada para brindar la mayor comodidad  y la más alta calidad.', '-Utiliza una membrana de nanofibras RESPILON que captura el 99% de todas las partículas y microorganismos.<br>- Protección contra los rayos UV ( UPF 50 ).<br>- BI-STRETCH.<br>- Clip Nasal ajustable- Transpirable.<br>- Suave y acogedor.<br>- Lavable y reutilizable.<br>- Hasta 50 ciclos de lavado.<br>- Comodidad para uso diario por más de 12 horas', NULL, 150, 0, 12, '2023-10-15 19:18:29', '2023-10-15 19:18:29'),
('11', 'T11', 'vistas/img/productos/Fabricante/11/T11 LATERAL.png<br>vistas/img/productos/Fabricante/11/T11 FRENTE.png<br>vistas/img/productos/Fabricante/11/T11 (frente).jpg<br>vistas/img/productos/Fabricante/11/T11 (reverso).jpg', 'NanoShield<br>Shield', 'Touareg', 'Touareg', 'Touareg', NULL, 150, 0, 12, '2023-10-15 19:18:29', '2023-10-15 19:18:29'),
('12', 'T13', 'vistas/img/productos/Fabricante/12/T13 LATERAL.png<br>vistas/img/productos/Fabricante/12/T13 FRENTE.png<br>vistas/img/productos/Fabricante/12/T13 (frente).jpg<br>vistas/img/productos/Fabricante/12/T13 (reverso).jpg', 'NanoShield<br>Shield', 'Touareg', 'Touareg 13', 'Touareg 13', NULL, 150, 0, 12, '2023-10-15 19:18:29', '2023-10-15 19:18:29'),
('2', 'G03', 'vistas/img/productos/Fabricante/2/401.png<br>vistas/img/productos/Fabricante/2/G03 FRENTE.png<br>vistas/img/productos/Fabricante/2/G03-(-reverso).jpg<br>vistas/img/productos/Fabricante/2/G03-(-frente).jpg', 'NanoShield<br>Shield', 'Guelaguetza', 'Te presentamos nuestras Nanoshields ideales para utilizar en transporte público, aviones, lugares concurridos o cualquier lugar contaminado.Cada banda tubular ha sido diseñada para brindar la mayor comodidad  y la más alta calidad.', '-Utiliza una membrana de nanofibras RESPILON que captura el 99% de todas las partículas y microorganismos.<br>- Protección contra los rayos UV ( UPF 50 ).<br>- BI-STRETCH.<br>- Clip Nasal ajustable- Transpirable.<br>- Suave y acogedor.<br>- Lavable y reutilizable.<br>- Hasta 50 ciclos de lavado.<br>- Comodidad para uso diario por más de 12 horas', NULL, 150, 0, 12, '2023-10-15 19:18:29', '2023-10-15 19:18:29'),
('3', 'M01', 'vistas/img/productos/Fabricante/3/402.png<br>vistas/img/productos/Fabricante/3/M01 FRENTE.png<br>vistas/img/productos/Fabricante/3/M01 (reverso).jpg<br>vistas/img/productos/Fabricante/3/M01 (frente).jpg', 'NanoShield<br>Shield', 'Mar de Cortés', 'Te presentamos nuestras Nanoshields ideales para utilizar en transporte público, aviones, lugares concurridos o cualquier lugar contaminado.Cada banda tubular ha sido diseñada para brindar la mayor comodidad  y la más alta calidad.', '-Utiliza una membrana de nanofibras RESPILON que captura el 99% de todas las partículas y microorganismos.<br>- Protección contra los rayos UV ( UPF 50 ).<br>- BI-STRETCH.<br>- Clip Nasal ajustable- Transpirable.<br>- Suave y acogedor.<br>- Lavable y reutilizable.<br>- Hasta 50 ciclos de lavado.<br>- Comodidad para uso diario por más de 12 horas', NULL, 150, 0, 12, '2023-10-15 19:18:29', '2023-10-15 19:18:29'),
('4', 'M03', 'vistas/img/productos/Fabricante/4/403.png<br>vistas/img/productos/Fabricante/4/M03 FRENTE.png<br>vistas/img/productos/Fabricante/4/M03 (reverso).jpg<br>vistas/img/productos/Fabricante/4/M03 (frente).jpg', 'NanoShield<br>Shield', 'Mar de Cortés', 'Te presentamos nuestras Nanoshields ideales para utilizar en transporte público, aviones, lugares concurridos o cualquier lugar contaminado.Cada banda tubular ha sido diseñada para brindar la mayor comodidad  y la más alta calidad.', '-Utiliza una membrana de nanofibras RESPILON que captura el 99% de todas las partículas y microorganismos.<br>- Protección contra los rayos UV ( UPF 50 ).<br>- BI-STRETCH.<br>- Clip Nasal ajustable- Transpirable.<br>- Suave y acogedor.<br>- Lavable y reutilizable.<br>- Hasta 50 ciclos de lavado.<br>- Comodidad para uso diario por más de 12 horas', NULL, 150, 0, 12, '2023-10-15 19:18:29', '2023-10-15 19:18:29'),
('5', 'M04', 'vistas/img/productos/Fabricante/5/404.png<br>vistas/img/productos/Fabricante/5/M04 FRENTE.png<br>vistas/img/productos/Fabricante/5/M04-(reverso).jpg<br>vistas/img/productos/Fabricante/5/M04 (frente).jpg', 'NanoShield<br>Shield', 'Mar de Cortés', 'Te presentamos nuestras Nanoshields ideales para utilizar en transporte público, aviones, lugares concurridos o cualquier lugar contaminado.Cada banda tubular ha sido diseñada para brindar la mayor comodidad  y la más alta calidad.', '-Utiliza una membrana de nanofibras RESPILON que captura el 99% de todas las partículas y microorganismos.<br>- Protección contra los rayos UV ( UPF 50 ).<br>- BI-STRETCH.<br>- Clip Nasal ajustable- Transpirable.<br>- Suave y acogedor.<br>- Lavable y reutilizable.<br>- Hasta 50 ciclos de lavado.<br>- Comodidad para uso diario por más de 12 horas', NULL, 150, 0, 12, '2023-10-15 19:18:29', '2023-10-15 19:18:29'),
('6', 'M05', 'vistas/img/productos/Fabricante/6/405.png<br>vistas/img/productos/Fabricante/6/M05 FRENTE.png<br>vistas/img/productos/Fabricante/6/M05 (frente).jpg<br>vistas/img/productos/Fabricante/6/M05-(reverso).jpg', 'NanoShield<br>Shield', 'Mar de Cortés', 'Te presentamos nuestras Nanoshields ideales para utilizar en transporte público, aviones, lugares concurridos o cualquier lugar contaminado.Cada banda tubular ha sido diseñada para brindar la mayor comodidad  y la más alta calidad.', '-Utiliza una membrana de nanofibras RESPILON que captura el 99% de todas las partículas y microorganismos.<br>- Protección contra los rayos UV ( UPF 50 ).<br>- BI-STRETCH.<br>- Clip Nasal ajustable- Transpirable.<br>- Suave y acogedor.<br>- Lavable y reutilizable.<br>- Hasta 50 ciclos de lavado.<br>- Comodidad para uso diario por más de 12 horas', NULL, 150, 0, 12, '2023-10-15 19:18:29', '2023-10-15 19:18:29'),
('7', 'MILITAR 4', 'vistas/img/productos/Fabricante/7/406.png', 'NanoShield<br>Shield', 'Urban', 'Te presentamos nuestras Nanoshields ideales para utilizar en transporte público, aviones, lugares concurridos o cualquier lugar contaminado.Cada banda tubular ha sido diseñada para brindar la mayor comodidad  y la más alta calidad.', '-Utiliza una membrana de nanofibras RESPILON que captura el 99% de todas las partículas y microorganismos.<br>- Protección contra los rayos UV ( UPF 50 ).<br>- BI-STRETCH.<br>- Clip Nasal ajustable- Transpirable.<br>- Suave y acogedor.<br>- Lavable y reutilizable.<br>- Hasta 50 ciclos de lavado.<br>- Comodidad para uso diario por más de 12 horas', NULL, 150, 0, 12, '2023-10-15 19:18:29', '2023-10-15 19:18:29'),
('8', 'R08', 'vistas/img/productos/Fabricante/8/407.png', 'NanoShield<br>Shield', 'Rarámuri', 'Te presentamos nuestras Nanoshields ideales para utilizar en transporte público, aviones, lugares concurridos o cualquier lugar contaminado.Cada banda tubular ha sido diseñada para brindar la mayor comodidad  y la más alta calidad.', '-Utiliza una membrana de nanofibras RESPILON que captura el 99% de todas las partículas y microorganismos.<br>- Protección contra los rayos UV ( UPF 50 ).<br>- BI-STRETCH.<br>- Clip Nasal ajustable- Transpirable.<br>- Suave y acogedor.<br>- Lavable y reutilizable.<br>- Hasta 50 ciclos de lavado.<br>- Comodidad para uso diario por más de 12 horas', NULL, 150, 0, 12, '2023-10-15 19:18:29', '2023-10-15 19:18:29'),
('9', 'YOUNG 7', 'vistas/img/productos/Fabricante/9/YOUNG 7.png', 'NanoShield<br>Shield', 'Urban', 'Te presentamos nuestras Nanoshields ideales para utilizar en transporte público, aviones, lugares concurridos o cualquier lugar contaminado.Cada banda tubular ha sido diseñada para brindar la mayor comodidad  y la más alta calidad.', '-Utiliza una membrana de nanofibras RESPILON que captura el 99% de todas las partículas y microorganismos.<br>- Protección contra los rayos UV ( UPF 50 ).<br>- BI-STRETCH.<br>- Clip Nasal ajustable- Transpirable.<br>- Suave y acogedor.<br>- Lavable y reutilizable.<br>- Hasta 50 ciclos de lavado.<br>- Comodidad para uso diario por más de 12 horas', NULL, 150, 0, 12, '2023-10-15 19:18:29', '2023-10-15 19:18:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_mayorista`
--

CREATE TABLE `productos_mayorista` (
  `ID` varchar(20) NOT NULL,
  `mayorista` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `imagenes` text NOT NULL,
  `categorias` varchar(20) NOT NULL,
  `coleccion` varchar(20) NOT NULL,
  `rack` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `caracteristicas` text NOT NULL,
  `detalles_tecnicos` text DEFAULT NULL,
  `precio_mayorista` int(11) NOT NULL,
  `precio_dist` int(11) NOT NULL,
  `cantidad_min` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `fecha_alta` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_modif` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos_mayorista`
--

INSERT INTO `productos_mayorista` (`ID`, `mayorista`, `nombre`, `imagenes`, `categorias`, `coleccion`, `rack`, `descripcion`, `caracteristicas`, `detalles_tecnicos`, `precio_mayorista`, `precio_dist`, `cantidad_min`, `stock`, `fecha_alta`, `fecha_modif`) VALUES
('1', 'Pedrito', 'G02', 'vistas/img/productos/Mayorista/Pedrito/1/G02 LATERAL.png<br>vistas/img/productos/Mayorista/Pedrito/1/G02 FRENTE.png<br>vistas/img/productos/Mayorista/Pedrito/1/G02-(-frente).jpg<br>vistas/img/productos/Mayorista/Pedrito/1/G02-(-reverso).jpg', 'NanoShield<br>Shield', 'Guelaguetza', 0, 'Te presentamos nuestras Nanoshields ideales para utilizar en transporte público, aviones, lugares concurridos o cualquier lugar contaminado.Cada banda tubular ha sido diseñada para brindar la mayor comodidad  y la más alta calidad.', '-Utiliza una membrana de nanofibras RESPILON que captura el 99% de todas las partículas y microorganismos.<br>- Protección contra los rayos UV ( UPF 50 ).<br>- BI-STRETCH.<br>- Clip Nasal ajustable- Transpirable.<br>- Suave y acogedor.<br>- Lavable y reutilizable.<br>- Hasta 50 ciclos de lavado.<br>- Comodidad para uso diario por más de 12 horas', NULL, 150, 200, 9, 30, '2023-10-21 14:45:23', '2023-10-21 14:45:23'),
('10', 'Pedrito', 'U08', 'vistas/img/productos/Mayorista/Pedrito/10/U08 LATERAL.png<br>vistas/img/productos/Mayorista/Pedrito/10/U08 FRENTE.png<br>vistas/img/productos/Mayorista/Pedrito/10/U08 (reverso).jpg<br>vistas/img/productos/Mayorista/Pedrito/10/U08 (frente).jpg', 'NanoShield<br>Shield', 'Urban', 0, 'Te presentamos nuestras Nanoshields ideales para utilizar en transporte público, aviones, lugares concurridos o cualquier lugar contaminado.Cada banda tubular ha sido diseñada para brindar la mayor comodidad  y la más alta calidad.', '-Utiliza una membrana de nanofibras RESPILON que captura el 99% de todas las partículas y microorganismos.<br>- Protección contra los rayos UV ( UPF 50 ).<br>- BI-STRETCH.<br>- Clip Nasal ajustable- Transpirable.<br>- Suave y acogedor.<br>- Lavable y reutilizable.<br>- Hasta 50 ciclos de lavado.<br>- Comodidad para uso diario por más de 12 horas', NULL, 150, 210, 12, 30, '2023-10-15 19:19:38', '2023-10-15 19:19:38'),
('11', 'Pedrito', 'nuevo producto', 'vistas/img/productos/Mayorista/Pedrito/11/T10 (frente).jpg<br>vistas/img/productos/Mayorista/Pedrito/11/T10 (reverso).jpg<br>vistas/img/productos/Mayorista/Pedrito/11/T10 FRENTE.png<br>vistas/img/productos/Mayorista/Pedrito/11/T10 LATERAL.png', 'NanoShield<br>Shield', 'Touareg', 0, 'Touareg', 'Touareg', NULL, 200, 280, 12, 100, '2023-10-15 19:19:38', '2023-10-15 19:19:38'),
('2', 'Pedrito', 'G03', 'vistas/img/productos/Mayorista/Pedrito/2/401.png<br>vistas/img/productos/Mayorista/Pedrito/2/G03 FRENTE.png<br>vistas/img/productos/Mayorista/Pedrito/2/G03-(-frente).jpg<br>vistas/img/productos/Mayorista/Pedrito/2/G03-(-reverso).jpg', 'NanoShield<br>Shield', 'Guelaguetza', 0, 'Te presentamos nuestras Nanoshields ideales para utilizar en transporte público, aviones, lugares concurridos o cualquier lugar contaminado.Cada banda tubular ha sido diseñada para brindar la mayor comodidad  y la más alta calidad.', '-Utiliza una membrana de nanofibras RESPILON que captura el 99% de todas las partículas y microorganismos.<br>- Protección contra los rayos UV ( UPF 50 ).<br>- BI-STRETCH.<br>- Clip Nasal ajustable- Transpirable.<br>- Suave y acogedor.<br>- Lavable y reutilizable.<br>- Hasta 50 ciclos de lavado.<br>- Comodidad para uso diario por más de 12 horas', NULL, 150, 200, 12, 30, '2023-10-15 19:19:38', '2023-10-15 19:19:38'),
('3', 'Pedrito', 'M01', 'vistas/img/productos/Mayorista/Pedrito/3/402.png<br>vistas/img/productos/Mayorista/Pedrito/3/M01 FRENTE.png<br>vistas/img/productos/Mayorista/Pedrito/3/M01 (reverso).jpg<br>vistas/img/productos/Mayorista/Pedrito/3/M01 (frente).jpg', 'NanoShield<br>Shield', 'Mar de Cortés', 0, 'Te presentamos nuestras Nanoshields ideales para utilizar en transporte público, aviones, lugares concurridos o cualquier lugar contaminado.Cada banda tubular ha sido diseñada para brindar la mayor comodidad  y la más alta calidad.', '-Utiliza una membrana de nanofibras RESPILON que captura el 99% de todas las partículas y microorganismos.<br>- Protección contra los rayos UV ( UPF 50 ).<br>- BI-STRETCH.<br>- Clip Nasal ajustable- Transpirable.<br>- Suave y acogedor.<br>- Lavable y reutilizable.<br>- Hasta 50 ciclos de lavado.<br>- Comodidad para uso diario por más de 12 horas', NULL, 150, 200, 12, 30, '2023-10-15 19:19:38', '2023-10-15 19:19:38'),
('4', 'Pedrito', 'M03', 'vistas/img/productos/Mayorista/Pedrito/4/403.png<br>vistas/img/productos/Mayorista/Pedrito/4/M03 FRENTE.png<br>vistas/img/productos/Mayorista/Pedrito/4/M03 (reverso).jpg<br>vistas/img/productos/Mayorista/Pedrito/4/M03 (frente).jpg', 'NanoShield<br>Shield', 'Mar de Cortés', 0, 'Te presentamos nuestras Nanoshields ideales para utilizar en transporte público, aviones, lugares concurridos o cualquier lugar contaminado.Cada banda tubular ha sido diseñada para brindar la mayor comodidad  y la más alta calidad.', '-Utiliza una membrana de nanofibras RESPILON que captura el 99% de todas las partículas y microorganismos.<br>- Protección contra los rayos UV ( UPF 50 ).<br>- BI-STRETCH.<br>- Clip Nasal ajustable- Transpirable.<br>- Suave y acogedor.<br>- Lavable y reutilizable.<br>- Hasta 50 ciclos de lavado.<br>- Comodidad para uso diario por más de 12 horas', NULL, 150, 200, 12, 30, '2023-10-15 19:19:38', '2023-10-15 19:19:38'),
('5', 'Pedrito', 'M04', 'vistas/img/productos/Mayorista/Pedrito/5/404.png<br>vistas/img/productos/Mayorista/Pedrito/5/M04 FRENTE.png<br>vistas/img/productos/Mayorista/Pedrito/5/M04-(reverso).jpg<br>vistas/img/productos/Mayorista/Pedrito/5/M04 (frente).jpg', 'NanoShield<br>Shield', 'Mar de Cortés', 0, 'Te presentamos nuestras Nanoshields ideales para utilizar en transporte público, aviones, lugares concurridos o cualquier lugar contaminado.Cada banda tubular ha sido diseñada para brindar la mayor comodidad  y la más alta calidad.', '-Utiliza una membrana de nanofibras RESPILON que captura el 99% de todas las partículas y microorganismos.<br>- Protección contra los rayos UV ( UPF 50 ).<br>- BI-STRETCH.<br>- Clip Nasal ajustable- Transpirable.<br>- Suave y acogedor.<br>- Lavable y reutilizable.<br>- Hasta 50 ciclos de lavado.<br>- Comodidad para uso diario por más de 12 horas', NULL, 150, 200, 12, 30, '2023-10-15 19:19:38', '2023-10-15 19:19:38'),
('6', 'Pedrito', 'M05', 'vistas/img/productos/Mayorista/Pedrito/6/405.png<br>vistas/img/productos/Mayorista/Pedrito/6/M05 FRENTE.png<br>vistas/img/productos/Mayorista/Pedrito/6/M05 (frente).jpg<br>vistas/img/productos/Mayorista/Pedrito/6/M04-(reverso).jpg', 'NanoShield<br>Shield', 'Mar de Cortés', 0, 'Te presentamos nuestras Nanoshields ideales para utilizar en transporte público, aviones, lugares concurridos o cualquier lugar contaminado.Cada banda tubular ha sido diseñada para brindar la mayor comodidad  y la más alta calidad.', '-Utiliza una membrana de nanofibras RESPILON que captura el 99% de todas las partículas y microorganismos.<br>- Protección contra los rayos UV ( UPF 50 ).<br>- BI-STRETCH.<br>- Clip Nasal ajustable- Transpirable.<br>- Suave y acogedor.<br>- Lavable y reutilizable.<br>- Hasta 50 ciclos de lavado.<br>- Comodidad para uso diario por más de 12 horas', NULL, 150, 200, 12, 30, '2023-10-15 19:19:38', '2023-10-15 19:19:38'),
('7', 'Pedrito', 'MILITAR 4', 'vistas/img/productos/Mayorista/Pedrito/7/406.png', 'NanoShield<br>Shield', 'Urban', 0, 'Te presentamos nuestras Nanoshields ideales para utilizar en transporte público, aviones, lugares concurridos o cualquier lugar contaminado.Cada banda tubular ha sido diseñada para brindar la mayor comodidad  y la más alta calidad.', '-Utiliza una membrana de nanofibras RESPILON que captura el 99% de todas las partículas y microorganismos.<br>- Protección contra los rayos UV ( UPF 50 ).<br>- BI-STRETCH.<br>- Clip Nasal ajustable- Transpirable.<br>- Suave y acogedor.<br>- Lavable y reutilizable.<br>- Hasta 50 ciclos de lavado.<br>- Comodidad para uso diario por más de 12 horas', NULL, 150, 200, 12, 30, '2023-10-15 19:19:38', '2023-10-15 19:19:38'),
('8', 'Pedrito', 'R08', 'vistas/img/productos/Mayorista/Pedrito/8/407.png', 'NanoShield<br>Shield', 'Rarámuri', 0, 'Te presentamos nuestras Nanoshields ideales para utilizar en transporte público, aviones, lugares concurridos o cualquier lugar contaminado.Cada banda tubular ha sido diseñada para brindar la mayor comodidad  y la más alta calidad.', '-Utiliza una membrana de nanofibras RESPILON que captura el 99% de todas las partículas y microorganismos.<br>- Protección contra los rayos UV ( UPF 50 ).<br>- BI-STRETCH.<br>- Clip Nasal ajustable- Transpirable.<br>- Suave y acogedor.<br>- Lavable y reutilizable.<br>- Hasta 50 ciclos de lavado.<br>- Comodidad para uso diario por más de 12 horas', NULL, 150, 200, 12, 30, '2023-10-15 19:19:38', '2023-10-15 19:19:38'),
('9', 'Pedrito', 'YOUNG 7', 'vistas/img/productos/Mayorista/Pedrito/9/YOUNG 7.png', 'NanoShield<br>Shield', 'Urban', 0, 'Te presentamos nuestras Nanoshields ideales para utilizar en transporte público, aviones, lugares concurridos o cualquier lugar contaminado.Cada banda tubular ha sido diseñada para brindar la mayor comodidad  y la más alta calidad.', '-Utiliza una membrana de nanofibras RESPILON que captura el 99% de todas las partículas y microorganismos.<br>- Protección contra los rayos UV ( UPF 50 ).<br>- BI-STRETCH.<br>- Clip Nasal ajustable- Transpirable.<br>- Suave y acogedor.<br>- Lavable y reutilizable.<br>- Hasta 50 ciclos de lavado.<br>- Comodidad para uso diario por más de 12 horas', NULL, 150, 210, 12, 30, '2023-10-15 19:19:38', '2023-10-15 19:19:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitantes`
--

CREATE TABLE `solicitantes` (
  `ID` varchar(20) NOT NULL,
  `tipo_persona` int(11) NOT NULL,
  `mayorista` varchar(20) DEFAULT NULL,
  `zona` varchar(20) DEFAULT NULL,
  `agente` varchar(20) DEFAULT NULL,
  `rechazo` date DEFAULT NULL,
  `observs` text DEFAULT NULL,
  `cp` varchar(7) NOT NULL,
  `dir_fiscal` varchar(200) NOT NULL,
  `domicilios` text NOT NULL,
  `historia` varchar(600) NOT NULL,
  `propuesta` int(11) NOT NULL,
  `sit_fiscal` varchar(500) DEFAULT NULL,
  `identificacion` varchar(500) DEFAULT NULL,
  `comp_dom` varchar(500) DEFAULT NULL,
  `acta_const` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitantes`
--

INSERT INTO `solicitantes` (`ID`, `tipo_persona`, `mayorista`, `zona`, `agente`, `rechazo`, `observs`, `cp`, `dir_fiscal`, `domicilios`, `historia`, `propuesta`, `sit_fiscal`, `identificacion`, `comp_dom`, `acta_const`) VALUES
('asp', 0, NULL, NULL, NULL, '0000-00-00', NULL, '44444', 'Calle Oswaldo Martinolli 111A', '', 'hi', 10, '', '', '', ''),
('Juan', 0, NULL, NULL, NULL, '0000-00-00', NULL, '00000', 'Calle Oswaldo Martinolli 112A', '', 'holi', 300, '', '', '', ''),
('newuser', 0, NULL, NULL, NULL, NULL, NULL, '33333', 'Calle Oswaldo Martinolli 113A', '', 'ejf0jf094f09pefmpiqewvoiwpof3q0', 100000, 'vistas/docs/solicitantes/newuser/EXAMEN TEMA 2.pdf', 'vistas/docs/solicitantes/newuser/1603815699-Convocatoria_INCLUSIÓN DIGITAL_MEDIA SUPERIOR Y SUPERIOR 2020 (2) (1).pdf', 'vistas/docs/solicitantes/newuser/Diagrama_de_Casos_de_Uso.pdf', 'vistas/docs/solicitantes/newuser/2010WorldFinalProblemSet.pdf'),
('Solic', 0, NULL, NULL, NULL, '0000-00-00', NULL, '37395', 'Calle Oswaldo Martinolli 114A', '', 'hi', 5, '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_de_credito`
--

CREATE TABLE `solicitudes_de_credito` (
  `ID` int(11) NOT NULL,
  `dist` int(11) NOT NULL,
  `cantidad` float NOT NULL,
  `fecha_solicitud` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `aprobacion` int(11) NOT NULL,
  `interes` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `total_productos_pedidos`
--

CREATE TABLE `total_productos_pedidos` (
  `productos_fab` int(11) NOT NULL,
  `productos_mayorista` int(11) NOT NULL,
  `pedidos_mayoristas` int(11) NOT NULL,
  `pedidos_dists` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `total_productos_pedidos`
--

INSERT INTO `total_productos_pedidos` (`productos_fab`, `productos_mayorista`, `pedidos_mayoristas`, `pedidos_dists`) VALUES
(13, 12, 3, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` varchar(20) NOT NULL,
  `nombre_legal_o_rs` varchar(100) DEFAULT NULL,
  `tipo` varchar(20) NOT NULL,
  `foto` varchar(500) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `tel` varchar(14) NOT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `ciudad` varchar(50) DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT 0,
  `ultimo_login` datetime NOT NULL DEFAULT current_timestamp(),
  `ingreso` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `nombre_legal_o_rs`, `tipo`, `foto`, `email`, `contrasena`, `tel`, `estado`, `ciudad`, `estatus`, `ultimo_login`, `ingreso`) VALUES
('Admin', '', 'Administrador', 'vistas/img/usuarios/Admin/405.jpg', 'admin@gmail.com', '$2a$07$asxx54ahjppf45sd87a5au6dvp1FCl12JI0.oJcCFq4Ni1dHoWwjy', '(477) 578-1149', NULL, NULL, 1, '2024-01-26 08:21:54', '2023-02-19 16:19:57'),
('Agente', 'Agente', 'Agente', 'vistas/img/usuarios/Agente/628.jpg', 'agent@mail.com', '$2a$07$asxx54ahjppf45sd87a5au6dvp1FCl12JI0.oJcCFq4Ni1dHoWwjy', '(222) 222-2222', 'Aguascalientes', 'Jesus Maria', 1, '2023-10-10 20:23:46', '2023-03-29 18:58:41'),
('asp', 'aspirante', 'Solicitante', 'vistas/img/usuarios/asp/385.jpg', 'email@email.com', '$2a$07$asxx54ahjppf45sd87a5au6dvp1FCl12JI0.oJcCFq4Ni1dHoWwjy', '(000) 000-0000', 'Guanajuato', 'León', 1, '2023-03-31 20:20:13', '2023-03-03 23:04:39'),
('BordadosNorte', 'Bordados del Norte', 'Distribuidor', 'vistas/img/usuarios/BordadosNorte/476.png', 'PGUERRA@BORDADOSDELNORTE.COM', '$2a$07$asxx54ahjppf45sd87a5au6dvp1FCl12JI0.oJcCFq4Ni1dHoWwjy', '(811) 044-0376', 'Guanajuato', 'León', 1, '2024-01-24 08:22:30', '2023-02-19 16:17:31'),
('Distribuidor', 'Distribuidor', 'Distribuidor', 'vistas/img/usuarios/Distribuidor/407.jpg', 'dist@email.com', '$2a$07$asxx54ahjppf45sd87a5auJRR6foEJ7ynpjisKtbiKJbvJsoQ8VPS', '(888) 888-8888', 'Chihuahua', 'Carichi', 1, '2023-10-10 20:24:09', '2023-03-31 01:16:49'),
('Juan', 'Juan', 'Solicitante', 'vistas/img/usuarios/Juan/524.jpg', 'juan@email.com', '$2a$07$asxx54ahjppf45sd87a5auJRR6foEJ7ynpjisKtbiKJbvJsoQ8VPS', '(000) 000-0000', 'Campeche', 'Hecelchakan', 1, '2023-03-31 20:28:28', '2023-03-23 01:15:36'),
('Lic Cecilia', '', 'Fabricante', 'vistas/img/usuarios/Lic Cecilia/238.jpg', 'gestion@comertex.com.mx', '$2a$07$asxx54ahjppf45sd87a5au6dvp1FCl12JI0.oJcCFq4Ni1dHoWwjy', '(111) 111-1111', NULL, NULL, 1, '2023-12-11 17:56:11', '2023-03-29 18:39:32'),
('newuser', 'newuser', 'Solicitante', 'vistas/img/usuarios/newuser/438.png', 'elcorreo@email.com', '$2a$07$asxx54ahjppf45sd87a5auJRR6foEJ7ynpjisKtbiKJbvJsoQ8VPS', '(999) 999-9999', 'Chihuahua', 'Camargo', 1, '2023-04-27 10:08:05', '2023-04-26 22:14:54'),
('Pablito', 'Pablo', 'Agente', 'vistas/img/usuarios/Pablito/706.jpg', 'pablo@email.com', '$2a$07$asxx54ahjppf45sd87a5au6dvp1FCl12JI0.oJcCFq4Ni1dHoWwjy', '(477) 113-1258', 'Guanajuato', 'León', 1, '2023-06-03 21:21:23', '2023-02-19 16:18:46'),
('Pedrito', 'Pedro', 'Mayorista', 'vistas/img/usuarios/Pedrito/304.png', 'pedrito@email.com', '$2a$07$asxx54ahjppf45sd87a5auJRR6foEJ7ynpjisKtbiKJbvJsoQ8VPS', '(477) 113-1258', 'Guanajuato', 'León', 1, '2024-02-01 08:37:11', '2023-02-19 16:15:55'),
('Solic', 'Solicitante', 'Solicitante', 'vistas/img/usuarios/Solicitante/514.jpg', 'solicitante@mail.com', '$2a$07$asxx54ahjppf45sd87a5au6dvp1FCl12JI0.oJcCFq4Ni1dHoWwjy', '(477) 340-8753', 'Guanajuato', 'León', 1, '2023-09-27 23:02:33', '2023-02-19 16:14:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

CREATE TABLE `zonas` (
  `ID` varchar(100) NOT NULL,
  `mayorista` varchar(20) NOT NULL,
  `estados` text NOT NULL,
  `ciudades` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `zonas`
--

INSERT INTO `zonas` (`ID`, `mayorista`, `estados`, `ciudades`) VALUES
('Bajío', 'Pedrito', 'Guanajuato,Jalisco', 'San Miguel De Allende-Celaya-León,Guadalajara'),
('Norte', 'Pedrito', 'Nuevo León', 'Abasolo-Agualeguas-Los Aldamas'),
('Zona', 'Pedrito', 'Aguascalientes,San Luis Potosí,Zacatecas,Hidalgo', 'Aguascalientes-Asientos-Calvillo,Ahualulco-Alaquines-Aquismon,Cuauhtemoc-Huanusco,Acatlan-Acaxochitlan-Actopan');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agentes`
--
ALTER TABLE `agentes`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `carritos_dists`
--
ALTER TABLE `carritos_dists`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `carritos_mayoristas`
--
ALTER TABLE `carritos_mayoristas`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `colecciones`
--
ALTER TABLE `colecciones`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `comisiones`
--
ALTER TABLE `comisiones`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID_pedido` (`ID_pedido`),
  ADD KEY `agente` (`agente`);

--
-- Indices de la tabla `credito`
--
ALTER TABLE `credito`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `dist` (`dist`);

--
-- Indices de la tabla `cuentas_deps`
--
ALTER TABLE `cuentas_deps`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `dists`
--
ALTER TABLE `dists`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `mayoristas`
--
ALTER TABLE `mayoristas`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `pedidos_dists`
--
ALTER TABLE `pedidos_dists`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `dist` (`dist`);

--
-- Indices de la tabla `pedidos_mayoristas`
--
ALTER TABLE `pedidos_mayoristas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `mayorista` (`mayorista`);

--
-- Indices de la tabla `productos_fab`
--
ALTER TABLE `productos_fab`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `coleccion` (`coleccion`),
  ADD KEY `categoria` (`categorias`);

--
-- Indices de la tabla `productos_mayorista`
--
ALTER TABLE `productos_mayorista`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `solicitantes`
--
ALTER TABLE `solicitantes`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `solicitudes_de_credito`
--
ALTER TABLE `solicitudes_de_credito`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `dist` (`dist`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Indices de la tabla `zonas`
--
ALTER TABLE `zonas`
  ADD PRIMARY KEY (`ID`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `agentes`
--
ALTER TABLE `agentes`
  ADD CONSTRAINT `agentes_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `usuarios` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dists`
--
ALTER TABLE `dists`
  ADD CONSTRAINT `dists_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `usuarios` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mayoristas`
--
ALTER TABLE `mayoristas`
  ADD CONSTRAINT `mayoristas_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `usuarios` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos_dists`
--
ALTER TABLE `pedidos_dists`
  ADD CONSTRAINT `pedidos_dists_ibfk_1` FOREIGN KEY (`dist`) REFERENCES `dists` (`ID`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos_mayoristas`
--
ALTER TABLE `pedidos_mayoristas`
  ADD CONSTRAINT `pedidos_mayoristas_ibfk_1` FOREIGN KEY (`mayorista`) REFERENCES `mayoristas` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos_fab`
--
ALTER TABLE `productos_fab`
  ADD CONSTRAINT `productos_fab_ibfk_1` FOREIGN KEY (`coleccion`) REFERENCES `colecciones` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `solicitantes`
--
ALTER TABLE `solicitantes`
  ADD CONSTRAINT `solicitantes_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `usuarios` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
