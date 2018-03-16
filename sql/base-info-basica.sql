-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 07-03-2018 a las 21:36:46
-- Versión del servidor: 5.7.17-log
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `base`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cat2_productos`
--

CREATE TABLE `tbl_cat2_productos` (
  `cat2_productos_id` int(5) NOT NULL,
  `cat2_productos_titulo` varchar(150) DEFAULT NULL,
  `cat2_productos_titulo_corto` varchar(100) DEFAULT NULL,
  `cat2_productos_keyws` text,
  `cat2_productos_padre` int(5) UNSIGNED NOT NULL DEFAULT '0',
  `cat2_productos_copete` varchar(255) DEFAULT NULL,
  `cat2_productos_destacado` tinyint(1) DEFAULT NULL,
  `cat2_productos_estado` tinyint(1) DEFAULT '0',
  `cat2_productos_archivo_url` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cat2_secciones`
--

CREATE TABLE `tbl_cat2_secciones` (
  `cat2_secciones_id` int(5) NOT NULL,
  `cat2_secciones_titulo` varchar(150) DEFAULT NULL,
  `cat2_secciones_titulo_corto` varchar(100) DEFAULT NULL,
  `cat2_secciones_keyws` text,
  `cat2_secciones_padre` int(5) UNSIGNED NOT NULL DEFAULT '0',
  `cat2_secciones_copete` varchar(255) DEFAULT NULL,
  `cat2_secciones_destacado` tinyint(1) DEFAULT NULL,
  `cat2_secciones_estado` tinyint(1) DEFAULT '0',
  `cat2_secciones_archivo_url` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cat_noticias`
--

CREATE TABLE `tbl_cat_noticias` (
  `cat_noticias_id` int(5) NOT NULL,
  `cat_noticias_titulo` varchar(150) DEFAULT NULL,
  `cat_noticias_titulo_corto` varchar(100) DEFAULT NULL,
  `cat_noticias_keyws` text,
  `cat_noticias_padre` int(5) UNSIGNED NOT NULL DEFAULT '0',
  `cat_noticias_copete` varchar(255) DEFAULT NULL,
  `cat_noticias_destacado` tinyint(1) DEFAULT NULL,
  `cat_noticias_estado` tinyint(1) DEFAULT '0',
  `cat_noticias_archivo_url` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cat_productos`
--

CREATE TABLE `tbl_cat_productos` (
  `cat_productos_id` int(5) NOT NULL,
  `cat_productos_titulo` varchar(150) DEFAULT NULL,
  `cat_productos_titulo_corto` varchar(100) DEFAULT NULL,
  `cat_productos_keyws` text,
  `cat_productos_padre` int(5) UNSIGNED NOT NULL DEFAULT '0',
  `cat_productos_copete` varchar(255) DEFAULT NULL,
  `cat_productos_destacado` tinyint(1) DEFAULT NULL,
  `cat_productos_estado` tinyint(1) DEFAULT '0',
  `cat_productos_archivo_url` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_clientes`
--

CREATE TABLE `tbl_clientes` (
  `clientes_id` smallint(5) UNSIGNED NOT NULL,
  `clientes_categoria` int(5) DEFAULT '0',
  `clientes_nombre` varchar(255) DEFAULT NULL,
  `clientes_apellido` varchar(100) DEFAULT NULL,
  `clientes_razon_social` varchar(150) DEFAULT '',
  `clientes_email` varchar(150) DEFAULT NULL,
  `clientes_telefono` varchar(150) DEFAULT '',
  `clientes_domicilio` varchar(255) DEFAULT '',
  `clientes_cp` varchar(8) DEFAULT '',
  `clientes_localidad` varchar(150) DEFAULT NULL,
  `clientes_provincia` varchar(150) DEFAULT NULL,
  `clientes_pais` varchar(100) DEFAULT NULL,
  `clientes_cuit` varchar(15) DEFAULT '',
  `clientes_iva` varchar(60) DEFAULT '',
  `clientes_cuerpo` text,
  `clientes_fecha_alta` date DEFAULT NULL,
  `clientes_fecha_baja` date DEFAULT NULL,
  `clientes_estado` tinyint(1) DEFAULT '1' COMMENT '0:baja / 10: cliente / 20:en curso / 30:consultó / 40:nota_vendedor',
  `clientes_vistas` int(11) DEFAULT '0',
  `clientes_gal1` tinyint(1) DEFAULT '0',
  `clientes_usuario` varchar(50) DEFAULT NULL,
  `clientes_clave` varchar(50) DEFAULT 'clave',
  `clientes_cambio_clave` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_consultas`
--

CREATE TABLE `tbl_consultas` (
  `consultas_id` int(10) NOT NULL,
  `consultas_nombre` varchar(60) DEFAULT NULL,
  `consultas_empresa` varchar(255) DEFAULT NULL,
  `consultas_email` varchar(60) DEFAULT NULL,
  `consultas_direccion` varchar(100) DEFAULT NULL,
  `consultas_localidad` varchar(60) DEFAULT NULL,
  `consultas_provincia` varchar(60) DEFAULT NULL,
  `consultas_codigo_postal` varchar(20) DEFAULT NULL,
  `consultas_pais` varchar(60) DEFAULT NULL,
  `consultas_telefono` varchar(30) DEFAULT NULL,
  `consultas_consulta` text,
  `consultas_fecha` datetime DEFAULT NULL,
  `consultas_asunto` varchar(50) DEFAULT NULL,
  `consultas_campo1` varchar(100) DEFAULT NULL,
  `consultas_campo2` varchar(100) DEFAULT NULL,
  `consultas_campo3` varchar(100) DEFAULT NULL,
  `consultas_campo4` varchar(100) DEFAULT NULL,
  `consultas_categoria` tinyint(1) DEFAULT '1',
  `consultas_estado` tinyint(1) DEFAULT '1',
  `consultas_enviado` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_intentos`
--

CREATE TABLE `tbl_intentos` (
  `intento_id` int(5) NOT NULL,
  `intento_exitoso` tinyint(1) NOT NULL,
  `intento_usuario` varchar(40) DEFAULT NULL,
  `intento_clave` varchar(40) DEFAULT NULL,
  `intento_ip` varchar(60) NOT NULL,
  `intento_fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_login`
--

CREATE TABLE `tbl_login` (
  `login_id` int(5) NOT NULL,
  `login_usuario` varchar(20) NOT NULL,
  `login_clave` varchar(50) NOT NULL,
  `login_tipo` int(1) NOT NULL,
  `login_lastsessid` varchar(100) NOT NULL,
  `login_nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_login`
--

INSERT INTO `tbl_login` (`login_id`, `login_usuario`, `login_clave`, `login_tipo`, `login_lastsessid`, `login_nombre`) VALUES
(1, 'julianNNss', 'a8f5f167f44f4964e6c998dee827110c', 1, '', 'Julián Gómara'),
(3, 'norberto', '2c8dceaea1789967b4378d4d838fb7c3', 1, '', 'Norberto Lanosa'),
(4, 'ariel', 'fac7f52732925af83c335564f193a842', 1, '', 'Ariel Giral');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_noticias`
--

CREATE TABLE `tbl_noticias` (
  `noticias_id` smallint(5) UNSIGNED NOT NULL,
  `noticias_categoria` int(5) DEFAULT '0',
  `noticias_categoria2` int(5) DEFAULT '1',
  `noticias_titulo` varchar(255) DEFAULT NULL,
  `noticias_titulo_corto` varchar(100) DEFAULT NULL,
  `noticias_icono` varchar(50) DEFAULT NULL,
  `noticias_copete` varchar(255) DEFAULT NULL,
  `noticias_keyws` text,
  `noticias_codigo` varchar(15) DEFAULT NULL,
  `noticias_cuerpo` text,
  `noticias_precio` decimal(10,2) DEFAULT NULL,
  `noticias_precio_promo` decimal(10,2) DEFAULT '0.00',
  `noticias_precio_mayorista` decimal(10,2) DEFAULT '0.00',
  `noticias_stock` varchar(15) DEFAULT NULL,
  `noticias_stock_vendido` int(4) DEFAULT '0',
  `noticicas_stock_reservado` int(4) DEFAULT '0',
  `noticias_fecha_alta` date DEFAULT NULL,
  `noticias_fecha_baja` date DEFAULT NULL,
  `noticias_estado` tinyint(1) DEFAULT '1',
  `noticias_destacado` tinyint(1) NOT NULL DEFAULT '0',
  `noticias_restringido` tinyint(1) NOT NULL DEFAULT '0',
  `noticias_vistas` int(11) NOT NULL DEFAULT '0',
  `noticias_gal1` tinyint(1) DEFAULT '0',
  `noticias_home` tinyint(1) DEFAULT '0',
  `noticias_ubicacion_botonera` tinyint(1) DEFAULT '0',
  `noticias_archivo_url` varchar(150) DEFAULT 'index.php',
  `noticias_video_youtube` varchar(20) DEFAULT NULL,
  `noticias_orden` tinyint(2) NOT NULL DEFAULT '2',
  `noticias_idusuario` mediumint(11) DEFAULT NULL,
  `noticias_acepta_cr` int(1) DEFAULT '1',
  `noticias_costo_flete1` decimal(6,2) DEFAULT '0.00',
  `noticias_costo_flete2` decimal(6,2) DEFAULT '0.00',
  `noticias_costo_flete3` decimal(6,2) DEFAULT '0.00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_notificaciones`
--

CREATE TABLE `tbl_notificaciones` (
  `notificacion_id` int(10) NOT NULL,
  `notificacion_accion` varchar(100) NOT NULL,
  `notificacion_url` varchar(100) NOT NULL,
  `notificacion_img` varchar(100) NOT NULL,
  `notificacion_titulo` varchar(100) NOT NULL,
  `notificacion_leida` varchar(1) NOT NULL,
  `notificacion_fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos`
--

CREATE TABLE `tbl_productos` (
  `productos_id` smallint(5) UNSIGNED NOT NULL,
  `productos_categoria` int(5) NOT NULL DEFAULT '0',
  `productos_categoria2` int(5) DEFAULT '1',
  `productos_titulo` varchar(255) DEFAULT NULL,
  `productos_titulo_corto` varchar(100) DEFAULT NULL,
  `productos_icono` varchar(50) DEFAULT NULL,
  `productos_copete` varchar(255) DEFAULT NULL,
  `productos_keyws` text,
  `productos_codigo` varchar(15) DEFAULT NULL,
  `productos_cuerpo` text,
  `productos_precio` decimal(10,2) DEFAULT NULL,
  `productos_precio_promo` decimal(10,2) DEFAULT '0.00',
  `productos_precio_mayorista` decimal(10,2) DEFAULT '0.00',
  `productos_stock` varchar(15) DEFAULT NULL,
  `productos_stock_vendido` int(4) DEFAULT '0',
  `noticicas_stock_reservado` int(4) DEFAULT '0',
  `productos_fecha_alta` date DEFAULT NULL,
  `productos_fecha_baja` date DEFAULT NULL,
  `productos_estado` tinyint(1) DEFAULT '1',
  `productos_destacado` tinyint(1) NOT NULL DEFAULT '0',
  `productos_restringido` tinyint(1) NOT NULL DEFAULT '0',
  `productos_vistas` int(11) NOT NULL DEFAULT '0',
  `productos_gal1` tinyint(1) DEFAULT '0',
  `productos_home` tinyint(1) DEFAULT '0',
  `productos_ubicacion_botonera` tinyint(1) DEFAULT '0',
  `productos_archivo_url` varchar(150) DEFAULT 'index.php',
  `productos_video_youtube` varchar(20) DEFAULT NULL,
  `productos_orden` tinyint(2) NOT NULL DEFAULT '2',
  `productos_idusuario` mediumint(11) DEFAULT NULL,
  `productos_acepta_cr` int(1) DEFAULT '1',
  `productos_costo_flete1` decimal(6,2) DEFAULT '0.00',
  `productos_costo_flete2` decimal(6,2) DEFAULT '0.00',
  `productos_costo_flete3` decimal(6,2) DEFAULT '0.00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_provincias`
--

CREATE TABLE `tbl_provincias` (
  `provincias_cod_prov` int(3) NOT NULL,
  `provincias_provincia` varchar(30) NOT NULL DEFAULT '',
  `provincias_cargo_envio` double(6,3) NOT NULL DEFAULT '0.000'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_provincias`
--

INSERT INTO `tbl_provincias` (`provincias_cod_prov`, `provincias_provincia`, `provincias_cargo_envio`) VALUES
(1, 'Buenos Aires', 0.000),
(2, 'Catamarca', 0.000),
(3, 'Chaco', 0.000),
(4, 'Chubut', 0.000),
(5, 'Ciudad de Buenos Aires', 0.000),
(6, 'Cordoba', 0.000),
(7, 'Corrientes', 0.000),
(8, 'Entre Rios', 0.000),
(9, 'Formosa', 0.000),
(10, 'Jujuy', 0.000),
(11, 'La Pampa', 0.000),
(12, 'La Rioja', 0.000),
(13, 'Mendoza', 0.000),
(14, 'Misiones', 0.000),
(15, 'Neuquen', 0.000),
(16, 'Rio Negro', 0.000),
(17, 'Salta', 0.000),
(18, 'San Juan', 0.000),
(19, 'San Luis', 0.000),
(20, 'Santa Cruz', 0.000),
(21, 'Santa Fe', 0.000),
(22, 'Santiago del Estero', 0.000),
(23, 'Tierra del Fuego', 0.000),
(24, 'Tucuman', 0.000),
(25, ' Otras (fuera de Argentina)', 0.000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_secciones`
--

CREATE TABLE `tbl_secciones` (
  `secciones_id` smallint(5) UNSIGNED NOT NULL,
  `secciones_categoria` int(5) DEFAULT '0',
  `secciones_categoria2` int(5) DEFAULT '1',
  `secciones_titulo` varchar(255) DEFAULT NULL,
  `secciones_titulo_corto` varchar(100) DEFAULT NULL,
  `secciones_icono` varchar(50) DEFAULT NULL,
  `secciones_copete` varchar(255) DEFAULT NULL,
  `secciones_keyws` text,
  `secciones_codigo` varchar(15) DEFAULT NULL,
  `secciones_cuerpo` text,
  `secciones_precio` decimal(10,2) DEFAULT NULL,
  `secciones_precio_promo` decimal(10,2) DEFAULT '0.00',
  `secciones_precio_mayorista` decimal(10,2) DEFAULT '0.00',
  `secciones_stock` varchar(15) DEFAULT NULL,
  `secciones_stock_vendido` int(4) DEFAULT '0',
  `secciones_stock_reservado` int(4) DEFAULT '0',
  `secciones_fecha_alta` date DEFAULT NULL,
  `secciones_fecha_baja` date DEFAULT NULL,
  `secciones_estado` tinyint(1) DEFAULT '1',
  `secciones_destacado` tinyint(1) NOT NULL DEFAULT '0',
  `secciones_restringido` tinyint(1) NOT NULL DEFAULT '0',
  `secciones_vistas` int(11) NOT NULL DEFAULT '0',
  `secciones_gal1` tinyint(1) DEFAULT '0',
  `secciones_home` tinyint(1) DEFAULT '0',
  `secciones_ubicacion_botonera` tinyint(1) DEFAULT '0',
  `secciones_archivo_url` varchar(150) DEFAULT 'index.php',
  `secciones_video_youtube` varchar(20) DEFAULT NULL,
  `secciones_orden` tinyint(2) NOT NULL DEFAULT '2',
  `secciones_idusuario` mediumint(11) DEFAULT NULL,
  `secciones_acepta_cr` int(1) DEFAULT '1',
  `secciones_costo_flete1` decimal(6,2) DEFAULT '0.00',
  `secciones_costo_flete2` decimal(6,2) DEFAULT '0.00',
  `secciones_costo_flete3` decimal(6,2) DEFAULT '0.00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_secciones`
--

INSERT INTO `tbl_secciones` (`secciones_id`, `secciones_categoria`, `secciones_categoria2`, `secciones_titulo`, `secciones_titulo_corto`, `secciones_icono`, `secciones_copete`, `secciones_keyws`, `secciones_codigo`, `secciones_cuerpo`, `secciones_precio`, `secciones_precio_promo`, `secciones_precio_mayorista`, `secciones_stock`, `secciones_stock_vendido`, `secciones_stock_reservado`, `secciones_fecha_alta`, `secciones_fecha_baja`, `secciones_estado`, `secciones_destacado`, `secciones_restringido`, `secciones_vistas`, `secciones_gal1`, `secciones_home`, `secciones_ubicacion_botonera`, `secciones_archivo_url`, `secciones_video_youtube`, `secciones_orden`, `secciones_idusuario`, `secciones_acepta_cr`, `secciones_costo_flete1`, `secciones_costo_flete2`, `secciones_costo_flete3`) VALUES
(1, 0, NULL, 'INICIO', NULL, NULL, '', NULL, NULL, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n', NULL, '0.00', '0.00', NULL, 0, 0, '2018-03-07', NULL, 1, 0, 0, 0, 0, 0, 0, 'index.php', NULL, 2, 4, 1, '0.00', '0.00', '0.00'),
(2, 0, NULL, 'QUIENES SOMOS', NULL, NULL, '', NULL, NULL, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n', NULL, '0.00', '0.00', NULL, 0, 0, '2018-03-07', NULL, 1, 0, 0, 0, 0, 0, 0, 'index.php', NULL, 2, 4, 1, '0.00', '0.00', '0.00'),
(3, 0, NULL, 'PRODUCTOS', NULL, NULL, '', NULL, NULL, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n', NULL, '0.00', '0.00', NULL, 0, 0, '2018-03-07', NULL, 1, 0, 0, 0, 0, 0, 0, 'index.php', NULL, 2, 4, 1, '0.00', '0.00', '0.00'),
(4, 0, NULL, 'SERVICIOS', NULL, NULL, '', NULL, NULL, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n', NULL, '0.00', '0.00', NULL, 0, 0, '2018-03-07', NULL, 1, 0, 0, 0, 0, 0, 0, 'index.php', NULL, 2, 4, 1, '0.00', '0.00', '0.00'),
(5, 0, NULL, 'UBICACION', NULL, NULL, '', NULL, NULL, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n', NULL, '0.00', '0.00', NULL, 0, 0, '2018-03-07', NULL, 1, 0, 0, 0, 0, 0, 0, 'index.php', NULL, 2, 4, 1, '0.00', '0.00', '0.00'),
(10, 0, NULL, 'CONTACTO', NULL, NULL, '', NULL, NULL, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n', NULL, '0.00', '0.00', NULL, 0, 0, '2018-03-07', NULL, 1, 0, 0, 0, 0, 0, 0, 'index.php', NULL, 2, 4, 1, '0.00', '0.00', '0.00'),
(11, 25, 0, 'CONTACTO Ok', '', '', '', NULL, '', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>', '0.00', '0.00', '0.00', '', 0, 0, '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 'index.php', '', 2, 4, 1, '0.00', '0.00', '0.00'),
(20, 0, NULL, 'Secciones Interiores Index', NULL, NULL, '', NULL, NULL, '<p>.</p>\r\n', NULL, '0.00', '0.00', NULL, 0, 0, '2018-03-07', NULL, 0, 0, 0, 0, 0, 0, 0, 'index.php', NULL, 2, 4, 1, '0.00', '0.00', '0.00'),
(21, 20, NULL, 'Footer', NULL, NULL, '', NULL, NULL, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie</p>\r\n', NULL, '0.00', '0.00', NULL, 0, 0, '2018-03-07', NULL, 0, 0, 0, 0, 0, 0, 0, 'index.php', NULL, 2, 4, 1, '0.00', '0.00', '0.00'),
(22, 20, NULL, 'Info Extra 1', NULL, NULL, '', NULL, NULL, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n', NULL, '0.00', '0.00', NULL, 0, 0, '2018-03-07', NULL, 0, 0, 0, 0, 0, 0, 0, 'index.php', NULL, 2, 4, 1, '0.00', '0.00', '0.00'),
(23, 20, 0, 'Info Extra 2', '', '', '', NULL, '', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>', '0.00', '0.00', '0.00', '', 0, 0, '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 'index.php', '', 2, 4, 1, '0.00', '0.00', '0.00'),
(24, 20, 0, 'Info Extra 3', '', '', '', NULL, '', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>', '0.00', '0.00', '0.00', '', 0, 0, '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 'index.php', '', 2, 4, 1, '0.00', '0.00', '0.00'),
(25, 0, NULL, 'Secciones Interiores Funcionales', NULL, NULL, '', NULL, NULL, '<p>.</p>\r\n', NULL, '0.00', '0.00', NULL, 0, 0, '2018-03-07', NULL, 0, 0, 0, 0, 0, 0, 0, 'index.php', NULL, 2, 4, 1, '0.00', '0.00', '0.00'),
(26, 25, NULL, 'LOGIN/ALTA', NULL, NULL, '', NULL, NULL, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n', NULL, '0.00', '0.00', NULL, 0, 0, '2018-03-07', NULL, 0, 0, 0, 0, 0, 0, 0, 'index.php', NULL, 2, 4, 1, '0.00', '0.00', '0.00'),
(27, 25, NULL, 'LOGIN OK', NULL, NULL, '', NULL, NULL, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n', NULL, '0.00', '0.00', NULL, 0, 0, '2018-03-07', NULL, 0, 0, 0, 0, 0, 0, 0, 'index.php', NULL, 2, 4, 1, '0.00', '0.00', '0.00'),
(28, 25, 0, 'ALTA OK', '', '', '', NULL, '', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>', '0.00', '0.00', '0.00', '', 0, 0, '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 'index.php', '', 2, 4, 1, '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_webinfo`
--

CREATE TABLE `tbl_webinfo` (
  `info_id` int(3) NOT NULL,
  `info_titulo` varchar(60) NOT NULL,
  `info_descripcion` text NOT NULL,
  `info_email` varchar(60) NOT NULL,
  `info_empresa` text NOT NULL,
  `info_terminos` text,
  `info_googlemap` text NOT NULL,
  `info_mantenimiento` tinyint(1) NOT NULL,
  `info_carro` tinyint(1) NOT NULL,
  `info_mp` int(1) NOT NULL,
  `mp_client_id` varchar(100) DEFAULT NULL,
  `mp_client_secret` varchar(1000) DEFAULT NULL,
  `info_ctadigital` int(1) NOT NULL,
  `ctadigital_id` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_webinfo`
--

INSERT INTO `tbl_webinfo` (`info_id`, `info_titulo`, `info_descripcion`, `info_email`, `info_empresa`, `info_terminos`, `info_googlemap`, `info_mantenimiento`, `info_carro`, `info_mp`, `mp_client_id`, `mp_client_secret`, `info_ctadigital`, `ctadigital_id`) VALUES
(1, 'Página Base', 'Páginas Base', 'info@base.com.ar', '', '', '', 0, 0, 0, NULL, NULL, 0, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_cat2_productos`
--
ALTER TABLE `tbl_cat2_productos`
  ADD PRIMARY KEY (`cat2_productos_id`);

--
-- Indices de la tabla `tbl_cat2_secciones`
--
ALTER TABLE `tbl_cat2_secciones`
  ADD PRIMARY KEY (`cat2_secciones_id`);

--
-- Indices de la tabla `tbl_cat_noticias`
--
ALTER TABLE `tbl_cat_noticias`
  ADD PRIMARY KEY (`cat_noticias_id`);

--
-- Indices de la tabla `tbl_cat_productos`
--
ALTER TABLE `tbl_cat_productos`
  ADD PRIMARY KEY (`cat_productos_id`);

--
-- Indices de la tabla `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  ADD PRIMARY KEY (`clientes_id`),
  ADD KEY `clientes_id` (`clientes_id`);

--
-- Indices de la tabla `tbl_consultas`
--
ALTER TABLE `tbl_consultas`
  ADD PRIMARY KEY (`consultas_id`);

--
-- Indices de la tabla `tbl_intentos`
--
ALTER TABLE `tbl_intentos`
  ADD PRIMARY KEY (`intento_id`);

--
-- Indices de la tabla `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indices de la tabla `tbl_noticias`
--
ALTER TABLE `tbl_noticias`
  ADD PRIMARY KEY (`noticias_id`);

--
-- Indices de la tabla `tbl_notificaciones`
--
ALTER TABLE `tbl_notificaciones`
  ADD PRIMARY KEY (`notificacion_id`);

--
-- Indices de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD PRIMARY KEY (`productos_id`);

--
-- Indices de la tabla `tbl_provincias`
--
ALTER TABLE `tbl_provincias`
  ADD PRIMARY KEY (`provincias_cod_prov`);

--
-- Indices de la tabla `tbl_secciones`
--
ALTER TABLE `tbl_secciones`
  ADD PRIMARY KEY (`secciones_id`);

--
-- Indices de la tabla `tbl_webinfo`
--
ALTER TABLE `tbl_webinfo`
  ADD PRIMARY KEY (`info_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_cat2_productos`
--
ALTER TABLE `tbl_cat2_productos`
  MODIFY `cat2_productos_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_cat2_secciones`
--
ALTER TABLE `tbl_cat2_secciones`
  MODIFY `cat2_secciones_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_cat_noticias`
--
ALTER TABLE `tbl_cat_noticias`
  MODIFY `cat_noticias_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_cat_productos`
--
ALTER TABLE `tbl_cat_productos`
  MODIFY `cat_productos_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  MODIFY `clientes_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_consultas`
--
ALTER TABLE `tbl_consultas`
  MODIFY `consultas_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_intentos`
--
ALTER TABLE `tbl_intentos`
  MODIFY `intento_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `login_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `tbl_noticias`
--
ALTER TABLE `tbl_noticias`
  MODIFY `noticias_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_notificaciones`
--
ALTER TABLE `tbl_notificaciones`
  MODIFY `notificacion_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  MODIFY `productos_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_provincias`
--
ALTER TABLE `tbl_provincias`
  MODIFY `provincias_cod_prov` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `tbl_secciones`
--
ALTER TABLE `tbl_secciones`
  MODIFY `secciones_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `tbl_webinfo`
--
ALTER TABLE `tbl_webinfo`
  MODIFY `info_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
