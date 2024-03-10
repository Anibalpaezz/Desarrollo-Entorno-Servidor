DROP DATABASE IF EXISTS Ejer_nico;

CREATE DATABASE IF NOT EXISTS ejer_nico
    DEFAULT CHARACTER SET utf8mb4
    DEFAULT COLLATE utf8mb4_spanish_ci;

USE ejer_nico;

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    cantidad_stock INT,
    precio_unitario DECIMAL(10, 2)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Inserciones para la tabla productos
INSERT INTO productos (nombre, cantidad_stock, precio_unitario) VALUES
('Producto1', 50, 19.99),
('Producto2', 30, 29.95),
('Producto3', 20, 14.99),
('Producto4', 40, 9.99),
('Producto5', 60, 24.95),
('Producto6', 25, 34.99),
('Producto7', 15, 12.99),
('Producto8', 35, 17.95),
('Producto9', 45, 22.99),
('Producto10', 55, 27.95);

UPDATE productos SET cantidad_stock = 20 WHERE cantidad_stock > 50;

CREATE TABLE proveedores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    tiempo_entrega_dias INT,
    calidad_producto VARCHAR(50)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO proveedores (nombre, tiempo_entrega_dias, calidad_producto) VALUES
('Proveedor1', 3, 'Alta'),
('Proveedor2', 5, 'Media'),
('Proveedor3', 7, 'Baja'),
('Proveedor4', 4, 'Alta'),
('Proveedor5', 6, 'Media'),
('Proveedor6', 8, 'Baja'),
('Proveedor7', 2, 'Alta'),
('Proveedor8', 5, 'Media'),
('Proveedor9', 7, 'Baja'),
('Proveedor10', 4, 'Alta');

CREATE TABLE ordenes_compra (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_producto INT,
    id_proveedor INT,
    cantidad_comprada INT,
    precio_total DECIMAL(10, 2),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_producto) REFERENCES productos(id),
    FOREIGN KEY (id_proveedor) REFERENCES proveedores(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

/* -- Inserciones para la tabla ordenes_compra
INSERT INTO ordenes_compra (id_producto, id_proveedor, cantidad_comprada, precio_total) VALUES
(1, 1, 10, 199.90),
(2, 2, 5, 149.75),
(3, 3, 8, 119.92),
(4, 4, 12, 119.88),
(5, 5, 15, 374.25),
(6, 6, 7, 244.93),
(7, 7, 3, 38.97),
(8, 8, 9, 161.55),
(9, 9, 11, 252.89),
(10, 10, 6, 167.70); */
