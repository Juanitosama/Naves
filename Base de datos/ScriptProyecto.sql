CREATE DATABASE Proyecto;
USE PROYECTO;
CREATE TABLE almacen (
  id_almacen varchar(9) NOT NULL PRIMARY KEY,
  nombre varchar(255) NOT NULL,
  direccion varchar(255) NOT NULL,
  telefono varchar(20) DEFAULT NULL
);
CREATE TABLE cliente (
  dni_cliente varchar(9) NOT NULL PRIMARY KEY,
  nombre_cliente varchar(255) NOT NULL,
  apellido_cliente varchar(255) NOT NULL,
  edad_cliente varchar(255) DEFAULT NULL,
  telefono_cliente varchar(20) DEFAULT NULL,
  ciudad_cliente varchar(20) DEFAULT NULL,
  puntos int DEFAULT NULL
);
CREATE TABLE producto (
  id_producto varchar(9) NOT NULL PRIMARY KEY,
  nombre_producto varchar(255) NOT NULL,
  memoria varchar(255) NOT NULL,
  descripcion_producto text DEFAULT NULL,
  marca_producto varchar(50) NOT NULL,
  precio_producto decimal(10,2) NOT NULL,
  categoria enum('HDD','SSD','SSD externo','M.2 SSD') NOT NULL
);
CREATE TABLE tienda (
id_tienda varchar(9) NOT NULL PRIMARY KEY,
nombre_tienda varchar(255) NOT NULL,
direccion_tienda varchar(255) NOT NULL
);
CREATE TABLE empleado (
  dni_empleado varchar(9) NOT NULL PRIMARY KEY,
  nombre_empleado varchar(255) NOT NULL,
  apellido_empleado varchar(255) NOT NULL,
  telefono_empleado varchar(9) NOT NULL,
  edad_empleado int(11) NOT NULL,
  fecha_contratacion date NOT NULL,
  id_tienda varchar(9) DEFAULT NULL,
  CONSTRAINT fk_empleado_tienda FOREIGN KEY (id_tienda) REFERENCES tienda (id_tienda) ON UPDATE CASCADE
);
CREATE TABLE venta (
id_venta int AUTO_INCREMENT NOT NULL PRIMARY KEY,
dni_empleado varchar(9) NOT NULL,
dni_cliente varchar(9) NOT NULL,
fecha_venta date NOT NULL,
CONSTRAINT fk_venta_empleado FOREIGN KEY (dni_empleado) REFERENCES empleado (dni_empleado) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT fk_venta_cliente FOREIGN KEY (dni_cliente) REFERENCES cliente (dni_cliente) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE detalle_venta (
  id_venta int NOT NULL,
  id_producto varchar(9) NOT NULL,
  cantidad int NOT NULL,
  descuento_puntos decimal(10,2) DEFAULT NULL,
  total decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (id_venta, id_producto),
  CONSTRAINT fk_detalle_venta_venta FOREIGN KEY (id_venta) REFERENCES venta (id_venta) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_detalle_venta_producto FOREIGN KEY (id_producto) REFERENCES producto (id_producto) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE stock_tienda (
id_tienda varchar(9) NOT NULL,
id_producto varchar(9) NOT NULL,
cantidad int NOT NULL,
PRIMARY KEY (id_tienda, id_producto),
CONSTRAINT fk_stock_tienda_tienda FOREIGN KEY (id_tienda) REFERENCES tienda (id_tienda) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT fk_stock_tienda_producto FOREIGN KEY (id_producto) REFERENCES producto (id_producto) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE stock_almacen (
  id_almacen varchar(9) NOT NULL,
  id_producto varchar(9) NOT NULL,
  cantidad int NOT NULL,
  PRIMARY KEY (id_almacen, id_producto),
  CONSTRAINT fk_stock_almacen_almacen FOREIGN KEY (id_almacen) REFERENCES almacen (id_almacen) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_stock_almacen_producto FOREIGN KEY (id_producto) REFERENCES producto (id_producto) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE venta_online (
  id_venta_online int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  dni_cliente varchar(9) NOT NULL,
  fecha_venta_online date NOT NULL,
  total decimal(10,2) NOT NULL,
  CONSTRAINT fk_venta_online_cliente FOREIGN KEY (dni_cliente) REFERENCES cliente (dni_cliente) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE detalle_venta_online (
  id_venta_online int NOT NULL,
  id_producto varchar(9) NOT NULL,
  cantidad int NOT NULL,
  precio_unitario decimal(10,2) NOT NULL,
  descuento_puntos decimal(10,2) DEFAULT NULL,
  total decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (id_venta_online, id_producto),
  CONSTRAINT fk_detalle_venta_online_venta FOREIGN KEY (id_venta_online) REFERENCES venta_online (id_venta_online) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_detalle_venta_online_producto FOREIGN KEY (id_producto) REFERENCES producto (id_producto) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE usuario (
  id int(11) UNSIGNED NOT NULL,
  usuario varchar(255) NOT NULL,
  password char(64) NOT NULL
);

--Datos tabla almacén
INSERT INTO `almacen` (`id_almacen`, `nombre`, `direccion`, `telefono`) VALUES
('ALM01', 'Almacen Madrid', 'Gran Via 7', '678345102'),
('ALM02', 'Almacen Asturias', 'Calle Constitucion', '987456123');
--Datos tabla cliente
INSERT INTO `cliente` (`dni_cliente`, `nombre_cliente`, `apellido_cliente`, `edad_cliente`, `telefono_cliente`, `ciudad_cliente`, `puntos`) VALUES
('12345678A', 'Juan', 'Perez', '35', '666555444', 'Madrid', 180),
('23456789B', 'Maria', 'Gonzalez', '27', '678901234', 'Barcelona', 430),
('34567890C', 'Luis', 'Martinez', '45', '654987321', 'Valencia', 350),
('45678901D', 'Laura', 'Rodriguez', '32', '654321987', 'Sevilla', 190),
('56789012E', 'Javier', 'Fernandez', '29', '678543219', 'Malaga', 275),
('67890123F', 'Sara', 'Gomez', '41', '654321654', 'Bilbao', 140),
('78901234G', 'Lucia', 'Sanchez', '23', '666777888', 'Murcia', 180),
('89012345H', 'Pedro', 'Hernandez', '38', '678901234', 'Alicante', 270),
('90123456I', 'Carmen', 'Ruiz', '31', '654987321', 'Zaragoza', 268),
('01234567J', 'Pablo', 'Vazquez', '50', '678543219', 'Granada', 240),
('23456789K', 'Lucas', 'Garcia', '33', '654321654', 'Barcelona', 410),
('34567890L', 'Ana', 'Fernandez', '25', '678901234', 'Madrid', 50),
('45678901M', 'Mario', 'Perez', '41', '654987321', 'Valencia', 180),
('56789012N', 'Sofia', 'Ruiz', '29', '678543219', 'Sevilla', 90),
('67890123O', 'Marta', 'Gomez', '35', '654321987', 'Bilbao', 150),
('78901234P', 'Diego', 'Martinez', '26', '666777888', 'Barcelona', 180),
('89012345Q', 'Carla', 'Sanchez', '28', '678901234', 'Madrid', 70),
('90123456R', 'Alejandro', 'Hernandez', '36', '654987321', 'Valencia', 400),
('01234567S', 'Alicia', 'Rodriguez', '31', '678543219', 'Sevilla', 120),
('12345678T', 'Lorena', 'Fernandez', '24', '654321987', 'Bilbao', 80),
('23456789X', 'Laura', 'Gonzalez', '32', '600123456', 'Barcelona', 430),
('34567890Y', 'Santiago', 'Gomez', '28', '666777888', 'Madrid', 670),
('45678901Z', 'Pablo', 'Alvarez', '39', '654321654', 'Valencia', 950),
('56789012A', 'Cristina', 'Sanchez', '22', '600123456', 'Sevilla', 10),
('67890123B', 'Pedro', 'Ramos', '37', '666777888', 'Bilbao', 830),
('78901234C', 'Maria', 'Castillo', '44', '654321654', 'Barcelona', 760),
('89012345D', 'Antonio', 'Ortega', '30', '666777888', 'Madrid', 420),
('90123456E', 'Paula', 'Molina', '26', '600123456', 'Valencia', 220),
('01234567F', 'Juan', 'Navarro', '31', '654321654', 'Sevilla', 290),
('12345678G', 'Silvia', 'Saez', '29', '666777888', 'Bilbao', 290),
('43995390F', 'Anais', 'Marroquí Llanes', '30', '652314970', 'Alicante', 500);
--Datos tabla producto
INSERT INTO `producto` (`id_producto`, `nombre_producto`, `memoria`, `descripcion_producto`, `marca_producto`, `precio_producto`, `categoria`) VALUES
('HDD001', 'Seagate Barracuda', '1TB', '3,5 pulgadas SATA 3', 'Seagate', '44.00', 'HDD'),
('HDD002', 'Seagate Barracuda', '2TB', '3.5 pulgadas', 'Seagate', '55.00', 'HDD'),
('HDD003', 'Seagate Barracuda', '4TB', '3.5 pulgadas', 'Seagate', '75.00', 'HDD'),
('HDD004', 'Seagate Barracuda', '2TB', '2.5 pulgadas', 'Seagate', '87.00', 'HDD'),
('SSD001', 'Kingston A400', '240GB', NULL, 'Kingston', '19.00', 'SSD'),
('SSD002', 'Kingston A400', '480GB', NULL, 'Kingston', '28.99', 'SSD'),
('SSD003', 'Crucial BX500', '480GB', 'SSD  3D NAND SATA3', 'Crucial', '39.00', 'SSD'),
('SSD004', 'Kioxia EXCERIA', '480GB', '  SSD SATA', 'Kioxia', '44.00', 'SSD'),
('SSD005', 'Crucial MX500', '500GB', 'SSD  SATA', 'Crucial', '45.00', 'SSD'),
('SSD006', 'Kingston A400', '960 GB', 'SSD SATA 3', 'Kingston', '58.00', 'SSD'),
('SSD007', 'Samsung 870 EVO ', '500GB', 'SSD 2.pulgadas  SATA 3 Negro', 'Samsung', '58.14', 'SSD'),
('SSD008', 'Crucial BX500', '1TB', 'SSD 3D NAND SATA3', 'Crucial', '68.99', 'SSD'),
('SSD009', 'Kioxia EXCERIA', '960GB', 'SSD SATA', 'Kioxia', '72.00', 'SSD'),
('SSD010', 'GoodRam CL100 Gen.3', '960GB', 'SSD 2.5 pulgadas SATA 3', 'GoodRam', '75.35', 'SSD'),
('SSD011', 'Crucial MX500', '1TB', 'SSD SATA', 'Crucial', '81.99', 'SSD'),
('SSD012', 'Samsung 870 QVE', '1TB', 'SSD  SATA3', 'Samsung', '85.98', 'SSD'),
('M2SSD001', 'Kingston NV2', '500GB', 'SSD PCIe 4.0 NVMe Gen 4x4', 'Kingston', '36.99', 'M.2 SSD'),
('M2SSD002', 'Kioxia EXCERIA', '500GB', 'SSD NVMe M.2 2280', 'Kioxia', '39.00', 'M.2 SSD'),
('M2SSD003', 'Crucial P3', '500GB', 'SSD M.2 3D NAND NVMe PCIe SATA 3', 'Crucial', '42.66', 'M.2 SSD'),
('M2SSD004', 'Kioxia Exceria G2', '1TB', 'Unidad SSD NVMe M.2 2280', 'Kioxia', '58.00', 'M.2 SSD'),
('M2SSD005', 'Kingston NV2', '1TB', 'SSD PCIe 4.0 NVMe Gen 4x4', 'Kingston', '59.99', 'M.2 SSD'),
('M2SSD006', 'WD Blue SN570', '1TB', 'M.2 NVMe', 'WD', '62.99', 'M.2 SSD'),
('M2SSD007', 'Kioxia Exceria PLUS', '500GB', 'SSD NVMe M.2 2280', 'Kioxia', '64.00', 'M.2 SSD'),
('M2SSD008', 'WD Green SN350', '1TB', 'SSD M.2 NVMe', 'WD', '72.00', 'M.2 SSD'),
('M2SSD009', 'MSI Spatium M390', '500GB', 'SSD NVMe M.2', 'MSI', '72.00', 'M.2 SSD'),
('M2SSD010', 'WD BLACK SN770', '1TB', 'NVMe SSD', 'WD', '84.99', 'M.2 SSD'),
('M2SSD011', 'Samsung 970 EVO Plus', '1TB', 'SSD NVMe M.2', 'Samsung', '95.69', 'M.2 SSD'),
('M2SSD012', 'Samsung 980 SSD', '1TB', 'PCIe 3.0 NVMe M.2', 'Samsung', '98.97', 'M.2 SSD'),
('M2SSD013', 'Nfortec Alcyon X', '512GB', 'SSD M.2 NVMe', 'Nfortec', '98.99', 'M.2 SSD'),
('M2SSD014', 'WD Black SN850X', '1TB', 'SSD M.2 2280 PCIe Gen4 NVMe', 'WD', '120.00', 'M.2 SSD'),
('M2SSD015', 'Samsung 980 Pro SSD', '1TB', 'PCIe NVMe M.2', 'Samsung', '123.99', 'M.2 SSD'),
('M2SSD016', 'Kioxia Exceria Pro', '1TB', 'Unidad SSD NVMe M.2 2280 PCIe Gen4x4', 'Kioxia', '144.99', 'M.2 SSD'),
('M2SSD017', 'Samsung 980 Pro', '1TB', 'SSD PCIe 4.0 NVMe M.2', 'Samsung', '157.00', 'M.2 SSD'),
('M2SSD018', 'Samsung 970 EVO Plus', '2TB', 'SSD NVMe M.2', 'Samsung', '173.18', 'M.2 SSD'),
('M2SSD019', 'Samsung 980 Pro', '2TB', 'SSD PCIe 4.0 NVMe M.2', 'Samsung', '199.99', 'M.2 SSD'),
('EXT001', 'Toshiba Canvio Basics', '1TB', '2.5 pulgadas USB 3.0', 'Toshiba', '50.00', 'SSD externo'),
('EXT002', 'Toshiba Cambio Basics', '2TB', '2.5 pulgadas USB Negro', 'Toshiba', '62.00', 'SSD externo'),
('EXT003', 'Seagate Expansion Portable', '2TB', '2.5 pulgadas USB 3.0', 'Seagate', '67.87', 'SSD externo'),
('EXT004', 'Samsung T7 Shield', '1TB', 'SSD 3.2 pulgadas NVMe PCIe USB-C Negro', 'Samsung', '121.99', 'SSD externo');
--Datos tabla tienda
INSERT INTO `tienda` (`id_tienda`, `nombre_tienda`, `direccion_tienda`) VALUES
('TI01', 'Tienda Madrid', 'Gran Via 7'),
('TI02', 'Tienda Asturias', 'Calle Constitucion'),
('TI03', 'Tienda Valencia', 'Calle Alcoi');
--Datos tabla empleado
INSERT INTO `empleado` (`dni_empleado`, `nombre_empleado`, `apellido_empleado`, `telefono_empleado`, `edad_empleado`, `fecha_contratacion`, `id_tienda`) VALUES
('3289624A', 'Lucia', 'Garcia', '654321987', 28, '2021-01-01', 'TI01'),
('12895687B', 'Juan', 'Rodriguez', '678901234', 24, '2020-03-15', 'TI02'),
('25761589C', 'Maria', 'Rodriguez', '654987321', 34, '2019-05-10', 'TI01'),
('58978458D', 'Alberto', 'Gonzalez', '678543219', 31, '2022-02-20', 'TI03'),
('98647235E', 'Ana', 'Belen', '654321987', 27, '2018-08-05', 'TI01'),
('32000587F', 'Anais', 'Marroqui', '666777888', 29, '2021-11-12', 'TI02'),
('02578945Q', 'Sofia', 'Ruiz', '678901234', 25, '2020-10-01', 'TI03'),
('82663001H', 'Manuel', 'Sanchez', '654987321', 30, '2019-07-22', 'TI01'),
('25779001I', 'Carlos', 'Martinez', '678543219', 33, '2022-04-30', 'TI02'),
('7986428J', 'Carmen', 'Gomez', '654321987', 26, '2018-12-18', 'TI03'),
('3789023Y', 'Mario', 'Gutierrez ', '687415962', 30, '2022-07-13', 'TI02'),
('27489123U', 'Mario', 'Cesar', '644432842', 31, '2021-11-24', 'TI03');
--Datos stock_tienda
INSERT INTO `stock_tienda` (`id_tienda`, `id_producto`, `cantidad`) VALUES
('TI01', 'SSD004', 14),
('TI01', 'SSD001', 13),
('TI03', 'HDD004', 18),
('TI02', 'HDD004', 5),
('TI02', 'HDD003', 18),
('TI01', 'HDD003', 11),
('TI03', 'HDD002', 17),
('TI02', 'HDD002', 10),
('TI01', 'HDD002', 16),
('TI03', 'HDD001', 15),
('TI02', 'HDD001', 12),
('TI01', 'HDD001', 8),
('TI03', 'SSD003', 13),
('TI02', 'SSD003', 20),
('TI01', 'SSD003', 5),
('TI03', 'SSD002', 10),
('TI02', 'SSD002', 14),
('TI01', 'SSD002', 8),
('TI03', 'SSD001', 18),
('TI02', 'SSD001', 14),
('TI03', 'HDD003', 20),
('TI01', 'HDD004', 5),
('TI03', 'SSD011', 11),
('TI02', 'SSD011', 13),
('TI01', 'SSD011', 14),
('TI03', 'SSD010', 15),
('TI02', 'SSD010', 10),
('TI01', 'SSD010', 16),
('TI03', 'SSD009', 6),
('TI02', 'SSD009', 4),
('TI01', 'SSD009', 5),
('TI03', 'SSD008', 7),
('TI02', 'SSD008', 16),
('TI01', 'SSD008', 18),
('TI03', 'SSD007', 11),
('TI02', 'SSD007', 19),
('TI01', 'SSD007', 7),
('TI03', 'SSD006', 6),
('TI02', 'SSD006', 18),
('TI01', 'SSD006', 15),
('TI03', 'SSD005', 10),
('TI02', 'SSD005', 17),
('TI01', 'SSD005', 11),
('TI03', 'SSD004', 6),
('TI02', 'SSD004', 6),
('TI01', 'SSD012', 14),
('TI02', 'SSD012', 14),
('TI03', 'SSD012', 15),
('TI01', 'M2SSD001', 4),
('TI02', 'M2SSD001', 13),
('TI03', 'M2SSD001', 12),
('TI01', 'M2SSD002', 20),
('TI02', 'M2SSD002', 12),
('TI03', 'M2SSD002', 13),
('TI01', 'M2SSD003', 17),
('TI02', 'M2SSD003', 5),
('TI03', 'M2SSD003', 16),
('TI01', 'M2SSD004', 13),
('TI02', 'M2SSD004', 5),
('TI03', 'M2SSD004', 4),
('TI01', 'M2SSD005', 20),
('TI02', 'M2SSD005', 6),
('TI03', 'M2SSD005', 12),
('TI01', 'M2SSD006', 19),
('TI02', 'M2SSD006', 18),
('TI03', 'M2SSD006', 14),
('TI01', 'M2SSD007', 19),
('TI02', 'M2SSD007', 9),
('TI03', 'M2SSD007', 8),
('TI01', 'M2SSD008', 11),
('TI02', 'M2SSD008', 10),
('TI03', 'M2SSD008', 16),
('TI01', 'M2SSD009', 9),
('TI02', 'M2SSD009', 17),
('TI03', 'M2SSD009', 20),
('TI01', 'M2SSD010', 6),
('TI02', 'M2SSD010', 12),
('TI03', 'M2SSD010', 20),
('TI01', 'M2SSD011', 5),
('TI02', 'M2SSD011', 5),
('TI03', 'M2SSD011', 9),
('TI01', 'M2SSD012', 8),
('TI02', 'M2SSD012', 15),
('TI03', 'M2SSD012', 11),
('TI01', 'M2SSD013', 10),
('TI02', 'M2SSD013', 14),
('TI03', 'M2SSD013', 18),
('TI01', 'M2SSD014', 11),
('TI02', 'M2SSD014', 17),
('TI03', 'M2SSD014', 14),
('TI01', 'M2SSD015', 19),
('TI02', 'M2SSD015', 12),
('TI03', 'M2SSD015', 12),
('TI01', 'M2SSD016', 13),
('TI02', 'M2SSD016', 16),
('TI03', 'M2SSD016', 8),
('TI01', 'M2SSD017', 8),
('TI02', 'M2SSD017', 15),
('TI03', 'M2SSD017', 10),
('TI01', 'M2SSD018', 6),
('TI02', 'M2SSD018', 20),
('TI03', 'M2SSD018', 11),
('TI01', 'M2SSD019', 7),
('TI02', 'M2SSD019', 8),
('TI03', 'M2SSD019', 20),
('TI01', 'EXT001', 10),
('TI02', 'EXT001', 8),
('TI03', 'EXT001', 20),
('TI01', 'EXT002', 10),
('TI02', 'EXT002', 5),
('TI03', 'EXT002', 5),
('TI01', 'EXT003', 9),
('TI02', 'EXT003', 16),
('TI03', 'EXT003', 12),
('TI01', 'EXT004', 14),
('TI02', 'EXT004', 7),
('TI03', 'EXT004', 9);
--Datos stock_almacen
INSERT INTO `stock_almacen` (`id_almacen`, `id_producto`, `cantidad`) VALUES
('ALM01', 'HDD001', 43),
('ALM02', 'HDD001', 39),
('ALM01', 'HDD002', 38),
('ALM02', 'HDD002', 24),
('ALM01', 'HDD003', 44),
('ALM02', 'HDD003', 50),
('ALM01', 'HDD004', 35),
('ALM02', 'HDD004', 25),
('ALM01', 'SSD001', 21),
('ALM02', 'SSD001', 30),
('ALM01', 'SSD002', 36),
('ALM02', 'SSD002', 41),
('ALM01', 'SSD003', 46),
('ALM02', 'SSD003', 18),
('ALM01', 'SSD004', 48),
('ALM02', 'SSD004', 17),
('ALM01', 'SSD005', 40),
('ALM02', 'SSD005', 48),
('ALM01', 'SSD006', 20),
('ALM02', 'SSD006', 27),
('ALM01', 'SSD007', 22),
('ALM02', 'SSD007', 40),
('ALM01', 'SSD008', 32),
('ALM02', 'SSD008', 42),
('ALM01', 'SSD009', 14),
('ALM02', 'SSD009', 42),
('ALM01', 'SSD010', 18),
('ALM02', 'SSD010', 13),
('ALM01', 'SSD011', 39),
('ALM02', 'SSD011', 25),
('ALM01', 'SSD012', 31),
('ALM02', 'SSD012', 37),
('ALM01', 'M2SSD001', 31),
('ALM02', 'M2SSD001', 42),
('ALM01', 'M2SSD002', 19),
('ALM02', 'M2SSD002', 18),
('ALM01', 'M2SSD003', 31),
('ALM02', 'M2SSD003', 50),
('ALM01', 'M2SSD004', 19),
('ALM02', 'M2SSD004', 44),
('ALM01', 'M2SSD005', 42),
('ALM02', 'M2SSD005', 29),
('ALM01', 'M2SSD006', 18),
('ALM02', 'M2SSD006', 24),
('ALM01', 'M2SSD007', 12),
('ALM02', 'M2SSD007', 21),
('ALM01', 'M2SSD008', 18),
('ALM02', 'M2SSD008', 34),
('ALM01', 'M2SSD009', 17),
('ALM02', 'M2SSD009', 32),
('ALM01', 'M2SSD010', 28),
('ALM02', 'M2SSD010', 45),
('ALM01', 'M2SSD011', 48),
('ALM02', 'M2SSD011', 37),
('ALM01', 'M2SSD012', 42),
('ALM02', 'M2SSD012', 35),
('ALM01', 'M2SSD013', 49),
('ALM02', 'M2SSD013', 42),
('ALM01', 'M2SSD014', 11),
('ALM02', 'M2SSD014', 30),
('ALM01', 'M2SSD015', 17),
('ALM02', 'M2SSD015', 41),
('ALM01', 'M2SSD016', 17),
('ALM02', 'M2SSD016', 10),
('ALM01', 'M2SSD017', 29),
('ALM02', 'M2SSD017', 15),
('ALM01', 'M2SSD018', 37),
('ALM02', 'M2SSD018', 39),
('ALM01', 'M2SSD019', 34),
('ALM02', 'M2SSD019', 13),
('ALM01', 'EXT001', 16),
('ALM02', 'EXT001', 48),
('ALM01', 'EXT002', 24),
('ALM02', 'EXT002', 26),
('ALM01', 'EXT003', 17),
('ALM02', 'EXT003', 19),
('ALM01', 'EXT004', 36),
('ALM02', 'EXT004', 18);

-- Se insertan valores en la tabla de usuario para el login del formulario con las passwords encriptadas en el .php
INSERT INTO `usuario` (`id`, `usuario`, `password`) VALUES
(4, 'root', '$2y$10$M7kgVnwvC3WS8w7j3ARhVOcNNgUYX2isSQNN9XXG2y3/YDuOEbGE2'),
(3, 'juan', '$2y$10$Ogt5oq13hp44k/jRHQBYAORoTJrEoR7Jz.rfNwXmxL1biRk0U2U1.'),
(5, 'brian', '$2y$10$bQd/hZIKJbaMmxmdez7PseCJMdQw/L5eQEA6ZxU4zaTmOvEK2rl96'),
(6, 'enrique', '$2y$10$nG/S9alJBKtRcNPatHjTV.fgv3ChC/NJ83Pa.LrlfdQt31jhpu/HS');

--Se crean roles para las diferentes tareas de la empresa.
CREATE ROLE Administrador;
CREATE ROLE Tienda;
CREATE ROLE Almacen;
CREATE ROLE Online;

--Rol de Administrador todos los permisos sobre la base de datos de proyecto
GRANT ALL PRIVILEGES ON proyecto.* TO Administrador;
--Rol de Tienda puede ver, actualizar y insertar datos en las tablas de venta, detalle_venta, stock_tienda
--Puede ver y insertar datos en la tabla de Cliente
--Y puede ver la tabla de producto
GRANT SELECT, INSERT, UPDATE ON Proyecto.venta TO Tienda;
GRANT SELECT, INSERT, UPDATE ON Proyecto.detalle_venta TO Tienda;
GRANT SELECT, INSERT, UPDATE ON Proyecto.stock_tienda TO Tienda;
GRANT SELECT,INSERT  ON Proyecto.cliente TO Tienda;
GRANT SELECT ON Proyecto.producto TO Tienda;
--Rol de Almacen puede ver, actualizar y insertar datos en las tablas de almacen, stock_almacen y producto
--Y puede ver las tablas de stock_tienda, detalle_venta, detalle_venta_online
GRANT SELECT, INSERT, UPDATE ON Proyecto.almacen TO Almacen;
GRANT SELECT, INSERT, UPDATE ON Proyecto.stock_almacen TO Almacen;
GRANT SELECT, INSERT, UPDATE ON Proyecto.producto TO Almacen;
GRANT SELECT ON Proyecto.stock_tienda TO Almacen;
GRANT SELECT ON Proyecto.detalle_venta TO Almacen;
GRANT SELECT ON Proyecto.detalle_venta_online TO Almacen;
--Rol de Online puede ver, actualizar y insertar datos en las tablas de detalle_venta_online y venta_online
--Y puede ver las tablas de producto y cliente
GRANT SELECT, INSERT, UPDATE ON Proyecto.detalle_venta_online TO Online;
GRANT SELECT, INSERT, UPDATE ON Proyecto.venta_online TO Online;
GRANT SELECT ON Proyecto.producto TO Online;
GRANT SELECT ON Proyecto.cliente TO Online;


-- Se crean los usuarios de administración.
CREATE USER administrador1 IDENTIFIED BY 'password';
CREATE USER administrador2 IDENTIFIED BY 'password';
-- Se les asigna el Rol "administrador".
GRANT Administrador TO administrador1;
GRANT Administrador TO administrador2;
-- Se crean los usuarios de Tienda.
CREATE USER tiendaasturias1 IDENTIFIED BY 'password';
CREATE USER tiendaasturias2 IDENTIFIED BY 'password';
CREATE USER tiendavalencia1 IDENTIFIED BY 'password';
CREATE USER tiendavalencia2 IDENTIFIED BY 'password';
CREATE USER tiendamadrid1 IDENTIFIED BY 'password';
CREATE USER tiendamadrid2 IDENTIFIED BY 'password';
CREATE USER tiendamadrid3 IDENTIFIED BY 'password';
-- Se les asigna el Rol "Tienda"
GRANT Tienda TO tiendaasturias1;
GRANT Tienda TO tiendaasturias2;
GRANT Tienda TO tiendavalencia1;
GRANT Tienda TO tiendavalencia2;
GRANT Tienda TO tiendamadrid1;
GRANT Tienda TO tiendamadrid2;
GRANT Tienda TO tiendamadrid3;
-- Se crean los usuarios de Almacen
CREATE USER almacenasturias1 IDENTIFIED BY 'password';
CREATE USER almacenasturias2 IDENTIFIED BY 'password';
CREATE USER almacenmadrid1 IDENTIFIED BY 'password';
CREATE USER almacenmadrid2 IDENTIFIED BY 'password';
-- Se les asigna el Rol de "Almacen"
GRANT Almacen TO almacenasturias1;
GRANT Almacen TO almacenasturias2;
GRANT Almacen TO almacenmadrid1;
GRANT Almacen TO almacenmadrid2;
-- Se crean los usuarios de Online
CREATE USER online1 IDENTIFIED BY 'password';
CREATE USER online2 IDENTIFIED BY 'password';
-- Se les asigna el Rol de "Online"
GRANT Online TO online1;
GRANT Online TO online2;