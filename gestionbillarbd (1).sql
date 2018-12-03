-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-12-2018 a las 18:36:17
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestionbillarbd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `debt`
--

CREATE TABLE `debt` (
  `id_debt` int(11) NOT NULL,
  `id_saleproduct` int(11) NOT NULL,
  `debt_total` double NOT NULL,
  `debt_cancelled` double NOT NULL,
  `debt_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `debt`
--

INSERT INTO `debt` (`id_debt`, `id_saleproduct`, `debt_total`, `debt_cancelled`, `debt_status`) VALUES
(1, 9, 0.3, 0.1, 0),
(2, 10, 0.6, 0.6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `debtpay`
--

CREATE TABLE `debtpay` (
  `id_debtpay` int(11) NOT NULL,
  `id_debt` int(11) NOT NULL,
  `id_turn` int(11) NOT NULL,
  `debtpay_mont` double NOT NULL,
  `debtpay_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `debtpay`
--

INSERT INTO `debtpay` (`id_debtpay`, `id_debt`, `id_turn`, `debtpay_mont`, `debtpay_date`) VALUES
(1, 1, 7, 0.1, '2018-11-22 21:01:54'),
(2, 2, 7, 0.6, '2018-11-25 11:33:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `debtrent`
--

CREATE TABLE `debtrent` (
  `id_debtrent` int(11) NOT NULL,
  `id_salerent` int(11) NOT NULL,
  `debtrent_total` double NOT NULL,
  `debtrent_cancelled` double NOT NULL,
  `debtrent_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `debtrentpay`
--

CREATE TABLE `debtrentpay` (
  `id_debtrentpay` int(11) NOT NULL,
  `id_debtrent` int(11) NOT NULL,
  `id_turn` int(11) NOT NULL,
  `debtrentpay_mont` double NOT NULL,
  `debtrent_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expense`
--

CREATE TABLE `expense` (
  `id_expense` int(11) NOT NULL,
  `id_turn` int(11) NOT NULL,
  `expense_mont` double NOT NULL,
  `expense_description` varchar(120) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `expense`
--

INSERT INTO `expense` (`id_expense`, `id_turn`, `expense_mont`, `expense_description`) VALUES
(2, 7, 10, 'Almuerzo Huevito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `location`
--

CREATE TABLE `location` (
  `id_location` int(11) NOT NULL,
  `id_typelocation` int(11) NOT NULL,
  `location_name` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `location_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `location`
--

INSERT INTO `location` (`id_location`, `id_typelocation`, `location_name`, `location_status`) VALUES
(1, 2, 'PS-1', 0),
(2, 2, 'PS-2', 0),
(3, 1, 'BILLAR-1', 1),
(4, 1, 'BILLAR-2', 0),
(7, 2, 'PS-3', 0),
(8, 1, 'BILLAR-3', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locationrent`
--

CREATE TABLE `locationrent` (
  `id_locationrent` int(11) NOT NULL,
  `id_salerent` int(11) NOT NULL,
  `id_location` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `locationrent`
--

INSERT INTO `locationrent` (`id_locationrent`, `id_salerent`, `id_location`) VALUES
(1, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `menu_name` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `menu_icon` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id_menu`, `menu_name`, `menu_icon`) VALUES
(1, 'Login', 'fa fa-key'),
(2, 'Inicio', 'fa fa-dashboard'),
(3, 'Permisos', 'fa fa-check-square-o'),
(4, 'Inventario', 'fa fa-pencil-square'),
(5, 'Venta', 'fa fa-ticket'),
(6, 'Deuda', 'fa fa-calendar'),
(7, 'Personas', 'fa fa-user'),
(8, 'Usuarios', 'fa fa-unlock-alt'),
(9, 'Turnos', 'fa fa-code-fork'),
(10, 'Reporte Del Dia', 'fa fa-calendar-o'),
(11, 'Reporte Turnos', 'fa fa-calendar'),
(12, 'Egresos', 'fa fa-book'),
(13, 'Locaciones Alquiler', 'fa fa-compass');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `object`
--

CREATE TABLE `object` (
  `id_object` int(11) NOT NULL,
  `object_name` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `object_description` varchar(600) COLLATE utf8_spanish_ci NOT NULL,
  `object_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `object`
--

INSERT INTO `object` (`id_object`, `object_name`, `object_description`, `object_total`) VALUES
(1, 'Bolas de Billar', 'Bolas para jugar el billar pe causa', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `optionmenu`
--

CREATE TABLE `optionmenu` (
  `id_option` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `option_name` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `option_url` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `option_show` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `optionmenu`
--

INSERT INTO `optionmenu` (`id_option`, `id_menu`, `option_name`, `option_url`, `option_show`) VALUES
(1, 2, 'Inicio', 'Index/index', 1),
(2, 3, 'Ver Permisos', 'Permit/add', 1),
(3, 3, 'Agregar Permisos', 'Permit/read', 1),
(4, 1, 'Iniciar Sesion', 'Login/index', 1),
(5, 4, 'Ver Inventario Venta', 'Inventory/listProducts', 1),
(6, 4, 'Ver Inventario Alquiler', 'Inventory/listRent', 1),
(7, 4, 'Ver Inventario Objetos', 'Inventory/listObjects', 1),
(8, 4, 'Agregar Producto', 'Inventory/addProduct', 0),
(9, 4, 'Editar Producto', 'Inventory/editProduct', 0),
(10, 4, 'Lista Precio de Producto', 'Inventory/productForsale', 0),
(11, 4, 'Agregar Precio Producto', 'Inventory/addProductforsale', 0),
(12, 4, 'Agregar Precio Producto', 'Inventory/addProductforsale', 0),
(13, 4, 'Editar Precio de Venta', 'Inventory/editProductforsale', 0),
(14, 4, 'Agregar Alquiler', 'Inventory/addRent', 0),
(15, 4, 'Editar Alquiler', 'Inventory/editRent', 0),
(16, 4, 'Agregar Objeto', 'Inventory/addObject', 0),
(17, 4, 'Editar Objeto', 'Inventory/editObject', 0),
(18, 4, 'Agregar Stock Producto', 'Inventory/addProductstock', 0),
(19, 5, 'Realizar Venta Rapida', 'Sell/fastSell', 1),
(20, 5, 'Realizar Alquiler', 'Sell/rent', 1),
(21, 6, 'Ver y Cobrar Deudas', 'Debt/seeAll', 1),
(22, 5, 'Ver Disponibilidad Alquileres', 'Sell/viewRents', 1),
(23, 7, 'Ver Personas', 'Person/list', 1),
(24, 7, 'Agregar Persona', 'Person/addPerson', 1),
(25, 7, 'Editar Persona', 'Person/editPerson', 0),
(26, 8, 'Gestionar Usuarios', 'User/seeAll', 1),
(27, 8, 'Agregar Usuario', 'User/add', 1),
(28, 8, 'Editar Usuario', 'User/edit', 0),
(29, 8, 'Cambiar Contraseña', 'User/modifyPassword', 0),
(30, 9, 'Gestionar Turnos', 'Turn/seeAll', 1),
(31, 9, 'Agregar Turno', 'Turn/add', 1),
(32, 10, 'Ver Reporte del Dia', 'Report/day', 1),
(33, 11, 'Ver Reportes por Turnos', 'Report/all', 1),
(34, 12, 'Agregar Egreso', 'Expense/add', 1),
(35, 12, 'Ver Egresos', 'Expense/all', 1),
(36, 12, 'Editar Egreso', 'Expense/edit', 0),
(37, 13, 'Agregar Locacion', 'Location/add', 1),
(38, 13, 'Ver Locaciones', 'Location/all', 1),
(39, 13, 'Editar Locacion', 'Location/edit', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permit`
--

CREATE TABLE `permit` (
  `id_permit` int(11) NOT NULL,
  `permit_controller` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `permit_action` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `permit_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `permit`
--

INSERT INTO `permit` (`id_permit`, `permit_controller`, `permit_action`, `permit_status`) VALUES
(1, 'Permit', 'save', 1),
(2, 'Permit', 'delete', 1),
(3, 'Role', 'save', 1),
(4, 'Role', 'insertPermits', 1),
(5, 'Role', 'deleteRole', 1),
(6, 'Role', 'deletePermit', 1),
(7, 'Person', 'save', 1),
(8, 'Person', 'readAll', 1),
(9, 'User', 'save', 1),
(11, 'User', 'insertRoleuser', 1),
(15, 'Permit', 'changeStatus', 1),
(16, 'Login', 'singIn', 1),
(17, 'Login', 'singOut', 1),
(18, 'Permit', 'readAll', 1),
(19, 'Inventory', 'saveProduct', 1),
(20, 'Inventory', 'deleteProduct', 1),
(21, 'Inventory', 'saveProductprice', 1),
(22, 'Inventory', 'deleteProductprice', 1),
(23, 'Inventory', 'saveRent', 1),
(24, 'Inventory', 'deleteRent', 1),
(25, 'Inventory', 'saveObject', 1),
(26, 'Inventory', 'deleteObject', 1),
(27, 'Inventory', 'saveProductstock', 1),
(28, 'Sell', 'sellProduct', 1),
(29, 'Sell', 'sellRent', 1),
(30, 'Debt', 'seeAll', 1),
(31, 'Debt', 'payDebt', 1),
(32, 'Debt', 'payDebtrent', 1),
(33, 'Sell', 'viewRents', 1),
(34, 'Sell', 'finishRent', 1),
(35, 'Person', 'deletePerson', 1),
(37, 'User', 'deleteUser', 1),
(38, 'Turn', 'save', 1),
(39, 'Turn', 'delete', 1),
(40, 'Turn', 'change', 1),
(41, 'Expense', 'save', 1),
(42, 'Expense', 'delete', 1),
(43, 'Report', 'set_turn', 1),
(44, 'Location', 'save', 1),
(45, 'Location', 'delete', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `person`
--

CREATE TABLE `person` (
  `id_person` int(11) NOT NULL,
  `person_name` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `person_surname` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `person_dni` char(8) COLLATE utf8_spanish_ci NOT NULL,
  `person_address` varchar(126) COLLATE utf8_spanish_ci DEFAULT NULL,
  `person_cellphone` varchar(24) COLLATE utf8_spanish_ci DEFAULT NULL,
  `person_genre` char(1) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `person`
--

INSERT INTO `person` (`id_person`, `person_name`, `person_surname`, `person_dni`, `person_address`, `person_cellphone`, `person_genre`) VALUES
(1, 'Alan', 'Brito', '77777773', 'Calle Siempre Viva 123', '987654322', 'M'),
(2, 'Cliente ', 'Sin Registro', '00000000', 'Calle Siempre Viva #111', '999999999', 'M'),
(3, 'Carlos Andres', 'Melendez', '77777789', 'Calle Sin Nombre 345', '965321478', 'M'),
(4, 'Cesar', 'Ruiz', '72195723', 'Calle Estado de Israel 256', '969902084', 'M');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `product_name` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `product_description` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `product_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id_product`, `product_name`, `product_description`, `product_stock`) VALUES
(1, 'Cerveza Pilsen 600ml', 'Cerveza Rica', 22),
(2, 'Coca Cola 500ml', 'Gaseosa', 37),
(3, 'Caramelo Halls Negro', 'Caramelos color negro', 73),
(4, 'Cerveza Cristal 600ml', 'Chelita Sabrosa', 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productforsale`
--

CREATE TABLE `productforsale` (
  `id_productforsale` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `product_unid` int(11) NOT NULL,
  `product_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productforsale`
--

INSERT INTO `productforsale` (`id_productforsale`, `id_product`, `product_unid`, `product_price`) VALUES
(1, 1, 3, 12),
(2, 1, 1, 5),
(3, 2, 1, 1.2),
(4, 3, 1, 0.3),
(5, 3, 3, 1),
(6, 4, 1, 5),
(7, 4, 3, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rent`
--

CREATE TABLE `rent` (
  `id_rent` int(11) NOT NULL,
  `rent_name` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `rent_description` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `rent_timeminutes` int(11) NOT NULL,
  `rent_cost` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rent`
--

INSERT INTO `rent` (`id_rent`, `rent_name`, `rent_description`, `rent_timeminutes`, `rent_cost`) VALUES
(1, 'PS4', 'Alquiler por Hora', 60, 4),
(2, 'Billar', 'Alquiler de Mesa', 60, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `role_name` varchar(32) COLLATE utf8_spanish_ci DEFAULT NULL,
  `role_description` varchar(126) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`id_role`, `role_name`, `role_description`) VALUES
(1, 'Free', 'Its happy to be here'),
(2, 'Admin', 'Manage Everything');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rolemenu`
--

CREATE TABLE `rolemenu` (
  `id_rolemenu` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rolemenu`
--

INSERT INTO `rolemenu` (`id_rolemenu`, `id_role`, `id_menu`) VALUES
(1, 2, 2),
(2, 2, 3),
(3, 1, 1),
(4, 2, 4),
(5, 2, 5),
(6, 2, 6),
(7, 2, 7),
(8, 2, 8),
(9, 2, 9),
(10, 2, 10),
(11, 2, 11),
(12, 2, 12),
(13, 2, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rolepermit`
--

CREATE TABLE `rolepermit` (
  `id_rolepermit` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_permit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rolepermit`
--

INSERT INTO `rolepermit` (`id_rolepermit`, `id_role`, `id_permit`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3),
(4, 2, 4),
(5, 2, 5),
(6, 2, 6),
(7, 2, 7),
(8, 2, 8),
(9, 2, 9),
(11, 2, 11),
(15, 2, 15),
(16, 2, 16),
(17, 2, 17),
(18, 2, 18),
(19, 2, 19),
(20, 2, 20),
(21, 2, 21),
(22, 2, 22),
(23, 2, 23),
(25, 2, 24),
(26, 2, 25),
(27, 2, 26),
(28, 2, 27),
(29, 2, 28),
(30, 2, 29),
(31, 2, 30),
(32, 2, 31),
(33, 2, 32),
(34, 2, 33),
(35, 2, 34),
(36, 2, 35),
(38, 2, 37),
(39, 2, 38),
(40, 2, 39),
(41, 2, 40),
(42, 2, 41),
(43, 2, 42),
(44, 2, 43),
(45, 2, 44),
(46, 2, 45);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saledetail`
--

CREATE TABLE `saledetail` (
  `id_saledetail` int(11) NOT NULL,
  `id_saleproduct` int(11) NOT NULL,
  `id_productforsale` int(11) NOT NULL,
  `sale_productname` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `sale_unid` int(11) NOT NULL,
  `sale_price` double NOT NULL,
  `sale_productsselled` int(11) NOT NULL,
  `sale_productstotalselled` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `saledetail`
--

INSERT INTO `saledetail` (`id_saledetail`, `id_saleproduct`, `id_productforsale`, `sale_productname`, `sale_unid`, `sale_price`, `sale_productsselled`, `sale_productstotalselled`) VALUES
(1, 1, 4, 'Caramelo Halls Negro', 1, 0.3, 2, 2),
(2, 2, 5, 'Caramelo Halls Negro', 3, 1, 2, 6),
(3, 3, 6, 'Cerveza Cristal 600ml', 1, 5, 1, 1),
(4, 4, 7, 'Cerveza Cristal 600ml', 3, 13, 2, 6),
(5, 5, 1, 'Cerveza Pilsen 600ml', 3, 12, 1, 3),
(6, 6, 2, 'Cerveza Pilsen 600ml', 1, 5, 1, 1),
(7, 7, 3, 'Coca Cola 500ml', 1, 1.2, 2, 2),
(8, 8, 4, 'Caramelo Halls Negro', 1, 0.3, 2, 2),
(9, 9, 4, 'Caramelo Halls Negro', 1, 0, 1, 1),
(10, 10, 4, 'Caramelo Halls Negro', 1, 0, 2, 2),
(11, 11, 5, 'Caramelo Halls Negro', 3, 0, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saleproduct`
--

CREATE TABLE `saleproduct` (
  `id_saleproduct` int(11) NOT NULL,
  `id_person` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_turn` int(11) NOT NULL,
  `saleproduct_total` double NOT NULL,
  `saleproduct_date` datetime NOT NULL,
  `saleproduct_cancelled` varchar(5) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `saleproduct`
--

INSERT INTO `saleproduct` (`id_saleproduct`, `id_person`, `id_user`, `id_turn`, `saleproduct_total`, `saleproduct_date`, `saleproduct_cancelled`) VALUES
(1, 2, 1, 7, 0.6, '2018-11-22 19:40:56', 'true'),
(2, 2, 1, 7, 2, '2018-11-22 19:41:03', 'true'),
(3, 2, 1, 7, 5, '2018-11-22 19:41:12', 'true'),
(4, 2, 1, 7, 26, '2018-11-22 19:41:22', 'true'),
(5, 2, 1, 7, 12, '2018-11-22 19:41:30', 'true'),
(6, 2, 1, 7, 5, '2018-11-22 19:41:41', 'true'),
(7, 2, 1, 7, 2.4, '2018-11-22 19:41:52', 'true'),
(8, 2, 3, 7, 0.6, '2018-11-22 21:01:16', 'true'),
(9, 1, 3, 7, 0.3, '2018-11-22 21:01:34', 'false'),
(10, 3, 1, 7, 0.6, '2018-11-24 12:04:15', 'false'),
(11, 2, 1, 7, 0, '2018-11-24 12:04:35', 'true');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salerent`
--

CREATE TABLE `salerent` (
  `id_salerent` int(11) NOT NULL,
  `id_rent` int(11) NOT NULL,
  `id_person` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_location` int(11) NOT NULL,
  `id_turn` int(11) NOT NULL,
  `salerent_date` date NOT NULL,
  `salerent_start` time NOT NULL,
  `salerent_finish` time NOT NULL,
  `salerent_total` double NOT NULL,
  `salerent_finished` tinyint(1) NOT NULL,
  `salerent_cancelled` varchar(5) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `salerent`
--

INSERT INTO `salerent` (`id_salerent`, `id_rent`, `id_person`, `id_user`, `id_location`, `id_turn`, `salerent_date`, `salerent_start`, `salerent_finish`, `salerent_total`, `salerent_finished`, `salerent_cancelled`) VALUES
(1, 1, 3, 3, 1, 7, '2018-11-22', '21:05:03', '23:05:03', 8, 1, 'true'),
(2, 2, 2, 1, 3, 7, '2018-12-02', '19:24:19', '20:24:19', 6, 0, 'true');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `startproduct`
--

CREATE TABLE `startproduct` (
  `id_startproduct` int(11) NOT NULL,
  `id_turn` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `startproduct_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `startproduct`
--

INSERT INTO `startproduct` (`id_startproduct`, `id_turn`, `id_product`, `startproduct_stock`) VALUES
(1, 7, 1, 26),
(2, 7, 2, 39),
(3, 7, 3, 69),
(4, 7, 4, 31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stocklog`
--

CREATE TABLE `stocklog` (
  `id_stocklog` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_turn` int(11) NOT NULL,
  `stocklog_added` int(11) NOT NULL,
  `stocklog_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `stocklog`
--

INSERT INTO `stocklog` (`id_stocklog`, `id_product`, `id_turn`, `stocklog_added`, `stocklog_date`) VALUES
(2, 3, 7, 20, '2018-11-22 18:53:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turn`
--

CREATE TABLE `turn` (
  `id_turn` int(11) NOT NULL,
  `turn_datestart` datetime NOT NULL,
  `turn_datefinish` datetime NOT NULL,
  `turn_active` tinyint(1) NOT NULL,
  `turn_wasactive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `turn`
--

INSERT INTO `turn` (`id_turn`, `turn_datestart`, `turn_datefinish`, `turn_active`, `turn_wasactive`) VALUES
(1, '2018-11-19 10:00:00', '2018-11-19 18:00:00', 0, 1),
(2, '2018-11-19 18:00:00', '2018-11-20 06:00:00', 0, 1),
(5, '2018-11-20 18:00:00', '2018-11-21 04:00:00', 0, 1),
(6, '2018-11-21 04:00:00', '2018-11-21 18:00:00', 0, 1),
(7, '2018-11-21 18:00:00', '2018-11-22 10:00:00', 1, 1),
(8, '2018-11-22 10:00:00', '2018-11-23 04:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `typelocation`
--

CREATE TABLE `typelocation` (
  `id_typelocation` int(11) NOT NULL,
  `typelocation_name` varchar(120) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `typelocation`
--

INSERT INTO `typelocation` (`id_typelocation`, `typelocation_name`) VALUES
(1, 'BILLAR'),
(2, 'PLAY STATION 4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_person` int(11) DEFAULT NULL,
  `id_role` int(11) NOT NULL,
  `user_nickname` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_password` varchar(64) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_image` varchar(126) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_user`, `id_person`, `id_role`, `user_nickname`, `user_password`, `user_image`, `user_status`) VALUES
(1, 1, 2, 'el_huevas', '$2y$10$t0pvs.8vpcAEwq.ZK.j8iOHFgUNo8Rv3YeFd926LhrNc4XCf.qR7m', 'media/user/1/user.jpg', 1),
(3, 3, 2, 'carlitos', '$2y$10$NT0aNyHON1hi6P3A.QvVjemzAPuCQ4enp3Dmwh7QnopOMfpwTyl1O', 'media/user/1/user.jpg', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `debt`
--
ALTER TABLE `debt`
  ADD PRIMARY KEY (`id_debt`),
  ADD KEY `id_saleproduct` (`id_saleproduct`);

--
-- Indices de la tabla `debtpay`
--
ALTER TABLE `debtpay`
  ADD PRIMARY KEY (`id_debtpay`),
  ADD KEY `id_debt` (`id_debt`),
  ADD KEY `id_turn` (`id_turn`);

--
-- Indices de la tabla `debtrent`
--
ALTER TABLE `debtrent`
  ADD PRIMARY KEY (`id_debtrent`),
  ADD KEY `id_salerent` (`id_salerent`);

--
-- Indices de la tabla `debtrentpay`
--
ALTER TABLE `debtrentpay`
  ADD PRIMARY KEY (`id_debtrentpay`),
  ADD KEY `id_debtrent` (`id_debtrent`),
  ADD KEY `id_turn` (`id_turn`);

--
-- Indices de la tabla `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id_expense`),
  ADD KEY `id_turn` (`id_turn`);

--
-- Indices de la tabla `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id_location`),
  ADD KEY `id_typelocation` (`id_typelocation`);

--
-- Indices de la tabla `locationrent`
--
ALTER TABLE `locationrent`
  ADD PRIMARY KEY (`id_locationrent`),
  ADD KEY `locationrent_ibfk_1` (`id_location`),
  ADD KEY `locationrent_ibfk_2` (`id_salerent`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indices de la tabla `object`
--
ALTER TABLE `object`
  ADD PRIMARY KEY (`id_object`);

--
-- Indices de la tabla `optionmenu`
--
ALTER TABLE `optionmenu`
  ADD PRIMARY KEY (`id_option`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indices de la tabla `permit`
--
ALTER TABLE `permit`
  ADD PRIMARY KEY (`id_permit`);

--
-- Indices de la tabla `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id_person`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indices de la tabla `productforsale`
--
ALTER TABLE `productforsale`
  ADD PRIMARY KEY (`id_productforsale`),
  ADD KEY `id_product` (`id_product`);

--
-- Indices de la tabla `rent`
--
ALTER TABLE `rent`
  ADD PRIMARY KEY (`id_rent`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indices de la tabla `rolemenu`
--
ALTER TABLE `rolemenu`
  ADD PRIMARY KEY (`id_rolemenu`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indices de la tabla `rolepermit`
--
ALTER TABLE `rolepermit`
  ADD PRIMARY KEY (`id_rolepermit`),
  ADD KEY `R_4` (`id_role`),
  ADD KEY `R_5` (`id_permit`);

--
-- Indices de la tabla `saledetail`
--
ALTER TABLE `saledetail`
  ADD PRIMARY KEY (`id_saledetail`),
  ADD KEY `id_saleproduct` (`id_saleproduct`),
  ADD KEY `id_productforsale` (`id_productforsale`);

--
-- Indices de la tabla `saleproduct`
--
ALTER TABLE `saleproduct`
  ADD PRIMARY KEY (`id_saleproduct`),
  ADD KEY `id_person` (`id_person`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_turn` (`id_turn`);

--
-- Indices de la tabla `salerent`
--
ALTER TABLE `salerent`
  ADD PRIMARY KEY (`id_salerent`),
  ADD KEY `id_rent` (`id_rent`),
  ADD KEY `id_person` (`id_person`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_location` (`id_location`),
  ADD KEY `id_turn` (`id_turn`);

--
-- Indices de la tabla `startproduct`
--
ALTER TABLE `startproduct`
  ADD PRIMARY KEY (`id_startproduct`),
  ADD KEY `id_turn` (`id_turn`),
  ADD KEY `id_product` (`id_product`);

--
-- Indices de la tabla `stocklog`
--
ALTER TABLE `stocklog`
  ADD PRIMARY KEY (`id_stocklog`),
  ADD KEY `id_turn` (`id_turn`),
  ADD KEY `id_product` (`id_product`);

--
-- Indices de la tabla `turn`
--
ALTER TABLE `turn`
  ADD PRIMARY KEY (`id_turn`);

--
-- Indices de la tabla `typelocation`
--
ALTER TABLE `typelocation`
  ADD PRIMARY KEY (`id_typelocation`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `R_2` (`id_person`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `debt`
--
ALTER TABLE `debt`
  MODIFY `id_debt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `debtpay`
--
ALTER TABLE `debtpay`
  MODIFY `id_debtpay` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `debtrent`
--
ALTER TABLE `debtrent`
  MODIFY `id_debtrent` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `debtrentpay`
--
ALTER TABLE `debtrentpay`
  MODIFY `id_debtrentpay` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `expense`
--
ALTER TABLE `expense`
  MODIFY `id_expense` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `location`
--
ALTER TABLE `location`
  MODIFY `id_location` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `locationrent`
--
ALTER TABLE `locationrent`
  MODIFY `id_locationrent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `object`
--
ALTER TABLE `object`
  MODIFY `id_object` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `optionmenu`
--
ALTER TABLE `optionmenu`
  MODIFY `id_option` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `permit`
--
ALTER TABLE `permit`
  MODIFY `id_permit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `person`
--
ALTER TABLE `person`
  MODIFY `id_person` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `productforsale`
--
ALTER TABLE `productforsale`
  MODIFY `id_productforsale` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `rent`
--
ALTER TABLE `rent`
  MODIFY `id_rent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rolemenu`
--
ALTER TABLE `rolemenu`
  MODIFY `id_rolemenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `rolepermit`
--
ALTER TABLE `rolepermit`
  MODIFY `id_rolepermit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `saledetail`
--
ALTER TABLE `saledetail`
  MODIFY `id_saledetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `saleproduct`
--
ALTER TABLE `saleproduct`
  MODIFY `id_saleproduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `salerent`
--
ALTER TABLE `salerent`
  MODIFY `id_salerent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `startproduct`
--
ALTER TABLE `startproduct`
  MODIFY `id_startproduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `stocklog`
--
ALTER TABLE `stocklog`
  MODIFY `id_stocklog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `turn`
--
ALTER TABLE `turn`
  MODIFY `id_turn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `typelocation`
--
ALTER TABLE `typelocation`
  MODIFY `id_typelocation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `debt`
--
ALTER TABLE `debt`
  ADD CONSTRAINT `debt_ibfk_1` FOREIGN KEY (`id_saleproduct`) REFERENCES `saleproduct` (`id_saleproduct`);

--
-- Filtros para la tabla `debtpay`
--
ALTER TABLE `debtpay`
  ADD CONSTRAINT `debtpay_ibfk_1` FOREIGN KEY (`id_debt`) REFERENCES `debt` (`id_debt`),
  ADD CONSTRAINT `debtpay_ibfk_2` FOREIGN KEY (`id_turn`) REFERENCES `turn` (`id_turn`);

--
-- Filtros para la tabla `debtrent`
--
ALTER TABLE `debtrent`
  ADD CONSTRAINT `debtrent_ibfk_1` FOREIGN KEY (`id_salerent`) REFERENCES `salerent` (`id_salerent`);

--
-- Filtros para la tabla `debtrentpay`
--
ALTER TABLE `debtrentpay`
  ADD CONSTRAINT `debtrentpay_ibfk_1` FOREIGN KEY (`id_debtrent`) REFERENCES `debtrent` (`id_debtrent`),
  ADD CONSTRAINT `debtrentpay_ibfk_2` FOREIGN KEY (`id_turn`) REFERENCES `turn` (`id_turn`);

--
-- Filtros para la tabla `expense`
--
ALTER TABLE `expense`
  ADD CONSTRAINT `expense_ibfk_1` FOREIGN KEY (`id_turn`) REFERENCES `turn` (`id_turn`);

--
-- Filtros para la tabla `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`id_typelocation`) REFERENCES `typelocation` (`id_typelocation`);

--
-- Filtros para la tabla `locationrent`
--
ALTER TABLE `locationrent`
  ADD CONSTRAINT `locationrent_ibfk_1` FOREIGN KEY (`id_location`) REFERENCES `location` (`id_location`) ON DELETE NO ACTION,
  ADD CONSTRAINT `locationrent_ibfk_2` FOREIGN KEY (`id_salerent`) REFERENCES `salerent` (`id_salerent`) ON DELETE NO ACTION;

--
-- Filtros para la tabla `optionmenu`
--
ALTER TABLE `optionmenu`
  ADD CONSTRAINT `optionmenu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`);

--
-- Filtros para la tabla `productforsale`
--
ALTER TABLE `productforsale`
  ADD CONSTRAINT `productforsale_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`);

--
-- Filtros para la tabla `rolemenu`
--
ALTER TABLE `rolemenu`
  ADD CONSTRAINT `rolemenu_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`),
  ADD CONSTRAINT `rolemenu_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`);

--
-- Filtros para la tabla `rolepermit`
--
ALTER TABLE `rolepermit`
  ADD CONSTRAINT `R_4` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`),
  ADD CONSTRAINT `R_5` FOREIGN KEY (`id_permit`) REFERENCES `permit` (`id_permit`) ON DELETE CASCADE;

--
-- Filtros para la tabla `saledetail`
--
ALTER TABLE `saledetail`
  ADD CONSTRAINT `saledetail_ibfk_1` FOREIGN KEY (`id_saleproduct`) REFERENCES `saleproduct` (`id_saleproduct`),
  ADD CONSTRAINT `saledetail_ibfk_2` FOREIGN KEY (`id_productforsale`) REFERENCES `productforsale` (`id_productforsale`);

--
-- Filtros para la tabla `saleproduct`
--
ALTER TABLE `saleproduct`
  ADD CONSTRAINT `saleproduct_ibfk_1` FOREIGN KEY (`id_person`) REFERENCES `person` (`id_person`),
  ADD CONSTRAINT `saleproduct_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `saleproduct_ibfk_3` FOREIGN KEY (`id_turn`) REFERENCES `turn` (`id_turn`);

--
-- Filtros para la tabla `salerent`
--
ALTER TABLE `salerent`
  ADD CONSTRAINT `salerent_ibfk_1` FOREIGN KEY (`id_rent`) REFERENCES `rent` (`id_rent`),
  ADD CONSTRAINT `salerent_ibfk_2` FOREIGN KEY (`id_person`) REFERENCES `person` (`id_person`),
  ADD CONSTRAINT `salerent_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `salerent_ibfk_4` FOREIGN KEY (`id_location`) REFERENCES `location` (`id_location`),
  ADD CONSTRAINT `salerent_ibfk_5` FOREIGN KEY (`id_turn`) REFERENCES `turn` (`id_turn`);

--
-- Filtros para la tabla `startproduct`
--
ALTER TABLE `startproduct`
  ADD CONSTRAINT `startproduct_ibfk_1` FOREIGN KEY (`id_turn`) REFERENCES `turn` (`id_turn`),
  ADD CONSTRAINT `startproduct_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`);

--
-- Filtros para la tabla `stocklog`
--
ALTER TABLE `stocklog`
  ADD CONSTRAINT `stocklog_ibfk_1` FOREIGN KEY (`id_turn`) REFERENCES `turn` (`id_turn`),
  ADD CONSTRAINT `stocklog_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `R_2` FOREIGN KEY (`id_person`) REFERENCES `person` (`id_person`),
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
