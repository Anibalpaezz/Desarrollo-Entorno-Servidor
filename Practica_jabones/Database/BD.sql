DROP DATABASE IF EXISTS jaboneria;
CREATE DATABASE IF NOT EXISTS jaboneria CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

use jaboneria;

CREATE TABLE clientes (
    email VARCHAR(50) PRIMARY KEY,
    nombre VARCHAR(30),
    direccion VARCHAR(40),
    CP UNSIGNED INT,
    telefono VARCHAR(12)
) ENGINE = InnoDB;


CREATE TABLE productos (
    producto_ID INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30),
    descripcion TEXT,
    peso UNSIGNED INT,
    precio UNSIGNED INT,
    imagen VARCHAR(50)
) ENGINE = InnoDB;


CREATE TABLE cesta (
    cesta_ID INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50),
    fecha_creacion DATE,
    FOREIGN KEY (email) REFERENCES clientes(email)
) ENGINE = InnoDB;


CREATE TABLE item_cesta (
    item_cesta_ID INT AUTO_INCREMENT PRIMARY KEY,
    cesta_ID INT,
    producto_ID INT,
    cantidad INT,
    FOREIGN KEY (cesta_ID) REFERENCES cesta(cesta_ID),
    FOREIGN KEY (producto_ID) REFERENCES productos(producto_ID)
) ENGINE = InnoDB;


CREATE TABLE pedidos (
    pedido_ID INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50),
    fecha_pedido DATE,
    fecha_entrega DATE,
    total_pedido INT,
    entregado BOOLEAN,
    FOREIGN KEY (email) REFERENCES clientes(email)
) ENGINE = InnoDB;


CREATE TABLE item_pedido (
    item_pedido_ID INT AUTO_INCREMENT PRIMARY KEY,
    pedido_ID INT,
    producto_ID INT,
    unidades INT,
    FOREIGN KEY (pedido_ID) REFERENCES pedidos(pedido_ID),
    FOREIGN KEY (producto_ID) REFERENCES productos(producto_ID)
) ENGINE = InnoDB;
