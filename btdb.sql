-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-06-2015 a las 19:26:44
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `btdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abono`
--

CREATE TABLE IF NOT EXISTS `abono` (
`id` int(11) NOT NULL,
  `valor` double DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `multa_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `abono`
--

INSERT INTO `abono` (`id`, `valor`, `estado`, `multa_id`) VALUES
(1, 500, 2, 1),
(2, 3500, 2, 1),
(3, 200, 2, 2),
(4, 1000, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloqueo_libro`
--

CREATE TABLE IF NOT EXISTS `bloqueo_libro` (
`id` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL,
  `observacion` varchar(255) NOT NULL,
  `libro_id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `bloqueo_libro`
--

INSERT INTO `bloqueo_libro` (`id`, `fecha_inicio`, `estado`, `observacion`, `libro_id`, `persona_id`) VALUES
(1, '2015-05-20', 2, 'no esta en biblioteca', 1, 3),
(2, '2015-05-20', 2, 'por que si', 3, 3),
(3, '2015-05-21', 2, 'por que esta en reparacion', 1, 3),
(4, '2015-05-26', 2, 'potfghjk', 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloqueo_persona`
--

CREATE TABLE IF NOT EXISTS `bloqueo_persona` (
`id` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL,
  `observacion` mediumtext NOT NULL,
  `persona_id` int(11) NOT NULL,
  `persona_id1` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `bloqueo_persona`
--

INSERT INTO `bloqueo_persona` (`id`, `fecha_inicio`, `estado`, `observacion`, `persona_id`, `persona_id1`) VALUES
(4, '2015-05-14', 2, 'multa pendiente, debe cancelar lo restante', 9, 3),
(5, '2015-05-19', 2, 'quedo mal en los pagos', 3, 3),
(6, '2015-05-19', 2, 'por que quiero', 3, 3),
(7, '2015-05-19', 2, 'por que no devolvio el libro', 2, 3),
(8, '2015-05-19', 2, 'daÃ±o el libro', 2, 3),
(9, '2015-05-19', 2, 'se hizo merecedor de multa y no la pago', 9, 3),
(10, '2015-05-20', 2, 'ok', 3, 3),
(11, '2015-05-20', 2, 'multa pendiente, debe cancelar lo restante', 3, 3),
(12, '2015-05-20', 2, 'no trajo carnet', 3, 3),
(13, '2015-06-09', 2, 'por que me dio la gana', 3, 3),
(14, '2015-06-09', 2, 'multa pendiente, debe cancelar lo restante', 2, 3),
(15, '2015-06-16', 2, 'multa pendiente, debe cancelar lo restante', 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE IF NOT EXISTS `calificacion` (
`id` int(11) NOT NULL,
  `numero_estrellas` int(11) DEFAULT NULL,
  `favorito` tinyint(1) DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL,
  `persona_id` int(11) NOT NULL,
  `libro_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
`id` int(11) NOT NULL,
  `descripcion` blob,
  `persona_id` int(11) NOT NULL,
  `libro_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias_festivo`
--

CREATE TABLE IF NOT EXISTS `dias_festivo` (
`id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dias_festivo`
--

INSERT INTO `dias_festivo` (`id`, `fecha`) VALUES
(1, '0000-00-00'),
(2, '2015-01-13'),
(3, '2015-02-02'),
(4, '2015-03-10'),
(5, '2015-06-08'),
(6, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
`id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `grado` varchar(45) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id`, `nombre`, `grado`, `fecha_inicio`, `fecha_fin`) VALUES
(1, 'default', 'null', '0000-00-00', '0000-00-00'),
(2, 'Primero Uno', '1-1', '0000-00-00', '0000-00-00'),
(3, 'primero Dos', '1-2', '0000-00-00', '0000-00-00'),
(4, 'primero Tres', '1-3', '0000-00-00', '0000-00-00'),
(5, 'Segundo Uno', '2-1', '0000-00-00', '0000-00-00'),
(7, 'Segundo Tres', '2-3', '2015-02-02', '2015-02-12'),
(8, 'Segundo Dos', '2-2', '2015-02-04', '2015-02-26'),
(9, 'Tercero Uno', '3-1', '2015-02-05', '2015-11-15'),
(10, 'Once', '11', '2015-03-07', '2015-03-07'),
(11, 'Tercero Dos', '3-2', '2015-03-16', '2015-03-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE IF NOT EXISTS `imagen` (
`id` int(11) NOT NULL,
  `img` longblob NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `persona_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE IF NOT EXISTS `libro` (
`id` int(11) NOT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `clasificacion` varchar(45) DEFAULT NULL,
  `isbn` varchar(45) DEFAULT NULL,
  `editorial` varchar(45) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `autor` varchar(45) DEFAULT NULL,
  `area` varchar(45) DEFAULT NULL,
  `tema` varchar(45) DEFAULT NULL,
  `estado_fisico` smallint(6) DEFAULT NULL,
  `tipo` smallint(6) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `descripcion` longtext,
  `palabras_clave` longtext,
  `modalidad` smallint(6) DEFAULT NULL,
  `persona_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`id`, `codigo`, `clasificacion`, `isbn`, `editorial`, `nombre`, `autor`, `area`, `tema`, `estado_fisico`, `tipo`, `estado`, `descripcion`, `palabras_clave`, `modalidad`, `persona_id`) VALUES
(1, '6.608', '001.54M17C', '84-481-0267-3', 'McGRAW-HILL', 'Camino Al futuro', 'Bill Gates', '6', 'Informatica', 2, 1, 1, 'sfsgdhfjgfhgsf', 'fdfgfhgjwqWGDHSW', 1, 3),
(3, '3.961', '001.64.951I60', '958-9498-24-8', 'PHC', 'El Mundo y Sus Demonios', 'JosÃ© Francisco Amador MontaÃ±o', '6', 'Informatica', 3, 2, 1, 'asadfhjhk', 'sdfghjklÃ±', 2, 3),
(4, '3.299', '107.G17EJ3', '958-02-0216-8', 'VOLUNTAD S.A', 'Pensemos 10', 'Fabio Garcia Ortiz - Francisco De La Parra L.', '4', 'Filosofia 10', 3, 1, 1, 'este libro habla de la filosofia', 'filosofia, pensamientos, decimo', 1, 5),
(5, '2345', 'asserdty', 'sdfsghjgfds', 'sdfghfd', 'dfghhjgds', 'asdfghgfds', '1', 'sdfghjgdf', 4, 2, 0, 'EARSUIOPITYERAWERRTYITUREAWQetyreweryygfdewrtfjtyersyjgytrsaetgjkvftsretyjyutertyjycxzerhfctterrttyerertrtertjkytytrtyugitryytytdtyufytfdgfjkliluytdsraweryfyuctszrtryufytdrsetryuyfdxrstyctxrstcvu', 'fgfhjhjfcdzsdrstyucxszetrcyvcdxresdtdfjhgfdsdfghjkjhgzdxfjhsgdfjhsgdftyhdgsgrtyuukjhgfdfghjkjhgfdsdfuiuytreertyjkjhgfdertyuytressdjkjhgfdssdfghjkjhgfdssdfghjkkjhfdsdfghjkkjhgfdsdfghjkjhgfdsdfhjklkjhgfdfghjkkjhgfdfghjkjhgfdsdfghjjhgfd', 2, 3),
(6, '1.129', '1234454', '84-481-0267-3', 'Planeta Colombia', 'Camino Al futuro', 'Fabio Garcia Ortiz - Francisco De La Parra L.', '2', 'fsdfg', 5, 1, 1, 'sqfhjkjgefaghhkjhghfgsssssssssssss', 'gssssssssssssssssfsssssssssssgsgsgsgsgsg', 2, 3),
(7, '0990', '12', '978-970-26-1190-5', 'pearson education', 'java como programar', 'luis', '6', 'Informatica', 1, 1, 1, 'es el lenguaje de programacion orientada a objetos mas popular con mas de 5 millones de desarrolladores', 'java,programacion', 1, 6),
(10, '6.360', '869.4 S243', '958-704-242-5', 'Punto de lectura', 'El hombre duplicado', 'JosÃ© Saramago', '5', 'Superacion', 2, 1, 1, 'Este libro trata de un hombre duplicado', 'superacion, literatura', 1, 3),
(11, '1234', 'szdxfhgjh', 'dsftfyui', 'asdfghjhfds', '<sdfghjkgfdsa', '<sdfhjgdsa', '2', 'asdfghjjhdsa', 4, 1, 0, 'asdfghjkljftseaA', 'DFDTFUIUYTREW', 1, 3),
(12, '6912', '823.8 W 45 N', '978-958-30-0143-7', 'Panamericana', 'El retrato de dorian grey', 'Oscar Wilde', '5', 'Literatura universal', 2, 1, 1, 'El retrato donde la ruiqueza fantastica halla su expresion mas adecuada', 'oscar, wilde, literatura,', 1, 3),
(13, '6.666', 'OF-DT-89-06-YH', '84-8280-932-6', 'CARVAJAL S.A', 'Los piratas de la malasia', 'Emilio Salgari', '5', 'Piratas', 2, 1, 1, 'este libro trata de poratas antiguos', 'piratas, malasio, emilio, salgari', 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multa`
--

CREATE TABLE IF NOT EXISTS `multa` (
`id` int(11) NOT NULL,
  `valor` double DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_corte` date DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL,
  `persona_id` int(11) NOT NULL,
  `prestamo_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `multa`
--

INSERT INTO `multa` (`id`, `valor`, `fecha_inicio`, `fecha_corte`, `estado`, `persona_id`, `prestamo_id`) VALUES
(1, 4000, '2015-05-21', '0000-00-00', 2, 2, 153),
(2, 1200, '2015-06-11', '0000-00-00', 2, 2, 155);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parentesco`
--

CREATE TABLE IF NOT EXISTS `parentesco` (
`id` int(11) NOT NULL,
  `estado` smallint(6) DEFAULT NULL,
  `persona_id` int(11) NOT NULL,
  `persona_id1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
`id` int(11) NOT NULL,
  `codigo` double DEFAULT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `sexo` smallint(6) NOT NULL,
  `tipo_documento` smallint(6) DEFAULT NULL,
  `numero_documento` varchar(45) DEFAULT NULL,
  `mail` varchar(45) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `perfil` smallint(6) DEFAULT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `clave` varchar(45) DEFAULT NULL,
  `grupo_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `codigo`, `nombres`, `apellidos`, `sexo`, `tipo_documento`, `numero_documento`, `mail`, `celular`, `telefono`, `estado`, `perfil`, `usuario`, `clave`, `grupo_id`) VALUES
(2, 7788, 'Caroline', 'Zamora', 2, 1, '1053848784', 'kadia96@hotmail.com', '3117201253', '8912752', 1, 2, 'Caroo', '202cb962ac59075b964b07152d234b70', 2),
(3, 4071, 'Jorge Luis', 'OrdoÃ±ez Ospina', 1, 1, '1053841556', 'jorgeluissito@gmail.com', '3148682411', '8900000', 1, 1, 'jorge.lordonez', '202cb962ac59075b964b07152d234b70', 1),
(5, 123, 'Alan Brito', 'delgado', 1, 1, '12345678', 'alanbritodelgadito@hotmail.com', '123456', '12345', 1, 3, 'alanbrito.delgado', '202cb962ac59075b964b07152d234b70', 1),
(6, 4664, 'Diego Alejandro', 'Usma Lozanno', 1, 1, '1053832679', 'dialeus263@gmail.com', '3113646987', '8880284', 1, 1, 'diego.ausma', '202cb962ac59075b964b07152d234b70', 1),
(9, 6543, 'Juan Camilo', 'Aristizabal Hincapie', 1, 2, '97061619686', 'camiloa-1997@hotmail.com', '3206634951', '8654543', 2, 2, 'juancamilo.ahincapie', '202cb962ac59075b964b07152d234b70', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE IF NOT EXISTS `prestamo` (
`id` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_corte` date DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL,
  `libro_id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `persona_id1` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `prestamo`
--

INSERT INTO `prestamo` (`id`, `fecha_inicio`, `fecha_corte`, `estado`, `libro_id`, `persona_id`, `persona_id1`) VALUES
(148, '2015-05-27', '2015-06-16', 2, 1, 3, 3),
(149, '2015-05-27', '2015-06-16', 2, 10, 3, 3),
(150, '2015-05-27', '2015-06-16', 2, 10, 3, 3),
(151, '2015-05-27', '2015-06-16', 2, 10, 3, 3),
(152, '2015-05-27', '2015-06-16', 2, 4, 2, 3),
(153, '2015-06-09', '2015-05-20', 2, 1, 2, 3),
(154, '2015-06-09', '2015-06-29', 2, 7, 2, 3),
(155, '2015-06-16', '2015-06-10', 2, 1, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `renovacion`
--

CREATE TABLE IF NOT EXISTS `renovacion` (
`id` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_corte` date DEFAULT NULL,
  `numero_renovacion` smallint(6) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `prestamo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservacion`
--

CREATE TABLE IF NOT EXISTS `reservacion` (
`id` int(11) NOT NULL,
  `opcion` smallint(6) DEFAULT NULL,
  `fecha_reservacion` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `persona_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservacion_libro`
--

CREATE TABLE IF NOT EXISTS `reservacion_libro` (
`id` int(11) NOT NULL,
  `fecha_reservacion` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `persona_id` int(11) NOT NULL,
  `libro_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reservacion_libro`
--

INSERT INTO `reservacion_libro` (`id`, `fecha_reservacion`, `fecha_fin`, `estado`, `persona_id`, `libro_id`) VALUES
(12, '2015-05-26', '2015-05-28', 2, 3, 10),
(13, '2015-05-26', '2015-05-28', 2, 3, 10),
(14, '2015-05-26', '2015-05-28', 2, 3, 1),
(15, '2015-05-27', '2015-05-29', 2, 3, 10),
(16, '2015-05-27', '2015-05-29', 2, 3, 10),
(17, '2015-05-27', '2015-05-29', 2, 3, 1),
(18, '2015-05-27', '2015-05-29', 2, 3, 1),
(19, '2015-05-27', '2015-05-26', 2, 3, 1),
(20, '2015-05-27', '2015-05-26', 2, 3, 1),
(21, '2015-05-27', '2015-05-26', 2, 3, 1),
(22, '2015-05-27', '2015-05-29', 2, 3, 1),
(23, '2015-05-27', '2015-05-29', 2, 2, 4),
(24, '2015-06-09', '2015-06-11', 2, 2, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subtitulo`
--

CREATE TABLE IF NOT EXISTS `subtitulo` (
`id` int(11) NOT NULL,
  `descripcion` longtext,
  `titulo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subtitulo_1`
--

CREATE TABLE IF NOT EXISTS `subtitulo_1` (
`id` int(11) NOT NULL,
  `descripcion` longtext,
  `subtitulo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subtitulo_2`
--

CREATE TABLE IF NOT EXISTS `subtitulo_2` (
`id` int(11) NOT NULL,
  `descripcion` longtext,
  `subtitulo_1_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subtitulo_3`
--

CREATE TABLE IF NOT EXISTS `subtitulo_3` (
`id` int(11) NOT NULL,
  `descripcion` longtext,
  `subtitulo_2_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulo`
--

CREATE TABLE IF NOT EXISTS `titulo` (
`id` int(11) NOT NULL,
  `descripcion` longtext,
  `libro_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trueque`
--

CREATE TABLE IF NOT EXISTS `trueque` (
  `id` int(11) NOT NULL,
  `disponibilidad` tinyint(1) DEFAULT NULL,
  `libro_id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE IF NOT EXISTS `ubicacion` (
`id` int(11) NOT NULL,
  `sala` smallint(6) DEFAULT NULL,
  `estante` int(11) DEFAULT NULL,
  `fila` int(11) DEFAULT NULL,
  `columna` int(11) DEFAULT NULL,
  `area` int(45) DEFAULT NULL,
  `libro_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`id`, `sala`, `estante`, `fila`, `columna`, `area`, `libro_id`) VALUES
(15, 2, 1, 1, 1, 3, 1),
(16, 2, 1, 1, 1, 3, 3),
(17, 2, 1, 4, 3, 5, 5),
(18, 1, 3, 4, 2, 3, 7),
(19, 2, 9, 3, 6, 7, 4),
(20, 2, 10, 3, 2, 4, 10),
(21, 2, 4, 3, 2, 4, 11),
(22, 2, 5, 2, 4, 4, 12);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abono`
--
ALTER TABLE `abono`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_abono_multa1_idx` (`multa_id`);

--
-- Indices de la tabla `bloqueo_libro`
--
ALTER TABLE `bloqueo_libro`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_bloqueo_libro_libro1_idx` (`libro_id`), ADD KEY `fk_bloqueo_libro_persona1_idx` (`persona_id`);

--
-- Indices de la tabla `bloqueo_persona`
--
ALTER TABLE `bloqueo_persona`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_bloqueo_persona_idx` (`persona_id`), ADD KEY `fk_bloqueo_persona_persona1_idx` (`persona_id1`);

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_calificacion_persona1_idx` (`persona_id`), ADD KEY `fk_calificacion_libro1_idx` (`libro_id`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_comentario_persona1_idx` (`persona_id`), ADD KEY `fk_comentario_libro1_idx` (`libro_id`);

--
-- Indices de la tabla `dias_festivo`
--
ALTER TABLE `dias_festivo`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_libro_persona1_idx` (`persona_id`);

--
-- Indices de la tabla `multa`
--
ALTER TABLE `multa`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_multa_persona1_idx` (`persona_id`), ADD KEY `fk_multa_prestamo1_idx` (`prestamo_id`);

--
-- Indices de la tabla `parentesco`
--
ALTER TABLE `parentesco`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_parentezco_persona1_idx` (`persona_id`), ADD KEY `fk_parentezco_persona2_idx` (`persona_id1`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_persona_grupo1_idx` (`grupo_id`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_prestamo_libro1_idx` (`libro_id`), ADD KEY `fk_prestamo_persona1_idx` (`persona_id`), ADD KEY `fk_prestamo_persona2_idx` (`persona_id1`);

--
-- Indices de la tabla `renovacion`
--
ALTER TABLE `renovacion`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_renovacion_prestamo1_idx` (`prestamo_id`);

--
-- Indices de la tabla `reservacion`
--
ALTER TABLE `reservacion`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_reservacion_persona1_idx` (`persona_id`);

--
-- Indices de la tabla `reservacion_libro`
--
ALTER TABLE `reservacion_libro`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_reservacion_persona1_idx` (`persona_id`), ADD KEY `fk_reservacion_libro1_idx` (`libro_id`);

--
-- Indices de la tabla `subtitulo`
--
ALTER TABLE `subtitulo`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_subtitulo_titulo1_idx` (`titulo_id`);

--
-- Indices de la tabla `subtitulo_1`
--
ALTER TABLE `subtitulo_1`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_subtitulo_1_subtitulo1_idx` (`subtitulo_id`);

--
-- Indices de la tabla `subtitulo_2`
--
ALTER TABLE `subtitulo_2`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_subtitulo_2_subtitulo_11_idx` (`subtitulo_1_id`);

--
-- Indices de la tabla `subtitulo_3`
--
ALTER TABLE `subtitulo_3`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_subtitulo_3_subtitulo_21_idx` (`subtitulo_2_id`);

--
-- Indices de la tabla `titulo`
--
ALTER TABLE `titulo`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_titulo_libro1_idx` (`libro_id`);

--
-- Indices de la tabla `trueque`
--
ALTER TABLE `trueque`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_trueque_libro1_idx` (`libro_id`), ADD KEY `fk_trueque_persona1_idx` (`persona_id`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_hubicacion_libro1_idx` (`libro_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abono`
--
ALTER TABLE `abono`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `bloqueo_libro`
--
ALTER TABLE `bloqueo_libro`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `bloqueo_persona`
--
ALTER TABLE `bloqueo_persona`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `dias_festivo`
--
ALTER TABLE `dias_festivo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `libro`
--
ALTER TABLE `libro`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `multa`
--
ALTER TABLE `multa`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `parentesco`
--
ALTER TABLE `parentesco`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=156;
--
-- AUTO_INCREMENT de la tabla `renovacion`
--
ALTER TABLE `renovacion`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `reservacion`
--
ALTER TABLE `reservacion`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `reservacion_libro`
--
ALTER TABLE `reservacion_libro`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `subtitulo`
--
ALTER TABLE `subtitulo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `subtitulo_1`
--
ALTER TABLE `subtitulo_1`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `subtitulo_2`
--
ALTER TABLE `subtitulo_2`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `subtitulo_3`
--
ALTER TABLE `subtitulo_3`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `titulo`
--
ALTER TABLE `titulo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `abono`
--
ALTER TABLE `abono`
ADD CONSTRAINT `fk_abono_multa1` FOREIGN KEY (`multa_id`) REFERENCES `multa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `bloqueo_libro`
--
ALTER TABLE `bloqueo_libro`
ADD CONSTRAINT `fk_bloqueo_libro_libro1` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_bloqueo_libro_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `bloqueo_persona`
--
ALTER TABLE `bloqueo_persona`
ADD CONSTRAINT `fk_bloqueo_persona` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_bloqueo_persona_persona1` FOREIGN KEY (`persona_id1`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `calificacion`
--
ALTER TABLE `calificacion`
ADD CONSTRAINT `fk_calificacion_libro1` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_calificacion_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
ADD CONSTRAINT `fk_comentario_libro1` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_comentario_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `libro`
--
ALTER TABLE `libro`
ADD CONSTRAINT `fk_libro_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `multa`
--
ALTER TABLE `multa`
ADD CONSTRAINT `fk_multa_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_multa_prestamo1` FOREIGN KEY (`prestamo_id`) REFERENCES `prestamo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `parentesco`
--
ALTER TABLE `parentesco`
ADD CONSTRAINT `fk_parentezco_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_parentezco_persona2` FOREIGN KEY (`persona_id1`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
ADD CONSTRAINT `fk_persona_grupo1` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
ADD CONSTRAINT `fk_prestamo_libro1` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_prestamo_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_prestamo_persona2` FOREIGN KEY (`persona_id1`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `renovacion`
--
ALTER TABLE `renovacion`
ADD CONSTRAINT `fk_renovacion_prestamo1` FOREIGN KEY (`prestamo_id`) REFERENCES `prestamo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reservacion`
--
ALTER TABLE `reservacion`
ADD CONSTRAINT `fk_reservacion_persona10` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reservacion_libro`
--
ALTER TABLE `reservacion_libro`
ADD CONSTRAINT `fk_reservacion_libro1` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_reservacion_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `subtitulo`
--
ALTER TABLE `subtitulo`
ADD CONSTRAINT `fk_subtitulo_titulo1` FOREIGN KEY (`titulo_id`) REFERENCES `titulo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `subtitulo_1`
--
ALTER TABLE `subtitulo_1`
ADD CONSTRAINT `fk_subtitulo_1_subtitulo1` FOREIGN KEY (`subtitulo_id`) REFERENCES `subtitulo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `subtitulo_2`
--
ALTER TABLE `subtitulo_2`
ADD CONSTRAINT `fk_subtitulo_2_subtitulo_11` FOREIGN KEY (`subtitulo_1_id`) REFERENCES `subtitulo_1` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `subtitulo_3`
--
ALTER TABLE `subtitulo_3`
ADD CONSTRAINT `fk_subtitulo_3_subtitulo_21` FOREIGN KEY (`subtitulo_2_id`) REFERENCES `subtitulo_2` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `titulo`
--
ALTER TABLE `titulo`
ADD CONSTRAINT `fk_titulo_libro1` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `trueque`
--
ALTER TABLE `trueque`
ADD CONSTRAINT `fk_trueque_libro1` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_trueque_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
ADD CONSTRAINT `fk_hubicacion_libro1` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
